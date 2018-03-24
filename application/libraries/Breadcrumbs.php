<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Breadcrumbs {
	private $breadcrumbs = array();
	public function __construct(){	
		$this->ci =& get_instance();
		$this->ci->load->config('breadcrumbs');
		$this->tag_open = $this->ci->config->item('tag_open');
		$this->tag_close = $this->ci->config->item('tag_close');
		$this->divider = $this->ci->config->item('divider');
		$this->crumb_open = $this->ci->config->item('crumb_open');
		$this->crumb_close = $this->ci->config->item('crumb_close');
		$this->crumb_last_open = $this->ci->config->item('crumb_last_open');
	}
	
	function push($page, $href){
		if (!$page OR !$href) return;
		$href = base_url($href);
		$this->breadcrumbs[$href] = array('page' => $page, 'href' => $href);
	}
	
	function unshift($page, $href){
		if (!$page OR !$href) return;
		$href = base_url($href);
		array_unshift($this->breadcrumbs, array('page' => $page, 'href' => $href));
	}
	
	function show(){
		if ($this->breadcrumbs) {
			$output = $this->tag_open;
			foreach ($this->breadcrumbs as $key => $crumb) {
				$keys = array_keys($this->breadcrumbs);
				if (end($keys) == $key) {
					$output .= $this->crumb_last_open . '' . $crumb['page'] . '' . $this->crumb_close;
				} else {
					$output .= $this->crumb_open.'<a href="' . $crumb['href'] . '">' . $crumb['page'] . '</a> '.$this->crumb_close;
				}
			}
			
			return $output . $this->tag_close . PHP_EOL;
		}
		
		return '';
	}

}