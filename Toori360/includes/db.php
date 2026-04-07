<?php
// Configuración de la base de datos MySQL
$DB_HOST = 'localhost'; // Cambia si tu host es diferente
$DB_NAME = 'u545413471_360';
$DB_USER = 'u545413471_360';
$DB_PASS = 'lU6eXq$4t=~';

try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Error de conexión a la base de datos: ' . $e->getMessage());
}
