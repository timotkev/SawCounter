<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_tasks extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_tasks_running_by_id_projects_milestones($id_projects, $id_milestones){
		$this->db->select('tbl_tasks.tasks tasks,tbl_tasks.id_tasks id_tasks');
        $this->db->where('id_milestones', $id_milestones);
        $this->db->where('id_projects', $id_projects);
        $this->db->where('status_tasks', '0');
        $this->db->from('tbl_tasks');

        $query = $this->db->get();
		return $query->result_array();
	}

    function get_assigned_user_for_task($id_tasks){
        $this->db->select('tbl_users.fullname fullname');
        $this->db->from('tbl_tasks');
        $this->db->join('tbl_tasks_assigned', 'tbl_tasks_assigned.id_tasks = tbl_tasks.id_tasks');
        $this->db->join('tbl_users', 'tbl_tasks_assigned.id_users = tbl_users.id_users');

        $this->db->where('tbl_tasks.id_tasks', $id_tasks);

        $query = $this->db->get();
        return $query->result_array();
    }

	function get_tasks_finish_by_id_projects_milestones($id_projects, $id_milestones){
		$this->db->select('*');
		$this->db->where('id_milestones', $id_milestones);
		$this->db->where('id_projects', $id_projects);
		$this->db->where('status_tasks', '1');
		$this->db->from('tbl_tasks');

		$query = $this->db->get();
		return $query->result_array();
	}

    function get_finished_tasks_by_id_projects($id_projects){
        $this->db->select('*');
        $this->db->where('id_projects', $id_projects);
        $this->db->where('status_tasks', '1');
        $this->db->from('tbl_tasks');
        $this->db->order_by('update_tasks');

        $query = $this->db->get();
        return $query->result_array();
    }

	function get_tasks_by($data){
        return $this->db->get_where('tbl_tasks', $data);
    }

	function add_tasks($data){
		return $this->db->insert('tbl_tasks', $data);
	}

	function update_tasks_by_id($id_tasks, $data) {
        $this->db->where('id_tasks', $id_tasks);
        return $this->db->update('tbl_tasks', $data);
    }

    function delete_tasks_by_id($id_tasks){
        $this->db->where('id_tasks', $id_tasks);
        return $this->db->delete('tbl_tasks');
    }
}