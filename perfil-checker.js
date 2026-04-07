/**
 * perfil-checker.js — Modal con formulario inline para completar campos faltantes
 * No se puede cerrar. Guarda directamente en Supabase.
 */

(function (window) {

  const SUPABASE_URL = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
  const SUPABASE_ANON_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';

  const STYLES = `
    @import url('https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&display=swap');

    #pfc-overlay {
      position: fixed; inset: 0; z-index: 99999;
      background: rgba(15, 18, 35, 0.88);
      backdrop-filter: blur(8px);
      display: flex; align-items: center; justify-content: center;
      opacity: 0; transition: opacity 0.3s ease; pointer-events: none;
      padding: 16px;
    }
    #pfc-overlay.pfc-visible { opacity: 1; pointer-events: all; }

    #pfc-modal {
      background: #fff; border-radius: 20px; width: min(560px, 100%);
      max-height: 90vh; overflow-y: auto;
      box-shadow: 0 32px 80px rgba(0,0,0,0.28);
      transform: translateY(24px) scale(0.97);
      transition: transform 0.35s cubic-bezier(0.22, 1, 0.36, 1);
      font-family: 'DM Sans', sans-serif;
    }
    #pfc-overlay.pfc-visible #pfc-modal { transform: translateY(0) scale(1); }

    #pfc-modal-header {
      background: linear-gradient(135deg, #4b4e6d 0%, #00c2cb 100%);
      padding: 26px 28px 20px; position: relative;
    }
    #pfc-modal-header::after {
      content: ''; position: absolute; bottom: -1px; left: 0;
      width: 100%; height: 18px; background: #fff; border-radius: 20px 20px 0 0;
    }
    #pfc-modal-title { font-family:'Sora',sans-serif; font-size:1.2rem; font-weight:700; color:#fff; margin:0 0 4px; }
    #pfc-modal-subtitle { font-size:0.83rem; color:rgba(255,255,255,0.78); margin:0; }

    #pfc-modal-body { padding: 24px 28px 8px; }

    #pfc-progress-wrap { margin-bottom: 20px; }
    #pfc-progress-label { display:flex; justify-content:space-between; font-size:0.8rem; font-weight:600; color:#555; margin-bottom:7px; }
    #pfc-progress-bar-bg { height:7px; background:#f0f0f4; border-radius:99px; overflow:hidden; }
    #pfc-progress-bar-fill { height:100%; border-radius:99px; background:linear-gradient(90deg,#4b4e6d,#00c2cb); transition:width 0.6s cubic-bezier(0.22,1,0.36,1); }

    #pfc-form { display:flex; flex-direction:column; gap:14px; }

    .pfc-field { display:flex; flex-direction:column; gap:5px; }
    .pfc-field label { font-size:0.84rem; font-weight:600; color:#444; }

    .pfc-field input[type="text"],
    .pfc-field input[type="number"],
    .pfc-field input[type="tel"],
    .pfc-field select {
      width:100%; padding:11px 14px;
      border-radius:10px; border:1px solid #dde1e7;
      background:#f8fafc; font-size:0.95rem;
      font-family:'DM Sans',sans-serif;
      transition: border-color 0.2s, box-shadow 0.2s;
      outline: none;
    }
    .pfc-field input:focus, .pfc-field select:focus {
      border-color:#00c2cb;
      box-shadow: 0 0 0 3px rgba(0,194,203,0.12);
      background:#fff;
    }

    /* Foto de perfil */
    #pfc-foto-preview {
      width:90px; height:90px; border-radius:50%;
      border:2px dashed #ccc;
      display:flex; align-items:center; justify-content:center;
      overflow:hidden; cursor:pointer; margin:0 auto 6px;
      font-size:2rem; color:#ccc; background:#f8fafc;
      transition: border-color 0.2s;
    }
    #pfc-foto-preview:hover { border-color:#00c2cb; }
    #pfc-foto-preview img { width:100%; height:100%; object-fit:cover; border-radius:50%; }

    /* Archivos */
    .pfc-file-label {
      display:flex; align-items:center; gap:8px;
      padding:10px 14px; border-radius:10px;
      border:1px dashed #b0c4d8; background:#f4f8fc;
      cursor:pointer; font-size:0.88rem; color:#4a6a8a;
      transition: background 0.2s, border-color 0.2s;
    }
    .pfc-file-label:hover { background:#e8f4ff; border-color:#00c2cb; }
    .pfc-file-label input[type="file"] { display:none; }
    .pfc-file-name { font-size:0.78rem; color:#888; margin-top:3px; }

    /* Categorías */
    #pfc-cats-chips { display:flex; flex-wrap:wrap; gap:6px; margin-top:6px; }
    .pfc-cat-chip {
      display:inline-flex; align-items:center; gap:5px;
      background:#e8f4ff; border:1px solid #b0d4f0;
      color:#2a6496; border-radius:99px;
      padding:4px 10px; font-size:0.8rem; font-weight:600;
    }
    .pfc-cat-chip button {
      background:none; border:none; cursor:pointer;
      color:#2a6496; font-size:0.9rem; line-height:1; padding:0;
    }

    /* Alert */
    #pfc-alert {
      padding:10px 14px; border-radius:10px;
      font-size:0.85rem; font-weight:600;
      display:none; margin-bottom:6px;
    }
    #pfc-alert.error { background:#fdecea; color:#c0392b; border:1px solid #f5c6c6; }
    #pfc-alert.success { background:#eafaf1; color:#1a7a4a; border:1px solid #b2dfce; }

    #pfc-modal-footer { padding:16px 28px 24px; }
    #pfc-btn-guardar {
      width:100%; background:linear-gradient(135deg,#4b4e6d 0%,#00c2cb 100%);
      color:#fff; border:none; border-radius:50px;
      padding:14px 20px; font-family:'Sora',sans-serif;
      font-size:0.95rem; font-weight:700; cursor:pointer;
      transition:transform 0.15s, box-shadow 0.2s;
      box-shadow:0 4px 14px rgba(0,194,203,0.28);
    }
    #pfc-btn-guardar:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(0,194,203,0.38); }
    #pfc-btn-guardar:disabled { opacity:0.65; cursor:not-allowed; transform:none; }
  `;

  // ─── Campos ───────────────────────────────────────────────────────────────────
  const CAMPOS = [
    { key: ['nombre', 'name'],        label: 'Nombre completo',      type: 'text',   dbKey: 'nombre' },
    { key: ['edad', 'age'],           label: 'Edad',                 type: 'number', dbKey: 'edad' },
    { key: ['dni'],                   label: 'DNI',                  type: 'text',   dbKey: 'dni' },
    { key: ['provincia', 'province'], label: 'Provincia',            type: 'text',   dbKey: 'provincia' },
    { key: ['categoria'],             label: 'Categoría',            type: 'categoria', dbKey: 'categoria', isArray: true },
    { key: ['foto_perfil', 'foto'],   label: 'Foto de perfil',       type: 'foto',   dbKey: 'foto_perfil' },
    { key: ['celular', 'telefono'],   label: 'Teléfono / WhatsApp',  type: 'tel',    dbKey: 'celular' },
    { key: ['ciudad'],                label: 'Ciudad',               type: 'text',   dbKey: 'ciudad', nullable: false },
    { key: ['barrio'],                label: 'Barrio',               type: 'text',   dbKey: 'barrio', nullable: false },
    { key: ['suscriptor'],            label: 'Suscriptor',           type: 'select', dbKey: 'suscriptor',   nullable: true, opciones: [{v:'true',l:'Sí'},{v:'false',l:'No'}] },
    { key: ['antecedentes'],          label: 'Antecedentes (PDF/imagen)', type: 'file', dbKey: 'antecedentes', nullable: true, accept: 'image/*,application/pdf' },
    { key: ['matricula'],             label: 'Matrícula (PDF/imagen)',    type: 'file', dbKey: 'matricula',    nullable: true, accept: 'image/*,application/pdf' },
  ];

  const TOTAL = CAMPOS.length;
  let _supabase = null;
  let _userEmail = null;
  let _userId = null;
  let _categoriasDisponibles = [];
  let _categoriasElegidas = [];

  function pick(obj, keys) {
    for (const k of keys) { if (k in obj) return obj[k]; }
    return undefined;
  }

  function esFaltante(campo, val) {
    if (campo.nullable) return val === null || val === undefined;
    if (val === null || val === undefined) return true;
    if (campo.isArray) return Array.isArray(val) ? val.length === 0 : String(val).trim() === '';
    if (typeof val === 'number') return false;
    return String(val).trim() === '';
  }

  function getCamposFaltantes(usuario) {
    return CAMPOS.filter(c => esFaltante(c, pick(usuario, c.key)));
  }

  function injectStyles() {
    if (document.getElementById('pfc-styles')) return;
    const tag = document.createElement('style');
    tag.id = 'pfc-styles';
    tag.textContent = STYLES;
    document.head.appendChild(tag);
  }

  // ─── Render de cada campo ─────────────────────────────────────────────────────
  function renderCampo(campo) {
    const id = `pfc-input-${campo.dbKey}`;

    if (campo.type === 'foto') {
      return `
        <div class="pfc-field">
          <label>${campo.label}</label>
          <div id="pfc-foto-preview" onclick="document.getElementById('pfc-foto-file').click()">+</div>
          <input type="file" id="pfc-foto-file" accept="image/*" style="display:none">
          <div class="pfc-file-name" id="pfc-foto-name">Hacé click para seleccionar</div>
        </div>`;
    }

    if (campo.type === 'file') {
      return `
        <div class="pfc-field">
          <label>${campo.label}</label>
          <label class="pfc-file-label">
            <span>📎</span>
            <span id="pfc-fname-${campo.dbKey}">Seleccionar archivo...</span>
            <input type="file" id="${id}" accept="${campo.accept || '*'}">
          </label>
        </div>`;
    }

    if (campo.type === 'categoria') {
      return `
        <div class="pfc-field">
          <label>${campo.label} (máx. 3)</label>
          <select id="pfc-cat-select">
            <option value="">Cargando categorías...</option>
          </select>
          <div id="pfc-cats-chips"></div>
        </div>`;
    }

    if (campo.type === 'select') {
      const opts = campo.opciones.map(o => `<option value="${o.v}">${o.l}</option>`).join('');
      return `
        <div class="pfc-field">
          <label>${campo.label}</label>
          <select id="${id}"><option value="">Seleccioná...</option>${opts}</select>
        </div>`;
    }

    return `
      <div class="pfc-field">
        <label>${campo.label}</label>
        <input type="${campo.type}" id="${id}" placeholder="${campo.label}">
      </div>`;
  }

  // ─── Modal ────────────────────────────────────────────────────────────────────
  async function buildModal(camposFaltantes) {
    document.getElementById('pfc-overlay')?.remove();

    const completados = TOTAL - camposFaltantes.length;
    const porcentaje = Math.round((completados / TOTAL) * 100);
    const camposHtml = camposFaltantes.map(renderCampo).join('');

    const overlay = document.createElement('div');
    overlay.id = 'pfc-overlay';
    overlay.innerHTML = `
      <div id="pfc-modal" role="dialog" aria-modal="true">
        <div id="pfc-modal-header">
          <p id="pfc-modal-title">⚠️ Completá tu perfil</p>
          <p id="pfc-modal-subtitle">Estos datos son necesarios para continuar usando Toori</p>
        </div>
        <div id="pfc-modal-body">
          <div id="pfc-progress-wrap">
            <div id="pfc-progress-label">
              <span>Progreso del perfil</span><span>${porcentaje}% completado</span>
            </div>
            <div id="pfc-progress-bar-bg">
              <div id="pfc-progress-bar-fill" style="width:0%"></div>
            </div>
          </div>
          <div id="pfc-alert"></div>
          <form id="pfc-form" onsubmit="return false;">${camposHtml}</form>
        </div>
        <div id="pfc-modal-footer">
          <button id="pfc-btn-guardar">Guardar y continuar</button>
        </div>
      </div>
    `;
    document.body.appendChild(overlay);

    // Bloquear cierre
    overlay.addEventListener('click', e => e.stopPropagation());
    document.addEventListener('keydown', e => { if (e.key === 'Escape') e.preventDefault(); });

    requestAnimationFrame(() => {
      overlay.classList.add('pfc-visible');
      setTimeout(() => {
        const bar = document.getElementById('pfc-progress-bar-fill');
        if (bar) bar.style.width = porcentaje + '%';
      }, 120);
    });

    // ── Foto preview ──
    const fotoFile = document.getElementById('pfc-foto-file');
    if (fotoFile) {
      fotoFile.addEventListener('change', () => {
        if (!fotoFile.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
          const prev = document.getElementById('pfc-foto-preview');
          prev.innerHTML = `<img src="${e.target.result}" alt="preview">`;
          document.getElementById('pfc-foto-name').textContent = fotoFile.files[0].name;
        };
        reader.readAsDataURL(fotoFile.files[0]);
      });
    }

    // ── Archivos: mostrar nombre ──
    camposFaltantes.filter(c => c.type === 'file').forEach(campo => {
      const input = document.getElementById(`pfc-input-${campo.dbKey}`);
      if (input) {
        input.addEventListener('change', () => {
          const nameEl = document.getElementById(`pfc-fname-${campo.dbKey}`);
          if (nameEl && input.files[0]) nameEl.textContent = input.files[0].name;
        });
      }
    });

    // ── Categorías ──
    const catSelect = document.getElementById('pfc-cat-select');
    if (catSelect) {
      _categoriasElegidas = [];
      await cargarCategorias(catSelect);
      catSelect.addEventListener('change', () => {
        const val = catSelect.value;
        if (!val) return;
        if (_categoriasElegidas.length >= 3) { catSelect.value = ''; return; }
        if (!_categoriasElegidas.includes(val)) {
          _categoriasElegidas.push(val);
          renderCatChips();
        }
        catSelect.value = '';
      });
    }

    // ── Guardar ──
    document.getElementById('pfc-btn-guardar').addEventListener('click', () => guardar(camposFaltantes));
  }

  function renderCatChips() {
    const cont = document.getElementById('pfc-cats-chips');
    if (!cont) return;
    cont.innerHTML = _categoriasElegidas.map(cat => `
      <span class="pfc-cat-chip">
        ${cat}
        <button type="button" onclick="
          window._pfcQuitarCat('${cat}')
        ">✕</button>
      </span>`).join('');
  }

  window._pfcQuitarCat = function(cat) {
    _categoriasElegidas = _categoriasElegidas.filter(c => c !== cat);
    renderCatChips();
  };

  async function cargarCategorias(select) {
    if (_categoriasDisponibles.length > 0) {
      poblarSelect(select);
      return;
    }
    try {
      const sb = _supabase || window.supabaseClient;
      const { data, error } = await sb.from('categorias').select('nombre').order('nombre');
      if (!error && data) {
        _categoriasDisponibles = data.map(d => d.nombre);
        poblarSelect(select);
      }
    } catch(e) {
      select.innerHTML = '<option value="">Error cargando</option>';
    }
  }

  function poblarSelect(select) {
    select.innerHTML = '<option value="">Agregar categoría...</option>';
    _categoriasDisponibles.forEach(nombre => {
      const opt = document.createElement('option');
      opt.value = nombre;
      opt.textContent = nombre;
      select.appendChild(opt);
    });
  }

  function showAlert(msg, tipo = 'error') {
    const el = document.getElementById('pfc-alert');
    if (!el) return;
    el.className = tipo;
    el.textContent = msg;
    el.style.display = 'block';
  }

  // ─── Guardar en Supabase ──────────────────────────────────────────────────────
  async function guardar(camposFaltantes) {
    const btn = document.getElementById('pfc-btn-guardar');
    btn.disabled = true;
    btn.textContent = 'Guardando...';

    const sb = _supabase || window.supabaseClient;
    if (!sb) { showAlert('Error: cliente Supabase no disponible.'); btn.disabled=false; btn.textContent='Guardar y continuar'; return; }

    try {
      // Si _userEmail/_userId no están seteados (vía check directo), obtenerlos de la sesión
      if (!_userEmail || !_userId) {
        const { data: { session } } = await sb.auth.getSession();
        if (!session) { showAlert('No hay sesión activa.'); btn.disabled=false; btn.textContent='Guardar y continuar'; return; }
        _userEmail = session.user.email;
        _userId = session.user.id;
      }

      const updates = {};

      for (const campo of camposFaltantes) {
        const id = `pfc-input-${campo.dbKey}`;

        // Foto de perfil
        if (campo.type === 'foto') {
          const file = document.getElementById('pfc-foto-file')?.files[0];
          if (file) {
            const ext = file.name.split('.').pop();
            const path = `imagenes/${_userId}-perfil-${Date.now()}.${ext}`;
            const { data: up, error: upErr } = await sb.storage.from('imagenes').upload(path, file, { upsert: true });
            if (upErr) throw new Error('Error subiendo foto: ' + upErr.message);
            updates['foto_perfil'] = `${SUPABASE_URL}/storage/v1/object/public/${up.fullPath}`;
          }
          continue;
        }

        // Archivos (matricula, antecedentes)
        if (campo.type === 'file') {
          const file = document.getElementById(id)?.files[0];
          if (file) {
            const ext = file.name.split('.').pop();
            const path = `imagenes/${_userId}-${campo.dbKey}-${Date.now()}.${ext}`;
            const { data: up, error: upErr } = await sb.storage.from('imagenes').upload(path, file, { upsert: true });
            if (upErr) throw new Error(`Error subiendo ${campo.label}: ` + upErr.message);
            updates[campo.dbKey] = [`${SUPABASE_URL}/storage/v1/object/public/${up.fullPath}`];
          }
          continue;
        }

        // Categorías
        if (campo.type === 'categoria') {
          if (_categoriasElegidas.length === 0) {
            showAlert('Por favor elegí al menos una categoría.');
            btn.disabled = false;
            btn.textContent = 'Guardar y continuar';
            return;
          }
          updates['categoria'] = _categoriasElegidas;
          continue;
        }

        // Select (suscriptor, verificado)
        if (campo.type === 'select') {
          const el = document.getElementById(id);
          if (el && el.value !== '') {
            updates[campo.dbKey] = el.value === 'true';
          }
          continue;
        }

        // Inputs normales
        const el = document.getElementById(id);
        if (el) {
          const val = el.value.trim();
          if (val !== '') {
            updates[campo.dbKey] = campo.type === 'number' ? (parseFloat(val) || null) : val;
          }
        }
      }

      if (Object.keys(updates).length === 0) {
        showAlert('Completá al menos un campo.');
        btn.disabled = false;
        btn.textContent = 'Guardar y continuar';
        return;
      }

      const { error } = await sb.from('usuarios').update(updates).eq('email', _userEmail);
      if (error) throw new Error(error.message);

      showAlert('¡Guardado correctamente!', 'success');
      setTimeout(() => window.location.reload(), 1000);

    } catch (err) {
      showAlert('Error: ' + err.message);
      btn.disabled = false;
      btn.textContent = 'Guardar y continuar';
    }
  }

  // ─── API pública ──────────────────────────────────────────────────────────────
  function check(usuario, opts = {}) {
    if (!usuario) return;
    injectStyles();
    const faltantes = getCamposFaltantes(usuario);
    console.log('[ProfileChecker] Faltantes:', faltantes.map(c => c.label));
    if (faltantes.length === 0 && !opts.force) return;
    buildModal(faltantes);
  }

  async function init(supabaseClient, opts = {}) {
    if (!supabaseClient) return;
    _supabase = supabaseClient;
    injectStyles();
    try {
      const { data: { session } } = await supabaseClient.auth.getSession();
      if (!session) return;
      _userEmail = session.user.email;
      _userId = session.user.id;

      const { data: usuario, error } = await supabaseClient
        .from('usuarios').select('*').eq('email', _userEmail).single();
      if (error || !usuario) return;
      if (opts.soloTrabajadores && usuario.rol !== 'trabajador') return;

      setTimeout(() => check(usuario, opts), opts.delayMs ?? 800);
    } catch (e) {
      console.warn('[ProfileChecker] Error:', e);
    }
  }

  window.ProfileChecker = { check, init, getCamposFaltantes: u => getCamposFaltantes(u).map(c => c.label) };

})(window);