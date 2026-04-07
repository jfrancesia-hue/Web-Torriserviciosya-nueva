<?php
/**
 * CRON JOB - Verificar propuestas pendientes
 * 
 * Este script debe ejecutarse cada 1-2 minutos via cron:
 * * * * * * php /path/to/verificar_propuestas.php
 * 
 * Busca ofertas en estado "completa" con paso=4 que ya tengan 3+ presupuestos
 * y envía automáticamente las opciones al cliente.
 */

require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';

// HEARTBEAT: escribir inicio en archivo específico para comprobar que el cron se ejecuta
$heartbeatFile = __DIR__ . '/debug_cron_heartbeat.json';
$hb = [
    'last_start' => time(),
    'last_end' => null,
    'pid' => (function_exists('getmypid') ? getmypid() : null),
    'status' => 'running',
    'script' => basename(__FILE__)
];
file_put_contents($heartbeatFile, json_encode($hb), LOCK_EX);
file_put_contents("debug_cron.txt", "[CRON HEARTBEAT] START " . date('c') . " pid=" . ($hb['pid'] ?? 'unknown') . "\n", FILE_APPEND);

register_shutdown_function(function() use ($heartbeatFile) {
    $content = @file_get_contents($heartbeatFile);
    $obj = [];
    if ($content) {
        $obj = json_decode($content, true) ?: [];
    }
    $obj['last_end'] = time();
    $obj['status'] = 'completed';
    $obj['ended_at'] = date('c');
    $obj['pid_end'] = (function_exists('getmypid') ? getmypid() : null);
    file_put_contents($heartbeatFile, json_encode($obj), LOCK_EX);
    file_put_contents("debug_cron.txt", "[CRON HEARTBEAT] END " . date('c') . " pid=" . ($obj['pid_end'] ?? 'unknown') . "\n", FILE_APPEND);
});

file_put_contents("debug_cron.txt", "[CRON] " . date('Y-m-d H:i:s') . " - Iniciando verificación\n", FILE_APPEND);
file_put_contents("debug_cron.txt", "[CRON] Proposal timeout (seconds): " . (defined('PROPOSAL_TIMEOUT') ? PROPOSAL_TIMEOUT : 'undefined') . "\n", FILE_APPEND);

// Buscar ofertas que están esperando propuestas (paso=4, estado=completa)
$ofertas = supabaseRequest(
    "GET",
    "nuevaOferta?paso=eq.4&estado=eq.completa&order=created_at.asc"
);

if (!is_array($ofertas) || count($ofertas) === 0) {
    file_put_contents("debug_cron.txt", "[CRON] No hay ofertas esperando propuestas\n", FILE_APPEND);
    exit;
}

file_put_contents("debug_cron.txt", "[CRON] Ofertas encontradas: " . count($ofertas) . "\n", FILE_APPEND);

