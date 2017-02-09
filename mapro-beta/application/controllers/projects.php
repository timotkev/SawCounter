<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Projects extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file', 'download'));
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index()
    {
        $this->session->unset_userdata('sort_projects');
        $this->session->unset_userdata('key_projects');

        $param = array();

        $keyword = $this->input->post('keyword');

        if (!empty($keyword)) {
            $param['keyword'] = $keyword;
            $this->session->set_userdata('key_projects', $keyword);
        }

        if ($this->input->post('proses')) {
            $data['id_projects'] = $this->input->post('id_projects');
            $data['sort'] = $this->input->post('sort');
        } else {
            $data['id_projects'] = '';
            $data['sort'] = '';
        }

        $per_halaman = sys_pagination();

        if (!empty($data['sort'])) {
            $param['sort'] = $data['sort'];
            $this->session->set_userdata('sort_projects', $data['sort']);
        }

        $this->load->model('m_projects');
        $total = $this->m_projects->get_total_projects($param);
        $data['total'] = $total;

        # Config Pagination
        $config['base_url'] = base_url('projects/request');
        $config['first_link'] = 'First';
        $config['div'] = 'result_data';
        $config['total_rows'] = $data['total'];
        $config['per_page'] = $per_halaman;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = ' <li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->load->library('Ajax_pagination');
        $this->ajax_pagination->initialize($config);

        $param['limit'] = $per_halaman;

        $this->load->model('m_projects');

        $data['pagination'] = $this->ajax_pagination->create_links();
        $data['projects'] = $this->m_projects->get_projects($param);

        $data['title'] = 'Projects';
        $data['content'] = 'content/projects/v_projects';

        $this->load->view('layouts/v_backoffice', $data);
    }

    function request()
    {
        $param = array();

        $page = $this->input->post('page');
        if (!$page) {
            $offset = 0;
        } else {
            $offset = $page;
        }

        $per_halaman = sys_pagination();

        # Get From Session
        if (!empty($this->session->userdata('sort_projects'))) {
            $param['sort'] = $this->session->userdata('sort_projects');
        }

        if (!empty($this->session->userdata('key_projects'))) {
            $param['keyword'] = $this->session->userdata('key_projects');
        }

        $this->load->model('m_projects');
        $total = $this->m_projects->get_total_projects($param);
        $data['total'] = $total;

        # Config Pagination
        $config['base_url'] = base_url('projects/request');
        $config['first_link'] = 'First';
        $config['div'] = 'result_data';
        $config['total_rows'] = $data['total'];
        $config['per_page'] = $per_halaman;
        $config['use_page_numbers'] = TRUE;
        $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = '&laquo; First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Last &raquo;';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['next_link'] = '<span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['prev_link'] = '<span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span>';
        $config['prev_tag_open'] = ' <li>';
        $config['prev_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page">';
        $config['num_tag_close'] = '</li>';

        $this->load->library('Ajax_pagination');
        $this->ajax_pagination->initialize($config);

        $data['pagination'] = $this->ajax_pagination->create_links();

        $param['limit'] = $per_halaman;
        $param['start'] = $offset;

        $data['projects'] = $this->m_projects->get_projects($param);
        $data['no'] = $offset + 1;


        $this->load->view('content/projects/v_request', $data, false);
    }

    function check_project()
    {
        $data['projects'] = $this->input->post('projects');
        $data['start_projects'] = $this->input->post('start_projects');

        $this->load->model('m_projects');
        $data_projects = $this->m_projects->get_projects_by($data)->row_array();

        if (!empty($data_projects)) {
            $this->form_validation->set_message('check_project', 'Sorry, Project existing in the systems!');
            return false;
        } else {
            return true;
        }
    }

    function add()
    {
        # ACCESS PERMISSION
        $array_permissions = access_roles();

        if (!in_array('1', $array_permissions)) {
            redirect('not-access', 'location');
        }

        $this->load->library('form_validation');

        $this->form_validation->set_rules('projects', 'Project', 'required|callback_check_project');
        #$this->form_validation->set_rules('id_customers', 'Customers', 'required');
        $this->form_validation->set_rules('start_projects', 'Start Project', 'required');
        $this->form_validation->set_rules('end_projects', 'End Project', 'required');
        $this->form_validation->set_rules('budget', 'Budget', 'required');

        if ($this->form_validation->run() == FALSE) {

            #$this->load->model('m_customers');

            #$data['customers']	= $this->m_customers->get_all_customers_name();
            $this->load->model('m_users');
            $data['users'] = $this->m_users->get_all_users_with_id_and_username();
            $data['title'] = 'Add Project';
            $data['content'] = 'content/projects/v_add';

            $this->load->view('layouts/v_backoffice', $data);
        } else {
            #$data['id_customers']		= $this->input->post('id_customers');
            $data['projects'] = $this->input->post('projects');
            $data['description'] = $this->input->post('description');
            $data['start_projects'] = dateSql($this->input->post('start_projects'));
            $data['end_projects'] = dateSql($this->input->post('end_projects'));
            $data['budget'] = $this->input->post('budget');
            $data['created_projects'] = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
            $data['update_projects'] = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);
            $data['status'] = 0;

            $this->load->model('m_projects');
            $this->m_projects->add_projects($data);

            $id_projects = $this->db->insert_id();
            $users = $this->input->post('id_users');

            if (!empty($users)) {
                $this->load->model('m_projects_assigned');
                foreach ($users as $row) {
                    $data2['id_users'] = $row;
                    $data2['id_projects'] = $id_projects;

                    $this->m_projects_assigned->add_projects_assigned($data2);
                }
            }

            $message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully saved!
						</div>';
            $this->session->set_flashdata('message', $message);
            redirect('projects', 'location');
        }
    }

    function edit($id_projects)
    {

        # ACCESS PERMISSION
        $array_permissions = access_roles();

        if (!in_array('2', $array_permissions)) {
            redirect('not-access', 'location');
        }

        $this->load->library('form_validation');

        $data['id_projects'] = $id_projects;

        $this->load->model('m_projects');
        $projects = $this->m_projects->get_projects_by($data);

        if ($projects->num_rows() > 0) {
            #$this->load->model('m_customers');

            #$data['customers']	= $this->m_customers->get_all_customers_name();
            $this->load->model('m_users');
            $data['users'] = $this->m_users->get_all_users_with_id_and_username();

            $this->load->model('m_projects_assigned');
            $data['users_projects'] = $this->m_projects_assigned->get_id_users_by_id_projects($id_projects);

            $data['data'] = $projects->row_array();
            $data['title'] = 'Edit Project';
            $data['content'] = 'content/projects/v_edit';

            $this->load->view('layouts/v_backoffice', $data);
        } else {

            redirect('projects', 'location');

        }
    }

    function update()
    {

        # ACCESS PERMISSION
        $array_permissions = access_roles();

        if (!in_array('2', $array_permissions)) {
            redirect('not-access', 'location');
        }

        $id_projects = $this->input->post('id_projects');

        $this->load->library('form_validation');

        $this->form_validation->set_rules('projects', 'Project', 'required');
        #$this->form_validation->set_rules('id_customers', 'Customers', 'required');
        $this->form_validation->set_rules('start_projects', 'Start Project', 'required');
        $this->form_validation->set_rules('end_projects', 'End Project', 'required');
        $this->form_validation->set_rules('budget', 'Budget', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id_projects);
        } else {
            #$data['id_customers']		= $this->input->post('id_customers');
            $data['projects'] = $this->input->post('projects');
            $data['description'] = $this->input->post('description');
            $data['start_projects'] = dateSql($this->input->post('start_projects'));
            $data['end_projects'] = dateSql($this->input->post('end_projects'));
            $data['budget'] = $this->input->post('budget');
            $data['update_projects'] = gmdate("Y-m-d H:i:s", time() + 60 * 60 * 7);

            $this->load->model('m_projects');
            $this->m_projects->update_projects_by_id($id_projects, $data);

            $id_users = $this->input->post('id_users');

            $this->load->model('m_projects_assigned');

            if (!empty($id_users)) {
                foreach ($id_users as $row) {
                    $data2['id_projects'] = $id_projects;
                    $data2['id_users'] = $row;

                    $check_data = $this->m_projects_assigned->get_projects_assigned_by($data2);

                    if ($check_data->num_rows() == 0) { # NEW DATA
                        $this->m_projects_assigned->add_projects_assigned($data2);
                    }
                }
            } else { # DELETE ALL USERS PROJECTS
                $this->m_projects_assigned->delete_projects_assigned_by_id_projects($id_projects);
            }

            $users_projects = $this->m_projects_assigned->get_id_users_by_id_projects($id_projects);
            $array_diff = array_diff($users_projects, $id_users);

            if (!empty($array_diff)) {

                foreach ($array_diff as $row) {

                    $this->m_projects_assigned->delete_projects_assigned_by($id_projects, $row);

                }
            }

            $message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully updated!
						</div>';
            $this->session->set_flashdata('message', $message);
            redirect('projects', 'location');
        }
    }

    function delete($id_projects)
    {
        # ACCESS PERMISSION
        $array_permissions = access_roles();

        if (!in_array('3', $array_permissions)) {
            redirect('not-access', 'location');
        }

        $this->load->modeL('m_projects');
        $this->m_projects->delete_projects_by_id($id_projects);

        $message = '<div class="alert alert-dismissible alert-success">
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						  <strong><i class="glyphicon glyphicon-info-sign"></i> Success!</strong> Data successfully deleted!
						</div>';
        $this->session->set_flashdata('message', $message);
        redirect('projects', 'location');
    }

    function detail($id_projects)
    {
        $data['id_projects'] = $id_projects;

        $this->load->model('m_tasks');
        $this->load->model('m_projects');

        $projects = $this->m_projects->get_projects_by($data);

        if ($projects->num_rows() > 0) {
            $projects = $projects->row_array();

            $data['detail'] = $projects;
            $data['title'] = 'Detail Project';
            $data['content'] = 'content/projects/v_detail';

            $this->load->model('m_milestones');
            $data['milestones'] = $this->m_milestones->get_milestones_by_id_projects($projects['id_projects']);

            $this->load->model('m_projects_assigned');
            $data['users_projects'] = $this->m_projects_assigned->get_users_by_id_projects($projects['id_projects']);

            $data['tab_milestones'] = $this->load->view('content/projects/milestones/v_tab_milestones', $data, TRUE);
            $data['tab_tasks'] = $this->load->view('content/projects/tasklists/v_results', $data, TRUE);
            $data['tab_task_src'] = $this->load->view('content/projects/tasklists/v_tab_tasklists', $data, TRUE);
            $data['tab_messages'] = $this->load->view('content/projects/messages/v_tab_messages', $data, TRUE);
            $data['tab_files'] = $this->load->view('content/projects/files/v_tab_files', $data, TRUE);
            $data['tab_users'] = $this->load->view('content/projects/users/v_tab_users', $data, TRUE);
            $data['tab_curve'] = $this->load->view('content/projects/curve/v_tab_curve', $data, TRUE);

            $this->load->view('layouts/v_backoffice', $data);
        } else {

            redirect('projects', 'location');

        }
    }

    public function upload($id_projects)
    {
        $foldername = 'assets/uploads/' . $id_projects;
        if (!is_dir($foldername)) {
            mkdir('./' . $foldername, 0777, TRUE);
        }
        log_message('debug', 'Will put to ' . $foldername);

        $config['upload_path'] = $foldername;
        $config['allowed_types'] = '*';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('file')) {
            $error = array('error' => $this->upload->display_errors());
            log_message('error', json_encode($error));
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            log_message('debug', json_encode($data));
            echo json_encode($data);
        }
    }
}