<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

  public function __construct(){
    parent::__construct();
    
    Admin_helper::is_admin($this->session->userdata('rol_id'));

    $this->load->library('breadcrumbs');
    $this->breadcrumbs->push('Home', '/backend/');

    $this->load->helper('html');
    $this->load->helper('url_helper');
    $this->load->helper('directory');
    
    $this->data = array(
      "title" => 'Administrar módulos',
      "menu"  => menu_backend('Módulos')
    );
  }


  public function index(){
    $modulos = array();
    $map = directory_map('./application/modules/', 1);
    foreach ($map as $key => $value) {
      if(strpos($value, '.') === FALSE){
        if($string = @file_get_contents('./application/modules/'.$value.'info.json')){
          $array = json_decode($string, true);
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

    $this->breadcrumbs->push('Modulos', '/backend/modulos/');
    $this->breadcrumbs->show();

    $this->data['modulos'] = $modulos;
    $this->data['content'] = $this->load->view('../../views/ver_modulos', $this->data, true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }
}