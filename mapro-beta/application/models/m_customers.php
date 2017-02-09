<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_customers extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_total_customers($param = array()){

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.customers_name', $param['keyword']);
			$this->db->or_like('t1.address', $param['keyword']);
			$this->db->or_like('t1.contact_person', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.customers_name', $param['keyword']);
			$this->db->or_like('t1.address', $param['keyword']);
			$this->db->or_like('t1.contact_person', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.customers_name', $param['keyword']);
			$this->db->or_like('t1.address', $param['keyword']);
			$this->db->or_like('t1.contact_person', $param['keyword']);
		}

		return $this->db->count_all_results('tbl_customers as t1');
	}

	function get_customers($param = array()){
		$this->db->select('t1.id_customers, t1.customers_name, t1.address, t1.contact_person, t1.registered');

		if(array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param))
		{
			$this->db->like('t1.customers_name', $param['keyword']);
			$this->db->or_like('t1.address', $param['keyword']);
			$this->db->or_like('t1.contact_person', $param['keyword']);

			$this->db->limit($param['limit'], $param['start']);

		} else if(array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit'], $param['start']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.customers_name', $param['keyword']);
			$this->db->or_like('t1.address', $param['keyword']);
			$this->db->or_like('t1.contact_person', $param['keyword']);

			$this->db->limit($param['limit']);
		} else if(!array_key_exists('start', $param) && array_key_exists('limit', $param) && !array_key_exists('keyword', $param)) {
			$this->db->limit($param['limit']);
		} else if(array_key_exists('keyword', $param)) {
			
			$this->db->like('t1.customers_name', $param['keyword']);
			$this->db->or_like('t1.address', $param['keyword']);
			$this->db->or_like('t1.contact_person', $param['keyword']);
		}

		if(array_key_exists('sort', $param)) { 
			if($param['sort'] == 'roles_asc'){
				$this->db->order_by('t1.roles','ASC');
			} else if($param['sort'] == 'roles_desc'){
				$this->db->order_by('t1.roles','DESC');
			} else if($param['sort'] == 'registered_asc'){
				$this->db->order_by('t1.registered','ASC');
			} else if($param['sort'] == 'registered_desc'){
				$this->db->order_by('t1.registered','DESC');
			}
		} else {
			$this->db->order_by('t1.customers_name','ASC');
		}

		$this->db->from('tbl_customers as t1');
		
		$data = $this->db->get();

		return $data->result_array();
	}

	function get_all_customers_name(){
		$this->db->select('id_customers, customers_name');
		$this->db->from('tbl_customers');
		$this->db->order_by('customers_name', 'ASC');

		$query = $this->db->get();
		return $query->result_array();
	}
	function get_customers_by($data){
        return $this->db->get_where('tbl_customers', $data);
    }

	function add_customers($data){
		return $this->db->insert('tbl_customers', $data);
	}

	function update_customers_by_id($id_customers, $data) {
        $this->db->where('id_customers', $id_customers);
        return $this->db->update('tbl_customers', $data);
    }

    function delete_customers_by_id($id_customers){
        $this->db->where('id_customers', $id_customers);
        return $this->db->delete('tbl_customers');
    }
}