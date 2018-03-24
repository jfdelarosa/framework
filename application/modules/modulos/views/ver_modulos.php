<div class="row">
<?php foreach($modulos as $modulo): ?>
<div class="col-sm-6 col-md-4">
  <div class="card">
    <div class="card-header">
      <?php echo $modulo['nombre']; ?>
    </div>
    <div class="card-body">
      <p><?php echo $modulo['descripcion']; ?></p>
      <small>Versión <?php echo $modulo['version']; ?></small>
    </div>
    <div class="card-footer">
      <button class="btn btn-sm btn-success"><i class="fa fa-lightbulb-o"></i> Actualizar</button>
      <button class="pull-right btn btn-sm btn-danger"><i class="fa fa-trash"></i> Eliminar</button>
    </div>
  </div>
</div>
<?php endforeach; ?>
</div>