<div class="card">
  <div class="card-header">
    <i class="fa fa-align-justify"></i> Usuarios
  </div>
  <div class="card-body">
<?php if(sizeof($usuarios) == 0): ?>

No hay usuarios creadas.

<?php else: ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titulo</th>
          <th>Fecha de creación</th>
          <th>Creada por</th>
          <th>Última edición</th>
          <th>Editada por</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
<?php foreach($usuarios as $usuario): ?>
        <tr>
          <td><?php echo $usuario["page_id"]; ?></td>
          <td><a href="/backend/paginas/editar/<?php echo $pagina["page_id"]; ?>"><?php echo $usuario["page_title"]; ?></a></td>
          <td><?php echo $usuario["page_created"]; ?></td>
          <td><?php echo $usuario["page_created_by"]; ?></td>
          <td><?php echo ($usuario["page_edited"] == 0) ? "-" : $usuario["page_edited"]; ?></td>
          <td><?php echo ($usuario["page_edited_by"] == 0) ? "-" : $usuario["page_edited_by"]; ?></td>
          <td><?php echo ($usuario["page_status"] == 1) ? '<span class="badge badge-success">Activa</span>' : '<span class="badge badge-secondary">Inactiva</span>'; ?></td>
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
