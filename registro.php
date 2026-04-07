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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/main-D3W1u2cc.css">
    
    <!-- Agregar CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Agregar JS de Bootstrap acá -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body { background-color: #f8fafc; font-family: 'Plus Jakarta Sans', sans-serif; }
        .container { padding: 60px 0; display: flex; justify-content: center; }
        .card-premium { max-width: 650px; width: 100%; padding: 50px; background: white; border-radius: 24px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);}
        .form-group { margin-bottom: 20px; }
        .form-control { width: 100%; padding: 12px 15px; border-radius: 12px; border: 1px solid #ccc; }
        select.form-control { cursor: pointer; }
        .alert { padding: 10px; border-radius: 5px; margin-bottom: 20px; display:none; }
        .alert-success { background-color: #d4edda; color: #155724; }
        .alert-error { background-color: #f8d7da; color: #721c24; }
        .profile-preview {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    border: 2px dashed #ccc;
    margin: 0 auto 10px auto;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    cursor: pointer;
    position: relative;
}


#preview-placeholder {
    font-size: 48px;
    color: #ccc;
}

 .custom-bienvenida-modal .modal-dialog {
        animation: none !important;
    }
    .custom-bienvenida-modal.show .modal-dialog {
        animation: bienvenida-pop 0.35s cubic-bezier(.22,1,.36,1) both;
        animation-iteration-count: 1;
        animation-fill-mode: both;
    }
    @keyframes bienvenida-pop {
        0% { transform: scale(0.85) translateY(-20px); opacity: 0; }
        100% { transform: scale(1) translateY(0); opacity: 1; }
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>
    <script>
        // Inicializar Supabase
        const supabaseUrl = "https://dhhhftzdfpqthzvkrqoz.supabase.co";
        const supabaseKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ";
        window.supabaseClient = supabase.createClient(supabaseUrl, supabaseKey);
    </script>
</head>
<body>
<?php include 'header.php'; ?>

<main class="container">
    <div class="card-premium">
        <h1 class="text-center mb-3">Sumate a nuestra red</h1>
        <p class="text-center text-muted mb-4">Postulate para formar parte de los profesionales gestionados por Toori.</p>


                <!-- Modal de Bienvenida -->

                                <!-- Modal de Bienvenida CSS PURO -->
                                <div id="toori-bienvenida-modal" class="toori-bienvenida-modal">
                                    <div class="toori-bienvenida-modal-content">
                                        <div class="toori-bienvenida-modal-header">
                                            <span class="toori-bienvenida-modal-title">¡Bienvenido!</span>
                                            <button class="toori-bienvenida-modal-close" id="toori-cerrarBienvenida" aria-label="Cerrar">&times;</button>
                                        </div>
                                        <div class="toori-bienvenida-modal-body">
                                            <div style="font-size:2.5rem; color:#27ae60; margin-bottom:10px;">🎉</div>
                                            <p><strong>¡Felicidades!</strong> Ahora sos parte del equipo de profesionales de <b>Toori ServiciosYa</b>.<br><br>
                                                Cada vez que un cliente necesite tus servicios, aparecerá en la pestaña <b>"Ofertas"</b> y te llegará un mensaje a tu WhatsApp si lo escribiste correctamente.<br><br>
                                                Visitá tu perfil por si querés agregar algún dato o corregir algo.</p>
                                        </div>
                                        <div class="toori-bienvenida-modal-footer">
                                            <a href="perfil.php" class="toori-bienvenida-btn-principal">Ir a mi perfil</a>
                                            <button class="toori-bienvenida-btn-secundario" id="toori-cerrarBienvenida2">Cerrar</button>
                                        </div>
                                    </div>
                                </div>

                <div id="reg-alert" class="alert"></div>

        <form id="registro-form">
            <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="form-group text-center">
    <label>Foto de perfil</label>
    <div class="profile-preview" id="profile-preview">
        <img src="" alt="Preview" id="preview-img" style="display:none;">
        <div id="preview-placeholder">+</div>
    </div>
    <input type="file" id="reg-foto" accept="image/*" style="display:none;">
</div>
                <div class="form-group">
                    <label>nombre y apellido</label>
                    <input type="text" id="reg-nombre" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>DNI</label>
                    <input type="text" id="reg-dni" class="form-control" required>
                </div>
            </div>

            <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="reg-email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <input type="password" id="reg-password" class="form-control" required minlength="6">
                </div>
            </div>

            <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="form-group">
                    <label>Edad</label>
                    <input type="number" id="reg-edad" class="form-control">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="tel" id="reg-celular" class="form-control">
                </div>
            </div>

            <div class="grid" style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:20px; margin-top:8px;">
                <div class="form-group">
                    <label>Ciudad</label>
                    <input type="text" id="reg-ciudad" class="form-control" placeholder="Ej: San Fernando del Valle" required>
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

            <div class="form-group">
                <label>En qué te especializás (elige un oficio ahora, luego del registro puedes agregar más)</label>
                <select id="reg-profesion" class="form-control" required>
                    <option value="">Cargando categorías...</option>
                </select>
            </div>

            <div class="grid" style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="form-group">
                    <label>Matrícula <span style="color:#888;font-size:0.85em;">(opcional)</span></label>
                    <input type="file" id="reg-matricula-pdf" accept="application/pdf" class="form-control" style="padding:8px;">
                </div>
                <div class="form-group">
                    <label>certificado de libre antecedentes penales <span style="color:#888;font-size:0.85em;">(opcional)</span></label>
                    <input type="file" id="reg-antecedentes-pdf" accept="application/pdf" class="form-control" style="padding:8px;">
                </div>
            </div>

            <div class="form-group">
                <label>Años de experiencia</label>
                <input type="number" id="reg-antiguedad" class="form-control" value="1">
            </div>


            <div class="form-group">
                <input type="checkbox" id="reg-terminos" required>
                <label>Acepto los <a href="/Terminos-y-condiciones.php">Términos y Condiciones</a></label>
            </div>

            <div class="form-group" style="display:flex;align-items:flex-start;gap:10px;background:#eaf7f0;border:1px solid #b2dfce;border-radius:12px;padding:14px 16px;">
                <span style="font-size:22px;color:#27ae60;flex-shrink:0;">&#10003;</span>
                <p style="margin:0;color:#1a7a4a;font-size:0.92em;line-height:1.5;">
                    <strong>Subir tu matrícula y antecedentes te convertirá en un prestador verificado</strong>, dándote mayor visibilidad y confianza ante los clientes.
                </p>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-3">Enviar</button>
        </form>
    </div>
</main>
    <!-- Footer (Toori Design) -->
   <?php include 'footer.php'; ?>

<script>
// Redirigir si ya hay sesión activa en Supabase Auth
document.addEventListener('DOMContentLoaded', async () => {
    const { data: { session } } = await window.supabaseClient.auth.getSession();
    if (session) {
        window.location.href = 'perfil.php';
        return;
    }
});
document.addEventListener('DOMContentLoaded', async () => {
    const alertDiv = document.getElementById('reg-alert');
    const select = document.getElementById('reg-profesion');

    // Traer categorías desde Supabase
    const { data: categorias, error } = await window.supabaseClient
        .from('categorias')
        .select('nombre')
        .order('nombre', { ascending: true });

    if (error) {
        select.innerHTML = '<option value="">Error al cargar categorías</option>';
        console.error(error);
        return;
    }

    select.innerHTML = '<option value="">Seleccioná una opción...</option>';
    categorias.forEach(cat => {
        const option = document.createElement('option');
        option.value = cat.nombre;
        option.textContent = cat.nombre;
        select.appendChild(option);
    });

    // --- Preview de foto circular ---
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

        const email = document.getElementById('reg-email').value;
        const password = document.getElementById('reg-password').value;

        // Función para traducir errores comunes de Supabase Auth
        function traducirError(mensaje) {
            if (!mensaje) return '';
            if (mensaje.includes('User already registered')) return 'El email ya está registrado.';
            if (mensaje.includes('Invalid login credentials')) return 'Credenciales inválidas.';
            if (mensaje.includes('Password should be at least')) return 'La contraseña debe tener al menos 6 caracteres.';
            if (mensaje.includes('invalid email')) return 'El email no es válido.';
            if (mensaje.includes('malformed array literal')) return 'Error interno: formato de categoría incorrecto.';
            // Puedes agregar más traducciones según los mensajes que recibas
            return mensaje;
        }

        // 1️⃣ Registrar usuario en Supabase Auth
        // Validación cliente: ciudad es obligatoria
        const ciudadVal = document.getElementById('reg-ciudad').value || '';
        if (String(ciudadVal).trim() === '') {
            alertDiv.className = 'alert alert-error';
            alertDiv.textContent = 'Por favor indicá la Ciudad (es obligatoria).';
            alertDiv.style.display = 'block';
            return;
        }

        const { data: authData, error: authError } = await window.supabaseClient.auth.signUp({
            email: email,
            password: password
        });

        if (authError) {
            alertDiv.className = 'alert alert-error';
            alertDiv.textContent = 'Error de registro: ' + traducirError(authError.message);
            alertDiv.style.display = 'block';
            return;
        }

        const user_id = authData.user.id; // ID único del usuario
        let fotoUrl = null;
        let matriculaUrl = null;
        let antecedentesUrl = null;

        // 2️⃣ Subir foto si hay archivo
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const fileName = `${user_id}-perfil-${Date.now()}`;
            const { data: storageData, error: storageError } = await window.supabaseClient
                .storage
                .from('imagenes')
                .upload(fileName, file);

            if (storageError) {
                alertDiv.className = 'alert alert-error';
                alertDiv.textContent = 'Error al subir la foto: ' + storageError.message;
                alertDiv.style.display = 'block';
                return;
            }

            // URL pública
            fotoUrl = `${supabaseUrl}/storage/v1/object/public/imagenes/${fileName}`;
        }

        // 2b️⃣ Subir PDF de matrícula (opcional)
        const matriculaInput = document.getElementById('reg-matricula-pdf');
        if (matriculaInput.files.length > 0) {
            const file = matriculaInput.files[0];
            const fileName = `${user_id}-matricula-${Date.now()}.pdf`;
            const { error: storageError } = await window.supabaseClient
                .storage
                .from('imagenes')
                .upload(fileName, file);
            if (!storageError) {
                matriculaUrl = `${supabaseUrl}/storage/v1/object/public/imagenes/${fileName}`;
            }
        }

        // 2c️⃣ Subir PDF de antecedentes (opcional)
        const antecedentesInput = document.getElementById('reg-antecedentes-pdf');
        if (antecedentesInput.files.length > 0) {
            const file = antecedentesInput.files[0];
            const fileName = `${user_id}-antecedentes-${Date.now()}.pdf`;
            const { error: storageError } = await window.supabaseClient
                .storage
                .from('imagenes')
                .upload(fileName, file);
            if (!storageError) {
                antecedentesUrl = `${supabaseUrl}/storage/v1/object/public/imagenes/${fileName}`;
            }
        }

        const verificado = !!(matriculaUrl && antecedentesUrl);

        // 3️⃣ Guardar perfil en tabla "usuarios"
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
            categoria: [document.getElementById('reg-profesion').value], // ← como array
            matricula: matriculaUrl,
            antecedentes: antecedentesUrl, // Solo la URL del PDF, nunca el texto
            verificado: verificado,
            antiguedad: parseInt(document.getElementById('reg-antiguedad').value) || 0,
            // El texto del textarea NO se guarda en el campo antecedentes
            rol: 'worker',
            foto_perfil: fotoUrl
        };

        console.log("Datos que se intentan insertar:", data);

        const { error: insertError } = await window.supabaseClient.from('usuarios').insert([data]);

        if (insertError) {
            alertDiv.className = 'alert alert-error';
            alertDiv.textContent = 'Error al guardar perfil: ' + traducirError(insertError.message);
            alertDiv.style.display = 'block';
        } else {
            // Redirigir a pantalla de registro completado en vez de abrir modal
            window.location.href = 'registro-completado.php';
        }
    });
});
</script>


