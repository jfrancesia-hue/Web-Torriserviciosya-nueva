<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Si ya está logueado, redirigir al dashboard
if (isset($_SESSION['propietario_id'])) {
    header('Location: ../index.php');
    exit;
}

require_once __DIR__ . '/../includes/conexion.php';

$register_success = false;
$register_error = '';
$login_error = '';

// --- REGISTRO ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $nombre   = trim($_POST['registerName'] ?? '');
    $apellido = trim($_POST['registerApellido'] ?? '');
    $dni      = trim($_POST['registerDni'] ?? '');
    $telefono = trim($_POST['registerTelefono'] ?? '');
    $email    = trim($_POST['registerEmail'] ?? '');
    $password = $_POST['registerPassword'] ?? '';

    if ($nombre && $apellido && $email && $password) {
        // Verificar si el email ya existe
        $check = $pdo->prepare('SELECT id FROM propietarios WHERE email = ?');
        $check->execute([$email]);
        if ($check->fetch()) {
            $register_error = 'Ya existe una cuenta con ese email.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            try {
                $stmt = $pdo->prepare('INSERT INTO propietarios (nombre, apellido, dni, telefono, email, password) VALUES (?, ?, ?, ?, ?, ?)');
                $stmt->execute([$nombre, $apellido, $dni, $telefono, $email, $hash]);
                $register_success = true;
            } catch (PDOException $e) {
                $register_error = 'Error al registrar: ' . $e->getMessage();
            }
        }
    } else {
        $register_error = 'Completa todos los campos obligatorios.';
    }
}

// --- LOGIN ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email    = trim($_POST['loginEmail'] ?? '');
    $password = $_POST['loginPassword'] ?? '';

    if ($email && $password) {
        $stmt = $pdo->prepare('SELECT * FROM propietarios WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['propietario_id']     = $user['id'];
            $_SESSION['propietario_nombre'] = $user['nombre'];
            header('Location: ../index.php');
            exit;
        } else {
            $login_error = 'Email o contraseña incorrectos.';
        }
    } else {
        $login_error = 'Completa todos los campos.';
    }
}


