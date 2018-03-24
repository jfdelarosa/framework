<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Users_model extends CI_Model{
  public function __construct() {
    parent::__construct();
  }

  public function login($username, $password){
    $this->db->select('user_hash, user_id');
    $this->db->where('user_username', $username);
    $query = $this->db->get('users');
    $return = false;
    if($query->num_rows() == 1){
      if(hash_equals($query->row()->user_hash, crypt($password, $query->row()->user_hash))){
        $return = $query->row()->user_id;
      }else{
        $return = array('error' => true, 'mensaje' => 'Las contraseñas no coinciden.');
      }
    }else{
      $return = array('error' => true, 'mensaje' => 'Usuario no encontrado.');
    }
    
    return $return;
  }

  public function get_data($id){
    $this->db->select('rol_id, user_username, user_nombre');
    $this->db->where('user_id', $id);
    $query = $this->db->get('users');
    
    return $query->row();
  }

  public function registrar($rol_id, $user_username, $user_nombre, $password){
    $cost = 10;
    $salt = bin2hex(random_bytes(16));
    $salt = sprintf("$2a$%02d$", $cost) .$salt;

    $data = array(
      'rol_id'      => $rol_id,
      'user_username'   => $user_username,
      'user_nombre' => $user_nombre,
      'user_hash'   => crypt($password, $salt)
    );

    $this->db->insert('users', $data);
  }
}