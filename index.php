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

      /* --- Carrusel infinito --- */
      .sponsor-carousel-wrapper {
        position: relative;
        overflow: hidden;
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
        animation: scroll-sponsors 35s linear infinite;
        width: max-content;
      }

      .sponsor-carousel-track:hover {
        animation-play-state: paused;
      }

      @keyframes scroll-sponsors {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
      }

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

    <!-- Carrusel infinito -->
    <div class="sponsor-carousel-wrapper">
      <div class="sponsor-carousel-track" id="sponsor-track">

        <!-- Sponsor 1: Ferreteria -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Sponsor</span>
            <img class="sp-card-img" src="https://images.pexels.com/photos/1029243/pexels-photo-1029243.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Ferreteria El Tornillo">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Ferreteria El Tornillo</div>
            <p class="sp-card-desc">Materiales y herramientas de calidad al mejor precio para tu hogar</p>
            <span class="sp-card-cat"><i class="bi bi-tools"></i> Materiales & Herramientas</span>
          </div>
        </div>

        <!-- Sponsor 2: Automotores -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Sponsor</span>
            <img class="sp-card-img" src="https://images.pexels.com/photos/3802510/pexels-photo-3802510.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Automotores Catamarca">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Automotores Catamarca</div>
            <p class="sp-card-desc">Financiacion inmediata, sin tramites complicados</p>
            <span class="sp-card-cat"><i class="bi bi-car-front"></i> Automotores</span>
          </div>
        </div>

        <!-- Sponsor 3: Farmacia -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Sponsor</span>
            <img class="sp-card-img" src="https://images.pexels.com/photos/3683098/pexels-photo-3683098.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Farmacia Central">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Farmacia Central</div>
            <p class="sp-card-desc">Medicamentos, cosmeticos y atencion personalizada 24hs</p>
            <span class="sp-card-cat"><i class="bi bi-heart-pulse"></i> Salud & Bienestar</span>
          </div>
        </div>

        <!-- VIDEO SPONSOR -->
        <div class="sp-card-video">
          <div class="sp-video-wrap" id="sp-video-container" onclick="playSpVideo(this)">
            <img class="sp-card-img" src="https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Video Toori" id="sp-video-thumb" style="height:100%;min-height:280px;">
            <div class="sp-video-overlay" id="sp-video-overlay">
              <div class="sp-video-play"><i class="bi bi-play-fill"></i></div>
              <span class="sp-video-label">Ver video institucional</span>
            </div>
          </div>
        </div>

        <!-- Sponsor 4: Corralon -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Sponsor</span>
            <img class="sp-card-img" src="https://images.pexels.com/photos/2760243/pexels-photo-2760243.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Corralon del Norte">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Corralon del Norte</div>
            <p class="sp-card-desc">Arena, cemento, ladrillos y todo para tu obra</p>
            <span class="sp-card-cat"><i class="bi bi-bricks"></i> Construccion</span>
          </div>
        </div>

        <!-- Sponsor 5: Electrica -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Sponsor</span>
            <img class="sp-card-img" src="https://images.pexels.com/photos/257736/pexels-photo-257736.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Electrica San Martin">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Electrica San Martin</div>
            <p class="sp-card-desc">Cables, llaves termicas, tableros y materiales electricos</p>
            <span class="sp-card-cat"><i class="bi bi-lightning"></i> Electricidad</span>
          </div>
        </div>

        <!-- Sponsor 6: Pintureria -->
        <div class="sp-card">
          <div class="sp-card-img-wrap">
            <span class="sp-card-badge">Sponsor</span>
            <img class="sp-card-img" src="https://images.pexels.com/photos/1749900/pexels-photo-1749900.jpeg?auto=compress&cs=tinysrgb&w=400&h=300&fit=crop" alt="Pintureria Colores">
          </div>
          <div class="sp-card-body">
            <div class="sp-card-name">Pintureria Colores</div>
            <p class="sp-card-desc">Pinturas, rodillos, esmaltes y accesorios para renovar tu hogar</p>
            <span class="sp-card-cat"><i class="bi bi-palette"></i> Pintura & Deco</span>
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

