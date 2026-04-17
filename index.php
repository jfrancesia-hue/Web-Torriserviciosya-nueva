<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toori ServiciosYa - Gestion Humana con Respaldo Total</title>
    <meta name="description"
        content="Pedi el servicio que necesitas. Nosotros nos ocupamos del resto. Gestion profesional y respaldo para tu hogar.">

    <!-- OpenGraph / WhatsApp -->
    <meta property="og:title" content="Toori ServiciosYa - Gestion Humana con Respaldo Total">
    <meta property="og:description"
        content="Pedi el servicio que necesitas. Nosotros nos ocupamos del resto. Gestion profesional y respaldo para tu hogar.">
    <meta property="og:image" content="assets/logo.png">
    <meta property="og:url" content="https://tooriserviciosya.com">
    <meta property="og:type" content="website">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="assets/logo.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">
</head>

<body>

    <?php include 'header.php'; ?>

    <!-- ===================== HERO - Slideshow con Ken Burns ===================== -->
    <style>
      .hero-slideshow {
        position: relative;
        min-height: 100vh;
        display: flex;
        align-items: flex-start;
        overflow: hidden;
      }

      /* Slides de fondo */
      .hero-slide {
        position: absolute;
        inset: 0;
        background-size: cover;
        background-position: center;
        opacity: 0;
        transition: opacity 1.2s ease-in-out;
        will-change: opacity, transform;
      }

      .hero-slide.active {
        opacity: 1;
        animation: kenBurns 8s ease-in-out forwards;
      }

      @keyframes kenBurns {
        0% { transform: scale(1) translate(0, 0); }
        100% { transform: scale(1.08) translate(-1%, -1%); }
      }

      /* Variantes de animacion para cada slide */
      .hero-slide:nth-child(2).active {
        animation: kenBurns2 8s ease-in-out forwards;
      }
      @keyframes kenBurns2 {
        0% { transform: scale(1.05) translate(-1%, 0); }
        100% { transform: scale(1) translate(1%, -1%); }
      }

      .hero-slide:nth-child(3).active {
        animation: kenBurns3 8s ease-in-out forwards;
      }
      @keyframes kenBurns3 {
        0% { transform: scale(1) translate(1%, 1%); }
        100% { transform: scale(1.1) translate(-1%, 0); }
      }

      .hero-slide:nth-child(4).active {
        animation: kenBurns4 8s ease-in-out forwards;
      }
      @keyframes kenBurns4 {
        0% { transform: scale(1.08) translate(0, -1%); }
        100% { transform: scale(1) translate(0, 1%); }
      }

      .hero-slide:nth-child(5).active {
        animation: kenBurns5 8s ease-in-out forwards;
      }
      @keyframes kenBurns5 {
        0% { transform: scale(1) translate(-1%, -1%); }
        100% { transform: scale(1.06) translate(1%, 0); }
      }

      /* Overlay oscuro + gradiente */
      .hero-slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
          180deg,
          rgba(30, 30, 50, 0.85) 0%,
          rgba(30, 30, 50, 0.6) 40%,
          rgba(30, 30, 50, 0.4) 70%,
          rgba(255, 255, 255, 0) 100%
        );
        z-index: 2;
      }

      /* Indicadores de slide */
      .hero-indicators {
        position: absolute;
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 5;
      }

      .hero-indicator {
        width: 32px;
        height: 4px;
        border-radius: 2px;
        background: rgba(255,255,255,0.3);
        cursor: pointer;
        transition: all 0.4s;
        border: none;
        padding: 0;
      }

      .hero-indicator.active {
        background: white;
        width: 48px;
      }

      /* Etiqueta de la foto actual */
      .hero-slide-label {
        position: absolute;
        bottom: 120px;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255,255,255,0.5);
        font-size: 0.78rem;
        font-weight: 500;
        z-index: 5;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        opacity: 0;
        transition: opacity 0.5s;
      }

      .hero-slide-label.visible {
        opacity: 1;
      }

      /* Contenido hero */
      .hero-slideshow .hero-main-content {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        justify-content: flex-start;
        padding-top: 22vh;
        gap: 24px;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding-left: 24px;
        padding-right: 24px;
      }

      @media (max-width: 768px) {
        .hero-slideshow { min-height: 90vh; }
        .hero-slideshow .hero-main-content { padding-top: 16vh; }
        .hero-indicators { bottom: 80px; }
        .hero-slide-label { bottom: 100px; font-size: 0.7rem; }
      }
    </style>

    <section class="hero-slideshow" id="home">
      <!-- Slides de fondo - prestadores reales trabajando -->
      <div class="hero-slide active"
        style="background-image: url('https://images.pexels.com/photos/8005397/pexels-photo-8005397.jpeg?auto=compress&cs=tinysrgb&w=1600&h=900&fit=crop');"
        data-label="Electricista profesional"></div>
      <div class="hero-slide"
        style="background-image: url('https://images.pexels.com/photos/6419128/pexels-photo-6419128.jpeg?auto=compress&cs=tinysrgb&w=1600&h=900&fit=crop');"
        data-label="Plomero verificado"></div>
      <div class="hero-slide"
        style="background-image: url('https://images.pexels.com/photos/6474471/pexels-photo-6474471.jpeg?auto=compress&cs=tinysrgb&w=1600&h=900&fit=crop');"
        data-label="Pintor de interiores"></div>
      <div class="hero-slide"
        style="background-image: url('https://images.pexels.com/photos/1301856/pexels-photo-1301856.jpeg?auto=compress&cs=tinysrgb&w=1600&h=900&fit=crop');"
        data-label="Jardinero experto"></div>
      <div class="hero-slide"
        style="background-image: url('https://images.pexels.com/photos/4107120/pexels-photo-4107120.jpeg?auto=compress&cs=tinysrgb&w=1600&h=900&fit=crop');"
        data-label="Servicio de limpieza"></div>

      <!-- Overlay -->
      <div class="hero-slide-overlay"></div>

      <!-- Contenido -->
      <div class="hero-main-content">
        <div class="hero-content animate-in" style="max-width: 800px;">
          <h1 style="font-size: 3.8rem; margin-bottom: 1rem; line-height: 1.1; color: white; text-shadow: 0 4px 24px rgba(0,0,0,0.4);">
            Hace tu vida mas facil
          </h1>
          <p style="font-size: 1.35rem; color: rgba(255,255,255,0.92); margin-bottom: 2rem; text-shadow: 0 2px 12px rgba(0,0,0,0.4); font-weight: 400; max-width: 550px; margin-left: auto; margin-right: auto; line-height: 1.5;">
            Disfruta de cualquier servicio profesional, en la comodidad de tu propio hogar.
          </p>
          <div class="hero-cta-bar">
            <a href="https://wa.me/5493512139046" class="btn btn-primary btn-ripple">Buscar un Servicio</a>
            <a href="registro.php" class="btn btn-ripple" style="background: #f1f8e9; color: #558b2f; font-weight: 600;">Ofrecer Servicios</a>
          </div>
        </div>

        <!-- Trust badges -->
        <div class="trust-badges" style="margin-top: 20px;">
          <div class="trust-badge">
            <i class="bi bi-shield-check"></i>
            <span>Prestadores verificados</span>
          </div>
          <div class="trust-badge">
            <i class="bi bi-clock"></i>
            <span>Respuesta en minutos</span>
          </div>
          <div class="trust-badge">
            <i class="bi bi-star"></i>
            <span>Garantia de calidad</span>
          </div>
        </div>
      </div>

      <!-- Etiqueta de slide actual -->
      <div class="hero-slide-label visible" id="hero-label">Electricista profesional</div>

      <!-- Indicadores -->
      <div class="hero-indicators" id="hero-indicators">
        <button class="hero-indicator active" data-index="0"></button>
        <button class="hero-indicator" data-index="1"></button>
        <button class="hero-indicator" data-index="2"></button>
        <button class="hero-indicator" data-index="3"></button>
        <button class="hero-indicator" data-index="4"></button>
      </div>
    </section>

    <!-- ===================== STATS BAR con CONTADOR ANIMADO ===================== -->
    <section style="background: white; border-bottom: 1px solid #f0f0f0;">
        <div class="container">
            <div class="stats-bar reveal">
                <div class="stat-item">
                    <div class="stat-number" data-target="500" data-suffix="+">0</div>
                    <div class="stat-label">Servicios realizados</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="200" data-suffix="+">0</div>
                    <div class="stat-label">Profesionales activos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="4.8" data-suffix="" data-decimal="true">0</div>
                    <div class="stat-label">Valoracion promedio</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-target="15" data-suffix="+">0</div>
                    <div class="stat-label">Categorias de servicio</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mesh divider -->
    <div class="mesh-divider"></div>

    <!-- ===================== SPONSORS - Carrusel Profesional ===================== -->
