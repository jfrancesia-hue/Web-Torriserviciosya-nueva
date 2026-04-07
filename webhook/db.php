<?php
// Cargar variables de entorno y helper de logging
require_once 'config.php';

if (!function_exists('log_debug')) {
    function log_debug($msg) {
        if (env('DEBUG') === '1') {
            error_log($msg);
        }
    }
}

log_debug('[DEBUG] INICIO db.php');

function supabaseRequest($method, $endpoint, $data = null) {
    $url = env('SUPABASE_URL') . "/rest/v1/" . $endpoint;
    log_debug('[DEBUG] supabaseRequest URL: ' . $url);
    // Verificar que las variables existan
    if (empty(env('SUPABASE_URL'))) {
        error_log('[ERROR] SUPABASE_URL está vacío');
        return null;
    }
    if (empty(env('SUPABASE_SERVICE_KEY'))) {
        error_log('[ERROR] SUPABASE_SERVICE_KEY está vacío');
        return null;
    }
    $headers = [
        "apikey: " . env('SUPABASE_SERVICE_KEY'),
        "Authorization: Bearer " . env('SUPABASE_SERVICE_KEY'),
        "Content-Type: application/json",
        "Prefer: return=representation"
    ];
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    }
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    // Registro más detallado para depuración (condicional)
    log_debug('[DEBUG] supabaseRequest response_length: ' . ($response === false ? 'false' : strlen($response)) . ' httpCode: ' . $httpCode);
    if (is_string($response)) {
        log_debug('[DEBUG] supabaseRequest response_preview: ' . substr($response, 0, 2000));
    } else {
        log_debug('[DEBUG] supabaseRequest response not a string (var_export): ' . var_export($response, true));
    }
    log_debug('[DEBUG] supabaseRequest curlError: ' . $curlError);
    curl_close($ch);

    if ($curlError) {
        error_log('[ERROR] CURL error: ' . $curlError);
        return null;
    }
    if ($response === false || $response === null || $response === '') {
        error_log('[ERROR] Respuesta vacía. HTTP code: ' . $httpCode);
        return null;
    }
    if ($httpCode >= 400) {
        error_log('[ERROR] HTTP ' . $httpCode . ' - response: ' . substr($response, 0, 2000));
        return null;
    }

    $decoded = json_decode($response, true);
    $jsonErr = json_last_error();
    if ($jsonErr !== JSON_ERROR_NONE) {
        error_log('[ERROR] json_decode fallo: ' . json_last_error_msg() . ' codigo: ' . $jsonErr);
        error_log('[ERROR] response_preview_for_json_error: ' . substr($response, 0, 4000));
        return null;
    }

    log_debug('[DEBUG] supabaseRequest decoded_type: ' . gettype($decoded) . ' count: ' . (is_array($decoded) ? count($decoded) : 0));
    if (is_array($decoded)) {
        // Logear los primeros 5 elementos para inspección si existen
        $sample = array_slice($decoded, 0, 5);
        log_debug('[DEBUG] supabaseRequest decoded_sample: ' . var_export($sample, true));
    }
    return $decoded;
}

log_debug('[DEBUG] FIN db.php');