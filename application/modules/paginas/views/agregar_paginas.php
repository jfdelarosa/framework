<?php echo form_open('backend/paginas/agregar', array('id' => 'paginas')); ?>
<div class="row">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agregar página</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label class="form-label" for="page-title">Titulo</label>
          <input class="form-control" name="page-title" id="page-title" value="<?php echo set_value('page-title'); ?>" placeholder="Ingresa el titulo de la pagina." />
          <?php echo form_error('page-title'); ?>
        </div>
        <div class="form-group">
          <label class="form-label" for="page-slug">URL</label>
          <input class="form-control" name="page-slug" id="page-slug" value="<?php echo set_value('page-slug'); ?>" placeholder="Ingresa la url de la pagina." />
          <?php echo form_error('page-slug'); ?>
        </div>
        <div class="form-group">
          <label class="form-label" for="page-content">Contenido</label>
          <textarea name="page-content" id="page-content" class="js-st-instance"><?php echo set_value('page-content'); ?></textarea>
          <!-- <textarea name="page-content" id="page-content" class="form-control" placeholder="Ingresa el contenido de la pagina."><?php echo set_value('page-content'); ?></textarea> -->
          <?php echo form_error('page-content'); ?>
        </div>
      </div>
    </div>

  </div>
  <div class="col-md-3">
    <div class="card">
      <div class="card-header">
        <i class="fa fa-cog"></i> Opciones
      </div>
      <div class="card-body">
      Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
      </div>
      <div class="card-footer">
          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Guardar página</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>