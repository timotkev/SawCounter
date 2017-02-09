<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_tasks_assigned extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_id_users_by_id_tasks($id_tasks){
		$this->db->select('id_users');
		$this->db->where('id_tasks', $id_tasks);
		$this->db->from('tbl_tasks_assigned');

		$query = $this->db->get();

		$result = array();

		if($query->num_rows() > 0){
			$data = array();
			foreach($query->result_array() as $row){
				$data[$row['id_users']] = $row['id_users'];

				$result = $data;
			}
		}

		return $result;
	}

	function add_tasks_assigned($data){
		return $this->db->insert('tbl_tasks_assigned', $data);
	}

	function get_tasks_assigned_by($data){
        return $this->db->get_where('tbl_tasks_assigned', $data);
    }

    function delete_tasks_assigned_by_id_tasks($id_tasks){
        $this->db->where('id_tasks', $id_tasks);
        return $this->db->delete('tbl_tasks_assigned');
    }

    function delete_tasks_assigned_by($id_tasks, $id_users){
        $this->db->where('id_tasks', $id_tasks);
        $this->db->where('id_users', $id_users);
        return $this->db->delete('tbl_tasks_assigned');
    }

}