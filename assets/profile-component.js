(function(window){
  // Utility escape
  function escapeHtml(str) {
    if (typeof str !== 'string') return str === null || str === undefined ? '' : String(str);
    return str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;').replace(/'/g, '&#039;');
  }

  function getMissingFields(u) {
    const missing = [];
    if (!(u.nombre || u.name)) missing.push('nombre');
    if (!(u.edad || u.age)) missing.push('edad');
    if (!(u.creado_en || u.created_at || u.inserted_at)) missing.push('registrado en');
    if (!u.dni) missing.push('DNI');
    if (!(u.provincia || u.province)) missing.push('provincia');
    if (!u.categoria || (Array.isArray(u.categoria) && u.categoria.length === 0) || (typeof u.categoria === 'string' && u.categoria.trim() === '')) missing.push('categoría');
    if (!(u.foto_perfil || u.foto)) missing.push('foto');
    if (u.suscriptor === null || u.suscriptor === undefined) missing.push('suscriptor');
    if (u.verificado === null || u.verificado === undefined) missing.push('verificado');
    if (u.antecedentes === null || u.antecedentes === undefined) missing.push('antecedentes');
    if (u.matricula === null || u.matricula === undefined) missing.push('matricula');
    return missing;
  }

  function isProfileComplete(u){
    return getMissingFields(u).length === 0;
  }

  function showOrMissing(val, label){
    if (val === null || val === undefined) return `<span style="color:#c00">Falta ${label}</span>`;
    if (Array.isArray(val) && val.length === 0) return `<span style="color:#c00">Falta ${label}</span>`;
    if (typeof val === 'string' && val.trim() === '') return `<span style="color:#c00">Falta ${label}</span>`;
    return escapeHtml(String(val));
  }

  function formatDate(val){
    if (!val) return '';
    const d = new Date(val);
    if (isNaN(d)) return String(val);
    return d.toLocaleDateString();
  }

  function summarizeJson(obj){
    if (!obj) return '—';
    try{
      if (typeof obj === 'string'){
        const parsed = JSON.parse(obj);
        return summarizeJson(parsed);
      }
      if (Array.isArray(obj)) return obj.join(', ');
      if (typeof obj === 'object'){
        const entries = Object.entries(obj).slice(0,5).map(([k,v]) => `${k}: ${String(v)}`);
        return entries.join(' • ');
      }
      return String(obj);
    } catch(e){
      return String(obj).slice(0,120);
    }
  }

  /**
   * Muestra un banner de alerta en perfil.php si el usuario tiene campos incompletos.
   * Llama a esta función después de cargar el perfil desde Supabase.
   * @param {object} u - Objeto con los datos del usuario cargados desde la tabla `usuarios`
   */
  function mostrarBannerCamposIncompletos(u) {
    // Eliminar banner previo si existe
    const bannerPrevio = document.getElementById('banner-campos-incompletos');
    if (bannerPrevio) bannerPrevio.remove();

    const camposFaltantes = getMissingFields(u);
    if (camposFaltantes.length === 0) return; // Perfil completo, no mostrar nada

    const banner = document.createElement('div');
    banner.id = 'banner-campos-incompletos';
    banner.style.cssText = `
      position: sticky;
      top: 70px;
      z-index: 1050;
      margin: 0 0 20px 0;
      padding: 14px 20px;
      background: #fff8e1;
      border: 1.5px solid #f9a825;
      border-radius: 12px;
      color: #7a5800;
      font-size: 0.95rem;
      display: flex;
      align-items: flex-start;
      gap: 12px;
      box-shadow: 0 4px 12px rgba(249,168,37,0.15);
      animation: slideDown 0.3s ease;
    `;

    const porcentajeCompleto = Math.round(((11 - camposFaltantes.length) / 11) * 100);
    const lista = camposFaltantes.map(c => `<span style="background:#f9a825;color:#fff;border-radius:6px;padding:2px 8px;font-size:0.82rem;font-weight:600;">${c}</span>`).join(' ');

    banner.innerHTML = `
      <style>
        @keyframes slideDown {
          from { opacity: 0; transform: translateY(-10px); }
          to   { opacity: 1; transform: translateY(0); }
        }
        #banner-campos-incompletos .progress-bar-inner {
          height: 6px;
          border-radius: 3px;
          background: linear-gradient(90deg, #f9a825, #00c2cb);
          width: ${porcentajeCompleto}%;
          transition: width 0.5s ease;
        }
      </style>
      <div style="font-size:1.5rem; line-height:1;">⚠️</div>
      <div style="flex:1;">
        <div style="font-weight:700; margin-bottom:6px;">
          Tu perfil está incompleto (${porcentajeCompleto}% completado)
        </div>
        <div style="background:#f0f0f0;border-radius:3px;margin-bottom:10px;overflow:hidden;">
          <div class="progress-bar-inner"></div>
        </div>
        <div style="margin-bottom:8px;">
          <strong>Faltan:</strong> ${lista}
        </div>
        <div style="font-size:0.85rem;color:#a07000;">
          Completar tu perfil te ayuda a aparecer en los resultados de búsqueda y generar más confianza.
        </div>
      </div>
      <button onclick="document.getElementById('banner-campos-incompletos').remove()"
        style="background:none;border:none;cursor:pointer;font-size:1.2rem;color:#a07000;line-height:1;padding:0;flex-shrink:0;">✕</button>
    `;

    // Insertar arriba del formulario, debajo del alert-msg existente
    const alertMsg = document.getElementById('alert-msg');
    if (alertMsg) {
      alertMsg.insertAdjacentElement('afterend', banner);
    } else {
      // Fallback: insertar al inicio del profile-card
      const profileCard = document.querySelector('.profile-card');
      if (profileCard) {
        profileCard.insertAdjacentElement('afterbegin', banner);
      }
    }
  }

  function createProfileCard(u){
    const card = document.createElement('div');
    card.style.border = '1px solid #e6e6e6';
    card.style.borderRadius = '12px';
    card.style.padding = '16px';
    card.style.background = '#fff';
    card.style.boxShadow = '0 6px 18px rgba(0,0,0,0.04)';

    const nombre = u.nombre || u.name || '';
    const edad = u.edad || u.age || '';
    const creado_en = u.creado_en || u.created_at || u.inserted_at || '';
    const dni = u.dni || '';
    const provincia = u.provincia || u.province || '';
    const categoria = Array.isArray(u.categoria) ? u.categoria : (u.categoria ? [u.categoria] : []);
    const foto_perfil = u.foto_perfil || u.foto || '';
    const defaultImg = 'assets/nofoto.png';
    const finalImg = foto_perfil || defaultImg;
    const suscriptor = Boolean(u.suscriptor);
    const antecedentes = u.antecedentes || u.antecedentes_json || null;
    const matricula = u.matricula || u.matricula_json || null;
    const verificado = Boolean(u.verificado);

    const imageHtml = `<div style="width:100%;height:160px;overflow:hidden;border-radius:8px;margin-bottom:10px;"><img src="${escapeHtml(finalImg)}" alt="Foto perfil" style="width:100%;height:100%;object-fit:cover;display:block;"></div>`;

    const idValue = u.id || u.user_id || u.uid || u.ID || u.userId || '';
    if (idValue) card.dataset.userId = String(idValue);

    const missing = getMissingFields(u);
    let bannerHtml = '';
    if (missing.length > 0){
      const list = missing.join(', ');
      const perfilLink = idValue ? `perfil.php?uid=${encodeURIComponent(String(idValue))}` : 'perfil.php';
      bannerHtml = `<div style="background:#ffecec;border:1px solid #f5c6cb;color:#a94442;padding:10px;border-radius:8px;margin-bottom:10px;text-align:left;"><strong>Faltan datos:</strong> ${escapeHtml(list)} <a href="${perfilLink}" style="margin-left:8px;color:#7a0b0b;text-decoration:underline;">Completar datos</a></div>`;
    }

    const nombreHtml = showOrMissing(nombre, 'nombre');
    const edadHtml = showOrMissing(edad, 'edad');
    const creadoHtml = (creado_en ? escapeHtml(formatDate(creado_en)) : `<span style="color:#c00">Falta registrado en</span>`);
    const dniHtml = showOrMissing(dni, 'DNI');
    const provinciaHtml = showOrMissing(provincia, 'provincia');
    const categoriaHtml = (Array.isArray(categoria) && categoria.length > 0) ? escapeHtml(categoria.join(', ')) : `<span style="color:#c00">Falta categoría</span>`;
    const fotoHtml = imageHtml;
    const suscriptorHtml = (u.suscriptor === null || u.suscriptor === undefined) ? `<span style="color:#c00">Falta suscriptor</span>` : (suscriptor ? 'Sí' : 'No');
    const verificadoHtml = (u.verificado === null || u.verificado === undefined) ? `<span style="color:#c00">Falta verificado</span>` : (verificado ? 'Sí' : 'No');
    const antecedentesHtml = (antecedentes ? escapeHtml(summarizeJson(antecedentes)) : `<span style="color:#c00">Falta antecedentes</span>`);
    const matriculaHtml = (matricula ? escapeHtml(summarizeJson(matricula)) : `<span style="color:#c00">Falta matricula</span>`);

    card.innerHTML = `
      ${bannerHtml}
      ${fotoHtml}
      <h3 style="margin:0 0 8px 0; font-size:1.05rem; color:#222;">${nombreHtml}</h3>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Edad:</strong> ${edadHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Registrado en:</strong> ${creadoHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>DNI:</strong> ${dniHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Provincia:</strong> ${provinciaHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Categoría:</strong> ${categoriaHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Suscriptor:</strong> ${suscriptorHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Verificado:</strong> ${verificadoHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Antecedentes:</strong> ${antecedentesHtml}</div>
      <div style="color:#666;font-size:0.95rem;margin-bottom:6px;"><strong>Matricula:</strong> ${matriculaHtml}</div>
    `;

    return card;
  }

  // Expose API
  window.ProfileComponent = {
    getMissingFields,
    isProfileComplete,
    createProfileCard,
    showOrMissing,
    mostrarBannerCamposIncompletos  // ← nueva función expuesta
  };

})(window);