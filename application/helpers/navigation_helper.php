<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('menu_backend'))
{
  function menu_backend($sel = 'home')
   {
    $CI =& get_instance();
    $CI->load->helper('directory');
    $menus = array();
    $map = directory_map('./application/modules/', 1);

    foreach ($map as $key => $value) {
      if(strpos($value, '.') === FALSE){
        if(file_exists('./application/modules/'.$value.'index.php')){
          $test = include('./application/modules/'.$value.'index.php');
          if(isset($test['menu'])){
            array_push($menus, $test['menu']);
          }
        }
      }
    }
    $menu = '<ul class="nav nav-tabs border-0 flex-column flex-lg-row">'."\n";
    foreach($menus as $key => $items){
      foreach($items as $key => $item){
        $active = false;
        if(!array_key_exists("icon", $item)){ $item['icon'] = ""; }
        if(!array_key_exists("badge", $item)){ $item['badge'] = ""; }
        
        $url = ($item['url']) ? $item['url'] : "javascript:void(0)";
        $current = ($item['url'] == uri_string() || ($item['url'] == "/backend/" && uri_string() == "backend")) ? ' active' : '';
        $dropdown = (array_key_exists("submenu", $item)) ? ' dropdown' : '';
        $dropdownToggle = (array_key_exists("submenu", $item)) ? 'data-toggle="dropdown"' : '';
        $menu .= '  <li class="nav-item'.$dropdown.'">'."\n";
        if(array_key_exists("submenu", $item)){
          foreach($item['submenu'] as $subkey => $subitem){
            if($subitem['url'] == uri_string()){
              $current = ' active';
              break;
            }
          }
        }
        $menu .= '    <a class="nav-link'.$current.'" '.$dropdownToggle.' href="'.base_url($url).'">'.$item['icon'].$key.$item['badge'].'</a>'."\n";
        if(array_key_exists("submenu", $item)){
          $menu .= '      <div class="dropdown-menu dropdown-menu-arrow">'."\n";
          foreach($item['submenu'] as $subkey => $subitem){
            $menu .= '          <a class="dropdown-item" href="'.base_url($subitem['url']).'">'.$subitem['icon'].$subkey.'</a>'."\n";
          }
          $menu .= '      </div>'."\n";
        }
        $menu .= '  </li>'."\n";
      }
    }
    $menu .= '</ul>'."\n";
    return $menu;
  }
}