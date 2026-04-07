<?php
require_once __DIR__ . '/../includes/conexion.php';
if (session_status() === PHP_SESSION_NONE) session_start();
$id_propietario = $_SESSION['propietario_id'] ?? 0;


// --- AJAX ---
if (isset($_GET['action'])) {
    header('Content-Type: application/json');
    if (!$id_propietario) { echo json_encode(['ok'=>false,'error'=>'No autorizado']); exit; }

    // Guardar nuevo inquilino
    if ($_GET['action'] === 'nuevo_inquilino') {
        $nombre        = trim($_POST['nombre'] ?? '');
        $dni           = trim($_POST['dni'] ?? '');
        $edad          = ($_POST['edad'] ?? '') !== '' ? (int)$_POST['edad'] : null;
        $fecha_entrada = $_POST['fecha_entrada'] ?? null;
        $propiedad_id  = (int)($_POST['propiedad_id'] ?? 0);
        $estado        = $_POST['estado'] ?? 'pendiente';

        if (!$nombre || !$dni || !$propiedad_id) {
            echo json_encode(['ok'=>false,'error'=>'Faltan campos obligatorios']); exit;
        }

        // Validar que la propiedad pertenezca al usuario
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM propiedades WHERE id = ? AND id_propietario = ?');
        $stmt->execute([$propiedad_id, $id_propietario]);
        if (!$stmt->fetchColumn()) {
            echo json_encode(['ok'=>false,'error'=>'Propiedad inválida']); exit;
        }

        try {
            $stmt = $pdo->prepare('INSERT INTO inquilinos (nombre, dni, edad, fecha_entrada, propiedad_id, estado) VALUES (?,?,?,?,?,?)');
            $stmt->execute([$nombre, $dni, $edad, $fecha_entrada ?: null, $propiedad_id, $estado]);
            echo json_encode(['ok'=>true]);
        } catch (Exception $e) {
            echo json_encode(['ok'=>false,'error'=>'Error al guardar: '.$e->getMessage()]);
        }
        exit;
    }

    // Cambiar estado de inquilino
    if ($_GET['action'] === 'cambiar_estado') {
        $id     = (int)($_POST['id'] ?? 0);
        $estado = $_POST['estado'] ?? '';

        if (!in_array($estado, ['pendiente','activo','expulsado'])) {
            echo json_encode(['ok'=>false,'error'=>'Estado inválido']); exit;
        }

        // Validar que el inquilino pertenezca a una propiedad del usuario
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM inquilinos i JOIN propiedades p ON i.propiedad_id = p.id WHERE i.id = ? AND p.id_propietario = ?');
        $stmt->execute([$id, $id_propietario]);
        if (!$stmt->fetchColumn()) {
            echo json_encode(['ok'=>false,'error'=>'No autorizado']); exit;
        }

        $stmt = $pdo->prepare('UPDATE inquilinos SET estado = ? WHERE id = ?');
        $stmt->execute([$estado, $id]);
        echo json_encode(['ok'=>true]);
        exit;
    }

    echo json_encode(['ok'=>false,'error'=>'Acción no válida']);
    exit;
}

// --- Traer propiedades del propietario ---
$stmt = $pdo->prepare('SELECT id, direccion, ciudad, tipo FROM propiedades WHERE id_propietario = ? ORDER BY direccion');
$stmt->execute([$id_propietario]);
$propiedades = $stmt->fetchAll();

// --- Traer inquilinos de esas propiedades ---
$inquilinos = [];
if ($propiedades) {
    $ids = implode(',', array_column($propiedades, 'id'));
    $sql = "SELECT i.*, p.direccion FROM inquilinos i 
            JOIN propiedades p ON i.propiedad_id = p.id 
            WHERE i.propiedad_id IN ($ids) 
            ORDER BY i.id DESC";
    $inquilinos = $pdo->query($sql)->fetchAll();
}
?>

<div class="page-header">
    <div>
        <h1 class="page-title">Inquilinos</h1>
        <p class="page-subtitle">Gestión de inquilinos asociados a las propiedades.</p>
    </div>
    <div class="btn-group">
        <button class="btn btn-primary" onclick="openModal('modalNuevoInquilino')">
            <i class="fas fa-user-plus"></i> Cargar Inquilino
        </button>
    </div>
</div>

<?php if (empty($inquilinos)): ?>
<div style="display:flex;justify-content:center;align-items:center;min-height:220px;">
    <div style="text-align:center;cursor:pointer;" onclick="openModal('modalNuevoInquilino')">
        <div style="font-size:3.5rem;color:#00B4D8;margin-bottom:1rem;"><i class="fas fa-user-plus"></i></div>
        <div style="font-size:1.2rem;font-weight:600;color:#0056A6;">Cargar Inquilino</div>
        <div style="font-size:.95rem;color:#888;margin-top:.5rem;">No hay inquilinos registrados. Haz clic para agregar el primero.</div>
    </div>
</div>
<?php else: ?>

