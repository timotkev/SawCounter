<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Roles extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	function index()
	{
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('50', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->session->unset_userdata('sort_roles');
		$this->session->unset_userdata('key_roles');

		$param = array();

		$keyword = $this->input->post('keyword');

		if(!empty($keyword)){
			$param['keyword'] = $keyword;
			$this->session->set_userdata('key_roles', $keyword);
		}

		if($this->input->post('proses')){
			$data['id_roles'] 	= $this->input->post('id_roles');
			$data['sort']	 	= $this->input->post('sort');
		} else {
			$data['id_roles'] 	= '';
			$data['sort'] 		= '';
		}

		$per_halaman = sys_pagination();

		if(!empty($data['sort'])){
			$param['sort'] = $data['sort'];
			$this->session->set_userdata('sort_roles', $data['sort']);
		}

		$this->load->model('m_roles');
		$total 			= $this->m_roles->get_total_roles($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('roles/request');        
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
		
		$this->load->model('m_roles');

		$data['pagination']  	= $this->ajax_pagination->create_links();
		$data['roles'] 			= $this->m_roles->get_roles($param);

		$data['title'] 		= 'Roles';
		$data['content']	= 'content/roles/v_roles';

		$this->load->view('layouts/v_backoffice', $data);
	}

	function request()
	{
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('50', $array_permissions)){
			redirect('not-access', 'location');
		}

		$param = array();

		$page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }

        $per_halaman = sys_pagination();

        # Get From Session
        if(!empty($this->session->userdata('sort_roles'))){
        	$param['sort'] = $this->session->userdata('sort_roles');
        }

        if(!empty($this->session->userdata('key_roles'))){
        	$param['keyword'] = $this->session->userdata('key_roles');
        }

        $this->load->model('m_roles');
		$total 			= $this->m_roles->get_total_roles($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('roles/request');        
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

		$data['roles'] 		= $this->m_roles->get_roles($param);
		$data['no'] 		= $offset + 1;


		$this->load->view('content/roles/v_request', $data, false);
	}

	function add(){
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('51', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('roles', 'Roles', 'required|is_unique[tbl_roles.roles]');

		if($this->form_validation->run() == FALSE){

			$this->load->model('m_permissions');
			$data['parent_permissions'] = $this->m_permissions->get_all_parent_permissions();

			$data['title'] 		= 'Add Roles';
			$data['content']	= 'content/roles/v_add';

			$this->load->view('layouts/v_backoffice', $data);
		} else {
			$data['roles'] 			= $this->input->post('roles');
			$data['description'] 	= $this->input->post('description');

			$this->load->model('m_roles');
			$this->m_roles->add_roles($data);

			$id_roles 		= $this->db->insert_id();
			$permissions 	= $this->input->post('permissions');

			if(!empty($permissions)){

				$this->load->model('m_roles_permissions');

				foreach($permissions as $row){
					$data2['id_roles'] 			= $id_roles;
					$data2['id_permissions']	= $row;

					$this->m_roles_permissions->add_roles_permissions($data2);
				}
			}

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully saved!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('roles', 'location');
		}

	}

	function edit($id_roles){

		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('52', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->load->library('form_validation');

		$data['id_roles'] 	= $id_roles;

		$this->load->model('m_roles');
		$roles = $this->m_roles->get_roles_by($data);

		if($roles->num_rows() > 0){
			$this->load->model('m_roles_permissions');
			$this->load->model('m_permissions');

			$data['parent_permissions'] = $this->m_permissions->get_all_parent_permissions();
			$data['roles_permissions'] 	= $this->m_roles_permissions->get_permissions_by_id_roles($id_roles);

			$data['data'] 		= $roles->row_array();
			$data['title'] 		= 'Edit Roles';
			$data['content']	= 'content/roles/v_edit';

			$this->load->view('layouts/v_backoffice', $data);
		} else {			

			redirect('roles', 'location');

		}
	}

	function update(){

		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('52', $array_permissions)){
			redirect('not-access', 'location');
		}
		
		$id_roles = $this->input->post('id_roles');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('roles', 'Roles', 'required');

		if($this->form_validation->run() == FALSE){
			$this->edit($id_roles);
		} else {
			$data['roles'] 			= $this->input->post('roles');
			$data['description'] 	= $this->input->post('description');

			$this->load->model('m_roles');
			$this->m_roles->update_roles_by_id($id_roles, $data);

			$permissions 	= $this->input->post('permissions');

			$this->load->model('m_roles_permissions');

			if(!empty($permissions)){				

				foreach($permissions as $row){
					$data2['id_roles'] 			= $id_roles;
					$data2['id_permissions']	= $row;

					$check_data = $this->m_roles_permissions->get_roles_permissions_by($data2);
					
					if($check_data->num_rows() == 0){ # NEW DATA
						$this->m_roles_permissions->add_roles_permissions($data2);
					}					
				}
			} else { # DELETE ALL PERMISSIONS
				$this->m_roles_permissions->delete_roles_permissions_by_id_roles($id_roles);
			}

			$data_permissions = $this->m_roles_permissions->get_permissions_by_id_roles($id_roles);
			$array_diff = array_diff($data_permissions, $permissions);

			if(!empty($array_diff)){

				foreach($array_diff as $row){

					$this->m_roles_permissions->delete_roles_permissions_by($id_roles, $row);

				}
			}


			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully updated!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('roles', 'location');
		}
	}

	function delete($id_roles){
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('53', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->load->modeL('m_roles');
		$this->m_roles->delete_roles_by_id($id_roles);

		$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully deleted!
						</div>';
		$this->session->set_flashdata('message', $message);
		redirect('roles', 'location');
	}
}