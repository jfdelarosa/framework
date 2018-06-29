<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->model('paginas_model');
    $this->load->helper(array('html', 'url_helper'));
    
    $this->data = array(
      "modulo"  => "paginas",
      "title"   => "Administrar paginas",
      "scripts" => array("/assets/js/jquery.validate.min.js")
    );
  }

  public function install(){
    $this->load->dbforge();
    $prefix = "producto_";
    $fields = array(
      $prefix . 'id' => array(
        'type' => 'INT',
        'constraint' => 3,
        'auto_increment' => TRUE
      ),
      $prefix . 'name' => array(
        'type' => 'VARCHAR',
        'constraint' => 100
      ),
      $prefix . 'created' => array(
        'type' => 'TIMESTAMP'
      ),
      $prefix . 'created_by' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'constraint' => 11
      ),
      $prefix . 'edited' => array(
        'type' => 'TIMESTAMP'
      ),
      $prefix . 'edited_by' => array(
        'type' => 'INT',
        'unsigned' => TRUE,
        'constraint' => 11
      ),
      $prefix . 'edited_count' => array(
        'type' => 'INT',
        'constraint' => 4
      ),
      $prefix . 'precio_compra' => array(
        'type' => 'FLOAT',
        'constraint' => '10, 2',
        'default' => 0
      ),
      $prefix . 'precio_venta' => array(
        'type' => 'FLOAT',
        'constraint' => '10, 2',
        'default' => 0
      ),
      $prefix . 'precio_minimo' => array(
        'type' => 'FLOAT',
        'constraint' => '10, 2',
        'default' => 0
      ),
      $prefix . 'codigo' => array(
        'type' => 'VARCHAR',
        'constraint' => 50
      ),
      $prefix . 'existencia' => array(
        'type' => 'INT',
        'constraint' => 5
      ),
      $prefix . 'status' => array(
        'type' => 'INT',
        'default' => 1,
        'constraint' => 1
      )
    );
    $this->dbforge->add_field($fields);
    $this->dbforge->add_key('producto_id', true);
    $this->dbforge->add_foreign_key(
      array(
        array(
          'field' => $prefix . 'created_by',
          'foreign_table' => 'aauth_users',
          'foreign_field' => 'id',
        ),
        array(
          'field' => $prefix . 'edited_by',
          'foreign_table' => 'aauth_users',
          'foreign_field' => 'id',
        )
      )
    );
    $this->dbforge->create_table('productos', true);
  }

  public function index(){
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('ver_paginas'))){
      redirect("/login");
    }

    $this->load->library('Smartgrid');

    $tabla = $this->paginas_model->get_paginas(); 

    $columns = array(
      //"page_id"           => array("header" => "ID",                "type" => "label"),
      "product_name"       => array("header" => "Nombre del producto",    "type" => "customtitle"),
      "product_price_buy"  => array("header" => "Precio de compra",       "type" => "custom", "field_data" => '<span class="avatar" title="{created_by}">JF</span>'),
      "product_price_sell" => array("header" => "Precio de venta",        "type" => "label"),
      "product_price_min"  => array("header" => "Precio de venta mínimo", "type" => "custom", "field_data" => "{edited_by}"),
      "product_code"     => array("header" => "Código en sistema",      "type" => "status"),
      "product_slug"       => array("header" => "Opciones",               "type" => "custom", "field_data" => '
      <div class="btn-group btn-group-sm">
      <a href="paginas/editar/{page_id}" class="btn btn-success"><i class="far fa-edit"></i></a>
      <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
      </div>')
    );        
        
    $this->smartgrid->set_grid($tabla, $columns);
    $this->data['tabla'] = $this->smartgrid->render_grid();

    $this->data['content'] = $this->load->view('../../views/ver_paginas', $this->data, true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }

  public function agregar(){
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('agregar_paginas'))){
      redirect("/login");
    }

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('page-title', 'Titulo', 'required');
    $this->form_validation->set_rules('page-slug', 'URL', 'required');
    $this->form_validation->set_rules('page-content', 'Contenido', 'required');
    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

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
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('editar_paginas'))){
      redirect("/login");
    }

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('page-title', 'Titulo', 'required');
    $this->form_validation->set_rules('page-slug', 'URL', 'required');
    $this->form_validation->set_rules('page-content', 'Contenido', 'required');
    $this->form_validation->set_error_delimiters('<span class="help-block">', '</span>');

    $this->data['page_id'] = $page_id;
    $this->data['pagina'] = $this->paginas_model->get_pagina("page_id", $page_id);

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
