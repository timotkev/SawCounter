<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends CI_Controller {

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

		if(!in_array('40', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->session->unset_userdata('sort_customers');
		$this->session->unset_userdata('key_customers');

		$param = array();

		$keyword = $this->input->post('keyword');

		if(!empty($keyword)){
			$param['keyword'] = $keyword;
			$this->session->set_userdata('key_customers', $keyword);
		}

		if($this->input->post('proses')){
			$data['id_customers'] 	= $this->input->post('id_customers');
			$data['sort']	 	= $this->input->post('sort');
		} else {
			$data['id_customers'] 	= '';
			$data['sort'] 		= '';
		}

		$per_halaman = sys_pagination();

		if(!empty($data['sort'])){
			$param['sort'] = $data['sort'];
			$this->session->set_userdata('sort_customers', $data['sort']);
		}

		$this->load->model('m_customers');
		$total 			= $this->m_customers->get_total_customers($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('customers/request');        
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
		
		$this->load->model('m_customers');

		$data['pagination'] = $this->ajax_pagination->create_links();
		$data['customers'] 	= $this->m_customers->get_customers($param);

		$data['title'] 		= 'Customer Administration';
		$data['content']	= 'content/customers/v_customers';

		$this->load->view('layouts/v_backoffice', $data);
	}

	function request()
	{
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('40', $array_permissions)){
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
        if(!empty($this->session->userdata('sort_customers'))){
        	$param['sort'] = $this->session->userdata('sort_customers');
        }

        if(!empty($this->session->userdata('key_customers'))){
        	$param['keyword'] = $this->session->userdata('key_customers');
        }

        $this->load->model('m_customers');
		$total 			= $this->m_customers->get_total_customers($param);
		$data['total'] 	= $total;

		# Config Pagination
		$config['base_url']    		= base_url('customers/request');        
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

		$data['customers'] 		= $this->m_customers->get_customers($param);
		$data['no'] 		= $offset + 1;


		$this->load->view('content/customers/v_request', $data, false);
	}

	function add(){
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('41', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->load->library('form_validation');

		$this->form_validation->set_rules('customers_name', 'Customers Name', 'required|is_unique[tbl_customers.customers_name]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('contact_person', 'Contact Person', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');

		if($this->form_validation->run() == FALSE){
			$data['title'] 		= 'Add Customers';
			$data['content']	= 'content/customers/v_add';

			$this->load->view('layouts/v_backoffice', $data);
		} else {
			$data['customers_name'] 	= $this->input->post('customers_name');
			$data['contact_person'] 	= $this->input->post('contact_person');
			$data['email'] 				= $this->input->post('email');
			$data['phone'] 				= $this->input->post('phone');
			$data['website']			= $this->input->post('website');
			$data['address']			= $this->input->post('address');
			$data['registered'] 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

			$this->load->model('m_customers');
			$this->m_customers->add_customers($data);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully saved!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('customers', 'location');
		}
	}

	function edit($id_customers){
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('42', $array_permissions)){
			redirect('not-access', 'location');
		}
		
		$this->load->library('form_validation');

		$data['id_customers'] 	= $id_customers;

		$this->load->model('m_customers');
		$customers = $this->m_customers->get_customers_by($data);

		if($customers->num_rows() > 0){

			$data['data'] 		= $customers->row_array();
			$data['title'] 		= 'Edit Customers';
			$data['content']	= 'content/customers/v_edit';

			$this->load->view('layouts/v_backoffice', $data);
		} else {			

			redirect('customers', 'location');

		}
	}

	function update(){
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('42', $array_permissions)){
			redirect('not-access', 'location');
		}
		
		$id_customers = $this->input->post('id_customers');

		$this->load->library('form_validation');

		$this->form_validation->set_rules('customers_name', 'Customers Name', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('contact_person', 'Contact Person', 'required');
		$this->form_validation->set_rules('address', 'Address', 'required');
		$this->form_validation->set_rules('phone', 'Phone Number', 'required');

		if($this->form_validation->run() == FALSE){
			$this->edit($id_customers);
		} else {
			$data['customers_name'] 	= $this->input->post('customers_name');
			$data['contact_person'] 	= $this->input->post('contact_person');
			$data['email'] 				= $this->input->post('email');
			$data['phone'] 				= $this->input->post('phone');
			$data['website']			= $this->input->post('website');
			$data['address']			= $this->input->post('address');
			$data['last_update'] 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

			$this->load->model('m_customers');
			$this->m_customers->update_customers_by_id($id_customers, $data);

			$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully updated!
						</div>';
			$this->session->set_flashdata('message', $message);
			redirect('customers', 'location');
		}
	}

	function delete($id_customers){
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('43', $array_permissions)){
			redirect('not-access', 'location');
		}

		$this->load->modeL('m_customers');
		$this->m_customers->delete_customers_by_id($id_customers);

		$message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully deleted!
						</div>';
		$this->session->set_flashdata('message', $message);
		redirect('customers', 'location');
	}

	function detail(){
		# ACCESS PERMISSION
		$array_permissions = access_roles();

		if(!in_array('40', $array_permissions)){
			redirect('not-access', 'location');
		}
		
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			$data['id_customers'] 	= $this->input->post('id');

			$this->load->model('m_customers');
			$customers = $this->m_customers->get_customers_by($data);

			$data['data'] = $customers->row_array();

			$this->load->view('content/customers/v_detail', $data);

		}
		return;
	}
}