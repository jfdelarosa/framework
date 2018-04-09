<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct(){
    parent::__construct();
    Admin_helper::is_admin($this->session->userdata('rol_id'));
    
    $this->load->helper('html');
    $this->load->library('breadcrumbs');


    $this->breadcrumbs->push('Home', '/backend/');

    $this->data = array(
      "modulo"=> "home",
      "title" => "Inicio"
    );

  }

  public function index(){
    $this->breadcrumbs->show();
    
    $this->data['content'] = $this->load->view('../../views/home', '', true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }
}
