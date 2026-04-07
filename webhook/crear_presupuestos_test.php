<?php
require_once 'config.php';
require_once 'db.php';

/**
 * Script para crear presupuestos de prueba
 * Uso: /crear_presupuestos_test.php?oferta_id=7&cantidad=3
 */

$oferta_id = $_GET['oferta_id'] ?? null;
$cantidad = intval($_GET['cantidad'] ?? 3);

if (!$oferta_id) {
    echo "Error: Falta parámetro oferta_id\n";
    exit;
}

echo "Creando $cantidad presupuestos para oferta_id=$oferta_id...\n";

for ($i = 1; $i <= $cantidad; $i++) {
    $monto = 100000 + ($i * 50000);
    $dias = 2 + $i;
    
    $presupuesto = [
        "oferta_id" => intval($oferta_id),
        "trabajador_id" => 100 + $i,
        "trabajador_uuid" => "test-trabajador-$i",
        "monto" => $monto,
        "tiempo_entrega" => $dias,
        "score" => rand(1, 5),
        "estado" => "activo",
        "estado_confirmacion" => "pendiente",
        "descripcion" => "Propuesta de prueba #$i - $" . number_format($monto, 0)
    ];
    
    $resultado = supabaseRequest("POST", "presupuestos", $presupuesto);
    
    if ($resultado) {
        echo "✅ Presupuesto #$i creado: \$$monto en $dias días\n";
    } else {
        echo "❌ Error creando presupuesto #$i\n";
    }
}

echo "\n✅ Presupuestos de prueba creados. Ahora envía un mensaje para ver PASO 4.\n";
?>
