<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->helper('html');

    $this->load->library('breadcrumbs');
    $this->breadcrumbs->push('Home', '/backend/');

    $this->data = array(
      "title" => "Inicio",
      "menu"  => menu_backend('home')
    );

    if($this->session->userdata('rol_id') == FALSE || $this->session->userdata('rol_id') != 1){
      redirect('../login');
    }

  }

  public function index(){
    $this->breadcrumbs->show();
    
    $this->data['content'] = $this->load->view('../../views/home', '', true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }
}
