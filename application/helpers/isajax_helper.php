<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

if(!function_exists('isAjax')) {
  function isAjax () {
    return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
  }
}