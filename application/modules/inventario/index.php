<?php
return array(
  "nombre" => "inventario",
  "descripcion" => "Administra las páginas html de tu sitio web.",
  "require" => ["users"],
  "version" => 0.1,
  "menu" => array(
    "Inventario" => array(
      "icon"   => "<i class='far fa-file'></i>",
      "url"  => "",
      "submenu" => array(
        "Ver productos" => array(
          "icon"   => "",
          "url"  => "backend/inventario",
        ),
        "Agregar producto" => array(
          "icon"   => "",
          "url"  => "backend/inventario/agregar",
        )
      )
    )
  )
);