<?php
/**
 * TOORI SERVICIOYA 360
 * Funciones helper
 */

function formatMoney($amount, $currency = 'ARS') {
    if ($currency === 'USD') {
        return 'USD ' . number_format($amount, 0, ',', '.');
    }
    return '$ ' . number_format($amount, 0, ',', '.');
}

function getBadgeClass($estado) {
    $map = [
        'Activo' => 'badge-success', 'Activa' => 'badge-success', 'Disponible' => 'badge-success',
        'Vigente' => 'badge-success', 'Pagado' => 'badge-success', 'Liquidada' => 'badge-success',
        'Firmado' => 'badge-success', 'Escriturado' => 'badge-success', 'Conectado' => 'badge-success',
        'Finalizado' => 'badge-success', 'Realizada' => 'badge-success', 'Resuelto' => 'badge-success',
        'Convertida' => 'badge-success', 'Cerrado' => 'badge-success',
        'Pendiente' => 'badge-warning', 'En Revisión' => 'badge-warning', 'Aprobado' => 'badge-warning',
        'Nuevo' => 'badge-info', 'Contactado' => 'badge-info', 'Interesado' => 'badge-info',
        'Pendiente Firma' => 'badge-warning', 'En Escrituración' => 'badge-warning',
        'Confirmada' => 'badge-primary', 'Visita Agendada' => 'badge-primary',
        'En Curso' => 'badge-primary', 'En Proceso' => 'badge-primary', 'En Negociación' => 'badge-primary',
        'Reservada' => 'badge-purple', 'Pausada' => 'badge-secondary',
        'Alquilada' => 'badge-teal', 'Vendida' => 'badge-dark',
        'Inactivo' => 'badge-danger', 'Suspendida' => 'badge-danger', 'Vencido' => 'badge-danger',
        'Vencida' => 'badge-danger', 'Perdido' => 'badge-danger', 'Cancelado' => 'badge-danger',
        'Desconectado' => 'badge-secondary', 'Borrador' => 'badge-secondary',
        'Alta' => 'badge-danger', 'Media' => 'badge-warning', 'Baja' => 'badge-info',
    ];
    return $map[$estado] ?? 'badge-secondary';
}

function getNotifIcon($tipo) {
    $map = [
        'lead' => 'fa-user-plus', 'pago' => 'fa-dollar-sign', 'contrato' => 'fa-file-contract',
        'visita' => 'fa-calendar-check', 'mantenimiento' => 'fa-wrench', 'reserva' => 'fa-bookmark',
        'sistema' => 'fa-gear',
    ];
    return $map[$tipo] ?? 'fa-bell';
}

function getNotifColor($tipo) {
    $map = [
        'lead' => '#3b82f6', 'pago' => '#10b981', 'contrato' => '#8b5cf6',
        'visita' => '#f59e0b', 'mantenimiento' => '#ef4444', 'reserva' => '#6366f1',
        'sistema' => '#6b7280',
    ];
    return $map[$tipo] ?? '#6b7280';
}

function getActivePage() {
    return $_GET['page'] ?? 'dashboard';
}

function timeAgo($datetime) {
    $now = new DateTime('2025-06-10 11:00:00');
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    if ($diff->d > 0) return 'Hace ' . $diff->d . ' día' . ($diff->d > 1 ? 's' : '');
    if ($diff->h > 0) return 'Hace ' . $diff->h . ' hora' . ($diff->h > 1 ? 's' : '');
    if ($diff->i > 0) return 'Hace ' . $diff->i . ' min';
    return 'Ahora';
}
