<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" href="#"><i class="icon-list"></i> Inicio</a>
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
  <?php if(sizeof($paginas) == 0): ?>

  No hay paginas creadas.

  <?php else: ?>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>Fecha de creación</th>
            <th>Creada por</th>
            <th>Ediciones</th>
            <th>Última edición</th>
            <th>Editada por</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
  <?php foreach($paginas as $pagina): ?>
          <tr>
            <td><?php echo $pagina["page_id"]; ?></td>
            <td><a href="/backend/paginas/editar/<?php echo $pagina["page_id"]; ?>"><?php echo $pagina["page_title"]; ?></a></td>
            <td><?php echo $pagina["page_created"]; ?></td>
            <td><?php echo $pagina["page_created_by"]; ?></td>
            <td><?php echo ($pagina["page_edited_count"] == 0) ? "-" : $pagina["page_edited_count"]; ?></td>
            <td><?php echo ($pagina["page_edited"] == 0) ? "-" : $pagina["page_edited"]; ?></td>
            <td><?php echo ($pagina["page_edited_by"] == 0) ? "-" : $pagina["page_edited_by"]; ?></td>
            <td><?php echo ($pagina["page_status"] == 1) ? '<span class="badge badge-success">Activa</span>' : '<span class="badge badge-secondary">Inactiva</span>'; ?></td>
          </tr>
  <?php endforeach; ?>
        </tbody>
      </table>
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="#">Prev</a>
        </li>
        <li class="page-item active">
          <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">2</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">3</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">4</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">Next</a>
        </li>
      </ul>
  <?php endif; ?>
  </div>
</div>