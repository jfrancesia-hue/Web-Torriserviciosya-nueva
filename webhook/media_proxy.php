<?php
// media_proxy.php: Descarga y sirve archivos multimedia de Twilio de forma autenticada
// Uso: media_proxy.php?url=URL_DE_TWILIO

require_once 'config.php';

$url = $_GET['url'] ?? '';
if (!$url || strpos($url, 'api.twilio.com') === false) {
    http_response_code(400);
    echo 'URL inválida';
    exit;
}

$twilioSid = env('TWILIO_SID');
$twilioToken = env('TWILIO_TOKEN');
if (!$twilioSid || !$twilioToken) {
    http_response_code(500);
    echo 'Credenciales Twilio no configuradas';
    exit;
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERPWD, "$twilioSid:$twilioToken");
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
$data = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200 || !$data) {
    http_response_code(404);
    echo 'No se pudo descargar el archivo';
    exit;
}

header('Content-Type: ' . $contentType);
header('Cache-Control: max-age=86400');
echo $data;
