<?php
// Backend simple PHP para TOORI360 - Sin Composer
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Para frontend
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

// Config DB
$host = 'localhost'; // Cambia si es externo
$dbname = 'u545413471_Toori';
$user = 'u545413471_Toori';
$pass = 'D#e89Kh!';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'DB connection failed']);
    exit;
}

// JWT simple (sin libreria)
function generateJWT($payload, $secret = 'toori_secret') {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $headerEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $payloadEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(json_encode($payload)));
    $signature = hash_hmac('sha256', $headerEncoded . "." . $payloadEncoded, $secret, true);
    $signatureEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    return $headerEncoded . "." . $payloadEncoded . "." . $signatureEncoded;
}

// Router simple
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if ($request === '/api/v1/auth/login' && $method === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $token = generateJWT(['user_id' => $user['id']]);
        echo json_encode(['token' => $token]);
    } else {
        echo json_encode(['error' => 'Invalid credentials']);
    }
} elseif ($request === '/api/v1/maintenance' && $method === 'GET') {
    $stmt = $pdo->query('SELECT id, title, status FROM maintenance_requests');
    $tickets = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($tickets);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found']);
}
?>