<section class="section" id="sponsors">
  <div class="container text-center">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&display=swap');

      #sponsors {
        background: linear-gradient(135deg, #0f0c29 0%, #1a1a3e 40%, #24243e 100%);
        padding: 90px 0;
        overflow: hidden;
        position: relative;
      }

      #sponsors::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
          radial-gradient(ellipse 50% 50% at 15% 50%, rgba(167,139,250,0.1) 0%, transparent 60%),
          radial-gradient(ellipse 40% 50% at 85% 50%, rgba(52,211,153,0.08) 0%, transparent 60%);
        pointer-events: none;
      }

      .sponsors-header {
        margin-bottom: 52px;
        position: relative;
        z-index: 2;
      }

      .sponsors-divider {
        width: 60px; height: 3px;
        background: linear-gradient(90deg, #a78bfa, #34d399);
        border-radius: 2px;
        margin: 0 auto 16px;
      }

      .sponsors-title {
        font-family: 'Syne', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 10px;
      }

      .sponsors-title span {
        background: linear-gradient(90deg, #a78bfa, #34d399);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .sponsors-sub {
        color: rgba(255,255,255,0.5);
        font-size: 0.95rem;
      }

      /* --- Carrusel con scroll manual + auto-play --- */
      .sponsor-carousel-wrapper {
        position: relative;
        padding: 10px 0 20px;
        z-index: 2;
      }

      /* Fade izq/der */
      .sponsor-carousel-wrapper::before,
      .sponsor-carousel-wrapper::after {
        content: '';
        position: absolute;
        top: 0;
        bottom: 0;
        width: 80px;
        z-index: 3;
        pointer-events: none;
      }

      .sponsor-carousel-wrapper::before {
        left: 0;
        background: linear-gradient(90deg, #0f0c29, transparent);
      }

      .sponsor-carousel-wrapper::after {
        right: 0;
        background: linear-gradient(270deg, #24243e, transparent);
      }

      .sponsor-carousel-track {
        display: flex;
        gap: 28px;
        overflow-x: auto;
        scroll-behavior: smooth;
        scroll-snap-type: x mandatory;
        padding: 10px 60px;
        scrollbar-width: none;
        -ms-overflow-style: none;
      }

      .sponsor-carousel-track::-webkit-scrollbar {
        display: none;
      }

      .sp-card, .sp-card-video {
        scroll-snap-align: start;
      }

      /* Flechas de navegacion manual */
      .sp-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        width: 48px;
        height: 48px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
        color: #fff;
        font-size: 1.4rem;
        cursor: pointer;
        z-index: 4;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.25s ease;
      }

      .sp-arrow:hover {
        background: rgba(167,139,250,0.25);
        border-color: rgba(167,139,250,0.5);
        transform: translateY(-50%) scale(1.08);
        box-shadow: 0 6px 20px rgba(167,139,250,0.3);
      }

      .sp-arrow:active {
        transform: translateY(-50%) scale(0.96);
      }

      .sp-arrow-left { left: 10px; }
      .sp-arrow-right { right: 10px; }

      /* --- Card sponsor --- */
      .sp-card {
        flex-shrink: 0;
        width: 300px;
        border-radius: 20px;
        overflow: hidden;
        background: linear-gradient(145deg, rgba(255,255,255,0.09) 0%, rgba(255,255,255,0.03) 100%);
        border: 1px solid rgba(255,255,255,0.1);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        transition: transform 0.4s cubic-bezier(.22,1,.36,1), box-shadow 0.4s;
        cursor: pointer;
        position: relative;
      }

      .sp-card:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 20px 50px rgba(0,0,0,0.5), 0 0 30px rgba(167,139,250,0.12);
      }

      .sp-card-img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
      }

      /* Variante para banners horizontales (ej: IEC, Sancor) */
      .sp-card-img--contain {
        object-fit: contain;
        padding: 14px;
        background: #ffffff;
      }

      .sp-card:hover .sp-card-img {
        transform: scale(1.08);
      }

      .sp-card-img-wrap {
        overflow: hidden;
        position: relative;
      }

      .sp-card-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: linear-gradient(90deg, #a78bfa, #6366f1);
        color: #fff;
        font-size: 0.6rem;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        z-index: 2;
        box-shadow: 0 2px 10px rgba(99,102,241,0.4);
      }

      .sp-card-body {
        padding: 20px;
      }

      .sp-card-name {
        font-family: 'Syne', sans-serif;
        font-size: 1.05rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
      }

      .sp-card-desc {
        color: rgba(255,255,255,0.5);
        font-size: 0.85rem;
        line-height: 1.5;
        margin-bottom: 0;
      }

      .sp-card-cat {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 12px;
        font-size: 0.72rem;
        color: rgba(255,255,255,0.4);
        background: rgba(255,255,255,0.06);
        padding: 4px 10px;
        border-radius: 20px;
      }

      /* Pill de beneficio/código descuento destacado */
      .sp-card-code {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 10px;
        margin-left: 6px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        color: #0f0c29;
        background: linear-gradient(90deg, #a78bfa, #34d399);
        padding: 5px 12px;
        border-radius: 20px;
        box-shadow: 0 2px 10px rgba(167,139,250,0.25);
      }

      /* Badge "Aliado" (sin código, solo partnership) */
      .sp-card-badge--ally {
        background: linear-gradient(90deg, #34d399, #10b981);
      }

      /* --- Video card --- */
      .sp-card-video {
        width: 300px;
        flex-shrink: 0;
      }

      .sp-video-wrap {
        width: 100%;
        height: 100%;
        min-height: 280px;
        border-radius: 20px;
        overflow: hidden;
        position: relative;
        background: #111;
        border: 1px solid rgba(255,255,255,0.1);
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        cursor: pointer;
        transition: transform 0.4s cubic-bezier(.22,1,.36,1), box-shadow 0.4s;
      }

      .sp-video-wrap:hover {
        transform: translateY(-8px) scale(1.03);
        box-shadow: 0 20px 50px rgba(0,0,0,0.5);
      }

      .sp-video-wrap iframe,
      .sp-video-wrap video {
        width: 100%;
        height: 100%;
        min-height: 280px;
        object-fit: cover;
        border: none;
        display: block;
      }

      .sp-video-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.3);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 1;
        transition: opacity 0.3s;
        pointer-events: none;
      }

      .sp-video-wrap:hover .sp-video-overlay {
        opacity: 0;
      }

      .sp-video-play {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        backdrop-filter: blur(8px);
        margin-bottom: 10px;
      }

      .sp-video-play i {
        font-size: 1.5rem;
        color: white;
        margin-left: 4px;
      }

      .sp-video-label {
        color: rgba(255,255,255,0.8);
        font-size: 0.8rem;
        font-weight: 600;
      }

      /* --- CTA Sponsor --- */
      .sponsor-cta {
        margin-top: 48px;
        position: relative;
        z-index: 2;
      }

      .sponsor-cta a {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.8);
        padding: 14px 28px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s;
      }

      .sponsor-cta a:hover {
        background: rgba(167,139,250,0.15);
        border-color: rgba(167,139,250,0.4);
        color: white;
        transform: translateY(-2px);
      }

      @media (max-width: 768px) {
        .sponsors-title { font-size: 1.8rem; }
        .sp-card { width: 260px; }
        .sp-card-img { height: 140px; }
        .sp-card-video { width: 260px; }
        .sp-video-wrap { min-height: 240px; }
        .sp-video-wrap iframe,
        .sp-video-wrap video { min-height: 240px; }
        .sponsor-carousel-wrapper::before,
        .sponsor-carousel-wrapper::after { width: 40px; }
      }
    </style>

    <div class="sponsors-header">
      <div class="sponsors-divider reveal"></div>
      <h2 class="sponsors-title reveal">Nuestros <span>Sponsors</span></h2>
      <p class="sponsors-sub reveal">Empresas que confian en Toori y respaldan a nuestros profesionales</p>
    </div>

    <!-- Carrusel con flechas + auto-play -->
    <div class="sponsor-carousel-wrapper">
      <button class="sp-arrow sp-arrow-left" id="sp-arrow-left" aria-label="Sponsor anterior">
        <i class="bi bi-chevron-left"></i>
      </button>
      <button class="sp-arrow sp-arrow-right" id="sp-arrow-right" aria-label="Sponsor siguiente">
        <i class="bi bi-chevron-right"></i>
      </button>
      <div class="sponsor-carousel-track" id="sponsor-track">

        <!-- Sponsor: Escuelas IADE -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Aliado</span>
            <img class="sp-card-img" src="assets/sponsors/iade-card.png" alt="Escuelas IADE - Oficios, Tecnologia y Diseno">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Escuelas IADE</div>
            <p class="sp-card-desc">Medio siglo de liderazgo en educacion a distancia. Aprende un oficio y ofrecelo en Toori.</p>
            <span class="sp-card-cat"><i class="bi bi-mortarboard"></i> Educacion & Oficios</span>
            <span class="sp-card-code"><i class="bi bi-tag-fill"></i> TOORI777</span>
          </div>
        </div>

        <!-- Sponsor: El Sotano -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Aliado</span>
            <img class="sp-card-img" src="assets/sponsors/elsotano-card.png" alt="El Sotano Ferreteria y Cerrajeria">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">El Sotano</div>
            <p class="sp-card-desc">Ferreteria y cerrajeria con beneficios exclusivos para la comunidad Toori.</p>
            <span class="sp-card-cat"><i class="bi bi-tools"></i> Ferreteria & Cerrajeria</span>
            <span class="sp-card-code"><i class="bi bi-tag-fill"></i> TOORISERVI</span>
          </div>
        </div>

        <!-- Sponsor: IEC Instituto de Ensenanza de la Construccion -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge sp-card-badge--ally">Aliado</span>
            <img class="sp-card-img sp-card-img--contain" src="assets/sponsors/iec-card.png" alt="IEC Instituto de Ensenanza de la Construccion">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">IEC Construccion</div>
            <p class="sp-card-desc">Instituto de Ensenanza de la Construccion. Capacitacion tecnica para nuestros profesionales.</p>
            <span class="sp-card-cat"><i class="bi bi-building"></i> Capacitacion Tecnica</span>
          </div>
        </div>

        <!-- Sponsor: DARSIE -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Aliado</span>
            <img class="sp-card-img" src="assets/sponsors/darsie-card.png" alt="Darsie - Aliado Toori">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Darsie</div>
            <p class="sp-card-desc">Aliado de la comunidad Toori con descuentos exclusivos para profesionales y clientes.</p>
            <span class="sp-card-cat"><i class="bi bi-shop"></i> Beneficio Exclusivo</span>
            <span class="sp-card-code"><i class="bi bi-tag-fill"></i> TOORI777</span>
          </div>
        </div>

        <!-- Sponsor: Sancor Seguros -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge sp-card-badge--ally">Aliado</span>
            <img class="sp-card-img" src="assets/sponsors/sancor-card.png" alt="Sancor Seguros - Accidentes Personales">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Sancor Seguros</div>
            <p class="sp-card-desc">Tu seguro de Accidentes Personales. Respaldo para cada profesional de la red Toori.</p>
            <span class="sp-card-cat"><i class="bi bi-shield-check"></i> Cobertura & Seguros</span>
          </div>
        </div>

      </div><!-- /track -->
    </div><!-- /wrapper -->

    <!-- CTA -->
    <div class="sponsor-cta reveal">
      <a href="https://wa.me/5493512139046?text=Hola!%20Quiero%20ser%20sponsor%20de%20Toori">
        <i class="bi bi-stars"></i> Quiero ser sponsor de Toori
      </a>
    </div>

  </div>
