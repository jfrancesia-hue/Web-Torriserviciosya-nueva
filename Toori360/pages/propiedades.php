<?php
require_once __DIR__ . '/../includes/conexion.php';

// Obtener el id del propietario logueado
if (session_status() === PHP_SESSION_NONE) session_start();
$id_propietario = $_SESSION['propietario_id'] ?? 0;


// Solo traer las propiedades del propietario logueado
$stmt = $pdo->prepare('SELECT * FROM propiedades WHERE id_propietario = ? ORDER BY id DESC');
$stmt->execute([$id_propietario]);
$propiedades = $stmt->fetchAll();
$total = count($propiedades);
$disponibles = count(array_filter($propiedades, fn($p) => $p['estado'] === 'disponible'));
$vendidas = count(array_filter($propiedades, fn($p) => $p['estado'] === 'vendida'));
$alquiladas = count(array_filter($propiedades, fn($p) => $p['estado'] === 'alquilada'));
$reservadas = count(array_filter($propiedades, fn($p) => $p['estado'] === 'reservada'));
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Propiedades</h1>
        <p class="page-subtitle">Gestión integral de propiedades &mdash; <?= $total ?> registradas</p>
    </div>
    <div class="btn-group">
        <button class="btn btn-primary" onclick="openModal('modalNuevaPropiedad')"><i class="fas fa-plus"></i> Nueva Propiedad</button>
    </div>
</div>

<!-- KPI Cards -->
<div class="kpi-grid">
    <div class="kpi-card">
        <div class="kpi-icon blue"><i class="fas fa-home"></i></div>
        <div class="kpi-info"><div class="kpi-label">Total</div><div class="kpi-value"><?= $total ?></div></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon green"><i class="fas fa-check-circle"></i></div>
        <div class="kpi-info"><div class="kpi-label">Disponibles</div><div class="kpi-value"><?= $disponibles ?></div></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon dark"><i class="fas fa-handshake"></i></div>
        <div class="kpi-info"><div class="kpi-label">Vendidas</div><div class="kpi-value"><?= $vendidas ?></div></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon teal"><i class="fas fa-key"></i></div>
        <div class="kpi-info"><div class="kpi-label">Alquiladas</div><div class="kpi-value"><?= $alquiladas ?></div></div>
    </div>
    <div class="kpi-card">
        <div class="kpi-icon purple"><i class="fas fa-bookmark"></i></div>
        <div class="kpi-info"><div class="kpi-label">Reservadas</div><div class="kpi-value"><?= $reservadas ?></div></div>
    </div>
</div>

<!-- Filtros -->
<div class="card" style="margin-bottom:1.5rem;">
    <div class="card-body">
        <div class="filters-row">
            <div class="filter-group">
                <input type="text" class="form-control" placeholder="Buscar propiedad..." id="searchProp" oninput="filtrarTabla()">
            </div>
            <div class="filter-group">
                <select class="form-control" id="filterTipo" onchange="filtrarTabla()">
                    <option value="">Todos los tipos</option>
                    <option>Casa</option>
                    <option>Departamento</option>
                    <option>Local Comercial</option>
                    <option>Terreno</option>
                    <option>Oficina</option>
                </select>
            </div>
            <div class="filter-group">
                <select class="form-control" id="filterEstado" onchange="filtrarTabla()">
                    <option value="">Todos los estados</option>
                    <option value="disponible">Disponible</option>
                    <option value="reservada">Reservada</option>
                    <option value="vendida">Vendida</option>
                    <option value="alquilada">Alquilada</option>
                </select>
            </div>
        </div>
    </div>
</div>

