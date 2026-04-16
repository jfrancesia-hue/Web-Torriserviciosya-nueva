<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toori CRM - Gestion integral de clientes y ventas | Proximamente</title>
    <meta name="description" content="CRM inteligente para gestionar clientes, oportunidades, ventas y equipo. Integrado con todo el ecosistema Toori. Proximamente.">
    <meta property="og:title" content="Toori CRM - Proximamente">
    <meta property="og:description" content="CRM inteligente para gestionar clientes, ventas y equipo comercial.">
    <meta property="og:image" content="assets/logo.png">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">

    <style>
        /* ===== Hero CRM ===== */
        .hero-crm {
            min-height: 100vh;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f4a 40%, #24304e 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 120px 0 60px;
        }

        .hero-crm::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 25% 30%, rgba(59,168,224,0.14) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 75% 70%, rgba(174,205,90,0.10) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 85% 15%, rgba(99,102,241,0.10) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-crm::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridMoveCRM 22s linear infinite;
            pointer-events: none;
        }

        @keyframes gridMoveCRM {
            0% { transform: translate(0, 0); }
            100% { transform: translate(60px, 60px); }
        }

        .hero-crm-content {
            position: relative;
            z-index: 2;
        }

        .soon-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(99,102,241,0.14);
            border: 1px solid rgba(99,102,241,0.35);
            color: #a5b4fc;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 26px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .soon-badge::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #a5b4fc;
            animation: pulseBadge 1.8s ease-in-out infinite;
        }

        @keyframes pulseBadge {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(165,180,252,0.6); }
            50% { opacity: 0.7; box-shadow: 0 0 0 8px rgba(165,180,252,0); }
        }

        .hero-crm h1 {
            color: white;
            font-size: 3.4rem;
            line-height: 1.1;
            margin-bottom: 22px;
            font-weight: 800;
        }

        .hero-crm h1 span {
            background: linear-gradient(90deg, #3ba8e0, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-crm-desc {
            color: rgba(255,255,255,0.68);
            font-size: 1.18rem;
            line-height: 1.7;
            max-width: 540px;
            margin-bottom: 38px;
        }

        /* ===== Form captura email ===== */
        .notify-form {
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 16px;
            padding: 22px;
            max-width: 520px;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .notify-form-label {
            color: rgba(255,255,255,0.85);
            font-size: 0.92rem;
            font-weight: 600;
            margin-bottom: 12px;
            display: block;
        }

        .notify-form-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .notify-input {
            flex: 1;
            min-width: 200px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 0.95rem;
            outline: none;
            transition: all 0.3s;
        }

        .notify-input::placeholder { color: rgba(255,255,255,0.45); }

        .notify-input:focus {
            border-color: #818cf8;
            background: rgba(255,255,255,0.12);
        }

        .notify-btn {
            background: linear-gradient(135deg, #3ba8e0 0%, #818cf8 100%);
            color: white;
            border: none;
            padding: 14px 26px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .notify-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(129,140,248,0.35);
        }

        .notify-form-note {
            color: rgba(255,255,255,0.45);
            font-size: 0.78rem;
            margin-top: 12px;
        }

        .notify-success {
            display: none;
            background: rgba(52,211,153,0.12);
            border: 1px solid rgba(52,211,153,0.4);
            color: #6ee7b7;
            padding: 14px 18px;
            border-radius: 12px;
            font-size: 0.92rem;
            margin-top: 14px;
        }

        .notify-success.show { display: block; }

        /* ===== Mockup dashboard ===== */
        .crm-mockup {
            background: #10152c;
            border-radius: 18px;
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 25px 60px rgba(0,0,0,0.5);
            overflow: hidden;
            max-width: 460px;
            margin: 0 auto;
        }

        .crm-mockup-bar {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 12px 16px;
            background: rgba(255,255,255,0.02);
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .crm-mockup-bar .dot {
            width: 9px; height: 9px; border-radius: 50%;
        }

        .crm-mockup-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .crm-stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .crm-stat {
            background: rgba(255,255,255,0.03);
            border-radius: 10px;
            padding: 14px;
            text-align: center;
        }

        .crm-stat-num {
            font-size: 1.3rem;
            font-weight: 800;
            font-family: var(--font-title, 'Syne', sans-serif);
        }

        .crm-stat-label {
            font-size: 0.6rem;
            color: rgba(255,255,255,0.4);
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin-top: 3px;
        }

        .crm-lead {
            background: rgba(255,255,255,0.03);
            border-radius: 10px;
            padding: 12px 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .crm-lead-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: linear-gradient(135deg, #3ba8e0, #818cf8);
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 0.82rem;
            flex-shrink: 0;
        }

        .crm-lead-info {
            flex: 1;
            overflow: hidden;
        }

        .crm-lead-name {
            color: white;
            font-size: 0.82rem;
            font-weight: 600;
        }

        .crm-lead-meta {
            color: rgba(255,255,255,0.4);
            font-size: 0.68rem;
        }

        .crm-lead-tag {
            font-size: 0.6rem;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 700;
        }

        .tag-hot { background: rgba(239,68,68,0.15); color: #fca5a5; }
        .tag-warm { background: rgba(245,158,11,0.15); color: #fcd34d; }
        .tag-cold { background: rgba(59,168,224,0.15); color: #7dd3fc; }

        /* ===== Features ===== */
        .features-crm {
            background: #0f1120;
            padding: 90px 0;
        }

        .features-crm .container { position: relative; z-index: 2; }

        .features-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .features-title h2 {
            color: white;
            font-size: 2.2rem;
            margin-bottom: 14px;
        }

        .features-title h2 span {
            background: linear-gradient(90deg, #3ba8e0, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .features-title p { color: rgba(255,255,255,0.55); }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px;
        }

        .feature-card {
            background: linear-gradient(145deg, rgba(255,255,255,0.05), rgba(255,255,255,0.015));
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 26px;
            transition: all 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(129,140,248,0.3);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .feature-icon {
            width: 48px; height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #3ba8e0, #818cf8);
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .feature-card h4 {
            color: white;
            font-size: 1.08rem;
            margin-bottom: 8px;
        }

        .feature-card p {
            color: rgba(255,255,255,0.55);
            font-size: 0.88rem;
            line-height: 1.6;
            margin: 0;
        }

        /* ===== CTA Footer ===== */
        .crm-final-cta {
            background: linear-gradient(135deg, #0a0e27 0%, #1a1f4a 100%);
            padding: 70px 0;
            text-align: center;
        }

        .crm-final-cta h3 {
            color: white;
            font-size: 1.8rem;
            margin-bottom: 16px;
        }

        .crm-final-cta p {
            color: rgba(255,255,255,0.55);
            margin-bottom: 28px;
        }

        @media (max-width: 768px) {
            .hero-crm h1 { font-size: 2.2rem; }
            .hero-crm-desc { font-size: 1rem; }
            .features-title h2 { font-size: 1.7rem; }
            .crm-mockup { margin-top: 40px; }
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <!-- ===== HERO ===== -->
    <section class="hero-crm">
        <div class="container hero-crm-content">
            <div class="grid" style="grid-template-columns: 1.1fr 1fr; gap: 60px; align-items: center;">
                <div class="reveal-left">
                    <div class="soon-badge">Proximamente</div>
                    <h1>El <span>CRM inteligente</span> de Toori</h1>
                    <p class="hero-crm-desc">
                        Gestiona tus clientes, oportunidades y equipo comercial en un solo lugar. Pipeline visual, seguimiento automatico, integracion con WhatsApp y reportes en tiempo real. Estamos afinando los ultimos detalles.
                    </p>

                    <form class="notify-form" onsubmit="notifyMe(event, 'crm')">
                        <label class="notify-form-label"><i class="bi bi-bell-fill" style="color:#818cf8;"></i> Avisame cuando este disponible</label>
                        <div class="notify-form-row">
                            <input type="email" class="notify-input" name="email" placeholder="tu@email.com" required>
                            <button type="submit" class="notify-btn">
                                Avisame <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                        <p class="notify-form-note">Sin spam. Solo te avisamos cuando el producto este listo.</p>
                        <div class="notify-success" id="crm-success">
                            <i class="bi bi-check-circle-fill"></i> Listo! Te avisaremos apenas lancemos Toori CRM.
                        </div>
                    </form>
                </div>

                <div class="reveal-right">
                    <div class="crm-mockup">
                        <div class="crm-mockup-bar">
                            <span class="dot" style="background:#ff5f57;"></span>
                            <span class="dot" style="background:#ffbd2e;"></span>
                            <span class="dot" style="background:#28ca41;"></span>
                            <span style="margin-left:12px;font-size:0.72rem;color:rgba(255,255,255,0.4);">toori.crm/dashboard</span>
                        </div>
                        <div class="crm-mockup-body">
                            <div class="crm-stats-row">
                                <div class="crm-stat">
                                    <div class="crm-stat-num" style="color:#7dd3fc;">142</div>
                                    <div class="crm-stat-label">Leads</div>
                                </div>
                                <div class="crm-stat">
                                    <div class="crm-stat-num" style="color:#6ee7b7;">38</div>
                                    <div class="crm-stat-label">Cerrados</div>
                                </div>
                                <div class="crm-stat">
                                    <div class="crm-stat-num" style="color:#fcd34d;">$2.4M</div>
                                    <div class="crm-stat-label">Pipeline</div>
                                </div>
                            </div>

                            <div class="crm-lead">
                                <div class="crm-lead-avatar">MR</div>
                                <div class="crm-lead-info">
                                    <div class="crm-lead-name">Maria Rodriguez</div>
                                    <div class="crm-lead-meta">Consorcio Belgrano &middot; hace 5 min</div>
                                </div>
                                <span class="crm-lead-tag tag-hot">Caliente</span>
                            </div>

                            <div class="crm-lead">
                                <div class="crm-lead-avatar">JP</div>
                                <div class="crm-lead-info">
                                    <div class="crm-lead-name">Juan Perez</div>
                                    <div class="crm-lead-meta">Inmobiliaria Centro &middot; hace 2h</div>
                                </div>
                                <span class="crm-lead-tag tag-warm">Tibio</span>
                            </div>

                            <div class="crm-lead">
                                <div class="crm-lead-avatar">AL</div>
                                <div class="crm-lead-info">
                                    <div class="crm-lead-name">Ana Lopez</div>
                                    <div class="crm-lead-meta">Administracion Sur &middot; ayer</div>
                                </div>
                                <span class="crm-lead-tag tag-cold">Frio</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FEATURES ===== -->
    <section class="features-crm">
        <div class="container">
            <div class="features-title reveal">
                <h2>Pensado para <span>equipos comerciales</span> modernos</h2>
                <p>Todo lo que necesitas para vender mas y mejor</p>
            </div>

            <div class="feature-grid">
                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="bi bi-kanban"></i></div>
                    <h4>Pipeline visual</h4>
                    <p>Arrastra y solta tus oportunidades entre etapas. Vista Kanban clara para todo el equipo.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="bi bi-whatsapp"></i></div>
                    <h4>WhatsApp integrado</h4>
                    <p>Chatea con clientes sin salir del CRM. Historial completo por contacto y auto-asignacion.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="bi bi-graph-up-arrow"></i></div>
                    <h4>Reportes en vivo</h4>
                    <p>Dashboards de ventas, conversion y performance del equipo actualizados en tiempo real.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="bi bi-robot"></i></div>
                    <h4>Automatizaciones</h4>
                    <p>Tareas recurrentes, recordatorios y seguimientos automaticos. Menos trabajo manual.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="bi bi-people-fill"></i></div>
                    <h4>Gestion de equipo</h4>
                    <p>Roles, permisos y metricas por vendedor. Asignacion inteligente de leads.</p>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-icon"><i class="bi bi-arrow-repeat"></i></div>
                    <h4>Integrado con Toori</h4>
                    <p>Se conecta con Toori360, FacturaIA y el ecosistema para datos sincronizados.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== Final CTA ===== -->
    <section class="crm-final-cta">
        <div class="container">
            <h3 class="reveal">Se el primero en probarlo</h3>
            <p class="reveal">Estamos trabajando para lanzar Toori CRM muy pronto. Reserva tu acceso anticipado.</p>
            <a href="#" onclick="document.querySelector('.notify-input').focus();return false;" class="btn btn-primary btn-ripple reveal" style="padding:14px 32px;border-radius:50px;">
                <i class="bi bi-bell"></i> Avisame cuando este listo
            </a>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <a href="https://wa.me/5493512139046?text=Hola!%20Me%20interesa%20Toori%20CRM" class="floating-wa" target="_blank" rel="noopener" title="Consultanos por CRM">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script>
    function notifyMe(e, product) {
        e.preventDefault();
        const form = e.target;
        const email = form.querySelector('input[name=email]').value;
        const success = document.getElementById(product + '-success');

        // TODO: integrar con Supabase/Mailchimp cuando este listo
        // Por ahora solo guardamos localmente para no perder leads
        try {
            const leads = JSON.parse(localStorage.getItem('notify_leads') || '[]');
            leads.push({ product, email, date: new Date().toISOString() });
            localStorage.setItem('notify_leads', JSON.stringify(leads));
        } catch (err) {}

        form.querySelector('.notify-form-row').style.display = 'none';
        form.querySelector('.notify-form-note').style.display = 'none';
        success.classList.add('show');
    }

    // Scroll reveal
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => obs.observe(el));
    </script>

</body>
</html>
