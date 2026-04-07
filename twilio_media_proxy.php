<?php
/**
 * Proxy para servir imágenes de Twilio con autenticación
 * Uso: twilio_media_proxy.php?url=https://api.twilio.com/...
 */
// Evitar dependencia de archivos externos para que el proxy funcione incluso
// en entornos donde no exista `config.php`. Preferir variables de entorno.
$url = $_GET['url'] ?? '';

// Validar que la URL sea de Twilio (evita SSRF hacia otras hosts)
if (empty($url) || strpos($url, 'https://api.twilio.com/') !== 0) {
    http_response_code(400);
    echo 'URL inválida';
    exit;
}

// Valores por defecto para pruebas locales (si no están en variables de entorno)
// Nota: estos valores se proveen aquí a petición del desarrollador; por seguridad
// se recomienda cargarlos desde variables de entorno en producción.
$twilioSid   = getenv('TWILIO_SID') ?: ($_ENV['TWILIO_SID'] ?? null);
$twilioToken = getenv('TWILIO_TOKEN') ?: ($_ENV['TWILIO_TOKEN'] ?? null);
$twilioFrom  = getenv('TWILIO_WHATSAPP_FROM') ?: ($_ENV['TWILIO_WHATSAPP_FROM'] ?? null);

// Fallback: configurar en .env o variables de entorno
if (!$twilioSid) {
    $twilioSid = getenv('TWILIO_SID_FALLBACK') ?: '';
}
if (!$twilioToken) {
    $twilioToken = getenv('TWILIO_TOKEN_FALLBACK') ?: '';
}
if (!$twilioFrom) {
    $twilioFrom = 'whatsapp:+5493512139046';
}

if (!$twilioSid || !$twilioToken) {
    http_response_code(500);
    echo 'Credenciales no configuradas';
    exit;
}

// Cachear en el browser por 24hs para no re-descargar cada vez
// Permitir carga desde el navegador y evitar problemas CORS si se solicita desde JS
header('Access-Control-Allow-Origin: *');
header('Cache-Control: public, max-age=86400');

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERPWD, "$twilioSid:$twilioToken");
curl_setopt($ch, CURLOPT_TIMEOUT, 15);

$imageData   = curl_exec($ch);
$httpCode    = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

if ($httpCode !== 200 || empty($imageData)) {
    http_response_code(404);
    echo 'No se pudo obtener la imagen';
    exit;
}

// Limpiar content-type (puede venir con charset extra)
$contentType = $contentType ? explode(';', $contentType)[0] : 'application/octet-stream';

// Enviar cabeceras correctas y devolver el body binario
header('Content-Type: ' . $contentType);
header('Content-Transfer-Encoding: binary');
header('Content-Length: ' . strlen($imageData));
// Evitar que PHP haya enviado contenido accidental (BOM, whitespace)
if (ob_get_level()) { ob_end_clean(); }
echo $imageData;
flush();
exit;