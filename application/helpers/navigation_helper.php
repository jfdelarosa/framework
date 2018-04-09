<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('menu_backend'))
{
  function menu_backend($sel = 'home')
   {
    $CI =& get_instance();
    $CI->load->helper('directory');
    $items = array();
    $map = directory_map('./application/modules/', 1);

    foreach ($map as $key => $value) {
      if(strpos($value, '.') === FALSE){
        if(file_exists('./application/modules/'.$value.'menu.php')){
          include('./application/modules/'.$value.'menu.php');    
        }
      }
    }

    $menu = '<ul class="nav nav-tabs border-0 flex-column flex-lg-row">'."\n";
    foreach($items as $key => $item){
      if(!array_key_exists("icon", $item)){ $item['icon'] = ""; }
      if(!array_key_exists("badge", $item)){ $item['badge'] = ""; }
      
      $asd = str_replace("/backend/", "", $item['url']);
      $url = ($item['url']) ? $item['url'] : "javascript:void(0)";
      $current = ($sel == $asd || ($sel == "home" && $asd == "")) ? ' active' : '';
      $dropdown = (array_key_exists("submenu", $item)) ? ' dropdown' : '';
      $dropdownToggle = (array_key_exists("submenu", $item)) ? 'data-toggle="dropdown"' : '';
      $menu .= '  <li class="nav-item'.$dropdown.'">'."\n";
      $menu .= '    <a class="nav-link'.$current.'" '.$dropdownToggle.' href="'.$url.'">'.$item['icon'].$key.$item['badge'].'</a>'."\n";
      if(array_key_exists("submenu", $item)){
        $menu .= '      <div class="dropdown-menu dropdown-menu-arrow">'."\n";
        foreach($item['submenu'] as $subkey => $subitem){
          $menu .= '          <a class="dropdown-item" href="'.$subitem['url'].'">'.$subitem['icon'].$subkey.'</a>'."\n";
        }
        $menu .= '      </div>'."\n";
      }
      $menu .= '  </li>'."\n";
    }
    $menu .= '</ul>'."\n";
    return $menu;
  }
}