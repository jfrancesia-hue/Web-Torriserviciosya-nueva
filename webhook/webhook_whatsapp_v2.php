<?php
/**
 * Webhook WhatsApp - ServiciosYa
 * 
 * Versión 2.0 - IA Conversacional Guiada
 * 
 * Flujo:
 * 1. IA conversa libremente recolectando información
 * 2. Cuando tiene todo, muestra precio estimado y busca profesionales
 * 3. Muestra top 3 propuestas
 * 4. Cliente selecciona, paga y confirma
 */

require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';
require_once 'ia_conversacional.php';
require_once 'ranking.php';
require_once 'crear_pago.php';

// Responder inmediatamente a Twilio para evitar timeout
ignore_user_abort(true);

$telefono = $_POST['From'] ?? null;
$mensaje  = trim($_POST['Body'] ?? '');

// Capturar media (fotos/videos) de Twilio
$mediaUrls = [];
$numMedia = intval($_POST['NumMedia'] ?? 0);
for ($i = 0; $i < $numMedia; $i++) {
    $mediaUrl = $_POST["MediaUrl$i"] ?? null;
    if ($mediaUrl) {
        $mediaUrls[] = $mediaUrl;
    }
}

if (!$telefono && empty($mediaUrls)) {
    http_response_code(400);
    exit;
}

// Log inicial
file_put_contents("debug.txt", "[" . date('Y-m-d H:i:s') . "] WEBHOOK - Tel: $telefono | Msg: " . substr($mensaje, 0, 50) . " | Media: " . count($mediaUrls) . "\n", FILE_APPEND);

/* =========================================
   1️⃣ Buscar oferta pendiente del cliente
========================================= */

$telefonoEncoded = urlencode($telefono);
$endpoint = "nuevaOferta?cliente_telefono=eq.$telefonoEncoded&estado=in.(pendiente,completa,recolectando)&order=created_at.desc&limit=1";
$ofertas = supabaseRequest("GET", $endpoint);

if (!is_array($ofertas)) {
    $ofertas = [];
}

/* =========================================
   2️⃣ Si no existe, crear nueva conversación
========================================= */

if (!$ofertas || count($ofertas) === 0) {
    // Crear nueva oferta en estado "recolectando"
    $nueva = supabaseRequest("POST", "nuevaOferta", [
        "cliente_telefono" => $telefono,
        "paso" => 1,
        "estado" => "recolectando",
        "historial_conversacion" => "[]"
    ]);
    
    // Obtener la oferta recién creada
    $ofertas = supabaseRequest("GET", $endpoint);
    
    if (!$ofertas || count($ofertas) === 0) {
        enviarWhatsApp($telefono, "¡Hola! 👋 Soy el asistente de ServiciosYa. ¿En qué puedo ayudarte hoy?");
        http_response_code(200);
        exit;
    }
}

$oferta = $ofertas[0];
$ofertaId = $oferta['id'];
$paso = (int)($oferta['paso'] ?? 1);
$estado = $oferta['estado'] ?? 'recolectando';

file_put_contents("debug.txt", "[WEBHOOK] ofertaId=$ofertaId | paso=$paso | estado=$estado\n", FILE_APPEND);

/* =========================================
   3️⃣ Manejo por estados
========================================= */

// Si está en proceso de pago o ya completó, usar flujo anterior
if ($paso >= 99) {
    manejarPasoAvanzado($paso, $oferta, $ofertaId, $telefono, $mensaje);
    http_response_code(200);
    exit;
}

/* =========================================
   4️⃣ FLUJO CONVERSACIONAL (estado: recolectando)
========================================= */

// Guardar mensaje del usuario en historial
guardarEnHistorial($ofertaId, "user", $mensaje ?: "[Envió imagen/video]");

// Procesar con IA conversacional
$resultado = procesarConversacion($mensaje, $oferta, $mediaUrls);

file_put_contents("debug.txt", "[IA] Resultado: " . json_encode($resultado) . "\n", FILE_APPEND);

// Actualizar oferta con campos extraídos
if (!empty($resultado['campos'])) {
    actualizarOfertaConCampos($ofertaId, $resultado['campos'], $mediaUrls);
}

// Guardar respuesta de IA en historial
if (!empty($resultado['respuesta'])) {
    guardarEnHistorial($ofertaId, "assistant", $resultado['respuesta']);
}

