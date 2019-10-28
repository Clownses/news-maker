<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

  function __construct () {
    parent::__construct();
    $this->load->library('form_validation');
  }

  private function __encrip_password ($password) {
    return md5($password);
  }

  public function signIn () {
    $this->load->model('user_model');

    $this->form_validation->set_rules('username', 'Username', 'required', ['required' => 'Please enter username']);
    $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Please enter password']);

    $is_valid = $this->user_model->validate($this->input->post('username'), $this->__encrip_password($this->input->post('password')));
    if($this->form_validation->run() == FALSE) {
      echo validation_errors();
    } else {
    	if($is_valid) {
        $data = array(
          'user_name' => $this->input->post('username'),
          'is_logged_in' => true
        );
        foreach($data as $key => $val) {
          $this->session->set_userdata($key, $val);
        }
        #$this->session->set_userdata($data);
      } else {
        echo 'User not found';
      }
    }
  }

  public function logout () {
  	if($this->session->has_userdata('isUserLoggedIn')) {
  		$this->session->sess_destroy();
  	}
  }
 
}