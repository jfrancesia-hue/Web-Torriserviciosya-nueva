<?php
/**
 * Webhook WhatsApp - ServiciosYa
 * 
 * CAMBIO vs original: Cuando la recolección se completa (paso 4),
 * se actualiza created_at para que el timeout de propuestas arranque
 * desde el momento de publicación, no desde cuando empezó a chatear.
 */

require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';
require_once 'ia_conversacional.php';
require_once 'ranking.php';
require_once 'crear_pago.php';

ignore_user_abort(true);

$telefono  = $_POST['From']  ?? null;
$mensaje   = trim($_POST['Body'] ?? '');

// Capturar media de Twilio
$mediaUrls = [];
$numMedia  = intval($_POST['NumMedia'] ?? 0);
for ($i = 0; $i < $numMedia; $i++) {
    $url = $_POST["MediaUrl$i"] ?? null;
    if ($url) $mediaUrls[] = $url;
}

if (!$telefono) { http_response_code(400); exit; }

_log("WEBHOOK | tel=$telefono | msg=" . substr($mensaje, 0, 60) . " | media=" . count($mediaUrls));

// ─────────────────────────────────────────────
//  BUSCAR OFERTA ACTIVA DEL CLIENTE
// ─────────────────────────────────────────────
$telEnc   = urlencode($telefono);
$ofertas  = supabaseRequest('GET',
    "nuevaOferta?cliente_telefono=eq.$telEnc&estado=in.(recolectando,completa,pendiente)&order=created_at.desc&limit=1"
);
$oferta   = is_array($ofertas) && count($ofertas) > 0 ? $ofertas[0] : null;
$ofertaId = $oferta['id'] ?? null;
$paso     = intval($oferta['paso'] ?? 1);
$estado   = $oferta['estado'] ?? null;

// ─────────────────────────────────────────────
//  INTENCIÓN DE CANCELAR / SALIR
// ─────────────────────────────────────────────
$cancelar = preg_match(
    '/\b(cancelar|cancela|cancelalo|cancelá|cancel|salir|eliminar|elimina|eliminalo|eliminá|eliminame|borrar|borra|borralo|borrá|ya no|no lo necesito|no necesito|no quiero|quiero salir|quiero cancelar|chau|adios|adiós)\b/iu',
    $mensaje
);

if ($cancelar && $ofertaId) {
    supabaseRequest('DELETE', "nuevaOferta?id=eq.$ofertaId");
    _log("Oferta $ofertaId eliminada por solicitud del cliente");
    enviarWhatsApp($telefono, "Entendido, eliminé tu solicitud. Si en algún momento necesitás un profesional, escribime y te ayudo de nuevo 😊");
    http_response_code(200);
    exit;
}

// ─────────────────────────────────────────────
//  PAUSA GLOBAL: procesar pero no responder
// ─────────────────────────────────────────────
$pausaGlobal = env('PAUSA_GLOBAL') == '1';

if ($pausaGlobal && $ofertaId) {
    guardarEnHistorial($ofertaId, 'user', $mensaje ?: '[Envió imagen/video]');
    $res = procesarConversacion($mensaje, $oferta, $mediaUrls);

    $videosRecibidos   = $res['videos_recibidos']   ?? [];
    $imagenesRecibidas = $res['imagenes_recibidas'] ?? [];

    if (!empty($res['campos']) || !empty($videosRecibidos) || !empty($imagenesRecibidas)) {
        if (function_exists('guardarCamposEnBD')) {
            guardarCamposEnBD($ofertaId, $res['campos'] ?? [], $videosRecibidos, $imagenesRecibidas);
        } else {
            $patchData = [];
            $campos = $res['campos'] ?? [];
            if (!empty($campos['categoria'])) $patchData['categoria'] = $campos['categoria'];
            if (!empty($campos['descripcion'])) $patchData['descripcion'] = $campos['descripcion'];
            if (!empty($campos['zona'])) $patchData['zona'] = $campos['zona'];
            if (!empty($imagenesRecibidas)) $patchData['media_url'] = implode(',', $imagenesRecibidas);
            if (!empty($patchData)) supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", $patchData);
        }
    }

    if (!empty($res['respuesta'])) guardarEnHistorial($ofertaId, 'assistant', $res['respuesta']);
    http_response_code(200);
    exit;
}

