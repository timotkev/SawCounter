<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    function index()
    {
        $data['title'] = 'Dashboard';
        $data['content'] = 'content/dashboard/v_dashboard';
        $this->load->model('m_projects');
        $projects = $this->m_projects->get_assigned_projects($this->session->userdata('mapro_login')['id_users']);
        $projects_ongoing = array();
        $projects_closed = array();

        if (!empty($projects)) {
            foreach ($projects as $project) {
                $item['projects'] = $project['projects'];
                $item['id_projects'] = $project['id_projects'];
                if ($project['status'] == 0) {
                    array_push($projects_ongoing, $item);
                } else array_push($projects_closed, $item);
            }
        }

        $data['projects_ongoing'] = $projects_ongoing;
        $data['projects_closed'] = $projects_closed;

        $this->load->view('layouts/v_backoffice', $data);
    }
}