<script>
// Modal Bienvenida CSS puro (IDs y clases únicos)
document.addEventListener('DOMContentLoaded', function() {
    function cerrarModalBienvenida() {
        document.getElementById('toori-bienvenida-modal').classList.remove('toori-bienvenida-modal-show');
    }
    document.getElementById('toori-cerrarBienvenida').onclick = cerrarModalBienvenida;
    document.getElementById('toori-cerrarBienvenida2').onclick = cerrarModalBienvenida;
    // Cerrar con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModalBienvenida();
    });
    // Cerrar al hacer click fuera del modal
    document.getElementById('toori-bienvenida-modal').addEventListener('click', function(e) {
        if (e.target === this) cerrarModalBienvenida();
    });
});
</script>
</body>
<style>
/* Modal Bienvenida CSS puro (clases e IDs únicos) */
.toori-bienvenida-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0; top: 0; width: 100vw; height: 100vh;
    background: rgba(0,0,0,0.32);
    justify-content: center;
    align-items: center;
    transition: background 0.2s;
}
/* Sin animaciones ni hover */
.toori-bienvenida-modal-show {
    display: flex;
}
.toori-bienvenida-modal-content {
    background: #fff;
    border-radius: 22px;
    box-shadow: 0 8px 32px 0 rgba(44,62,80,0.18), 0 3px 8px 0 rgba(44,62,80,0.12);
    border: 2px solid #007bff;
    min-width: 320px;
    max-width: 95vw;
    width: 410px;
    overflow: hidden;
}
.toori-bienvenida-modal-header {
    background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);
    padding: 1.1rem 1.5rem 1rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}
