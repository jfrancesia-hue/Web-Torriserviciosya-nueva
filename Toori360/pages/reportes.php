<?php
/**
 * REPORTES Y ESTADÍSTICAS
 */
$m = $metricas;
?>
<div class="page-header">
    <div>
        <h1 class="page-title">Reportes y Estadísticas</h1>
        <p class="page-subtitle">Análisis de rendimiento del negocio &mdash; Junio 2025</p>
    </div>
    <div class="btn-group">
        <select class="form-control" style="width:auto;"><option>Junio 2025</option><option>Mayo 2025</option><option>Abril 2025</option></select>
        <button class="btn btn-secondary"><i class="fas fa-file-pdf"></i> Exportar PDF</button>
        <button class="btn btn-secondary"><i class="fas fa-file-excel"></i> Exportar Excel</button>
    </div>
</div>

<!-- KPIs Principales -->
<div class="kpi-grid">
    <div class="kpi-card"><div class="kpi-icon green"><i class="fas fa-dollar-sign"></i></div><div class="kpi-info"><div class="kpi-label">Ingresos Totales</div><div class="kpi-value"><?= formatMoney($m['ingresos_mes_ars']) ?></div><div class="kpi-change up"><i class="fas fa-arrow-up"></i> +18% vs mes anterior</div></div></div>
    <div class="kpi-card"><div class="kpi-icon red"><i class="fas fa-arrow-down"></i></div><div class="kpi-info"><div class="kpi-label">Egresos Totales</div><div class="kpi-value"><?= formatMoney(4200000) ?></div></div></div>
    <div class="kpi-card"><div class="kpi-icon blue"><i class="fas fa-chart-line"></i></div><div class="kpi-info"><div class="kpi-label">Rentabilidad</div><div class="kpi-value">62%</div><div class="kpi-change up"><i class="fas fa-arrow-up"></i> +5%</div></div></div>
    <div class="kpi-card"><div class="kpi-icon purple"><i class="fas fa-funnel-dollar"></i></div><div class="kpi-info"><div class="kpi-label">Conversión Leads</div><div class="kpi-value">24%</div></div></div>
</div>

<!-- Gráficos -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem;">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Ventas Mensuales</h3></div>
        <div class="card-body">
            <div class="chart-bars">
                <?php foreach($grafico_ventas as $gv): $maxV=8; ?>
                <div class="chart-bar-group">
                    <div class="chart-bar-container"><div class="chart-bar blue" style="height:<?= ($gv['valor']/$maxV)*100 ?>%;"></div></div>
                    <div class="chart-bar-label"><?= $gv['mes'] ?></div>
                    <div class="chart-bar-value"><?= $gv['valor'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3 class="card-title">Alquileres Mensuales</h3></div>
        <div class="card-body">
            <div class="chart-bars">
                <?php foreach($grafico_alquileres as $ga): $maxA=15; ?>
                <div class="chart-bar-group">
                    <div class="chart-bar-container"><div class="chart-bar teal" style="height:<?= ($ga['valor']/$maxA)*100 ?>%;"></div></div>
                    <div class="chart-bar-label"><?= $ga['mes'] ?></div>
                    <div class="chart-bar-value"><?= $ga['valor'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;margin-bottom:1.5rem;">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Captación de Leads</h3></div>
        <div class="card-body">
            <div class="chart-bars">
                <?php foreach($grafico_leads as $gl): $maxL=22; ?>
                <div class="chart-bar-group">
                    <div class="chart-bar-container"><div class="chart-bar purple" style="height:<?= ($gl['valor']/$maxL)*100 ?>%;"></div></div>
                    <div class="chart-bar-label"><?= $gl['mes'] ?></div>
                    <div class="chart-bar-value"><?= $gl['valor'] ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3 class="card-title">Rendimiento por Corredor</h3></div>
        <div class="card-body">
            <?php
            $topAgentes = array_slice($agentes, 0, 5);
            $maxOps = max(array_map(fn($a) => $a['ventas']+$a['alquileres'], $topAgentes));
            foreach($topAgentes as $a):
                $ops = $a['ventas'] + $a['alquileres'];
            ?>
            <div style="display:flex;align-items:center;gap:.75rem;margin-bottom:.6rem;">
                <span style="width:110px;font-size:.8rem;font-weight:600;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;"><?= $a['nombre'] ?></span>
                <div style="flex:1;height:18px;background:var(--gray-100);border-radius:4px;overflow:hidden;">
                    <div style="height:100%;background:linear-gradient(90deg,#3b82f6,#10b981);width:<?= ($ops/$maxOps)*100 ?>%;border-radius:4px;"></div>
                </div>
                <span style="font-size:.8rem;font-weight:700;width:30px;text-align:right;"><?= $ops ?></span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Tablas de reportes adicionales -->
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">
    <div class="card">
        <div class="card-header"><h3 class="card-title">Propiedades Más Consultadas</h3></div>
        <div class="card-body">
            <?php foreach(array_slice($propiedades, 0, 5) as $i => $p): ?>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;<?= $i < 4 ? 'border-bottom:1px solid var(--gray-100);' : '' ?>">
                <div><strong style="font-size:.85rem;"><?= $p['codigo'] ?></strong> <span style="font-size:.8rem;color:var(--gray-500);"><?= $p['titulo'] ?></span></div>
                <span class="badge badge-primary"><?= rand(8,25) ?> consultas</span>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="card">
        <div class="card-header"><h3 class="card-title">Morosidad</h3></div>
        <div class="card-body">
            <?php $morosos = array_filter($pagos, fn($p) => $p['estado']==='Vencido');
            foreach(array_slice($morosos, 0, 5) as $p): ?>
            <div style="display:flex;justify-content:space-between;align-items:center;padding:.5rem 0;border-bottom:1px solid var(--gray-100);">
                <div><strong style="font-size:.85rem;"><?= $p['pagador'] ?></strong><br><span style="font-size:.75rem;color:var(--gray-500);"><?= $p['propiedad'] ?></span></div>
                <span style="font-weight:700;color:#ef4444;"><?= formatMoney($p['monto']) ?></span>
            </div>
            <?php endforeach; ?>
            <?php if(count($morosos) === 0): ?>
            <div style="text-align:center;padding:2rem;color:var(--gray-400);"><i class="fas fa-check-circle" style="font-size:2rem;"></i><br>Sin morosidad</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Panel de exportación -->
<div class="card" style="margin-top:1.5rem;">
    <div class="card-header"><h3 class="card-title">Centro de Exportación</h3></div>
    <div class="card-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:1rem;">
            <?php
            $exports = [
                ['Reporte de Ventas','fa-shopping-cart','#10b981'],
                ['Reporte de Alquileres','fa-key','#0d9488'],
                ['Reporte de Comisiones','fa-coins','#f59e0b'],
                ['Reporte de Leads','fa-user-plus','#3b82f6'],
                ['Reporte de Pagos','fa-dollar-sign','#8b5cf6'],
                ['Reporte de Morosidad','fa-exclamation-triangle','#ef4444'],
            ];
            foreach($exports as $ex): ?>
            <button class="btn btn-secondary" style="display:flex;align-items:center;gap:.5rem;justify-content:flex-start;padding:.75rem 1rem;">
                <i class="fas <?= $ex[1] ?>" style="color:<?= $ex[2] ?>;"></i>
                <span><?= $ex[0] ?></span>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</div>
