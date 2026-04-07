<?php include __DIR__ . '/includes/supabase.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - Toori ServiciosYa</title>
    <meta name="description" content="Inicia sesion en tu cuenta de Toori para gestionar tus servicios o tu perfil profesional.">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">

    <style>
        body { margin: 0; }

        .login-split {
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 100vh;
        }

        /* Panel izquierdo: visual */
        .login-visual {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 48px;
        }

        .login-visual-bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            animation: kenBurnsLogin 20s ease-in-out infinite alternate;
        }

        @keyframes kenBurnsLogin {
            0% { transform: scale(1); }
            100% { transform: scale(1.1) translate(-1%, -1%); }
        }

        .login-visual::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(15,12,41,0.4) 0%, rgba(15,12,41,0.85) 100%);
            z-index: 1;
        }

        .login-visual-content {
            position: relative;
            z-index: 2;
            color: white;
        }

        .login-visual-content h2 {
            font-size: 2.2rem;
            color: white;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        .login-visual-content p {
            color: rgba(255,255,255,0.7);
            font-size: 1rem;
            max-width: 380px;
            line-height: 1.6;
            margin-bottom: 28px;
        }

        .login-visual-features {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .login-visual-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.8);
            font-size: 0.92rem;
        }

        .login-visual-feature i {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            color: var(--toori-green);
            flex-shrink: 0;
        }

        /* Panel derecho: formulario */
        .login-form-panel {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 48px 40px;
            background: #f8fafc;
        }

        .login-form-inner {
            width: 100%;
            max-width: 400px;
        }

        .login-logo {
            text-align: center;
            margin-bottom: 36px;
        }

        .login-logo img {
            height: 80px;
            margin-bottom: 12px;
        }

        .login-logo h1 {
            font-size: 1.4rem;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .login-logo p {
            color: var(--text-muted);
            font-size: 0.9rem;
        }

        .login-card {
            background: white;
            border-radius: 20px;
            padding: 36px 32px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.04);
        }

        .login-card .form-label {
            font-weight: 600;
            font-size: 0.88rem;
            color: #444;
            margin-bottom: 6px;
        }

        .login-card .form-control {
            padding: 13px 16px;
            border-radius: 14px;
            border: 2px solid #e8ecf1;
            background: #fafbfc;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .login-card .form-control:focus {
            border-color: var(--toori-blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(59,168,224,0.08);
        }

        .login-card .input-group {
            position: relative;
        }

        .login-card .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #aab;
            z-index: 4;
            font-size: 1rem;
        }

        .login-card .form-control.with-icon {
            padding-left: 44px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            background: var(--toori-blue);
            color: white;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 14px rgba(59,168,224,0.3);
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59,168,224,0.4);
        }

        .btn-login:active {
            transform: scale(0.98);
        }

        .login-divider {
            display: flex;
            align-items: center;
            gap: 16px;
            margin: 24px 0;
            color: #ccc;
            font-size: 0.82rem;
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e8ecf1;
        }

        .login-alt-buttons {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .btn-alt {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 12px;
            border-radius: 14px;
            border: 2px solid #e8ecf1;
            background: white;
            color: var(--text-main);
            font-size: 0.9rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-alt:hover {
            border-color: var(--toori-blue);
            background: rgba(59,168,224,0.03);
            color: var(--toori-blue);
        }

        .btn-alt i {
            font-size: 1.1rem;
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
        }

        .login-footer a {
            color: var(--toori-blue);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .login-footer a:hover {
            color: var(--toori-purple);
        }

        /* Error alert */
        .login-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 0.9rem;
            margin-bottom: 16px;
            display: none;
        }

        .login-error.show {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .login-error i {
            font-size: 1.1rem;
            flex-shrink: 0;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .login-split {
                grid-template-columns: 1fr;
            }

            .login-visual {
                min-height: 260px;
                padding: 32px 24px;
            }

            .login-visual-content h2 {
                font-size: 1.6rem;
            }

            .login-visual-features {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .login-form-panel {
                padding: 32px 20px;
            }

            .login-card {
                padding: 28px 20px;
            }

            .login-visual {
                min-height: 200px;
            }
        }
    </style>
</head>

<body>

<div class="login-split">
    <!-- Panel visual izquierdo -->
    <div class="login-visual">
        <div class="login-visual-bg" style="background-image: url('https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg?auto=compress&cs=tinysrgb&w=1200&h=800&fit=crop');"></div>
        <div class="login-visual-content">
            <h2>La plataforma que conecta hogares con profesionales</h2>
            <p>Ingresa a tu cuenta y gestiona tus servicios de manera simple y segura.</p>
            <div class="login-visual-features">
                <div class="login-visual-feature">
                    <i class="bi bi-shield-check"></i>
                    <span>Prestadores verificados con documentacion</span>
                </div>
                <div class="login-visual-feature">
                    <i class="bi bi-lightning"></i>
                    <span>Recibe ofertas en minutos</span>
                </div>
                <div class="login-visual-feature">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>Mas de 500 servicios realizados</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel formulario derecho -->
    <div class="login-form-panel">
        <div class="login-form-inner">
            <div class="login-logo">
                <a href="./"><img src="assets/logo.png" alt="Toori Logo"></a>
                <h1>Bienvenido de vuelta</h1>
                <p>Ingresa a tu cuenta de Toori ServiciosYa</p>
            </div>

            <div class="login-card">
                <div class="login-error" id="login-error">
                    <i class="bi bi-exclamation-circle"></i>
                    <span id="login-error-text"></span>
                </div>

                <form id="login-form">
                    <div class="mb-3">
                        <label class="form-label">Correo electronico</label>
                        <div class="input-group">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" class="form-control with-icon" id="login-email" placeholder="tu@correo.com" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contrasena</label>
                        <div class="input-group">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" class="form-control with-icon" id="login-password" placeholder="Tu contrasena" required>
                        </div>
                    </div>
                    <button type="submit" class="btn-login" id="login-btn">
                        Ingresar a mi cuenta
                    </button>
                </form>

                <div class="login-divider">o tambien podes</div>

                <div class="login-alt-buttons">
                    <a href="https://wa.me/5493512139046?text=Hola!%20Quiero%20contratar%20un%20servicio" target="_blank" class="btn-alt">
                        <i class="bi bi-whatsapp" style="color:#25d366;"></i> Contratar un servicio (Cliente)
                    </a>
                    <a href="registro.php" class="btn-alt">
                        <i class="bi bi-tools" style="color:var(--toori-purple);"></i> Registrarme como profesional
                    </a>
                </div>
            </div>

            <div class="login-footer">
                <a href="./"><i class="bi bi-arrow-left"></i> Volver al inicio</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const loginForm = document.getElementById('login-form');
    const loginError = document.getElementById('login-error');
    const loginErrorText = document.getElementById('login-error-text');
    const loginBtn = document.getElementById('login-btn');

    // Revisar si ya hay sesion activa
    const { data: { session }, error } = await supabaseClient.auth.getSession();
    if (error) console.error(error);
    if (session) {
        window.location.href = 'perfil.php';
        return;
    }

    function traducirError(msg) {
        if (!msg) return 'Error desconocido';
        if (msg.includes('Invalid login')) return 'Email o contrasena incorrectos';
        if (msg.includes('Email not confirmed')) return 'Confirma tu email antes de ingresar';
        return msg;
    }

    loginForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        loginError.classList.remove('show');
        loginBtn.disabled = true;
        loginBtn.innerHTML = '<i class="bi bi-arrow-repeat spin" style="display:inline-block;animation:spin 1s linear infinite;"></i> Ingresando...';

        const email = document.getElementById('login-email').value;
        const password = document.getElementById('login-password').value;

        const { data, error } = await supabaseClient.auth.signInWithPassword({ email, password });

        if (error) {
            loginErrorText.textContent = traducirError(error.message);
            loginError.classList.add('show');
            loginBtn.disabled = false;
            loginBtn.textContent = 'Ingresar a mi cuenta';
        } else {
            window.location.href = 'perfil.php';
        }
    });
});
</script>

<style>@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}</style>

</body>
</html>