// Si la recolección está completa
if ($resultado['completo'] === true) {
    
    // Construir mensaje final con precio estimado
    $mensajeFinal = $resultado['respuesta'];
    
    if (!empty($resultado['precio_estimado'])) {
        $precio = $resultado['precio_estimado'];
        if (!str_contains($mensajeFinal, '$')) {
            // Solo agregar si la IA no incluyó precio en su respuesta
            $min = number_format($precio['minimo'] ?? 0, 0, ',', '.');
            $max = number_format($precio['maximo'] ?? 0, 0, ',', '.');
            $mensajeFinal .= "\n\n💰 *Precio estimado:* \$$min - \$$max";
        }
    }
    
    $mensajeFinal .= "\n\n🔍 Ya estoy contactando profesionales de tu zona. En breve recibirás las mejores propuestas.";
    
    // Actualizar estado a "completa" y paso 4
    supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", [
        "estado" => "completa",
        "paso" => 4
    ]);
    
    enviarWhatsApp($telefono, $mensajeFinal);
    
} else {
    // Continuar conversación
    enviarWhatsApp($telefono, $resultado['respuesta']);
}

http_response_code(200);
exit;

/* =========================================
   FUNCIONES DE PASOS AVANZADOS
========================================= */

function manejarPasoAvanzado($paso, $oferta, $ofertaId, $telefono, $mensaje) {
    
    switch ($paso) {
        
        /* --------------------------
           PASO 4 — Mostrar top 3 presupuestos
        --------------------------- */
        case 4:
            mostrarPresupuestos($ofertaId, $telefono);
            break;
        
        /* --------------------------
           PASO 99 — Seleccionar presupuesto
        --------------------------- */
        case 99:
            seleccionarPresupuesto($ofertaId, $telefono, $mensaje);
            break;
        
        /* --------------------------
           PASO 995 — Confirmar fecha/hora
        --------------------------- */
        case 995:
            confirmarFechaHora($ofertaId, $telefono, $mensaje);
            break;
        
        /* --------------------------
           PASO 996 — Guardar domicilio
        --------------------------- */
        case 996:
            guardarDomicilio($ofertaId, $telefono, $mensaje);
            break;
        
        /* --------------------------
           PASO 999 — Esperando pago
        --------------------------- */
        case 999:
            enviarWhatsApp($telefono, "Tu solicitud está pendiente de pago. Una vez que pagues, confirmaremos el servicio. 💳");
            break;
        
        default:
            enviarWhatsApp($telefono, "Ya estamos procesando tu solicitud. Te avisamos pronto. 👍");
            break;
    }
}

function mostrarPresupuestos($ofertaId, $telefono) {
    $presupuestos = supabaseRequest(
        "GET",
        "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc&limit=3"
    );
    
    if (!is_array($presupuestos)) $presupuestos = [];
    
    if (count($presupuestos) > 0) {
        $mensaje_top3 = "🎯 *Aquí están las mejores propuestas:*\n\n";
        
        $i = 1;
        foreach ($presupuestos as $p) {
            if (!is_array($p)) continue;
            
            $monto = (float)($p['monto'] ?? 0);
            $horarios = trim($p['horarios_disponibles'] ?? '');
            $descripcion = trim($p['descripcion'] ?? '');
            
            $mensaje_top3 .= "$i️⃣ *Opción $i*\n";
            $mensaje_top3 .= "   💵 Precio: \$" . number_format($monto, 0, ',', '.') . "\n";
            if (!empty($horarios)) {
                $mensaje_top3 .= "   🕐 Horarios: $horarios\n";
            }
            if (!empty($descripcion)) {
                $mensaje_top3 .= "   📝 Incluye: $descripcion\n";
            }
            $mensaje_top3 .= "\n";
            $i++;
        }
        
        $mensaje_top3 .= "Respondé con *1*, *2* o *3* para elegir.";
        
        enviarWhatsApp($telefono, $mensaje_top3);
        
        supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", ["paso" => 99]);
        
    } else {
        // No hay presupuestos aún - el cron job notificará cuando lleguen
        file_put_contents("debug.txt", "[PASO 4] Sin presupuestos para oferta $ofertaId\n", FILE_APPEND);
    }
}

