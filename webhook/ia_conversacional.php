<?php
/**
 * IA Conversacional - ServiciosYa / Mica 2.0
 * 
 * CAMBIOS vs original:
 * 1. require_once 'claude.php' (adapter LLM + matcheo categorías)
 * 2. llamarOpenAI() → llamarLLM() en procesarConversacion() y procesarConversacionEspera()
 * 3. buildSystemPrompt() mejorado con personalidad Mica 2.0
 * 4. guardarCamposEnBD() ahora matchea categoría contra tabla `categorias`
 */

require_once 'config.php';
require_once 'claude.php';

// ─────────────────────────────────────────────
//  DESCARGA DE MEDIA DESDE TWILIO (SIN CAMBIOS)
// ─────────────────────────────────────────────
function descargarMediaTwilio($url) {
    $sid   = env('TWILIO_SID');
    $token = env('TWILIO_TOKEN');
    if (!$sid || !$token) return null;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERPWD        => "$sid:$token",
        CURLOPT_TIMEOUT        => 30,
    ]);
    $data  = curl_exec($ch);
    $code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $ctype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);

    if ($code !== 200 || empty($data)) return null;
    if (strpos($ctype, 'video') !== false) return ['es_video' => true];

    $mime = 'image/jpeg';
    if (strpos($ctype, 'png')  !== false) $mime = 'image/png';
    if (strpos($ctype, 'webp') !== false) $mime = 'image/webp';
    if (strpos($ctype, 'gif')  !== false) $mime = 'image/gif';

    $b64 = base64_encode($data);
    return ['base64' => $b64, 'mime' => $mime, 'data_url' => "data:$mime;base64,$b64"];
}

function descargarMediaTwilioArchivo($url, string $extension = 'ogg'): ?string {
    $sid   = env('TWILIO_SID');
    $token = env('TWILIO_TOKEN');
    if (!$sid || !$token) return null;

    $tmp = tempnam(sys_get_temp_dir(), 'mica_audio_');
    $path = $tmp . '.' . preg_replace('/[^a-z0-9]/i', '', $extension ?: 'ogg');
    @rename($tmp, $path);

    $fh = fopen($path, 'wb');
    if (!$fh) return null;

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_FILE           => $fh,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_USERPWD        => "$sid:$token",
        CURLOPT_TIMEOUT        => 45,
    ]);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err  = curl_error($ch);
    curl_close($ch);
    fclose($fh);

    if ($err || $code !== 200 || !file_exists($path) || filesize($path) <= 0) {
        @unlink($path);
        _log("Audio download failed HTTP=$code err=$err");
        return null;
    }
    return $path;
}

function transcribirAudioTwilio($url, string $contentType = ''): ?string {
    $apiKey = env('OPENAI_KEY') ?: env('OPENAI_API_KEY');
    if (!$apiKey) {
        _log('Audio transcription skipped: OPENAI_KEY faltante');
        return null;
    }

    $extension = 'ogg';
    if (stripos($contentType, 'mpeg') !== false || stripos($contentType, 'mp3') !== false) $extension = 'mp3';
    if (stripos($contentType, 'wav') !== false) $extension = 'wav';
    if (stripos($contentType, 'mp4') !== false || stripos($contentType, 'm4a') !== false) $extension = 'm4a';

    $path = descargarMediaTwilioArchivo($url, $extension);
    if (!$path) return null;

    $ch = curl_init('https://api.openai.com/v1/audio/transcriptions');
    $post = [
        'model' => 'whisper-1',
        'language' => 'es',
        'file' => new CURLFile($path, $contentType ?: 'audio/ogg', basename($path)),
    ];
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_HTTPHEADER     => ['Authorization: Bearer ' . $apiKey],
        CURLOPT_POSTFIELDS     => $post,
        CURLOPT_TIMEOUT        => 60,
    ]);
    $resp = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err  = curl_error($ch);
    curl_close($ch);
    @unlink($path);

    if ($err || $code !== 200 || !$resp) {
        _log("Audio transcription failed HTTP=$code err=$err resp=" . substr((string)$resp, 0, 250));
        return null;
    }

    $decoded = json_decode($resp, true);
    $text = trim($decoded['text'] ?? '');
    if ($text === '') return null;
    _log('Audio transcription OK len=' . strlen($text));
    return $text;
}