.toori-bienvenida-modal-title {
    color: #fff;
    font-size: 1.45rem;
    font-weight: 700;
}
.toori-bienvenida-modal-close {
    background: none;
    border: none;
    color: #fff;
    font-size: 2rem;
    line-height: 1;
    cursor: pointer;
    margin-left: 10px;
    transition: color 0.2s;
}
.toori-bienvenida-modal-close:hover {
    color: #fff;
}
.toori-bienvenida-modal-body {
    text-align: center;
    padding: 2.2rem 2rem 1.2rem 2rem;
}
.toori-bienvenida-modal-footer {
    display: flex;
    justify-content: center;
    gap: 12px;
    background: #f8fafc;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
    padding: 1.1rem 1.5rem;
}
.toori-bienvenida-btn-principal {
    background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);
    color: #fff;
    border: none;
    border-radius: 12px;
    padding: 0.7rem 2.2rem;
    font-size: 1.1rem;
    font-weight: 600;
    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    box-shadow: 0 2px 8px 0 rgba(0,123,255,0.10);
}
.toori-bienvenida-btn-principal:hover {
    background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);
    color: #fff;
}
.toori-bienvenida-btn-secundario {
    background: none;
    color: #007bff;
    border: 2px solid #007bff;
    border-radius: 12px;
    padding: 0.7rem 2.2rem;
    font-size: 1.1rem;
    font-weight: 600;
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
}
.toori-bienvenida-btn-secundario:hover {
    background: none;
    color: #007bff;
}
</style>
</html>