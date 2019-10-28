<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class User_model extends CI_Model { 
  function __construct () { 
    $this->table = 'users'; 
  } 


  public function validate ($username, $password) {
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $query = $this->db->get($this->table);
    if($query->num_rows() == 1) {
      return true;
    }
    return false;
  }
}