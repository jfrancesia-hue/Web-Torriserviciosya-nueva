<?php
/**
 * Test para validar que enviarWhatsApp no envía mensajes vacíos
 */

require_once 'config.php';
require_once 'whatsapp.php';

// Test 1: Mensaje normal
echo "Test 1: Mensaje normal\n";
$result = enviarWhatsApp("+1234567890", "Hola mundo");
echo "Resultado: " . ($result ? "OK" : "FAIL") . "\n\n";

// Test 2: Mensaje con espacios
echo "Test 2: Mensaje con espacios en blanco\n";
$result = enviarWhatsApp("+1234567890", "   ");
echo "Resultado: " . ($result ? "FAIL (debería ser false)" : "OK (rechazado correctamente)") . "\n\n";

// Test 3: Mensaje vacío
echo "Test 3: Mensaje vacío\n";
$result = enviarWhatsApp("+1234567890", "");
echo "Resultado: " . ($result ? "FAIL (debería ser false)" : "OK (rechazado correctamente)") . "\n\n";

// Test 4: Mensaje null
echo "Test 4: Mensaje null\n";
$result = enviarWhatsApp("+1234567890", null);
echo "Resultado: " . ($result ? "FAIL (debería ser false)" : "OK (rechazado correctamente)") . "\n\n";

// Test 5: Mensaje con número
echo "Test 5: Mensaje con número\n";
$monto = 100.50;
$mensaje = "Debes pagar: \$" . number_format($monto, 2);
$result = enviarWhatsApp("+1234567890", $mensaje);
echo "Resultado: " . ($result ? "OK" : "FAIL") . "\n";
echo "Mensaje: $mensaje\n";
