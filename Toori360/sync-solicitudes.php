<?php
/**
 * Sincroniza solicitudes de servicio (tabla nuevaOferta) de ServiciosYa -> SolucionesYa360.
 * Cada solicitud del cliente se convierte en un Ticket en SolucionesYa (dedup por marketplaceId).
 *
 * Uso CLI:   php sync-solicitudes.php --limit=50 [--dry]
 * Uso web:   /Toori360/sync-solicitudes.php?key=RUN_SECRET&limit=50&dry=1
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

$limit  = max(1, min(200, (int) param('limit', 50, $isCli)));
$dryRun = (bool) param('dry', false, $isCli);

if (!$isCli && ($_GET['key'] ?? '') !== ($cfg['run_secret'] ?? null)) {
    http_response_code(401);
    exit("No autorizado.\n");
}

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
    curl_close($ch);
    return ['code' => $code, 'body' => $res];
}

// --- 1) leer solicitudes de Supabase (nuevaOferta) ---
$select = 'id,categoria,zona,descripcion,estado,nombre_cliente,cliente_telefono,created_at';
$url = rtrim($cfg['supabase_url'], '/') . '/rest/v1/nuevaOferta?select=' . rawurlencode($select) . '&order=id.desc&limit=' . $limit;
$sb = httpJson('GET', $url, [
    'apikey: ' . $cfg['supabase_key'],
    'Authorization: Bearer ' . $cfg['supabase_key'],
]);
if ($sb['code'] !== 200) {
    http_response_code(502);
    exit("Error leyendo Supabase (HTTP {$sb['code']}): {$sb['body']}\n");
}
$ofertas = json_decode($sb['body'], true) ?: [];
echo "Leídas " . count($ofertas) . " solicitudes de ServiciosYa.\n";

// --- 2) mapear al formato de SolucionesYa ---
$solicitudes = [];
foreach ($ofertas as $o) {
    if (empty($o['id'])) continue;
    $tel = $o['cliente_telefono'] ?? null;
    if ($tel) $tel = preg_replace('/^whatsapp:\s*/i', '', (string) $tel);
    $solicitudes[] = [
        'marketplaceId' => (string) $o['id'],
        'categoria'     => $o['categoria'] ?: 'Servicio',
        'zona'          => $o['zona'] ?? null,
        'descripcion'   => $o['descripcion'] ?? null,
        'estado'        => $o['estado'] ?? 'pendiente',
        'clienteNombre' => $o['nombre_cliente'] ?? null,
        'clienteTelefono' => $tel,
        'createdAt'     => $o['created_at'] ?? null,
    ];
}
if (!$solicitudes) exit("No hay solicitudes para sincronizar.\n");

if ($dryRun) {
    echo "DRY-RUN: se sincronizarían " . count($solicitudes) . " solicitudes. Muestra:\n";
    echo json_encode(array_slice($solicitudes, 0, 3), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "\n";
    exit;
}

// --- 3) empujar a SolucionesYa (lotes de 200) ---
$creados = 0; $actualizados = 0;
foreach (array_chunk($solicitudes, 200) as $lote) {
    $payload = json_encode(['tenantId' => $cfg['tenant_id'], 'solicitudes' => $lote], JSON_UNESCAPED_UNICODE);
    $r = httpJson('POST', rtrim($cfg['solucionesya_url'], '/') . '/api/marketplace/solicitudes', [
        'Authorization: Bearer ' . $cfg['marketplace_token'],
        'Content-Type: application/json',
    ], $payload);
    $data = json_decode($r['body'], true);
    if ($r['code'] === 200 && !empty($data['ok'])) {
        $creados      += (int) ($data['creados'] ?? 0);
        $actualizados += (int) ($data['actualizados'] ?? 0);
        echo "Lote OK: creados {$data['creados']}, actualizados {$data['actualizados']}.\n";
    } else {
        echo "Lote ERROR (HTTP {$r['code']}): {$r['body']}\n";
    }
}
echo "Listo. Tickets creados: {$creados}, actualizados: {$actualizados}.\n";
