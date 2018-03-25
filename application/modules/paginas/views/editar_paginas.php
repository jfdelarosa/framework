<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#"><i class="icon-pencil"></i> Editar página</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/backend/paginas/"><i class="icon-list"></i> Inicio</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/backend/paginas/agregar"><i class="icon-plus"></i> Agregar página</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="/backend/paginas/ajustes"><i class="icon-settings"></i> Ajustes</a>
  </li>
</ul>
<div class="tab-content">
  <div class="tab-pane active">
    <?php echo form_open('backend/paginas/editar/'.$page_id); ?>
      <div class="form-group">
        <label for="page-title">Titulo</label>
        <input class="form-control" name="page-title" id="page-title" value="<?php echo set_value('page-title', $pagina['page_title']); ?>" placeholder="Ingresa el titulo de la pagina." />
        <?php echo form_error('page-title'); ?>
      </div>
      <div class="form-group">
        <label for="page-slug">URL</label>
        <input class="form-control" name="page-slug" id="page-slug" value="<?php echo set_value('page-slug', $pagina['page_slug']); ?>" placeholder="Ingresa la url de la pagina." />
        <?php echo form_error('page-slug'); ?>
      </div>
      <div class="form-group">
        <label for="page-content">Contenido</label>
        <textarea name="page-content" id="page-content" class="form-control" placeholder="Ingresa el contenido de la pagina."><?php echo set_value('page-content', $pagina['page_content']); ?></textarea>
        <?php echo form_error('page-content'); ?>
      </div>
      <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-dot-circle-o"></i> Submit</button>
      <button type="reset" class="btn btn-sm btn-danger"><i class="fa fa-ban"></i> Reset</button>
    <?php echo form_close(); ?>
  </div>
</div>