function seleccionarPresupuesto($ofertaId, $telefono, $mensaje) {
    $eleccion = intval($mensaje);
    
    if ($eleccion >= 1 && $eleccion <= 3) {
        $presupuestos = supabaseRequest(
            "GET",
            "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc&limit=3"
        );
        
        if (!isset($presupuestos[$eleccion - 1])) {
            enviarWhatsApp($telefono, "Opción inválida. Respondé *1*, *2* o *3*.");
            return;
        }
        
        $presupuesto = $presupuestos[$eleccion - 1];
        $monto = (float)($presupuesto['monto'] ?? 0);
        $comision = $monto * 0.15;
        $monto_total = $monto + $comision;
        
        supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", [
            "presupuesto_seleccionado_id" => $presupuesto['id'],
            "monto_final" => $monto_total,
            "comision" => $comision,
            "paso" => 995
        ]);
        
        enviarWhatsApp($telefono, 
            "¡Excelente elección! 👍\n\n" .
            "¿En qué fecha y hora te gustaría que llegue el profesional?\n\n" .
            "Ejemplos:\n" .
            "• Hoy a las 17hs\n" .
            "• Mañana a las 14:30\n" .
            "• Viernes a las 15hs"
        );
        
    } else {
        enviarWhatsApp($telefono, "Por favor respondé con *1*, *2* o *3* para seleccionar.");
    }
}

function confirmarFechaHora($ofertaId, $telefono, $mensaje) {
    $mensaje_normalizado = strtolower(trim($mensaje));
    
    $palabras_validas = [
        'hoy', 'mañana', 'pasado', '/', '-', 'hs', 'h ', ':',
        'lunes', 'martes', 'miércoles', 'miercoles', 'jueves', 'viernes', 'sábado', 'sabado', 'domingo',
        'próximo', 'proximo', 'esta', 'semana', 'tarde', 'mañana', 'noche', 'mediodía', 'mediodia'
    ];
    
    $es_valido = false;
    foreach ($palabras_validas as $palabra) {
        if (strpos($mensaje_normalizado, $palabra) !== false) {
            $es_valido = true;
            break;
        }
    }
    
    // También validar si contiene números (podría ser una fecha como "15/03")
    if (preg_match('/\d/', $mensaje_normalizado)) {
        $es_valido = true;
    }
    
    if (!$es_valido) {
        enviarWhatsApp($telefono,
            "Por favor, ingresá una fecha y hora válida.\n\n" .
            "Ejemplos:\n" .
            "• Hoy a las 17hs\n" .
            "• Mañana a las 14:30\n" .
            "• 10/03 a las 18hs"
        );
        return;
    }
    
    supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", [
        "fecha_hora_acordada" => $mensaje,
        "paso" => 996
    ]);
    
    enviarWhatsApp($telefono,
        "📍 Ahora necesito tu domicilio completo para que el profesional pueda llegar.\n\n" .
        "Indicá:\n" .
        "• Calle y número\n" .
        "• Barrio/Ciudad\n" .
        "• Alguna referencia útil\n\n" .
        "Ejemplo: *Av. San Martín 1234, Centro, Catamarca. Casa con portón verde.*"
    );
}

function guardarDomicilio($ofertaId, $telefono, $mensaje) {
    if (strlen(trim($mensaje)) < 10) {
        enviarWhatsApp($telefono,
            "Por favor, ingresá un domicilio más completo con calle, número y ciudad."
        );
        return;
    }
    
    supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", [
        "domicilio" => trim($mensaje),
        "paso" => 999
    ]);
    
    $oferta_data = supabaseRequest("GET", "nuevaOferta?id=eq.$ofertaId");
    $oferta_data = is_array($oferta_data) && count($oferta_data) > 0 ? $oferta_data[0] : null;
    
    $monto_total = (float)($oferta_data['monto_final'] ?? 0);
    $presupuesto_id = $oferta_data['presupuesto_seleccionado_id'] ?? null;
    $fecha_hora = $oferta_data['fecha_hora_acordada'] ?? '';
    
    $link_pago = crear_link_pago($monto_total, $presupuesto_id);
    $monto_formateado = number_format($monto_total, 0, ',', '.');
    
    if ($link_pago && !empty(trim($link_pago))) {
        $mensaje_pago = "✅ *Resumen de tu solicitud:*\n\n" .
                       "📅 Fecha y hora: $fecha_hora\n" .
                       "📍 Domicilio: " . trim($mensaje) . "\n" .
                       "💰 Total a pagar: \$" . $monto_formateado . "\n\n" .
                       "Para confirmar el servicio, realizá el pago:\n" . 
                       trim($link_pago);
    } else {
        $mensaje_pago = "Para confirmar el servicio debés pagar: \$" . $monto_formateado . ". Te enviaremos el link en breve.";
    }
    
    enviarWhatsApp($telefono, $mensaje_pago);
}
