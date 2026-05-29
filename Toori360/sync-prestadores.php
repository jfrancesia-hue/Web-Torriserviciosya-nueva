<?php
/**
 * Sincroniza prestadores (usuarios rol=worker) de ServiciosYa -> SolucionesYa360.
 *
 * Uso CLI:   php sync-prestadores.php --limit=100 --categoria=Plomeria [--dry]
 * Uso web:   /Toori360/sync-prestadores.php?key=RUN_SECRET&limit=100&dry=1
 *
 * Lee de Supabase (REST) los usuarios con rol=worker y los empuja en lotes al
 * endpoint /api/marketplace/proveedores de SolucionesYa con el token de sincronización.
 */

declare(strict_types=1);
header('Content-Type: text/plain; charset=utf-8');

$cfgPath = __DIR__ . '/config-solucionesya.php';
if (!is_file($cfgPath)) {
    http_response_code(500);
    exit("Falta config-solucionesya.php (copiá config-solucionesya.example.php y completá los valores).\n");
}
$cfg = require $cfgPath;

$isCli = (PHP_SAPI === 'cli');

// --- parámetros ---
function param(string $name, $default = null, bool $cli = false) {
    if ($cli) {
        foreach ($GLOBALS['argv'] ?? [] as $arg) {
            if (preg_match('/^--' . preg_quote($name, '/') . '=(.*)$/', $arg, $m)) return $m[1];
            if ($arg === '--' . $name) return '1';
        }
        return $default;
    }
    return $_GET[$name] ?? $default;
}

$limit     = max(1, min(200, (int) param('limit', 100, $isCli)));
$categoria = param('categoria', null, $isCli);
$dryRun    = (bool) param('dry', false, $isCli);

// --- seguridad para ejecución web ---
if (!$isCli) {
    if (($_GET['key'] ?? '') !== ($cfg['run_secret'] ?? null)) {
        http_response_code(401);
        exit("No autorizado.\n");
    }
}

// --- helper cURL ---
function httpJson(string $method, string $url, array $headers, ?string $body = null): array {
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_CUSTOMREQUEST  => $method,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_TIMEOUT        => 30,
    ]);
    if ($body !== null) curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    $res  = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $err  = curl_error($ch);
    curl_close($ch);
    return ['code' => $code, 'body' => $res, 'error' => $err];
}

// --- 1) leer workers de Supabase (ServiciosYa) ---
$select = 'id,nombre,apellido,email,categoria';
$query  = "rol=eq.worker&select={$select}&limit={$limit}";
if ($categoria) $query .= '&categoria=eq.' . rawurlencode($categoria);

$sb = httpJson('GET', rtrim($cfg['supabase_url'], '/') . "/rest/v1/usuarios?{$query}", [
    'apikey: ' . $cfg['supabase_key'],
    'Authorization: Bearer ' . $cfg['supabase_key'],
]);
if ($sb['code'] !== 200) {
    http_response_code(502);
    exit("Error leyendo Supabase (HTTP {$sb['code']}): {$sb['body']}\n");
}
$workers = json_decode($sb['body'], true) ?: [];
echo "Leídos " . count($workers) . " prestadores de ServiciosYa" . ($categoria ? " (categoría: {$categoria})" : "") . ".\n";

// --- 2) mapear al formato de SolucionesYa ---
$proveedores = [];
foreach ($workers as $w) {
    if (empty($w['id'])) continue;
    $nombre = trim(($w['nombre'] ?? '') . ' ' . ($w['apellido'] ?? ''));
    if ($nombre === '') $nombre = 'Prestador ' . substr((string) $w['id'], 0, 8);
    // En ServiciosYa `categoria` es un array (text[]); puede venir como array o string.
    $rubros = [];
    $cat = $w['categoria'] ?? null;
    if (is_array($cat)) {
        foreach ($cat as $c) { $c = trim((string) $c); if ($c !== '') $rubros[] = $c; }
    } elseif (!empty($cat)) {
        $rubros[] = (string) $cat;
    }
    $proveedores[] = [
        'marketplaceId' => (string) $w['id'],
        'nombre'        => $nombre,
        'rubros'        => $rubros,
        'email'         => $w['email'] ?? null,
    ];
}

if (!$proveedores) exit("No hay prestadores para sincronizar.\n");

if ($dryRun) {
    echo "DRY-RUN: se sincronizarían " . count($proveedores) . " prestadores. Muestra:\n";
    echo json_encode(array_slice($proveedores, 0, 3), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    exit;
}

// --- 3) empujar a SolucionesYa (lotes de 200) ---
$totCreados = 0; $totActualizados = 0;
foreach (array_chunk($proveedores, 200) as $lote) {
    $payload = json_encode(['tenantId' => $cfg['tenant_id'], 'proveedores' => $lote], JSON_UNESCAPED_UNICODE);
    $r = httpJson('POST', rtrim($cfg['solucionesya_url'], '/') . '/api/marketplace/proveedores', [
        'Authorization: Bearer ' . $cfg['marketplace_token'],
        'Content-Type: application/json',
    ], $payload);
    $data = json_decode($r['body'], true);
    if ($r['code'] === 200 && !empty($data['ok'])) {
        $totCreados      += (int) ($data['creados'] ?? 0);
        $totActualizados += (int) ($data['actualizados'] ?? 0);
        echo "Lote OK: creados {$data['creados']}, actualizados {$data['actualizados']}.\n";
    } else {
        echo "Lote ERROR (HTTP {$r['code']}): {$r['body']}\n";
    }
}

echo "Listo. Creados: {$totCreados}, actualizados: {$totActualizados}.\n";

/**
 * PENDIENTE — sincronización de SOLICITUDES:
 * En ServiciosYa no encontré una tabla `ofertas` con ese nombre. Cuando confirmes en qué
 * tabla viven las solicitudes de servicio del cliente (y sus campos: categoría, descripción,
 * zona, cliente), se replica este patrón empujando a /api/marketplace/solicitudes con:
 *   { tenantId, solicitudes: [ { marketplaceId, categoria, zona, descripcion, estado, clienteNombre } ] }
 */
