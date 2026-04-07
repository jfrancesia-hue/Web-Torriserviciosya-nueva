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

    <!-- ===================== HERO SECTION con PARALLAX ===================== -->
    <section class="hero hero-parallax" id="home"
        style="background-image: url('assets/hero_house.png'); background-position: bottom; align-items: flex-start;">
        <div class="hero-overlay"
            style="background: linear-gradient(180deg, rgba(75, 78, 109, 0.9) 0%, rgba(75, 78, 109, 0.5) 50%, rgba(255, 255, 255, 0) 100%);">
        </div>
        <div class="container"
            style="display: flex; flex-direction: column; align-items: center; text-align: center; justify-content: flex-start; padding-top: 22vh; gap: 24px;">
            <div class="hero-content animate-in" style="max-width: 800px;">
                <h1 style="font-size: 3.8rem; margin-bottom: 1rem; line-height: 1.1; color: white; text-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                    Hace tu vida mas facil
                </h1>
                <p style="font-size: 1.35rem; color: rgba(255,255,255,0.92); margin-bottom: 2rem; text-shadow: 0 2px 10px rgba(0,0,0,0.3); font-weight: 400; max-width: 550px; margin-left: auto; margin-right: auto; line-height: 1.5;">
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

    <!-- ===================== SPONSORS ===================== -->
<section class="section" id="sponsors">
  <div class="container text-center">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Syne:wght@700;800&display=swap');

      .sponsors-title {
        font-family: 'Syne', sans-serif;
        font-size: 2.5rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 48px;
      }

      .sponsors-title span {
        background: linear-gradient(90deg, #a78bfa, #34d399);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .sponsor-card-v2 {
        border-radius: 20px;
        padding: 36px 24px 24px;
        background: linear-gradient(145deg, rgba(255,255,255,0.10) 0%, rgba(255,255,255,0.04) 100%);
        border: 1px solid rgba(255,255,255,0.12);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.3);
        cursor: pointer;
        transition: transform 0.4s cubic-bezier(.22,1,.36,1), box-shadow 0.4s;
      }

      .sponsor-card-v2:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0,0,0,0.4), 0 0 30px rgba(167,139,250,0.15);
      }

      .sponsor-icon-v2 {
        width: 72px; height: 72px;
        border-radius: 18px;
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem;
        margin: 0 auto 16px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.25);
      }

      .sponsor-badge-v2 {
        position: absolute;
        top: 14px; right: 14px;
        background: linear-gradient(90deg, #a78bfa, #6366f1);
        color: #fff;
        font-size: 0.6rem;
        font-weight: 800;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        z-index: 4;
      }

      .sponsor-name {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem;
        font-weight: 800;
        color: #fff;
        margin-bottom: 6px;
      }

      .sponsor-desc {
        color: rgba(255,255,255,0.55);
        font-size: 0.88rem;
        line-height: 1.5;
      }

      .sponsors-divider {
        width: 60px; height: 3px;
        background: linear-gradient(90deg, #a78bfa, #34d399);
        border-radius: 2px;
        margin: 0 auto 16px;
      }
    </style>

    <div class="sponsors-divider reveal"></div>
    <h2 class="sponsors-title reveal">Nuestros <span>Sponsors</span></h2>

    <div class="grid stagger-children" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 28px; position: relative; z-index: 1;">

      <div class="sponsor-card-v2 reveal" style="position:relative;">
        <span class="sponsor-badge-v2">Sponsor</span>
        <div class="sponsor-icon-v2" style="background: linear-gradient(135deg, #FF6B35, #ff9a6c); color: #fff;">🔧</div>
        <div class="sponsor-name">Ferreteria El Tornillo</div>
        <p class="sponsor-desc">Materiales y herramientas de calidad al mejor precio</p>
      </div>

      <div class="sponsor-card-v2 reveal" style="position:relative;">
        <span class="sponsor-badge-v2">Sponsor</span>
        <div class="sponsor-icon-v2" style="background: linear-gradient(135deg, #2C3E50, #4a6fa5); color: #fff;">🚗</div>
        <div class="sponsor-name">Automotores Catamarca</div>
        <p class="sponsor-desc">Financiacion inmediata, sin tramites complicados</p>
      </div>

      <div class="sponsor-card-v2 reveal" style="position:relative;">
        <span class="sponsor-badge-v2">Sponsor</span>
        <div class="sponsor-icon-v2" style="background: linear-gradient(135deg, #27AE60, #52c97e); color: #fff;">💊</div>
        <div class="sponsor-name">Farmacia Central</div>
        <p class="sponsor-desc">Medicamentos, cosmeticos y atencion personalizada</p>
      </div>

    </div>
  </div>
</section>

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