// --- LOGIN INQUILINO ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['loginInquilino'])) {
    $dni = trim($_POST['loginInquilinoDni'] ?? '');
    $propiedad_id = trim($_POST['loginInquilinoPropiedad'] ?? '');
    if ($dni && $propiedad_id) {
        $stmt = $pdo->prepare('SELECT i.id, i.nombre, i.dni, i.propiedad_id FROM inquilinos i WHERE i.dni = ? AND i.propiedad_id = ?');
        $stmt->execute([$dni, $propiedad_id]);
        $inquilino = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($inquilino) {
            $_SESSION['inquilino_id'] = $inquilino['id'];
            $_SESSION['inquilino_nombre'] = $inquilino['nombre'];
            $_SESSION['inquilino_propiedad_id'] = $inquilino['propiedad_id'];
            header('Location: ../indexInquilino.php');
            exit;
        } else {
            $login_inquilino_error = 'DNI o ID de propiedad incorrectos.';
        }
    } else {
        $login_inquilino_error = 'Completa todos los campos.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Toori360</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
                .inquilino-card-gradient-text {
                    background: linear-gradient(90deg, #fff36b 0%, #00B4D8 50%, #a8cb60 100%);
                    background-size: 200% 200%;
                    animation: gradientTextMove 3s ease-in-out infinite;
                    -webkit-background-clip: text;
                    -webkit-text-fill-color: transparent;
                    background-clip: text;
                    color: transparent;
                    font-weight: 800;
                }
                @keyframes gradientTextMove {
                    0% {background-position: 0% 50%;}
                    50% {background-position: 100% 50%;}
                    100% {background-position: 0% 50%;}
                }
        body, html {height:100%;margin:0;}
        .login-container {display:flex;min-height:100vh;}
        .login-left {flex:1;background:linear-gradient(135deg,#2e86de 60%,#48dbfb 100%);color:#fff;display:flex;flex-direction:column;justify-content:center;align-items:center;padding:3rem;}
        .login-left h1 {font-size:2.5rem;margin-bottom:1rem;}
        .login-left p {font-size:1.2rem;max-width:400px;line-height:1.5;}
        .login-right {
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #f7fafd;
    flex-direction: column;
}
        .login-card {width:100%;max-width:350px;background:#fff;border-radius:12px;box-shadow:0 2px 16px rgba(44,62,80,.08);padding:2.5rem 2rem;}
        .login-card h2 {margin-bottom:1.5rem;text-align:center;}
        .form-group {margin-bottom:1.2rem;}
        .form-group label {display:block;margin-bottom:.5rem;font-weight:500;}
        .form-control {width:100%;padding:.7rem;border:1px solid #dfe6e9;border-radius:6px;font-size:1rem;}
        .btn {width:100%;padding:.7rem;background:#2e86de;color:#fff;border:none;border-radius:6px;font-size:1rem;font-weight:600;cursor:pointer;transition:.2s;}
        .btn:hover {background:#2163a6;}
        .toggle-link {display:block;text-align:center;margin-top:1rem;color:#2e86de;cursor:pointer;}
        .toggle-link:hover {text-decoration:underline;}
        .logo {font-size:2.5rem;font-weight:900;letter-spacing:2px;margin-bottom:1.5rem;}
        @media (max-width:900px) {
            .login-container {flex-direction:column;}
            .login-left, .login-right {flex:none;width:100%;min-height:300px;}
            .login-left {padding:2rem;}
        }
        body, html {height:100%;margin:0;}
        .login-container {display:flex;min-height:100vh;}
        .login-left {
    flex: 1;
    background: linear-gradient(245deg, #4AADD3 60%, #a8cb60 90%);
    color: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 3rem;
    backdrop-filter: brightness(0);
    background-size: 200% 200%;
    animation: gradientMove 4s ease-in-out infinite;
}
                .inquilino-card-gradient {
                    background: linear-gradient(90deg, #ffffff 0%, #0056a6 50%, #ffffff 100%);
                    color:#fff;
                    box-shadow:0 2px 24px rgba(0,86,166,0.10);
                    font-size:1.15rem;
                    font-weight:600;
                    text-align:center;
                    margin-bottom:24px;
                    width:370px;
                    padding:1.2rem 1rem;
                    border-radius:16px;
                    background-size: 200% 200%;
                    animation: gradientMove 4s ease-in-out infinite;
                    cursor: pointer;
                    transition: transform 0.2s, box-shadow 0.2s;
                }
                .inquilino-card-gradient:hover {
                    transform: scale(1.04) rotate(-1deg);
                    box-shadow:0 6px 32px rgba(0,86,166,0.18);
                }
                @keyframes gradientMove {
                    0% {background-position: 0% 50%;}
                    50% {background-position: 100% 50%;}
                    100% {background-position: 0% 50%;}
                }
        .logo-img {
            display:block;
            max-width:180px;
            margin-bottom:2rem;
        }
        .login-left h1 {
            font-size:2.3rem;
            margin-bottom:1rem;
            color:#fff;
            text-shadow:0 2px 8px rgba(0,0,0,0.08);
        }
        .login-left p {
            font-size:1.15rem;
            max-width:400px;
            line-height:1.5;
            color:#e3f6fd;
        }
        .login-right {
            flex:1;
            display:flex;
            justify-content:center;
            align-items:center;
            background:#f7fafd;
        }
        .login-card {
            width:100%;
            max-width:370px;
            background:#fff;
            border-radius:16px;
            box-shadow:0 2px 24px rgba(0,86,166,0.10);
            padding:2.5rem 2rem;
        }
        .login-card h2 {
            margin-bottom:1.5rem;
            text-align:center;
            color:#0056A6;
            font-weight:700;
        }
        .form-group {margin-bottom:1.2rem;}
        .form-group label {display:block;margin-bottom:.5rem;font-weight:500;color:#0056A6;}
        .form-control {
    width: 90%;
    padding: .7rem;
    border: 1px solid #b0bec5;
    border-radius: 6px;
    font-size: 1rem;
    background: #f7fafd;
    color: #222;
}
        .form-control:focus {
            outline:2px solid #00B4D8;
            border-color:#00B4D8;
        }
        .btn {
            width:100%;
            padding:.7rem;
            background: linear-gradient(245deg, #4AADD3 60%, #a8cb60 90%);
    
            color:#fff;
            border:none;
            border-radius:6px;
            font-size:1rem;
            font-weight:600;
            cursor:pointer;
            transition:.2s;
            box-shadow:0 2px 8px rgba(0,86,166,0.08);
        }
        .btn:hover {
            background:#003c70;
        }
        .toggle-link {
            display:block;
            text-align:center;
            margin-top:1rem;
            color:#00B4D8;
            cursor:pointer;
            font-weight:500;
        }
        .toggle-link:hover {text-decoration:underline;}
        @media (max-width:900px) {
            .login-container {flex-direction:column;}
            .login-left, .login-right {flex:none;width:100%;min-height:300px;}
            .login-left {padding:2rem;}
        }
    </style>
</head>
<body style="
    text-align: center;
    font-family: sans-serif;
">
    
    <div class="login-container">
    <div class="login-left" style="
    text-align: center;
    font-family: sans-serif;
">
        <img src="../assets/logo.png" alt="Toori360 Logo" class="logo-img" style="max-width:180px;margin-bottom:2rem;background: #333;padding: 20px;border-radius: 20%;">
        <h1 style="font-weight:800;letter-spacing:1px;">Gestión y Mantenimiento de Propiedades</h1>
        <p style="font-size:1.15rem;max-width:400px;line-height:1.5;">Toori360 es la plataforma integral para administrar, mantener y potenciar la gestión de tus propiedades. Controla mantenimientos, inquilinos, mejoras y mucho más desde un solo lugar, de forma simple y profesional.</p>
    </div>
    <div class="login-right">
        <div style="width:100%;display:flex;justify-content:center;margin-top:32px;">
            <div class="inquilino-card-gradient" id="inquilinoCard">
                <span class="inquilino-card-gradient-text" style="font-size:1.2rem;">¿Sos inquilino? <br>Iniciá sesión acá!!!</span>
            </div>
        </div>
        <div class="login-card" id="loginCard">
            <h2 id="formTitle">Iniciar Sesión</h2>
            <form id="loginForm" method="post" style="width:90%;justify-self:center;">
    <?php if ($login_error): ?>
        <div class="form-group" style="color:red;"><?= htmlspecialchars($login_error) ?></div>
    <?php endif; ?>
    <div class="form-group">
        <label for="loginEmail">Email</label>
        <input type="email" class="form-control" id="loginEmail" name="loginEmail" required>
    </div>
    <div class="form-group">
        <label for="loginPassword">Contraseña</label>
        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
    </div>
    <button type="submit" class="btn" name="login">Ingresar</button>
</form>
            <form id="loginInquilinoForm" method="post" style="display:none;width:90%;justify-self:center;">
                <?php if (isset($login_inquilino_error) && $login_inquilino_error): ?>
                    <div class="form-group" style="color:red;"> <?= htmlspecialchars($login_inquilino_error) ?> </div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="loginInquilinoDni">DNI</label>
                    <input type="text" class="form-control" id="loginInquilinoDni" name="loginInquilinoDni" required>
                </div>
                <div class="form-group">
                    <label for="loginInquilinoPropiedad">ID de Propiedad</label>
                    <input type="number" class="form-control" id="loginInquilinoPropiedad" name="loginInquilinoPropiedad" required>
                </div>
                <button type="submit" class="btn" name="loginInquilino">Ingresar como Inquilino</button>
                <span class="toggle-link" id="toggleLoginPropietario" style="margin-top:10px;">¿Sos propietario? Iniciá sesión acá</span>
            </form>
            <form id="registerForm" method="post" style="display:none;">
                <?php if($register_success): ?>
                    <div class="form-group" style="color:green;">¡Registro exitoso! Ahora puedes iniciar sesión.</div>
                <?php elseif($register_error): ?>
                    <div class="form-group" style="color:red;"><?= htmlspecialchars($register_error) ?></div>
                <?php endif; ?>
                <div class="form-group">
                    <label for="registerName">Nombre</label>
                    <input type="text" class="form-control" id="registerName" name="registerName" required>
                </div>
                <div class="form-group">
                    <label for="registerApellido">Apellido</label>
                    <input type="text" class="form-control" id="registerApellido" name="registerApellido" required>
                </div>
                <div class="form-group">
                    <label for="registerDni">DNI</label>
                    <input type="text" class="form-control" id="registerDni" name="registerDni">
                </div>
                <div class="form-group">
                    <label for="registerTelefono">Teléfono</label>
                    <input type="text" class="form-control" id="registerTelefono" name="registerTelefono">
                </div>
                <div class="form-group">
                    <label for="registerEmail">Email</label>
                    <input type="email" class="form-control" id="registerEmail" name="registerEmail" required>
                </div>
                <div class="form-group">
                    <label for="registerPassword">Contraseña</label>
                    <input type="password" class="form-control" id="registerPassword" name="registerPassword" required>
                </div>
                <button type="submit" class="btn" name="register">Registrarse</button>
            </form>
            <span class="toggle-link" id="toggleRegister">¿No tienes cuenta? Regístrate</span>
            <span class="toggle-link" id="toggleLogin" style="display:none;">¿Ya tienes cuenta? Inicia sesión</span>
        </div>
    </div>
</div>
<script>
const inquilinoCard = document.getElementById('inquilinoCard');
const loginInquilinoForm = document.getElementById('loginInquilinoForm');
const toggleLoginPropietario = document.getElementById('toggleLoginPropietario');

inquilinoCard.onclick = function() {
    loginForm.style.display = 'none';
    registerForm.style.display = 'none';
    loginInquilinoForm.style.display = 'block';
    toggleRegister.style.display = 'none';
    toggleLogin.style.display = 'none';
    formTitle.textContent = 'Inquilino: Iniciar Sesión';
};

if (toggleLoginPropietario) {
    toggleLoginPropietario.onclick = function() {
        loginForm.style.display = 'block';
        registerForm.style.display = 'none';
        loginInquilinoForm.style.display = 'none';
        toggleRegister.style.display = 'block';
        toggleLogin.style.display = 'none';
        formTitle.textContent = 'Iniciar Sesión';
    };
}
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const toggleRegister = document.getElementById('toggleRegister');
const toggleLogin = document.getElementById('toggleLogin');
const formTitle = document.getElementById('formTitle');

toggleRegister.onclick = function() {
    loginForm.style.display = 'none';
    registerForm.style.display = 'block';
    toggleRegister.style.display = 'none';
    toggleLogin.style.display = 'block';
    formTitle.textContent = 'Crear Cuenta';
};

toggleLogin.onclick = function() {
    loginForm.style.display = 'block';
    registerForm.style.display = 'none';
    toggleRegister.style.display = 'block';
    toggleLogin.style.display = 'none';
    formTitle.textContent = 'Iniciar Sesión';
};
// Mostrar form correcto si hubo error/éxito en PHP
<?php if ($register_error || $register_success): ?>
    toggleRegister.onclick();
<?php endif; ?>
<?php if ($login_error): ?>
    // ya está visible por defecto
<?php endif; ?>
</script>
</body>
</html>