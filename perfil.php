<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Toori ServiciosYa</title>
    <meta name="description" content="Gestioná tu información personal y profesional en Toori.">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        .profile-hero {
            position: relative;
            min-height: 250px;
            background-image: url('assets/hero_house.png');
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding-bottom: 60px;
        }

        .profile-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(180deg, rgba(75, 78, 109, 0.9) 0%, rgba(75, 78, 109, 0.6) 100%);
        }

        .profile-hero div {
            position: relative;
            z-index: 2;
        }

        .profile-container {
            margin-top: -60px;
            position: relative;
            z-index: 10;
        }

        .profile-card {
            background: white;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-premium);
            padding: 40px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .avatar-edit {
            position: relative;
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
        }

        .avatar-img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: var(--toori-dark);
            font-size: 0.9rem;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: var(--radius-md);
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
            font-size: 1rem;
            transition: all 0.2s;
            font-family: var(--font-body);
        }

        .form-control:focus {
            background-color: white;
            border-color: var(--toori-blue);
            box-shadow: 0 0 0 4px rgba(59, 168, 224, 0.1);
        }

        .btn-save {
            background-color: var(--toori-blue);
            border: none;
            border-radius: 50px;
            padding: 15px;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.2s;
            color: white;
            font-family: var(--font-body);
        }

        .btn-save:hover {
            transform: translateY(-2px);
            background-color: var(--toori-green-hover);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .worker-section {
            background: #f8fafc;
            border-radius: var(--radius-md);
            padding: 25px;
            margin-top: 30px;
            border: 1px dashed var(--toori-blue);
        }

        .role-card {
            cursor: pointer;
            transition: all 0.2s;
            border: 2px solid #e5e7eb;
            border-radius: var(--radius-md);
            padding: 20px;
            text-align: center;
        }

        .btn-check:checked+.role-card {
            border-color: var(--toori-blue);
            background-color: rgba(59, 168, 224, 0.05);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        h2,
        h6 {
            color: var(--toori-dark);
        }
    </style>
  <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">

  <script src="perfil-checker.js"></script>
</head>

<body class="bg-light">

    <?php include 'header.php'; ?>

    <div id="page-loader" class="text-center py-5" style="margin-top: 100px;">
        <div class="spinner-border text-primary" role="status" style="width: 3rem; height: 3rem;"></div>
        <p class="mt-3 fw-bold text-muted">Cargando tu perfil...</p>
    </div>

    <div id="profile-content" class="d-none">
        <section class="profile-hero">
            <div>
                <h2 class="mb-2 text-white">Configuración de Perfil</h2>
                <p class="text-white-50 opacity-75">Tu información personal segura en un solo lugar</p>
            </div>
        </section>

        <section class="container profile-container mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="profile-card">
                        <form id="form-perfil">
                            <div class="avatar-edit">
                                <img id="profile-img" src="https://ui-avatars.com/api/?name=User" alt="Avatar"
                                    class="avatar-img">
                            </div>

                            <div id="alert-msg" class="alert d-none mb-4 py-3 small fw-bold text-center"></div>

                            <div class="row g-4">

                                <!-- Role Selection (Only for New Users) -->
                                <div id="role-selection" class="col-12 d-none">
                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3">¿Cómo vas a usar Toori?</h6>
                                        <div class="d-flex gap-3">
                                            <div class="flex-grow-1">
                                                <input type="radio" class="btn-check" name="user-role" id="role-cliente"
                                                    value="cliente" autocomplete="off">
                                                <label class="role-card w-100" for="role-cliente">
                                                    <i class="bi bi-person-heart d-block mb-2 h3 text-primary"></i>
                                                    <span class="fw-bold">Soy Cliente</span>
                                                    <small class="d-block text-muted">Busco servicios</small>
                                                </label>
                                            </div>
                                            <div class="flex-grow-1">
                                                <input type="radio" class="btn-check" name="user-role"
                                                    id="role-prestador" value="prestador" autocomplete="off">
                                                <label class="role-card w-100" for="role-prestador">
                                                    <i class="bi bi-tools d-block mb-2 h3 text-primary"></i>
                                                    <span class="fw-bold">Soy Trabajador</span>
                                                    <small class="d-block text-muted">Ofrezco servicios</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Campos adicionales del perfil -->
                                <div class="col-md-6">
    <label class="form-label">Profesión / Categoría</label>
    <select id="input-categoria-select" class="form-control" style="width:100%">
        <option value="">Cargando categorías...</option>
    </select>
    <div id="categorias-seleccionadas" class="d-flex flex-wrap gap-2 mt-2"></div>
</div>
                               
                                <div class="col-md-3">
                                    <label class="form-label">Edad</label>
                                    <input type="number" id="input-edad" class="form-control" placeholder="Edad">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">DNI</label>
                                    <input type="text" id="input-dni" class="form-control" placeholder="DNI">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Provincia</label>
                                    <input type="text" id="input-provincia" class="form-control" placeholder="Provincia">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Rol</label>
                                    <input type="text" id="input-rol" class="form-control" placeholder="Rol" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Verificado</label>
                                    <input type="text" id="input-verificado" class="form-control" placeholder="Verificado" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Ranking</label>
                                    <input type="text" id="input-ranking" class="form-control" placeholder="Ranking" disabled>
                                </div>
                                <div class="col-md-12" id="suscripcion-row" style="display:none;">
                                    <label class="form-label">Suscripción activa hasta</label>
                                    <input type="text" id="input-suscripcion" class="form-control" placeholder="Fecha de vencimiento" disabled>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Nombre Completo</label>
                                    <input type="text" id="input-nombre" class="form-control" placeholder="Tu nombre"
                                        required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono / WhatsApp</label>
                                    <input type="tel" id="input-telefono" class="form-control"
                                        placeholder="Ej: 3511234567 (Sin el 0 ni el 15)">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email de seguridad</label>
                                    <input type="email" id="input-email" class="form-control" disabled>
                                </div>

                                <!-- Worker specific fields -->
                                <div id="worker-fields" class="col-12 d-none">
                                    <div class="worker-section">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="fw-bold mb-0 d-flex align-items-center gap-2">
                                                <i class="bi bi-briefcase-fill text-primary"></i>
                                                Información de Trabajador
                                            </h6>
                                            <a id="btn-view-public" href="#" target="_blank"
                                                class="btn btn-sm btn-outline-primary rounded-pill">
                                                <i class="bi bi-eye-fill me-1"></i> Ver Perfil Público
                                            </a>
                                        </div>

                                        <!-- Reputation Summary -->
                                        <div id="reputation-summary"
                                            class="p-3 bg-white rounded border mb-3 d-flex align-items-center justify-content-around text-center">
                                            <div>
                                                <div id="worker-stars" class="text-warning h4 mb-0">
                                                    <i class="bi bi-star"></i><i class="bi bi-star"></i><i
                                                        class="bi bi-star"></i><i class="bi bi-star"></i><i
                                                        class="bi bi-star"></i>
                                                </div>
                                                <small class="text-muted">Puntuación</small>
                                            </div>
                                            <div class="vr"></div>
                                            <div>
                                                <h4 id="worker-reviews-count" class="mb-0 fw-bold">0</h4>
                                                <small class="text-muted">Reseñas</small>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <div class="col-md-12">
                                                <label class="form-label">Mis Servicios</label>
                                                <div id="worker-oficios" class="d-flex flex-wrap gap-2 mb-2">
                                                    <!-- Oficios badges will go here -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Ubicación / Ciudad</label>
                                                <input type="text" id="input-ciudad" class="form-control"
                                                    placeholder="Ej: Córdoba">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Barrio</label>
                                                <input type="text" id="input-barrio" class="form-control"
                                                    placeholder="Ej: Centro">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-6">
    <label class="form-label">Matrícula (máx. 3)</label>
    <input type="file" id="input-matricula" class="form-control mb-2" accept="image/*,application/pdf">
    <div id="matriculas-lista" class="d-flex flex-wrap gap-2 mt-1"></div>
</div>
<div class="col-md-6">
    <label class="form-label">Antecedentes (máx. 3)</label>
    <input type="file" id="input-antecedentes" class="form-control mb-2" accept="image/*,application/pdf">
    <div id="antecedentes-lista" class="d-flex flex-wrap gap-2 mt-1"></div>
</div>

                                <div class="col-12 mt-5">
                                    <button type="submit" id="btn-save-profile"
                                        class="btn btn-primary btn-save w-100 shadow-sm">
                                        <i class="bi bi-check2-circle me-1"></i> Guardar Cambios
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </section>
    </div>
<!-- Footer (Toori Design) -->
   <?php include 'footer.php'; ?>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script inline para perfil usando tabla usuarios -->
    <script type="module">
        import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js/+esm';

        // Función para mostrar preview de archivos (img/pdf/otros)
        function mostrarPreviewArchivo(elementId, url) {
            const cont = document.getElementById(elementId);
            if (!cont) return;
            cont.innerHTML = '';
            if (!url) return;
            const lowerUrl = url.toLowerCase();
            if (lowerUrl.match(/\.(jpg|jpeg|png|gif|webp)$/)) {
                cont.innerHTML = `<img src="${url}" alt="Archivo" style="max-width:100%;max-height:180px;border-radius:8px;box-shadow:0 2px 8px #0001;">`;
            } else if (lowerUrl.endsWith('.pdf')) {
                cont.innerHTML = `<iframe src="${url}" style="width:100%;height:180px;border-radius:8px;border:1px solid #eee;"></iframe>`;
            } else {
                cont.innerHTML = `<a href="${url}" target="_blank" rel="noopener">Ver archivo</a>`;
            }
        }

        const SUPABASE_URL = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
        const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';
        const supabase = createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

        // Referencias a elementos del DOM
        const inputNombre = document.getElementById('input-nombre');
        const inputTelefono = document.getElementById('input-telefono');
        const inputEmail = document.getElementById('input-email');
        const inputCiudad = document.getElementById('input-ciudad');
        const inputCategoria = document.getElementById('input-categoria');
        const inputMatricula = document.getElementById('input-matricula');
        const inputAntecedentes = document.getElementById('input-antecedentes');
        const profileImg = document.getElementById('profile-img');
        const workerFields = document.getElementById('worker-fields');
        const workerOficios = document.getElementById('worker-oficios');
        const btnSave = document.getElementById('btn-save-profile');
        const profileForm = document.querySelector('form');


        let currentUser = null;
        let userProfile = null;

        // Utilidad para mostrar mensajes en pantalla
        function showAlert(msg, type = 'info') {
            const alertDiv = document.getElementById('alert-msg');
            if (!alertDiv) return;
            alertDiv.className = `alert alert-${type} mb-4 py-3 small fw-bold text-center`;
            alertDiv.textContent = msg;
            alertDiv.classList.remove('d-none');
        }
        function hideAlert() {
            const alertDiv = document.getElementById('alert-msg');
            if (!alertDiv) return;
            alertDiv.className = 'alert d-none mb-4 py-3 small fw-bold text-center';
            alertDiv.textContent = '';
        }

let categoriasElegidas = [];

let matriculasGuardadas = [];
let antecedentesGuardados = [];

function renderArchivos(lista, containerId, tipo) {
    const cont = document.getElementById(containerId);
    if (!cont) return;
    cont.innerHTML = lista.map((url, i) => {
        const nombre = url.split('/').pop().split('?')[0];
        const esImagen = url.match(/\.(jpg|jpeg|png|gif|webp)$/i);
        return `
        <div class="d-flex align-items-center gap-1 border rounded p-1" style="font-size:0.82rem;">
            ${esImagen
                ? `<img src="${url}" style="height:36px;width:36px;object-fit:cover;border-radius:4px;">`
                : `<i class="bi bi-file-earmark-pdf text-danger fs-5"></i>`
            }
            <a href="${url}" target="_blank" class="text-truncate" style="max-width:120px;">${nombre}</a>
            <i class="bi bi-x-circle text-danger" style="cursor:pointer;" onclick="quitarArchivo('${tipo}', ${i})"></i>
        </div>`;
    }).join('');
}

window.quitarArchivo = function(tipo, index) {
    if (tipo === 'matricula') {
        matriculasGuardadas.splice(index, 1);
        renderArchivos(matriculasGuardadas, 'matriculas-lista', 'matricula');
    } else if (tipo === 'antecedentes') {
        antecedentesGuardados.splice(index, 1);
        renderArchivos(antecedentesGuardados, 'antecedentes-lista', 'antecedentes');
    }
}

function renderCategoriasElegidas() {
    const cont = document.getElementById('categorias-seleccionadas');
    if (!cont) return;
    cont.innerHTML = categoriasElegidas.map(cat => `
        <span class="badge bg-primary d-flex align-items-center gap-1" style="font-size:0.9rem;padding:6px 10px;">
            ${cat}
            <i class="bi bi-x-circle" style="cursor:pointer;" onclick="quitarCategoria('${cat}')"></i>
        </span>
    `).join('');
}

window.quitarCategoria = function(cat) {
    categoriasElegidas = categoriasElegidas.filter(c => c !== cat);
    renderCategoriasElegidas();
}

async function cargarCategorias() {
    try {
        const { data, error } = await supabase
            .from('categorias')
            .select('id, nombre')
            .order('nombre');

        if (error) throw error;

        const select = document.getElementById('input-categoria-select');
        if (select) {
            select.innerHTML = '<option value="">Agregar categoría...</option>';
            data.forEach(cat => {
                const opt = document.createElement('option');
                opt.value = cat.nombre;
                opt.textContent = cat.nombre;
                select.appendChild(opt);
            });

            // Al elegir una opción, agregarla al array
            select.addEventListener('change', () => {
    const val = select.value;
    if (val && !categoriasElegidas.includes(val)) {
        if (categoriasElegidas.length >= 3) {
            alert('Podés agregar un máximo de 3 categorías.');
            select.value = '';
            return;
        }
        categoriasElegidas.push(val);
        renderCategoriasElegidas();
    }
    select.value = '';
});
        }
    } catch (error) {
        console.error('Error cargando categorías:', error);
    }
}

        // Inicializar
        async function init() {
                        
            try {
                // Cargar categorías en el select
                        await cargarCategorias();
                // Obtener sesión actual
                const { data: { session }, error: sessionError } = await supabase.auth.getSession();
                if (sessionError || !session) {
                    console.log('No hay sesión activa, redirigiendo a login...');
                    showAlert('No hay sesión activa. Redirigiendo a login...', 'danger');
                    window.location.href = 'login.php';
                    return;
                }
                currentUser = session.user;
                showAlert(`Usuario autenticado: ${currentUser.email} (ID: ${currentUser.id})`, 'info');
                console.log('Usuario autenticado:', currentUser.email, 'ID:', currentUser.id);
                // Cargar perfil desde tabla usuarios
                await loadProfile();
            } catch (error) {
                console.error('Error en init:', error);
                alert('Error al inicializar: ' + error.message);
            } finally {
                // Mostrar el contenido y ocultar el loader SIEMPRE
                document.getElementById('page-loader')?.classList.add('d-none');
                document.getElementById('profile-content')?.classList.remove('d-none');
            }
        }

        // Cargar perfil del usuario
        async function loadProfile() {
            try {
                // Intentar buscar por email (que es único)
                showAlert(`Buscando perfil por email: ${currentUser.email}`, 'info');
                const { data, error } = await supabase
                    .from('usuarios')
                    .select('*')
                    .eq('email', currentUser.email)
                    .single();

                if (error && error.code !== 'PGRST116') {
                    console.error('Error al cargar perfil:', error);
                    showAlert('Error al cargar perfil: ' + error.message, 'danger');
                    return;
                }

                if (data) {
                    userProfile = data;
                    showAlert('Perfil cargado correctamente.', 'success');
                    console.log('Perfil cargado:', userProfile);
                    // Llenar formulario con datos
                    if (inputNombre) {
                        const nombreCompleto = [data.nombre, data.apellido].filter(Boolean).join(' ');
                        inputNombre.value = nombreCompleto || '';
                    }
                    if (inputTelefono) {
                        inputTelefono.value = data.celular || '';
                    }
                    if (inputEmail) {
                        inputEmail.value = data.email || currentUser.email || '';
                    }
                    if (inputCiudad) {
                        inputCiudad.value = data.ciudad || '';
                    }
                    if (profileImg && data.foto_perfil) {
                        profileImg.src = data.foto_perfil;
                    }
                    // Campos adicionales
                    const cat = data.categoria;
categoriasElegidas = Array.isArray(cat) ? cat : (cat ? [cat] : []);
renderCategoriasElegidas();

                    const mat = data.matricula;
matriculasGuardadas = Array.isArray(mat) ? mat : (mat ? [mat] : []);
renderArchivos(matriculasGuardadas, 'matriculas-lista', 'matricula');

const ant = data.antecedentes;
antecedentesGuardados = Array.isArray(ant) ? ant : (ant ? [ant] : []);
renderArchivos(antecedentesGuardados, 'antecedentes-lista', 'antecedentes');
                    document.getElementById('input-edad').value = data.edad || '';
                    document.getElementById('input-dni').value = data.dni || '';
                    document.getElementById('input-provincia').value = data.provincia || '';
                    document.getElementById('input-rol').value = data.rol || '';
                    document.getElementById('input-verificado').value = (data.verificado || data.dni_verificado) ? 'Sí' : 'No';
                    // Ranking (mostrar estrellas o promedio)
                    let ranking = '';
                    if (data.ranking && Array.isArray(data.ranking) && data.ranking.length > 0) {
                        const r = data.ranking[0];
                        ranking = `Estrellas: ${r.estrellas ?? 0}, Puntualidad: ${r.puntualidad ?? 0}`;
                    } else if (data.ranking && typeof data.ranking === 'object') {
                        ranking = `Estrellas: ${data.ranking.estrellas ?? 0}, Puntualidad: ${data.ranking.puntualidad ?? 0}`;
                    } else {
                        ranking = 'Sin ranking';
                    }
                    document.getElementById('input-ranking').value = ranking;
                    // Suscripción
                    if (data.suscriptor && data.suscripcion_activa_hasta) {
                        document.getElementById('suscripcion-row').style.display = 'block';
                        document.getElementById('input-suscripcion').value = data.suscripcion_activa_hasta;
                    } else {
                        document.getElementById('suscripcion-row').style.display = 'none';
                        document.getElementById('input-suscripcion').value = '';
                    }
                    // Si es trabajador, mostrar sección de trabajador
                    if (data.rol === 'trabajador' && workerFields) {
                        workerFields.style.display = 'block';
                        document.getElementById('role-worker')?.click();
                        // Mostrar categoría/servicios
                        if (workerOficios && data.categoria) {
                           const cats = Array.isArray(data.categoria) ? data.categoria : (data.categoria ? [data.categoria] : []);
workerOficios.innerHTML = cats.map(c => `<span class="badge bg-primary">${c}</span>`).join('');
                        }
                     } else if (workerFields) {
                        workerFields.style.display = 'none';
                    }

                  window._pfcSupabase = supabase; // ← agregá esta línea antes del check
if (window.ProfileChecker) {
    setTimeout(() => window.ProfileChecker.check(data, { perfilUrl: 'perfil.php' }), 900);
}

                } else {
                    showAlert('No se encontró perfil para este email. Complete y guarde para crear uno nuevo.', 'warning');
                    console.log('No se encontró perfil, creando uno nuevo...');
                    // Pre-llenar con email del auth
                    if (inputEmail) {
                        inputEmail.value = currentUser.email || '';
                    }
                }
            } catch (error) {
                console.error('Error en loadProfile:', error);
            }
            
        }

        // Guardar perfil
        async function saveProfile(e) {
            e.preventDefault();
            
            if (!currentUser) {
                alert('No hay usuario autenticado');
                return;
            }

            btnSave.disabled = true;
            btnSave.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Guardando...';

            try {
                // Separar nombre y apellido
                const nombreCompleto = inputNombre?.value?.trim() || '';
                const partes = nombreCompleto.split(' ');
                const nombre = partes[0] || '';
                const apellido = partes.slice(1).join(' ') || '';

                // REEMPLAZAR los dos bloques if(inputMatricula...) y if(inputAntecedentes...) por:
const inputMat = document.getElementById('input-matricula');
if (inputMat?.files?.[0]) {
    if (matriculasGuardadas.length >= 3) {
        alert('Máximo 3 matrículas.');
    } else {
        const file = inputMat.files[0];
        const ext = file.name.split('.').pop();
        const filePath = `imagenes/${currentUser.id}-matricula-${Date.now()}.${ext}`;
        const { data: upMat, error: errMat } = await supabase.storage.from('imagenes').upload(filePath, file, { upsert: true });
        if (errMat) throw errMat;
        matriculasGuardadas.push(`${SUPABASE_URL}/storage/v1/object/public/${upMat.fullPath}`);
        inputMat.value = '';
    }
}

const inputAnt = document.getElementById('input-antecedentes');
if (inputAnt?.files?.[0]) {
    if (antecedentesGuardados.length >= 3) {
        alert('Máximo 3 antecedentes.');
    } else {
        const file = inputAnt.files[0];
        const ext = file.name.split('.').pop();
        const filePath = `imagenes/${currentUser.id}-antecedentes-${Date.now()}.${ext}`;
        const { data: upAnt, error: errAnt } = await supabase.storage.from('imagenes').upload(filePath, file, { upsert: true });
        if (errAnt) throw errAnt;
        antecedentesGuardados.push(`${SUPABASE_URL}/storage/v1/object/public/${upAnt.fullPath}`);
        inputAnt.value = '';
    }
}

                const profileData = {
                    nombre: nombre,
                    apellido: apellido,
                    email: inputEmail?.value?.trim() || currentUser.email,
                    celular: inputTelefono?.value?.trim() || null,
                    ciudad: inputCiudad?.value?.trim() || null,
                    barrio: document.getElementById('input-barrio')?.value?.trim() || null,
                    provincia: document.getElementById('input-provincia')?.value?.trim() || null,
                    dni: document.getElementById('input-dni')?.value?.trim() || null,
                    edad: document.getElementById('input-edad')?.value?.trim() || null,
                    matricula: matriculasGuardadas.length > 0 ? matriculasGuardadas : null,
antecedentes: antecedentesGuardados.length > 0 ? antecedentesGuardados : null,
                    categoria: categoriasElegidas.length > 0 ? categoriasElegidas : null
                };

                // Verificar si es trabajador
                const isWorker = document.getElementById('role-worker')?.checked;
                if (isWorker) {
                    profileData.rol = 'trabajador';
                }

                console.log('Guardando datos:', profileData);

                if (userProfile) {
                    // Actualizar registro existente
                    const { error } = await supabase
                        .from('usuarios')
                        .update(profileData)
                        .eq('email', currentUser.email);

                    if (error) throw error;
                } else {
                    // Insertar nuevo registro
                    profileData.id = currentUser.id;
                    profileData.usuario_id = currentUser.id;
                    
                    const { error } = await supabase
                        .from('usuarios')
                        .insert(profileData);

                    if (error) throw error;
                }

                alert('¡Perfil guardado exitosamente!');
                await loadProfile(); // Recargar datos

            } catch (error) {
                console.error('Error al guardar:', error);
                alert('Error al guardar: ' + error.message);
            } finally {
                btnSave.disabled = false;
                btnSave.innerHTML = '<i class="bi bi-check2-circle me-1"></i> Guardar Cambios';
            }
        }

        // Event listeners
        if (profileForm) {
            profileForm.addEventListener('submit', saveProfile);
        }

        // Manejar selección de rol
        document.querySelectorAll('input[name="user-role"]').forEach(radio => {
            radio.addEventListener('change', (e) => {
                if (workerFields) {
                    workerFields.style.display = e.target.id === 'role-worker' ? 'block' : 'none';
                }
            });
        });

        // Por esto solo:
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
    </script>



</body>

</html>