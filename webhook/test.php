<?php
// test.php — subilo a la carpeta webhook/ y abrilo en el navegador
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "1. config.php... ";
require_once 'config.php';
echo "OK<br>";

echo "2. db.php... ";
require_once 'db.php';
echo "OK<br>";

echo "3. whatsapp.php... ";
require_once 'whatsapp.php';
echo "OK<br>";

echo "4. claude.php... ";
require_once 'claude.php';
echo "OK<br>";

echo "5. ia_conversacional.php... ";
require_once 'ia_conversacional.php';
echo "OK<br>";

echo "6. ENV test: SUPABASE_URL = " . (env('SUPABASE_URL') ?: 'VACÍO') . "<br>";
echo "7. ENV test: LLM_PROVIDER = " . (env('LLM_PROVIDER') ?: 'VACÍO') . "<br>";
echo "8. ENV test: ANTHROPIC_API_KEY = " . (env('ANTHROPIC_API_KEY') ? 'OK (tiene valor)' : 'VACÍO') . "<br>";

echo "<br>✅ Todo cargó bien!";