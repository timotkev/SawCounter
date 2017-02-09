<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permissions extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	function index()
	{
		$this->session->unset_userdata('sort_permissions');
		$this->session->unset_userdata('key_permissions');

		$param = array();

		$keyword = $this->input->post('keyword');

		if(!empty($keyword)){
			$param['keyword'] = $keyword;
			$this->session->set_userdata('key_permissions', $keyword);
		}

		if($this->input->post('proses')){
			$data['id_permissions'] 	= $this->input->post('id_permissions');
			$data['sort']	 	= $this->input->post('sort');
		} else {
			$data['id_permissions'] 	= '';
			$data['sort'] 		= '';
		}

		$per_halaman = sys_pagination();

		if(!empty($data['sort'])){
			$param['sort'] = $data['sort'];
			$this->session->set_userdata('sort_permissions', $data['sort']);
		}

		$this->load->model('m_permissions');
		$total 			= $this->m_permissions->get_total_permissions($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('permissions/request');        
        $config['first_link'] 		= 'First';
        $config['div']         		= 'result_data';
        $config['total_rows']  		= $data['total'];
        $config['per_page']    		= $per_halaman;
        $config['use_page_numbers'] = TRUE;  
		$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';  
		$config['full_tag_close'] 	= '</ul>';  
		$config['first_link'] 		= '&laquo; First';  
		$config['first_tag_open'] 	= '<li>';  
		$config['first_tag_close'] 	= '</li>';  
		$config['last_link'] 		= 'Last &raquo;';  
		$config['last_tag_open'] 	= '<li>';  
		$config['last_tag_close'] 	= '</li>';  
		$config['next_link']		= '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';  
		$config['next_tag_open'] 	= '<li>';  
		$config['next_tag_close'] 	= '</li>';  
		$config['prev_link'] 		= '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';  
		$config['prev_tag_open'] 	= ' <li>';  
		$config['prev_tag_close'] 	= '</li>';  
		$config['cur_tag_open']		= '<li class="active"><a href="javascript:void(0);">';  
		$config['cur_tag_close'] 	= '</a></li>';  
		$config['num_tag_open'] 	= '<li class="page">';  
		$config['num_tag_close'] 	= '</li>';  

		$this->load->library('Ajax_pagination');
		$this->ajax_pagination->initialize($config);		

		$param['limit'] = $per_halaman;	
		
		$this->load->model('m_permissions');

		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['permissions'] 	= $this->m_permissions->get_permissions($param);

		$data['title'] 		= 'Permissions';
		$data['content']	= 'content/permissions/v_permissions';

		$this->load->view('layouts/v_backoffice', $data);
	}

	function request()
	{
		$param = array();

		$page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $per_halaman = sys_pagination();

        # Get From Session
        if(!empty($this->session->userdata('sort_permissions'))){
        	$param['sort'] = $this->session->userdata('sort_permissions');
        }

        if(!empty($this->session->userdata('key_permissions'))){
        	$param['keyword'] = $this->session->userdata('key_permissions');
        }

        $this->load->model('m_permissions');
		$total 			= $this->m_permissions->get_total_permissions($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('permissions/request');        
        $config['first_link'] 		= 'First';
        $config['div']         		= 'result_data';
        $config['total_rows']  		= $data['total'];
        $config['per_page']    		= $per_halaman;
        $config['use_page_numbers'] = TRUE;  
		$config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';  
		$config['full_tag_close'] 	= '</ul>';  
		$config['first_link'] 		= '&laquo; First';  
		$config['first_tag_open'] 	= '<li>';  
		$config['first_tag_close'] 	= '</li>';  
		$config['last_link'] 		= 'Last &raquo;';  
		$config['last_tag_open'] 	= '<li>';  
		$config['last_tag_close'] 	= '</li>';  
		$config['next_link']		= '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';  
		$config['next_tag_open'] 	= '<li>';  
		$config['next_tag_close'] 	= '</li>';  
		$config['prev_link'] 		= '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';  
		$config['prev_tag_open'] 	= ' <li>';  
		$config['prev_tag_close'] 	= '</li>';  
		$config['cur_tag_open']		= '<li class="active"><a href="javascript:void(0);">';  
		$config['cur_tag_close'] 	= '</a></li>';  
		$config['num_tag_open'] 	= '<li class="page">';  
		$config['num_tag_close'] 	= '</li>';  

		$this->load->library('Ajax_pagination');
		$this->ajax_pagination->initialize($config);	

		$data['pagination'] = $this->ajax_pagination->create_links();

		$param['limit'] 	= $per_halaman;	
		$param['start'] 	= $offset;

		$data['permissions'] 	= $this->m_permissions->get_permissions($param);
		$data['no'] 			= $offset + 1;


		$this->load->view('content/permissions/v_request', $data, false);
	}

	function add(){
		$this->load->library('form_validation');

		$this->form_validation->set_rules('permissions', 'Permissions', 'required|is_unique[tbl_permissions.permissions]');

		if($this->form_validation->run() == FALSE){

			$this->load->model('m_permissions');

			$data['parent_permissions'] = $this->m_permissions->get_all_parent_permissions();
			$data['title'] 				= 'Add Permissions';
			$data['content']			= 'content/permissions/v_add';

			$this->load->view('layouts/v_backoffice', $data);
		} else {
			$data['permissions'] 		= $this->input->post('permissions');
			$data['parent_permissions'] = $this->input->post('parent_permissions');

			$this->load->model('m_permissions');
			$this->m_permissions->add_permissions($data);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully saved!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('permissions', 'location');
		}
	}

	function edit($id_permissions){
		
		$this->load->library('form_validation');

		$data['id_permissions'] = $id_permissions;

		$this->load->model('m_permissions');
		$permissions = $this->m_permissions->get_permissions_by($data);

		if($permissions->num_rows() > 0){

			$data['data'] 				= $permissions->row_array();
			$data['parent_permissions'] = $this->m_permissions->get_all_parent_permissions();
			$data['title'] 				= 'Edit Permissions';
			$data['content']			= 'content/permissions/v_edit';

			$this->load->view('layouts/v_backoffice', $data);
		} else {			

			redirect('permissions', 'location');

		}
	}

	function update(){
		
		$id_permissions = $this->input->post('id_permissions');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('permissions', 'Permissions', 'required');

		if($this->form_validation->run() == FALSE){
			$this->edit($id_permissions);
		} else {
			$data['permissions'] 		= $this->input->post('permissions');
			$data['parent_permissions'] = $this->input->post('parent_permissions');

			$this->load->model('m_permissions');
			$this->m_permissions->update_permissions_by_id($id_permissions, $data);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully updated!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('permissions', 'location');
		}
	}

	function delete($id_permissions){
		$this->load->modeL('m_permissions');
		$this->m_permissions->delete_permissions_by_id($id_permissions);

		$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully deleted!
						</div>';
		$this->session->set_flashdata('message', $message);
		redirect('permissions', 'location');
	}
}