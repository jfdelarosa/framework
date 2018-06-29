<?php echo form_open('/backend/paginas/editar/'.$page_id, array('id' => 'paginas')); ?>
<div class="row">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Edición de página</h3>
      </div>
      <div class="card-body">
        <div class="form-group">
          <label class="form-label" for="page-title">Titulo</label>
          <input class="form-control" name="page-title" id="page-title" value="<?php echo set_value('page-title', $pagina['page_title']); ?>" placeholder="Ingresa el titulo de la pagina." />
          <?php echo form_error('page-title'); ?>
        </div>
        <div class="form-group">
          <label class="form-label" for="page-slug">URL</label>
          <div class="input-group">
            <span class="input-group-prepend" id="basic-addon3">
              <span class="input-group-text"><?php echo base_url("paginas/"); ?></span>
            </span>
            <input class="form-control" type="text" name="page-slug" id="page-slug" value="<?php echo set_value('page-slug', $pagina['page_slug']); ?>" placeholder="Ingresa la url de la pagina.">
          </div>
          <?php echo form_error('page-slug'); ?>
        </div>
        <div class="form-group">
          <label class="form-label" for="page-content">Contenido</label>
          <textarea name="page-content" id="page-content" class="js-st-instance"><?php echo set_value('page-content', $pagina['page_content']); ?></textarea>
          <?php echo form_error('page-content'); ?>
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
          <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Guardar página</button>
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>