// ─────────────────────────────────────────────
//  LLAMADA A OPENAI (SIN CAMBIOS - fallback)
// ─────────────────────────────────────────────
function llamarOpenAI(array $messages, bool $tieneImagen = false): ?array {
    $apiKey = env('OPENAI_KEY');
    if (!$apiKey) return null;

    $model  = $tieneImagen ? 'gpt-4o' : 'gpt-4o-mini';
    $models = array_unique([$model, 'gpt-4o', 'gpt-4o-mini']);

    $payload = [
        'messages'        => $messages,
        'temperature'     => 0.7,
        'max_tokens'      => 500,
        'response_format' => ['type' => 'json_object'],
    ];

    foreach ($models as $m) {
        $payload['model'] = $m;
        $ch = curl_init('https://api.openai.com/v1/chat/completions');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $apiKey,
            ],
            CURLOPT_POSTFIELDS     => json_encode($payload),
            CURLOPT_TIMEOUT        => 30,
        ]);
        $resp = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        _log("OpenAI modelo=$m HTTP=$code");

        if ($code === 200 && $resp) {
            $decoded = json_decode($resp, true);
            $content = $decoded['choices'][0]['message']['content'] ?? null;
            if ($content) {
                $parsed = json_decode($content, true);
                if ($parsed) return $parsed;
            }
        }
    }
    return null;
}

