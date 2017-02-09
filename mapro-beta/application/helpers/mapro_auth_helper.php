<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI = & get_instance();

# Load Library Session
$CI->load->library('session');

$user = $CI->session->userdata('mapro_login');
$controller = $CI->router->class;

if(empty($user) && $controller != "authentication" ) {
    redirect('authentication/', 'refresh');
} else {
    return true;
}