</section>

<!-- Carrusel: flechas manuales + auto-play con pausa en hover -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', () => {
    const track = document.getElementById('sponsor-track');
    const leftBtn = document.getElementById('sp-arrow-left');
    const rightBtn = document.getElementById('sp-arrow-right');
    if (!track || !leftBtn || !rightBtn) return;

    const scrollStep = () => {
      const firstCard = track.querySelector('.sp-card');
      if (!firstCard) return 320;
      return firstCard.offsetWidth + 28; // card width + gap
    };

    leftBtn.addEventListener('click', () => {
      track.scrollBy({ left: -scrollStep(), behavior: 'smooth' });
      pauseAutoplay();
    });

    rightBtn.addEventListener('click', () => {
      track.scrollBy({ left: scrollStep(), behavior: 'smooth' });
      pauseAutoplay();
    });

    // Auto-play: avanza cada 4s, reinicia al final
    let autoInterval = null;
    let pausedUntil = 0;

    const tick = () => {
      if (Date.now() < pausedUntil) return;
      const atEnd = track.scrollLeft + track.clientWidth >= track.scrollWidth - 4;
      if (atEnd) {
        track.scrollTo({ left: 0, behavior: 'smooth' });
      } else {
        track.scrollBy({ left: scrollStep(), behavior: 'smooth' });
      }
    };

    const startAutoplay = () => {
      if (autoInterval) return;
      autoInterval = setInterval(tick, 4000);
    };

    const pauseAutoplay = () => {
      pausedUntil = Date.now() + 8000; // pausa 8s tras interaccion manual
    };

    track.addEventListener('mouseenter', () => { pausedUntil = Date.now() + 999999; });
    track.addEventListener('mouseleave', () => { pausedUntil = 0; });

    // Respeta prefers-reduced-motion
    const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (!reduceMotion) startAutoplay();
  });
})();
</script>

    <!-- ===================== COMO FUNCIONA ===================== -->
    <section class="section mesh-bg-soft" id="como-funciona" style="background-color: var(--bg-white);">
        <div class="container text-center">
            <h2 class="section-title reveal">Como funciona?</h2>
            <p class="section-subtitle reveal">En 3 simples pasos conseguis el profesional que necesitas</p>

            <div class="grid steps-grid stagger-children"
                style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 40px; align-items: start; margin-bottom: 50px;">

                <div class="step-card reveal">
                    <div class="step-number">1</div>
                    <div style="min-height: 220px; display: flex; align-items: center; justify-content: center;">
                        <img src="assets/paso1.png" alt="Buscas el servicio">
                    </div>
                    <h4>Buscas el servicio que necesites</h4>
                </div>

                <div class="step-card reveal">
                    <div class="step-number">2</div>
                    <div style="min-height: 220px; display: flex; align-items: center; justify-content: center;">
                        <img src="assets/paso2.png" alt="Encontramos perfil">
                    </div>
                    <h4>Encontramos el mejor prestador para vos</h4>
                </div>

                <div class="step-card reveal">
                    <div class="step-number">3</div>
                    <div style="min-height: 220px; display: flex; align-items: center; justify-content: center;">
                        <img src="assets/paso3.png" alt="Coordinamos">
                    </div>
                    <h4>Coordinamos juntos el servicio</h4>
                </div>
            </div>

            <div class="reveal" style="display: inline-flex; align-items: center; gap: 16px; flex-wrap: wrap; justify-content: center;">
                <span style="font-size: 1.05rem; color: var(--text-muted); font-weight: 500;">Queres saber mas?</span>
                <a href="https://play.google.com/store/apps/details?id=com.alex_6775.appTrabajo&hl=es_AR"
                    class="btn btn-primary btn-ripple" style="padding: 12px 30px; border-radius: 50px;">Descargar la app</a>
            </div>
        </div>
    </section>

    <!-- ===================== CATEGORIAS CON IMAGENES REALES ===================== -->
    <section class="section" id="categorias" style="background-color: var(--bg-soft);">
        <div class="container text-center">
            <h2 class="section-title reveal">Que servicio estas buscando?</h2>
            <p class="section-subtitle reveal">Elegimos al profesional ideal para cada trabajo en tu hogar</p>

            <div class="grid categories-grid-enhanced stagger-children"
                style="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; max-width: 1000px; margin: 0 auto;">

                <div class="category-card reveal">
                    <div class="category-card-img-wrapper">
                        <img class="category-card-img" src="https://images.pexels.com/photos/4107120/pexels-photo-4107120.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Limpieza" loading="lazy">
                    </div>
                    <div class="category-card-body">
                        <i class="bi bi-stars icon-hover-bounce"></i>
                        <h4>Limpieza</h4>
                        <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="Limpieza">Iniciar gestion</button>
                    </div>
                </div>

                <div class="category-card reveal">
                    <div class="category-card-img-wrapper">
                        <img class="category-card-img" src="https://images.pexels.com/photos/6419128/pexels-photo-6419128.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Plomeria" loading="lazy">
                    </div>
                    <div class="category-card-body">
                        <i class="bi bi-wrench icon-hover-bounce"></i>
                        <h4>Plomeria</h4>
                        <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="Plomeria">Iniciar gestion</button>
                    </div>
                </div>

                <div class="category-card reveal">
                    <div class="category-card-img-wrapper">
                        <img class="category-card-img" src="https://images.pexels.com/photos/8005397/pexels-photo-8005397.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Electricidad" loading="lazy">
                    </div>
                    <div class="category-card-body">
                        <i class="bi bi-lightbulb icon-hover-bounce"></i>
                        <h4>Electricidad</h4>
                        <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="Electricidad">Iniciar gestion</button>
                    </div>
                </div>

                <div class="category-card reveal">
                    <div class="category-card-img-wrapper">
                        <img class="category-card-img" src="https://images.pexels.com/photos/6492108/pexels-photo-6492108.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Gas" loading="lazy">
                    </div>
                    <div class="category-card-body">
                        <i class="bi bi-fire icon-hover-bounce"></i>
                        <h4>Gas</h4>
                        <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="Gas">Iniciar gestion</button>
                    </div>
                </div>

                <div class="category-card reveal">
                    <div class="category-card-img-wrapper">
                        <img class="category-card-img" src="https://images.pexels.com/photos/6474471/pexels-photo-6474471.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Pintura" loading="lazy">
                    </div>
                    <div class="category-card-body">
                        <i class="bi bi-brush icon-hover-bounce"></i>
                        <h4>Pintura</h4>
                        <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="Pintura">Iniciar gestion</button>
                    </div>
                </div>

                <div class="category-card reveal">
                    <div class="category-card-img-wrapper">
                        <img class="category-card-img" src="https://images.pexels.com/photos/1301856/pexels-photo-1301856.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Jardineria" loading="lazy">
                    </div>
                    <div class="category-card-body">
                        <i class="bi bi-tree icon-hover-bounce"></i>
                        <h4>Jardineria</h4>
                        <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="Jardineria">Iniciar gestion</button>
                    </div>
                </div>

                <div class="category-card reveal">
                    <div class="category-card-img-wrapper">
                        <img class="category-card-img" src="https://images.pexels.com/photos/2219024/pexels-photo-2219024.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Albanileria" loading="lazy">
                    </div>
                    <div class="category-card-body">
                        <i class="bi bi-bricks icon-hover-bounce"></i>
                        <h4>Albanileria</h4>
                        <button class="btn btn-primary btn-ripple whatsapp-btn" data-category="Albanileria">Iniciar gestion</button>
                    </div>
                </div>

                <div class="category-card reveal" style="background: linear-gradient(135deg, var(--toori-blue) 0%, #178abf 100%);">
                    <div class="category-card-img-wrapper" style="height:160px;display:flex;align-items:center;justify-content:center;background:rgba(255,255,255,0.08);">
                        <i class="bi bi-grid-fill" style="font-size:4rem;color:rgba(255,255,255,0.6);"></i>
                    </div>
                    <div class="category-card-body" style="color:white;">
                        <i class="bi bi-arrow-right-circle icon-hover-bounce" style="color:white;"></i>
                        <h4 style="color:white;">Ver todas</h4>
                        <a href="categorias.php" class="btn btn-ripple" style="background:rgba(255,255,255,0.2);color:white;border:1px solid rgba(255,255,255,0.3);padding:8px 20px;font-size:0.85rem;border-radius:50px;">Explorar mas</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Mesh divider -->
    <div class="mesh-divider"></div>

    <!-- ===================== TESTIMONIOS ===================== -->
    <section class="testimonials-section">
        <div class="container text-center">
            <h2 class="section-title reveal">Lo que dicen nuestros clientes</h2>
            <p class="section-subtitle reveal">Miles de personas ya confiaron en Toori para resolver sus necesidades</p>

            <div class="grid testimonials-grid stagger-children" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">

                <div class="testimonial-card reveal">
                    <div class="testimonial-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="testimonial-text">"Necesitaba un plomero urgente un domingo y en menos de 30 minutos ya tenia uno en camino. Excelente servicio, muy profesional."</p>
                    <div class="testimonial-author">
                        <img class="testimonial-avatar" src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=100&h=100&fit=crop&q=80" alt="Maria G.">
                        <div style="text-align:left;">
                            <div class="testimonial-name">Maria G.</div>
                            <div class="testimonial-role">Cliente desde 2024</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal">
                    <div class="testimonial-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <p class="testimonial-text">"Me registre como electricista y en la primera semana ya tenia 3 trabajos. La plataforma es muy facil de usar y los pagos son rapidos."</p>
                    <div class="testimonial-author">
                        <img class="testimonial-avatar" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=100&h=100&fit=crop&q=80" alt="Carlos R.">
                        <div style="text-align:left;">
                            <div class="testimonial-name">Carlos R.</div>
                            <div class="testimonial-role">Electricista verificado</div>
                        </div>
                    </div>
                </div>

                <div class="testimonial-card reveal">
                    <div class="testimonial-stars">
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-half"></i>
                    </div>
                    <p class="testimonial-text">"Lo mejor es la tranquilidad de saber que los profesionales estan verificados. Contrate pintura para toda mi casa y quedo impecable."</p>
                    <div class="testimonial-author">
                        <img class="testimonial-avatar" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop&q=80" alt="Laura M.">
                        <div style="text-align:left;">
                            <div class="testimonial-name">Laura M.</div>
                            <div class="testimonial-role">Cliente desde 2023</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== CTA REGISTRO ===================== -->
    <section class="section" style="padding-bottom: 80px;">
        <div class="container text-center">
            <h2 class="section-title reveal" style="margin-bottom: 32px;">Queres ofrecer servicios en Toori?</h2>

            <div class="grid cta-register reveal"
                style="grid-template-columns: 1fr 1.2fr; gap: 0; align-items: stretch; text-align: left;">
                <div class="cta-register-content">
                    <h3 style="font-size: 2rem; margin-bottom: 0.2rem; color: #2C2C2C; font-weight: 700;">Registrate facilisimo y</h3>
                    <h3 style="font-size: 2rem; margin-bottom: 1.5rem; color: #2C2C2C; font-weight: 700;">empeza <span style="color: var(--toori-green);">hoy mismo</span></h3>
                    <p style="color: #555; font-size: 1.05rem; margin-bottom: 2rem; max-width: 380px; line-height: 1.7;">
                        Hay miles de usuarios esperando contratarte. Unite a la red de profesionales verificados de Toori.</p>
                    <div style="display:flex;gap:12px;flex-wrap:wrap;">
                        <a href="registro.php" class="btn btn-primary btn-ripple" style="padding: 14px 32px; font-size: 1rem; border-radius: 50px;">Ofrecer Servicios</a>
                    </div>
                    <div style="margin-top:20px;display:flex;gap:24px;flex-wrap:wrap;">
                        <div style="display:flex;align-items:center;gap:8px;color:#666;font-size:0.9rem;">
                            <i class="bi bi-check-circle-fill" style="color:var(--toori-green);"></i> Registro gratuito
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;color:#666;font-size:0.9rem;">
                            <i class="bi bi-check-circle-fill" style="color:var(--toori-green);"></i> Sin comisiones ocultas
                        </div>
                    </div>
                </div>
                <div class="imgServiciosToori" style="padding: 24px;">
                    <div class="cta-register-img" style="background-image: url('assets/paso4.png'); overflow:hidden; border-radius:16px;"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== APP MOCKUP SECTION ===================== -->
    <section class="app-section">
        <div class="container">
            <div class="grid app-grid" style="grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">

                <div class="app-content reveal-left">
                    <h2>Tu hogar en la palma de tu mano</h2>
                    <p>Descarga la app de Toori y gestiona todos tus servicios desde cualquier lugar. Rapido, seguro y siempre disponible.</p>

                    <div class="app-features">
                        <div class="app-feature">
                            <i class="bi bi-bell-fill"></i>
                            <span>Notificaciones en tiempo real</span>
                        </div>
                        <div class="app-feature">
                            <i class="bi bi-chat-dots-fill"></i>
                            <span>Chat directo con profesionales</span>
                        </div>
                        <div class="app-feature">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Profesionales cerca tuyo</span>
                        </div>
                        <div class="app-feature">
                            <i class="bi bi-credit-card-fill"></i>
                            <span>Pagos seguros integrados</span>
                        </div>
                    </div>

                    <div class="app-download-buttons">
                        <a href="https://play.google.com/store/apps/details?id=com.alex_6775.appTrabajo&hl=es_AR" target="_blank" class="app-download-btn">
                            <i class="bi bi-google-play"></i>
                            <div>
                                <div style="font-size:0.7rem;opacity:0.7;">Disponible en</div>
                                <div>Google Play</div>
                            </div>
                        </a>
                        <a href="#" class="app-download-btn" style="opacity:0.5;pointer-events:none;">
                            <i class="bi bi-apple"></i>
                            <div>
                                <div style="font-size:0.7rem;opacity:0.7;">Proximamente</div>
                                <div>App Store</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Phone Mockup con screenshot real del app -->
                <div class="reveal-right" style="display:flex;justify-content:center;">
                    <div class="app-mockup">
                        <img class="app-mockup-img" src="assets/app-screenshot.jpeg" alt="App Toori ServiciosYa - Pantalla principal" loading="lazy">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== PLATAFORMA TOORI ===================== -->
    <section class="platform-section" style="background: linear-gradient(135deg, #0f0c29, #1a1a3e, #24243e); padding: 90px 0; overflow: hidden; position: relative;">
        <style>
            .platform-section::before {
                content: '';
                position: absolute;
                inset: 0;
                background:
                    radial-gradient(ellipse 50% 50% at 20% 30%, rgba(59,168,224,0.1) 0%, transparent 60%),
                    radial-gradient(ellipse 40% 50% at 80% 70%, rgba(52,211,153,0.08) 0%, transparent 60%),
                    radial-gradient(ellipse 30% 40% at 50% 50%, rgba(129,140,248,0.08) 0%, transparent 60%);
                pointer-events: none;
            }
            .platform-header {
                text-align: center;
                margin-bottom: 56px;
                position: relative;
                z-index: 2;
            }
            .platform-header-eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: rgba(255,255,255,0.06);
                border: 1px solid rgba(255,255,255,0.1);
                color: rgba(255,255,255,0.85);
                padding: 6px 16px;
                border-radius: 50px;
                font-size: 0.78rem;
                font-weight: 600;
                margin-bottom: 18px;
                letter-spacing: 0.06em;
                text-transform: uppercase;
            }
            .platform-header h2 {
                color: white;
                font-size: 2.4rem;
                margin-bottom: 14px;
                line-height: 1.15;
                font-weight: 800;
            }
            .platform-header h2 span {
                background: linear-gradient(90deg, #3ba8e0, #34d399, #fcd34d);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }
            .platform-header p {
                color: rgba(255,255,255,0.55);
                font-size: 1.05rem;
                max-width: 620px;
                margin: 0 auto;
            }

            .platform-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 24px;
                position: relative;
                z-index: 2;
            }
            .platform-card {
                background: linear-gradient(145deg, rgba(255,255,255,0.06) 0%, rgba(255,255,255,0.02) 100%);
                border: 1px solid rgba(255,255,255,0.1);
                border-radius: 20px;
                padding: 32px 28px;
                transition: all 0.4s cubic-bezier(.22,1,.36,1);
                position: relative;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                backdrop-filter: blur(14px);
                -webkit-backdrop-filter: blur(14px);
            }
            .platform-card::before {
                content: '';
                position: absolute;
                inset: 0;
                opacity: 0.08;
                pointer-events: none;
                transition: opacity 0.3s;
            }
            .platform-card:hover {
                transform: translateY(-6px);
                border-color: rgba(255,255,255,0.2);
                box-shadow: 0 20px 50px rgba(0,0,0,0.5);
            }
            .platform-card:hover::before { opacity: 0.14; }

            .platform-card.toori360::before { background: radial-gradient(circle at 0% 0%, #3ba8e0, transparent 70%); }
            .platform-card.crm::before { background: radial-gradient(circle at 0% 0%, #818cf8, transparent 70%); }
            .platform-card.fact::before { background: radial-gradient(circle at 0% 0%, #34d399, transparent 70%); }

            .platform-card-icon {
                width: 56px;
                height: 56px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 1.5rem;
                margin-bottom: 22px;
                box-shadow: 0 8px 24px rgba(0,0,0,0.2);
            }
            .platform-card.toori360 .platform-card-icon { background: linear-gradient(135deg, #3ba8e0, #aecd5a); }
            .platform-card.crm .platform-card-icon { background: linear-gradient(135deg, #3ba8e0, #818cf8); }
            .platform-card.fact .platform-card-icon { background: linear-gradient(135deg, #34d399, #fcd34d); }

            .platform-card-title {
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 10px;
            }
            .platform-card h3 {
                color: white;
                font-size: 1.4rem;
                margin: 0;
                font-weight: 800;
            }
            .platform-soon {
                font-size: 0.6rem;
                padding: 3px 9px;
                border-radius: 10px;
                background: rgba(252,211,77,0.15);
                color: #fcd34d;
                font-weight: 800;
                letter-spacing: 0.05em;
                text-transform: uppercase;
            }

            .platform-card-desc {
                color: rgba(255,255,255,0.6);
                font-size: 0.95rem;
                line-height: 1.6;
                margin-bottom: 20px;
            }

            .platform-features {
                list-style: none;
                padding: 0;
                margin: 0 0 26px 0;
                flex: 1;
            }
            .platform-features li {
                display: flex;
                align-items: center;
                gap: 10px;
                color: rgba(255,255,255,0.7);
                font-size: 0.88rem;
                padding: 6px 0;
            }
            .platform-features li i {
                font-size: 0.95rem;
                flex-shrink: 0;
            }
            .platform-card.toori360 .platform-features li i { color: #aecd5a; }
            .platform-card.crm .platform-features li i { color: #818cf8; }
            .platform-card.fact .platform-features li i { color: #34d399; }

            .platform-card-btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 22px;
                border-radius: 12px;
                font-weight: 700;
                text-decoration: none;
                font-size: 0.92rem;
                transition: all 0.3s;
                border: 1px solid rgba(255,255,255,0.15);
                color: white;
                background: rgba(255,255,255,0.05);
            }
            .platform-card:hover .platform-card-btn {
                background: rgba(255,255,255,0.12);
                border-color: rgba(255,255,255,0.25);
            }
            .platform-card.toori360:hover .platform-card-btn {
                background: var(--toori-blue);
                border-color: var(--toori-blue);
            }
            .platform-card.crm:hover .platform-card-btn {
                background: linear-gradient(135deg, #3ba8e0, #818cf8);
                border-color: transparent;
            }
            .platform-card.fact:hover .platform-card-btn {
                background: linear-gradient(135deg, #34d399, #fcd34d);
                border-color: transparent;
                color: #0c1a12;
            }

            @media (max-width: 900px) {
                .platform-grid { grid-template-columns: 1fr; gap: 18px; }
                .platform-header h2 { font-size: 1.8rem; }
                .platform-section { padding: 70px 0; }
            }
        </style>

        <div class="container" style="position:relative;z-index:2;">
            <div class="platform-header">
                <div class="platform-header-eyebrow reveal">
                    <i class="bi bi-stars"></i> La plataforma Toori
                </div>
                <h2 class="reveal">Todo lo que necesitas, en <span>un solo lugar</span></h2>
                <p class="reveal">Tres productos integrados para que gestiones, vendas y factures sin cambiar de herramienta.</p>
            </div>

            <div class="platform-grid">
                <!-- Toori360 -->
                <div class="platform-card toori360 reveal">
                    <div class="platform-card-icon"><i class="bi bi-buildings"></i></div>
                    <div class="platform-card-title">
                        <h3>Toori360</h3>
                    </div>
                    <p class="platform-card-desc">
                        Gestion de mantenimiento, incidencias y proveedores para inmobiliarias y consorcios con trazabilidad total.
                    </p>
                    <ul class="platform-features">
                        <li><i class="bi bi-check-circle-fill"></i> Tickets inteligentes</li>
                        <li><i class="bi bi-check-circle-fill"></i> WhatsApp + IA integrados</li>
                        <li><i class="bi bi-check-circle-fill"></i> Multi-tenant</li>
                    </ul>
                    <a href="toori360.php" class="platform-card-btn">
                        Conocer mas <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <!-- CRM -->
                <div class="platform-card crm reveal">
                    <div class="platform-card-icon"><i class="bi bi-people-fill"></i></div>
                    <div class="platform-card-title">
                        <h3>Toori CRM</h3>
                        <span class="platform-soon">Pronto</span>
                    </div>
                    <p class="platform-card-desc">
                        Pipeline visual, WhatsApp integrado y automatizaciones para equipos comerciales que quieren vender mas.
                    </p>
                    <ul class="platform-features">
                        <li><i class="bi bi-check-circle-fill"></i> Pipeline Kanban</li>
                        <li><i class="bi bi-check-circle-fill"></i> Reportes en tiempo real</li>
                        <li><i class="bi bi-check-circle-fill"></i> Multi-usuario</li>
                    </ul>
                    <a href="crm.php" class="platform-card-btn">
                        Reservar acceso <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                <!-- FacturaIA -->
                <div class="platform-card fact reveal">
                    <div class="platform-card-icon"><i class="bi bi-receipt"></i></div>
                    <div class="platform-card-title">
                        <h3>FacturaIA</h3>
                        <span class="platform-soon">Pronto</span>
                    </div>
                    <p class="platform-card-desc">
                        Facturacion electronica AFIP con asistente IA. Emite comprobantes A, B, C y notas en segundos.
                    </p>
                    <ul class="platform-features">
                        <li><i class="bi bi-check-circle-fill"></i> Conexion directa AFIP</li>
                        <li><i class="bi bi-check-circle-fill"></i> Asistente IA integrado</li>
                        <li><i class="bi bi-check-circle-fill"></i> PDF + envio automatico</li>
                    </ul>
                    <a href="facturacion.php" class="platform-card-btn">
                        Reservar acceso <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== FAQ ACCORDION ===================== -->
    <section class="faq-section">
        <div class="container text-center">
            <h2 class="section-title reveal">Preguntas frecuentes</h2>
            <p class="section-subtitle reveal">Todo lo que necesitas saber sobre Toori</p>

            <div class="faq-container">
                <div class="faq-item reveal">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Como solicito un servicio?</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Es muy simple: elegi la categoria del servicio que necesitas, envianos un mensaje por WhatsApp describiendo tu necesidad y nosotros nos encargamos de encontrar al mejor profesional para vos. En minutos recibis presupuestos.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Los profesionales estan verificados?</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Si, todos nuestros profesionales pasan por un proceso de verificacion que incluye DNI, antecedentes y certificaciones. Los que tienen el badge de "verificado" cuentan con matricula profesional y certificado de antecedentes penales.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Cuanto cuesta usar Toori?</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Para los clientes, el uso de la plataforma es completamente gratuito. Solo pagas el costo del servicio acordado con el profesional. Para los trabajadores, el registro tambien es gratis y sin comisiones ocultas.</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>En que zonas operan?</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Actualmente operamos en San Fernando del Valle de Catamarca y alrededores. Estamos expandiendonos a mas ciudades de Argentina. Si queres que lleguemos a tu ciudad, contactanos!</p>
                    </div>
                </div>

                <div class="faq-item reveal">
                    <div class="faq-question" onclick="toggleFaq(this)">
                        <span>Como me registro como profesional?</span>
                        <i class="bi bi-chevron-down"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Hace click en "Ofrecer Servicios", completa el formulario con tus datos y especialidad. Si tenes matricula y certificado de antecedentes, subilos para obtener el badge de verificado y tener mayor visibilidad.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===================== FOOTER ===================== -->
    <?php include 'footer.php'; ?>

    <!-- Fixed Mobile CTA -->
    <div class="fixed-mobile-cta">
        <a href="#categorias" class="btn btn-primary btn-ripple w-100" style="padding: 14px;">Iniciar mi pedido ahora</a>
    </div>

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/5493512139046?text=Hola!%20Necesito%20ayuda%20con%20Toori" class="floating-wa"
        target="_blank" rel="noopener noreferrer" title="Contactate con nuestro Bot">
        <i class="bi bi-whatsapp"></i>
    </a>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- WhatsApp Category Handler -->
    <script>
        document.addEventListener('click', function(e) {
            var btn = e.target.closest('.whatsapp-btn, .dynamic-whatsapp-btn');
            if (btn) {
                e.preventDefault();
                e.stopImmediatePropagation();
                var category = btn.getAttribute('data-category') || 'Servicio General';
                window.open('https://wa.me/5493512139046?text=' + encodeURIComponent('Busco un servicio de ' + category), '_blank');
            }
        }, true);
    </script>

    <!-- Scroll Reveal + Counter + Navbar Scroll + Parallax + Ripple + FAQ -->
    <script>
    (function() {
        // --- Scroll Reveal ---
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        // --- Animated Counter ---
        let counterStarted = false;
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !counterStarted) {
                    counterStarted = true;
                    document.querySelectorAll('.stat-number[data-target]').forEach(el => {
                        const target = parseFloat(el.dataset.target);
                        const suffix = el.dataset.suffix || '';
                        const isDecimal = el.dataset.decimal === 'true';
                        const duration = 2000;
                        const start = performance.now();

                        function update(now) {
                            const elapsed = now - start;
                            const progress = Math.min(elapsed / duration, 1);
                            const eased = 1 - Math.pow(1 - progress, 3);
                            const current = eased * target;

                            if (isDecimal) {
                                el.textContent = current.toFixed(1) + suffix;
                            } else {
                                el.textContent = Math.floor(current) + suffix;
                            }

                            if (progress < 1) requestAnimationFrame(update);
                        }
                        requestAnimationFrame(update);
                    });
                }
            });
        }, { threshold: 0.3 });

        document.addEventListener('DOMContentLoaded', () => {
            // Reveal
            document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale').forEach(el => {
                revealObserver.observe(el);
            });

            // Counter
            const statsBar = document.querySelector('.stats-bar');
            if (statsBar) counterObserver.observe(statsBar);
        });

        // --- Navbar Scroll Shrink ---
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const navbar = document.querySelector('.navbar');
            if (!navbar) return;
            if (window.scrollY > 80) {
                navbar.classList.add('navbar--scrolled');
            } else {
                navbar.classList.remove('navbar--scrolled');
            }
            lastScroll = window.scrollY;
        }, { passive: true });

        // --- Button Ripple Effect ---
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.btn-ripple');
            if (!btn) return;

            const ripple = document.createElement('span');
            ripple.className = 'ripple';
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
            ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
            btn.appendChild(ripple);
            ripple.addEventListener('animationend', () => ripple.remove());
        });
    })();

    // --- FAQ Accordion ---
    function toggleFaq(el) {
        const item = el.parentElement;
        const wasActive = item.classList.contains('active');

        // Cerrar todos
        document.querySelectorAll('.faq-item').forEach(faq => {
            faq.classList.remove('active');
        });

        // Abrir si no estaba activo
        if (!wasActive) {
            item.classList.add('active');
        }
    }
    </script>

    <!-- Hero Slideshow Controller -->
    <script>
    (function() {
        const slides = document.querySelectorAll('.hero-slide');
        const indicators = document.querySelectorAll('.hero-indicator');
        const label = document.getElementById('hero-label');
        let current = 0;
        let interval;
        const DURATION = 6000; // 6 segundos por slide

        function goToSlide(index) {
            // Quitar active de todos
            slides.forEach(s => s.classList.remove('active'));
            indicators.forEach(i => i.classList.remove('active'));

            // Fade label
            if (label) {
                label.classList.remove('visible');
            }

            current = index;

            // Activar nuevo
            slides[current].classList.add('active');
            indicators[current].classList.add('active');

            // Actualizar label con delay
            setTimeout(() => {
                if (label) {
                    label.textContent = slides[current].dataset.label || '';
                    label.classList.add('visible');
                }
            }, 400);
        }

        function nextSlide() {
            goToSlide((current + 1) % slides.length);
        }

        function startAutoplay() {
            interval = setInterval(nextSlide, DURATION);
        }

        function stopAutoplay() {
            clearInterval(interval);
        }

        // Click en indicadores
        indicators.forEach(ind => {
            ind.addEventListener('click', () => {
                stopAutoplay();
                goToSlide(parseInt(ind.dataset.index));
                startAutoplay();
            });
        });

        // Iniciar
        if (slides.length > 0) {
            startAutoplay();
        }
    })();
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
