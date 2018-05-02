<?php
return $items['Usuarios'] = array(
  'icon' => '<i class="far fa-user-circle"></i>',
  'url' => '',
  'submenu' => array(
    'Ver usuarios' => array(
      'icon' => '',
      'url' => '/backend/usuarios'
    ),
    'Agregar usuarios' => array(
      'icon' => '',
      'url' => '/backend/usuarios/agregar'
    ),
    'Roles' => array(
      'icon' => '',
      'url' => '/backend/usuarios/roles'
    )
  )
);