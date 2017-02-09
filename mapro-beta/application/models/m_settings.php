<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_settings extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function get_settings_by_name($setting_name){
		$this->db->select('setting_value');
		$this->db->where('setting_name', $setting_name);
		$this->db->from('tbl_settings');

		$query 	= $this->db->get();
		$hasil 	= '';

		if($query->num_rows() > 0){
			$row = $query->row_array();
			$hasil = $row['setting_value'];
		}

		return $hasil;
	}

	function update_settings_by_name($setting_name, $setting_value) {
        $this->db->where('setting_name', $setting_name);
        return $this->db->update('tbl_settings', array('setting_value' => $setting_value));
    }
}