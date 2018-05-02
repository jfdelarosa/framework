<?php echo form_open('backend/usuarios/agregar'); ?>
<div class="row">
  <div class="col-md-9">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Agregar usuario</h3>
      </div>
      <div class="card-body">
      <div class="form-group">
          <?php
          echo form_label('Nombre de usuario', 'username', ['class' => 'form-label']);
          echo form_input(['name' => 'username', 'class' => 'form-control', 'value' => set_value('username'), 'placeholder' => 'Ingresa el nombre de usuario']);
          echo form_error('username');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Correo electrónico', 'email', ['class' => 'form-label']);
          echo form_input(['name' => 'email', 'class' => 'form-control', 'value' => set_value('email'), 'placeholder' => 'Ingresa el correo electrónico']);
          echo form_error('email');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Contraseña', 'password', ['class' => 'form-label']);
          echo form_password(['name' => 'password', 'class' => 'form-control', 'value' => set_value('password'), 'placeholder' => 'Ingresa la contraseña']);
          echo form_error('password');
          ?>
        </div>
        <div class="form-group">
          <?php
          echo form_label('Repetir contraseña', 'repeat', ['class' => 'form-label']);
          echo form_password(['name' => 'repeat', 'class' => 'form-control', 'value' => set_value('repeat'), 'placeholder' => 'Repetir contraseña']);
          echo form_error('repeat');
          ?>
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
<?php echo form_close(); ?>