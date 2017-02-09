<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_projects_assigned extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_id_users_by_id_projects($id_projects){
		$this->db->select('id_users');
		$this->db->where('id_projects', $id_projects);
		$this->db->from('tbl_projects_assigned');

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

	function get_users_by_id_projects($id_projects){
		$this->db->select('t1.id_users, t2.username, t2.fullname');
		$this->db->join('tbl_users as t2', 't1.id_users = t2.id_users');
		$this->db->where('t1.id_projects', $id_projects);
		$this->db->from('tbl_projects_assigned as t1');
		$this->db->order_by('t1.id_projects_assigned', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}

	function get_projects_assigned_by($data){
        return $this->db->get_where('tbl_projects_assigned', $data);
    }

	function add_projects_assigned($data){
		return $this->db->insert('tbl_projects_assigned', $data);
	}

	function update_projects_assigned_by_id($id_projects_assigned, $data) {
        $this->db->where('id_projects_assigned', $id_projects_assigned);
        return $this->db->update('tbl_projects_assigned', $data);
    }

    function delete_projects_assigned_by_id_projects($id_projects){
        $this->db->where('id_projects', $id_projects);
        return $this->db->delete('tbl_projects_assigned');
    }

    function delete_projects_assigned_by($id_projects, $id_users){
        $this->db->where('id_projects', $id_projects);
        $this->db->where('id_users', $id_users);
        return $this->db->delete('tbl_projects_assigned');
    }
}