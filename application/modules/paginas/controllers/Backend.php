<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

  public function __construct(){
    parent::__construct();

    Admin_helper::is_admin($this->session->userdata('rol_id'));

    $this->load->library('breadcrumbs');
    $this->breadcrumbs->push('Home', '/backend/');

    $this->load->model('paginas_model');

    $this->load->helper(array('html', 'url_helper'));
    
    $this->data = array(
      "modulo"  => "paginas",
      "title"   => "Administrar paginas",
      "menu"    => menu_backend('paginas'),
      "scripts" => array("/assets/js/jquery.validate.min.js")
    );
  }

  public function index(){
    $this->load->library('Smartgrid');
 
    $this->breadcrumbs->push('Paginas', '/backend/paginas');
    $this->breadcrumbs->show();

    $tabla = $this->paginas_model->get_paginas(); 

    $columns = array(
      //"page_id"           => array("header" => "ID",                "type" => "label"),
      "page_title"        => array("header" => "Titulo",            "type" => "link", "href" => "backend/paginas/editar/{page_id}"),
      "page_created"      => array("header" => "Fecha de creación", "type" => "relativedate"),
      "page_created_by"   => array("header" => "Creada por",        "type" => "custom", "field_data" => "{created_by}"),
      "page_edited_count" => array("header" => "Ediciones",         "type" => "label"),
      "page_edited"       => array("header" => "Última edición",    "type" => "customdate"),
      "page_edited_by"    => array("header" => "Editada por",       "type" => "custom", "field_data" => "{edited_by}"),
      "page_status"       => array("header" => "Status",            "type" => "status")
    );        
        
    $this->smartgrid->set_grid($tabla, $columns);
    $this->data['tabla'] = $this->smartgrid->render_grid();

    $this->data['content'] = $this->load->view('../../views/ver_paginas', $this->data, true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }

  public function agregar(){
    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('page-title', 'Titulo', 'required');
    $this->form_validation->set_rules('page-slug', 'URL', 'required');
    $this->form_validation->set_rules('page-content', 'Contenido', 'required');
    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

    $this->breadcrumbs->push('Paginas', '/backend/paginas');
    $this->breadcrumbs->push('Agregar pagina', '/backend/paginas/agregar');
    $this->breadcrumbs->show();

    if($this->form_validation->run() === TRUE){
      if($id = $this->paginas_model->create_page()){
        redirect("/backend/paginas/editar/" . $id);
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

    $this->data['page_id'] = $page_id;
    $this->data['pagina'] = $this->paginas_model->get_pagina("page_id", $page_id);

    $this->breadcrumbs->push('Paginas', '/backend/paginas');
    $this->breadcrumbs->push('Editar página', '/backend/paginas');
    $this->breadcrumbs->push($this->data['pagina']['page_title'], '/backend/paginas/'.$page_id);
    $this->breadcrumbs->show();

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

  public function slug(){
    if(isset($_GET['page_id']) && $_GET['page_id'] != ""){
      echo ($this->paginas_model->slug_exists($_GET['slug'], $_GET['page_id']))? 0 : 1;
    }else{
      echo ($this->paginas_model->slug_exists($_GET['slug']))? 0 : 1;
    } 
  }
}
