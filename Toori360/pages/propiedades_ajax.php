<?php
session_start();
require_once __DIR__ . '/../includes/conexion.php';

header('Content-Type: application/json');

$id_propietario = $_SESSION['propietario_id'] ?? 0;
if (!$id_propietario) { echo json_encode(['ok'=>false,'error'=>'No autorizado']); exit; }

$action = $_GET['action'] ?? '';

if ($action === 'nueva_propiedad') {
    $dir    = trim($_POST['direccion'] ?? '');
    $ciudad = trim($_POST['ciudad'] ?? '');
    $tipo   = trim($_POST['tipo'] ?? '');
    $precio = $_POST['precio'] ? (float)$_POST['precio'] : null;
    $estado = $_POST['estado'] ?? 'disponible';

    if (!$dir) { echo json_encode(['ok'=>false,'error'=>'Dirección requerida']); exit; }

    try {
        $stmt = $pdo->prepare('INSERT INTO propiedades (direccion, ciudad, tipo, precio, estado, id_propietario) VALUES (?,?,?,?,?,?)');
        $stmt->execute([$dir, $ciudad, $tipo, $precio, $estado, $id_propietario]);
        echo json_encode(['ok' => true]);
    } catch (Exception $e) {
        echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
    }
    exit;
}

if ($action === 'eliminar_propiedad') {
    $id = (int)($_GET['id'] ?? 0);
    try {
        $pdo->prepare('DELETE FROM propiedades WHERE id = ? AND id_propietario = ?')->execute([$id, $id_propietario]);
        echo json_encode(['ok' => true]);
    } catch (Exception $e) {
        echo json_encode(['ok'=>false,'error'=>$e->getMessage()]);
    }
    exit;
}

echo json_encode(['ok'=>false,'error'=>'Acción no válida']);