<!-- Script para duplicar items y crear loop infinito + video -->
<script>
(function() {
  document.addEventListener('DOMContentLoaded', () => {
    // Duplicar cards para loop infinito
    const track = document.getElementById('sponsor-track');
    if (track) {
      const items = track.innerHTML;
      track.innerHTML = items + items;
    }
  });
})();

function playSpVideo(container) {
    // Reemplazar thumbnail con iframe de video
    // CAMBIAR esta URL por el video real del sponsor/empresa
    const videoUrl = 'https://www.youtube.com/embed/dQw4w9WgXcQ?autoplay=1&mute=1';
    const thumb = document.getElementById('sp-video-thumb');
    const overlay = document.getElementById('sp-video-overlay');

    if (thumb) thumb.style.display = 'none';
    if (overlay) overlay.style.display = 'none';

    const iframe = document.createElement('iframe');
    iframe.src = videoUrl;
    iframe.allow = 'autoplay; encrypted-media';
    iframe.allowFullscreen = true;
    container.appendChild(iframe);

    // Pausar carrusel cuando se reproduce video
    const track = document.getElementById('sponsor-track');
    if (track) track.style.animationPlayState = 'paused';
}
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

                <!-- Phone Mockup -->
                <div class="reveal-right" style="display:flex;justify-content:center;">
                    <div class="app-mockup">
                        <div class="app-mockup-screen">
                            <img src="assets/logo.png" alt="Toori" style="border-radius:14px;background:white;padding:4px;">
                            <div class="app-title">Toori ServiciosYa</div>
                            <div class="app-mockup-item">
                                <div class="item-icon"><i class="bi bi-stars"></i></div>
                                <div>
                                    <div class="item-text">Limpieza del hogar</div>
                                    <div class="item-sub">3 profesionales disponibles</div>
                                </div>
                            </div>
                            <div class="app-mockup-item">
                                <div class="item-icon"><i class="bi bi-wrench"></i></div>
                                <div>
                                    <div class="item-text">Plomeria urgente</div>
                                    <div class="item-sub">5 profesionales disponibles</div>
                                </div>
                            </div>
                            <div class="app-mockup-item">
                                <div class="item-icon"><i class="bi bi-lightbulb"></i></div>
                                <div>
                                    <div class="item-text">Instalacion electrica</div>
                                    <div class="item-sub">2 profesionales disponibles</div>
                                </div>
                            </div>
                            <div class="app-mockup-item">
                                <div class="item-icon"><i class="bi bi-brush"></i></div>
                                <div>
                                    <div class="item-text">Pintura interior</div>
                                    <div class="item-sub">4 profesionales disponibles</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===================== TOORI360 PROMO ===================== -->
    <section style="background: linear-gradient(135deg, #0f0c29, #1a1a3e, #24243e); padding: 80px 0; overflow: hidden; position: relative;">
        <div style="position:absolute;inset:0;background:radial-gradient(ellipse 50% 50% at 30% 50%, rgba(59,168,224,0.08) 0%, transparent 60%);pointer-events:none;"></div>
        <div class="container" style="position:relative;z-index:2;">
            <div class="grid reveal" style="grid-template-columns: 1fr 1fr; gap: 48px; align-items: center;">
                <div>
                    <div style="display:inline-flex;align-items:center;gap:8px;background:rgba(135,78,153,0.15);border:1px solid rgba(135,78,153,0.3);color:var(--toori-purple);padding:5px 14px;border-radius:50px;font-size:0.78rem;font-weight:600;margin-bottom:20px;">
                        <i class="bi bi-rocket-takeoff"></i> Nuevo producto
                    </div>
                    <h2 style="color:white;font-size:2rem;margin-bottom:14px;line-height:1.2;">
                        Conoce <span style="background:linear-gradient(90deg,var(--toori-blue),var(--toori-green));-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;">Toori360</span>
                    </h2>
                    <p style="color:rgba(255,255,255,0.6);font-size:1rem;line-height:1.7;margin-bottom:28px;max-width:420px;">
                        La plataforma B2B para inmobiliarias y consorcios que necesitan gestionar mantenimiento, incidencias y proveedores con trazabilidad total.
                    </p>
                    <div style="display:flex;gap:16px;flex-wrap:wrap;margin-bottom:24px;">
                        <div style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,0.7);font-size:0.88rem;">
                            <i class="bi bi-check-circle-fill" style="color:var(--toori-green);"></i> Tickets inteligentes
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,0.7);font-size:0.88rem;">
                            <i class="bi bi-check-circle-fill" style="color:var(--toori-green);"></i> WhatsApp + IA
                        </div>
                        <div style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,0.7);font-size:0.88rem;">
                            <i class="bi bi-check-circle-fill" style="color:var(--toori-green);"></i> Multi-tenant
                        </div>
                    </div>
                    <a href="toori360.php" class="btn btn-primary btn-ripple" style="padding:14px 32px;border-radius:14px;font-size:1rem;">
                        <i class="bi bi-arrow-right me-2"></i> Conocer mas
                    </a>
                </div>
                <div class="reveal-right" style="text-align:center;">
                    <div style="background:#1e1e2e;border-radius:16px;border:1px solid rgba(255,255,255,0.08);box-shadow:0 20px 60px rgba(0,0,0,0.4);overflow:hidden;max-width:380px;margin:0 auto;">
                        <div style="display:flex;align-items:center;gap:6px;padding:10px 14px;background:rgba(255,255,255,0.03);border-bottom:1px solid rgba(255,255,255,0.06);">
                            <div style="width:8px;height:8px;border-radius:50%;background:#ff5f57;"></div>
                            <div style="width:8px;height:8px;border-radius:50%;background:#ffbd2e;"></div>
                            <div style="width:8px;height:8px;border-radius:50%;background:#28ca41;"></div>
                        </div>
                        <div style="padding:20px;display:flex;flex-direction:column;gap:10px;">
                            <div style="display:flex;gap:10px;">
                                <div style="flex:1;background:rgba(59,168,224,0.1);border-radius:10px;padding:14px;text-align:center;">
                                    <div style="font-size:1.4rem;font-weight:700;color:var(--toori-blue);font-family:var(--font-title);">24</div>
                                    <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);">TICKETS</div>
                                </div>
                                <div style="flex:1;background:rgba(174,205,90,0.1);border-radius:10px;padding:14px;text-align:center;">
                                    <div style="font-size:1.4rem;font-weight:700;color:var(--toori-green);font-family:var(--font-title);">87</div>
                                    <div style="font-size:0.65rem;color:rgba(255,255,255,0.4);">RESUELTOS</div>
                                </div>
                            </div>
                            <div style="background:rgba(255,255,255,0.03);border-radius:8px;padding:10px 12px;display:flex;align-items:center;justify-content:space-between;">
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <span style="font-size:0.68rem;color:var(--toori-blue);font-family:monospace;font-weight:600;">TK-0024</span>
                                    <span style="font-size:0.72rem;color:rgba(255,255,255,0.5);">Fuga de agua 3ro B</span>
                                </div>
                                <span style="font-size:0.6rem;padding:2px 8px;border-radius:10px;background:rgba(59,168,224,0.15);color:var(--toori-blue);font-weight:600;">Abierto</span>
                            </div>
                            <div style="background:rgba(255,255,255,0.03);border-radius:8px;padding:10px 12px;display:flex;align-items:center;justify-content:space-between;">
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <span style="font-size:0.68rem;color:var(--toori-blue);font-family:monospace;font-weight:600;">TK-0023</span>
                                    <span style="font-size:0.72rem;color:rgba(255,255,255,0.5);">Pintura hall edif.</span>
                                </div>
                                <span style="font-size:0.6rem;padding:2px 8px;border-radius:10px;background:rgba(39,174,96,0.15);color:#27ae60;font-weight:600;">Resuelto</span>
                            </div>
                        </div>
                    </div>
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
