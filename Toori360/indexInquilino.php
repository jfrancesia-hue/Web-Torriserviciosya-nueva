<?php
session_start();

if (!isset($_SESSION['inquilino_id'])) {
    header('Location: pages/login.php');
    exit;
}

require_once __DIR__ . '/includes/conexion.php';

$inquilino_id       = $_SESSION['inquilino_id'];
$inquilino_nombre   = $_SESSION['inquilino_nombre'] ?? 'Inquilino';
$propiedad_id       = $_SESSION['inquilino_propiedad_id'] ?? null;

// --- Cargar datos del inquilino y propiedad ---
$inquilino = null;
$propiedad = null;
if ($propiedad_id) {
    $stmt = $pdo->prepare('SELECT * FROM inquilinos WHERE id = ?');
    $stmt->execute([$inquilino_id]);
    $inquilino = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $pdo->prepare('SELECT * FROM propiedades WHERE id = ?');
    $stmt2->execute([$propiedad_id]);
    $propiedad = $stmt2->fetch(PDO::FETCH_ASSOC);
}

// --- Enviar solicitud de mantenimiento ---
$mant_success = '';
$mant_error   = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['solicitar_mantenimiento'])) {
    $titulo      = trim($_POST['mant_titulo'] ?? '');
    $descripcion = trim($_POST['mant_descripcion'] ?? '');
    $prioridad   = $_POST['mant_prioridad'] ?? 'media';
    if ($titulo && $descripcion) {
        try {
            $stmt = $pdo->prepare('INSERT INTO mantenimientos (propiedad_id, inquilino_id, titulo, descripcion, prioridad, estado, created_at) VALUES (?, ?, ?, ?, ?, "pendiente", NOW())');
            $stmt->execute([$propiedad_id, $inquilino_id, $titulo, $descripcion, $prioridad]);
            $mant_success = '¡Solicitud enviada correctamente!';
        } catch (PDOException $e) {
            $mant_error = 'Error al enviar: ' . $e->getMessage();
        }
    } else {
        $mant_error = 'Completá el título y la descripción.';
    }
}

// --- Enviar comentario de mejora ---
$com_success = '';
$com_error   = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enviar_comentario'])) {
    $comentario = trim($_POST['comentario'] ?? '');
    if ($comentario) {
        try {
            $stmt = $pdo->prepare('INSERT INTO comentarios_mejoras (propiedad_id, inquilino_id, comentario, created_at) VALUES (?, ?, ?, NOW())');
            $stmt->execute([$propiedad_id, $inquilino_id, $comentario]);
            $com_success = '¡Comentario enviado!';
        } catch (PDOException $e) {
            $com_error = 'Error: ' . $e->getMessage();
        }
    } else {
        $com_error = 'Escribí un comentario antes de enviar.';
    }
}

