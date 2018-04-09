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
    
    $this->data = array(
      "modulo"=> "usuarios",
      "title" => "Administrar usuarios"
    );
  }


  public function index(){
    $this->load->library('Smartgrid');

    $this->breadcrumbs->push('Paginas', '/backend/usuarios/');
    $this->breadcrumbs->show();


    $columns = array(
      "id"     => array("header" => "ID",    "type" => "label"),
      "fecha"  => array("header" => "fecha", "type" => "label"),
      "texto"  => array("header" => "texto", "type" => "label")
    );        
        
    $this->smartgrid->set_grid("SELECT * FROM test", $columns);
    $this->data['tabla'] = $this->smartgrid->render_grid();

    $this->data['content'] = $this->load->view('../../views/ver_usuarios', $this->data, true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }

  public function agregar(){
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('page-title', 'Titulo', 'required');
    $this->form_validation->set_rules('page-slug', 'URL', 'required');
    $this->form_validation->set_rules('page-content', 'Contenido', 'required');
    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

    $this->breadcrumbs->push('Paginas', '/backend/paginas/');
    $this->breadcrumbs->push('Agregar pagina', '/backend/paginas/agregar');
    $this->breadcrumbs->show();

    $this->data['scripts'] = array("/assets/js/agregar_paginas.js");

    if($this->form_validation->run() === TRUE){
      if($this->paginas_model->create_page()){
        $this->data['alert'] = array('type' => 'bg-success', 'text' => 'La pagina se ha agregado correctamente.');
      }else{
        $this->data['alert'] = array('type' => 'bg-warning', 'text' => 'Hubo un error al agregar la pagina.');
      }
    }
    $this->data['content'] = $this->load->view('../../views/agregar_paginas', '', true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }

  public function editar($page_id = NULL){
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('page-title', 'Titulo', 'required');
    $this->form_validation->set_rules('page-slug', 'URL', 'required');
    $this->form_validation->set_rules('page-content', 'Contenido', 'required');
    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

    $this->breadcrumbs->push('Paginas', '/backend/paginas/');
    $this->breadcrumbs->push('Editar página', '/backend/paginas/editar');
    $this->breadcrumbs->push($page_id, '/backend/paginas/'.$page_id);
    $this->breadcrumbs->show();


    $this->data['page_id'] = $page_id;
    $this->data['pagina'] = $this->paginas_model->get_pagina($page_id);
    $this->data['scripts'] = array("/assets/js/agregar_paginas.js");

    if($this->data['pagina'] === NULL){
      $this->data['alert'] = array('type' => 'bg-danger', 'text' => 'La pagina no se encuentra.');
    }else{
      if($this->form_validation->run() === TRUE){
        if($this->paginas_model->edit_page($page_id)){
          $this->data['alert'] = array('type' => 'bg-success', 'text' => 'La pagina se ha editado correctamente.');
        }else{
          $this->data['alert'] = array('type' => 'bg-warning', 'text' => 'Hubo un error al editar la pagina.');
        }
      }
      $this->data['content'] = $this->load->view('../../views/editar_paginas', $this->data, true);
    }
    $this->load->view(TEMPLATE_URL, $this->data);
  }
}
