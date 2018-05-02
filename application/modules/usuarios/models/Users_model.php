<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model{
  public function __construct() {
    parent::__construct();
  }

  public function get_usuarios(){
    $this->db->select('*');
    $this->db->where('id !=', 1);
    $query = $this->db->get('aauth_users');
    return $query->result_array();
  }

  public function get_data($id){
    $this->db->select('rol_id, user_username, user_nombre');
    $this->db->where('user_id', $id);
    $query = $this->db->get('users');
    
    return $query->row();
  }
}