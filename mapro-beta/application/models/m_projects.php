<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_projects extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_total_projects($param = array()){

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.projects', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.projects', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.projects', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);
		}

		return $this->db->count_all_results('tbl_projects as t1');
	}

	function get_projects($param = array()){
		$this->db->select('t1.id_projects, t1.projects, t1.description, t1.start_projects, t1.end_projects, t1.budget, t1.status');

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.projects', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.projects', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.projects', $param['keyword']);
			$this->db->or_like('t1.description', $param['keyword']);
		}

		if(array_key_exists('sort', $param)) { 
			if($param['sort'] == 'projects_asc'){
				$this->db->order_by('t1.projects','ASC');
			} else if($param['sort'] == 'projects_desc'){
				$this->db->order_by('t1.projects','DESC');
			} else if($param['sort'] == 'description_asc'){
				$this->db->order_by('t1.description','ASC');
			} else if($param['sort'] == 'description_desc'){
				$this->db->order_by('t1.description','DESC');
			} else if($param['sort'] == 'start_projects_asc'){
				$this->db->order_by('t1.start_projects','ASC');
			} else if($param['sort'] == 'start_projects_desc'){
				$this->db->order_by('t1.start_projects','DESC');
			} else if($param['sort'] == 'end_projects_asc'){
				$this->db->order_by('t1.end_projects','ASC');
			} else if($param['sort'] == 'end_projects_desc'){
				$this->db->order_by('t1.end_projects','DESC');
			}
		} else {
			$this->db->order_by('t1.start_projects','DESC');
		}

		$this->db->from('tbl_projects as t1');
		
		$data = $this->db->get();

		return $data->result_array();
	}

	function get_projects_by($data){
        return $this->db->get_where('tbl_projects', $data);
    }

	function add_projects($data){
		return $this->db->insert('tbl_projects', $data);
	}

	function update_projects_by_id($id_projects, $data) {
        $this->db->where('id_projects', $id_projects);
        return $this->db->update('tbl_projects', $data);
    }

    function delete_projects_by_id($id_projects){
        $this->db->where('id_projects', $id_projects);
        return $this->db->delete('tbl_projects');
    }

    function get_assigned_projects($id_users){
        $this->db->select('tbl_projects.status status, tbl_projects.projects projects, tbl_projects.id_projects id_projects');
        $this->db->from('tbl_projects');
        $this->db->join('tbl_projects_assigned', 'tbl_projects_assigned.id_projects = tbl_projects.id_projects');

        $this->db->where('tbl_projects_assigned.id_users', $id_users);

        $query = $this->db->get();
        return $query->result_array();
    }
}