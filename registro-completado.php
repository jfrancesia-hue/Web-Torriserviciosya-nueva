<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro completado - Toori ServiciosYa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./assets/main-D3W1u2cc.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>
<main class="container" style="padding:60px 0; display:flex; justify-content:center;">
    <div style="max-width:700px; width:100%; background:#fff; border-radius:18px; padding:36px; box-shadow:0 8px 30px rgba(0,0,0,0.06); text-align:center;">
        <h1>¡Registro completado!</h1>
        <p class="text-muted">Gracias por unirte a la red de profesionales de Toori.</p>
        <p>Ahora podés completar tu perfil o volver al inicio.</p>
        <div style="display:flex;gap:12px;justify-content:center;margin-top:18px;">
            <a class="btn btn-primary" href="perfil.php">Ir a mi perfil</a>
            <a class="btn btn-outline-secondary" href="index.php">Volver al inicio</a>
        </div>
    </div>
</main>
<?php include 'footer.php'; ?>
</body>
</html>