<!-- Tabla -->
<div class="card">
    <div class="card-body" style="overflow-x:auto;">
        <?php if (empty($propiedades)): ?>
            <div style="display:flex;justify-content:center;align-items:center;min-height:220px;">
                <div style="text-align:center;cursor:pointer;" onclick="openModal('modalNuevaPropiedad')">
                    <div style="font-size:3.5rem;color:#00B4D8;margin-bottom:1rem;"><i class="fas fa-plus-circle"></i></div>
                    <div style="font-size:1.2rem;font-weight:600;color:#0056A6;">Agregar Propiedad</div>
                    <div style="font-size:.95rem;color:#888;margin-top:.5rem;">No hay propiedades registradas. Haz clic para agregar la primera.</div>
                </div>
            </div>
        <?php else: ?>
        <table class="table" id="tablaPropiedades">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($propiedades as $p): ?>
                <tr data-tipo="<?= strtolower($p['tipo']) ?>" data-estado="<?= $p['estado'] ?>">
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['direccion']) ?></td>
                    <td><?= htmlspecialchars($p['ciudad'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($p['tipo'] ?? '-') ?></td>
                    <td><strong><?= $p['precio'] ? '$' . number_format($p['precio'], 0, ',', '.') : '-' ?></strong></td>
                    <td>
                        <span class="badge <?= match($p['estado']) {
                            'disponible' => 'badge-success',
                            'vendida'    => 'badge-dark',
                            'alquilada'  => 'badge-teal',
                            'reservada'  => 'badge-warning',
                            default      => 'badge-secondary'
                        } ?>">
                            <?= ucfirst($p['estado']) ?>
                        </span>
                    </td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-secondary" title="Ver detalle"
                                onclick="verDetalle(<?= htmlspecialchars(json_encode($p)) ?>)">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-secondary" title="Eliminar"
                                onclick="eliminarPropiedad(<?= $p['id'] ?>)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Detalle -->
<div class="modal-overlay" id="modalDetalleProp">
    <div class="modal" style="max-width:600px;">
        <div class="modal-header">
            <h3>Detalle de Propiedad</h3>
            <button class="modal-close" onclick="closeModal('modalDetalleProp')">&times;</button>
        </div>
        <div class="modal-body" id="detalleContenido"></div>
    </div>
</div>

<!-- Modal Nueva Propiedad -->
<div class="modal-overlay" id="modalNuevaPropiedad">
    <div class="modal" style="max-width:600px;">
        <div class="modal-header">
            <h3>Nueva Propiedad</h3>
            <button class="modal-close" onclick="closeModal('modalNuevaPropiedad')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="formNuevaPropiedad">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Dirección *</label>
                        <input type="text" class="form-control" name="direccion" required>
                    </div>
                    <div class="form-group">
                        <label>Ciudad</label>
                        <input type="text" class="form-control" name="ciudad">
                    </div>
                    <div class="form-group">
                        <label>Tipo</label>
                        <select class="form-control" name="tipo">
                            <option value="">-- Seleccionar --</option>
                            <option>Casa</option>
                            <option>Departamento</option>
                            <option>Local Comercial</option>
                            <option>Terreno</option>
                            <option>Oficina</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" class="form-control" name="precio" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado">
                            <option value="disponible">Disponible</option>
                            <option value="reservada">Reservada</option>
                            <option value="vendida">Vendida</option>
                            <option value="alquilada">Alquilada</option>
                        </select>
                    </div>
                </div>
                <div id="formError" style="color:red;display:none;margin-top:.5rem;"></div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalNuevaPropiedad')">Cancelar</button>
            <button class="btn btn-primary" onclick="guardarPropiedad()"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
</div>

<style>
.filters-row{display:flex;gap:.75rem;flex-wrap:wrap;align-items:center;}
.filter-group{flex:1;min-width:150px;}
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.form-grid .full-width{grid-column:1/-1;}
</style>

<script>
function filtrarTabla() {
    const search = document.getElementById('searchProp').value.toLowerCase();
    const tipo   = document.getElementById('filterTipo').value.toLowerCase();
    const estado = document.getElementById('filterEstado').value.toLowerCase();
    document.querySelectorAll('#tablaPropiedades tbody tr').forEach(row => {
        const texto  = row.innerText.toLowerCase();
        const rTipo  = row.dataset.tipo  || '';
        const rEstado= row.dataset.estado|| '';
        const ok = texto.includes(search)
            && (tipo   === '' || rTipo.includes(tipo))
            && (estado === '' || rEstado === estado);
        row.style.display = ok ? '' : 'none';
    });
}

function verDetalle(p) {
    document.getElementById('detalleContenido').innerHTML = `
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            <div><span style="font-size:.7rem;color:#888;text-transform:uppercase;">ID</span><div style="font-weight:600;">${p.id}</div></div>
            <div><span style="font-size:.7rem;color:#888;text-transform:uppercase;">Estado</span><div style="font-weight:600;">${p.estado}</div></div>
            <div><span style="font-size:.7rem;color:#888;text-transform:uppercase;">Dirección</span><div style="font-weight:600;">${p.direccion}</div></div>
            <div><span style="font-size:.7rem;color:#888;text-transform:uppercase;">Ciudad</span><div style="font-weight:600;">${p.ciudad ?? '-'}</div></div>
            <div><span style="font-size:.7rem;color:#888;text-transform:uppercase;">Tipo</span><div style="font-weight:600;">${p.tipo ?? '-'}</div></div>
            <div><span style="font-size:.7rem;color:#888;text-transform:uppercase;">Precio</span><div style="font-weight:600;">${p.precio ? '$' + Number(p.precio).toLocaleString('es-AR') : '-'}</div></div>
        </div>`;
    openModal('modalDetalleProp');
}

function guardarPropiedad() {
    const form = document.getElementById('formNuevaPropiedad');
    const data = new FormData(form);
    const err  = document.getElementById('formError');
    if (!data.get('direccion')) { err.textContent='La dirección es obligatoria.'; err.style.display='block'; return; }
    err.style.display = 'none';

    fetch('/Toori360/pages/propiedades_ajax.php?action=nueva_propiedad', {
        method: 'POST',
        body: data
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) { closeModal('modalNuevaPropiedad'); location.reload(); }
        else { err.textContent = res.error || 'Error al guardar.'; err.style.display='block'; }
    })
    .catch(() => {
        err.textContent = 'Error de conexión.'; err.style.display='block';
    });
}

function eliminarPropiedad(id) {
    if (!confirm('¿Eliminar esta propiedad?')) return;
    fetch('/Toori360/pages/propiedades_ajax.php?action=eliminar_propiedad&id=' + id, { method: 'POST' })
        .then(r => r.json())
        .then(res => { if (res.ok) location.reload(); });
}

function openModal(id) {
    document.getElementById(id).classList.add('active');
    document.getElementById(id).style.display = 'flex';
}
function closeModal(id) {
    document.getElementById(id).classList.remove('active');
    document.getElementById(id).style.display = 'none';
}
</script>