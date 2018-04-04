<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Paginas_model extends CI_Model {
   public function __construct(){
    $this->load->database();
  }
  
  public function get_paginas(){
    $query = $this->db->query('SELECT *,
      (SELECT user_username FROM users WHERE user_id = pages.page_created_by) AS created_by,
      (SELECT user_username FROM users WHERE user_id = pages.page_edited_by) AS edited_by
      FROM pages
      WHERE page_status = 1
      ORDER BY page_edited DESC');
    

    return $query->result_array();
  }
  
  public function get_pagina($key, $value){
    $query = $this->db->get_where('pages', array($key => $value, "page_status" => 1));
    return $query->row_array();
  }

  public function create_page(){
    $data = array(
      'page_title'      => $this->input->post('page-title'),
      'page_created_by' => $this->session->userdata('user_id'),
      'page_slug'       => $this->input->post('page-slug'),
      'page_content'    => $this->input->post('page-content')
    );
    $this->db->insert('pages', $data);
    return $this->db->insert_id();
  }

  public function edit_page($page_id){
    $data = array(
      'page_title'     => $this->input->post('page-title'),
      'page_slug'      => $this->input->post('page-slug'),
      'page_content'   => $this->input->post('page-content'),
      'page_edited'    => date('Y-m-d H:i:s', time()),
      'page_edited_by' => $this->session->userdata('user_id')
    );
    $this->db->set('page_edited_count', 'page_edited_count+1', FALSE);
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

  public function slug_exists($slug, $page_id = null){
    $this->db->where('page_slug', $slug);
    $this->db->where('page_status', 1);
    if($page_id){
      $this->db->where('page_id !=', $page_id);
    }
    $query = $this->db->get('pages');
    return ($query->row() !== NULL);
  }
}