<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Folder extends CI_Controller {
  function __construct() {
    parent::__construct();
  }

  public function assets(){
    $segments = $this->uri->segments;
    $file = array_values(array_slice($segments, -1))[0];
    array_pop($segments);
    
    $path = str_replace("folder/assets/", "", implode('/', $segments));
    $file = getcwd() .'/application/modules/' . $path. '/assets/' . $file;
    $path_parts = pathinfo($file);
    $file_type = strtolower($path_parts['extension']);
    
    if(is_file($file)) {
      switch ($file_type) {
        case 'css':
          header('Content-type: text/css');
          break;

        case 'js':
          header('Content-type: text/javascript');
          break;
        
        case 'json':
          header('Content-type: application/json');
          break;
        
        case 'xml':
          header('Content-type: text/xml');
          break;

        case 'html':
          header('Content-type: text/html');
          break;
        
        case 'pdf':
          header('Content-type: application/pdf');
          break;
        
        case 'jpg' || 'jpeg' || 'png' || 'gif':
          header('Content-type: image/'.$file_type);
          break;
      }
      include $file;
    }
    exit;
  }
}