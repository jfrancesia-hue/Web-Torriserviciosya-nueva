<?php
// index.php simple
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <style>
        body {
            background: #f5f6fa;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
            text-align: center;
        }
        h1 {
            color: #273c75;
        }
        a {
            display: inline-block;
            margin-top: 1.5rem;
            padding: 0.5rem 1.5rem;
            background: #0097e6;
            color: #fff;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        a:hover {
            background: #40739e;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        // Dashboard: Ofertas pagadas/contratadas y profesionales registrados
        $supabase_url = 'https://dhhhftzdfpqthzvkrqoz.supabase.co';
        $supabase_key = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImRoaGhmdHpkZnBxdGh6dmtycW96Iiwicm9sZSI6ImFub24iLCJpYXQiOjE3NDQ2OTQyODUsImV4cCI6MjA2MDI3MDI4NX0.-atBYl9Uica9quKZQzqmgWQ8wNd1PFB4ivLrSNv89OQ';

        // 1. Ofertas pagadas/contratadas
        $ch1 = curl_init();
        curl_setopt($ch1, CURLOPT_URL, $supabase_url . "/rest/v1/nuevaOferta?pagado=eq.true&select=id");
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_HTTPHEADER, [
            'apikey: ' . $supabase_key,
            'Authorization: Bearer ' . $supabase_key,
            'Content-Type: application/json'
        ]);
        $result1 = curl_exec($ch1);
        $ofertas_pagadas = 0;
        if (!curl_errno($ch1) && $result1 !== false) {
            $data1 = json_decode($result1, true);
            if (is_array($data1)) $ofertas_pagadas = count($data1);
        }
        curl_close($ch1);

        // 2. Profesionales registrados desde 11/03/2026 y rol=worker
        $fecha_inicio = '2026-03-11T00:00:00';
        $ch2 = curl_init();
        // Filtrar por nombre is not null
        $url2 = $supabase_url . "/rest/v1/usuarios?rol=eq.worker&creado_en=gte." . urlencode($fecha_inicio) . "&nombre=not.is.null&select=id";
        curl_setopt($ch2, CURLOPT_URL, $url2);
        curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch2, CURLOPT_HTTPHEADER, [
            'apikey: ' . $supabase_key,
            'Authorization: Bearer ' . $supabase_key,
            'Content-Type: application/json'
        ]);
        $result2 = curl_exec($ch2);
        $profesionales_registrados = 0;
        if (!curl_errno($ch2) && $result2 !== false) {
            $data2 = json_decode($result2, true);
            if (is_array($data2)) $profesionales_registrados = count($data2);
        }
        curl_close($ch2);
        ?>
        <h1>Dashboard</h1>
        <div style="display:flex;gap:2rem;justify-content:center;margin:2rem 0;flex-wrap:wrap;">
            <div style="background:#e1f7d5;padding:2rem 2.5rem;border-radius:12px;box-shadow:0 2px 8px #0001;text-align:center;min-width:200px;">
                <div style="font-size:2.5rem;font-weight:bold;color:#44bd32;">
                    <?php echo $ofertas_pagadas; ?>
                </div>
                <div style="font-size:1.1rem;color:#273c75;">Ofertas pagadas/contratadas</div>
            </div>
            <div style="background:#d0e6fa;padding:2rem 2.5rem;border-radius:12px;box-shadow:0 2px 8px #0001;text-align:center;min-width:200px;">
                <div style="font-size:2.5rem;font-weight:bold;color:#0097e6;">
                    <?php echo $profesionales_registrados; ?>
                </div>
                <div style="font-size:1.1rem;color:#273c75;">Profesionales registrados</div>
            </div>
        </div>
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <a href="logout.php">Cerrar sesión</a>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
        <?php endif; ?>
    </div>
</body>
</html>