// ─────────────────────────────────────────────
//  SIN OFERTA ACTIVA → BIENVENIDA + CREAR OFERTA
// ─────────────────────────────────────────────
if (!$oferta) {
    $bienvenida =
        "¡Hola! 👋 Soy *Mica*, tu asistente de *ServiciosYa*.\n\n" .
        "Estoy acá para ayudarte a encontrar el profesional ideal para lo que necesites, rápido y fácil 🛠️\n\n" .
        "Para empezar, *¿cómo te llamás?* 😊";

    $ahora = date('c');
    $historialInicial = json_encode([
        ['role' => 'user',      'content' => $mensaje ?: '[primer mensaje]', 'timestamp' => $ahora],
        ['role' => 'assistant', 'content' => $bienvenida,                    'timestamp' => $ahora],
    ]);

    $created = supabaseRequest('POST', 'nuevaOferta', [
        'cliente_telefono'       => $telefono,
        'paso'                   => 1,
        'estado'                 => 'recolectando',
        'historial_conversacion' => $historialInicial,
    ]);

    $nuevoId = $created[0]['id'] ?? null;
    if (!$nuevoId) {
        $check   = supabaseRequest('GET', "nuevaOferta?cliente_telefono=eq.$telEnc&order=created_at.desc&limit=1");
        $nuevoId = $check[0]['id'] ?? null;
    }

    enviarWhatsApp($telefono, $bienvenida);

    if ($nuevoId && (trim($mensaje) !== '' || (!empty($mediaUrls) && count($mediaUrls) > 0))) {
        $ofertaNueva = supabaseRequest('GET', "nuevaOferta?id=eq.$nuevoId");
        $ofertaNueva = $ofertaNueva[0] ?? null;
        if ($ofertaNueva) {
            $res = procesarConversacion($mensaje, $ofertaNueva, $mediaUrls);
            guardarCamposEnBD($nuevoId, $res['campos'] ?? [], $res['videos_recibidos'] ?? [], $res['imagenes_recibidas'] ?? []);
            if (!empty($mediaUrls) && count($mediaUrls) > 0) {
                supabaseRequest('PATCH', "nuevaOferta?id=eq.$nuevoId", [
                    'media_url' => implode(',', $mediaUrls)
                ]);
            }
        }
    }

    http_response_code(200);
    exit;
}

// ─────────────────────────────────────────────
//  FLUJO DE PASOS AVANZADOS (paso >= 4)
// ─────────────────────────────────────────────
if ($paso >= 4) {
    guardarEnHistorial($ofertaId, 'user', $mensaje ?: '[Envió imagen/video]');
    manejarPasoAvanzado($paso, $oferta, $ofertaId, $telefono, $mensaje);
    http_response_code(200);
    exit;
}

// ─────────────────────────────────────────────
//  FLUJO DE RECOLECCIÓN (paso 1-3)
// ─────────────────────────────────────────────
guardarEnHistorial($ofertaId, 'user', $mensaje ?: '[Envió imagen/video]');

$res = procesarConversacion($mensaje, $oferta, $mediaUrls);

_log("Resultado IA | completo=" . ($res['completo'] ? 'SI' : 'NO') . " | respuesta=" . substr($res['respuesta'] ?? '', 0, 80));

guardarCamposEnBD($ofertaId, $res['campos'] ?? [], $res['videos_recibidos'] ?? [], $res['imagenes_recibidas'] ?? []);

if (!empty($res['respuesta'])) {
    guardarEnHistorial($ofertaId, 'assistant', $res['respuesta']);
}

// ─────────────────────────────────────────────
//  RECOLECCIÓN COMPLETA → PUBLICAR OFERTA
// ─────────────────────────────────────────────
if ($res['completo'] === true) {

    // ═══ CAMBIO: actualizar created_at al momento de publicación ═══
    supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", [
        'estado'     => 'completa',
        'paso'       => 4,
        'created_at' => date('Y-m-d H:i:s'),
    ]);
    _log("Oferta $ofertaId marcada como completa (created_at actualizado)");

    $presupEstimado = trim($oferta['presupuesto_estimado'] ?? $res['campos']['presupuesto_estimado'] ?? '');

    $msgFinal = ($res['respuesta'] ? $res['respuesta'] . "\n\n" : '') .
        "🔍 ¡Listo! Ya estoy buscando profesionales en tu zona. En breve recibirás las mejores propuestas. ¡Gracias por usar ServiciosYa! 🙌";

    if ($presupEstimado) {
        $msgFinal .= "\n\n💰 *Presupuesto estimado orientativo:* " . $presupEstimado .
                     "\n_(El precio final lo define el profesional según lo que vea en el lugar)_";
    }

    enviarWhatsApp($telefono, $msgFinal);

    notificarProfesionales($ofertaId, $res['campos'], $oferta);

} else {
    if (!empty($res['respuesta'])) {
        enviarWhatsApp($telefono, $res['respuesta']);
    }
}

