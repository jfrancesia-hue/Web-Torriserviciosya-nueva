<?php
$supabase_url = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
$supabase_key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';

$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, $supabase_url . "/rest/v1/nuevaOferta?pagado=eq.true&select=id");
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch1, CURLOPT_HTTPHEADER, [
    'apikey: ' . $supabase_key,
    'Authorization: Bearer ' . $supabase_key,
    'Content-Type: application/json'
]);
$result1 = curl_exec($ch1);
$ofertas_pagadas = 0;
if (!curl_errno($ch1) && $result1 !== false) {
    $data1 = json_decode($result1, true);
    if (is_array($data1)) $ofertas_pagadas = count($data1);
}
curl_close($ch1);

$fecha_inicio = '2026-03-11T00:00:00';
$ch2 = curl_init();
$url2 = $supabase_url . "/rest/v1/usuarios?rol=eq.worker&creado_en=gte." . urlencode($fecha_inicio) . "&nombre=not.is.null&select=id";
curl_setopt($ch2, CURLOPT_URL, $url2);
curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch2, CURLOPT_HTTPHEADER, [
    'apikey: ' . $supabase_key,
    'Authorization: Bearer ' . $supabase_key,
    'Content-Type: application/json'
]);
$result2 = curl_exec($ch2);
$profesionales_registrados = 0;
if (!curl_errno($ch2) && $result2 !== false) {
    $data2 = json_decode($result2, true);
    if (is_array($data2)) $profesionales_registrados = count($data2);
}
curl_close($ch2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard · Toori</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:        #f0f2f7;
            --surface:   #ffffff;
            --border:    #e4e7ef;
            --text:      #1a1d2e;
            --muted:     #8890a8;
            --accent:    #4361ee;
            --accent-lt: #eef1fd;
            --green:     #10b981;
            --green-lt:  #d1fae5;
            --red:       #ef4444;
            --red-lt:    #fee2e2;
            --amber:     #f59e0b;
            --amber-lt:  #fef3c7;
            --radius:    12px;
            --shadow:    0 1px 3px rgba(0,0,0,.08), 0 4px 16px rgba(0,0,0,.06);
        }

        body {
            background: var(--bg);
            font-family: 'DM Sans', sans-serif;
            color: var(--text);
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 0 2rem;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .navbar-brand {
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .navbar-brand .dot {
            width: 8px; height: 8px;
            background: var(--accent);
            border-radius: 50%;
        }

        /* ── LAYOUT ── */
        .page { max-width: 1600px; margin: 0 auto; padding: 2rem; }

        /* ── STATS ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1.5rem 1.75rem;
            display: flex;
            align-items: center;
            gap: 1rem;
            box-shadow: var(--shadow);
        }
        .stat-icon {
            width: 48px; height: 48px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .stat-icon.green { background: var(--green-lt); color: var(--green); }
        .stat-icon.blue  { background: var(--accent-lt); color: var(--accent); }
        .stat-number { font-size: 2rem; font-weight: 600; line-height: 1; }
        .stat-label  { font-size: .8rem; color: var(--muted); margin-top: .25rem; }

        /* ── COLLAPSIBLE SECTION ── */
        .section-wrap { margin-bottom: 1.5rem; }

        .section-toggle {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            cursor: pointer;
            font-family: inherit;
            font-size: 1rem;
            font-weight: 600;
            color: var(--text);
            box-shadow: var(--shadow);
            transition: background .15s;
            text-align: left;
        }
        .section-toggle:hover { background: var(--bg); }
        .section-toggle.open { border-bottom-left-radius: 0; border-bottom-right-radius: 0; border-bottom-color: transparent; }

        .section-toggle .toggle-icon {
            margin-left: auto;
            font-size: 1rem;
            color: var(--muted);
            transition: transform .25s;
        }
        .section-toggle.open .toggle-icon { transform: rotate(180deg); }

        .badge-count {
            font-size: .72rem;
            font-weight: 600;
            padding: .2rem .6rem;
            border-radius: 20px;
        }
        .badge-count.pending { background: var(--amber-lt); color: var(--amber); }
        .badge-count.public  { background: var(--green-lt);  color: var(--green); }

        .section-body {
            background: var(--bg);
            border: 1px solid var(--border);
            border-top: none;
            border-bottom-left-radius: var(--radius);
            border-bottom-right-radius: var(--radius);
            padding: 1rem;
            display: none;
        }
        .section-body.open { display: block; }

        /* ── CARDS GRID ── */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
            gap: 1rem;
        }

        /* ── BTN BASE ── */
        .btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .45rem 1rem;
            border-radius: 8px;
            font-size: .82rem;
            font-family: inherit;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all .15s;
            text-decoration: none;
        }
        .btn-ghost {
            background: transparent;
            border: 1px solid var(--border);
            color: var(--muted);
        }
        .btn-ghost:hover { background: var(--bg); color: var(--text); }

        .btn-approve {
            background: var(--green);
            color: #fff;
            flex: 1;
            justify-content: center;
        }
        .btn-approve:hover { background: #0ea271; }
        .btn-approve:disabled { background: #a7f3d0; cursor: not-allowed; }

        .btn-unpublish {
            background: var(--red-lt);
            color: var(--red);
            border: 1px solid rgba(239,68,68,.25);
            flex: 1;
            justify-content: center;
        }
        .btn-unpublish:hover { background: #fecaca; }
        .btn-unpublish:disabled { opacity: .5; cursor: not-allowed; }

        .btn-wsp {
            background: transparent;
            border: 1px solid #25d366;
            color: #25d366;
        }
        .btn-wsp:hover { background: #25d366; color: #fff; }
        .btn-wsp[disabled] { opacity: .35; pointer-events: none; }

        /* ── PROFESSIONAL CARD ── */
        .pro-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: box-shadow .2s, transform .2s;
            animation: cardIn .25s ease both;
        }
        .pro-card:hover {
            box-shadow: 0 4px 24px rgba(67,97,238,.12);
            transform: translateY(-2px);
        }
        .pro-card.public-card { border-top: 3px solid var(--green); }

        .pro-card-head {
            display: flex;
            align-items: center;
            gap: .85rem;
            padding: 1rem 1.25rem;
            border-bottom: 1px solid var(--border);
        }
        .pro-avatar {
            width: 52px; height: 52px;
            border-radius: 10px;
            object-fit: cover;
            flex-shrink: 0;
            background: var(--bg);
        }
        .pro-avatar-placeholder {
            width: 52px; height: 52px;
            border-radius: 10px;
            background: var(--accent-lt);
            color: var(--accent);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .pro-name  { font-weight: 600; font-size: .95rem; line-height: 1.2; }
        .pro-email { font-size: .78rem; color: var(--muted); margin-top: .15rem; }
        .pro-rol-badge {
            margin-left: auto;
            background: var(--accent-lt);
            color: var(--accent);
            font-size: .7rem;
            font-weight: 600;
            padding: .2rem .6rem;
            border-radius: 20px;
            white-space: nowrap;
            flex-shrink: 0;
        }

        .pro-card-body {
            padding: .85rem 1.25rem;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .55rem .75rem;
            flex: 1;
        }
        .pro-field { display: flex; flex-direction: column; gap: .1rem; }
        .pro-field.full { grid-column: 1 / -1; }
        .pro-field-label {
            font-size: .68rem;
            font-weight: 600;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: .04em;
            display: flex;
            align-items: center;
            gap: .3rem;
        }
        .pro-field-value {
            font-size: .82rem;
            color: var(--text);
            font-family: 'DM Mono', monospace;
        }
        .pro-field-value.missing { color: var(--red); font-style: italic; }
        .pro-field-value.tag {
            font-family: 'DM Sans', sans-serif;
            display: inline-flex;
            flex-wrap: wrap;
            gap: .25rem;
        }
        .tag-pill {
            background: var(--accent-lt);
            color: var(--accent);
            font-size: .72rem;
            padding: .15rem .5rem;
            border-radius: 20px;
            font-weight: 500;
        }

        /* ── EDITABLE INPUTS ── */
        .editable-input {
            font-size: .82rem;
            font-family: 'DM Mono', monospace;
            color: var(--text);
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: 6px;
            padding: .3rem .5rem;
            width: 100%;
            outline: none;
            transition: border-color .15s, background .15s, box-shadow .15s;
        }
        .editable-input:focus {
            border-color: var(--accent);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(67,97,238,.12);
        }
        .editable-input.saving {
            border-color: var(--amber);
            background: var(--amber-lt);
        }
        .editable-input.saved {
            border-color: var(--green);
            background: var(--green-lt);
        }
        .editable-input.error {
            border-color: var(--red);
            background: var(--red-lt);
        }
        .editable-input::placeholder { color: var(--muted); font-style: italic; }

        /* save indicator dot */
        .save-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
            flex-shrink: 0;
            opacity: 0;
            transition: opacity .2s;
        }
        .save-dot.saving { background: var(--amber); opacity: 1; }
        .save-dot.saved  { background: var(--green);  opacity: 1; }
        .save-dot.error  { background: var(--red);    opacity: 1; }

        /* editable select */
        .editable-select {
            font-size: .82rem;
            font-family: 'DM Mono', monospace;
            color: var(--text);
            background: var(--bg);
            border: 1.5px solid var(--border);
            border-radius: 6px;
            padding: .3rem .5rem;
            width: 100%;
            outline: none;
            transition: border-color .15s, background .15s;
            cursor: pointer;
        }
        .editable-select:focus { border-color: var(--accent); background: var(--surface); }

        .pro-card-missing {
            margin: 0 1.25rem .75rem;
            background: var(--red-lt);
            border-radius: 8px;
            padding: .5rem .75rem;
            font-size: .75rem;
            color: var(--red);
        }
        .pro-card-missing strong { font-weight: 600; }

        .pro-card-foot {
            padding: .85rem 1.25rem;
            border-top: 1px solid var(--border);
            display: flex;
            gap: .5rem;
        }

        /* ── DOC BUTTON ── */
        .doc-btn {
            display: inline-flex;
            align-items: center;
            gap: .35rem;
            padding: .3rem .75rem;
            border-radius: 20px;
            font-size: .78rem;
            font-family: 'DM Sans', sans-serif;
            font-weight: 500;
            background: rgba(16,185,129,.12);
            color: var(--green);
            border: 1px solid rgba(16,185,129,.3);
            text-decoration: none;
            transition: background .15s, border-color .15s;
            width: fit-content;
        }
        .doc-btn:hover { background: rgba(16,185,129,.22); border-color: rgba(16,185,129,.5); color: var(--green); }
        .doc-btn i { font-size: .85rem; }

        /* ── STATES ── */
        .state-box {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 3rem;
            text-align: center;
            color: var(--muted);
            font-size: .9rem;
        }
        .state-box i { font-size: 2.5rem; display: block; margin-bottom: .75rem; opacity: .4; }

        .spinner {
            width: 24px; height: 24px;
            border: 3px solid var(--border);
            border-top-color: var(--accent);
            border-radius: 50%;
            animation: spin .7s linear infinite;
            margin: 0 auto 1rem;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        @keyframes cardIn {
            from { opacity: 0; transform: translateY(10px); }
            to   { opacity: 1; transform: translateY(0); }
        }
    </style>
    <?php include_once __DIR__ . '/../includes/supabase.php'; ?>
</head>

<body>

    <nav class="navbar">
        <div class="navbar-brand">
            <span class="dot"></span> Toori Admin
        </div>
        <button id="btn-refresh" class="btn btn-ghost">
            <i class="bi bi-arrow-clockwise"></i> Refrescar
        </button>
    </nav>

    <div class="page">

        <!-- ── STATS ── -->
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-icon green"><i class="bi bi-bag-check-fill"></i></div>
                <div>
                    <div class="stat-number"><?php echo $ofertas_pagadas; ?></div>
                    <div class="stat-label">Ofertas pagadas / contratadas</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon blue"><i class="bi bi-people-fill"></i></div>
                <div>
                    <div class="stat-number"><?php echo $profesionales_registrados; ?></div>
                    <div class="stat-label">Profesionales registrados</div>
                </div>
            </div>
        </div>

        <!-- ── SECCIÓN 1: PENDIENTES ── -->
        <div class="section-wrap">
            <button class="section-toggle open" id="toggle-pending" onclick="toggleSection('pending')">
                <i class="bi bi-person-clock" style="color:var(--amber)"></i>
                Pendientes de aprobación
                <span class="badge-count pending" id="badge-pending">—</span>
                <i class="bi bi-chevron-down toggle-icon"></i>
            </button>
            <div class="section-body open" id="body-pending">
                <div class="cards-grid" id="grid-pending">
                    <div class="state-box" style="grid-column:1/-1">
                        <div class="spinner"></div>
                        Cargando...
                    </div>
                </div>
            </div>
        </div>

        <!-- ── SECCIÓN 2: PÚBLICOS ── -->
        <div class="section-wrap">
            <button class="section-toggle" id="toggle-public" onclick="toggleSection('public')">
                <i class="bi bi-globe2" style="color:var(--green)"></i>
                Perfiles públicos activos
                <span class="badge-count public" id="badge-public">—</span>
                <i class="bi bi-chevron-down toggle-icon"></i>
            </button>
            <div class="section-body" id="body-public">
                <div class="cards-grid" id="grid-public">
                    <div class="state-box" style="grid-column:1/-1">
                        <div class="spinner"></div>
                        Cargando...
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /page -->

    <script>
        const btnRefresh = document.getElementById('btn-refresh');

        /* ── TOGGLE ── */
        function toggleSection(which) {
            const btn  = document.getElementById(`toggle-${which}`);
            const body = document.getElementById(`body-${which}`);
            btn.classList.toggle('open');
            body.classList.toggle('open');
        }

        /* ── HELPERS ── */
        function safeText(v) {
            return (v === null || v === undefined || String(v).trim() === '') ? null : String(v).trim();
        }
        function isMissing(v) {
            if (v === null || v === undefined) return true;
            if (typeof v === 'boolean')  return false;
            if (typeof v === 'number')   return false;
            if (typeof v === 'string')   return v.trim() === '';
            if (Array.isArray(v))        return v.length === 0;
            if (typeof v === 'object')   return Object.keys(v).length === 0;
            return false;
        }
        function formatDate(ts) {
            if (!ts) return null;
            try { return new Date(ts).toLocaleDateString('es-AR', { day:'2-digit', month:'short', year:'numeric' }); }
            catch(e) { return String(ts); }
        }
        function sanitizePhone(cel) {
            if (!cel) return '';
            return String(cel).replace(/\D/g, '');
        }

        /* Static field (read-only, used in public cards) */
        function fieldHTML(label, value, full = false) {
            const missing = value === null || value === undefined || value === '';
            const cls = `pro-field${full ? ' full' : ''}`;
            const valHtml = missing
                ? `<span class="pro-field-value missing">Sin dato</span>`
                : `<span class="pro-field-value">${value}</span>`;
            return `<div class="${cls}"><span class="pro-field-label">${label}</span>${valHtml}</div>`;
        }

        function editableFieldHTML(label, dbKey, userId, value, full = false) {
            const cls  = `pro-field${full ? ' full' : ''}`;
            const val  = (value === null || value === undefined) ? '' : String(value);
            const dotId = `dot-${userId}-${dbKey}`;
            return `
                <div class="${cls}">
                    <span class="pro-field-label">
                        ${label}
                        <span class="save-dot" id="${dotId}"></span>
                    </span>
                    <input
                        class="editable-input"
                        type="text"
                        value="${val.replace(/"/g, '&quot;')}"
                        placeholder="Ingresar ${label.toLowerCase()}…"
                        data-user-id="${userId}"
                        data-field="${dbKey}"
                        data-dot="${dotId}"
                        onblur="saveField(this)"
                        onkeydown="if(event.key==='Enter'){this.blur();}"
                    />
                </div>`;
        }

        function editableSelectHTML(label, dbKey, userId, value, options, full = false) {
            const cls = `pro-field${full ? ' full' : ''}`;
            const dotId = `dot-${userId}-${dbKey}`;
            const opts = options.map(o => {
                const sel = (value && String(value) === String(o)) ? 'selected' : '';
                return `<option value="${o}" ${sel}>${o}</option>`;
            }).join('');
            return `
                <div class="${cls}">
                    <span class="pro-field-label">
                        ${label}
                        <span class="save-dot" id="${dotId}"></span>
                    </span>
                    <select
                        class="editable-select"
                        data-user-id="${userId}"
                        data-field="${dbKey}"
                        data-dot="${dotId}"
                        onchange="saveField(this)"
                    >
                        <option value="">— sin dato —</option>
                        ${opts}
                    </select>
                </div>`;
        }

        function resolveDocUrl(val) {
            if (!val) return null;
            if (Array.isArray(val)) return val.find(v => typeof v === 'string' && v.startsWith('http')) || null;
            if (typeof val === 'string' && val.trim().startsWith('[')) {
                try {
                    const p = JSON.parse(val);
                    if (Array.isArray(p)) return p.find(v => typeof v === 'string' && v.startsWith('http')) || null;
                } catch(e) {}
            }
            if (typeof val === 'string' && val.startsWith('http')) return val;
            return null;
        }
        function docFieldHTML(label, val) {
            const url = resolveDocUrl(val);
            if (url) return `<div class="pro-field"><span class="pro-field-label">${label}</span><a class="doc-btn" href="${url}" target="_blank" rel="noopener"><i class="bi bi-file-earmark-check-fill"></i>${label} cargado · Ver</a></div>`;
            return `<div class="pro-field"><span class="pro-field-label">${label}</span><span class="pro-field-value missing">Sin documento</span></div>`;
        }
        function categoriaHTML(cat) {
            if (!cat || (Array.isArray(cat) && cat.length === 0)) return null;
            const items = Array.isArray(cat) ? cat : [cat];
            return `<div class="pro-field full"><span class="pro-field-label">Categoría</span><div class="pro-field-value tag">${items.map(c => `<span class="tag-pill">${c}</span>`).join('')}</div></div>`;
        }

        const requiredLabels = {
            nombre: 'nombre', email: 'email', edad: 'edad', dni: 'DNI',
            celular: 'celular', barrio: 'barrio', ciudad: 'ciudad',
            antiguedad: 'antigüedad', matricula: 'matrícula',
            antecedentes: 'antecedentes', foto_perfil: 'foto',
            categoria: 'categoría', rol: 'rol', provincia: 'provincia'
        };

        /* ── SAVE FIELD ── */
        async function saveField(el) {
            const userId = el.dataset.userId;
            const field  = el.dataset.field;
            const dotId  = el.dataset.dot;
            const dot    = document.getElementById(dotId);
            const val    = el.value.trim();

            if (el._lastSaved !== undefined && el._lastSaved === val) return;
            el._lastSaved = val;

            const patch = {};
            patch[field] = val === '' ? null : (field === 'categoria' ? [val] : val);

            el.classList.add('saving');
            if (dot) { dot.className = 'save-dot saving'; }

            const supabase = window.supabaseClient;
            const { error } = await supabase
                .from('usuarios')
                .update(patch)
                .eq('id', userId);

            el.classList.remove('saving');
            if (error) {
                el.classList.add('error');
                if (dot) { dot.className = 'save-dot error'; dot.title = error.message; }
                setTimeout(() => { el.classList.remove('error'); if (dot) dot.className = 'save-dot'; }, 3000);
            } else {
                el.classList.add('saved');
                if (dot) { dot.className = 'save-dot saved'; }
                setTimeout(() => { el.classList.remove('saved'); if (dot) dot.className = 'save-dot'; }, 1800);

                const card = el.closest('.pro-card');
                if (card) refreshMissingWarning(card, userId);
            }
        }

        function refreshMissingWarning(card, userId) {
            const inputs  = card.querySelectorAll('[data-user-id]');
            const current = {};
            inputs.forEach(inp => { current[inp.dataset.field] = inp.value.trim(); });

            const missing = Object.keys(requiredLabels).filter(k => {
                if (k === 'matricula' || k === 'antecedentes') {
                    return card.querySelector(`.doc-btn`) === null;
                }
                const v = current[k];
                return v === undefined || v === '';
            });

            let warn = card.querySelector('.pro-card-missing');
            if (missing.length > 0) {
                const html = `<strong>⚠ Faltan:</strong> ${missing.map(k => requiredLabels[k]).join(', ')}`;
                if (warn) { warn.innerHTML = html; }
                else {
                    warn = document.createElement('div');
                    warn.className = 'pro-card-missing';
                    warn.innerHTML = html;
                    const foot = card.querySelector('.pro-card-foot');
                    card.insertBefore(warn, foot);
                }
            } else {
                if (warn) warn.remove();
            }
        }

        /* ── BUILD CARD ── */
        function buildCard(u, mode) {
            const celular = sanitizePhone(u.celular);
            const waHref  = celular ? `https://wa.me/54${celular}` : null;
            const fecha   = formatDate(u.creado_en);

            const avatarHTML = u.foto_perfil
                ? `<img src="${u.foto_perfil}" class="pro-avatar" alt="foto">`
                : `<div class="pro-avatar-placeholder"><i class="bi bi-person"></i></div>`;

            const missing = Object.keys(requiredLabels).filter(k => {
                if (k === 'matricula' || k === 'antecedentes') return resolveDocUrl(u[k]) === null;
                return isMissing(u[k]);
            });
            const missingHTML = missing.length > 0
                ? `<div class="pro-card-missing"><strong>⚠ Faltan:</strong> ${missing.map(k => requiredLabels[k]).join(', ')}</div>`
                : '';

            let bodyHTML = '';
            if (mode === 'pending') {
                bodyHTML = `
                    ${editableFieldHTML('Nombre', 'nombre', u.id, u.nombre)}
                    ${editableFieldHTML('Email', 'email', u.id, u.email)}
                    ${editableFieldHTML('DNI', 'dni', u.id, u.dni)}
                    ${editableFieldHTML('Edad', 'edad', u.id, u.edad)}
                    ${editableFieldHTML('Celular', 'celular', u.id, u.celular)}
                    ${editableFieldHTML('Antigüedad', 'antiguedad', u.id, u.antiguedad)}
                    ${editableFieldHTML('Ciudad', 'ciudad', u.id, u.ciudad)}
                    ${editableFieldHTML('Barrio', 'barrio', u.id, u.barrio)}
                    ${editableFieldHTML('Provincia', 'provincia', u.id, u.provincia, true)}
                    ${docFieldHTML('Matrícula', u.matricula)}
                    ${docFieldHTML('Antecedentes', u.antecedentes)}
                    ${editableSelectHTML('Categoría', 'categoria', u.id, Array.isArray(u.categoria) ? u.categoria[0] : u.categoria, window._categorias || [], true)}
                    ${fieldHTML('Registrado', fecha)}
                `;
            } else {
                const loc = [safeText(u.ciudad), safeText(u.barrio), safeText(u.provincia)].filter(Boolean).join(' · ') || null;
                bodyHTML = `
                    ${fieldHTML('DNI', safeText(u.dni))}
                    ${fieldHTML('Edad', safeText(u.edad))}
                    ${fieldHTML('Celular', safeText(u.celular))}
                    ${fieldHTML('Antigüedad', safeText(u.antiguedad))}
                    ${fieldHTML('Ubicación', loc, true)}
                    ${docFieldHTML('Matrícula', u.matricula)}
                    ${docFieldHTML('Antecedentes', u.antecedentes)}
                    ${categoriaHTML(u.categoria) || fieldHTML('Categoría', null, true)}
                    ${fieldHTML('Registrado', fecha)}
                `;
            }

            let footBtns = '';
            if (mode === 'pending') {
                footBtns = `
                    <button class="btn btn-approve" onclick="setPublic('${u.id}', true, this)">
                        <i class="bi bi-check-lg"></i> Aprobar y publicar
                    </button>
                    ${waHref
                        ? `<a class="btn btn-wsp" target="_blank" href="${waHref}"><i class="bi bi-whatsapp"></i></a>`
                        : `<button class="btn btn-wsp" disabled><i class="bi bi-whatsapp"></i></button>`
                    }`;
            } else {
                footBtns = `
                    <button class="btn btn-unpublish" onclick="setPublic('${u.id}', false, this)">
                        <i class="bi bi-eye-slash"></i> Despublicar
                    </button>
                    ${waHref
                        ? `<a class="btn btn-wsp" target="_blank" href="${waHref}"><i class="bi bi-whatsapp"></i></a>`
                        : `<button class="btn btn-wsp" disabled><i class="bi bi-whatsapp"></i></button>`
                    }`;
            }

            const card = document.createElement('div');
            card.className = `pro-card${mode === 'public' ? ' public-card' : ''}`;
            card.dataset.id = u.id;
            card.innerHTML = `
                <div class="pro-card-head">
                    ${avatarHTML}
                    <div>
                        <div class="pro-name">${safeText(u.nombre) || '<span style="color:var(--red)">Sin nombre</span>'}</div>
                        <div class="pro-email">${safeText(u.email) || '—'}</div>
                    </div>
                    ${safeText(u.rol) ? `<span class="pro-rol-badge">${u.rol}</span>` : ''}
                </div>
                <div class="pro-card-body">${bodyHTML}</div>
                ${missingHTML}
                <div class="pro-card-foot">${footBtns}</div>
            `;

            card.querySelectorAll('[data-user-id]').forEach(inp => {
                inp._lastSaved = inp.value.trim();
            });

            return card;
        }

        /* ── LOAD DATA ── */
        async function loadAll() {
            const supabase = window.supabaseClient;
            if (!supabase) return;

            // Cargar categorías para los selects
            if (!window._categorias) {
                const { data: cats } = await supabase.from('categorias').select('nombre').order('nombre');
                window._categorias = cats ? cats.map(c => c.nombre) : [];
            }

            const fields = `id, nombre, email, edad, dni, celular, barrio, ciudad, antiguedad, matricula, antecedentes, foto_perfil, categoria, rol, provincia, creado_en, perfilPublico`;

            // ── Pendientes (desde 2026-03-01) ──
            const gridPending  = document.getElementById('grid-pending');
            const badgePending = document.getElementById('badge-pending');
            gridPending.innerHTML = `<div class="state-box" style="grid-column:1/-1"><div class="spinner"></div>Cargando...</div>`;

            const { data: pending, error: err1 } = await supabase
                .from('usuarios')
                .select(fields)
                .eq('rol', 'worker')
                .neq('perfilPublico', true)
                .gte('creado_en', '2026-03-01T00:00:00')
                .order('creado_en', { ascending: false })
                .limit(500);

            if (err1) {
                gridPending.innerHTML = `<div class="state-box" style="grid-column:1/-1"><i class="bi bi-x-circle"></i>Error: ${err1.message}</div>`;
            } else if (!pending || pending.length === 0) {
                gridPending.innerHTML = `<div class="state-box" style="grid-column:1/-1"><i class="bi bi-check2-circle" style="color:var(--green);opacity:1"></i>¡No hay pendientes!</div>`;
                badgePending.textContent = '0';
            } else {
                badgePending.textContent = pending.length;
                gridPending.innerHTML = '';
                pending.forEach((u, i) => {
                    const card = buildCard(u, 'pending');
                    card.style.animationDelay = `${i * 35}ms`;
                    gridPending.appendChild(card);
                });
            }

            // ── Públicos ──
            const gridPublic  = document.getElementById('grid-public');
            const badgePublic = document.getElementById('badge-public');
            gridPublic.innerHTML = `<div class="state-box" style="grid-column:1/-1"><div class="spinner"></div>Cargando...</div>`;

            const { data: publicos, error: err2 } = await supabase
                .from('usuarios')
                .select(fields)
                .eq('rol', 'worker')
                .eq('perfilPublico', true)
                .order('creado_en', { ascending: false })
                .limit(500);

            if (err2) {
                gridPublic.innerHTML = `<div class="state-box" style="grid-column:1/-1"><i class="bi bi-x-circle"></i>Error: ${err2.message}</div>`;
            } else if (!publicos || publicos.length === 0) {
                gridPublic.innerHTML = `<div class="state-box" style="grid-column:1/-1"><i class="bi bi-globe2" style="opacity:.3"></i>Sin perfiles públicos aún.</div>`;
                badgePublic.textContent = '0';
            } else {
                badgePublic.textContent = publicos.length;
                gridPublic.innerHTML = '';
                publicos.forEach((u, i) => {
                    const card = buildCard(u, 'public');
                    card.style.animationDelay = `${i * 35}ms`;
                    gridPublic.appendChild(card);
                });
            }
        }

        /* ── SET perfilPublico ── */
        async function setPublic(id, value, btn) {
            const action = value ? 'publicar este perfil' : 'despublicar este perfil';
            if (!confirm(`¿Confirmar: ${action}?`)) return;

            btn.disabled = true;
            btn.innerHTML = `<i class="bi bi-hourglass-split"></i> Procesando...`;

            const supabase = window.supabaseClient;
            const { error } = await supabase
                .from('usuarios')
                .update({ perfilPublico: value })
                .eq('id', id);

            if (error) {
                alert('Error: ' + error.message);
                btn.disabled = false;
                btn.innerHTML = value
                    ? '<i class="bi bi-check-lg"></i> Aprobar y publicar'
                    : '<i class="bi bi-eye-slash"></i> Despublicar';
                return;
            }

            const card = btn.closest('.pro-card');
            if (card) {
                card.style.transition = 'opacity .3s, transform .3s';
                card.style.opacity = '0';
                card.style.transform = 'scale(.95)';
                setTimeout(() => { card.remove(); loadAll(); }, 300);
            }
        }

        btnRefresh.addEventListener('click', loadAll);
        window.addEventListener('DOMContentLoaded', loadAll);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>