// ─────────────────────────────────────────────
//  PROMPT DEL SISTEMA — MICA 2.0
// ─────────────────────────────────────────────
function buildSystemPrompt(array $oferta): string {
    $nombre      = $oferta['nombre_cliente'] ?? '';
    $categoria   = $oferta['categoria']      ?? '';
    $descripcion = $oferta['descripcion']    ?? '';
    $zona        = $oferta['zona']           ?? '';
    $tieneMedia  = !empty($oferta['media_url']);
    $mediaDesc   = $oferta['media_descripcion'] ?? '';

    $recolectado = '';
    if ($nombre)      $recolectado .= "- Nombre: $nombre\n";
    if ($categoria)   $recolectado .= "- Tipo de servicio: $categoria\n";
    if ($descripcion) $recolectado .= "- Descripción: $descripcion\n";
    if ($zona)        $recolectado .= "- Zona (provincia y ciudad): $zona\n";
    if ($tieneMedia)  $recolectado .= "- Foto/video: recibido\n";
    if ($mediaDesc)   $recolectado .= "- Descripción de la foto: $mediaDesc\n";

    $falta = '';
    if (!$nombre)      $falta .= "- Nombre del cliente\n";
    if (!$categoria || !$descripcion) $falta .= "- Qué servicio necesita y descripción del problema\n";
    if (!$zona)        $falta .= "- Provincia Y ciudad (ambos obligatorios)\n";

    return <<<PROMPT
# IDENTIDAD
Sos MICA, la asistente virtual de ServiciosYa. Atendés como una operadora humana: cálida, rápida, resolutiva y con criterio. Hablás en español argentino informal (vos, tenés, querés). Usás emojis con moderación (0-1 por mensaje; 2 solo si suma calidez). No suenes como bot ni como formulario.

# ESTILO HUMANO OBLIGATORIO
- Primero entendé lo que la persona necesita; después preguntá lo mínimo que falte.
- No repitas siempre la misma estructura. Variá frases y tono de forma natural.
- No hagas interrogatorio. Si faltan varios datos, pedí solo el dato más importante del momento.
- Si el usuario ya te dio datos mezclados en una frase, aprovechalos y no vuelvas a pedirlos.
- Si algo está confuso, proponé una interpretación y pedí confirmación: "Dale, entiendo que sería plomería por una pérdida, ¿es en Córdoba Capital?"
- Usá recap breve cuando ayude: "Perfecto, entonces sería plomero por una pérdida en Córdoba Capital."
- Evitá frases robóticas como "he registrado", "procederé", "solicitud procesada". Usá: "listo", "ya lo tengo", "me sirve", "te ayudo".
- Si el cliente está apurado o preocupado, bajá ansiedad: "Dale, vamos rápido con esto" / "Tranqui, te ayudo a resolverlo".

# PERSONALIDAD
- Sos como una persona de atención al cliente que se hace cargo.
- Si el cliente está frustrado, validás su emoción primero: "Entiendo, es un garrón cuando pasa eso".
- Usás el nombre del cliente solo cuando queda natural; no lo fuerces en todas las respuestas.
- Respuestas cortas: 1-3 oraciones. WhatsApp, no email.
- Nunca hacés más de UNA pregunta por mensaje.
- Si el cliente hace humor, respondés con onda pero seguís resolviendo.
- Si el cliente está apurado, sos ultra-directa.

# MISIÓN PRINCIPAL
Ayudar al cliente a encontrar un profesional disponible en ServiciosYa. Necesitás recolectar estos datos, sin sonar mecánica:
1. Nombre del cliente, si no lo tenés.
2. Qué servicio necesita + descripción breve del problema.
3. Provincia Y ciudad donde se necesita (ambos obligatorios).
4. Urgencia aproximada: hoy / esta semana / cuando se pueda, solo si surge natural o cambia la prioridad.

Una vez que tenés los datos principales, pedí una foto si ayuda. Si el cliente no tiene foto o está apurado, aceptá seguir sin foto.

# CATEGORÍA DEL SERVICIO
- La categoría debe ser el nombre GENÉRICO de la profesión o servicio en singular
- Ejemplos correctos: "plomero", "electricista", "limpieza", "pintor", "gasista", "jardinero", "mudanza", "cerrajero"
- Si el cliente dice "limpiadora" → la categoría es "limpieza"
- Si el cliente dice "me se rompió un caño" → la categoría es "plomero"
- Si el cliente dice "necesito pintar" → la categoría es "pintor"
- Siempre usá el nombre del servicio/profesión, no la acción ni el adjetivo

# MANEJO DE FOTOS
Cuando el cliente envía una foto:
- Analizá la imagen para entender el problema.
- Describí lo que ves de forma natural: "Ahí veo la pérdida en la zona de la canilla, eso ayuda bastante para presupuestar".
- Usá la información visual para mejorar la descripción del servicio.
- Guardá la descripción en campos_extraidos.media_url.
Si todavía no mandó foto:
- Pedila como ayuda, no como traba: "Si podés, mandame una foto; ayuda a que el profesional presupueste mejor. Si no tenés, seguimos igual."
- Si dice que no tiene foto, no insistas.

# MANEJO DE PROBLEMAS Y SITUACIONES ESPECIALES

## Cliente enojado o frustrado
- Validá la emoción: "Entiendo que es frustrante, [nombre]"
- Ofrecé solución concreta inmediatamente

## Servicio que no existe
- "Uy [nombre], por ahora no tenemos ese servicio en la plataforma"

## Cliente cambia de opinión
- "Dale, sin problema! Arrancamos de nuevo"
- Mantené los datos que sigan siendo válidos

## Cliente quiere registrarse como profesional
- Redirigí a:
  App: https://play.google.com/store/apps/details?id=com.alex_6775.appTrabajo
  Web: https://tooriserviciosya.com/

## Cliente pregunta por precio/costo de la plataforma
- ServiciosYa es GRATIS para el cliente.
- Si pregunta cuánto sale el trabajo, aclarale que depende del profesional y que le vas a conseguir presupuestos. Si ya tenés datos suficientes, podés dar un rango orientativo.

## Cliente manda algo incompleto como "plomero" o "necesito alguien"
- No respondas como formulario. Interpretá y avanzá suave.
- Ejemplo: "Dale, te ayudo con un plomero. ¿Qué problema tenés: pérdida, caño tapado, canilla, termotanque?"

## Cliente manda una urgencia
- Reconocé la urgencia y pedí el dato que falta.
- Ejemplo: "Dale, vamos rápido. ¿En qué ciudad estás?"
- Si hay riesgo físico, agregá una recomendación segura sin alarmar:
  - Olor a gas: "si podés, cerrá la llave de gas y ventilá; no prendas luces ni fuego".
  - Pérdida/inundación: "si podés, cerrá la llave de paso mientras buscamos profesional".
  - Problema eléctrico/chispas: "si es seguro, bajá la térmica y no manipules cables".
  - Cerradura/persona afuera: priorizá cerrajero y zona.
- No reemplazás emergencias: si hay peligro real, sugerí contactar servicio de emergencia/local además de buscar profesional.

# DATOS DE CONTEXTO
DATOS YA RECOLECTADOS:
{$recolectado}

DATOS QUE FALTAN:
{$falta}

# REGLAS ESTRICTAS
- Si un trabajo necesita varias categorías, separar por coma: "plomero, gasista".
- La zona DEBE tener provincia Y ciudad. Si falta uno, preguntá antes de continuar.
- NUNCA pidas dirección exacta (calle y número) en esta etapa; solo provincia y ciudad.
- No inventes datos que el cliente no dijo.
- No prometas disponibilidad garantizada. Decí "voy a buscar profesionales" o "te aviso cuando entren propuestas".
- No digas que ya hay profesionales disponibles si todavía no llegaron presupuestos.
- No culpes al cliente ni a los prestadores.
- Cuando completes la solicitud, dejá una ficha mental clara: servicio, problema, zona, urgencia, foto/audio si hubo.

# LÓGICA DE LA FOTO
- Una vez que tenés nombre + categoría + descripción + zona, pedí UNA foto del problema si suma al presupuesto.
- Si el usuario manda la foto → guardá descripción en media_url, marcá foto_recibida = true, recoleccion_completa = true.
- Si dice que no tiene foto, no puede, está apurado o quiere seguir igual → marcá foto_rechazada = true, recoleccion_completa = true.
- NO vuelvas a pedir la foto si ya la pediste o fue rechazada.

# PRESUPUESTO ESTIMADO (cuando recoleccion_completa = true)
- Calculá un rango estimado basándote en la categoría y descripción
- Estimá por lo alto: mejor que el cliente se sorprenda gratamente
- Usá precios en pesos argentinos acordes a 2025-2026
- Formato: "Entre \$X.000 y \$X.000"
- Aclará que es orientativo

# FORMATO DE RESPUESTA (siempre JSON, sin backticks)
{
  "respuesta": "Mensaje amable para el cliente (máx 2-3 oraciones)",
  "campos_extraidos": {
    "nombre_cliente": "valor o null",
    "categoria": "valor o null",
    "descripcion": "valor o null",
    "zona": "valor o null",
    "media_url": "descripción breve de la imagen o null"
  },
  "foto_recibida": false,
  "foto_rechazada": false,
  "urgencia": "hoy / esta semana / cuando se pueda / null",
  "presupuesto_estimado": "Entre \$X.000 y \$X.000",
  "recoleccion_completa": false
}

recoleccion_completa = true SOLO cuando tenés: nombre, categoria, descripcion, zona (con provincia y ciudad) Y además (foto recibida O foto rechazada).
PROMPT;
}

