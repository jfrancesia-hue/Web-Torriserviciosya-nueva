<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: perfil.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Trabajador - Toori ServiciosYa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background: linear-gradient(135deg, #f0f4ff 0%, #f8fafc 50%, #eef9f0 100%);
            min-height: 100vh;
        }

        .registro-hero {
            background: linear-gradient(135deg, var(--toori-dark) 0%, #2d3054 100%);
            padding: 100px 0 60px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .registro-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 50% 60% at 20% 40%, rgba(59,168,224,0.15) 0%, transparent 60%),
                radial-gradient(ellipse 40% 50% at 80% 60%, rgba(174,205,90,0.1) 0%, transparent 60%);
            pointer-events: none;
        }

        .registro-hero h1 {
            color: white;
            font-size: 2.4rem;
            margin-bottom: 12px;
            position: relative;
        }

        .registro-hero p {
            color: rgba(255,255,255,0.7);
            font-size: 1.1rem;
            max-width: 500px;
            margin: 0 auto;
            position: relative;
        }

        /* Stepper */
        .stepper {
            display: flex;
            justify-content: center;
            gap: 0;
            margin: -30px auto 40px;
            position: relative;
            z-index: 2;
            max-width: 500px;
            padding: 0 20px;
        }

        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }

        .step-indicator:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 22px;
            left: 55%;
            width: 90%;
            height: 3px;
            background: #e0e0e0;
            z-index: 0;
            transition: background 0.4s;
        }

        .step-indicator.completed:not(:last-child)::after {
            background: var(--toori-green);
        }

        .step-dot {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: white;
            border: 3px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            color: #999;
            position: relative;
            z-index: 1;
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }

        .step-indicator.active .step-dot {
            border-color: var(--toori-blue);
            color: var(--toori-blue);
            box-shadow: 0 4px 16px rgba(59,168,224,0.25);
            transform: scale(1.1);
        }

        .step-indicator.completed .step-dot {
            border-color: var(--toori-green);
            background: var(--toori-green);
            color: white;
        }

        .step-label {
            font-size: 0.75rem;
            color: #999;
            margin-top: 8px;
            font-weight: 500;
            transition: color 0.3s;
        }

        .step-indicator.active .step-label {
            color: var(--toori-blue);
            font-weight: 600;
        }

        .step-indicator.completed .step-label {
            color: var(--toori-green);
        }

        /* Form Card */
        .registro-card {
            max-width: 680px;
            width: 100%;
            margin: 0 auto;
            padding: 44px 40px;
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.06);
            border: 1px solid rgba(0,0,0,0.04);
        }

        /* Steps content */
        .step-content {
            display: none;
        }

        .step-content.active {
            display: block;
            animation: fadeInUp 0.4s ease-out;
        }

        .step-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 6px;
        }

        .step-desc {
            font-size: 0.92rem;
            color: var(--text-muted);
            margin-bottom: 28px;
        }

        /* Form styling */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 6px;
        }

        .form-group label .optional {
            color: #aaa;
            font-weight: 400;
            font-size: 0.82em;
        }

        .form-control {
            width: 100%;
            padding: 13px 16px;
            border-radius: 14px;
            border: 2px solid #e8ecf1;
            font-size: 0.95rem;
            font-family: var(--font-body);
            background: #fafbfc;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--toori-blue);
            background: white;
            box-shadow: 0 0 0 4px rgba(59,168,224,0.08);
        }

        .form-control::placeholder {
            color: #bbb;
        }

        select.form-control {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23999' viewBox='0 0 16 16'%3E%3Cpath d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        /* Profile photo */
        .photo-upload {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .profile-preview {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 3px dashed #d0d5dd;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            cursor: pointer;
            position: relative;
            transition: all 0.3s;
            background: #f8fafc;
        }

        .profile-preview:hover {
            border-color: var(--toori-blue);
            background: rgba(59,168,224,0.04);
        }

        .profile-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #preview-placeholder {
            font-size: 2rem;
            color: #ccc;
            transition: color 0.3s;
        }

        .profile-preview:hover #preview-placeholder {
            color: var(--toori-blue);
        }

        .photo-label {
            font-size: 0.82rem;
            color: var(--text-muted);
        }

        /* File upload styled */
        .file-upload-area {
            border: 2px dashed #e0e5eb;
            border-radius: 14px;
            padding: 16px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            background: #fafbfc;
        }

        .file-upload-area:hover {
            border-color: var(--toori-blue);
            background: rgba(59,168,224,0.03);
        }

        .file-upload-area i {
            font-size: 1.5rem;
            color: var(--toori-blue);
            display: block;
            margin-bottom: 6px;
        }

        .file-upload-area span {
            font-size: 0.82rem;
            color: #888;
        }

        .file-upload-area .file-name {
            font-size: 0.82rem;
            color: var(--toori-green);
            font-weight: 600;
            margin-top: 4px;
        }

        /* Alert */
        .alert {
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: none;
            font-size: 0.92rem;
        }

        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #b7dfca; }
        .alert-error { background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; }

        /* Buttons */
        .btn-step {
            padding: 14px 32px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .btn-next {
            background: var(--toori-blue);
            color: white;
            box-shadow: 0 4px 14px rgba(59,168,224,0.3);
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59,168,224,0.4);
        }

        .btn-back {
            background: #f1f5f9;
            color: #555;
        }

        .btn-back:hover {
            background: #e2e8f0;
        }

        .btn-submit {
            background: linear-gradient(135deg, var(--toori-green), #8fba40);
            color: white;
            box-shadow: 0 4px 14px rgba(174,205,90,0.3);
            width: 100%;
            padding: 16px;
            font-size: 1.05rem;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(174,205,90,0.4);
        }

        .step-buttons {
            display: flex;
            justify-content: space-between;
            gap: 12px;
            margin-top: 28px;
        }

        /* Checkbox */
        .checkbox-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            margin-bottom: 16px;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-top: 2px;
            accent-color: var(--toori-blue);
            flex-shrink: 0;
        }

        .checkbox-wrapper label {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 0;
        }

        /* Verificado tip */
        .verificado-tip {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            background: linear-gradient(135deg, #eaf7f0, #f0faf5);
            border: 1px solid #b2dfce;
            border-radius: 14px;
            padding: 16px;
            margin-bottom: 20px;
        }

        .verificado-tip i {
            font-size: 1.3rem;
            color: #27ae60;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .verificado-tip p {
            margin: 0;
            color: #1a7a4a;
            font-size: 0.88rem;
            line-height: 1.5;
        }

        /* Modal bienvenida */
        .toori-bienvenida-modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0; top: 0; width: 100vw; height: 100vh;
            background: rgba(0,0,0,0.4);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
        }

        .toori-bienvenida-modal-show { display: flex; }

        .toori-bienvenida-modal-content {
            background: #fff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
            min-width: 320px;
            max-width: 95vw;
            width: 420px;
            overflow: hidden;
        }

        .toori-bienvenida-modal-header {
            background: linear-gradient(135deg, var(--toori-blue), #178abf);
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .toori-bienvenida-modal-title { color: #fff; font-size: 1.3rem; font-weight: 700; }
        .toori-bienvenida-modal-close { background: none; border: none; color: rgba(255,255,255,0.8); font-size: 1.8rem; cursor: pointer; }
        .toori-bienvenida-modal-body { text-align: center; padding: 28px 24px 16px; }

        .toori-bienvenida-modal-footer {
            display: flex;
            justify-content: center;
            gap: 12px;
            padding: 16px 24px 24px;
        }

        .toori-bienvenida-btn-principal {
            background: var(--toori-blue);
            color: #fff;
            border: none;
            border-radius: 14px;
            padding: 12px 28px;
            font-size: 1rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s;
        }

        .toori-bienvenida-btn-principal:hover { transform: translateY(-2px); color: #fff; }

        .toori-bienvenida-btn-secundario {
            background: none;
            color: var(--toori-blue);
            border: 2px solid var(--toori-blue);
            border-radius: 14px;
            padding: 12px 28px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .registro-hero { padding: 90px 20px 50px; }
            .registro-hero h1 { font-size: 1.8rem; }
            .registro-card { padding: 28px 20px; margin: 0 16px; }
            .form-grid-2, .form-grid-3 { grid-template-columns: 1fr; }
            .stepper { margin: -24px auto 28px; }
            .step-dot { width: 38px; height: 38px; font-size: 0.85rem; }
            .step-label { font-size: 0.68rem; }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
        const supabaseUrl = "https://dhhhftzdfpqthzvkrqoz.supabase.co";
        const supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ";
        window.supabaseClient = supabase.createClient(supabaseUrl, supabaseKey);
    </script>
</head>
<body>

<?php include 'header.php'; ?>

<!-- Hero -->
<div class="registro-hero">
    <h1>Sumate a nuestra red</h1>
    <p>Postulate para formar parte de los profesionales gestionados por Toori</p>
</div>

<!-- Stepper -->
<div class="stepper">
    <div class="step-indicator active" data-step="1">
        <div class="step-dot">1</div>
        <span class="step-label">Datos</span>
    </div>
    <div class="step-indicator" data-step="2">
        <div class="step-dot">2</div>
        <span class="step-label">Ubicacion</span>
    </div>
    <div class="step-indicator" data-step="3">
        <div class="step-dot">3</div>
        <span class="step-label">Profesion</span>
    </div>
</div>

<!-- Form -->
<main style="padding: 0 0 80px;">
    <div class="registro-card">

        <!-- Modal de Bienvenida -->
        <div id="toori-bienvenida-modal" class="toori-bienvenida-modal">
            <div class="toori-bienvenida-modal-content">
                <div class="toori-bienvenida-modal-header">
                    <span class="toori-bienvenida-modal-title">Bienvenido!</span>
                    <button class="toori-bienvenida-modal-close" id="toori-cerrarBienvenida" aria-label="Cerrar">&times;</button>
                </div>
                <div class="toori-bienvenida-modal-body">
                    <div style="font-size:2.5rem; margin-bottom:12px;">🎉</div>
                    <p><strong>Felicidades!</strong> Ahora sos parte del equipo de profesionales de <b>Toori ServiciosYa</b>.<br><br>
                        Cada vez que un cliente necesite tus servicios, aparecera en la pestaña <b>"Ofertas"</b> y te llegara un mensaje a tu WhatsApp.<br><br>
                        Visita tu perfil por si queres agregar algun dato o corregir algo.</p>
                </div>
                <div class="toori-bienvenida-modal-footer">
                    <a href="perfil.php" class="toori-bienvenida-btn-principal">Ir a mi perfil</a>
                    <button class="toori-bienvenida-btn-secundario" id="toori-cerrarBienvenida2">Cerrar</button>
                </div>
            </div>
        </div>

        <div id="reg-alert" class="alert"></div>

        <form id="registro-form">

            <!-- PASO 1: Datos personales -->
            <div class="step-content active" data-step="1">
                <div class="step-title">Datos personales</div>
                <div class="step-desc">Contanos sobre vos para crear tu perfil</div>

                <div class="form-grid-2">
                    <div class="form-group photo-upload" style="grid-column: 1 / -1;">
                        <div class="profile-preview" id="profile-preview">
                            <img src="" alt="Preview" id="preview-img" style="display:none;">
                            <div id="preview-placeholder"><i class="bi bi-camera"></i></div>
                        </div>
                        <span class="photo-label">Subi tu foto de perfil</span>
                        <input type="file" id="reg-foto" accept="image/*" style="display:none;">
                    </div>

                    <div class="form-group">
                        <label>Nombre y apellido</label>
                        <input type="text" id="reg-nombre" class="form-control" placeholder="Ej: Juan Perez" required>
                    </div>
                    <div class="form-group">
                        <label>DNI</label>
                        <input type="text" id="reg-dni" class="form-control" placeholder="Ej: 35.678.901" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="reg-email" class="form-control" placeholder="tu@correo.com" required>
                    </div>
                    <div class="form-group">
                        <label>Contrasena</label>
                        <input type="password" id="reg-password" class="form-control" placeholder="Minimo 6 caracteres" required minlength="6">
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Edad</label>
                        <input type="number" id="reg-edad" class="form-control" placeholder="Ej: 30">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="tel" id="reg-celular" class="form-control" placeholder="Ej: 3512345678">
                    </div>
                </div>

                <div class="step-buttons" style="justify-content: flex-end;">
                    <button type="button" class="btn-step btn-next" onclick="nextStep(2)">Siguiente <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- PASO 2: Ubicacion -->
            <div class="step-content" data-step="2">
                <div class="step-title">Tu ubicacion</div>
                <div class="step-desc">Necesitamos saber donde operas para conectarte con clientes cercanos</div>

                <div class="form-grid-3">
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" id="reg-ciudad" class="form-control" placeholder="Ej: San Fernando" required>
                    </div>
                    <div class="form-group">
                        <label>Provincia</label>
                        <input type="text" id="reg-provincia" class="form-control" placeholder="Ej: Catamarca">
                    </div>
                    <div class="form-group">
                        <label>Barrio</label>
                        <input type="text" id="reg-barrio" class="form-control" placeholder="Ej: Centro">
                    </div>
                </div>

                <div class="step-buttons">
                    <button type="button" class="btn-step btn-back" onclick="prevStep(1)"><i class="bi bi-arrow-left"></i> Atras</button>
                    <button type="button" class="btn-step btn-next" onclick="nextStep(3)">Siguiente <i class="bi bi-arrow-right"></i></button>
                </div>
            </div>

            <!-- PASO 3: Profesion y docs -->
            <div class="step-content" data-step="3">
                <div class="step-title">Tu profesion</div>
                <div class="step-desc">Selecciona tu especialidad y subi documentacion para ser verificado</div>

                <div class="form-group">
                    <label>En que te especializas?</label>
                    <select id="reg-profesion" class="form-control" required>
                        <option value="">Cargando categorias...</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Anos de experiencia</label>
                    <input type="number" id="reg-antiguedad" class="form-control" value="1" min="0" placeholder="Ej: 5">
                </div>

                <div class="verificado-tip">
                    <i class="bi bi-patch-check-fill"></i>
                    <p><strong>Subi tu matricula y antecedentes</strong> para convertirte en prestador verificado, con mayor visibilidad y confianza ante los clientes.</p>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Matricula profesional <span class="optional">(opcional)</span></label>
                        <div class="file-upload-area" id="matricula-area" onclick="document.getElementById('reg-matricula-pdf').click()">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span>Click para subir PDF</span>
                            <div class="file-name" id="matricula-name"></div>
                        </div>
                        <input type="file" id="reg-matricula-pdf" accept="application/pdf" style="display:none;">
                    </div>
                    <div class="form-group">
                        <label>Antecedentes penales <span class="optional">(opcional)</span></label>
                        <div class="file-upload-area" id="antecedentes-area" onclick="document.getElementById('reg-antecedentes-pdf').click()">
                            <i class="bi bi-file-earmark-pdf"></i>
                            <span>Click para subir PDF</span>
                            <div class="file-name" id="antecedentes-name"></div>
                        </div>
                        <input type="file" id="reg-antecedentes-pdf" accept="application/pdf" style="display:none;">
                    </div>
                </div>

                <div class="checkbox-wrapper">
                    <input type="checkbox" id="reg-terminos" required>
                    <label for="reg-terminos">Acepto los <a href="/Terminos-y-condiciones.php" style="color:var(--toori-blue);font-weight:600;">Terminos y Condiciones</a></label>
                </div>

                <button type="submit" class="btn-step btn-submit" id="btn-submit">
                    <i class="bi bi-check-circle me-2"></i> Crear mi cuenta
                </button>

                <div class="step-buttons" style="margin-top:12px;">
                    <button type="button" class="btn-step btn-back" onclick="prevStep(2)"><i class="bi bi-arrow-left"></i> Atras</button>
                    <div></div>
                </div>
            </div>

        </form>
    </div>
</main>

<?php include 'footer.php'; ?>

<!-- Floating WhatsApp -->
<a href="https://wa.me/5493512139046?text=Hola!%20Necesito%20ayuda%20con%20Toori" class="floating-wa"
    target="_blank" rel="noopener noreferrer">
    <i class="bi bi-whatsapp"></i>
</a>

<script>
// === STEPPER ===
let currentStep = 1;

function goToStep(step) {
    document.querySelectorAll('.step-content').forEach(s => s.classList.remove('active'));
    document.querySelector(`.step-content[data-step="${step}"]`).classList.add('active');

    document.querySelectorAll('.step-indicator').forEach(ind => {
        const s = parseInt(ind.dataset.step);
        ind.classList.remove('active', 'completed');
        if (s === step) ind.classList.add('active');
        else if (s < step) ind.classList.add('completed');
    });

    currentStep = step;
    window.scrollTo({ top: 300, behavior: 'smooth' });
}

function nextStep(step) {
    // Validacion basica antes de avanzar
    if (currentStep === 1) {
        const nombre = document.getElementById('reg-nombre').value.trim();
        const email = document.getElementById('reg-email').value.trim();
        const pass = document.getElementById('reg-password').value;
        if (!nombre || !email || !pass) {
            showAlert('Completa nombre, email y contrasena para continuar.', 'error');
            return;
        }
        if (pass.length < 6) {
            showAlert('La contrasena debe tener al menos 6 caracteres.', 'error');
            return;
        }
    }
    if (currentStep === 2) {
        const ciudad = document.getElementById('reg-ciudad').value.trim();
        if (!ciudad) {
            showAlert('La ciudad es obligatoria.', 'error');
            return;
        }
    }
    hideAlert();
    goToStep(step);
}

function prevStep(step) {
    hideAlert();
    goToStep(step);
}

function showAlert(msg, type) {
    const a = document.getElementById('reg-alert');
    a.className = 'alert alert-' + type;
    a.textContent = msg;
    a.style.display = 'block';
    a.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function hideAlert() {
    document.getElementById('reg-alert').style.display = 'none';
}

// === FILE UPLOAD DISPLAY ===
document.getElementById('reg-matricula-pdf').addEventListener('change', function() {
    document.getElementById('matricula-name').textContent = this.files[0] ? this.files[0].name : '';
});

document.getElementById('reg-antecedentes-pdf').addEventListener('change', function() {
    document.getElementById('antecedentes-name').textContent = this.files[0] ? this.files[0].name : '';
});

// === REDIRECT IF LOGGED IN ===
document.addEventListener('DOMContentLoaded', async () => {
    const { data: { session } } = await window.supabaseClient.auth.getSession();
    if (session) {
        window.location.href = 'perfil.php';
        return;
    }
});

// === LOAD CATEGORIES + FORM SUBMIT ===
document.addEventListener('DOMContentLoaded', async () => {
    const alertDiv = document.getElementById('reg-alert');
    const select = document.getElementById('reg-profesion');

    const { data: categorias, error } = await window.supabaseClient
        .from('categorias')
        .select('nombre')
        .order('nombre', { ascending: true });

    if (error) {
        select.innerHTML = '<option value="">Error al cargar categorias</option>';
        return;
    }

    select.innerHTML = '<option value="">Selecciona una opcion...</option>';
    categorias.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.nombre;
        option.textContent = cat.nombre;
        select.appendChild(option);
    });

    // --- Preview foto ---
    const previewDiv = document.getElementById('profile-preview');
    const fileInput = document.getElementById('reg-foto');
    const previewImg = document.getElementById('preview-img');
    const placeholder = document.getElementById('preview-placeholder');

    previewDiv.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', () => {
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                placeholder.style.display = 'none';
            }
            reader.readAsDataURL(fileInput.files[0]);
        }
    });

    // --- Form submit ---
    document.getElementById('registro-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const btnSubmit = document.getElementById('btn-submit');
        btnSubmit.disabled = true;
        btnSubmit.innerHTML = '<i class="bi bi-arrow-repeat spin me-2"></i> Registrando...';

        const email = document.getElementById('reg-email').value;
        const password = document.getElementById('reg-password').value;

        function traducirError(mensaje) {
            if (!mensaje) return '';
            if (mensaje.includes('User already registered')) return 'El email ya esta registrado.';
            if (mensaje.includes('Invalid login credentials')) return 'Credenciales invalidas.';
            if (mensaje.includes('Password should be at least')) return 'La contrasena debe tener al menos 6 caracteres.';
            if (mensaje.includes('invalid email')) return 'El email no es valido.';
            if (mensaje.includes('malformed array literal')) return 'Error interno: formato de categoria incorrecto.';
            return mensaje;
        }

        const ciudadVal = document.getElementById('reg-ciudad').value || '';
        if (String(ciudadVal).trim() === '') {
            showAlert('Por favor indica la Ciudad (es obligatoria).', 'error');
            btnSubmit.disabled = false;
            btnSubmit.innerHTML = '<i class="bi bi-check-circle me-2"></i> Crear mi cuenta';
            return;
        }

        const { data: authData, error: authError } = await window.supabaseClient.auth.signUp({
            email: email,
            password: password
        });

        if (authError) {
            showAlert('Error de registro: ' + traducirError(authError.message), 'error');
            btnSubmit.disabled = false;
            btnSubmit.innerHTML = '<i class="bi bi-check-circle me-2"></i> Crear mi cuenta';
            return;
        }

        const user_id = authData.user.id;
        let fotoUrl = null;
        let matriculaUrl = null;
        let antecedentesUrl = null;

        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const fileName = `${user_id}-perfil-${Date.now()}`;
            const { data: storageData, error: storageError } = await window.supabaseClient
                .storage.from('imagenes').upload(fileName, file);
            if (storageError) {
                showAlert('Error al subir la foto: ' + storageError.message, 'error');
                btnSubmit.disabled = false;
                btnSubmit.innerHTML = '<i class="bi bi-check-circle me-2"></i> Crear mi cuenta';
                return;
            }
            fotoUrl = `${supabaseUrl}/storage/v1/object/public/imagenes/${fileName}`;
        }

        const matriculaInput = document.getElementById('reg-matricula-pdf');
        if (matriculaInput.files.length > 0) {
            const file = matriculaInput.files[0];
            const fileName = `${user_id}-matricula-${Date.now()}.pdf`;
            const { error: storageError } = await window.supabaseClient
                .storage.from('imagenes').upload(fileName, file);
            if (!storageError) {
                matriculaUrl = `${supabaseUrl}/storage/v1/object/public/imagenes/${fileName}`;
            }
        }

        const antecedentesInput = document.getElementById('reg-antecedentes-pdf');
        if (antecedentesInput.files.length > 0) {
            const file = antecedentesInput.files[0];
            const fileName = `${user_id}-antecedentes-${Date.now()}.pdf`;
            const { error: storageError } = await window.supabaseClient
                .storage.from('imagenes').upload(fileName, file);
            if (!storageError) {
                antecedentesUrl = `${supabaseUrl}/storage/v1/object/public/imagenes/${fileName}`;
            }
        }

        const verificado = !!(matriculaUrl && antecedentesUrl);

        const data = {
            id: user_id,
            nombre: document.getElementById('reg-nombre').value,
            dni: document.getElementById('reg-dni').value,
            email: document.getElementById('reg-email').value,
            edad: parseInt(document.getElementById('reg-edad').value) || null,
            celular: document.getElementById('reg-celular').value || null,
            ciudad: document.getElementById('reg-ciudad').value || null,
            provincia: document.getElementById('reg-provincia') ? document.getElementById('reg-provincia').value || null : null,
            barrio: document.getElementById('reg-barrio').value || null,
            categoria: [document.getElementById('reg-profesion').value],
            matricula: matriculaUrl,
            antecedentes: antecedentesUrl,
            verificado: verificado,
            antiguedad: parseInt(document.getElementById('reg-antiguedad').value) || 0,
            rol: 'worker',
            foto_perfil: fotoUrl
        };

        const { error: insertError } = await window.supabaseClient.from('usuarios').insert([data]);

        if (insertError) {
            showAlert('Error al guardar perfil: ' + traducirError(insertError.message), 'error');
            btnSubmit.disabled = false;
            btnSubmit.innerHTML = '<i class="bi bi-check-circle me-2"></i> Crear mi cuenta';
        } else {
            window.location.href = 'registro-completado.php';
        }
    });
});

// === MODAL BIENVENIDA ===
document.addEventListener('DOMContentLoaded', function() {
    function cerrarModalBienvenida() {
        document.getElementById('toori-bienvenida-modal').classList.remove('toori-bienvenida-modal-show');
    }
    document.getElementById('toori-cerrarBienvenida').onclick = cerrarModalBienvenida;
    document.getElementById('toori-cerrarBienvenida2').onclick = cerrarModalBienvenida;
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalBienvenida();
    });
    document.getElementById('toori-bienvenida-modal').addEventListener('click', function(e) {
        if (e.target === this) cerrarModalBienvenida();
    });
});

// Spin animation
document.head.insertAdjacentHTML('beforeend', '<style>@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}.spin{animation:spin 1s linear infinite;display:inline-block;}</style>');
</script>

</body>
</html>
