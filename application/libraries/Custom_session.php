<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once BASEPATH . '/libraries/Session/Session.php';

class Custom_Session extends CI_Session {

	public function __construct ($params = array()) {
    parent::__construct();
    $this->CI->session = $this;
  }

  function sess_update() {
    if (!$this->CI->input->is_ajax_request())
            return parent::sess_update();
    }
}