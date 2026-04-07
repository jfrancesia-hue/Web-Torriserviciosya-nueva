<?php
/**
 * CRON JOB - Verificar perfiles de trabajadores y pedir completar categoría
 *
 * Filtro usado:
 * FROM usuarios
 * WHERE rol = 'worker'
 *   AND celular IS NOT NULL
 *   AND nombre IS NOT NULL
 *   AND creado_en > '2025-10-31'
 *   AND perfil_completo = true
 */

require_once 'config.php';
require_once 'db.php';
require_once 'whatsapp.php';

file_put_contents("debug_cron.txt", "[CHECK_PROFILES] " . date('c') . " - Iniciando verificación de perfiles\n", FILE_APPEND);

// Consulta a supabase para obtener usuarios que coincidan con los filtros
$query = "usuarios?rol=eq.worker&celular=is.not.null&nombre=is.not.null&creado_en=gt.2025-10-31&perfil_completo=eq.true&select=id,nombre,apellido,celular,categoria";
$users = supabaseRequest("GET", $query);
if (!is_array($users)) {
    $users = [];
}

file_put_contents("debug_cron.txt", "[CHECK_PROFILES] Usuarios encontrados: " . count($users) . "\n", FILE_APPEND);

$sentCount = 0;
$usersWithoutCategory = 0;

foreach ($users as $u) {
    // TEMPORAL - borrar después
    file_put_contents("debug_cron.txt", "[DEBUG] categoria raw: " . json_encode($u['categoria'] ?? 'KEY_NO_EXISTE') . "\n", FILE_APPEND);
    break; // solo el primero
    $userId = $u['id'] ?? null;
    $nombre = trim(($u['nombre'] ?? '') . ' ' . ($u['apellido'] ?? ''));
    $celularRaw = trim($u['celular'] ?? '');
    $categoria = $u['categoria'] ?? null;

// Detectar categoria vacía: null, [], [null], o array con solo nulls
$sinCategoria = empty($categoria) || 
                (is_array($categoria) && count(array_filter($categoria, fn($v) => $v !== null)) === 0);

if ($sinCategoria) {
        $usersWithoutCategory++;
        // Normalizar celular
        $cel = preg_replace('/\D/', '', $celularRaw);
        if (empty($cel)) {
            file_put_contents("debug_cron.txt", "[CHECK_PROFILES] SKIP user=$userId - celular inválido\n", FILE_APPEND);
            continue;
        }

        // Formato WhatsApp
        if (substr($cel, 0, 2) === '54') {
            $celWA = 'whatsapp:+' . $cel;
        } else {
            $celWA = 'whatsapp:+54' . $cel;
        }

        $mensaje = "Hola " . ($nombre ?: '¡aquí!') . ",\n\n" .
                   "Notamos que tu perfil aún no tiene la categoría completada. Completá tu perfil para recibir más solicitudes y mejorar tus oportunidades en la plataforma.\n\n" .
                   "Actualizá tu perfil aquí: https://tooriserviciosya.com/editarPerfil.php\n\n" .
                   "Gracias!";

        $sent = enviarWhatsApp($celWA, $mensaje);
        if ($sent) {
            $sentCount++;
        }
        file_put_contents("debug_cron.txt", "[CHECK_PROFILES] user=" . ($userId ?? 'unknown') . " nombre=" . ($nombre ?: 'unknown') . " enviado=" . ($sent ? 'true' : 'false') . "\n", FILE_APPEND);
    }
}

file_put_contents("debug_cron.txt", "[CHECK_PROFILES] Mensajes intentados: " . $usersWithoutCategory . " | Mensajes enviados: " . $sentCount . "\n", FILE_APPEND);
// También actualizar el heartbeat JSON para facilitar comprobaciones externas
$heartbeatFile = __DIR__ . '/debug_cron_heartbeat.json';
$hb = [];
$hbContent = @file_get_contents($heartbeatFile);
if ($hbContent) {
    $hb = json_decode($hbContent, true) ?: [];
}
$hb['profiles_last_attempts'] = $usersWithoutCategory;
$hb['profiles_last_sent'] = $sentCount;
$hb['profiles_last_run'] = time();
$hb['profiles_last_run_iso'] = date('c');
$hb['profiles_status'] = 'completed';
file_put_contents($heartbeatFile, json_encode($hb), LOCK_EX);

file_put_contents("debug_cron.txt", "[CHECK_PROFILES] " . date('c') . " - Finalizado\n", FILE_APPEND);

http_response_code(200);
exit;
