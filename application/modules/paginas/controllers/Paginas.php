<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paginas extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('paginas_model');
    $this->load->library('Sioen');
    $this->load->helper('html');

    // $this->data['settings']=$this->Hoosk_page_model->getSettings();
    // define ('SITE_NAME', $this->data['settings']['siteTitle']);

    define ('THEME', "clean-blog"); //$this->data['settings']['siteTheme']
    define ('THEME_FOLDER','../../../assets/themes/'.THEME);
  }

  public function index($val){
    $jsonToHtml = new converter();
    $this->data['pagina'] = $this->paginas_model->get_pagina("page_slug", $val);

    $this->data['content'] = $jsonToHtml->toHtml($this->data['pagina']["page_content"]);

    $this->data['header'] = $this->load->view(THEME_FOLDER . '/templates/header', $this->data, true);
    $this->data['footer'] = $this->load->view(THEME_FOLDER . '/templates/footer', '', true);
    $this->load->view(THEME_FOLDER . '/templates/pagina', $this->data);
  }
}