<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FacturaIA - Facturacion electronica AFIP con inteligencia artificial | Proximamente</title>
    <meta name="description" content="Facturacion electronica AFIP simplificada con IA. Emite facturas A, B, C, notas de credito y debito en segundos. Proximamente.">
    <meta property="og:title" content="FacturaIA - Proximamente">
    <meta property="og:description" content="Facturacion electronica AFIP con inteligencia artificial integrada.">
    <meta property="og:image" content="assets/logo.png">
    <meta property="og:type" content="website">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">

    <style>
        /* ===== Hero FacturaIA ===== */
        .hero-fact {
            min-height: 100vh;
            background: linear-gradient(135deg, #0c1a12 0%, #14332a 45%, #1d4e44 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding: 120px 0 60px;
        }

        .hero-fact::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 60% 50% at 20% 30%, rgba(52,211,153,0.14) 0%, transparent 60%),
                radial-gradient(ellipse 50% 60% at 80% 70%, rgba(245,158,11,0.10) 0%, transparent 60%),
                radial-gradient(ellipse 40% 40% at 85% 15%, rgba(167,139,250,0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .hero-fact::after {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
            background-size: 60px 60px;
            animation: gridMoveF 24s linear infinite;
            pointer-events: none;
        }

        @keyframes gridMoveF {
            0% { transform: translate(0,0); }
            100% { transform: translate(60px, 60px); }
        }

        .hero-fact-content { position: relative; z-index: 2; }

        .soon-badge-f {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(52,211,153,0.14);
            border: 1px solid rgba(52,211,153,0.35);
            color: #6ee7b7;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.82rem;
            font-weight: 700;
            margin-bottom: 26px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        .soon-badge-f::before {
            content: '';
            width: 8px; height: 8px;
            border-radius: 50%;
            background: #6ee7b7;
            animation: pulseF 1.8s ease-in-out infinite;
        }

        @keyframes pulseF {
            0%, 100% { opacity: 1; box-shadow: 0 0 0 0 rgba(110,231,183,0.6); }
            50% { opacity: 0.7; box-shadow: 0 0 0 8px rgba(110,231,183,0); }
        }

        .hero-fact h1 {
            color: white;
            font-size: 3.4rem;
            line-height: 1.1;
            margin-bottom: 22px;
            font-weight: 800;
        }

        .hero-fact h1 span {
            background: linear-gradient(90deg, #34d399, #fcd34d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-fact-desc {
            color: rgba(255,255,255,0.68);
            font-size: 1.18rem;
            line-height: 1.7;
            max-width: 540px;
            margin-bottom: 38px;
        }

        /* Form reutilizable */
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
            display: flex; gap: 10px; flex-wrap: wrap;
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
            border-color: #34d399;
            background: rgba(255,255,255,0.12);
        }

        .notify-btn-f {
            background: linear-gradient(135deg, #34d399 0%, #fcd34d 100%);
            color: #0c1a12;
            border: none;
            padding: 14px 26px;
            border-radius: 12px;
            font-weight: 800;
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .notify-btn-f:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(52,211,153,0.35);
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

        /* ===== Mockup factura ===== */
        .fact-mockup {
            background: white;
            border-radius: 18px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4);
            overflow: hidden;
            max-width: 420px;
            margin: 0 auto;
            position: relative;
            transform: perspective(1000px) rotateY(-6deg) rotateX(3deg);
            transition: transform 0.6s;
        }

        .fact-mockup:hover {
            transform: perspective(1000px) rotateY(-2deg) rotateX(1deg);
        }

        .fact-mockup-header {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: white;
            padding: 22px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .fact-mockup-header h5 {
            font-size: 1rem;
            margin-bottom: 4px;
            letter-spacing: 0.05em;
        }

        .fact-mockup-header .small {
            font-size: 0.72rem;
            opacity: 0.85;
        }

        .fact-type-badge {
            background: white;
            color: #047857;
            width: 52px; height: 52px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            font-weight: 900;
            font-family: var(--font-title, 'Syne', sans-serif);
        }

        .fact-mockup-body {
            padding: 22px;
        }

        .fact-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 0.82rem;
            border-bottom: 1px dashed #e5e7eb;
        }

        .fact-row:last-child { border-bottom: none; }

        .fact-row-key { color: #6b7280; }
        .fact-row-val { color: #111827; font-weight: 600; }

        .fact-total {
            margin-top: 14px;
            padding-top: 14px;
            border-top: 2px solid #10b981;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .fact-total-label {
            font-size: 0.88rem;
            color: #374151;
            font-weight: 700;
        }

        .fact-total-amount {
            font-size: 1.6rem;
            font-weight: 900;
            color: #047857;
            font-family: var(--font-title, 'Syne', sans-serif);
        }

        .fact-mockup-footer {
            background: #f9fafb;
            padding: 14px 22px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.72rem;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
        }

        .fact-mockup-footer i {
            color: #10b981;
            font-size: 1rem;
        }

        /* ===== Features ===== */
        .features-fact {
            background: #0a1a14;
            padding: 90px 0;
        }

        .features-fact-title {
            text-align: center;
            margin-bottom: 50px;
        }

        .features-fact-title h2 {
            color: white;
            font-size: 2.2rem;
            margin-bottom: 14px;
        }

        .features-fact-title h2 span {
            background: linear-gradient(90deg, #34d399, #fcd34d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .features-fact-title p { color: rgba(255,255,255,0.55); }

        .feat-grid-f {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 22px;
        }

        .feat-card-f {
            background: linear-gradient(145deg, rgba(255,255,255,0.05), rgba(255,255,255,0.015));
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            padding: 26px;
            transition: all 0.3s;
        }

        .feat-card-f:hover {
            transform: translateY(-4px);
            border-color: rgba(52,211,153,0.3);
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .feat-icon-f {
            width: 48px; height: 48px;
            border-radius: 12px;
            background: linear-gradient(135deg, #34d399 0%, #059669 100%);
            display: flex; align-items: center; justify-content: center;
            color: white;
            font-size: 1.3rem;
            margin-bottom: 16px;
        }

        .feat-card-f h4 {
            color: white;
            font-size: 1.08rem;
            margin-bottom: 8px;
        }

        .feat-card-f p {
            color: rgba(255,255,255,0.55);
            font-size: 0.88rem;
            line-height: 1.6;
            margin: 0;
        }

        /* ===== AFIP badge ===== */
        .afip-strip {
            background: linear-gradient(135deg, #14332a 0%, #1d4e44 100%);
            padding: 50px 0;
            text-align: center;
        }

        .afip-strip h3 {
            color: white;
            font-size: 1.4rem;
            margin-bottom: 26px;
        }

        .afip-badges {
            display: flex;
            gap: 14px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .afip-badge {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.12);
            color: white;
            padding: 10px 22px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .afip-badge i { color: #34d399; }

        /* ===== Final CTA ===== */
        .fact-final-cta {
            background: linear-gradient(135deg, #0c1a12 0%, #14332a 100%);
            padding: 70px 0;
            text-align: center;
        }

        .fact-final-cta h3 {
            color: white;
            font-size: 1.8rem;
            margin-bottom: 16px;
        }

        .fact-final-cta p {
            color: rgba(255,255,255,0.55);
            margin-bottom: 28px;
        }

        @media (max-width: 768px) {
            .hero-fact h1 { font-size: 2.2rem; }
            .hero-fact-desc { font-size: 1rem; }
            .fact-mockup { margin-top: 40px; transform: none; }
            .fact-mockup:hover { transform: none; }
            .features-fact-title h2 { font-size: 1.7rem; }
        }
    </style>
</head>
<body>

    <?php include 'header.php'; ?>

    <!-- ===== HERO ===== -->
    <section class="hero-fact">
        <div class="container hero-fact-content">
            <div class="grid" style="grid-template-columns: 1.1fr 1fr; gap: 60px; align-items: center;">
                <div class="reveal-left">
                    <div class="soon-badge-f">Proximamente</div>
                    <h1><span>FacturaIA</span> Facturacion electronica con inteligencia artificial</h1>
                    <p class="hero-fact-desc">
                        Emite facturas A, B, C, notas de credito y debito en segundos. Conectada directo con AFIP, con asistente IA que completa los campos por vos y envia el PDF al cliente automaticamente.
                    </p>

                    <form class="notify-form" onsubmit="notifyMe(event, 'fact')">
                        <label class="notify-form-label"><i class="bi bi-bell-fill" style="color:#34d399;"></i> Avisame cuando este disponible</label>
                        <div class="notify-form-row">
                            <input type="email" class="notify-input" name="email" placeholder="tu@email.com" required>
                            <button type="submit" class="notify-btn-f">
                                Avisame <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                        <p class="notify-form-note">Sin spam. Solo te avisamos cuando el producto este listo.</p>
                        <div class="notify-success" id="fact-success">
                            <i class="bi bi-check-circle-fill"></i> Listo! Te avisaremos apenas lancemos FacturaIA.
                        </div>
                    </form>
                </div>

                <div class="reveal-right">
                    <div class="fact-mockup">
                        <div class="fact-mockup-header">
                            <div>
                                <h5>FACTURA</h5>
                                <div class="small">N 0001-00012847</div>
                                <div class="small" style="margin-top:4px;">Fecha: 16/04/2026</div>
                            </div>
                            <div class="fact-type-badge">A</div>
                        </div>

                        <div class="fact-mockup-body">
                            <div class="fact-row">
                                <span class="fact-row-key">Cliente</span>
                                <span class="fact-row-val">Constructora del Norte S.A.</span>
                            </div>
                            <div class="fact-row">
                                <span class="fact-row-key">CUIT</span>
                                <span class="fact-row-val">30-71234567-8</span>
                            </div>
                            <div class="fact-row">
                                <span class="fact-row-key">Condicion</span>
                                <span class="fact-row-val">Responsable Inscripto</span>
                            </div>
                            <div class="fact-row">
                                <span class="fact-row-key">Servicio</span>
                                <span class="fact-row-val">Consultoria mensual</span>
                            </div>
                            <div class="fact-row">
                                <span class="fact-row-key">Neto</span>
                                <span class="fact-row-val">$ 420.000</span>
                            </div>
                            <div class="fact-row">
                                <span class="fact-row-key">IVA 21%</span>
                                <span class="fact-row-val">$ 88.200</span>
                            </div>

                            <div class="fact-total">
                                <span class="fact-total-label">TOTAL</span>
                                <span class="fact-total-amount">$ 508.200</span>
                            </div>
                        </div>

                        <div class="fact-mockup-footer">
                            <i class="bi bi-shield-check"></i>
                            <span>CAE: 74283910048572 &middot; Validada por AFIP</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== FEATURES ===== -->
    <section class="features-fact">
        <div class="container">
            <div class="features-fact-title reveal">
                <h2>Pensado para que <span>factures sin friccion</span></h2>
                <p>Menos clicks, menos errores, mas tiempo para tu negocio</p>
            </div>

            <div class="feat-grid-f">
                <div class="feat-card-f reveal">
                    <div class="feat-icon-f"><i class="bi bi-robot"></i></div>
                    <h4>Asistente IA</h4>
                    <p>Describi la factura en lenguaje natural ("3 horas de consultoria para Juan") y la IA la arma por vos.</p>
                </div>

                <div class="feat-card-f reveal">
                    <div class="feat-icon-f"><i class="bi bi-shield-check"></i></div>
                    <h4>Conexion directa AFIP</h4>
                    <p>Validacion automatica con WSFEv1. CAE en segundos sin intermediarios.</p>
                </div>

                <div class="feat-card-f reveal">
                    <div class="feat-icon-f"><i class="bi bi-file-pdf"></i></div>
                    <h4>PDF profesional</h4>
                    <p>Factura lista para imprimir o enviar. Personalizable con tu logo y datos fiscales.</p>
                </div>

                <div class="feat-card-f reveal">
                    <div class="feat-icon-f"><i class="bi bi-envelope"></i></div>
                    <h4>Envio automatico</h4>
                    <p>Manda la factura al email del cliente con un click. Con recordatorios de pago integrados.</p>
                </div>

                <div class="feat-card-f reveal">
                    <div class="feat-icon-f"><i class="bi bi-bar-chart"></i></div>
                    <h4>Reportes fiscales</h4>
                    <p>Libro IVA, ventas por periodo, exportacion a Excel y mas. Listo para tu contador.</p>
                </div>

                <div class="feat-card-f reveal">
                    <div class="feat-icon-f"><i class="bi bi-people"></i></div>
                    <h4>Multi-usuario</h4>
                    <p>Invita a tu contador o equipo con permisos granulares. Colaboracion real.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== AFIP Strip ===== -->
    <section class="afip-strip">
        <div class="container">
            <h3 class="reveal">Compatible con todos los comprobantes AFIP</h3>
            <div class="afip-badges reveal">
                <span class="afip-badge"><i class="bi bi-check-circle-fill"></i> Factura A</span>
                <span class="afip-badge"><i class="bi bi-check-circle-fill"></i> Factura B</span>
                <span class="afip-badge"><i class="bi bi-check-circle-fill"></i> Factura C</span>
                <span class="afip-badge"><i class="bi bi-check-circle-fill"></i> Nota de Credito</span>
                <span class="afip-badge"><i class="bi bi-check-circle-fill"></i> Nota de Debito</span>
                <span class="afip-badge"><i class="bi bi-check-circle-fill"></i> Recibo</span>
            </div>
        </div>
    </section>

    <!-- ===== Final CTA ===== -->
    <section class="fact-final-cta">
        <div class="container">
            <h3 class="reveal">Facturar nunca fue tan simple</h3>
            <p class="reveal">Reserva tu acceso anticipado y sumate a la lista de espera.</p>
            <a href="#" onclick="document.querySelector('.notify-input').focus();return false;" class="btn btn-primary btn-ripple reveal" style="padding:14px 32px;border-radius:50px;background:#34d399;color:#0c1a12;">
                <i class="bi bi-bell"></i> Avisame cuando este listo
            </a>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <a href="https://wa.me/5493512139046?text=Hola!%20Me%20interesa%20FacturaIA" class="floating-wa" target="_blank" rel="noopener" title="Consultanos por FacturaIA">
        <i class="bi bi-whatsapp"></i>
    </a>

    <script>
    function notifyMe(e, product) {
        e.preventDefault();
        const form = e.target;
        const email = form.querySelector('input[name=email]').value;
        const success = document.getElementById(product + '-success');

        try {
            const leads = JSON.parse(localStorage.getItem('notify_leads') || '[]');
            leads.push({ product, email, date: new Date().toISOString() });
            localStorage.setItem('notify_leads', JSON.stringify(leads));
        } catch (err) {}

        form.querySelector('.notify-form-row').style.display = 'none';
        form.querySelector('.notify-form-note').style.display = 'none';
        success.classList.add('show');
    }

    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => obs.observe(el));
    </script>

</body>
</html>
