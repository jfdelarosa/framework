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
    $check_user = $this->users_model->login("jfdelarosa", "pass");
    if($this->session->userdata('rol_id') == 1){
      //redirect('../backend');
    }

    $this->form_validation->set_rules('username', 'nombre de usuario', 'required');
    $this->form_validation->set_rules('password', 'password', 'required');
    if($this->form_validation->run() === TRUE){
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $check_user = $this->users_model->login($username, $password);

      if(is_array($check_user) AND $check_user['error']){
        $this->data['error'] = $check_user['mensaje'];
      }else{
        $user_data = $this->users_model->get_data($check_user);
        $data = array(
          'is_logued_in'  =>  TRUE,
          'user_id'       =>  $user_data->user_id,
          'rol_id'        =>  $user_data->rol_id,
          'user_username' =>  $user_data->user_username
        );

        $this->session->set_userdata($data);
        redirect('../backend');
      }
    }

    $this->load->view('../../views/login', $this->data);
  }

  public function logout(){
    $this->session->unset_userdata('isUserLoggedIn');
    $this->session->unset_userdata('userId');
    $this->session->sess_destroy();
    redirect('../login');
  }
}
