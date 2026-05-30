<?php
require_once __DIR__ . '/../webhook/config.php';

header('Content-Type: application/json; charset=utf-8');

$cronToken = env('SOLUCIONESYA_CRON_TOKEN') ?: env('SOLUCIONESYA_SYNC_TOKEN');
$receivedToken = $_GET['token'] ?? ($_SERVER['HTTP_X_SYNC_TOKEN'] ?? '');

if ($cronToken && !hash_equals($cronToken, $receivedToken)) {
    http_response_code(401);
    echo json_encode(['ok' => false, 'error' => 'No autorizado'], JSON_UNESCAPED_UNICODE);
    exit;
}

function run_sync_script($path) {
    ob_start();
    include $path;
    $raw = ob_get_clean();
    $decoded = json_decode($raw, true);
    return $decoded ?: ['ok' => false, 'raw' => $raw];
}

$prestadores = run_sync_script(__DIR__ . '/sync-solucionesya-prestadores.php');
$pedidos = run_sync_script(__DIR__ . '/sync-solucionesya-pedidos.php');

$ok = !empty($prestadores['ok']) && !empty($pedidos['ok']);
http_response_code($ok ? 200 : 502);

echo json_encode([
    'ok' => $ok,
    'prestadores' => $prestadores,
    'pedidos' => $pedidos
], JSON_UNESCAPED_UNICODE);
