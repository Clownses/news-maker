<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {
  function __construct () {
    parent::__construct();
    $this->load->model('upload_model');
  }

  function do_upload () {
    $status = 'success'; $msg = 'Image was uploaded successfully'; $imageUrl = '';

    $config['upload_path'] = "./assets/uploads";
    $config['allowed_types'] = 'gif|jpg|png';
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 1024 * 8;
    $config['overwrite'] = TRUE;

    $this->load->library('upload', $config);
    if($this->upload->do_upload('news-image')) {
      $upload = $this->upload->data();
      $imageUrl = base_url('/assets/uploads/' . $upload['file_name']);
    } else {
      $status = 'error';
      $msg = $this->upload->display_errors('', '');
    }
    echo json_encode(array('status' => $status, 'msg' => $msg, 'imageUrl' => $imageUrl));
    @unlink($_FILES['news-image']);
  }

  function removeImage () {
    $basepath = 'http://localhost:8888/assets/uploads/';
    $url = $this->input->post('imgName');
    $img = substr($url, strlen($basepath));
    if($img) {
      if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/' . $img)) {
        unlink($_SERVER['DOCUMENT_ROOT'] . '/assets/uploads/' . $img);
      }
    }
    echo json_encode(array('status' => 'success', 'img' => $img));
  }
}