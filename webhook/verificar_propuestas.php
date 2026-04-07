<?php
/**
 * CRON JOB - Verificar propuestas pendientes
 *
 * Ejecutar cada 1-2 minutos via cron:
 *   * * * * * php /ruta/absoluta/verificar_propuestas.php
 *
 * FLUJO:
 *   paso=4  → Esperando propuestas (30 min máx)
 *              Si hay 3+ propuestas → envía top 3, paso=99
 *              Si pasa timeout sin propuestas → avisa "seguimos buscando", paso=98
 *   paso=98 → Segunda espera (15 min máx)
 *              Si llegan propuestas → envía top 3, paso=99
 *              Si pasa timeout sin propuestas → CANCELA oferta, avisa al cliente
 */

require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';

// ═══════════════════════════════════════════════════════════
//  SISTEMA DE LOGS
// ═══════════════════════════════════════════════════════════
$logFile = __DIR__ . '/cron_log.txt';

function log_msg(string $nivel, string $msg): void {
    global $logFile;
    $ts    = date('Y-m-d H:i:s');
    $icono = match($nivel) {
        'OK'    => '✅',
        'ERROR' => '❌',
        'WARN'  => '⚠️ ',
        'INFO'  => '📋',
        'SEND'  => '📤',
        default => '   ',
    };
    file_put_contents($logFile, "[$ts] $icono [$nivel] $msg\n", FILE_APPEND | LOCK_EX);
}

function log_separador(string $titulo = ''): void {
    global $logFile;
    $linea = $titulo
        ? "\n" . str_repeat('─', 60) . "\n  $titulo\n" . str_repeat('─', 60) . "\n"
        : "\n" . str_repeat('─', 60) . "\n";
    file_put_contents($logFile, $linea, FILE_APPEND | LOCK_EX);
}

// ═══════════════════════════════════════════════════════════
//  HEARTBEAT
// ═══════════════════════════════════════════════════════════
$heartbeatFile = __DIR__ . '/cron_heartbeat.json';
$pid = function_exists('getmypid') ? getmypid() : null;

$hb = [
    'last_start' => time(),
    'last_end'   => null,
    'pid'        => $pid,
    'status'     => 'running',
    'script'     => basename(__FILE__),
    'started_at' => date('c'),
];
file_put_contents($heartbeatFile, json_encode($hb, JSON_PRETTY_PRINT), LOCK_EX);

register_shutdown_function(function() use ($heartbeatFile, $pid) {
    $content = @file_get_contents($heartbeatFile);
    $obj = $content ? (json_decode($content, true) ?: []) : [];
    $obj['last_end']  = time();
    $obj['status']    = 'completed';
    $obj['ended_at']  = date('c');
    $obj['pid_end']   = $pid;
    file_put_contents($heartbeatFile, json_encode($obj, JSON_PRETTY_PRINT), LOCK_EX);
});

log_separador('INICIO DE EJECUCIÓN');
log_msg('INFO', "PID=$pid | PROPOSAL_TIMEOUT=" . (defined('PROPOSAL_TIMEOUT') ? PROPOSAL_TIMEOUT : 'no definido'));

// Timeouts
$timeout_paso4  = defined('PROPOSAL_TIMEOUT') ? PROPOSAL_TIMEOUT : 1800; // 30 min
$timeout_paso98 = 900; // 15 min segunda espera

