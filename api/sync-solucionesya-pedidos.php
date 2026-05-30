<?php
require_once __DIR__ . '/../webhook/db.php';

header('Content-Type: application/json; charset=utf-8');

function fail_sync_pedidos($status, $message, $extra = []) {
    http_response_code($status);
    echo json_encode(array_merge([
        'ok' => false,
        'error' => $message
    ], $extra), JSON_UNESCAPED_UNICODE);
    exit;
}

$syncBaseUrl = env('SOLUCIONESYA_SYNC_BASE_URL');
$syncUrl = env('SOLUCIONESYA_PEDIDOS_SYNC_URL') ?: ($syncBaseUrl ? rtrim($syncBaseUrl, '/') . '/api/marketplace/solicitudes' : null);
$syncToken = env('SOLUCIONESYA_SYNC_TOKEN');
$tenantId = env('SOLUCIONESYA_TENANT_ID');

if (!$syncUrl || !$syncToken || !$tenantId) {
    fail_sync_pedidos(500, 'Faltan SOLUCIONESYA_PEDIDOS_SYNC_URL o SOLUCIONESYA_SYNC_BASE_URL, SOLUCIONESYA_SYNC_TOKEN y SOLUCIONESYA_TENANT_ID en webhook/.env');
}

$pedidos = supabaseRequest(
    'GET',
    'sy_pedidos?select=*&order=created_at.desc&limit=500'
);

if (!is_array($pedidos)) {
    fail_sync_pedidos(500, 'No se pudieron leer pedidos desde Supabase');
}

$ofertas = supabaseRequest(
    'GET',
    'nuevaOferta?select=*&estado=in.(completa,pendiente,recolectando)&order=created_at.desc&limit=500'
);

if (!is_array($ofertas)) {
    $ofertas = [];
}

$payloadSolicitudes = array_values(array_filter(array_map(function ($p) {
    $id = trim((string)($p['id'] ?? ''));
    $categoria = trim($p['categoria'] ?? '');
    if ($id === '' || $categoria === '') return null;

    return [
        'marketplaceId' => $id,
        'categoria' => $categoria,
        'zona' => $p['zona'] ?? null,
        'descripcion' => $p['descripcion'] ?? null,
        'estado' => $p['estado'] ?? null,
        'clienteMarketplaceId' => $p['cliente_id'] ?? null,
        'clienteNombre' => null,
        'clienteTelefono' => null,
        'prestadorMarketplaceId' => $p['prestador_id'] ?? null,
        'responsablePago' => $p['responsable_pago'] ?? 'A_DEFINIR',
        'createdAt' => $p['created_at'] ?? null
    ];
}, $pedidos)));

$payloadOfertas = array_values(array_filter(array_map(function ($o) {
    $id = trim((string)($o['id'] ?? ''));
    $categoria = trim($o['categoria'] ?? '');
    if ($id === '' || $categoria === '') return null;

    return [
        'marketplaceId' => 'nuevaOferta:' . $id,
        'categoria' => $categoria,
        'zona' => $o['zona'] ?? null,
        'descripcion' => $o['descripcion'] ?? null,
        'estado' => $o['estado'] ?? null,
        'clienteMarketplaceId' => null,
        'clienteNombre' => null,
        'clienteTelefono' => $o['cliente_telefono'] ?? null,
        'prestadorMarketplaceId' => $o['presupuesto_seleccionado_id'] ?? null,
        'responsablePago' => $o['responsable_pago'] ?? 'A_DEFINIR',
        'createdAt' => $o['created_at'] ?? null
    ];
}, $ofertas)));

$payloadSolicitudes = array_merge($payloadSolicitudes, $payloadOfertas);

if (count($payloadSolicitudes) === 0) {
    echo json_encode([
        'ok' => true,
        'message' => 'No hay pedidos para sincronizar',
        'enviados' => 0
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

function enviar_lote_solucionesya($syncUrl, $syncToken, $tenantId, $solicitudes) {
    $payload = [
        'tenantId' => $tenantId,
        'solicitudes' => $solicitudes
    ];

    $ch = curl_init($syncUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $syncToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload, JSON_UNESCAPED_UNICODE));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    if ($curlError) {
        return ['ok' => false, 'error' => 'Error conectando con SolucionesYa', 'detail' => $curlError];
    }

    $decoded = json_decode($response ?: '', true);
    if ($httpCode >= 400) {
        return ['ok' => false, 'error' => 'SolucionesYa rechazo la sincronizacion de pedidos', 'status' => $httpCode, 'response' => $decoded ?: $response];
    }

    return $decoded ?: ['ok' => false, 'raw' => $response];
}

$creados = 0;
$actualizados = 0;
$lotes = [];

foreach (array_chunk($payloadSolicitudes, 50) as $lote) {
    $resultado = enviar_lote_solucionesya($syncUrl, $syncToken, $tenantId, $lote);
    $lotes[] = $resultado;
    if (empty($resultado['ok'])) {
        fail_sync_pedidos(502, 'Fallo un lote de sincronizacion de pedidos', ['lotes' => $lotes]);
    }
    $creados += intval($resultado['creados'] ?? 0);
    $actualizados += intval($resultado['actualizados'] ?? 0);
}

echo json_encode([
    'ok' => true,
    'enviados' => count($payloadSolicitudes),
    'creados' => $creados,
    'actualizados' => $actualizados,
    'lotes' => count($lotes)
], JSON_UNESCAPED_UNICODE);
