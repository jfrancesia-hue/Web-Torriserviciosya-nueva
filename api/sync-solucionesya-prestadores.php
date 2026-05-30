<?php
require_once __DIR__ . '/../webhook/db.php';

header('Content-Type: application/json; charset=utf-8');

function fail_sync($status, $message, $extra = []) {
    http_response_code($status);
    echo json_encode(array_merge([
        'ok' => false,
        'error' => $message
    ], $extra), JSON_UNESCAPED_UNICODE);
    exit;
}

$syncBaseUrl = env('SOLUCIONESYA_SYNC_BASE_URL');
$syncUrl = env('SOLUCIONESYA_PRESTADORES_SYNC_URL') ?: env('SOLUCIONESYA_SYNC_URL') ?: ($syncBaseUrl ? rtrim($syncBaseUrl, '/') . '/api/marketplace/proveedores' : null);
$syncToken = env('SOLUCIONESYA_SYNC_TOKEN');
$tenantId = env('SOLUCIONESYA_TENANT_ID');

if (!$syncUrl || !$syncToken || !$tenantId) {
    fail_sync(500, 'Faltan SOLUCIONESYA_PRESTADORES_SYNC_URL o SOLUCIONESYA_SYNC_BASE_URL, SOLUCIONESYA_SYNC_TOKEN y SOLUCIONESYA_TENANT_ID en webhook/.env');
}

$prestadores = supabaseRequest(
    'GET',
    'sy_perfiles?rol=eq.prestador&select=id,nombre,telefono,oficios,verificado,zona_frecuente&order=nombre.asc&limit=500'
);

if (!is_array($prestadores)) {
    fail_sync(500, 'No se pudieron leer prestadores desde Supabase');
}

$payloadPrestadores = array_values(array_filter(array_map(function ($p) {
    $nombre = trim($p['nombre'] ?? '');
    if ($nombre === '') return null;

    $oficios = $p['oficios'] ?? [];
    if (!is_array($oficios)) {
        $oficios = $oficios ? [$oficios] : [];
    }

    return [
        'marketplaceId' => (string)($p['id'] ?? ''),
        'nombre' => $nombre,
        'rubros' => array_values(array_filter(array_map('trim', $oficios))),
        'telefono' => $p['telefono'] ?? null,
        'email' => null,
        'cuit' => null,
        'calificacion' => null
    ];
}, $prestadores)));

if (count($payloadPrestadores) === 0) {
    echo json_encode([
        'ok' => true,
        'message' => 'No hay prestadores para sincronizar',
        'enviados' => 0
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$payload = [
    'tenantId' => $tenantId,
    'proveedores' => $payloadPrestadores
];

$ch = curl_init($syncUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $syncToken,
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload, JSON_UNESCAPED_UNICODE));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($curlError) {
    fail_sync(502, 'Error conectando con SolucionesYa', ['detail' => $curlError]);
}

$decoded = json_decode($response ?: '', true);
if ($httpCode >= 400) {
    fail_sync($httpCode, 'SolucionesYa rechazo la sincronizacion', ['response' => $decoded ?: $response]);
}

echo json_encode([
    'ok' => true,
    'enviados' => count($payloadPrestadores),
    'solucionesYa' => $decoded
], JSON_UNESCAPED_UNICODE);