// ═══════════════════════════════════════════════════════════
//  FUNCIÓN: Enviar top 3 presupuestos al cliente
// ═══════════════════════════════════════════════════════════
function enviarTop3(string $ofertaId, string $telefono, array $presupuestos): bool {
    $toSend = array_slice($presupuestos, 0, 3);
    $mensaje = "🎉 ¡Ya tenemos propuestas para ti!\n\n🎯 Aquí están las mejores opciones:\n\n";

    $i = 1;
    foreach ($toSend as $p) {
        if (!is_array($p)) continue;

        $monto       = (float)($p['monto'] ?? 0);
        $horarios    = trim($p['horarios_disponibles'] ?? '');
        $descripcion = trim($p['descripcion'] ?? '');

        $trabajador_uuid = $p['trabajador_uuid'] ?? ($p['trabajador_id'] ?? null);
        $nombre_trab = '';
        $perfil_link = '';

        if (!empty($trabajador_uuid)) {
            $usuario = supabaseRequest("GET", "usuarios?id=eq.$trabajador_uuid&select=nombre,apellido,id");
            if (is_array($usuario) && count($usuario) > 0) {
                $u = $usuario[0];
                $nombre_trab = trim(($u['nombre'] ?? '') . ' ' . ($u['apellido'] ?? ''));
                $perfil_id   = $u['id'] ?? $trabajador_uuid;
                $perfil_link = 'https://tooriserviciosya.com/PerfileProfesionales.php?ids=' . urlencode($perfil_id);
            }
        }

        $mensaje .= $i . '️⃣ *Opción ' . $i . "*\n";
        if (!empty($nombre_trab)) $mensaje .= "   👷 Profesional: $nombre_trab\n";
        if (!empty($perfil_link)) $mensaje .= "   🔗 Perfil: $perfil_link\n";
        $mensaje .= "   💵 Monto: \$" . number_format($monto, 0, ',', '.') . "\n";
        if (!empty($horarios))    $mensaje .= "   🕐 Horarios: $horarios\n";
        if (!empty($descripcion)) $mensaje .= "   📝 Detalles: $descripcion\n";
        $mensaje .= "\n";
        $i++;
    }
    $mensaje .= "Respondé con *1*, *2* o *3* para elegir tu opción preferida.";

    $enviado = false;
    try {
        $enviado = enviarWhatsApp($telefono, $mensaje);
    } catch (Exception $e) {
        log_msg('ERROR', "  Oferta $ofertaId — Excepción al enviar: " . $e->getMessage());
    }

    if ($enviado) {
        supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", ["paso" => 99]);
        log_msg('OK', "  Oferta $ofertaId — Propuestas enviadas. Paso → 99");
    } else {
        log_msg('ERROR', "  Oferta $ofertaId — Falló el envío de propuestas");
    }

    return $enviado;
}

// ═══════════════════════════════════════════════════════════
//  SECCIÓN 1 — Ofertas en paso=4 (primera espera, 30 min)
// ═══════════════════════════════════════════════════════════
log_separador('SECCIÓN 1: Ofertas paso=4 (primera espera)');

$ofertas_paso4 = supabaseRequest(
    "GET",
    "nuevaOferta?paso=eq.4&estado=eq.completa&order=created_at.asc"
);

