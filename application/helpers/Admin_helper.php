<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 class Admin_helper{
   
   static function is_admin($id){
    if($id != 1){
      header("Location: /login/"); 
    }
   }

   static function is_logged_in($id){
    if($id != null){
      header("Location: /login/"); 
    }
   }
 } 