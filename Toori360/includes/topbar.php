<?php
$page = getActivePage();
$page_names = [
    'dashboard' => 'Panel de Control', 'empresas' => 'Empresas', 'sucursales' => 'Sucursales',
    'usuarios' => 'Usuarios y Roles', 'agentes' => 'Agentes', 'propietarios' => 'Propietarios',
    'clientes' => 'Clientes', 'propiedades' => 'Propiedades', 'tipos_propiedades' => 'Tipos de Propiedad',
    'ubicaciones' => 'Ubicaciones', 'publicaciones' => 'Publicaciones', 'ventas' => 'Ventas',
    'alquileres' => 'Alquileres', 'contratos' => 'Contratos', 'reservas' => 'Reservas',
    'pagos' => 'Pagos y Cobros', 'comisiones' => 'Comisiones', 'gastos' => 'Gastos',
    'mantenimiento' => 'Mantenimiento', 'agenda' => 'Agenda', 'leads' => 'Leads',
    'documentos' => 'Documentos', 'reportes' => 'Reportes', 'notificaciones' => 'Notificaciones',
    'mensajeria' => 'Mensajería', 'integraciones' => 'Integraciones', 'configuracion' => 'Configuración',
    'auditoria' => 'Auditoría', 'plantillas' => 'Plantillas', 'soporte' => 'Soporte',
];
$page_title = $page_names[$page] ?? 'Panel de Control';
$notif_unread = count(array_filter($notificaciones, fn($n) => !$n['leida']));
?>
<header class="topbar">
    <div class="topbar-left">
        <button class="topbar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        <div class="breadcrumb">
            <a href="?page=dashboard"><i class="fas fa-home"></i></a>
            <span class="sep">/</span>
            <span class="current"><?= $page_title ?></span>
        </div>
    </div>
    <div class="topbar-search">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Buscar propiedades, clientes, leads..." oninput="globalSearch(this.value)">
    </div>
    <div class="topbar-right">
        <button class="topbar-btn" title="Notificaciones" onclick="toggleNotifications()">
            <i class="fas fa-bell"></i>
            <?php if($notif_unread > 0): ?><span class="notif-dot"></span><?php endif; ?>
        </button>
        <button class="topbar-btn" title="Mensajes">
            <i class="fas fa-envelope"></i>
        </button>
        <button class="topbar-btn" title="Calendario">
            <i class="fas fa-calendar"></i>
        </button>
        <?php
        $nombre = 'Usuario';
        $apellido = '';
        $rol = '';
        $avatar = 'U';
        if (isset($_SESSION['propietario_id'])) {
            require_once __DIR__ . '/conexion.php';
            $stmt = $pdo->prepare('SELECT nombre, apellido, email FROM propietarios WHERE id = ?');
            $stmt->execute([$_SESSION['propietario_id']]);
            if ($row = $stmt->fetch()) {
                $nombre = $row['nombre'];
                $apellido = $row['apellido'];
                $avatar = strtoupper(mb_substr($nombre,0,1).mb_substr($apellido,0,1));
                $rol = 'Propietario';
            }
        }
        ?>
        <div class="user-menu">
            <div class="user-avatar" style="width:40px;height:40px;background:#007bff;color:#fff;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:1.3em;font-weight:bold;">
                <?= htmlspecialchars($avatar) ?>
            </div>
            <div class="user-info" style="display:flex;flex-direction:column;align-items:flex-start;gap:4px;">
                <div class="name" style="font-weight:bold;font-size:1em;"><?= htmlspecialchars($nombre . ' ' . $apellido) ?></div>
                <div class="role" style="font-size:0.95em;color:#666;"><?= htmlspecialchars($rol) ?></div>
                
            </div>
                <form action="/Toori360/logout.php" method="post" >
                    <button type="submit" style="background:#e74c3c;color:#fff;border:none;padding:6px 14px;border-radius:4px;cursor:pointer;font-size:0.95em;margin-top:6px;display:flex;align-items:center;gap:6px;">
                        <i class="fas fa-sign-out-alt" style="font-size:1em;"></i>
                    </button>
                </form>
        </div>
    </div>
</header>
