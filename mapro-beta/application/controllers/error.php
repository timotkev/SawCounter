<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends CI_Controller {

	function __construct(){
		parent::__construct();

	}

	function index()
	{
		$data['title'] 		= '404 Not Found';

		$this->load->view('layouts/v_error', $data);
	}

	function not_access(){
		$data['title'] 		= 'Not Access Page';

		$this->load->view('layouts/v_wrong_permissions', $data);
	}
}