http_response_code(200);
exit;

// ═════════════════════════════════════════════
//  NOTIFICACIÓN A PROFESIONALES (SIN CAMBIOS)
// ═════════════════════════════════════════════
function notificarProfesionales(string $ofertaId, array $camposNuevos, array $ofertaOriginal): void {

    $categoria = $camposNuevos['categoria'] ?? $ofertaOriginal['categoria'] ?? null;
    $zonaRaw   = $camposNuevos['zona']      ?? $ofertaOriginal['zona']      ?? null;

    if (!$categoria || !$zonaRaw) {
        _log("notificarProfesionales | faltan categoria o zona");
        return;
    }

    $norm = function(string $s): string {
        $s = mb_strtolower(trim($s));
        $s = @iconv('UTF-8', 'ASCII//TRANSLIT', $s) ?: $s;
        return trim(preg_replace('/[^a-z0-9\s]/', ' ', $s));
    };

    $capitales = [
        'buenos aires' => 'la plata', 'ciudad autonoma de buenos aires' => 'ciudad autonoma de buenos aires',
        'caba' => 'ciudad autonoma de buenos aires', 'catamarca' => 'san fernando del valle de catamarca',
        'chaco' => 'resistencia', 'chubut' => 'rawson', 'cordoba' => 'cordoba',
        'corrientes' => 'corrientes', 'entre rios' => 'parana', 'formosa' => 'formosa',
        'jujuy' => 'san salvador de jujuy', 'la pampa' => 'santa rosa', 'la rioja' => 'la rioja',
        'mendoza' => 'mendoza', 'misiones' => 'posadas', 'neuquen' => 'neuquen',
        'rio negro' => 'viedma', 'salta' => 'salta', 'san juan' => 'san juan',
        'san luis' => 'san luis', 'santa cruz' => 'rio gallegos', 'santa fe' => 'santa fe',
        'santiago del estero' => 'santiago del estero', 'tierra del fuego' => 'ushuaia',
        'tucuman' => 'san miguel de tucuman',
    ];

    $zonaLimpia   = $norm($zonaRaw);
    $provDetect   = '';
    $ciudadDetect = '';

    foreach ($capitales as $prov => $cap) {
        if (strpos($zonaLimpia, $norm($prov)) !== false) {
            $provDetect = $norm($prov);
            if (strpos($zonaLimpia, 'capital') !== false) {
                $ciudadDetect = $norm($cap);
            }
            break;
        }
    }
    foreach ($capitales as $prov => $cap) {
        $cn = $norm($cap);
        if ($cn && strpos($zonaLimpia, $cn) !== false) {
            $ciudadDetect = $cn;
            if (!$provDetect) $provDetect = $norm($prov);
            break;
        }
    }

    if (!$provDetect || !$ciudadDetect) {
        _log("notificarProfesionales | no se pudo detectar provincia='$provDetect' o ciudad='$ciudadDetect' de '$zonaRaw'");
        return;
    }

    _log("notificarProfesionales | prov=$provDetect | ciudad=$ciudadDetect | categoria=$categoria");

    $variantes = [strtolower(trim($categoria)), ucfirst(strtolower(trim($categoria)))];
    $profesionales = [];
    foreach ($variantes as $v) {
        $enc = urlencode('{' . $v . '}');
        $res = supabaseRequest('GET', "usuarios?categoria=cs.{$enc}&select=id,nombre,apellido,celular,provincia,ciudad");
        if (is_array($res)) $profesionales = array_merge($profesionales, $res);
    }

    $temp = [];
    foreach ($profesionales as $p) {
        if (!empty($p['id'])) $temp[$p['id']] = $p;
    }
    $profesionales = array_values($temp);

    $profesionales = array_values(array_filter($profesionales, function ($p) use ($provDetect, $ciudadDetect, $norm) {
        $pProv   = $norm($p['provincia'] ?? '');
        $pCiudad = $norm($p['ciudad']    ?? $p['localidad'] ?? '');
        return $pProv === $provDetect && $pCiudad === $ciudadDetect;
    }));

    _log("notificarProfesionales | profesionales a notificar=" . count($profesionales));

    foreach ($profesionales as $prof) {
        $celular = preg_replace('/\D/', '', $prof['celular'] ?? '');
        if (!$celular) continue;
        $wa = (substr($celular, 0, 2) === '54') ? "whatsapp:+$celular" : "whatsapp:+54$celular";

        $msg = "🔔 *¡Nueva solicitud disponible!*\n\n" .
               "📋 Servicio: $categoria\n" .
               "📍 Zona: $zonaRaw\n\n" .
               "Ingresá para ver los detalles y enviar tu presupuesto 💼\n" .
               "https://tooriserviciosya.com/ofertas.php\n\n" .
               "📱 App: https://play.google.com/store/apps/details?id=com.alex_6775.appTrabajo";

        enviarWhatsApp($wa, $msg);
        _log("  -> Notificado: " . ($prof['nombre'] ?? '') . " | $wa");
    }
}

