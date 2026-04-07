<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas de Trabajo - Toori ServiciosYa</title>
    <meta name="description"
        content="Explorá las ofertas de trabajo disponibles en Toori. Oportunidades para profesionales verificados.">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <!-- Bootstrap 5 CSS para modals -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .justify-center { justify-content: center; }
        @keyframes spin { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
        .spin { animation: spin 1s linear infinite; display: inline-block; }

        .oferta-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 4px 18px 0 rgba(44, 62, 80, 0.10), 0 1.5px 4px 0 rgba(44, 62, 80, 0.08);
            border: 2px solid var(--toori-blue, #007bff);
            transition: transform 0.18s, box-shadow 0.18s;
            position: relative;
            overflow: hidden;
            padding: 1rem;
        }
        .oferta-card:hover {
            transform: translateY(-6px) scale(1.025);
            box-shadow: 0 8px 32px 0 rgba(44, 62, 80, 0.18), 0 3px 8px 0 rgba(44, 62, 80, 0.12);
            border-color: #0056b3;
        }
        .oferta-card .categoria-badge {
            position: relative;
            background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);
            color: #fff;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 6px 16px;
            border-radius: 16px;
            box-shadow: 0 2px 8px 0 rgba(0, 123, 255, 0.10);
        }
        .oferta-card h5 {
            margin-bottom: 0.5rem;
            color: #007bff;
            font-weight: 700;
            font-size: 1.25rem;
        }
        .oferta-card p {
            margin-bottom: 0.5rem;
            color: #444;
        }
        .oferta-card .oferta-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.2rem;
            font-size: 0.98rem;
        }
        .oferta-card .oferta-footer .text-muted {
            color: #6c757d !important;
        }
        .oferta-card .oferta-footer .bi {
            margin-right: 4px;
        }

        /* Galería de imágenes dentro de la card */
        .oferta-imagenes {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin: 10px 0 4px;
        }
        .oferta-imagen-thumb {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #e0eaff;
            cursor: pointer;
            transition: transform 0.15s, border-color 0.15s;
            background: #f0f4ff;
        }
        .oferta-imagen-thumb:hover {
            transform: scale(1.08);
            border-color: #007bff;
        }

        /* Lightbox */
        #lightbox-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.88);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            cursor: zoom-out;
        }
        #lightbox-overlay.active {
            display: flex;
        }
        #lightbox-img {
            max-width: 92vw;
            max-height: 88vh;
            border-radius: 12px;
            box-shadow: 0 8px 48px rgba(0,0,0,0.6);
            cursor: default;
        }
        #lightbox-close {
            position: fixed;
            top: 18px;
            right: 24px;
            color: #fff;
            font-size: 2.2rem;
            cursor: pointer;
            z-index: 10000;
            line-height: 1;
        }
        #lightbox-close:hover { color: #aad4ff; }
    </style>
</head>

<body style="background-color: var(--bg-soft); min-height: 100vh;">

<?php include 'header.php'; ?>

    <main class="container" style="padding: 60px 0 100px;">
        <div class="mb-4">
            <h2>Ofertas Enviadas</h2>
            <div id="enviadas-container" class="grid mb-5"
                style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 32px;">
                <div id="loading-enviadas" class="text-center py-3">
                    <div style="font-size: 1.5rem; color: var(--toori-blue);"><i class="bi bi-arrow-repeat spin"></i></div>
                    <p class="mt-2 text-muted">Cargando tus presupuestos enviados...</p>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <h1>Ofertas Disponibles</h1>
            <p class="text-muted">Encontrá oportunidades y enviá tu presupuesto hoy mismo.</p>
        </div>
        <div id="loading-ofertas" class="text-center py-5">
            <div style="font-size: 2rem; color: var(--toori-blue);"><i class="bi bi-arrow-repeat spin"></i></div>
            <p class="mt-2 text-muted">Buscando las mejores ofertas para vos...</p>
        </div>
        <div id="ofertas-container" class="grid"
            style="grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 32px;">
        </div>
    </main>

