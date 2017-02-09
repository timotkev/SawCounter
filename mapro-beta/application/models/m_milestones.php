<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_milestones extends CI_Model {

	function __construct(){
		parent::__construct();
	}


	function get_milestones_by_id_projects($id_projects, $status = 0){
		$this->db->select('*');
		$this->db->where('id_projects', $id_projects);
		$this->db->where('status_milestones', $status);
		$this->db->from('tbl_milestones');
		$this->db->order_by('status_milestones', 'ASC');
		$this->db->order_by('start_milestones', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}

	function get_milestones_by($data){
        return $this->db->get_where('tbl_milestones', $data);
    }

	function add_milestones($data){
		return $this->db->insert('tbl_milestones', $data);
	}

	function update_milestones_by_id($id_milestones, $data) {
        $this->db->where('id_milestones', $id_milestones);
        return $this->db->update('tbl_milestones', $data);
    }

    function delete_milestones_by_id($id_milestones){
        $this->db->where('id_milestones', $id_milestones);
        return $this->db->delete('tbl_milestones');
    }
}