if (!is_array($ofertas_paso4) || count($ofertas_paso4) === 0) {
    log_msg('INFO', "No hay ofertas en paso 4.");
} else {
    log_msg('INFO', "Ofertas en paso 4: " . count($ofertas_paso4));

    foreach ($ofertas_paso4 as $oferta) {
        $ofertaId = $oferta['id'];
        $telefono = $oferta['cliente_telefono'] ?? '';

        log_msg('INFO', "─── Oferta ID=$ofertaId | Tel=$telefono");

        $presupuestos = supabaseRequest("GET",
            "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc&limit=3"
        );
        if (!is_array($presupuestos)) $presupuestos = [];
        $cantidad = count($presupuestos);

        // Calcular tiempo desde publicación
        $creada = $oferta['created_at'] ?? null;
        $segundos = $creada ? (time() - strtotime($creada)) : 0;
        $horaLimite = ($segundos >= $timeout_paso4);

        log_msg('INFO', "  Presupuestos: $cantidad | Segundos: $segundos | Timeout: " . ($horaLimite ? 'SÍ' : 'NO'));

        // Si hay 3+ presupuestos → enviar
        if ($cantidad >= 3) {
            enviarTop3($ofertaId, $telefono, $presupuestos);
            continue;
        }

        // Si pasó el timeout
        if ($horaLimite) {
            if ($cantidad > 0) {
                // Hay algunos presupuestos → enviar los que haya
                log_msg('INFO', "  Timeout con $cantidad presupuestos → enviando los que hay");
                enviarTop3($ofertaId, $telefono, $presupuestos);
            } else {
                // Sin presupuestos → avisar y pasar a paso 98 (segunda espera)
                log_msg('WARN', "  Sin presupuestos tras 30 min → paso 98");
                if (!empty($telefono)) {
                    $msgSinProp = "😕 Por ahora no recibimos propuestas de profesionales para tu solicitud.\n\n" .
                                  "Vamos a seguir buscando 15 minutos más. Si no encontramos, te avisamos.\n\n" .
                                  "Si querés cancelar, escribí *eliminar*.";
                    $enviado = enviarWhatsApp($telefono, $msgSinProp);
                    if ($enviado) {
                        supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", [
                            "paso"       => 98,
                            "created_at" => date('Y-m-d H:i:s'), // Reset timer para los 15 min
                        ]);
                        log_msg('OK', "  Oferta $ofertaId → Paso 98 (segunda espera, created_at reseteado)");
                    }
                }
            }
        } else {
            log_msg('INFO', "  Esperando más presupuestos. Skipping.");
        }
    }
}

// ═══════════════════════════════════════════════════════════
//  SECCIÓN 2 — Ofertas en paso=98 (segunda espera, 15 min)
// ═══════════════════════════════════════════════════════════
log_separador('SECCIÓN 2: Ofertas paso=98 (segunda espera)');

$ofertas_paso98 = supabaseRequest(
    "GET",
    "nuevaOferta?paso=eq.98&estado=eq.completa&order=created_at.asc"
);

if (!is_array($ofertas_paso98) || count($ofertas_paso98) === 0) {
    log_msg('INFO', "No hay ofertas en paso 98.");
} else {
    log_msg('INFO', "Ofertas en paso 98: " . count($ofertas_paso98));

    foreach ($ofertas_paso98 as $oferta) {
        $ofertaId = $oferta['id'];
        $telefono = $oferta['cliente_telefono'] ?? '';

        log_msg('INFO', "─── Oferta ID=$ofertaId | Tel=$telefono");

        $presupuestos = supabaseRequest("GET",
            "presupuestos?oferta_id=eq.$ofertaId&order=created_at.asc&limit=3"
        );
        if (!is_array($presupuestos)) $presupuestos = [];
        $cantidad = count($presupuestos);

        $creada = $oferta['created_at'] ?? null;
        $segundos = $creada ? (time() - strtotime($creada)) : 0;
        $horaLimite = ($segundos >= $timeout_paso98);

        log_msg('INFO', "  Presupuestos: $cantidad | Segundos: $segundos | Timeout 15min: " . ($horaLimite ? 'SÍ' : 'NO'));

        // Si llegaron presupuestos durante la segunda espera → enviar
        if ($cantidad > 0) {
            log_msg('OK', "  Llegaron $cantidad presupuestos en segunda espera → enviando");
            enviarTop3($ofertaId, $telefono, $presupuestos);
            continue;
        }

        // Si pasó el timeout de 15 min sin propuestas → CANCELAR
        if ($horaLimite) {
            log_msg('WARN', "  Sin presupuestos tras segunda espera → CANCELANDO oferta");

            if (!empty($telefono)) {
                $msgCancel = "😔 Lamentablemente no encontramos profesionales disponibles para tu solicitud en este momento.\n\n" .
                             "Podés intentar de nuevo en cualquier momento, solo escribime *Hola* y arrancamos. " .
                             "¡Disculpá las molestias y gracias por tu paciencia! 🙏";
                enviarWhatsApp($telefono, $msgCancel);
            }

            // Cancelar la oferta
            supabaseRequest("PATCH", "nuevaOferta?id=eq.$ofertaId", [
                "estado" => "cancelada",
                "paso"   => 0,
            ]);
            log_msg('OK', "  Oferta $ofertaId CANCELADA. Cliente notificado.");
        } else {
            log_msg('INFO', "  Esperando en segunda ronda. Skipping.");
        }
    }
}

