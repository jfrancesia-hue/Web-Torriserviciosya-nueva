<?php
require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';

$payload = @file_get_contents('php://input');
$event = json_decode($payload, true);

file_put_contents("debug.txt", "[WEBHOOK_PAGO] Recibido: " . json_encode($event) . "\n", FILE_APPEND);

$payment_id = null;

if (isset($event['topic']) && $event['topic'] === 'payment' && isset($event['resource'])) {
    $payment_id = $event['resource'];
}

if (isset($event['type']) && $event['type'] === 'payment' && isset($event['data']['id'])) {
    $payment_id = $event['data']['id'];
}

if (!$payment_id) {
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] No es notificación de pago válida\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

file_put_contents("debug.txt", "[WEBHOOK_PAGO] Payment ID detectado: $payment_id\n", FILE_APPEND);

$access_token = env('MERCADO_PAGO_ACCESS_TOKEN');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.mercadopago.com/v1/payments/$payment_id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $access_token",
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

file_put_contents("debug.txt", "[WEBHOOK_PAGO] API Response HTTP $http_code: " . substr($response, 0, 500) . "\n", FILE_APPEND);

if ($http_code !== 200) {
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] Error al consultar pago en API\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

$payment = json_decode($response, true);

$status = $payment['status'] ?? null;
$external_reference = $payment['external_reference'] ?? null;
$monto = $payment['transaction_amount'] ?? 0;

file_put_contents("debug.txt", "[WEBHOOK_PAGO] Payment Status: $status | Reference: $external_reference | Monto: $monto\n", FILE_APPEND);

if ($status !== 'approved') {
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] Pago con status: $status (no aprobado) - Ignorando\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

if (empty($external_reference)) {
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] ❌ No hay external_reference\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

preg_match('/presupuesto_(\d+)/', $external_reference, $matches);
$presupuesto_id = $matches[1] ?? null;

if (!$presupuesto_id) {
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] ❌ No se pudo extraer presupuesto_id de: $external_reference\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

file_put_contents("debug.txt", "[WEBHOOK_PAGO] ✅ Pago APROBADO - Presupuesto ID: $presupuesto_id | Monto: $monto\n", FILE_APPEND);

// 1️⃣ Obtener datos del presupuesto
$presupuesto = supabaseRequest(
    "GET",
    "presupuestos?id=eq.$presupuesto_id"
);

$presupuesto = is_array($presupuesto) && count($presupuesto) > 0 ? $presupuesto[0] : null;

if (!$presupuesto) {
    file_put_contents("debug.txt", "[ERROR] Presupuesto $presupuesto_id no encontrado\n", FILE_APPEND);
    http_response_code(200);
    exit;
}

$oferta_id = $presupuesto['oferta_id'] ?? null;
$comision = $monto; // El monto pagado YA es la comisión (15%)

// 2️⃣ Guardar registro de pago
supabaseRequest("POST", "presupuestopagado", [
    "presupuesto_id" => $presupuesto_id,
    "oferta_id" => $oferta_id,
    "monto_total" => $monto,
    "comision" => $comision,
    "payment_id" => $payment_id,
    "estado" => "aprobado"
]);

file_put_contents("debug.txt", "[WEBHOOK_PAGO] Registro guardado en presupuestopagado\n", FILE_APPEND);

// 3️⃣ Actualizar oferta como pagada
supabaseRequest(
    "PATCH",
    "nuevaOferta?id=eq.$oferta_id",
    [
        "pagado" => true,
        "estado" => "pagada",
        "presupuesto_seleccionado_id" => $presupuesto_id,
        "monto_final" => $monto,
        "comision" => $comision,
        "fecha_pago" => date("Y-m-d H:i:s"),
        "paso" => 100
    ]
);

file_put_contents("debug.txt", "[WEBHOOK_PAGO] Oferta $oferta_id actualizada como pagada\n", FILE_APPEND);

// 4️⃣ Obtener oferta para contactar al cliente
$oferta = supabaseRequest(
    "GET",
    "nuevaOferta?id=eq.$oferta_id"
);

$oferta = is_array($oferta) && count($oferta) > 0 ? $oferta[0] : null;

