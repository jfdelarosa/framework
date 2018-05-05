
<div class="row">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Editar usuario</h3>
      </div>
      <div class="card-body">

        <div class="form-group">
          <div class="custom-switches-stacked">
            <?php foreach($permisos as $permiso): ?>
              <label class="custom-switch">
                <input type="checkbox" name="<?php echo $permiso['name']; ?>" value="<?php echo ($permiso['allowed']) ? 1 : 0; ?>" class="custom-switch-input" <?php echo ($permiso['allowed']) ? "checked" : ""; ?>>
                <span class="custom-switch-indicator"></span>
                <span class="custom-switch-description"><?php echo $permiso['name']; ?></span>
              </label>
            <?php endforeach; ?>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-header">
        Opciones
      </div>
      <div class="card-body">
      Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Guardar usuario</button>
      </div>
    </div>
  </div>
</div>