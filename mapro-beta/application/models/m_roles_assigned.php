<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_roles_assigned extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function add_roles_assigned($data){
		return $this->db->insert('tbl_roles_assigned', $data);
	}

	function update_users_by_id_users($id_users, $data) {
        $this->db->where('id_users', $id_users);
        return $this->db->update('tbl_roles_assigned', $data);
    }
}