// ─────────────────────────────────────────────
//  FUNCIÓN PRINCIPAL (CAMBIO: llamarLLM + matcheo)
// ─────────────────────────────────────────────
function procesarConversacion(string $mensaje, array $oferta, array $mediaUrls = []): array {
    _log("procesarConversacion | ofertaId=" . ($oferta['id'] ?? '?') . " | msg=" . substr($mensaje, 0, 60));

    $tieneImagen       = false;
    $videosRecibidos   = [];
    $imagenesRecibidas = [];
    $audiosRecibidos   = [];
    $audioTranscripciones = [];
    $contenidoUsuario  = [];

    $textoUsuario = $mensaje ?: 'El usuario envió un archivo por WhatsApp.';

    foreach ($mediaUrls as $url) {
        $sid   = env('TWILIO_SID');
        $token = env('TWILIO_TOKEN');
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_USERPWD        => "$sid:$token",
            CURLOPT_NOBODY         => true,
            CURLOPT_TIMEOUT        => 10,
        ]);
        curl_exec($ch);
        $ctype = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        curl_close($ch);

        if (strpos($ctype, 'audio') !== false || strpos($ctype, 'ogg') !== false) {
            $audiosRecibidos[] = $url;
            $transcripcion = transcribirAudioTwilio($url, $ctype ?: 'audio/ogg');
            if ($transcripcion) {
                $audioTranscripciones[] = $transcripcion;
                $textoUsuario .= "\n\n[Audio transcripto del cliente]: " . $transcripcion;
            } else {
                $textoUsuario .= "\n\n[El cliente envió un audio, pero no pude transcribirlo automáticamente.]";
            }
            continue;
        }

        if (strpos($ctype, 'video') !== false) {
            $videosRecibidos[] = $url;
            continue;
        }

        $imagenesRecibidas[] = $url;

        $media = descargarMediaTwilio($url);
        if ($media && empty($media['es_video']) && !empty($media['data_url'])) {
            $contenidoUsuario[] = [
                'type'      => 'image_url',
                'image_url' => ['url' => $media['data_url'], 'detail' => 'low'],
            ];
            $tieneImagen = true;
        }
    }

    $contenidoUsuario[] = ['type' => 'text', 'text' => $textoUsuario];

    if (!empty($videosRecibidos) && !$tieneImagen) {
        return [
            'respuesta'          => "📹 ¡Recibí tu video! Los profesionales podrán verlo.\n\n¿Podés enviar también una foto para que pueda darte más detalle?",
            'campos'             => [],
            'completo'           => false,
            'videos_recibidos'   => $videosRecibidos,
            'imagenes_recibidas' => [],
            'audios_recibidos'   => $audiosRecibidos,
            'audio_transcripciones' => $audioTranscripciones,
        ];
    }

    $historial = json_decode($oferta['historial_conversacion'] ?? '[]', true);
    if (!is_array($historial)) $historial = [];

    $messages = [['role' => 'system', 'content' => buildSystemPrompt($oferta)]];
    foreach ($historial as $h) {
        if (!empty($h['role']) && !empty($h['content'])) {
            $messages[] = ['role' => $h['role'], 'content' => $h['content']];
        }
    }
    $messages[] = ['role' => 'user', 'content' => $tieneImagen ? $contenidoUsuario : $textoUsuario];

    // ═══ CAMBIO: llamarLLM en vez de llamarOpenAI ═══
    $parsed = llamarLLM($messages, $tieneImagen);

    if (!$parsed) {
        return [
            'respuesta'          => 'Disculpá, tuve un problema. ¿Podés repetirme?',
            'campos'             => [],
            'completo'           => false,
            'videos_recibidos'   => $videosRecibidos,
            'imagenes_recibidas' => $imagenesRecibidas,
            'audios_recibidos'   => $audiosRecibidos,
            'audio_transcripciones' => $audioTranscripciones,
        ];
    }

    $campos = $parsed['campos_extraidos'] ?? [];
    foreach ($campos as $k => $v) {
        if ($v === 'null' || $v === 'NULL' || $v === '') $campos[$k] = null;
    }

    // ═══ CAMBIO: Matchear categoría contra tabla `categorias` ═══
    if (!empty($campos['categoria'])) {
        $categoriaOriginal = $campos['categoria'];
        $campos['categoria'] = matchearCategoria($categoriaOriginal);
        if ($campos['categoria'] !== $categoriaOriginal) {
            _log("procesarConversacion | Categoría matcheada: '$categoriaOriginal' → '" . $campos['categoria'] . "'");
        }
    }

    $fotoRecibida      = filter_var($parsed['foto_recibida']  ?? false, FILTER_VALIDATE_BOOLEAN);
    $fotoRechazada     = filter_var($parsed['foto_rechazada'] ?? false, FILTER_VALIDATE_BOOLEAN);
    $iaQuiereCompletar = filter_var($parsed['recoleccion_completa'] ?? false, FILTER_VALIDATE_BOOLEAN);

    $presupuestoEstimado = trim($parsed['presupuesto_estimado'] ?? '');
    if ($presupuestoEstimado && $presupuestoEstimado !== 'null') {
        $campos['presupuesto_estimado'] = $presupuestoEstimado;
    }

    $urgencia = trim((string)($parsed['urgencia'] ?? ''));
    if ($urgencia !== '' && strtolower($urgencia) !== 'null') {
        $descActual = trim((string)($campos['descripcion'] ?? $oferta['descripcion'] ?? ''));
        if ($descActual && stripos($descActual, 'urgencia:') === false) {
            $campos['descripcion'] = $descActual . "\nUrgencia: " . $urgencia;
        }
    }

    $fotoYaResuelta = $fotoRecibida || $fotoRechazada || !empty($oferta['media_url']);
    $completo = $iaQuiereCompletar && $fotoYaResuelta;

    _log("IA respuesta=" . substr($parsed['respuesta'] ?? '', 0, 80) . " | completo=" . ($completo ? 'SI' : 'NO'));

    return [
        'respuesta'          => trim($parsed['respuesta'] ?? ''),
        'campos'             => $campos,
        'completo'           => $completo,
        'videos_recibidos'   => $videosRecibidos,
        'imagenes_recibidas' => $imagenesRecibidas,
        'audios_recibidos'   => $audiosRecibidos,
        'audio_transcripciones' => $audioTranscripciones,
    ];
}

