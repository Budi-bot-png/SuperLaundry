<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pelanggan extends CI_Model {

	public function get_data() {
		
		return $this->db->get('pelanggan');
	}

	public function count_rows() {
		return $this->db->count_all('pelanggan');
	}

	public function get_records($pelanggan_id){
		
		$where = array('pelanggan_id' => $pelanggan_id);
		$this->db->where($where);
		return $this->db->get('pelanggan');
	}

	public function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

	public function update_data($pelanggan_id, $data, $table){
		$where = array('pelanggan_id' => $pelanggan_id);
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function delete_data($pelanggan_id, $table){
		$where = array('pelanggan_id' => $pelanggan_id);
		$this->db->where($where);
		return $this->db->delete($table);
	}

}