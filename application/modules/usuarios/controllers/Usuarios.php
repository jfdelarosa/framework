<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {
  
  public function __construct(){
    parent::__construct();
    $this->load->helper('html');
    $this->load->library('form_validation');
    $this->load->model('users_model');
    $this->data = array("title" => "Inicio de sesión");
  }
  
  public function index(){
    if($this->aauth->is_loggedin()){
      redirect('../backend');
    }
    $this->form_validation->set_rules('username', 'nombre de usuario', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    if($this->form_validation->run() === TRUE){
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      if($this->aauth->login($username, $password, true)){
        redirect('../backend');
      }else{
        $this->data['error'] = "error";
      }
    }

    $this->load->view('../../views/login', $this->data);
  }

  public function logout(){
    $this->aauth->logout();
    redirect('../login');
  }
}
