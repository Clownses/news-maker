<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Pagination extends CI_Controller {
  public function __construct () {
    parent::__construct();
    $this->load->library('pagination');
  }
     
  public function index ()  {
    $this->load->database();
    $this->load->model('news_model');

    $params = array();
    $limit_per_page = 1;
    $start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $total_records = $this->news_model->get_total();

    if($total_records > 0)  {
      $params["results"] = $this->news_model->get_current_page_records($limit_per_page, $start_index);
      $config['base_url'] = base_url() . 'pagination/index';
      $config['total_rows'] = $total_records;
      $config['per_page'] = $limit_per_page;
      $config['uri_segment'] = 3;
      $this->pagination->initialize($config);
      $params['links'] = $this->pagination->create_links();
    }
    $this->load->view('news', $params);
  }
}