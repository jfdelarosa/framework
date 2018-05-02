<?php
return array(
  "nombre" => "usuarios",
  "descripcion" => "Administra los usuarios y roles.",
  "version" => 0.1,
  "menu" => array(
    "Usuarios" => array(
      "icon" => "<i class='far fa-user-circle'></i>",
      "url" => "",
      "submenu" => array(
        "Ver usuarios" => array(
          "icon" => "",
          "url" => "backend/usuarios"
        ),
        "Agregar usuarios" => array(
          "icon" => "",
          "url" => "backend/usuarios/agregar"
        ),
        "Roles" => array(
          "icon" => "",
          "url" => "backend/usuarios/roles"
        )
      )
    )
  )
);