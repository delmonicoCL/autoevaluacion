<!-- Modal -->
<div class="modal fade" id="FormularioModal" tabindex="-1" role="dialog" aria-labelledby="FormularioModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="FormularioModalLabel">Formulario de Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre">
          </div>
          <div class="form-group">
            <label for="contraseña">Contraseña</label>
            <input type="password" class="form-control" id="contraseña" placeholder="Ingrese su contraseña">
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" placeholder="Ingrese su correo">
          </div>
          <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" placeholder="Ingrese su apellido">
          </div>
          <div class="form-group">
            <label for="estado">Estado</label>
            <select class="form-control" id="estado">
              <option value="1">Activo</option>
              <option value="2">No Activo</option>
            </select>
          </div>
          <div class="form-group">
            <label for="tipo_usuario">Tipo de Usuario</label>
            <select class="form-control" id="tipo_usuario">
              <option value="1">Administrador</option>
              <option value="2">Profesor</option>
              <option value="3">Alumno</option>
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
