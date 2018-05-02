<?php
return array(
  "nombre" => "paginas",
  "descripcion" => "Administra las páginas html de tu sitio web.",
  "require" => ["users"],
  "version" => 0.1,
  "menu" => array(
    "Paginas" => array(
      "icon"   => "<i class='far fa-file'></i>",
      "url"  => "",
      "submenu" => array(
        "Ver paginas" => array(
          "icon"   => "",
          "url"  => "backend/paginas",
        ),
        "Agregar paginas" => array(
          "icon"   => "",
          "url"  => "backend/paginas/agregar",
        )
      )
    )
  )
);