<!-- Lightbox para ver imágenes en grande -->
<div id="lightbox-overlay" onclick="cerrarLightbox()">
    <span id="lightbox-close" onclick="cerrarLightbox()">×</span>
    <img id="lightbox-img" src="" alt="Imagen del problema" onclick="event.stopPropagation()">
</div>

<!-- Modal para ofrecer presupuesto -->
<?php include 'ofrecerPresupuesto.php'; ?>
<?php include 'footer.php'; ?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2"></script>

<script>
    const SUPABASE_URL = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
    const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';
    const db = supabase.createClient(SUPABASE_URL, SUPABASE_ANON_KEY);

    // ── Lightbox ─────────────────────────────────────────────────────────────
    function abrirLightbox(proxyUrl) {
        const img = document.getElementById('lightbox-img');
        img.src = proxyUrl;
        document.getElementById('lightbox-overlay').classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    function cerrarLightbox() {
        document.getElementById('lightbox-overlay').classList.remove('active');
        document.getElementById('lightbox-img').src = '';
        document.body.style.overflow = '';
    }
    document.addEventListener('keydown', e => { if (e.key === 'Escape') cerrarLightbox(); });

    // ── Genera HTML de miniaturas para las imágenes de una oferta ─────────────
    function renderImagenes(mediaUrl) {
        // mediaUrl puede venir como:
        // - cadena con comas
        // - JSON string de array ("[\"url1\",\"url2\"]")
        // - ya un array
        // Extraemos urls de forma robusta
        if (!mediaUrl) return '';

        let urls = [];
        try {
            if (Array.isArray(mediaUrl)) {
                urls = mediaUrl.map(u => String(u || '').trim()).filter(Boolean);
            } else if (typeof mediaUrl === 'string') {
                const s = mediaUrl.trim();
                if (s.startsWith('[')) {
                    // intentar parsear JSON
                    const parsed = JSON.parse(s);
                    if (Array.isArray(parsed)) urls = parsed.map(u => String(u || '').trim()).filter(Boolean);
                }
            }
        } catch (e) {
            urls = [];
        }

        if (urls.length === 0) {
            // fallback: extraer con regex todas las URLs http(s)
            const text = Array.isArray(mediaUrl) ? mediaUrl.join(',') : String(mediaUrl);
            const matches = text.match(/https?:\/\/[^\s"']+/g);
            if (matches) {
                urls = matches.map(m => m.replace(/^["'\[]+|["'\]]+$/g, '').trim()).filter(Boolean);
            } else {
                // última opción: split por comas y limpiar
                urls = text.split(',').map(u => u.replace(/^["'\[\]]+|["'\]\]]+$/g, '').trim()).filter(Boolean);
            }
        }

        if (urls.length === 0) return '';

        const thumbs = urls.map(url => {
            const proxyUrl = 'twilio_media_proxy.php?url=' + encodeURIComponent(url);
            return `<img src="${proxyUrl}" class="oferta-imagen-thumb" alt="Foto del problema" loading="lazy" onclick="event.stopPropagation(); abrirLightbox('${proxyUrl}')" onerror="(function(){this.onerror=null;this.src='assets/nofoto.png';}).call(this)">`;
        }).join('');

        return `
            <div class="oferta-imagenes">
                <small class="w-100 text-muted mb-1" style="font-size:0.82rem;">
                    <i class="bi bi-camera"></i> ${urls.length} foto${urls.length > 1 ? 's' : ''} del problema
                </small>
                ${thumbs}
            </div>`;
    }

    // ── Carga principal ───────────────────────────────────────────────────────
    async function cargarOfertas() {
        const container         = document.getElementById('ofertas-container');
        const loading           = document.getElementById('loading-ofertas');
        const enviadasContainer = document.getElementById('enviadas-container');
        const loadingEnviadas   = document.getElementById('loading-enviadas');

        try {
            // 1. Sesión
            const { data: { session } } = await db.auth.getSession();
            if (!session) { window.location.href = 'login.php'; return; }

            // 2. Datos del usuario
            const { data: usuarioData } = await db
                .from('usuarios')
                .select('categoria, usuario_id, id')
                .eq('email', session.user.email)
                .single();

            const cat = usuarioData?.categoria;
            const profesionUsuario = Array.isArray(cat)
                ? (cat[0] || '').trim().toLowerCase()
                : (cat || '').trim().toLowerCase();
            const trabajadorUuidSesion = usuarioData?.usuario_id || null;
            const trabajadorIdSesion   = usuarioData?.id || null;

            // 3. Presupuestos enviados
            if (enviadasContainer) {
                const { data: presupuestos, error: errorPres } = await db
                    .from('presupuestos')
                    .select(`*, nuevaOferta:oferta_id ( id, estado )`)
                    .or(`trabajador_uuid.eq.${trabajadorUuidSesion},trabajador_uuid.eq.${trabajadorIdSesion}`);

                const ahora = new Date();
                const presupuestosFiltrados = (presupuestos || []).filter(p => {
                    const estadoOferta = p.nuevaOferta?.estado?.toLowerCase();
                    if (estadoOferta === 'pagado') return false;
                    if (!p.created_at) return false;
                    const diffHoras = (ahora - new Date(p.created_at)) / (1000 * 60 * 60);
                    if (diffHoras > 48) return false;
                    return true;
                });

                if (loadingEnviadas) loadingEnviadas.style.display = 'none';

                if (errorPres) {
                    enviadasContainer.innerHTML = '<p class="text-danger">Error al cargar tus presupuestos enviados.</p>';
                } else if (!presupuestosFiltrados || presupuestosFiltrados.length === 0) {
                    enviadasContainer.innerHTML = '<p class="text-muted">No has enviado presupuestos aún.</p>';
                } else {
                    enviadasContainer.innerHTML = presupuestosFiltrados.map(p => `
                        <div class="oferta-card p-4 mb-2 bg-light border-primary">
                            <span class="categoria-badge">Presupuesto #${p.id}</span>
                            <h5>Monto: $${p.monto}</h5>
                            <p><b>Descripción:</b> ${p.descripcion || ''}</p>
                            <p><b>Horarios:</b> ${p.horarios_disponibles || ''}</p>
                            <div class="oferta-footer">
                                <span class="text-muted"><i class="bi bi-calendar"></i> ${p.created_at ? (() => { let d = new Date(p.created_at); d.setHours(d.getHours() - 3); return d.toLocaleString('es-AR'); })() : ''}</span>
                                <span class="text-muted"><i class="bi bi-info-circle"></i> Estado: ${p.estado || 'activo'}</span>
                            </div>
                        </div>
                    `).join('');
                }
            }

            // 4. Ofertas disponibles
            const { data, error } = await db
                .from('nuevaOferta')
                .select('*, presupuestos(count)')
                .order('created_at', { ascending: false });

            if (loading) loading.style.display = 'none';
            if (error) throw error;

            if (!data || data.length === 0) {
                container.innerHTML = '<p class="text-muted">No hay ofertas disponibles.</p>';
                return;
            }

            // 5. Filtrar por categoría y fecha
            const ahora = new Date();
            const ofertasFiltradas = data.filter(oferta => {
                if (!oferta.created_at) return false;
                const diffHoras = (ahora - new Date(oferta.created_at)) / (1000 * 60 * 60);
                if (diffHoras > 48) return false;
                if (oferta.estado?.toLowerCase() === 'pagado') return false;
                const cantPresupuestos = oferta.presupuestos?.[0]?.count ?? 0;
                if (cantPresupuestos >= 3) return false;

                const categoriasUsuario = Array.isArray(usuarioData?.categoria)
                    ? usuarioData.categoria.map(c => c.trim().toLowerCase())
                    : (usuarioData?.categoria ? [usuarioData.categoria.trim().toLowerCase()] : []);
                if (categoriasUsuario.length === 0) return true;
                if (!oferta.categoria) return false;
                const catOferta = oferta.categoria.trim().toLowerCase();
                return categoriasUsuario.some(c => catOferta.includes(c) || c.includes(catOferta));
            });

            if (ofertasFiltradas.length === 0) {
                container.innerHTML = '<p class="text-muted">No hay ofertas recientes para tu rubro.</p>';
                return;
            }

            // 6. Renderizar cards con imágenes
            container.innerHTML = ofertasFiltradas.map(oferta => `
                <div class="oferta-card p-4 mb-2" style="cursor:pointer;" data-oferta-id="${oferta.id}" onclick="abrirModalPresupuesto(${oferta.id})">
                    <span class="categoria-badge">${oferta.categoria || 'Sin categoría'}</span>
                    <h5>${oferta.descripcion || 'Oferta sin descripción'}</h5>
                    <p style="font-size:1.05rem;">${oferta.nombre_cliente ? `<b>Cliente:</b> ${oferta.nombre_cliente}` : ''}</p>
                    ${renderImagenes(oferta.media_url)}
                    <div class="oferta-footer">
                        <span class="text-muted"><i class="bi bi-geo-alt"></i> ${oferta.zona || 'Zona no especificada'}</span>
                        <span class="text-muted"><i class="bi bi-calendar"></i> ${oferta.created_at ? (() => { let d = new Date(oferta.created_at); d.setHours(d.getHours() - 3); return d.toLocaleString('es-AR'); })() : ''}</span>
                    </div>
                    <div class="mt-2">
                        <span class="badge bg-secondary"><i class="bi bi-send me-1"></i>${oferta.presupuestos?.[0]?.count ?? 0} presupuestos enviados</span>
                    </div>
                </div>
            `).join('');

        } catch (error) {
            if (loading) loading.style.display = 'none';
            console.error('Error:', error);
            container.innerHTML = `<p class="text-danger">Error al cargar ofertas: ${error.message}</p>`;
        }
    }

    document.addEventListener('DOMContentLoaded', cargarOfertas);

    // ── Modal de presupuesto ──────────────────────────────────────────────────
    let trabajadorId   = null;
    let trabajadorUuid = null;

    async function obtenerTrabajadorInfo(email) {
        const { data, error } = await db
            .from('usuarios')
            .select('id, usuario_id')
            .eq('email', email)
            .single();
        if (!data) return { id: null, usuario_id: null };
        return {
            id: data.id || null,
            usuario_id: data.usuario_id || data.id || null
        };
    }

    window.abrirModalPresupuesto = async function(ofertaId) {
        const { data: { session } } = await db.auth.getSession();
        if (!session) { window.location.href = 'login.php'; return; }
        const info = await obtenerTrabajadorInfo(session.user.email);
        trabajadorId   = info?.id || null;
        trabajadorUuid = info?.usuario_id || info?.id || null;
        document.getElementById('ofertaIdPresupuesto').value = ofertaId;
        const modal = new bootstrap.Modal(document.getElementById('ofrecerPresupuestoModal'));
        modal.show();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formOfrecerPresupuesto');
        if (form) {
            form.addEventListener('submit', async function(e) {
                e.preventDefault();
                const oferta_id  = document.getElementById('ofertaIdPresupuesto').value;
                const monto      = document.getElementById('precioPresupuesto').value;
                const descripcion = document.getElementById('descripcionPresupuesto').value;
                const horarios   = document.getElementById('horariosPresupuesto').value;
                if (!oferta_id || !trabajadorId || !monto || !descripcion || !horarios) {
                    let msg = 'Completa todos los campos.';
                    if (!trabajadorId || !trabajadorUuid) {
                        msg = 'No se pudo obtener la información del trabajador. Por favor, revisa tu perfil.';
                    }
                    alert(msg);
                    return;
                }
                const { error } = await db.from('presupuestos').insert({
                    oferta_id: oferta_id,
                    trabajador_uuid: trabajadorId,
                    monto: monto,
                    descripcion: descripcion,
                    horarios_disponibles: horarios
                });
                if (error) {
                    alert('Error al enviar presupuesto: ' + error.message);
                } else {
                    bootstrap.Modal.getInstance(document.getElementById('ofrecerPresupuestoModal')).hide();
                    form.reset();
                    alert('¡Presupuesto enviado con éxito!');
                }
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.ProfileChecker && window.supabaseClient) {
            ProfileChecker.init(window.supabaseClient, {
                perfilUrl: 'perfil.php',
                delayMs: 1200,
            });
        }
    });
</script>
<script src="perfil-checker.js"></script>
</body>
</html>