<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_roles_permissions extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_permissions_by_id_roles($id_roles){
		
		$this->db->select('id_permissions');
		$this->db->where('id_roles', $id_roles);
		$this->db->from('tbl_roles_permissions');

		$query = $this->db->get();
		$results = array();

		if($query->num_rows() > 0){

			$data = array();

			foreach($query->result_array() as $row){

				$data[$row['id_permissions']] 	= $row['id_permissions'];
				$results 	= $data;
			}
		}

		return $results;
	}

	function add_roles_permissions($data){
		return $this->db->insert('tbl_roles_permissions', $data);
	}

	function get_roles_permissions_by($data){
        return $this->db->get_where('tbl_roles_permissions', $data);
    }

    function update_roles_permissions_by_id($id_customers, $data) {
        $this->db->where('id_customers', $id_customers);
        return $this->db->update('tbl_roles_permissions', $data);
    }

    function delete_roles_permissions_by_id_roles($id_roles){
        $this->db->where('id_roles', $id_roles);
        return $this->db->delete('tbl_roles_permissions');
    }

    function delete_roles_permissions_by($id_roles, $id_permissions){
        $this->db->where('id_roles', $id_roles);
        $this->db->where('id_permissions', $id_permissions);
        return $this->db->delete('tbl_roles_permissions');
    }
}