<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_authentication extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_check_login($param1, $param2){
		$this->db->select('t1.id_users, t1.fullname, t2.id_roles');
		$this->db->join('tbl_roles_assigned as t2', 't1.id_users = t2.id_users');
		$this->db->where('t1.username', $param1);
		$this->db->where('t1.password', $param2);
		$this->db->or_where('t1.email', $param1);
		$this->db->where('t1.password', $param2);
		$this->db->from('tbl_users as t1');

		$query = $this->db->get();
		return $query->row_array();
	}
}