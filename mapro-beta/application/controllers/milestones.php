<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Milestones extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	function form_add(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			$data['id_projects'] 	= $this->input->post('id'); # id_projects

			$this->load->view('content/projects/milestones/v_add', $data);
		}
	}

	function form_edit(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$data['id_milestones'] 	= $this->input->post('id');

			$this->load->model('m_milestones');
			$data['ubah'] = $this->m_milestones->get_milestones_by($data)->row_array();

			$this->load->view('content/projects/milestones/v_edit', $data);
		}
	}

	function delete(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$id_milestones 	= $this->input->post('id');

			$this->load->model('m_milestones');
			$this->m_milestones->delete_milestones_by_id($id_milestones);

			echo json_encode(array('status' => TRUE));
		}
	}

	function close(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$id_milestones 	= $this->input->post('id');

			$this->load->model('m_milestones');
			$data['status_milestones'] = 1;
			$this->m_milestones->update_milestones_by_id($id_milestones, $data);

			echo json_encode(array('status' => TRUE));
		}
	}

	function save(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			$this->validasi_milestones();

			if($this->input->post('form_tambah')){

				$data['id_projects'] 			= $this->input->post('id_projects');
				$data['milestones'] 			= $this->input->post('milestones');
				$data['decription_milestones']	= $this->input->post('decription_milestones');
				$data['start_milestones'] 		= dateSql($this->input->post('start_milestones'));
				$data['end_milestones'] 		= dateSql($this->input->post('end_milestones'));
				$data['created_milestones'] 	= gmdate("Y-m-d H:i:s", time()+60*60*7);
				$data['update_milestones'] 	    = gmdate("Y-m-d H:i:s", time()+60*60*7);
				$data['status_milestones'] 	    = 0;

				$this->load->model('m_milestones');
				$this->m_milestones->add_milestones($data);

				echo json_encode(array('status' => TRUE));

			} else if($this->input->post('form_ubah')){
				
				$id_milestones = $this->input->post('id_milestones');

				$data['milestones'] 			= $this->input->post('milestones');
				$data['decription_milestones']	= $this->input->post('decription_milestones');
				$data['start_milestones'] 		= dateSql($this->input->post('start_milestones'));
				$data['end_milestones'] 		= dateSql($this->input->post('end_milestones'));
				$data['update_milestones'] 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

				$this->load->model('m_milestones');
				$this->m_milestones->update_milestones_by_id($id_milestones, $data);

				echo json_encode(array('status' => TRUE));
			}
		}
	}

	function validasi_milestones(){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('milestones') == '') {
            $data['inputerror'][] = 'milestones';
            $data['error_string'][] = 'Enter Milestones!';
            $data['status'] = FALSE;
        }

        if($this->input->post('start_milestones') == '') {
            $data['inputerror'][] = 'start_milestones';
            $data['error_string'][] = 'Enter Date!';
            $data['status'] = FALSE;
        }

        if($this->input->post('end_milestones') == '') {
            $data['inputerror'][] = 'end_milestones';
            $data['error_string'][] = 'Enter Date!';
            $data['status'] = FALSE;
        }

        if($this->input->post('form_tambah')) {
        	
        	$condition['milestones'] = $this->input->post('milestones');
        	$condition['start_milestones'] = dateSql($this->input->post('start_milestones'));

        	$this->load->model('m_milestones');
			$cek = $this->m_milestones->get_milestones_by($condition);

			if($cek->num_rows() > 0){

	            $data['inputerror'][] = 'milestones';
	            $data['error_string'][] = 'Sorry, Data existing systems!';
	            $data['status'] = FALSE;
			}
        }
 
        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
	}

	function load_milestones(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			$id_projects 		= $this->input->post('id');
			$status_milestones	= $this->input->post('status');

			$this->load->model('m_milestones');
			$data['milestones'] = $this->m_milestones->get_milestones_by_id_projects($id_projects, $status_milestones);

			$this->load->view('content/projects/milestones/v_results', $data);
		}
	}
}