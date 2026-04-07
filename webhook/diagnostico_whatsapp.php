<?php
/**
 * Script de diagnóstico para el error 63112
 * Ejecutar: php diagnostico_whatsapp.php
 */

require_once 'config.php';
require_once 'whatsapp.php';

echo "=== DIAGNÓSTICO DE WHATSAPP ===\n\n";

// Test 1: Verificar credenciales
echo "1. Credenciales de Twilio:\n";
$sid = env('TWILIO_SID');
$token = env('TWILIO_TOKEN');
$from = env('TWILIO_WHATSAPP_FROM');

echo "   - TWILIO_SID: " . (substr($sid, 0, 5) . "..." . substr($sid, -3)) . " ✓\n";
echo "   - TWILIO_TOKEN: " . (substr($token, 0, 5) . "..." . substr($token, -3)) . " ✓\n";
echo "   - TWILIO_WHATSAPP_FROM: $from ✓\n\n";

// Test 2: Prueba de mensaje normal
echo "2. Test de mensaje normal:\n";
$result = enviarWhatsApp("+1234567890", "Hola mundo");
echo "   - Resultado: " . ($result ? "OK" : "FAIL") . "\n\n";

// Test 3: Prueba con emojis
echo "3. Test con emojis:\n";
$result = enviarWhatsApp("+1234567890", "Hola 👋 ¿Qué necesitas?");
echo "   - Resultado: " . ($result ? "OK" : "FAIL") . "\n\n";

// Test 4: Prueba con número
echo "4. Test con formato de dinero:\n";
$monto = 100.50;
$mensaje_dinero = "Debes pagar: \$" . number_format($monto, 2);
$result = enviarWhatsApp("+1234567890", $mensaje_dinero);
echo "   - Resultado: " . ($result ? "OK" : "FAIL") . "\n";
echo "   - Mensaje: $mensaje_dinero\n\n";

// Test 5: Revisar log
echo "5. Últimas 10 líneas de debug.txt:\n";
if (file_exists('debug.txt')) {
    $lines = array_slice(file('debug.txt'), -10);
    foreach ($lines as $line) {
        echo "   " . trim($line) . "\n";
    }
} else {
    echo "   No hay archivo debug.txt aún\n";
}

echo "\n=== FIN DIAGNÓSTICO ===\n";