if ($oferta && isset($oferta['cliente_telefono'])) {
    $telefono = $oferta['cliente_telefono'];
    $fecha_hora = $oferta['fecha_hora_acordada'] ?? null;
    $domicilio = $oferta['domicilio'] ?? null;
    
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] Oferta data: " . json_encode($oferta) . "\n", FILE_APPEND);
    
    if (empty($fecha_hora)) {
        $fecha_hora = "Fecha a coordinar";
    }
    
    if (empty($domicilio)) {
        $domicilio = "Domicilio a confirmar";
    }
    
    // Obtener datos del trabajador
    $trabajador_nombre = "Trabajador asignado";
    $trabajador_celular = "";
    $trabajador_uuid = $presupuesto['trabajador_uuid'] ?? null;
    
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] trabajador_uuid: " . ($trabajador_uuid ?? 'NULL') . "\n", FILE_APPEND);
    
    if ($trabajador_uuid) {
        $usuario = supabaseRequest(
            "GET",
            "usuarios?id=eq.$trabajador_uuid"
        );
        
        file_put_contents("debug.txt", "[WEBHOOK_PAGO] Usuario encontrado: " . json_encode($usuario) . "\n", FILE_APPEND);
        
        if (is_array($usuario) && count($usuario) > 0) {
            $trabajador_nombre = $usuario[0]['nombre'] ?? "Trabajador asignado";
            $trabajador_celular = trim($usuario[0]['celular'] ?? '');
            file_put_contents("debug.txt", "[WEBHOOK_PAGO] Nombre: $trabajador_nombre | Celular: $trabajador_celular\n", FILE_APPEND);
        }
    }
    
    $monto_formateado = number_format($monto, 2);
    
    // ═══ CAMBIO: Agregar celular del profesional al mensaje ═══
    $mensaje = "✅ *¡Pago confirmado!*\n\n" .
               "👷 *Trabajador:* $trabajador_nombre\n" .
               "📅 *Fecha y hora:* $fecha_hora\n" .
               "📍 *Domicilio:* $domicilio\n" .
               "💰 *Seña pagada:* \$$monto_formateado\n\n";
    
    // Agregar celular del profesional si lo tiene
    if (!empty($trabajador_celular)) {
        // Formatear número para WhatsApp (sin el prefijo whatsapp:+)
        $celLimpio = preg_replace('/\D/', '', $trabajador_celular);
        $mensaje .= "📞 *Contacto del profesional:* +$celLimpio\n" .
                     "_(Podés contactarlo directamente por WhatsApp para coordinar detalles)_\n\n";
    }
    
    $mensaje .= "El trabajador se presentará en la fecha, hora y domicilio indicados. ¡Gracias por confiar en ServiciosYa!";
    
    enviarWhatsApp($telefono, $mensaje);
    
    file_put_contents("debug.txt", "[WEBHOOK_PAGO] ✅ Mensaje de confirmación enviado a $telefono\n", FILE_APPEND);
    
    // ---------------------------
    // Enviar aviso al profesional
    // ---------------------------
    $presupuesto_prof = supabaseRequest("GET", "presupuestos?id=eq.$presupuesto_id");
    if (is_array($presupuesto_prof) && count($presupuesto_prof) > 0) {
        $profesional_id = $presupuesto_prof[0]['profesional_id'] ?? $presupuesto_prof[0]['trabajador_uuid'] ?? null;
        if ($profesional_id) {
            $usuario_prof = supabaseRequest("GET", "usuarios?id=eq.$profesional_id");
            if (is_array($usuario_prof) && count($usuario_prof) > 0) {
                $celular = trim($usuario_prof[0]['celular'] ?? '');
                if (!empty($celular)) {
                    $celular_limpio = preg_replace('/\D/', '', $celular);
                    $wa_prof = (substr($celular_limpio, 0, 2) === '54') ? "whatsapp:+$celular_limpio" : "whatsapp:+54$celular_limpio";
                    $mensaje_prof = "✅ *¡Tu presupuesto fue aceptado y pagado!*\n\n" .
                                    "Revisá la app para ver los detalles del servicio o espera a que el cliente se contacte con vos por privado (tu numero de celular se le compartio al cliente) y al finalizar presioná *\"Finalizar\"* en la app.";
                    enviarWhatsApp($wa_prof, $mensaje_prof);
                    file_put_contents("debug.txt", "[WEBHOOK_PAGO] ✅ Mensaje enviado al profesional $wa_prof\n", FILE_APPEND);
                }
            }
        }
    }
}

http_response_code(200);
exit;