<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Upload_model extends CI_Model {
  function save_upload ($image) {
    $data = array(
      'file_name' => $image
    );
    $result = $this->db->insert('uploads', $data);
    return $result;
  }
}