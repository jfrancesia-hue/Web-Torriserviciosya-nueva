<?php
/**
 * Diagnóstico de errores - Subir al servidor y acceder via navegador
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Diagnóstico ServiciosYa</h1>";
echo "<pre>";

// 1. Verificar PHP
echo "✅ PHP Version: " . phpversion() . "\n\n";

// 2. Verificar archivos existen
$archivos = [
    'config.php',
    'db.php', 
    'whatsapp.php',
    'ia_conversacional.php',
    'ranking.php',
    'crear_pago.php',
    '.env'
];

echo "=== ARCHIVOS ===\n";
foreach ($archivos as $archivo) {
    if (file_exists(__DIR__ . '/' . $archivo)) {
        echo "✅ $archivo existe\n";
    } else {
        echo "❌ $archivo NO EXISTE\n";
    }
}
echo "\n";

// 3. Verificar config.php
echo "=== CONFIG.PHP ===\n";
try {
    require_once 'config.php';
    echo "✅ config.php cargado\n";
    
    // Verificar función env
    if (function_exists('env')) {
        echo "✅ función env() existe\n";
        
        $keys = ['SUPABASE_URL', 'TWILIO_SID', 'OPENAI_KEY'];
        foreach ($keys as $key) {
            $val = env($key);
            if ($val) {
                echo "✅ $key configurado: " . substr($val, 0, 20) . "...\n";
            } else {
                echo "❌ $key NO configurado\n";
            }
        }
    } else {
        echo "❌ función env() NO existe\n";
    }
} catch (Exception $e) {
    echo "❌ Error en config.php: " . $e->getMessage() . "\n";
}
echo "\n";

// 4. Verificar db.php
echo "=== DB.PHP ===\n";
try {
    require_once 'db.php';
    echo "✅ db.php cargado\n";
    
    if (function_exists('supabaseRequest')) {
        echo "✅ función supabaseRequest() existe\n";
    } else {
        echo "❌ función supabaseRequest() NO existe\n";
    }
} catch (Exception $e) {
    echo "❌ Error en db.php: " . $e->getMessage() . "\n";
}
echo "\n";

// 5. Verificar ia_conversacional.php
echo "=== IA_CONVERSACIONAL.PHP ===\n";
try {
    require_once 'ia_conversacional.php';
    echo "✅ ia_conversacional.php cargado\n";
    
    $funciones = ['descargarMediaTwilio', 'getCamposRequeridos', 'procesarConversacion', 'guardarEnHistorial', 'actualizarOfertaConCampos'];
    foreach ($funciones as $func) {
        if (function_exists($func)) {
            echo "✅ función $func() existe\n";
        } else {
            echo "❌ función $func() NO existe\n";
        }
    }
} catch (Exception $e) {
    echo "❌ Error en ia_conversacional.php: " . $e->getMessage() . "\n";
}
echo "\n";

// 6. Verificar whatsapp.php
echo "=== WHATSAPP.PHP ===\n";
try {
    require_once 'whatsapp.php';
    echo "✅ whatsapp.php cargado\n";
    
    if (function_exists('enviarWhatsApp')) {
        echo "✅ función enviarWhatsApp() existe\n";
    } else {
        echo "❌ función enviarWhatsApp() NO existe\n";
    }
} catch (Exception $e) {
    echo "❌ Error en whatsapp.php: " . $e->getMessage() . "\n";
}
echo "\n";

// 7. Test de sintaxis del webhook
echo "=== WEBHOOK SYNTAX CHECK ===\n";
$output = shell_exec('php -l webhook_whatsapp.php 2>&1');
echo $output;

echo "</pre>";
echo "<p><strong>Si todo está ✅, el problema puede ser en la BD o permisos.</strong></p>";
