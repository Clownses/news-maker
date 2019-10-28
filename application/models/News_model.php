<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class News_model extends CI_Model { 
  function __construct () { 
    $this->table = 'news'; 
  }

  public function save ($data) {
  	return $this->db->insert($this->table, $data);
  }

  public function update ($data) {
  	$this->db->set(['title' => $data['title'], 'text' => $data['text'], 'image' => $data['image'], 'author' => $data['author']]);
		$this->db->where('id', $data['id']);
		return $this->db->update($this->table);
  }


  public function getSingleNews ($id) {
  	$this->db->select('*');
    $this->db->from($this->table);
    $this->db->where('id', $id);
    $query = $this->db->get();
    return $query->row_array();
  }

  public function getNews () {
  	return $this->db->get($this->table);
  }

  public function removeNews ($id) {
  	return $this->db->delete($this->table, array('id' => $id));
  }

  public function get_news ($limit, $start)  {
    $this->db->limit($limit, $start);
    $query = $this->db->get($this->table);
    if($query->num_rows() > 0)  {
      foreach ($query->result() as $row)  {
        $data[] = $row;
      }
      return $data;
    }
    return false;
  }
     
  public function get_total ()  {
    return $this->db->count_all($this->table);
  }
}