<?php

require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';

$oferta_id = $_GET['oferta_id'] ?? null;

if (!$oferta_id) {
    http_response_code(400);
    exit;
}

// 1️⃣ Obtener oferta
$ofertas = supabaseRequest("GET", "nuevaOferta?id=eq.$oferta_id&select=*,created_at");
if (!$ofertas || count($ofertas) === 0) {
    http_response_code(404);
    exit;
}

$oferta = $ofertas[0];
$telefono = $oferta['cliente_telefono'] ?? null;
$creada = $oferta['created_at'] ?? null;

file_put_contents("debug_cron.txt", "[ENVIAR_TOP3] oferta_id=$oferta_id created_at=" . ($creada ?? 'NULL') . "\n", FILE_APPEND);

if (!$telefono) {
    http_response_code(400);
    exit;
}

// 2️⃣ Obtener top 3 presupuestos
$presupuestos = supabaseRequest(
    "GET",
    "presupuestos?oferta_id=eq.$oferta_id&estado=eq.activo&order=created_at.asc&limit=3"
);

// Calcular si pasó más del timeout desde la creación de la oferta
$horaLimite = false;
if ($creada) {
    $creada_ts = strtotime($creada);
    $ahora_ts = time();
    $timeout = defined('PROPOSAL_TIMEOUT') ? PROPOSAL_TIMEOUT : 3600;
    if ($ahora_ts - $creada_ts >= $timeout) {
        $horaLimite = true;
    }
    file_put_contents("debug_cron.txt", "[ENVIAR_TOP3] oferta_id=$oferta_id segundos_pasados=" . ($ahora_ts - $creada_ts) . " timeout=$timeout horaLimite=" . ($horaLimite ? 'SI' : 'NO') . "\n", FILE_APPEND);
}

if ((!$presupuestos || count($presupuestos) === 0) && !$horaLimite) {
    enviarWhatsApp($telefono, "Aún no hay propuestas disponibles. Te avisaremos cuando lleguen. ⏳");
    exit;
}
// Si pasó la hora, buscar todos los presupuestos disponibles aunque sean menos de 3
if ($horaLimite && (!$presupuestos || count($presupuestos) < 3)) {
    $presupuestos = supabaseRequest(
        "GET",
        "presupuestos?oferta_id=eq.$oferta_id&estado=eq.activo&order=created_at.asc"
    );
}
if (!$presupuestos || count($presupuestos) === 0) {
    enviarWhatsApp($telefono, "No se recibieron propuestas por ahora, vamos a seguir buscando y en 15 min te volvemos a avisar si no encontramos.");
    exit;
}

// 3️⃣ Armar mensaje
$mensaje = "🎯 Aquí están las 3 mejores propuestas:\n\n";

    $i = 1;
    foreach ($presupuestos as $p) {
        $monto = (float)($p['monto'] ?? 0);
        $tiempo = intval($p['tiempo_entrega'] ?? 0);

        // Obtener info del trabajador
        $trabajador_uuid = $p['trabajador_uuid'] ?? ($p['trabajador_id'] ?? null);
        $nombre_trab = '';
        $perfil_link = '';
        if (!empty($trabajador_uuid)) {
            $usuario = supabaseRequest("GET", "usuarios?id=eq.$trabajador_uuid&select=nombre,apellido,id");
            if (is_array($usuario) && count($usuario) > 0) {
                $u = $usuario[0];
                $nombre_trab = trim(($u['nombre'] ?? '') . ' ' . ($u['apellido'] ?? ''));
                $perfil_id = $u['id'] ?? $trabajador_uuid;
                $perfil_link = 'https://tooriserviciosya.com/PerfileProfesionales.php?ids=' . urlencode($perfil_id);
            }
        }

        $mensaje .= $i . '️⃣ - ';
        if (!empty($nombre_trab)) {
            $mensaje .= "$nombre_trab \n";
        }
        if (!empty($perfil_link)) {
            $mensaje .= "   🔗 Perfil: $perfil_link\n";
        }
        $mensaje .= "   \$" . number_format($monto, 2);
        if ($tiempo > 0) {
            $mensaje .= " | Entrega: $tiempo días";
        }
        $mensaje .= "\n";
        $i++;
    }

$mensaje .= "\nResponde 1, 2 o 3 para elegir.";

// 4️⃣ Enviar por WhatsApp
$sent = enviarWhatsApp($telefono, $mensaje);
file_put_contents("debug_cron.txt", "[ENVIAR_TOP3] oferta_id=$oferta_id enviarWhatsApp returned: " . ($sent ? 'true' : 'false') . " | opciones_enviadas=" . count($presupuestos) . "\n", FILE_APPEND);

// 5️⃣ Guardar que espera elección (solo si se envió)
if ($sent) {
    supabaseRequest("PATCH", "nuevaOferta?id=eq.$oferta_id", [
        "paso" => 99
    ]);
    file_put_contents("debug_cron.txt", "[ENVIAR_TOP3] oferta_id=$oferta_id paso actualizado a 99\n", FILE_APPEND);
} else {
    file_put_contents("debug_cron.txt", "[ENVIAR_TOP3] oferta_id=$oferta_id fallo al enviar, no se actualiza paso\n", FILE_APPEND);
}

http_response_code(200);
exit;