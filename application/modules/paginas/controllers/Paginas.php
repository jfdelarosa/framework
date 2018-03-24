<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paginas extends CI_Controller {

  public function __construct(){
    parent::__construct();
  }

  public function index(){
    echo '<a href="/backend/">Backend</a>';
  }
  public function hola(){
    echo "hola";
  }
}