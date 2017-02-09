<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

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

		if(!in_array('45', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->session->unset_userdata('sort_users');
		$this->session->unset_userdata('key_users');
		$this->session->unset_userdata('id_roles_users');

		$param = array();

		$keyword = $this->input->post('keyword');

		if(!empty($keyword)){
			$param['keyword'] = $keyword;
			$this->session->set_userdata('key_users', $keyword);
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
			$this->session->set_userdata('sort_users', $data['sort']);
		}

		if(!empty($data['id_roles'])){
			$param['id_roles_users'] = $data['id_roles'];
			$this->session->set_userdata('id_roles_users', $data['id_roles']);
		}

		$this->load->model('m_users');
		$total 			= $this->m_users->get_total_users($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('users/request');        
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
		$data['roles']			= $this->m_roles->get_all_roles();

		$data['pagination']  	= $this->ajax_pagination->create_links();
		$data['users'] 			= $this->m_users->get_users($param);

		$data['title'] 		= 'User Administration';
		$data['content']	= 'content/users/v_users';

		$this->load->view('layouts/v_backoffice', $data);
	}

	function request()
	{
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('45', $array_permissions)){
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

        $this->load->model('m_users');
		$total 			= $this->m_users->get_total_users($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('users/request');        
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

		$data['users'] 		= $this->m_users->get_users($param);
		$data['no'] 		= $offset + 1;


		$this->load->view('content/roles/v_request', $data, false);
	}

	function add(){

		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('46', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('id_roles', 'Roles', 'required');

		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password_confirmation', 'Confirm Password', 'required|matches[password]');

		if($this->form_validation->run() == FALSE){
			$this->load->model('m_roles');		
			$data['roles'] 		= $this->m_roles->get_all_roles();

			$data['title'] 		= 'Add Users';
			$data['content']	= 'content/users/v_add';

			$this->load->view('layouts/v_backoffice', $data);
		} else {
			$data['username'] 	= $this->input->post('username');
			$data['email'] 		= $this->input->post('email');
			$data['fullname'] 	= $this->input->post('fullname');
			$data['password'] 	= md5($this->input->post('password'));
			$data['active'] 	= 0;
			$data['registered'] = gmdate("Y-m-d H:i:s", time()+60*60*7);

			$this->load->model('m_users');
			$this->m_users->add_users($data);

			$id_users = $this->db->insert_id();

			$data2['id_users'] 	= $id_users;
			$data2['id_roles'] 	= $this->input->post('id_roles');

			$this->load->model('m_roles_assigned');
			$this->m_roles_assigned->add_roles_assigned($data2);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully saved!.
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('users', 'location');
		}
	}

	function edit($id_users){

		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('47', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->load->library('form_validation');

		$data['id_users'] 	= $id_users;

		$this->load->model('m_users');
		$users = $this->m_users->get_users_by_id_users($id_users);

		if(!empty($users)){
			$this->load->model('m_roles');		
			$data['roles'] 		= $this->m_roles->get_all_roles();

			$data['data'] 		= $users;
			$data['title'] 		= 'Edit Users';
			$data['content']	= 'content/users/v_edit';

			$this->load->view('layouts/v_backoffice', $data);
		} else {			

			redirect('users', 'location');

		}
	}

	function update(){
		
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('47', $array_permissions)){
			redirect('not-access', 'location');
		}

		$id_users = $this->input->post('id_users');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('fullname', 'Fullname', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('id_roles', 'Roles', 'required');

		if($this->input->post('change_password')){
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password_confirmation', 'Confirm Password', 'required|matches[password]');
		}

		if($this->form_validation->run() == FALSE){
			$this->edit($id_users);
		} else {
			$data['username'] 		= $this->input->post('username');
			$data['email'] 			= $this->input->post('email');
			$data['fullname'] 		= $this->input->post('fullname');
			$data['last_update'] 	= gmdate("Y-m-d H:i:s", time()+60*60*7);

			if($this->input->post('change_password')){
				$data['password'] 	= md5($this->input->post('password'));
			}

			$this->load->model('m_users');
			$this->m_users->update_users_by_id($id_users, $data);

			$data2['id_roles'] = $this->input->post('id_roles');
			$this->load->model('m_roles_assigned');
			$this->m_roles_assigned->update_users_by_id_users($id_users, $data2);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully updated!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('users', 'location');
		}

	}

	function delete($id_users){

		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('48', $array_permissions)){
			redirect('not-access', 'location');
		}
			
		$this->load->modeL('m_users');
		$this->m_users->delete_user_by_id($id_users);

		$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully deleted!
						</div>';
		$this->session->set_flashdata('message', $message);
		redirect('users', 'location');
	}

	function delete_users(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$id_users 	= $this->input->post('id_users');
			$id_projects 	= $this->input->post('id_projects');

			$this->load->model('m_projects_assigned');
			$this->m_projects_assigned->delete_projects_assigned_by($id_projects, $id_users);

			echo json_encode(array('status' => TRUE));
		}
	}

	function load_users(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$id_projects 	= $this->input->post('id');

			$this->load->model('m_projects_assigned');
			$data['users_projects'] = $this->m_projects_assigned->get_users_by_id_projects($id_projects);

			$this->load->view('content/projects/users/v_load_users', $data);
		}
	}

	function form_add(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['id_projects'] 	= $this->input->post('id');

			$this->load->model('m_users');
			$data['users'] = $this->m_users->get_all_users_with_id_and_username();

			$this->load->view('content/projects/users/v_add', $data);
		}
	}

	function save(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$this->validasi_users();

			$data['id_projects'] 	= $this->input->post('id_projects');
			$data['id_users'] 		= $this->input->post('id_users');

			$this->load->model('m_projects_assigned');
			$this->m_projects_assigned->add_projects_assigned($data);
			echo json_encode(array('status' => TRUE));
		}
	}

	function validasi_users(){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('id_users') == '') {
            $data['inputerror'][] = 'id_users';
            $data['error_string'][] = 'Please Choose Users!';
            $data['status'] = FALSE;
        } else if($this->input->post('form_tambah')) {
        	
        	$condition['id_projects'] 	= $this->input->post('id_projects');
        	$condition['id_users'] 		= $this->input->post('id_users');

        	$this->load->model('m_projects_assigned');
			$cek = $this->m_projects_assigned->get_projects_assigned_by($condition);

			if($cek->num_rows() > 0){

	            $data['inputerror'][] = 'id_users';
	            $data['error_string'][] = 'Sorry, Data existing systems!';
	            $data['status'] = FALSE;
			}
        }
 
        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
	}
}