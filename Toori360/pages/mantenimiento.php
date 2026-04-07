<?php
require_once __DIR__ . '/../includes/conexion.php';
/**
 * MANTENIMIENTO / REPARACIONES
 */
// Obtener mantenimientos desde la base de datos
$stmt = $pdo->query('SELECT m.*, p.titulo as propiedad FROM mantenimientos m LEFT JOIN propiedades p ON m.propiedad_id = p.id ORDER BY m.id DESC');
$mantenimientos = $stmt->fetchAll();

// KPIs
$total_mant = count($mantenimientos);
$pendientes_m = count(array_filter($mantenimientos, fn($m) => $m['estado']==='Pendiente'));
$en_curso = count(array_filter($mantenimientos, fn($m) => $m['estado']==='En Curso'||$m['estado']==='Aprobado'));
$finalizados = count(array_filter($mantenimientos, fn($m) => $m['estado']==='Finalizado'));

// Para el modal de alta, obtener propiedades
$stmt2 = $pdo->query('SELECT id, codigo, titulo FROM propiedades ORDER BY id DESC LIMIT 15');
$propiedades = $stmt2->fetchAll();
?>
<div class="page-header">
    <div>
        <h1 class="page-title">Mantenimiento / Reparaciones</h1>
        <p class="page-subtitle">Gestión de incidencias, reparaciones y mantenimiento preventivo</p>
    </div>
    <div class="btn-group">
        <button class="btn btn-primary" onclick="openModal('modalNuevoTicket')"><i class="fas fa-plus"></i> Nuevo Ticket</button>
    </div>
</div>

<div class="kpi-grid">
    <div class="kpi-card"><div class="kpi-icon blue"><i class="fas fa-wrench"></i></div><div class="kpi-info"><div class="kpi-label">Total Tickets</div><div class="kpi-value"><?= $total_mant ?></div></div></div>
    <div class="kpi-card"><div class="kpi-icon yellow"><i class="fas fa-clock"></i></div><div class="kpi-info"><div class="kpi-label">Pendientes</div><div class="kpi-value"><?= $pendientes_m ?></div></div></div>
    <div class="kpi-card"><div class="kpi-icon purple"><i class="fas fa-tools"></i></div><div class="kpi-info"><div class="kpi-label">En Curso</div><div class="kpi-value"><?= $en_curso ?></div></div></div>
    <div class="kpi-card"><div class="kpi-icon green"><i class="fas fa-check-circle"></i></div><div class="kpi-info"><div class="kpi-label">Finalizados</div><div class="kpi-value"><?= $finalizados ?></div></div></div>
</div>

<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-body">
        <div class="filters-row">
            <div class="filter-group"><input type="text" class="form-control" placeholder="Buscar ticket..."></div>
            <div class="filter-group"><select class="form-control"><option value="">Todas las prioridades</option><option>Alta</option><option>Media</option><option>Baja</option></select></div>
            <div class="filter-group"><select class="form-control"><option value="">Todos los estados</option><option>Pendiente</option><option>En Revisión</option><option>Aprobado</option><option>En Curso</option><option>Finalizado</option><option>Cancelado</option></select></div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body" style="overflow-x:auto;">
        <table class="table">
            <thead><tr><th>Ticket</th><th>Propiedad</th><th>Incidencia</th><th>Prioridad</th><th>Responsable</th><th>Costo Est.</th><th>Fecha</th><th>Estado</th><th>Acciones</th></tr></thead>
            <tbody>
                <?php foreach($mantenimientos as $m): ?>
                <tr>
                    <td><strong>TK-<?= str_pad($m['id'], 3, '0', STR_PAD_LEFT) ?></strong></td>
                    <td style="font-size:.85rem;"><?= $m['propiedad'] ?></td>
                    <td>
                        <div style="font-weight:600;font-size:.85rem;"><?= $m['tipo'] ?></div>
                        <div style="font-size:.75rem;color:var(--gray-500);"><?= $m['descripcion'] ?></div>
                    </td>
                    <td><span class="badge <?= getBadgeClass($m['prioridad']) ?>"><?= $m['prioridad'] ?></span></td>
                    <td style="font-size:.85rem;"><?= $m['responsable'] ?></td>
                    <td><?= formatMoney($m['costo_estimado']) ?></td>
                    <td style="font-size:.85rem;"><?= date('d/m/Y', strtotime($m['fecha'])) ?></td>
                    <td><span class="badge <?= getBadgeClass($m['estado']) ?>"><?= $m['estado'] ?></span></td>
                    <td><div class="btn-group"><button class="btn btn-sm btn-secondary"><i class="fas fa-eye"></i></button><button class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></button></div></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal-overlay" id="modalNuevoTicket">
    <div class="modal" style="max-width:600px;">
        <div class="modal-header"><h3>Nuevo Ticket de Mantenimiento</h3><button class="modal-close" onclick="closeModal('modalNuevoTicket')">&times;</button></div>
        <div class="modal-body">
            <div class="form-grid">
                <div class="form-group"><label>Propiedad</label><select class="form-control"><?php foreach(array_slice($propiedades,0,15) as $p): ?><option><?= $p['codigo'] ?> - <?= $p['titulo'] ?></option><?php endforeach; ?></select></div>
                <div class="form-group"><label>Tipo de incidencia</label><select class="form-control"><option>Plomería</option><option>Electricidad</option><option>Gas</option><option>Pintura</option><option>Humedad</option><option>Cerrajería</option><option>Otro</option></select></div>
                <div class="form-group"><label>Prioridad</label><select class="form-control"><option>Alta</option><option>Media</option><option>Baja</option></select></div>
                <div class="form-group"><label>Responsable</label><input type="text" class="form-control"></div>
                <div class="form-group"><label>Costo estimado</label><input type="number" class="form-control"></div>
                <div class="form-group"><label>Proveedor</label><input type="text" class="form-control"></div>
                <div class="form-group full-width"><label>Descripción</label><textarea class="form-control" rows="3"></textarea></div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalNuevoTicket')">Cancelar</button>
            <button class="btn btn-primary" onclick="closeModal('modalNuevoTicket')"><i class="fas fa-save"></i> Crear Ticket</button>
        </div>
    </div>
</div>
<style>.filters-row{display:flex;gap:.75rem;flex-wrap:wrap;}.filter-group{flex:1;min-width:150px;}.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}.form-grid .full-width{grid-column:1/-1;}</style>
