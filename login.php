<?php include __DIR__ . '/includes/supabase.php'; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - Toori ServiciosYa</title>
    <meta name="description"
        content="Iniciá sesión en tu cuenta de Toori para gestionar tus servicios o tu perfil profesional.">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <!-- Main CSS -->
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">

    <!-- Variables de color -->
    <style>
        :root {
            --toori-blue: #00c2cb;
            --toori-purple: #6b5dfc;
        }

        body {
    background-color: #f8fafc;
    margin: 0;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

.login-container {
    display: flex;
    flex-direction: column;
    justify-content: center; /* centra verticalmente */
    align-items: center;     /* centra horizontalmente */
    min-height: 100vh;
    padding: 20px;
}
        .login-card {
            background: white;
            border-radius: 24px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
            width: 100%;
            max-width: 450px;
        }

        .form-control {
            padding: 12px 20px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }

        .form-control:focus {
            background-color: white;
            border-color: var(--toori-blue);
            box-shadow: 0 0 0 4px rgba(0, 194, 203, 0.1);
        }

        .btn-auth {
            padding: 14px;
            border-radius: 12px;
            font-weight: 600;
            width: 100%;
        }

        .nav-tabs .nav-link {
            border: none;
            color: #64748b;
            font-weight: 600;
            padding: 15px 20px;
            background: transparent;
        }

        .nav-tabs .nav-link.active {
            color: var(--toori-blue);
            border-bottom: 3px solid var(--toori-blue);
            background: transparent;
        }
    </style>
</head>

<body>

<div class="login-container">
    <div class="text-center mb-4">
        <a href="./">
            <img src="assets/logo.png" alt="Toori Logo" style="height: 180px;">
        </a>
    </div>

    <div class="login-card">
            <!-- Tabs -->
            <ul class="nav nav-tabs justify-content-center mb-4" id="authTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login-pane"
                        type="button" role="tab">Iniciar sesión</button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="authTabsContent">

                <!-- Login Form -->
                <div class="tab-pane fade show active" id="login-pane" role="tabpanel" tabindex="0">
                    <div id="login-error" class="alert alert-danger d-none"></div>
                    <form id="login-form">
                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold">Correo Electrónico</label>
                            <input type="email" class="form-control" id="login-email" placeholder="tu@correo.com"
                                required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted fw-bold">Contraseña</label>
                            <input type="password" class="form-control" id="login-password" placeholder="••••••••"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-auth" id="login-btn">
                            Ingresar a mi cuenta
                        </button>
                    </form>
                </div>

            </div>

            <div class="text-center mt-4">
                <p class="text-muted small mb-2">¿Todavía no tienes cuenta?</p>
                <div class="d-flex flex-column gap-2">
                    <a href="https://wa.me/5493512139046?text=Hola!%20Quiero%20contratar%20un%20servicio"
                        target="_blank" class="btn btn-outline-primary btn-sm rounded-pill fw-bold">
                        <i class="bi bi-person-heart me-1"></i> Quiero Contratar (Cliente)
                    </a>
                    <a href="/registro.php" class="btn btn-outline-secondary btn-sm rounded-pill fw-bold">
                        <i class="bi bi-tools me-1"></i> Quiero Ofrecer Servicios (Trabajador)
                    </a>
                </div>
                <hr class="my-4 opacity-25">
                <a href="/" class="text-decoration-none" style="color: var(--toori-purple); font-weight: 600;"><i
                        class="bi bi-arrow-left"></i> Volver al inicio</a>
            </div>
        </div>

        
    </div>
<!-- Footer -->
        <?php include 'footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Login Script Supabase -->
    <script>
        document.addEventListener('DOMContentLoaded', async () => {

            const loginForm = document.getElementById('login-form');
            const loginError = document.getElementById('login-error');

            // 1️⃣ Revisar si ya hay sesión activa
            const { data: { session }, error } = await supabaseClient.auth.getSession();
            if (error) console.error(error);
            if (session) {
                window.location.href = 'perfil.php';
                return;
            }

            // 2️⃣ Manejo del formulario de login
            loginForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                loginError.classList.add('d-none'); // ocultar errores previos

                const email = document.getElementById('login-email').value;
                const password = document.getElementById('login-password').value;

                const { data, error } = await supabaseClient.auth.signInWithPassword({ email, password });

                if (error) {
                    loginError.textContent = error.message;
                    loginError.classList.remove('d-none');
                } else {
                    window.location.href = 'perfil.php';
                }
            });

        });
    </script>

</body>

</html>