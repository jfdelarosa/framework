<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->helper('html');
    $this->load->helper('url_helper');
    $this->load->helper('directory');
    
    $this->data = array(
      "modulo"=> "modulos",
      "title" => 'Administrar módulos'
    );
  }

  public function index(){
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('ver_modulos'))){
      redirect("/login");
    }
    
    $this->load->library('Smartgrid');


    $modulos = array();
    $map = directory_map('./application/modules/', 1);
    foreach ($map as $key => $value) {
      if(strpos($value, '.') === FALSE){
        if(file_exists('./application/modules/'.$value.'index.php')){
          $array = include('./application/modules/'.$value.'index.php');
        }else{
          $array = array(
            "nombre"      => rtrim($value, '\\'),
            "descripcion" => "Sin descripción",
            "version"     => "0"
          );
        }
        array_push($modulos, $array);
      }
    }

    $columns = array(
      "nombre"      => array("header" => "Nombre",      "type" => "custom", "field_data" => '<div>{nombre}</div><div class="small text-muted">Versión {version}</div>'),
      "descripcion" => array("header" => "Descripción", "type" => "label"),
      "version"     => array("header" => "Opciones",    "type" => "custom", "field_data" => '
      <a href="/paginas/{nombre}" target="_BLANK" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
      <a href="paginas/editar/{nombre}" class="btn btn-sm btn-success"><i class="far fa-edit"></i></a>
      <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>')
    );  

    $this->smartgrid->set_grid($modulos, $columns);
    $this->data['tabla'] = $this->smartgrid->render_grid();

    $this->data['content'] = $this->load->view('../../views/ver_modulos', $this->data, true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }
}