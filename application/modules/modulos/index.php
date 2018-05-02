<?php
return array(
  "nombre" => "modulos",
  "descripcion" => "Administra los módulos instalados.",
  "require" => ["users"],
  "version" => 0.1,
  "menu" => array(
    "Módulos" => array(
      "icon"   => "<i class='fe fe-box'></i>",
      "url"  => "backend/modulos"
    )
  )
);