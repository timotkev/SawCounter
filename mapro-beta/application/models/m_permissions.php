<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_permissions extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_total_permissions($param = array()){
		$this->db->where_not_in('t1.parent_permissions', '0');
		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.permissions', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.permissions', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.permissions', $param['keyword']);
		}

		return $this->db->count_all_results('tbl_permissions as t1');
	}

	function get_permissions($param = array()){
		$this->db->select('t1.id_permissions, t1.permissions');
		$this->db->where_not_in('t1.parent_permissions', '0');

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.permissions', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.permissions', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.permissions', $param['keyword']);
		}

		if(array_key_exists('sort', $param)) { 
			if($param['sort'] == 'permissions_asc'){
				$this->db->order_by('t1.permissions','ASC');
			} else if($param['sort'] == 'permissions_desc'){
				$this->db->order_by('t1.permissions','DESC');
			} else if($param['sort'] == 'id_permissions_asc'){
				$this->db->order_by('t1.id_permissions','ASC');
			} else if($param['sort'] == 'id_permissions_desc'){
				$this->db->order_by('t1.id_permissions','DESC');
			}
		} else {
			$this->db->order_by('t1.parent_permissions','ASC');
			$this->db->order_by('t1.id_permissions','ASC');
		}

		$this->db->from('tbl_permissions as t1');
		
		$data = $this->db->get();

		return $data->result_array();
	}

	function get_all_parent_permissions(){
		$this->db->select('id_permissions, permissions');
		$this->db->where('parent_permissions', '0');
		$this->db->from('tbl_permissions');
		$this->db->order_by('permissions', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}

	function get_all_permissions_by_parent_permissions($parent_permissions){
		$this->db->select('id_permissions, permissions');
		$this->db->where('parent_permissions', $parent_permissions);
		$this->db->from('tbl_permissions');
		$this->db->order_by('id_permissions', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}

	function get_permissions_by($data){
        return $this->db->get_where('tbl_permissions', $data);
    }

	function add_permissions($data){
		return $this->db->insert('tbl_permissions', $data);
	}

	function update_permissions_by_id($id_permissions, $data) {
        $this->db->where('id_permissions', $id_permissions);
        return $this->db->update('tbl_permissions', $data);
    }

    function delete_permissions_by_id($id_permissions){
        $this->db->where('id_permissions', $id_permissions);
        return $this->db->delete('tbl_permissions');
    }
}