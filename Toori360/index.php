<?php
/**
 * TOORI SERVICIOYA 360
 * Punto de entrada principal
 */

session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['propietario_id'])) {
    header('Location: pages/login.php');
    exit;
}

// Cargar datos y helpers
require_once __DIR__ . '/includes/data.php';
require_once __DIR__ . '/includes/helpers.php';

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

// Header HTML
include __DIR__ . '/includes/header.php';

// Sidebar
include __DIR__ . '/includes/sidebar.php';

// Main content wrapper
echo '<div class="main-content">';

// Topbar
include __DIR__ . '/includes/topbar.php';

// Page content
echo '<div class="page-content">';

$page_file = __DIR__ . '/pages/' . $page . '.php';
if (file_exists($page_file)) {
    include $page_file;
} else {
    include __DIR__ . '/pages/dashboard.php';
}

echo '</div>';

// Footer
include __DIR__ . '/includes/footer.php';
