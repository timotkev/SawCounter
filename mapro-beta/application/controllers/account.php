<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	function index()
	{	
		$this->load->model('m_users');

		$data['id_users'] 	= $this->session->userdata('mapro_login')['id_users'];
		$data['data'] 		= $this->m_users->get_users_by($data)->row_array();
		$data['title'] 		= 'User Profile';
		$data['content']	= 'content/account/v_account';

		$this->load->view('layouts/v_backoffice', $data);
	}

	function edit_profile(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');

		if($this->form_validation->run() == FALSE){
			$this->load->model('m_users');

			$data['id_users'] 	= $this->session->userdata('mapro_login')['id_users'];
			$data['data'] 		= $this->m_users->get_users_by($data)->row_array();

			$data['title'] 		= 'Edit Profile';
			$data['content']	= 'content/account/v_edit_profile';

			$this->load->view('layouts/v_backoffice', $data);

		} else {

			$current_avatar = $this->input->post('avatar_old');

			if(@$_FILES['avatar']['name'] != ""){

				$config['upload_path'] 		= './assets/uploads/avatar/';
				$config['allowed_types'] 	= 'jpg|jpeg|png|gif';
				$config['encrypt_name'] 	= TRUE;
				$config['remove_spaces'] 	= TRUE;
				$config['max_size']			= '204899999';

				unlink('./assets/uploads/avatar/'.$current_avatar);
				$this->upload_file($config,'avatar');
				
			} else {
				$this->avatar = $current_avatar;
			}
				

			$id_users				= $this->session->userdata('mapro_login')['id_users'];

			$data['email'] 			= $this->input->post('email');
			$data['fullname'] 		= $this->input->post('fullname');
			$data['avatar'] 		= $this->avatar;
			$data['last_update'] 	= gmdate("Y-m-d H:i:s", time()+60*60*7);

			$this->load->model('m_users');
			$this->m_users->update_users_by_id($id_users, $data);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully updated!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('account', 'location');
		}
	}

	function change_password(){
		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_confirmation', 'Password Confirmation', 'required|matches[password]');

		if($this->form_validation->run() == FALSE){
			
			$data['title'] 		= 'Change Password';
			$data['content']	= 'content/account/v_change_password';

			$this->load->view('layouts/v_backoffice', $data);

		} else {

			$this->load->model('m_users');

			$id_users = $this->session->userdata('mapro_login')['id_users'];

			$old_password 	= $this->m_users->get_password_by_id_users($id_users);
			$password_old	= md5($this->input->post('password_old'));

			if($old_password != $password_old){
				$message = '<div class="alert alert-dismissible alert-danger">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong><i class="glyphicon glyphicon-remove"></i> Sorry!</strong> Current Password is Wrong!
							</div>';
				$this->session->set_flashdata('message', $message);
				redirect('account/change_password', 'location');
			} else {
				$data['password'] 		= md5($this->input->post('password'));
				$data['last_update'] 	= gmdate("Y-m-d H:i:s", time()+60*60*7);

				$this->m_users->update_users_by_id($id_users, $data);

				$message = '<div class="alert alert-dismissible alert-success">
							  <button type="button" class="close" data-dismiss="alert">&times;</button>
							  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully updated!
							</div>';
				$this->session->set_flashdata('message', $message);
				redirect('account', 'location');
			}
		}
	}

	function check_file($field,$field_value) {
		if(isset($this->custom_errors[$field_value]))
		{
			$this->form_validation->set_message('check_file', $this->custom_errors[$field_value]);
			unset($this->custom_errors[$field_value]);
			return FALSE;
		}
		return TRUE;
	}

	function upload_file($config,$fieldname) {
		$this->load->library('upload');
		$this->upload->initialize($config);
		$this->upload->do_upload($fieldname);
		$error = $this->upload->display_errors();

		if(empty($error))
		{
			$data = $this->upload->data();
			$this->$fieldname = $data['file_name'];
		} else {
			$this->custom_errors[$fieldname] = $error;
		}
	}
}