// ─────────────────────────────────────────────
//  GUARDAR CAMPOS EN BD (CAMBIO: matcheo ya viene hecho)
// ─────────────────────────────────────────────
function guardarCamposEnBD(string $ofertaId, array $campos, array $videosRecibidos = [], array $imagenesRecibidas = []): void {
    require_once 'db.php';
    _log("guardarCamposEnBD | ofertaId=$ofertaId | imagenes=" . json_encode($imagenesRecibidas) . " | campos=" . json_encode($campos));

    $patch = [];

    $mapeo = ['nombre_cliente', 'categoria', 'descripcion', 'zona'];
    foreach ($mapeo as $campo) {
        if (isset($campos[$campo]) && $campos[$campo] !== null && trim($campos[$campo]) !== '') {
            $patch[$campo] = trim($campos[$campo]);
        }
    }

    if (isset($campos['presupuesto_estimado']) && $campos['presupuesto_estimado'] !== null && trim($campos['presupuesto_estimado']) !== '') {
        $rawPres = trim($campos['presupuesto_estimado']);
        if (preg_match('/(\d[\d\.,]*)/', $rawPres, $m)) {
            $numPart = $m[1];
            $norm = str_replace('.', '', $numPart);
            $norm = str_replace(',', '.', $norm);
            if (is_numeric($norm)) {
                $patch['presupuesto_estimado'] = (float)$norm;
            }
        }
    }

    if (!empty($imagenesRecibidas)) {
        $patch['media_url'] = implode(',', $imagenesRecibidas);
    }

    if (!empty($campos['media_url']) && $campos['media_url'] !== 'null') {
        $patch['media_descripcion'] = $campos['media_url'];
        unset($campos['media_url']);
    }

    if (!empty($videosRecibidos)) {
        $patch['video_urls'] = implode(',', $videosRecibidos);
    }

    if (empty($patch)) {
        _log("guardarCamposEnBD | ofertaId=$ofertaId | nada que guardar");
        return;
    }

    _log("guardarCamposEnBD | ofertaId=$ofertaId | patch=" . json_encode($patch));
    $result = supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", $patch);
    _log("guardarCamposEnBD | resultado=" . json_encode($result));

    if ($result === null) {
        _log("guardarCamposEnBD | supabaseRequest devolvió null, diagnóstico...");
        $current = supabaseRequest('GET', "nuevaOferta?id=eq.$ofertaId");
        file_put_contents('debug_ia.txt', '[' . date('Y-m-d H:i:s') . "] DIAGNOSTIC current: " . json_encode($current) . "\n", FILE_APPEND);

        $url = env('SUPABASE_URL') . "/rest/v1/nuevaOferta?id=eq.$ofertaId";
        $serviceKey = env('SUPABASE_SERVICE_KEY');
        $headers = [
            "apikey: $serviceKey",
            "Authorization: Bearer $serviceKey",
            "Content-Type: application/json",
            "Prefer: return=representation",
        ];
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_CUSTOMREQUEST  => 'PATCH',
            CURLOPT_HTTPHEADER     => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POSTFIELDS     => json_encode($patch),
            CURLOPT_TIMEOUT        => 20,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $resp     = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        file_put_contents('debug_ia.txt', '[' . date('Y-m-d H:i:s') . "] DIAGNOSTIC patch HTTP=$httpCode resp=" . substr($resp, 0, 300) . "\n", FILE_APPEND);
    }
}