foreach ($ofertas as $oferta) {
    $ofertaId = $oferta['id'];
    $telefono = $oferta['cliente_telefono'];
    
    // Verificar cuántos presupuestos tiene esta oferta (pedimos hasta 3)
    $presupuestos = supabaseRequest(
        "GET",
        "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc&limit=3"
    );
    if (!is_array($presupuestos)) {
        $presupuestos = [];
    }

    $cantidadPresupuestos = count($presupuestos);

    // Calcular si pasó más del timeout desde la creación de la oferta
    $creada = $oferta['created_at'] ?? null;
    $horaLimite = false;
    if ($creada) {
        $creada_ts = strtotime($creada);
        $ahora_ts = time();
        $timeout = defined('PROPOSAL_TIMEOUT') ? PROPOSAL_TIMEOUT : 3600;
        if ($ahora_ts - $creada_ts >= $timeout) {
            $horaLimite = true;
        }
    }

    file_put_contents("debug_cron.txt", "[CRON] Oferta $ofertaId creada=$creada | tiene $cantidadPresupuestos presupuestos | horaLimite=" . ($horaLimite ? 'SI' : 'NO') . "\n", FILE_APPEND);

    // Si hora límite está activa, registrar cuánto tiempo pasó exactamente
    if ($creada) {
        $segundos_pasados = time() - strtotime($creada);
        file_put_contents("debug_cron.txt", "[CRON] Oferta $ofertaId segundos_pasados=$segundos_pasados\n", FILE_APPEND);
    }

    // Si no tenemos 3 presupuestos pero ya pasó la hora límite, pedir todos los presupuestos disponibles
    if ($cantidadPresupuestos < 3 && $horaLimite) {
        $presupuestos = supabaseRequest(
            "GET",
            "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc"
        );
        if (!is_array($presupuestos)) {
            $presupuestos = [];
        }
        $cantidadPresupuestos = count($presupuestos);
        file_put_contents("debug_cron.txt", "[CRON] Después de ampliar, oferta $ofertaId tiene $cantidadPresupuestos presupuestos\n", FILE_APPEND);
    }

    // Enviar si tenemos al menos 3 presupuestos, o si pasó la hora límite (aunque haya <3)
    if ($cantidadPresupuestos >= 3 || $horaLimite) {
        if ($cantidadPresupuestos === 0) {
    file_put_contents("debug_cron.txt", "[CRON] ⚠️ Oferta $ofertaId - No se recibieron propuestas en 1 hora\n", FILE_APPEND);
    if (!empty($telefono)) {
        $enviado = enviarWhatsApp($telefono, "No se recibieron propuestas por ahora, vamos a seguir buscando y en 15 min te volvemos a avisar si no encontramos.");
        if ($enviado) {
            // Cambiar paso para que el cron no vuelva a procesarla
            supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", [
                "paso" => 98
            ]);
            file_put_contents("debug_cron.txt", "[CRON] Oferta $ofertaId - paso actualizado a 98 (sin propuestas)\n", FILE_APPEND);
        }
    }
    continue;
}

        file_put_contents("debug_cron.txt", "[CRON] ✅ Oferta $ofertaId - Enviando propuestas al cliente\n", FILE_APPEND);

        // Enviamos hasta 3 opciones (si hay más, tomar las primeras 3)
        $toSend = array_slice($presupuestos, 0, 3);

        // Armar mensaje con los presupuestos
        $mensaje_top3 = "🎉 ¡Ya tenemos propuestas para ti!\n\n🎯 Aquí están las mejores opciones:\n\n";

        $i = 1;
        foreach ($toSend as $p) {
            if (!is_array($p)) continue;

            $monto = (float)($p['monto'] ?? 0);
            $horarios = trim($p['horarios_disponibles'] ?? '');
            $descripcion = trim($p['descripcion'] ?? '');

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

            $mensaje_top3 .= $i . '️⃣ *Opción ' . $i . "*\n";
            if (!empty($nombre_trab)) {
                $mensaje_top3 .= "   👷 Profesional: $nombre_trab\n";
            }
            if (!empty($perfil_link)) {
                $mensaje_top3 .= "   🔗 Perfil: $perfil_link\n";
            }
            $mensaje_top3 .= "   💵 Monto: \$" . number_format($monto, 2) . "\n";
            if (!empty($horarios)) {
                $mensaje_top3 .= "   🕐 Horarios: $horarios\n";
            }
            if (!empty($descripcion)) {
                $mensaje_top3 .= "   📝 Detalles: $descripcion\n";
            }
            $mensaje_top3 .= "\n";
            $i++;
        }

        $mensaje_top3 .= "Responde con 1, 2 o 3 para elegir tu opción preferida.";

        // Enviar mensaje
        $enviado = enviarWhatsApp($telefono, $mensaje_top3);

        file_put_contents("debug_cron.txt", "[CRON] Oferta $ofertaId - enviarWhatsApp returned: " . ($enviado ? 'true' : 'false') . "\n", FILE_APPEND);

        if ($enviado) {
            // Actualizar a paso 99 (esperando selección)
            supabaseRequest(
                "PATCH",
                "nuevaOferta?id=eq.$ofertaId",
                [
                    "paso" => 99
                ]
            );

            file_put_contents("debug_cron.txt", "[CRON] ✅ Oferta $ofertaId - Mensaje enviado y paso actualizado a 99\n", FILE_APPEND);
        } else {
            file_put_contents("debug_cron.txt", "[CRON] ❌ Oferta $ofertaId - Error al enviar mensaje\n", FILE_APPEND);
        }
    }
}

file_put_contents("debug_cron.txt", "[CRON] " . date('Y-m-d H:i:s') . " - Verificación completada\n", FILE_APPEND);

// ─────────────────────────────────────────────
// Exportar usuarios recientes (lista simple celular | nombre)
// ─────────────────────────────────────────────
$since = '2026-03-14 00:08:41.427845';
$sinceEnc = urlencode($since);
$outFile = __DIR__ . '/usuarios_nuevos_desde_2026-03-14.txt';

file_put_contents("debug_cron.txt", "[CRON] Exportando usuarios creados desde $since\n", FILE_APPEND);

$usuarios = supabaseRequest("GET", "usuarios?select=celular,nombre&created_at=gte.$sinceEnc");
if (is_array($usuarios) && count($usuarios) > 0) {
    $lines = [];
    $lines[] = "Usuarios creados desde $since";
    $lines[] = "Cantidad: " . count($usuarios);
    $lines[] = "";
    foreach ($usuarios as $u) {
        $cel = trim($u['celular'] ?? '');
        $nom = trim($u['nombre'] ?? '');
        $lines[] = $cel . ' | ' . $nom;
    }
    file_put_contents($outFile, implode("\n", $lines) . "\n", LOCK_EX);
    file_put_contents("debug_cron.txt", "[CRON] Exportado " . count($usuarios) . " usuarios a " . basename($outFile) . "\n", FILE_APPEND);
} else {
    file_put_contents($outFile, "Usuarios creados desde $since\nCantidad: 0\n", LOCK_EX);
    file_put_contents("debug_cron.txt", "[CRON] No se encontraron usuarios recientes. Archivo creado vacío: " . basename($outFile) . "\n", FILE_APPEND);
}
