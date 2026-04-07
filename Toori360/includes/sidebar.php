<?php
$page = getActivePage();
$notif_count = count(array_filter($notificaciones, fn($n) => !$n['leida']));
$msg_count = count(array_filter($mensajes, fn($m) => !$m['leido']));
?>
<aside class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-logo">T</div>
        <div class="sidebar-brand">
            Toori 360
            <small>ServicioYa Inmobiliario</small>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section">Principal</div>
        <a href="?page=propiedades" class="nav-item <?= $page === 'propiedades' ? 'active' : '' ?>">
            <i class="fas fa-home"></i> Gestión de Propiedades
        </a>
        <a href="?page=mantenimiento" class="nav-item <?= $page === 'mantenimiento' ? 'active' : '' ?>">
            <i class="fas fa-wrench"></i> Mantenimientos
        </a>
        <a href="?page=mejoras" class="nav-item <?= $page === 'mejoras' ? 'active' : '' ?>">
            <i class="fas fa-tools"></i> Mejoras
        </a>
        <a href="?page=prestadores" class="nav-item <?= $page === 'prestadores' ? 'active' : '' ?>">
            <i class="fas fa-briefcase"></i> Prestadores
        </a>
        <a href="?page=inquilinos" class="nav-item <?= $page === 'inquilinos' ? 'active' : '' ?>">
            <i class="fas fa-user"></i> Inquilinos
        </a>

        <div class="nav-section">Próximamente</div>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-chart-pie"></i> Panel de Control</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-building"></i> Empresas</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-map-marker-alt"></i> Sucursales</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-users-cog"></i> Usuarios y Roles</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-user-tie"></i> Agentes</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-user-shield"></i> Propietarios</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-users"></i> Clientes</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-user-plus"></i> Leads</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-th-list"></i> Tipos de Propiedad</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-map"></i> Ubicaciones</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-bullhorn"></i> Publicaciones</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-handshake"></i> Ventas</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-key"></i> Alquileres</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-file-contract"></i> Contratos</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-bookmark"></i> Reservas</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-dollar-sign"></i> Pagos y Cobros</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-percentage"></i> Comisiones</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-receipt"></i> Gastos</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-calendar-alt"></i> Agenda</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-folder-open"></i> Documentos</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-bell"></i> Notificaciones</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-envelope"></i> Mensajería</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-chart-bar"></i> Reportes</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-history"></i> Auditoría</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-plug"></i> Integraciones</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-file-alt"></i> Plantillas</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-cog"></i> Configuración</span>
        <span class="nav-item disabled" tabindex="-1" aria-disabled="true"><i class="fas fa-life-ring"></i> Soporte</span>
    </nav>
</aside>
