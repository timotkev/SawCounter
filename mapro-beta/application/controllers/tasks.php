<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tasks extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
	}

	function form_add(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

			$this->load->model('m_users');
			$data['users'] = $this->m_users->get_all_users_with_id_and_username();

			$data['id_milestones'] 	= $this->input->post('id'); # id_milestones
			$data['id_projects'] 	= $this->input->post('id_projects'); # id_projects

			$this->load->view('content/projects/tasklists/v_add', $data);
		}
	}

	function form_edit(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

			$data['id_milestones'] 	= $this->input->post('id');

			$this->load->model('m_milestones');
			$data['ubah'] = $this->m_milestones->get_milestones_by($data)->row_array();

			$this->load->model('m_users');
			$data['users'] = $this->m_users->get_all_users_with_id_and_username();

			$this->load->view('content/projects/milestones/v_edit', $data);
		}
	}

	function delete(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$id_tasks 	= $this->input->post('id');

			$this->load->model('m_tasks');
			$this->m_tasks->delete_tasks_by_id($id_tasks);

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

			$this->validasi_tasks();

			if($this->input->post('form_tambah')){

				$data['id_projects'] 			= $this->input->post('id_projects');
				$data['id_milestones'] 			= $this->input->post('id_milestones');
				$data['tasks'] 					= $this->input->post('tasks');
				$data['budget_tasks'] 		    = $this->input->post('budget');
				$data['decription_tasks']		= $this->input->post('decription_tasks');
				$data['due_tasks'] 				= dateSql($this->input->post('due_tasks'));
				$data['created_tasks'] 			= gmdate("Y-m-d H:i:s", time()+60*60*7);
                $data['update_tasks'] 		    = gmdate("Y-m-d H:i:s", time()+60*60*7);
                $data['status_tasks']           = 0;

				$this->load->model('m_tasks');
				$this->m_tasks->add_tasks($data);

				$id_tasks = $this->db->insert_id();
				$users = $this->input->post('id_users');

				if(!empty($users)){

					$this->load->model('m_tasks_assigned');

					foreach($users as $row){

						$data2['id_users'] 	= $row;
						$data2['id_tasks']	= $id_tasks;

						$this->m_tasks_assigned->add_tasks_assigned($data2);
					}
				}

				echo json_encode(array('status' => TRUE));

			} else if($this->input->post('form_ubah')){

				$id_tasks = $this->input->post('id_tasks');

				$data['tasks'] 				= $this->input->post('tasks');
				$data['decription_tasks'] 	= $this->input->post('decription_tasks');
				$data['due_tasks'] 			= dateSql($this->input->post('due_tasks'));
				$data['update_tasks'] 		= gmdate("Y-m-d H:i:s", time()+60*60*7);

				$this->load->model('m_tasks');
				$this->m_tasks->update_tasks_by_id($id_tasks, $data);

				$id_users = $this->input->post('id_users');

				$this->load->model('m_tasks_assigned');

				if(!empty($id_users)){
					foreach($id_users as $row){
						$data2['id_tasks'] 	= $id_tasks;
						$data2['id_users']	= $row;

						$check_data = $this->m_tasks_assigned->get_tasks_assigned_by($data2);

						if($check_data->num_rows() == 0){ # NEW DATA
							$this->m_tasks_assigned->add_tasks_assigned($data2);
						}
					}
				} else { # DELETE ALL USERS PROJECTS
					$this->m_tasks_assigned->delete_tasks_assigned_by_id_tasks($id_tasks);
				}

				$users_projects = $this->m_tasks_assigned->get_id_users_by_id_tasks($id_tasks);
				$array_diff = array_diff($users_projects, $id_users);

				if(!empty($array_diff)){

					foreach($array_diff as $row){

						$this->m_tasks_assigned->delete_projects_assigned_by($id_tasks, $row);

					}
				}

				echo json_encode(array('status' => TRUE));
			}
		}
	}

	function mark_done(){
        if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            $id_tasks = $this->input->post('id_tasks');
            $data['update_tasks'] = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
            $data['status_tasks'] = 1;
            $this->load->model('m_tasks');
            $this->m_tasks->update_tasks_by_id($id_tasks, $data);
            echo json_encode(array('status' => TRUE));
        }
    }

	function validasi_tasks(){
		$data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('tasks') == '') {
            $data['inputerror'][] = 'tasks';
            $data['error_string'][] = 'Enter Tasks!';
            $data['status'] = FALSE;
        }

        if($this->input->post('due_tasks') == '') {
            $data['inputerror'][] = 'due_tasks';
            $data['error_string'][] = 'Enter Date!';
            $data['status'] = FALSE;
        }

        if($this->input->post('form_tambah')) {

        	$condition['tasks'] 		= $this->input->post('tasks');
        	$condition['due_tasks'] 	= dateSql($this->input->post('due_tasks'));

        	$this->load->model('m_tasks');
			$cek = $this->m_tasks->get_tasks_by($condition);

			if($cek->num_rows() > 0){

	            $data['inputerror'][] = 'tasks';
	            $data['error_string'][] = 'Sorry, Data existing systems!';
	            $data['status'] = FALSE;
			}
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }
	}

	function load_tasks(){
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

            $id_projects = $this->input->post('id');
            $data['id_projects'] 	= $id_projects;

            $this->load->model('m_tasks');
            $this->load->model('m_projects');
            $projects = $this->m_projects->get_projects_by($data);

            if($projects->num_rows() > 0){
                $projects 			= $projects->row_array();
                $data['detail'] 	= $projects;
                $data['title'] 		= 'Detail Project';
                $this->load->model('m_milestones');
                $data['milestones'] 	= $this->m_milestones->get_milestones_by_id_projects($id_projects);
                $this->load->view('content/projects/tasklists/v_results.php', $data);
            } else {
                redirect('projects', 'location');

            }
		}
	}
}