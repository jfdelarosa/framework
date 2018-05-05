<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backend extends CI_Controller {

  public function __construct(){
    parent::__construct();

    $this->load->helper('html');
    $this->load->helper('url_helper');
    $this->load->model('users_model');
    
    $this->data = array(
      "modulo"=> "usuarios",
      "title" => "Administrar usuarios"
    );
  }

  public function install(){
    $permisos = array(
      array("ver_paginas" => ""),
      array("editar_paginas" => ""),
      array("agregar_paginas" => ""),
      array("ver_usuarios" => ""),
      array("editar_usuarios" => ""),
      array("agregar_usuarios" => ""),
      array("ver_modulos" => ""),
      array("ver_permisos" => "")
    );

    foreach($permisos as $permiso => $desc){
      $this->aauth->create_perm($permiso, $desc);
    }

    redirect("/backend/usuarios");
  }

  public function index(){
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('ver_usuarios'))){
      redirect("/login");
    }

    $this->load->library('Smartgrid');

    $tabla = $this->users_model->get_usuarios();
    $columns = array(
      "username"   => array("header" => "Nombre de usuario",  "type" => "custom", "field_data" => '<a href="/backend/usuarios/editar/{username}">{username}</a>'),
      "email"      => array("header" => "Correo electrónico", "type" => "label"),
      "last_login" => array("header" => "Último inicio de sesión", "type" => "relativedate")
    );        
        
    $this->smartgrid->set_grid($tabla, $columns);
    $this->data['tabla'] = $this->smartgrid->render_grid();

    $this->data['content'] = $this->load->view('../../views/ver_usuarios', $this->data, true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }

  public function agregar(){
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('agregar_usuarios'))){
      redirect("/login");
    }

    $this->load->helper('form');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Nombre de usuario', 'required');
    $this->form_validation->set_rules('email', 'Correo', 'required');
    $this->form_validation->set_rules('password', 'Contraseña', 'required');
    $this->form_validation->set_rules('repeat', 'Repetir contraseña', 'required|matches[password]');
    $this->form_validation->set_error_delimiters('<div class="invalid-feedback">', '</div>');

    if($this->form_validation->run() === TRUE){
      $username = $this->input->post('username');
      $email = $this->input->post('email');
      $password = $this->input->post('password');

      if($id = $this->aauth->create_user($email, $password, $username)){
        redirect("/backend/usuarios/editar/" . $username);
      }else{
        $this->data['alert'] = array('type' => 'bg-warning', 'text' => 'Hubo un error al agregar el usuario.');
      }
    }
    $this->data['content'] = $this->load->view('../../views/agregar_usuarios', '', true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }

  public function editar($username){
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('editar_usuarios'))){
      redirect("/login");
    }
    $this->db->select('*');
    $this->db->where("username", $username);
    $return = $this->db->get('aauth_users');
    $user = $return->result_array()[0];

    $permisos = array();
    $perms = json_decode(json_encode($this->aauth->list_perms()), true);
    foreach ($perms as $perm) {
      $perm['allowed'] = false;
      if($this->aauth->is_allowed($perm['name'], $user['id'])){
        $perm['allowed'] = true;
      }
      array_push($permisos, $perm);
    }

    $this->data['permisos'] = $permisos;
    $this->data['content'] = $this->load->view('../../views/ver_usuario', $this->data, true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }

  public function permisos(){
    if(!($this->aauth->is_member('Admin') || $this->aauth->control('ver_permisos'))){
      redirect("/login");
    }
    $a = $this->aauth->list_perms();
    print_r($a);
  }
}