// ─────────────────────────────────────────────
//  HISTORIAL DE CONVERSACIÓN (SIN CAMBIOS)
// ─────────────────────────────────────────────
function guardarEnHistorial(string $ofertaId, string $rol, string $contenido): void {
    require_once 'db.php';

    $oferta = supabaseRequest('GET', "nuevaOferta?id=eq.$ofertaId&select=historial_conversacion");
    if (!is_array($oferta) || empty($oferta)) return;

    $historial = json_decode($oferta[0]['historial_conversacion'] ?? '[]', true);
    if (!is_array($historial)) $historial = [];

    $ultimo = end($historial);
    if ($ultimo && $ultimo['role'] === $rol && trim($ultimo['content']) === trim($contenido)) return;

    $historial[] = ['role' => $rol, 'content' => $contenido, 'timestamp' => date('c')];

    $max = intval(env('HISTORIAL_MAX') ?? 0);
    if ($max > 0 && count($historial) > $max) {
        $historial = array_slice($historial, -$max);
    }

    supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", [
        'historial_conversacion' => json_encode($historial),
    ]);
}

// ─────────────────────────────────────────────
//  CONVERSACIÓN DURANTE ESPERA (CAMBIO: llamarLLM)
// ─────────────────────────────────────────────
function procesarConversacionEspera(string $mensaje, array $oferta): array {
    $nombre         = $oferta['nombre_cliente']      ?? 'amigo/a';
    $categoria      = $oferta['categoria']           ?? 'el servicio';
    $zona           = $oferta['zona']                ?? 'tu zona';
    $presupEstimado = $oferta['presupuesto_estimado'] ?? '';

    $contextoPresup = $presupEstimado
        ? "- Presupuesto estimado informado al cliente: $presupEstimado"
        : "- Presupuesto estimado: no disponible";

    $systemPrompt = <<<PROMPT
Sos MICA, la asistente virtual de ServiciosYa.
El cliente ya realizó su solicitud de servicio y está esperando propuestas de profesionales.

CONTEXTO DE SU SOLICITUD:
- Nombre: {$nombre}
- Servicio solicitado: {$categoria}
- Zona: {$zona}
{$contextoPresup}

TU ROL EN ESTE MOMENTO:
- Mantener una conversación amable mientras el cliente espera
- Responder dudas sobre el proceso, profesionales, la plataforma
- Darle tranquilidad de que pronto recibirá propuestas
- Si pregunta por el precio, recordale el rango estimado y aclará que es orientativo
- Si quiere ofrecer sus servicios: https://play.google.com/store/apps/details?id=com.alex_6775.appTrabajo o https://tooriserviciosya.com/
- ServiciosYa es GRATIS para el cliente
- NO preguntes datos que ya tenés
- Respuestas cortas, cálidas y naturales
- Hablá en español argentino informal

FORMATO DE RESPUESTA (siempre JSON, sin backticks):
{
  "respuesta": "Mensaje breve y amable para el cliente"
}
PROMPT;

    $historial = json_decode($oferta['historial_conversacion'] ?? '[]', true);
    if (!is_array($historial)) $historial = [];

    $messages = [['role' => 'system', 'content' => $systemPrompt]];
    foreach ($historial as $h) {
        if (!empty($h['role']) && !empty($h['content'])) {
            $messages[] = ['role' => $h['role'], 'content' => $h['content']];
        }
    }
    $messages[] = ['role' => 'user', 'content' => $mensaje ?: '(sin texto)'];

    // ═══ CAMBIO: llamarLLM ═══
    $parsed = llamarLLM($messages, false);

    return [
        'respuesta' => trim($parsed['respuesta'] ?? ''),
    ];
}

// ─────────────────────────────────────────────
//  LOG HELPER (SIN CAMBIOS)
// ─────────────────────────────────────────────
function _log(string $msg): void {
    file_put_contents('debug_ia.txt', '[' . date('Y-m-d H:i:s') . "] $msg\n", FILE_APPEND);
}
