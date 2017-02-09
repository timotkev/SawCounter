<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_total_users($param = array()){
		
		$this->db->join('tbl_roles_assigned as t2', 't1.id_users = t2.id_users');

		if(array_key_exists('id_roles_users', $param)){
			$this->db->where('t2.id_roles', $param['id_roles_users']);
		}

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.username', $param['keyword']);
			$this->db->or_like('t1.email', $param['keyword']);
			$this->db->or_like('t1.fullname', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.username', $param['keyword']);
			$this->db->or_like('t1.email', $param['keyword']);
			$this->db->or_like('t1.fullname', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.username', $param['keyword']);
			$this->db->or_like('t1.email', $param['keyword']);
			$this->db->or_like('t1.fullname', $param['keyword']);
		}

		return $this->db->count_all_results('tbl_users as t1');
	}

	function get_users($param = array()){
		$this->db->select('t1.id_users, t1.username, t1.email, t1.fullname, t1.active, t1.registered');
		$this->db->join('tbl_roles_assigned as t2', 't1.id_users = t2.id_users');

		if(array_key_exists('id_roles_users', $param)){
			$this->db->where('t2.id_roles', $param['id_roles_users']);
		}

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.username', $param['keyword']);
			$this->db->or_like('t1.email', $param['keyword']);
			$this->db->or_like('t1.fullname', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.username', $param['keyword']);
			$this->db->or_like('t1.email', $param['keyword']);
			$this->db->or_like('t1.fullname', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.username', $param['keyword']);
			$this->db->or_like('t1.email', $param['keyword']);
			$this->db->or_like('t1.fullname', $param['keyword']);
		}

		if(array_key_exists('sort', $param)) { 
			if($param['sort'] == 'username_asc'){
				$this->db->order_by('t1.username','ASC');
			} else if($param['sort'] == 'username_desc'){
				$this->db->order_by('t1.username','DESC');
			} else if($param['sort'] == 'email_asc'){
				$this->db->order_by('t1.email','ASC');
			} else if($param['sort'] == 'email_desc'){
				$this->db->order_by('t1.email','DESC');
			} else if($param['sort'] == 'fullname_asc'){
				$this->db->order_by('t1.fullname','ASC');
			} else if($param['sort'] == 'fullname_desc'){
				$this->db->order_by('t1.fullname','DESC');
			}
		} else {
			$this->db->order_by('t2.id_roles','ASC');
			$this->db->order_by('t1.username','ASC');
			$this->db->order_by('t1.registered','ASC');
		}

		$this->db->from('tbl_users as t1');
		
		$data = $this->db->get();

		return $data->result_array();
	}

	function get_password_by_id_users($id_users){
		$this->db->select('password');
		$this->db->where('id_users', $id_users);
		$this->db->from('tbl_users', $id_users);

		$query = $this->db->get();
		$hasil = '';

		if($query->num_rows() > 0){
			$row = $query->row_array();
			$hasil = $row['password'];
		}

		return $hasil;
	}

	function get_all_users_with_id_and_username(){
		$this->db->select('id_users, username');
		$this->db->from('tbl_users');
		$this->db->order_by('username', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}

	function get_users_by($data){
        return $this->db->get_where('tbl_users', $data);
    }

    function get_users_by_id_users($id_users){
    	$this->db->select('t1.*, t2.id_roles');
		$this->db->join('tbl_roles_assigned as t2', 't1.id_users = t2.id_users');
		$this->db->where('t1.id_users', $id_users);
		$this->db->from('tbl_users as t1');

		$query = $this->db->get();
		return $query->row_array();
    }

	function add_users($data){
		return $this->db->insert('tbl_users', $data);
	}

	function update_users_by_id($id_users, $data) {
        $this->db->where('id_users', $id_users);
        return $this->db->update('tbl_users', $data);
    }

    function delete_user_by_id($id_users){
        $this->db->where('id_users', $id_users);
        return $this->db->delete('tbl_users');
    }
}