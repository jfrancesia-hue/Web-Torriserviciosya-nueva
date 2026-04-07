<!-- Modal reutilizable para ofrecer presupuesto -->
<div class="modal fade" id="ofrecerPresupuestoModal" tabindex="-1" aria-labelledby="ofrecerPresupuestoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ofrecerPresupuestoLabel">Ofrecer Presupuesto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formOfrecerPresupuesto">
        <div class="modal-body">
          <input type="hidden" id="ofertaIdPresupuesto" name="oferta_id">
          <div class="mb-3">
            <label for="precioPresupuesto" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precioPresupuesto" name="precio" required min="0">
          </div>
          <div class="mb-3">
            <label for="descripcionPresupuesto" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcionPresupuesto" name="descripcion" rows="2" required></textarea>
          </div>
          <div class="mb-3">
            <label for="horariosPresupuesto" class="form-label">Horarios libres hoy</label>
            <input type="text" class="form-control" id="horariosPresupuesto" name="horarios" placeholder="Ej: 14:00-16:00, 18:00-20:00" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Enviar Presupuesto</button>
        </div>
      </form>
    </div>
  </div>
</div>