// ═══════════════════════════════════════════════════════════
//  SECCIÓN 3 — Notificar usuarios con perfil incompleto
// ═══════════════════════════════════════════════════════════
log_separador('SECCIÓN 3: Notificación de perfiles incompletos');

$since    = '2026-03-14 00:08:41.427845';
$sinceT   = str_replace(' ', 'T', $since);
$sinceEnc = rawurlencode($sinceT);

log_msg('INFO', "Buscando usuarios registrados desde: $sinceT");

$usuarios  = [];
$pageSize  = 100;
$offset    = 0;

do {
    $pagina = supabaseRequest(
        "GET",
        "usuarios?select=id,celular,nombre,creado_en,notificado_at"
        . "&creado_en=gte.$sinceEnc"
        . "&order=creado_en.asc"
        . "&limit=$pageSize"
        . "&offset=$offset"
    );

    if (!is_array($pagina)) {
        log_msg('ERROR', "Falló la consulta en offset=$offset");
        break;
    }

    $pagina = array_values(array_filter($pagina, function($u) {
        return empty($u['notificado_at']);
    }));

    $usuarios = array_merge($usuarios, $pagina);
    log_msg('INFO', "  Página offset=$offset → " . count($pagina) . " usuarios sin notificar");
    $offset += $pageSize;
} while (count($pagina) === $pageSize);

if (!is_array($usuarios)) $usuarios = [];

$totalUsuarios = count($usuarios);
log_msg('INFO', "Usuarios pendientes de notificación: $totalUsuarios");

if ($totalUsuarios === 0) {
    log_msg('INFO', "Ningún usuario nuevo para notificar.");
} else {
    $enviados = 0;
    $fallidos = 0;
    $saltados = 0;
    $seen     = [];

    foreach ($usuarios as $u) {
        $cel = trim($u['celular'] ?? '');
        $nom = trim($u['nombre']  ?? '');
        $uid = $u['id'] ?? null;

        if ($cel === '') { $saltados++; continue; }
        if (isset($seen[$cel])) { $saltados++; continue; }
        $seen[$cel] = true;

        $namePart = $nom ? "Hola $nom,\n\n" : "Hola,\n\n";
        $msg = $namePart
             . "Detectamos que tu perfil en Toori ServiciosYa tiene datos incompletos. "
             . "Por favor ingresá a https://tooriserviciosya.com/ e iniciá sesión: "
             . "verás los campos pendientes para completar.\n\n"
             . "Este es un mensaje de alerta generado por nuestro agente IA.";

        $sent = false;
        try {
            $sent = enviarWhatsApp($cel, $msg);
        } catch (Exception $e) {
            log_msg('ERROR', "  Celular=$cel | Excepción: " . $e->getMessage());
        }

        if ($sent) {
            $enviados++;
            log_msg('SEND', "  OK — Celular=$cel");
            if ($uid) {
                supabaseRequest("PATCH", "usuarios?id=eq.$uid", [
                    "notificado_at" => date('c')
                ]);
            }
        } else {
            $fallidos++;
            log_msg('ERROR', "  FALLÓ — Celular=$cel");
        }

        usleep(300000);
    }

    log_msg('INFO', "Resumen: Enviados=$enviados | Fallidos=$fallidos | Saltados=$saltados");
}

// ═══════════════════════════════════════════════════════════
//  FIN
// ═══════════════════════════════════════════════════════════
log_separador('FIN DE EJECUCIÓN');
log_msg('INFO', "Script terminado correctamente.\n");