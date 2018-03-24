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

    $menu = '<ul class="nav">'."\n";
    foreach($items as $key => $item){
      if(!array_key_exists("icon", $item)){ $item['icon'] = ""; }
      if(!array_key_exists("badge", $item)){ $item['badge'] = ""; }



      $current = ($sel == $item['url']) ? 'active"' : '';
      $dropdown = (array_key_exists("submenu", $item)) ? ' nav-dropdown' : '';
      $dropdownToggle = (array_key_exists("submenu", $item)) ? ' nav-dropdown-toggle' : '';
      $menu .= '  <li class="nav-item'.$dropdown.'">'."\n";
      $menu .= '    <a class="nav-link '.$current.$dropdownToggle.'" href="'.$item['url'].'">'.$item['icon'].$key.$item['badge'].'</a>'."\n";
      if(array_key_exists("submenu", $item)){
        $menu .= '      <ul class="nav-dropdown-items">'."\n";
        foreach($item['submenu'] as $key => $subitem){
          $menu .= '        <li class="nav-item">'."\n";
          $menu .= '          <a class="nav-link" href="'.$subitem['url'].'">'.$subitem['icon'].$key.'</a>'."\n";
          $menu .= '        </li>'."\n";
        }
        $menu .= '      </ul>'."\n";
      }
      $menu .= '  </li>'."\n";
    }
    $menu .= '</ul>'."\n";
    return $menu;
  }
}