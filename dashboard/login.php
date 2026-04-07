<?php
// login.php simple con credenciales hardcodeadas
session_start();
$usuario_valido = 'admin';
$contrasena_valida = '1234';
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasena = $_POST['contrasena'] ?? '';
    if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
        $_SESSION['logged_in'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = 'Credenciales incorrectas';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-box {
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            text-align: center;
            min-width: 320px;
        }
        h1 {
            color: #273c75;
            margin-bottom: 1.5rem;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        label {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            font-weight: 500;
            color: #353b48;
        }
        input[type="text"], input[type="password"] {
            padding: 0.5rem;
            border: 1px solid #dcdde1;
            border-radius: 5px;
            width: 100%;
            margin-top: 0.3rem;
        }
        button {
            padding: 0.7rem 0;
            background: #0097e6;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }
        button:hover {
            background: #40739e;
        }
        .error {
            color: #e84118;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h1>Iniciar sesión</h1>
        <?php if ($error) echo "<div class='error'>$error</div>"; ?>
        <form method="post">
            <label>Usuario:
                <input type="text" name="usuario" autocomplete="username">
            </label>
            <label>Contraseña:
                <input type="password" name="contrasena" autocomplete="current-password">
            </label>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
