<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_roles extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_total_roles($param = array()){

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.roles', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.roles', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.roles', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);
		}

		return $this->db->count_all_results('tbl_roles as t1');
	}

	function get_roles($param = array()){
		$this->db->select('t1.id_roles, t1.roles, t1.description');

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.roles', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.roles', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.roles', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);
		}

		if(array_key_exists('sort', $param)) { 
			if($param['sort'] == 'roles_asc'){
				$this->db->order_by('t1.roles','ASC');
			} else if($param['sort'] == 'roles_desc'){
				$this->db->order_by('t1.roles','DESC');
			} else if($param['sort'] == 'description_asc'){
				$this->db->order_by('t1.description','ASC');
			} else if($param['sort'] == 'description_desc'){
				$this->db->order_by('t1.description','DESC');
			}
		} else {
			$this->db->order_by('t1.roles','ASC');
		}

		$this->db->from('tbl_roles as t1');
		
		$data = $this->db->get();

		return $data->result_array();
	}

	function get_all_roles(){
		$this->db->select('id_roles, roles, description');
		$this->db->from('tbl_roles');
		$this->db->order_by('roles', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}

	function get_roles_by($data){
        return $this->db->get_where('tbl_roles', $data);
    }

	function add_roles($data){
		return $this->db->insert('tbl_roles', $data);
	}

	function update_roles_by_id($id_roles, $data) {
        $this->db->where('id_roles', $id_roles);
        return $this->db->update('tbl_roles', $data);
    }

    function delete_roles_by_id($id_roles){
        $this->db->where('id_roles', $id_roles);
        return $this->db->delete('tbl_roles');
    }
}