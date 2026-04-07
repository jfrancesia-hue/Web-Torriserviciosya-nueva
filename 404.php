<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina no encontrada - Toori ServiciosYa</title>
    <link rel="icon" type="image/png" href="assets/logo.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" crossorigin href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="./assets/toori-enhanced.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: linear-gradient(135deg, #f0f4ff 0%, #f8fafc 50%, #eef9f0 100%);
        }

        .error-page {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            text-align: center;
        }

        .error-content {
            max-width: 500px;
        }

        .error-animation {
            position: relative;
            width: 200px;
            height: 200px;
            margin: 0 auto 32px;
        }

        .error-circle {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(59,168,224,0.1), rgba(174,205,90,0.1));
            display: flex;
            align-items: center;
            justify-content: center;
            animation: float404 3s ease-in-out infinite;
        }

        @keyframes float404 {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-16px); }
        }

        .error-number {
            font-family: var(--font-title);
            font-size: 5rem;
            background: linear-gradient(135deg, var(--toori-blue), var(--toori-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
        }

        .error-icon {
            position: absolute;
            font-size: 1.5rem;
            animation: orbit 4s linear infinite;
        }

        .error-icon:nth-child(2) {
            top: 10px; right: 10px;
            color: var(--toori-blue);
            animation-delay: 0s;
        }

        .error-icon:nth-child(3) {
            bottom: 20px; left: 5px;
            color: var(--toori-green);
            animation-delay: -1.3s;
        }

        .error-icon:nth-child(4) {
            top: 40px; left: 0;
            color: var(--toori-purple);
            animation-delay: -2.6s;
        }

        @keyframes orbit {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            25% { transform: translateY(-8px) rotate(10deg); }
            50% { transform: translateY(0) rotate(0deg); }
            75% { transform: translateY(8px) rotate(-10deg); }
        }

        .error-title {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 12px;
        }

        .error-desc {
            color: var(--text-muted);
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 32px;
        }

        .error-buttons {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .error-buttons .btn {
            padding: 14px 28px;
            border-radius: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="error-page">
    <div class="error-content">
        <div class="error-animation">
            <div class="error-circle">
                <div class="error-number">404</div>
            </div>
            <i class="bi bi-wrench error-icon"></i>
            <i class="bi bi-lightbulb error-icon"></i>
            <i class="bi bi-brush error-icon"></i>
        </div>

        <h1 class="error-title">Esta pagina no existe</h1>
        <p class="error-desc">Parece que la pagina que buscas fue movida, eliminada o nunca existio. Pero no te preocupes, podemos ayudarte a encontrar lo que necesitas.</p>

        <div class="error-buttons">
            <a href="./" class="btn btn-primary btn-ripple">
                <i class="bi bi-house me-2"></i> Ir al inicio
            </a>
            <a href="categorias.php" class="btn btn-secondary btn-ripple">
                <i class="bi bi-grid me-2"></i> Ver servicios
            </a>
            <a href="https://wa.me/5493512139046" target="_blank" class="btn" style="background:rgba(37,211,102,0.1);color:#25d366;border:2px solid rgba(37,211,102,0.2);">
                <i class="bi bi-whatsapp me-2"></i> Contactar
            </a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
