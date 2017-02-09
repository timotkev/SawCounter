<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	function index(){
		
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('30', $array_permissions)){
			redirect('not-access', 'location');
		}
			
		$this->load->library('form_validation');

		$this->form_validation->set_rules('sys_name', 'System Name', 'required');
		$this->form_validation->set_rules('sys_email', 'System Email Administrator', 'required');
		$this->form_validation->set_rules('sys_pagination', 'Data Per Page', 'required');
		$this->form_validation->set_rules('sys_date', 'Format System Date', 'required');

		if($this->form_validation->run() == FALSE){
			# Load Model
			$this->load->model('m_settings');
			$data['sys_name'] 		= $this->m_settings->get_settings_by_name('sys_name');
			$data['sys_desc'] 		= $this->m_settings->get_settings_by_name('sys_desc');
			$data['sys_keyword']	= $this->m_settings->get_settings_by_name('sys_keyword');
			$data['sys_email']		= $this->m_settings->get_settings_by_name('sys_email');
			$data['sys_pagination']	= $this->m_settings->get_settings_by_name('sys_pagination');
			$data['sys_date']		= $this->m_settings->get_settings_by_name('sys_date');

			$data['title'] 		= 'System Configuration';
			$data['content']	= 'content/settings/v_settings';

			$this->load->view('layouts/v_backoffice', $data);
		} else {
			$this->load->model('m_settings');

			$sys_name = $this->input->post('sys_name');			
			$this->m_settings->update_settings_by_name('sys_name', $sys_name);

			$sys_desc = $this->input->post('sys_desc');			
			$this->m_settings->update_settings_by_name('sys_desc', $sys_desc);

			$sys_keyword = $this->input->post('sys_keyword');			
			$this->m_settings->update_settings_by_name('sys_keyword', $sys_keyword);

			$sys_email = $this->input->post('sys_email');			
			$this->m_settings->update_settings_by_name('sys_email', $sys_email);

			$sys_pagination = $this->input->post('sys_pagination');			
			$this->m_settings->update_settings_by_name('sys_pagination', $sys_pagination);

			$sys_date = $this->input->post('sys_date');			
			$this->m_settings->update_settings_by_name('sys_date', $sys_date);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully saved!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('settings', 'location');
		}
	}
}