// ═════════════════════════════════════════════
//  PASOS AVANZADOS (SIN CAMBIOS)
// ═════════════════════════════════════════════
function manejarPasoAvanzado(int $paso, array $oferta, string $ofertaId, string $telefono, string $mensaje): void {
    switch ($paso) {
        case 4:
        case 98: // Segunda espera (15 min) — mismo comportamiento que paso 4
            mostrarPresupuestos($ofertaId, $telefono, $mensaje, $oferta);
            break;
        case 99:
            seleccionarPresupuesto($ofertaId, $telefono, $mensaje);
            break;
        case 995:
            confirmarFechaHora($ofertaId, $telefono, $mensaje);
            break;
        case 996:
            guardarDomicilio($ofertaId, $telefono, $mensaje);
            break;
        case 999:
            enviarWhatsApp($telefono, "Tu solicitud está pendiente de pago. Una vez que pagues, confirmamos el servicio. 💳");
            break;
        default:
            mostrarPresupuestos($ofertaId, $telefono, $mensaje, $oferta);
            break;
    }
}

function mostrarPresupuestos(string $ofertaId, string $telefono, string $mensaje, array $oferta): void {
    $presupuestos = supabaseRequest('GET',
        "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc&limit=3"
    );

    $presupEstimadoEspera = trim($oferta['presupuesto_estimado'] ?? '');
    $footer = "\n\n⏳ Todavía estamos esperando propuestas de profesionales. Te avisamos en cuanto lleguen, ¡ya casi!";
    if ($presupEstimadoEspera) {
        $footer .= "\n💰 *Presupuesto estimado:* " . $presupEstimadoEspera . " _(orientativo)_";
    }
    $footer .= "\nEn caso de querer cancelar o editar la oferta escribí *eliminar* para deshacer la oferta.";

    if (!is_array($presupuestos) || count($presupuestos) === 0) {
        $res = procesarConversacionEspera($mensaje, $oferta);
        $respuestaIA = trim($res['respuesta'] ?? '');
        if (!$respuestaIA) {
            $respuestaIA = "¡Claro! Estoy acá para ayudarte.";
        }
        enviarWhatsApp($telefono, $respuestaIA . $footer);
        guardarEnHistorial($ofertaId, 'assistant', $respuestaIA . $footer);
        return;
    }

    $msg = "🎯 *Aquí están las mejores propuestas:*\n\n";
    $i   = 1;
    foreach ($presupuestos as $p) {
        if (!is_array($p)) continue;
        $monto       = (float)($p['monto'] ?? 0);
        $horarios    = trim($p['horarios_disponibles'] ?? '');
        $descripcion = trim($p['descripcion'] ?? '');
        $tId         = $p['trabajador_uuid'] ?? $p['trabajador_id'] ?? null;
        $nombreTrab  = '';
        $perfilLink  = '';

        if ($tId) {
            $u = supabaseRequest('GET', "usuarios?id=eq.$tId&select=nombre,apellido,id");
            if (is_array($u) && count($u) > 0) {
                $nombreTrab = trim(($u[0]['nombre'] ?? '') . ' ' . ($u[0]['apellido'] ?? ''));
                $perfilLink = 'https://tooriserviciosya.com/PerfileProfesionales.php?ids=' . urlencode($u[0]['id']);
            }
        }

        $msg .= "{$i}️⃣ *Opción $i*\n";
        if ($nombreTrab) $msg .= "   👷 $nombreTrab\n";
        if ($perfilLink) $msg .= "   🔗 $perfilLink\n";
        $msg .= "   💵 \$" . number_format($monto, 0, ',', '.') . "\n";
        if ($horarios)    $msg .= "   🕐 $horarios\n";
        if ($descripcion) $msg .= "   📝 $descripcion\n";
        $msg .= "\n";
        $i++;
    }
    $msg .= "Respondé con *1*, *2* o *3* para elegir.";
    enviarWhatsApp($telefono, $msg);
    supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", ['paso' => 99]);
}

