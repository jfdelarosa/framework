<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

  public function __construct(){
    parent::__construct();
    
    $this->load->helper('html');

    if(!$this->aauth->is_loggedin()){
      redirect("../login");
    }

    $this->data = array(
      "modulo"=> "home",
      "title" => "Inicio"
    );

  }

  public function index(){
    $this->data['content'] = $this->load->view('../../views/home', '', true);
    $this->load->view(TEMPLATE_URL, $this->data);
  }
}
