<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toori360 - Gestion Integral de Mantenimiento para Inmobiliarias</title>
    <meta name="description" content="Plataforma B2B de gestion de mantenimiento, incidencias y servicios para inmobiliarias, consorcios y empresas. Tickets, presupuestos, reportes y mas.">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">

    <style>
        /* Hero 360 */
        .hero-360 {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0c29 0%, #1a1a3e 40%, #24243e 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 100px 0 60px;
        }

        .hero-360::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 30% 30%, rgba(59,168,224,0.12) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 70% 70%, rgba(174,205,90,0.08) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 80% 20%, rgba(135,78,153,0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Grid animado de fondo */
        .hero-360::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridMove 20s linear infinite;
            pointer-events: none;
        }

        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(60px, 60px); }
        }

        .hero-360-content {
            position: relative;
            z-index: 2;
        }

        .hero-360-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(59,168,224,0.1);
            border: 1px solid rgba(59,168,224,0.2);
            color: var(--toori-blue);
            padding: 6px 16px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 600;
            margin-bottom: 24px;
        }

        .hero-360 h1 {
            color: white;
            font-size: 3.2rem;
            line-height: 1.1;
            margin-bottom: 20px;
        }

        .hero-360 h1 span {
            background: linear-gradient(90deg, var(--toori-blue), var(--toori-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-360-desc {
            color: rgba(255,255,255,0.65);
            font-size: 1.15rem;
            line-height: 1.7;
            max-width: 520px;
            margin-bottom: 36px;
        }

        .hero-360-buttons {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn-360-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--toori-blue);
            color: white;
            padding: 16px 32px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s;
            box-shadow: 0 4px 20px rgba(59,168,224,0.3);
        }

        .btn-360-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 30px rgba(59,168,224,0.4);
            color: white;
        }

        .btn-360-secondary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: white;
            padding: 16px 32px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .btn-360-secondary:hover {
            background: rgba(255,255,255,0.15);
            color: white;
            transform: translateY(-2px);
        }

        /* Dashboard mockup */
        .dashboard-mockup {
            background: #1e1e2e;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
            overflow: hidden;
            position: relative;
        }

        .mockup-topbar {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 16px;
            background: rgba(255,255,255,0.03);
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        .mockup-dot {
            width: 10px; height: 10px;
            border-radius: 50%;
        }

        .mockup-body {
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .mockup-card {
            background: rgba(255,255,255,0.04);
            border-radius: 10px;
            padding: 16px;
            border: 1px solid rgba(255,255,255,0.06);
        }

        .mockup-card-title {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.4);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .mockup-card-value {
            font-size: 1.6rem;
            font-weight: 700;
            color: white;
            font-family: var(--font-title);
        }

        .mockup-card-sub {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.3);
            margin-top: 4px;
        }

        .mockup-list {
            grid-column: 1 / -1;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .mockup-list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 14px;
            background: rgba(255,255,255,0.03);
            border-radius: 8px;
            border: 1px solid rgba(255,255,255,0.04);
        }

        .mockup-list-left {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .mockup-ticket-id {
            font-size: 0.72rem;
            color: var(--toori-blue);
            font-weight: 600;
            font-family: monospace;
        }

        .mockup-ticket-desc {
            font-size: 0.75rem;
            color: rgba(255,255,255,0.6);
        }

        .mockup-status {
            font-size: 0.65rem;
            padding: 3px 10px;
            border-radius: 20px;
            font-weight: 600;
        }

        .mockup-status.open { background: rgba(59,168,224,0.15); color: var(--toori-blue); }
        .mockup-status.progress { background: rgba(245,158,11,0.15); color: #f59e0b; }
        .mockup-status.done { background: rgba(39,174,96,0.15); color: #27ae60; }

        /* Features */
        .features-360 {
            padding: 100px 0;
            background: var(--bg-white);
        }

        .feature-360-card {
            background: white;
            border-radius: 20px;
            padding: 36px 28px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.04);
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
        }

        .feature-360-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 40px rgba(59,168,224,0.1);
        }

        .feature-360-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .feature-360-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 10px;
            font-family: var(--font-body);
        }

        .feature-360-card p {
            color: var(--text-muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        /* Roles section */
        .roles-360 {
            padding: 100px 0;
            background: var(--bg-soft);
        }

        .role-card {
            text-align: center;
            padding: 32px 24px;
        }

        .role-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            margin: 0 auto 16px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .role-card h4 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 8px;
            font-family: var(--font-body);
        }

        .role-card p {
            color: var(--text-muted);
            font-size: 0.88rem;
            line-height: 1.5;
        }

        /* CTA */
        .cta-360 {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--toori-dark), #2d3054);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-360::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 50% 50% at 50% 50%, rgba(59,168,224,0.1) 0%, transparent 60%);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero-360-grid {
                grid-template-columns: 1fr !important;
                text-align: center;
            }
            .hero-360 h1 { font-size: 2.2rem; }
            .hero-360-desc { margin: 0 auto 36px; }
            .hero-360-buttons { justify-content: center; }
            .dashboard-mockup { margin-top: 40px; }
        }

        @media (max-width: 768px) {
            .hero-360 { padding: 90px 0 50px; min-height: auto; }
            .hero-360 h1 { font-size: 1.8rem; }
            .features-360, .roles-360, .cta-360 { padding: 60px 0; }
            .mockup-body { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<!-- ===================== HERO TOORI360 ===================== -->
<section class="hero-360">
    <div class="container">
        <div class="grid hero-360-grid" style="grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">

            <div class="hero-360-content">
                <div class="hero-360-badge">
                    <i class="bi bi-building"></i> Plataforma B2B
                </div>
                <h1>Gestion de mantenimiento <span>360 grados</span></h1>
                <p class="hero-360-desc">
                    El sistema operativo para inmobiliarias, consorcios y empresas que necesitan orden, trazabilidad y control total sobre sus propiedades y servicios.
                </p>
                <div class="hero-360-buttons">
                    <a href="https://wa.me/5493512139046?text=Hola!%20Quiero%20una%20demo%20de%20Toori360" target="_blank" class="btn-360-primary">
                        <i class="bi bi-play-circle"></i> Solicitar demo
                    </a>
                    <a href="#features" class="btn-360-secondary">
                        <i class="bi bi-grid"></i> Ver funcionalidades
                    </a>
                </div>
            </div>

            <!-- Dashboard Mockup -->
            <div class="reveal-right">
                <div class="dashboard-mockup">
                    <div class="mockup-topbar">
                        <div class="mockup-dot" style="background:#ff5f57;"></div>
                        <div class="mockup-dot" style="background:#ffbd2e;"></div>
                        <div class="mockup-dot" style="background:#28ca41;"></div>
                        <span style="color:rgba(255,255,255,0.3);font-size:0.72rem;margin-left:12px;">toori360.app/dashboard</span>
                    </div>
                    <div class="mockup-body">
                        <div class="mockup-card">
                            <div class="mockup-card-title">Tickets abiertos</div>
                            <div class="mockup-card-value" style="color:var(--toori-blue);">24</div>
                            <div class="mockup-card-sub">+3 hoy</div>
                        </div>
                        <div class="mockup-card">
                            <div class="mockup-card-title">Resueltos este mes</div>
                            <div class="mockup-card-value" style="color:var(--toori-green);">87</div>
                            <div class="mockup-card-sub">96% satisfaccion</div>
                        </div>
                        <div class="mockup-card">
                            <div class="mockup-card-title">Propiedades</div>
                            <div class="mockup-card-value">156</div>
                            <div class="mockup-card-sub">12 edificios</div>
                        </div>
                        <div class="mockup-card">
                            <div class="mockup-card-title">Presupuestos</div>
                            <div class="mockup-card-value" style="color:#f59e0b;">8</div>
                            <div class="mockup-card-sub">pendientes aprobacion</div>
                        </div>
                        <div class="mockup-list">
                            <div class="mockup-list-item">
                                <div class="mockup-list-left">
                                    <span class="mockup-ticket-id">TK-202604-0024</span>
                                    <span class="mockup-ticket-desc">Fuga de agua en 3ro B</span>
                                </div>
                                <span class="mockup-status open">Abierto</span>
                            </div>
                            <div class="mockup-list-item">
                                <div class="mockup-list-left">
                                    <span class="mockup-ticket-id">TK-202604-0023</span>
                                    <span class="mockup-ticket-desc">Pintura hall edificio</span>
                                </div>
                                <span class="mockup-status progress">En curso</span>
                            </div>
                            <div class="mockup-list-item">
                                <div class="mockup-list-left">
                                    <span class="mockup-ticket-id">TK-202604-0022</span>
                                    <span class="mockup-ticket-desc">Reparacion ascensor</span>
                                </div>
                                <span class="mockup-status done">Resuelto</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ===================== FEATURES ===================== -->
<section class="features-360" id="features">
    <div class="container text-center">
        <h2 class="section-title reveal">Todo lo que necesitas en un solo lugar</h2>
        <p class="section-subtitle reveal">Funcionalidades diseñadas para simplificar la gestion de propiedades</p>

        <div class="grid stagger-children" style="grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 24px;">

            <div class="feature-360-card reveal">
                <div class="feature-360-icon" style="background:rgba(59,168,224,0.1);color:var(--toori-blue);">
                    <i class="bi bi-ticket-detailed"></i>
                </div>
                <h3>Sistema de Tickets</h3>
                <p>Crea, asigna y rastrea incidencias con estados, prioridades, timeline de eventos y notificaciones en tiempo real.</p>
            </div>

            <div class="feature-360-card reveal">
                <div class="feature-360-icon" style="background:rgba(174,205,90,0.1);color:var(--toori-green);">
                    <i class="bi bi-building"></i>
                </div>
                <h3>Propiedades</h3>
                <p>Gestiona edificios, unidades, areas comunes. Asocia tickets e inquilinos a cada propiedad con historial completo.</p>
            </div>

            <div class="feature-360-card reveal">
                <div class="feature-360-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b;">
                    <i class="bi bi-calculator"></i>
                </div>
                <h3>Presupuestos</h3>
                <p>Solicita, compara y aprueba presupuestos de proveedores. Coordina visitas tecnicas y evidencias fotograficas.</p>
            </div>

            <div class="feature-360-card reveal">
                <div class="feature-360-icon" style="background:rgba(135,78,153,0.1);color:var(--toori-purple);">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h3>Reportes</h3>
                <p>Dashboards con metricas clave: tiempos de resolucion, costos por propiedad, rendimiento de proveedores.</p>
            </div>

            <div class="feature-360-card reveal">
                <div class="feature-360-icon" style="background:rgba(37,211,102,0.1);color:#25d366;">
                    <i class="bi bi-whatsapp"></i>
                </div>
                <h3>WhatsApp + IA</h3>
                <p>Los inquilinos reportan incidencias por WhatsApp. La IA clasifica, prioriza y genera tickets automaticamente.</p>
            </div>

            <div class="feature-360-card reveal">
                <div class="feature-360-icon" style="background:rgba(239,68,68,0.1);color:#ef4444;">
                    <i class="bi bi-calendar-event"></i>
                </div>
                <h3>Calendario</h3>
                <p>Vista de calendario con visitas programadas, mantenimientos preventivos y vencimientos de contratos.</p>
            </div>

        </div>
    </div>
</section>

<!-- ===================== ROLES ===================== -->
<section class="roles-360">
    <div class="container text-center">
        <h2 class="section-title reveal">Diseñado para cada rol</h2>
        <p class="section-subtitle reveal">Cada usuario ve exactamente lo que necesita</p>

        <div class="grid stagger-children" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 24px;">

            <div class="role-card reveal">
                <div class="role-icon" style="background:rgba(59,168,224,0.1);color:var(--toori-blue);">
                    <i class="bi bi-shield-lock"></i>
                </div>
                <h4>Administrador</h4>
                <p>Control total del sistema, usuarios, propiedades y configuracion</p>
            </div>

            <div class="role-card reveal">
                <div class="role-icon" style="background:rgba(174,205,90,0.1);color:var(--toori-green);">
                    <i class="bi bi-headset"></i>
                </div>
                <h4>Operador</h4>
                <p>Gestiona tickets, asigna proveedores y coordina servicios</p>
            </div>

            <div class="role-card reveal">
                <div class="role-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b;">
                    <i class="bi bi-eye"></i>
                </div>
                <h4>Supervisor</h4>
                <p>Monitorea metricas, aprueba presupuestos y supervisa calidad</p>
            </div>

            <div class="role-card reveal">
                <div class="role-icon" style="background:rgba(135,78,153,0.1);color:var(--toori-purple);">
                    <i class="bi bi-person"></i>
                </div>
                <h4>Inquilino</h4>
                <p>Reporta incidencias por WhatsApp o portal y sigue el estado</p>
            </div>

            <div class="role-card reveal">
                <div class="role-icon" style="background:rgba(239,68,68,0.1);color:#ef4444;">
                    <i class="bi bi-tools"></i>
                </div>
                <h4>Proveedor</h4>
                <p>Recibe asignaciones, sube presupuestos y registra trabajos</p>
            </div>

        </div>
    </div>
</section>

<!-- ===================== CTA ===================== -->
<section class="cta-360">
    <div class="container" style="position:relative;z-index:2;">
        <h2 class="reveal" style="color:white;font-size:2.2rem;margin-bottom:16px;">Lleva tu gestion al siguiente nivel</h2>
        <p class="reveal" style="color:rgba(255,255,255,0.6);font-size:1.1rem;max-width:500px;margin:0 auto 36px;line-height:1.6;">
            Unite a las inmobiliarias y empresas que ya gestionan sus propiedades con Toori360.
        </p>
        <div class="reveal" style="display:flex;gap:14px;justify-content:center;flex-wrap:wrap;">
            <a href="https://wa.me/5493512139046?text=Hola!%20Quiero%20una%20demo%20de%20Toori360" target="_blank" class="btn-360-primary">
                <i class="bi bi-whatsapp"></i> Agendar demo gratuita
            </a>
            <a href="./" class="btn-360-secondary">
                <i class="bi bi-arrow-left"></i> Volver a ServiciosYa
            </a>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- Floating WhatsApp -->
<a href="https://wa.me/5493512139046?text=Hola!%20Quiero%20info%20sobre%20Toori360" class="floating-wa" target="_blank" rel="noopener noreferrer">
    <i class="bi bi-whatsapp"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scroll reveal -->
<script>
(function() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add('visible');
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => observer.observe(el));
    });
})();
</script>

</body>
</html>
