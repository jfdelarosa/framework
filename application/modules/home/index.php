<?php
return array(
  "nombre" => "home",
  "descripcion" => "Dashboard del sitio web",
  "require" => ["users"],
  "version" => "0.1",
  "menu" => array(
    "Inicio" => array(
      "icon" => "<i class='fas fa-home'></i>",
      "url" => "/backend/",
    ),
  ),
);