<!-- Cards de inquilinos -->
<div style="display:flex;flex-wrap:wrap;gap:1.5rem;margin-bottom:2rem;">
    <?php foreach($inquilinos as $inq): ?>
    <div class="card" style="min-width:320px;max-width:370px;flex:1 1 320px;">
        <div class="card-body">
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <div style="font-size:1.25rem;font-weight:600;"><?= htmlspecialchars($inq['nombre']) ?></div>
                <span class="badge badge-<?=
                    $inq['estado']==='activo' ? 'success' :
                    ($inq['estado']==='expulsado' ? 'danger' : 'secondary')
                ?>" id="estado-badge-<?= $inq['id'] ?>">
                    <?= ucfirst($inq['estado'] ?? 'pendiente') ?>
                </span>
            </div>
            <div style="margin-top:.75rem;display:flex;flex-direction:column;gap:.25rem;">
                <div><b>DNI:</b> <?= htmlspecialchars($inq['dni']) ?></div>
                <div><b>Edad:</b> <?= htmlspecialchars($inq['edad'] ?? '-') ?></div>
                <div><b>Fecha de Entrada:</b> <?= htmlspecialchars($inq['fecha_entrada'] ?? '-') ?></div>
                <div><b>Propiedad:</b> <?= htmlspecialchars($inq['direccion']) ?></div>
            </div>
            <div style="margin-top:1rem;">
                <label style="font-size:.9rem;font-weight:500;">Cambiar estado:</label>
                <select class="form-control" style="margin-top:.3rem;max-width:180px;" 
                    onchange="cambiarEstadoInquilino(<?= $inq['id'] ?>, this.value)">
                    <option value="pendiente"  <?= $inq['estado']==='pendiente' ?'selected':'' ?>>Pendiente</option>
                    <option value="activo"   <?= $inq['estado']==='activo'  ?'selected':'' ?>>activo</option>
                    <option value="expulsado"  <?= $inq['estado']==='expulsado' ?'selected':'' ?>>Expulsado</option>
                </select>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php endif; ?>

<!-- Modal Nuevo Inquilino -->
<div class="modal-overlay" id="modalNuevoInquilino">
    <div class="modal" style="max-width:600px;">
        <div class="modal-header">
            <h3>Nuevo Inquilino</h3>
            <button class="modal-close" onclick="closeModal('modalNuevoInquilino')">&times;</button>
        </div>
        <div class="modal-body">
            <form id="formNuevoInquilino">
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Nombre *</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label>DNI *</label>
                        <input type="text" class="form-control" name="dni" required>
                    </div>
                    <div class="form-group">
                        <label>Edad</label>
                        <input type="number" class="form-control" name="edad">
                    </div>
                    <div class="form-group">
                        <label>Fecha de Entrada</label>
                        <input type="date" class="form-control" name="fecha_entrada">
                    </div>
                    <div class="form-group full-width">
                        <label>Propiedad alojada *</label>
                        <select class="form-control" name="propiedad_id" required>
                            <option value="">-- Seleccionar --</option>
                            <?php foreach($propiedades as $prop): ?>
                            <option value="<?= $prop['id'] ?>">
                                <?= htmlspecialchars($prop['direccion']) ?>
                                <?= $prop['ciudad'] ? ' - '.htmlspecialchars($prop['ciudad']) : '' ?>
                                <?= $prop['tipo']   ? ' ('.htmlspecialchars($prop['tipo']).')' : '' ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-control" name="estado">
                            <option value="pendiente">Pendiente</option>
                            <option value="activo">activo</option>
                            <option value="expulsado">Expulsado</option>
                        </select>
                    </div>
                </div>
                <div id="formErrorInq" style="color:red;display:none;margin-top:.5rem;"></div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="closeModal('modalNuevoInquilino')">Cancelar</button>
            <button class="btn btn-primary" onclick="guardarInquilino()"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
</div>

<style>
.form-grid{display:grid;grid-template-columns:1fr 1fr;gap:1rem;}
.form-grid .full-width{grid-column:1/-1;}
</style>

<script>
function guardarInquilino() {
    const form = document.getElementById('formNuevoInquilino');
    const data = new FormData(form);
    const err  = document.getElementById('formErrorInq');
    if (!data.get('nombre') || !data.get('dni') || !data.get('propiedad_id')) {
        err.textContent = 'Completa los campos obligatorios.';
        err.style.display = 'block';
        return;
    }
    err.style.display = 'none';

    fetch('/Toori360/pages/inquilinos.php?action=nuevo_inquilino', {
        method: 'POST',
        body: data
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) { closeModal('modalNuevoInquilino'); location.reload(); }
        else { err.textContent = res.error || 'Error al guardar.'; err.style.display = 'block'; }
    })
    .catch(() => {
        err.textContent = 'Error de conexión.'; err.style.display = 'block';
    });
}

function cambiarEstadoInquilino(id, estado) {
    fetch('/Toori360/pages/inquilinos.php?action=cambiar_estado', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + encodeURIComponent(id) + '&estado=' + encodeURIComponent(estado)
    })
    .then(r => r.json())
    .then(res => {
        if (res.ok) {
            const badge = document.getElementById('estado-badge-' + id);
            badge.textContent = estado.charAt(0).toUpperCase() + estado.slice(1);
            badge.className = 'badge badge-' + (
                estado === 'activo'  ? 'success' :
                estado === 'expulsado' ? 'danger'  : 'secondary'
            );
        }
    });
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