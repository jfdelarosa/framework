<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paginas_model extends CI_Model {
   public function __construct(){
    $this->load->database();
  }
  
  public function get_paginas(){
    $query = $this->db->get_where('pages', array("page_status" => 1));
    return $query->result_array();
  }
  
  public function get_pagina($page_id){
    $query = $this->db->get_where('pages', array('page_id' => $page_id, "page_status" => 1));
    return $query->row_array();
  }

  public function create_page(){
    $data = array(
      'page_title' => $this->input->post('page-title'),
      'page_created_by' => $this->session->userdata('rol_id'),
      'page_slug' => $this->input->post('page-slug'),
      'page_content' => $this->input->post('page-content')
    );
    return $this->db->insert('pages', $data);
  }

  public function edit_page($page_id){
    $data = array(
      'page_title' => $this->input->post('page-title'),
      'page_slug' => $this->input->post('page-slug'),
      'page_content' => $this->input->post('page-content'),
      'page_edited' => date('Y-m-d H:i:s', time()),
      'page_edited_by' => $this->session->userdata('rol_id')
    );
    $this->db->where('page_id', $page_id);
    return $this->db->update('pages', $data);
  }

  public function delete_page($page_id){
    $data = array(
      'page_status' => 0
    );
    $this->db->where('page_id', $page_id);
    return $this->db->update('pages', $data);
  }
}