function seleccionarPresupuesto(string $ofertaId, string $telefono, string $mensaje): void {
    $eleccion = intval($mensaje);
    if ($eleccion < 1 || $eleccion > 3) {
        enviarWhatsApp($telefono, "Por favor respondé con *1*, *2* o *3* para seleccionar.");
        return;
    }

    $presupuestos = supabaseRequest('GET',
        "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc&limit=3"
    );
    if (!isset($presupuestos[$eleccion - 1])) {
        enviarWhatsApp($telefono, "Opción inválida. Respondé *1*, *2* o *3*.");
        return;
    }

    $p          = $presupuestos[$eleccion - 1];
    $monto      = (float)($p['monto'] ?? 0);
    $comision   = $monto * 0.15;

    supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", [
        'presupuesto_seleccionado_id' => $p['id'],
        'monto_final'                 => $comision,  // Solo cobra la seña (15%)
        'comision'                    => $comision,
        'paso'                        => 995,
    ]);

    enviarWhatsApp($telefono,
        "¡Excelente elección! 👍\n\n" .
        "¿En qué fecha y hora te gustaría que llegue el profesional?\n\n" .
        "Ejemplos:\n• Hoy a las 17hs\n• Mañana a las 14:30\n• Viernes a las 15hs"
    );
}

function confirmarFechaHora(string $ofertaId, string $telefono, string $mensaje): void {
    $m = strtolower(trim($mensaje));
    $valido = preg_match('/\d/', $m) ||
              preg_match('/\b(hoy|mañana|lunes|martes|miércoles|miercoles|jueves|viernes|sábado|sabado|domingo|tarde|noche|mediodía|mediodia)\b/u', $m);

    if (!$valido) {
        enviarWhatsApp($telefono,
            "Por favor ingresá una fecha y hora válida.\n\nEjemplos:\n• Hoy a las 17hs\n• Mañana a las 14:30\n• 10/03 a las 18hs"
        );
        return;
    }

    supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", [
        'fecha_hora_acordada' => $mensaje,
        'paso'                => 996,
    ]);

    enviarWhatsApp($telefono,
        "📍 Ahora necesito tu domicilio completo para que el profesional pueda llegar.\n\n" .
        "Indicá: calle y número, barrio/ciudad, y alguna referencia útil.\n\n" .
        "Ejemplo: *Av. San Martín 1234, Centro, Catamarca. Casa con portón verde.*"
    );
}

function guardarDomicilio(string $ofertaId, string $telefono, string $mensaje): void {
    if (strlen(trim($mensaje)) < 10) {
        enviarWhatsApp($telefono, "Por favor, ingresá un domicilio más completo (calle, número y ciudad).");
        return;
    }

    supabaseRequest('PATCH', "nuevaOferta?id=eq.$ofertaId", [
        'domicilio' => trim($mensaje),
        'paso'      => 999,
    ]);

    $ofertaData = supabaseRequest('GET', "nuevaOferta?id=eq.$ofertaId");
    $ofertaData = $ofertaData[0] ?? null;
    $montoTotal = (float)($ofertaData['monto_final'] ?? 0);
    $presupId   = $ofertaData['presupuesto_seleccionado_id'] ?? null;
    $fechaHora  = $ofertaData['fecha_hora_acordada'] ?? '';

    $linkPago     = crear_link_pago($montoTotal, $presupId);
    $montoFormato = number_format($montoTotal, 0, ',', '.');

    $msgPago = !empty(trim($linkPago ?? ''))
        ? "✅ *Resumen de tu solicitud:*\n\n📅 $fechaHora\n📍 " . trim($mensaje) . "\n💰 *Seña para confirmar:* \$$montoFormato\n_(El resto se abona directo al profesional)_\n\nPagá acá para confirmar:\n" . trim($linkPago)
        : "Para confirmar el servicio debés abonar una seña de: \$$montoFormato. Te enviamos el link en breve.";

    enviarWhatsApp($telefono, $msgPago);

    $presup = supabaseRequest('GET', "presupuestos?id=eq.$presupId");
    $profId = $presup[0]['trabajador_uuid'] ?? null;
    if ($profId) {
        $prof = supabaseRequest('GET', "usuarios?id=eq.$profId&select=celular");
        $cel  = preg_replace('/\D/', '', $prof[0]['celular'] ?? '');
        if ($cel) {
            $wa = (substr($cel, 0, 2) === '54') ? "whatsapp:+$cel" : "whatsapp:+54$cel";
            enviarWhatsApp($wa, "✅ Uno de tus presupuestos fue aceptado y pagado. Revisá la app para ver los detalles y presioná 'Finalizar' al terminar.");
        }
    }
}