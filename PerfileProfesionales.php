<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Perfile Profesionales - Toori ServiciosYa</title>
  <meta name="description" content="Perfile Profesionales - Toori ServiciosYa">
  <meta property="og:title" content="Perfile Profesionales - Toori ServiciosYa">
  <meta property="og:description" content="Perfile Profesionales - Toori ServiciosYa">
  <meta property="og:image" content="assets/logo.png">
  <meta property="og:url" content="https://tooriserviciosya.com">
  <meta property="og:type" content="website">
  <link rel="icon" type="image/png" href="assets/logo.png">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
</head>

<body>

  <?php include 'header.php'; ?>

  <main style="padding:40px;text-align:center;">
    <div class="container">
      <h1 style="margin-bottom:16px;">Perfile Profesionales</h1>
      <p style="color:#555;">Esta página muestra los profesionales (usuarios con rol <code>worker</code>) registrados.</p>

      <div id="workers-area" style="margin-top:24px;">
        <div id="workers-loading" style="color:#666;margin-bottom:12px;">Cargando profesionales...</div>
        <div id="workers-list" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,360px));gap:16px;"></div>
        <div id="workers-empty" style="display:none;color:#777;margin-top:12px;">No se encontraron profesionales que cumplan los criterios.</div>
      </div>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="./assets/profile-component.js"></script>

  <!-- heic2any: client-side HEIC/HEIF -> JPEG converter (used for iPhone uploads) -->
  <script src="https://unpkg.com/heic2any/dist/heic2any.min.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', async () => {
      
      const loadingEl = document.getElementById('workers-loading');
      const listEl = document.getElementById('workers-list');
      const emptyEl = document.getElementById('workers-empty');

       // Simple escape helper
      function escapeHtml(str) {
        if (typeof str !== 'string') return str === null || str === undefined ? '' : String(str);
        return str
          .replace(/&/g, '&amp;')
          .replace(/</g, '&lt;')
          .replace(/>/g, '&gt;')
          .replace(/\"/g, '&quot;')
          .replace(/'/g, '&#039;');
      }


      if (!window.supabaseClient) {
        loadingEl.textContent = 'Cliente de Supabase no disponible.';
        return;
      }

      try {
        // Consulta: rol = 'worker' (traer todos los workers y priorizarlos en frontend)
        const { data, error } = await window.supabaseClient
  .from('usuarios')
  .select('*')
  .eq('rol', 'worker')
  .eq('perfilPublico', true)
  .order('creado_en', { ascending: false })
  .limit(1000);
  
        if (error) throw error;

        loadingEl.style.display = 'none';

        if (!data || data.length === 0) {
          emptyEl.style.display = 'block';
          return;
        }


        // Filtrar usuarios según reglas ligeras (no removemos por campos vacíos,
        // solo excluimos usuarios con nombre 'Alex')
        function hasAllRequired(u) {
  if (!u) return false;

  // Excluir usuarios con nombre 'Alex' (case-insensitive)
  const nameVal = (u.nombre || u.name || '').toString().trim().toLowerCase();
  if (nameVal === 'alex') return false;

  // Excluir si no tiene Categoría válida (no vacía, no null, no [])
  let cat = u.categoria;
  if (typeof cat === 'string') {
    try { cat = JSON.parse(cat); } catch(e) {}
  }
  if (Array.isArray(cat)) {
    const validCat = cat.filter(item => item !== null && item !== undefined && String(item).trim() !== '');
    if (validCat.length === 0) return false;
  } else {
    const catStr = (cat === null || cat === undefined) ? '' : String(cat).trim();
    if (!catStr || catStr === 'null' || catStr === '[]') return false;
  }

  return true;
}

        const filtered = data.filter(hasAllRequired);

        // Soporte para URL param `ids=uuid1,uuid2,uuid3` (máx 3) — REQUERIR UUID completo
        const params = new URLSearchParams(window.location.search || '');
        const idsParam = params.get('ids');
        let finalList = filtered;
        if (idsParam) {
          // Permitimos hasta 3 tokens; deben ser UUIDs completos (aseguramos formato)
          const ids = idsParam.split(',').map(s => s.toString().trim()).filter(Boolean).slice(0, 3);
          if (ids.length > 0) {
            const uuidRegex = /^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i;
            const valid = ids.map(t => t).filter(t => uuidRegex.test(t));
            if (valid.length === 0) {
              // Ningún token válido -> mostrar vacío
              emptyEl.style.display = 'block';
              return;
            }
            const set = new Set(valid.map(s => s.toLowerCase()));
            finalList = filtered.filter(u => {
              const uId = (u.id || u.user_id || u.uid || u.ID || u.userId || '').toString();
              return uId && set.has(uId.toLowerCase());
            });
          }
        }

        if (!finalList || finalList.length === 0) {
          emptyEl.style.display = 'block';
          return;
        }

        // Priorizar: primero los que tienen categoria no vacía
        function hasCategory(u) {
  if (!u) return false;
  let c = u.categoria;
  // Si llega como string JSON, parsearlo
  if (typeof c === 'string') {
    try { c = JSON.parse(c); } catch(e) { /* dejarlo como string */ }
  }
  // ✅ Si es array, filtrar nulls/vacíos y ver si queda algo
  if (Array.isArray(c)) {
    const valid = c.filter(item => item !== null && item !== undefined && String(item).trim() !== '');
    return valid.length > 0;
  }
  if (c === null || c === undefined) return false;
  return String(c).trim() !== '' && String(c).trim() !== 'null' && String(c).trim() !== '[]';
}

        // Ordenar por prioridad compuesta:
        // - Tener categoría no vacía (mayor peso)
        // - Estar verificado (`verificado === true`)
        // - Ser suscriptor (`suscriptor === true`)
        // Calculamos una puntuación y ordenamos descendente.
        function isTruthyFlag(v){
          return v === true || v === 1 || v === '1' || String(v).toLowerCase() === 'true' || String(v).toLowerCase() === 't' || String(v).toLowerCase() === 'si' || String(v).toLowerCase() === 'sí';
        }

        // Detecta si el usuario tiene al menos un documento útil (antecedentes/matricula)
        function hasDocument(u){
          if (!u) return false;
          const candidates = [u.antecedentes, u.antecedentes_json, u.matricula, u.matricula_json];
          for (const v of candidates){
            if (v === null || v === undefined) continue;
            if (typeof v === 'string'){
              const s = v.trim();
              if (s === '') continue;
              // si contiene una URL, contamos
              if (/https?:\/\/[^\s'"<>]+/i.test(s)) return true;
              // si es texto no vacío, también lo consideramos (puede ser metadata)
              return true;
            }
            if (Array.isArray(v) && v.length > 0) return true;
            if (typeof v === 'object' && Object.keys(v).length > 0) return true;
          }
          return false;
        }

        function scoreProfile(u){
          let s = 0;
          if (hasCategory(u)) s += 4;
          if (u && isTruthyFlag(u.verificado)) s += 2;
          if (u && isTruthyFlag(u.suscriptor)) s += 1;
          // Añadir peso importante si tiene al menos un documento (antecedentes o matricula)
          if (hasDocument(u)) s += 3;
          return s;
        }

        finalList.sort((a, b) => {
          const sa = scoreProfile(a);
          const sb = scoreProfile(b);
          if (sb !== sa) return sb - sa; // mayor score primero
          // fallback: mantener orden por id descendente (ya venía ordenado así desde la consulta)
          const idA = (a && (a.id || a.user_id || a.uid || a.ID || a.userId)) || '';
          const idB = (b && (b.id || b.user_id || b.uid || b.ID || b.userId)) || '';
          return String(idB).localeCompare(String(idA), undefined, {numeric:true, sensitivity:'base'});
        });
        const finalListOrdered = finalList;

        // Helper para mostrar valor o texto rojo si falta
        function showOrMissing(val, label) {
          if (val === null || val === undefined) return `<span style="color:#c00">Falta ${label}</span>`;
          if (Array.isArray(val) && val.length === 0) return `<span style="color:#c00">Falta ${label}</span>`;
          if (typeof val === 'string' && val.trim() === '') return `<span style="color:#c00">Falta ${label}</span>`;
          return escapeHtml(String(val));
        }

        // Helper: carga imágenes y convierte HEIC/HEIF si es necesario
        async function loadImageWithHeicSupport(imgEl, url){
          const defaultImg = 'assets/nofoto.png';
          if (!url) { imgEl.src = defaultImg; return; }
          const lower = String(url).toLowerCase();
          try{
            // If extension suggests HEIC/HEIF, fetch and convert
            if (lower.endsWith('.heic') || lower.endsWith('.heif')){
              const resp = await fetch(url);
              if (!resp.ok) throw new Error('fetch failed');
              const blob = await resp.blob();
              if (window.heic2any){
                const out = await heic2any({blob, toType: 'image/jpeg', quality: 0.9});
                imgEl.src = URL.createObjectURL(out);
                return;
              }
              imgEl.src = defaultImg;
              return;
            }

            // Try direct load first
            imgEl.src = url;
            imgEl.onerror = async function(){
              // On error try to fetch and inspect blob in case it's HEIC without extension
              try{
                const resp = await fetch(url);
                if (!resp.ok) throw new Error('fetch failed');
                const blob = await resp.blob();
                const t = (blob && blob.type) ? blob.type.toLowerCase() : '';
                if (t.includes('heic') || t.includes('heif')){
                  if (window.heic2any){
                    const out = await heic2any({blob, toType: 'image/jpeg', quality:0.9});
                    imgEl.src = URL.createObjectURL(out);
                    return;
                  }
                }
              }catch(e){
                // ignore
              }
              imgEl.onerror = null;
              imgEl.src = defaultImg;
            };
          }catch(e){
            imgEl.src = defaultImg;
          }
        }

        // Limpiar lista anterior y renderizar cada profesional — mostrar solo los campos solicitados
        listEl.innerHTML = '';
        finalListOrdered.forEach(user => {
          const card = document.createElement('div');
          card.style.border = '1px solid #e6e6e6';
          card.style.borderRadius = '12px';
          card.style.padding = '16px';
          card.style.background = '#fff';
          card.style.boxShadow = '0 6px 18px rgba(0,0,0,0.04)';

          // Campos (con nombres alternativos de respaldo)
          const nombre = user.nombre || user.name || '';
          const edad = user.edad || user.age || '';
          const creado_en = user.creado_en || user.created_at || user.inserted_at || '';
          const dni = user.dni || '';
          const provincia = user.provincia || user.province || '';
          const ciudad = user.ciudad || '';
          const barrio = user.barrio || '';
          let categoriaRaw = user.categoria;
if (typeof categoriaRaw === 'string') {
  try { categoriaRaw = JSON.parse(categoriaRaw); } catch(e) {}
}
const categoria = Array.isArray(categoriaRaw)
  ? categoriaRaw.filter(item => item !== null && item !== undefined && String(item).trim() !== '')
  : (categoriaRaw ? [categoriaRaw] : []);
          const foto_perfil = user.foto_perfil || user.foto || '';
          const defaultImg = 'assets/nofoto.png';
          const finalImg = foto_perfil || defaultImg;
          function isTruthyFlagLocal(v){
            return v === true || v === 1 || v === '1' || String(v).toLowerCase() === 'true' || String(v).toLowerCase() === 't' || String(v).toLowerCase() === 'si' || String(v).toLowerCase() === 'sí';
          }
          const suscriptor = isTruthyFlagLocal(user.suscriptor);
          const antecedentes = user.antecedentes || user.antecedentes_json || null;
          const matricula = user.matricula || user.matricula_json || null;
          const verificado = isTruthyFlagLocal(user.verificado);

          // Helpers
          function formatDate(val) {
            if (!val) return '';
            const d = new Date(val);
            if (isNaN(d)) return String(val);
            return d.toLocaleDateString();
          }

          function summarizeJson(obj) {
            if (!obj) return '—';
            try {
              if (typeof obj === 'string') {
                const parsed = JSON.parse(obj);
                return summarizeJson(parsed);
              }
              if (Array.isArray(obj)) return obj.join(', ');
              if (typeof obj === 'object') {
                const entries = Object.entries(obj).slice(0, 5).map(([k, v]) => `${k}: ${String(v)}`);
                return entries.join(' • ');
              }
              return String(obj);
            } catch (e) {
              return String(obj).slice(0, 120);
            }
          }

            // Render preview for file URLs or summarized content.
            function renderFilePreview(val, label) {
              if (!val) return `<span style="color:#c00">Falta ${label}</span>`;
              // Try to extract a URL even if the value is an object/array or contains extra text.
                // If val is array/object, try to find a URL inside it first.
                function extractUrlFromValue(v){
                  if (!v) return null;
                  if (typeof v === 'string') {
                    const m = v.match(/https?:\/\/[^\s'"<>]+/i);
                    if (m && m[0]) return m[0].replace(/[)\]"'.,;]+$/,'');
                    return null;
                  }
                  if (Array.isArray(v)){
                    for (const item of v){
                      const found = extractUrlFromValue(item);
                      if (found) return found;
                    }
                    return null;
                  }
                  if (typeof v === 'object'){
                    // search object values
                    for (const k of Object.keys(v)){
                      const found = extractUrlFromValue(v[k]);
                      if (found) return found;
                    }
                    return null;
                  }
                  return null;
                }

                // If it's not a plain string, try to find URL inside
                if (typeof val !== 'string') {
                  const found = extractUrlFromValue(val);
                  if (found) {
                    val = found;
                  } else {
                    return `<div>${escapeHtml(summarizeJson(val))}</div>`;
                  }
                }

                let url = val.toString().trim();
                // Extract the first URL if the string contains labels before it
                const extracted = url.match(/https?:\/\/[^\s'"<>]+/i);
                if (extracted && extracted[0]) url = extracted[0].replace(/[)\]"'.,;]+$/,'');
                const lower = url.toLowerCase();
                const isUrl = /^https?:\/\//i.test(url) || url.startsWith('/');
                const imgExt = /\.(png|jpe?g|gif|webp|avif|svg)(\?|$)/i;
                const pdfExt = /\.pdf(\?|$)/i;
                if (isUrl && imgExt.test(lower)) {
                  return `<div style="margin-bottom:8px;"><a href="${escapeHtml(url)}" target="_blank" rel="noopener noreferrer"><img src="${escapeHtml(url)}" alt="Preview" style="max-width:100%;height:120px;object-fit:contain;border-radius:8px;border:1px solid #ddd;"></a></div>`;
                }
                if (isUrl && pdfExt.test(lower)) {
                  return `<div style="margin-bottom:8px;"><a href="${escapeHtml(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration:underline;color:#007bff;">Ver PDF</a></div>`;
                }
                if (isUrl) {
                  return `<div style="margin-bottom:8px;"><a href="${escapeHtml(url)}" target="_blank" rel="noopener noreferrer" style="text-decoration:underline;color:#007bff;">Abrir archivo</a></div>`;
                }
                return `<div>${escapeHtml(String(val))}</div>`;
            }

          const imageHtml = `<div style="width:100%;height:160px;overflow:hidden;border-radius:8px;margin-bottom:10px;"><img data-src="${escapeHtml(finalImg)}" alt="Foto perfil" style="width: 50%;height: 100%;object-fit:cover;display:block;border-radius: 100%;justify-self: center;"></div>`;
          // Añadir id del trabajador como atributo data (oculto visualmente)
          const idValue = user.id || user.user_id || user.uid || user.ID || user.userId || '';
          if (idValue) card.dataset.userId = String(idValue);

          // Mostrar valor o mensaje rojo si falta
          const nombreHtml = showOrMissing(nombre, 'nombre');
          const edadHtml = showOrMissing(edad, 'edad');
          const creadoHtml = (creado_en ? escapeHtml(formatDate(creado_en)) : `<span style="color:#c00">Falta registrado en</span>`);
          const dniHtml = showOrMissing(dni, 'DNI');
          const provinciaHtml = showOrMissing(provincia, 'provincia');
          const ciudadHtml = showOrMissing(ciudad, 'ciudad');
          const barrioHtml = showOrMissing(barrio, 'barrio');
          const categoriaHtml = (Array.isArray(categoria) && categoria.length > 0) ? escapeHtml(categoria.join(', ')) : `<span style="color:#c00">Falta categoría</span>`;
          const fotoHtml = imageHtml;
          const suscriptorHtml = (user.suscriptor === null || user.suscriptor === undefined) ? `<span style="color:#c00">Falta suscriptor</span>` : (suscriptor ? 'Sí' : 'No');
          const verificadoHtml = (user.verificado === null || user.verificado === undefined) ? `<span style="color:#c00">Falta verificado</span>` : (verificado ? 'Sí' : 'No');
          const antecedentesHtml = (antecedentes ? renderFilePreview(antecedentes, 'antecedentes') : `<span style="color:#c00">Falta antecedentes</span>`);
          const matriculaHtml = (matricula ? renderFilePreview(matricula, 'matricula') : `<span style="color:#c00">Falta matricula</span>`);

          card.innerHTML = `
            ${fotoHtml}
            <h3 style="margin:0 0 8px 0; font-size:1.05rem; color:#222;">${nombreHtml}</h3>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Edad:</strong> ${edadHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Registrado en:</strong> ${creadoHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>DNI:</strong> ${dniHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Provincia:</strong> ${provinciaHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Ciudad:</strong> ${ciudadHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Barrio:</strong> ${barrioHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Categoría:</strong> ${categoriaHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Suscriptor:</strong> ${suscriptorHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Verificado:</strong> ${verificadoHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Antecedentes:</strong> ${antecedentesHtml}</div>
            <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Matricula:</strong> ${matriculaHtml}</div>
          `;

          listEl.appendChild(card);
          // After appending, initialize image loader for potential HEIC images
          const imgEl = card.querySelector('img[data-src]');
          if (imgEl){
            const src = imgEl.getAttribute('data-src');
            // remove data-src to avoid double-handling
            imgEl.removeAttribute('data-src');
            loadImageWithHeicSupport(imgEl, src);
          }
        });

      } catch (err) {
        loadingEl.textContent = 'Error cargando profesionales: ' + (err.message || err);
        console.error(err);
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