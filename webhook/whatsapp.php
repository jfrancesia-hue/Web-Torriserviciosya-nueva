<?php
require_once 'config.php';
function enviarWhatsApp($to, $mensaje) {
    // Validación 1: Verificar que el mensaje no sea null
    if ($mensaje === null) {
        file_put_contents("debug.txt", "[ERROR 63112] Mensaje NULL a $to\n", FILE_APPEND);
        return false;
    }
    // Validación 2: Convertir a string si es necesario
    $mensaje = (string)$mensaje;
    // Validación 3: Limpiar espacios en blanco
    $mensaje_limpio = trim($mensaje);
    // Validación 4: Verificar que no esté vacío
    if (empty($mensaje_limpio)) {
        file_put_contents("debug.txt", "[ERROR 63112] Mensaje vacío/whitespace a $to. Original: " . json_encode($mensaje) . "\n", FILE_APPEND);
        return false;
    }
    // Validación 5: Verificar longitud mínima
    if (strlen($mensaje_limpio) === 0) {
        file_put_contents("debug.txt", "[ERROR 63112] Mensaje sin contenido válido a $to\n", FILE_APPEND);
        return false;
    }
    $url = "https://api.twilio.com/2010-04-01/Accounts/" 
        . env('TWILIO_SID') . "/Messages.json";
    $sid = env('TWILIO_SID');
    $token = env('TWILIO_TOKEN');
    if (!$sid || !$token) {
        file_put_contents("debug.txt", "[ERROR] Credenciales de Twilio faltando\n", FILE_APPEND);
        return false;
    }
    // Preparar datos - ASEGURAR QUE Body NO ESTÉ VACÍO
    $data = [
        "From" => env('TWILIO_WHATSAPP_FROM'),
        "To" => $to,
        "Body" => $mensaje_limpio  // NUNCA vacío en este punto
    ];
    // Validar una vez más antes de enviar
    if (empty($data["Body"])) {
        file_put_contents("debug.txt", "[ERROR 63112] Body está vacío antes de enviar a $to\n", FILE_APPEND);
        return false;
    }
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_USERPWD, $sid . ":" . $token);
    
    // Construir el POST data manualmente para máximo control
    $post_data = "From=" . rawurlencode($data["From"]) . 
                 "&To=" . rawurlencode($data["To"]) . 
                 "&Body=" . rawurlencode($data["Body"]);
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    // Log de request antes de enviar
    file_put_contents("debug.txt", "[WHATSAPP_REQUEST] To: " . $data["To"] . " | Body (len): " . strlen($data["Body"]) . " | Body: " . substr($data["Body"], 0, 100) . "\n", FILE_APPEND);
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curl_error = curl_error($ch);
    curl_close($ch);
    // Log de respuesta detallado
    if ($http_code !== 201) {
        $error_log = "[WHATSAPP_ERROR] HTTP $http_code | Error: $curl_error | Response: " . substr($response, 0, 500);
        file_put_contents("debug.txt", $error_log . "\n", FILE_APPEND);
    } else {
        file_put_contents("debug.txt", "[WHATSAPP_OK] HTTP 201 - Enviado a " . $data["To"] . "\n", FILE_APPEND);
    }
    return $http_code == 201;
}