// --- Obtener propietario para contacto ---
$propietario = null;
if ($propiedad) {
    $stmt = $pdo->prepare('SELECT nombre, apellido, email, telefono FROM propietarios WHERE id = ?');
    $stmt->execute([$propiedad['propietario_id'] ?? 0]);
    $propietario = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Portal | Toori360</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --blue:       #4AADD3;
            --blue-dark:  #0056A6;
            --green:      #a8cb60;
            --green-dark: #7aab1e;
            --bg:         #f0f6fb;
            --white:      #ffffff;
            --text:       #1a2b3c;
            --text-soft:  #5a7080;
            --border:     #d4e4f0;
            --card-shadow: 0 4px 24px rgba(0,86,166,0.10);
            --radius:     16px;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        /* ── HEADER ── */
        .header {
            background: linear-gradient(135deg, var(--blue-dark) 0%, var(--blue) 60%, var(--green) 100%);
            background-size: 200% 200%;
            animation: gradMove 6s ease-in-out infinite;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 16px rgba(0,86,166,0.18);
        }
        @keyframes gradMove {
            0%   { background-position: 0% 50%; }
            50%  { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        .header-logo {
            font-size: 1.4rem;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1px;
        }
        .header-user {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
        }
        .header-user .avatar {
            width: 38px; height: 38px;
            border-radius: 50%;
            background: rgba(255,255,255,0.25);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; font-size: 1rem;
        }
        .btn-logout {
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.35);
            color: #fff;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s;
        }
        .btn-logout:hover { background: rgba(255,255,255,0.32); }

        /* ── LAYOUT ── */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 2rem 1.5rem 4rem;
        }

        /* ── WELCOME ── */
        .welcome-banner {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue) 60%, var(--green));
            background-size: 200% 200%;
            animation: gradMove 6s ease-in-out infinite;
            border-radius: var(--radius);
            padding: 2rem 2.5rem;
            color: #fff;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .welcome-banner h1 { font-size: 1.8rem; font-weight: 800; }
        .welcome-banner p  { font-size: 1rem; opacity: 0.88; margin-top: 4px; }
        .badge-estado {
            background: rgba(255,255,255,0.2);
            border: 1px solid rgba(255,255,255,0.4);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            backdrop-filter: blur(4px);
        }

        /* ── GRID ── */
        .grid-2 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }

        /* ── CARD ── */
        .card {
            background: var(--white);
            border-radius: var(--radius);
            box-shadow: var(--card-shadow);
            border: 1px solid var(--border);
            overflow: hidden;
        }
        .card-header {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .card-header .icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem;
        }
        .icon-blue  { background: rgba(74,173,211,0.12); color: var(--blue-dark); }
        .icon-green { background: rgba(168,203,96,0.15); color: var(--green-dark); }
        .icon-orange{ background: rgba(255,160,50,0.12); color: #d4820a; }
        .icon-purple{ background: rgba(130,90,220,0.12); color: #6b3fa0; }

        .card-header h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--text);
        }
        .card-body { padding: 1.5rem; }

        /* ── INFO ROWS ── */
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 10px 0;
            border-bottom: 1px solid #eef4f9;
            gap: 1rem;
        }
        .info-row:last-child { border-bottom: none; }
        .info-label {
            font-size: 0.82rem;
            color: var(--text-soft);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            white-space: nowrap;
        }
        .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--text);
            text-align: right;
        }

        /* ── FORM ELEMENTS ── */
        .form-group { margin-bottom: 1rem; }
        .form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--text-soft);
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: inherit;
            background: #f7fafd;
            color: var(--text);
            transition: border 0.2s, box-shadow 0.2s;
        }
        .form-control:focus {
            outline: none;
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(74,173,211,0.15);
            background: #fff;
        }
        textarea.form-control { resize: vertical; min-height: 90px; }
        select.form-control { cursor: pointer; }

        .btn-primary {
            background: linear-gradient(135deg, var(--blue-dark), var(--blue) 60%, var(--green));
            background-size: 200% 200%;
            animation: gradMove 6s ease-in-out infinite;
            color: #fff;
            border: none;
            padding: 11px 24px;
            border-radius: 10px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: opacity 0.2s, transform 0.15s;
            font-family: inherit;
        }
        .btn-primary:hover { opacity: 0.9; transform: translateY(-1px); }

        /* ── ALERT ── */
        .alert {
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .alert-success { background: #e6f9ec; color: #1a7a3a; border: 1px solid #a8e6ba; }
        .alert-error   { background: #fdecea; color: #b71c1c; border: 1px solid #f5c0bc; }

        /* ── CONTACTO ── */
        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 0;
            border-bottom: 1px solid #eef4f9;
        }
        .contact-item:last-child { border-bottom: none; }
        .contact-icon {
            width: 38px; height: 38px;
            border-radius: 10px;
            background: rgba(74,173,211,0.1);
            display: flex; align-items: center; justify-content: center;
            color: var(--blue-dark);
            font-size: 1rem;
            flex-shrink: 0;
        }
        .contact-label { font-size: 0.78rem; color: var(--text-soft); font-weight: 600; }
        .contact-value { font-size: 0.95rem; font-weight: 600; color: var(--text); }
        .contact-link  { color: var(--blue-dark); text-decoration: none; }
        .contact-link:hover { text-decoration: underline; }

        /* ── ESTADO BADGE ── */
        .estado-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
        }
        .estado-activo   { background: #e6f9ec; color: #1a7a3a; }
        .estado-pendiente{ background: #fff8e1; color: #b08000; }
        .estado-expulsado{ background: #fdecea; color: #b71c1c; }

        /* ── RESPONSIVE ── */
        @media (max-width: 600px) {
            .welcome-banner { padding: 1.5rem; }
            .welcome-banner h1 { font-size: 1.4rem; }
            .container { padding: 1rem 1rem 3rem; }
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="header">
    <div class="header-logo">🏠 Toori360</div>
    <div class="header-user">
        <div class="avatar"><?= strtoupper(substr($inquilino_nombre, 0, 1)) ?></div>
        <span style="font-weight:600;"><?= htmlspecialchars($inquilino_nombre) ?></span>
        <a href="pages/logout.php" class="btn-logout"><i class="fa fa-sign-out-alt"></i> Salir</a>
    </div>
</header>

<div class="container">

    <!-- WELCOME -->
    <div class="welcome-banner">
        <div>
            <h1>¡Hola, <?= htmlspecialchars(explode(' ', $inquilino_nombre)[0]) ?>! 👋</h1>
            <p>Este es tu portal de inquilino. Gestioná todo desde acá.</p>
        </div>
        <?php if ($inquilino): ?>
        <div class="badge-estado">
            Estado:
            <span class="estado-badge estado-<?= $inquilino['estado'] ?>">
                <?= ucfirst($inquilino['estado']) ?>
            </span>
        </div>
        <?php endif; ?>
    </div>

    <!-- FILA 1: Propiedad + Contacto -->
    <div class="grid-2">

        <!-- DATOS DE LA PROPIEDAD -->
        <div class="card">
            <div class="card-header">
                <div class="icon icon-blue"><i class="fa fa-building"></i></div>
                <h3>Mi Propiedad</h3>
            </div>
            <div class="card-body">
                <?php if ($propiedad): ?>
                    <div class="info-row">
                        <span class="info-label">Propiedad</span>
                        <span class="info-value"><?= htmlspecialchars($propiedad['nombre'] ?? 'Propiedad #' . $propiedad_id) ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Dirección</span>
                        <span class="info-value"><?= htmlspecialchars($propiedad['direccion'] ?? '—') ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Tipo</span>
                        <span class="info-value"><?= htmlspecialchars($propiedad['tipo'] ?? '—') ?></span>
                    </div>
                    <?php if (!empty($propiedad['precio_alquiler'])): ?>
                    <div class="info-row">
                        <span class="info-label">Alquiler</span>
                        <span class="info-value">$<?= number_format($propiedad['precio_alquiler'], 0, ',', '.') ?></span>
                    </div>
                    <?php endif; ?>
                    <?php if ($inquilino && $inquilino['fecha_entrada']): ?>
                    <div class="info-row">
                        <span class="info-label">Fecha entrada</span>
                        <span class="info-value"><?= date('d/m/Y', strtotime($inquilino['fecha_entrada'])) ?></span>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p style="color:var(--text-soft);text-align:center;padding:1rem 0;">Sin datos de propiedad.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- CONTACTAR PROPIETARIO -->
        <div class="card">
            <div class="card-header">
                <div class="icon icon-green"><i class="fa fa-user-tie"></i></div>
                <h3>Contactar Propietario</h3>
            </div>
            <div class="card-body">
                <?php if ($propietario): ?>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa fa-user"></i></div>
                        <div>
                            <div class="contact-label">Nombre</div>
                            <div class="contact-value"><?= htmlspecialchars($propietario['nombre'] . ' ' . $propietario['apellido']) ?></div>
                        </div>
                    </div>
                    <?php if (!empty($propietario['email'])): ?>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fa fa-envelope"></i></div>
                        <div>
                            <div class="contact-label">Email</div>
                            <div class="contact-value">
                                <a class="contact-link" href="mailto:<?= htmlspecialchars($propietario['email']) ?>">
                                    <?= htmlspecialchars($propietario['email']) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($propietario['telefono'])): ?>
                    <div class="contact-item">
                        <div class="contact-icon"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <div class="contact-label">WhatsApp / Teléfono</div>
                            <div class="contact-value">
                                <a class="contact-link" href="https://wa.me/<?= preg_replace('/\D/', '', $propietario['telefono']) ?>" target="_blank">
                                    <?= htmlspecialchars($propietario['telefono']) ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php else: ?>
                    <p style="color:var(--text-soft);text-align:center;padding:1rem 0;">Sin datos del propietario.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

    <!-- FILA 2: Mantenimiento + Comentarios -->
    <div class="grid-2">

        <!-- SOLICITAR MANTENIMIENTO -->
        <div class="card">
            <div class="card-header">
                <div class="icon icon-orange"><i class="fa fa-tools"></i></div>
                <h3>Solicitar Mantenimiento</h3>
            </div>
            <div class="card-body">
                <?php if ($mant_success): ?>
                    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?= $mant_success ?></div>
                <?php endif; ?>
                <?php if ($mant_error): ?>
                    <div class="alert alert-error"><i class="fa fa-exclamation-circle"></i> <?= $mant_error ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="form-group">
                        <label>Título del problema</label>
                        <input type="text" name="mant_titulo" class="form-control" placeholder="Ej: Canilla rota en baño" required>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea name="mant_descripcion" class="form-control" placeholder="Describí el problema con detalle..." required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Prioridad</label>
                        <select name="mant_prioridad" class="form-control">
                            <option value="baja">🟢 Baja</option>
                            <option value="media" selected>🟡 Media</option>
                            <option value="alta">🔴 Alta / Urgente</option>
                        </select>
                    </div>
                    <button type="submit" name="solicitar_mantenimiento" class="btn-primary">
                        <i class="fa fa-paper-plane"></i> Enviar Solicitud
                    </button>
                </form>
            </div>
        </div>

        <!-- COMENTARIOS PARA MEJORAS -->
        <div class="card">
            <div class="card-header">
                <div class="icon icon-purple"><i class="fa fa-lightbulb"></i></div>
                <h3>Sugerencias de Mejora</h3>
            </div>
            <div class="card-body">
                <?php if ($com_success): ?>
                    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?= $com_success ?></div>
                <?php endif; ?>
                <?php if ($com_error): ?>
                    <div class="alert alert-error"><i class="fa fa-exclamation-circle"></i> <?= $com_error ?></div>
                <?php endif; ?>
                <form method="post">
                    <div class="form-group">
                        <label>Tu sugerencia</label>
                        <textarea name="comentario" class="form-control" rows="5"
                            placeholder="¿Qué mejoras te gustaría ver en la propiedad? Cualquier idea es bienvenida..." required></textarea>
                    </div>
                    <p style="font-size:0.82rem;color:var(--text-soft);margin-bottom:1rem;">
                        <i class="fa fa-info-circle"></i> Tus sugerencias ayudan al propietario a mejorar la propiedad.
                    </p>
                    <button type="submit" name="enviar_comentario" class="btn-primary">
                        <i class="fa fa-lightbulb"></i> Enviar Sugerencia
                    </button>
                </form>
            </div>
        </div>

    </div>

</div><!-- /container -->
</body>
</html>