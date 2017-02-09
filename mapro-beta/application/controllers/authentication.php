<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Authentication extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	function index()
	{
		$login = $this->session->userdata('mapro_login');
		if(!empty($login)){
			redirect('dashboard', 'location');
		} else {
			$this->do_login();
		}
	}

	function do_login(){
		# Load Library
		$this->load->library('math_captcha');
		$this->load->library('form_validation');

		$this->load->library('form_validation');
		$this->form_validation->set_rules('param1', 'Username', 'required|xss_clean');
	    $this->form_validation->set_rules('param2', 'Password', 'required|xss_clean|callback_check_login');
	    $this->form_validation->set_rules('math_captcha', 'Captcha', 'required|xss_clean');

	    if ($this->form_validation->run() == false){
			# Generate Captcha
			$this->math_captcha->generate_captcha_math();

			$data['captcha_math'] 	= $this->math_captcha->display_captcha_math();
			$data['title'] 			= 'Login Web App';

			$this->load->view('layouts/v_authentication', $data);
	    }
	    else {
	    	redirect('dashboard', 'location');
	    }

		
	}

	function load_captcha(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			# Generate Captcha
			$this->load->library('math_captcha');
			$this->math_captcha->generate_captcha_math();

			$captcha_math = $this->math_captcha->display_captcha_math();

			echo $captcha_math;
		}
	}

	function check_login($str){
		$captcha_math = $this->session->userdata('captcha_math');
		$math_captcha = $this->input->post('math_captcha');

		if($captcha_math == $math_captcha){

			# Load Model
			$this->load->model('m_authentication');

			$param1 = $this->input->post('param1');
			$param2 = $this->input->post('param2');
			$param2 = md5($param2);

			
			$login = $this->m_authentication->get_check_login($param1, $param2);	
				
			if (!empty($login)){
				if($login['active'] == 1){ # Not Active
					$pesan = '<div class="alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<div><i class="glyphicon glyphicon-exclamation-sign"></i> YOUR ACCOUNT CANNOT ACCESS SYSTEM</div>
							</div>';
					$this->form_validation->set_message('check_login', $pesan);
					return false;
				} else {

					$newdata = array(
							'id_users' 	=> $login['id_users'],
							'id_roles' 	=> $login['id_roles'],
							'fullname'	=> $login['fullname'],
							'logged_in'	=> TRUE,
						);		
					$this->session->set_userdata('mapro_login', $newdata);

					# Update Last Login
					$id_users 			= $login['id_users'];
					$data['last_login'] = gmdate("Y-m-d H:i:s", time()+60*60*7);

					$this->load->model('m_users');
					$this->m_users->update_users_by_id($id_users, $data);

					return true;
				}
					
			} else {		
				$pesan = '<div class="alert alert-danger alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<div><i class="glyphicon glyphicon-exclamation-sign"></i> YOUR ACCOUNT NOT REGISTERED</div>
						</div>';
				$this->form_validation->set_message('check_login', $pesan);
				return false;
			}
		} else { # Kode captcha anda salah
			$pesan = '<div class="alert alert-warning alert-dismissible">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<div><i class="glyphicon glyphicon-exclamation-sign"></i> SECURITY CODE IS WRONG!</div>
						</div>';
			$this->form_validation->set_message('check_login', $pesan);
			return false;
		}
	}

	function do_logout(){
		$this->session->unset_userdata('mapro_login');
		$pesan = '<br><div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<i class="glyphicon glyphicon-info-sign"></i> THANK YOU FOR USING THE SYSTEMS!
					</div>';
		$this->session->set_flashdata('message', $pesan);
		redirect('authentication', 'location');
	}
}