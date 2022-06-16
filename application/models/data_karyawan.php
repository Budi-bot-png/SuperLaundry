<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_karyawan extends CI_Model {

	public function get_data() {
		return $this->db->get('karyawan');
	}

	public function count_rows() {
		return $this->db->count_all('karyawan');
	}

	public function get_records($karyawan_id){
		$where = array('karyawan_id' => $karyawan_id);
		$this->db->where($where);
		return $this->db->get('karyawan');
	}

	public function filter($dari, $sampai){
		return $this->db->query("select * from karyawan where (tgl_berhenti >= '$dari' and tgl_berhenti <= '$sampai') or (tgl_bergabung <= '$sampai' and  tgl_berhenti = '0000-00-00') and (aktif <= 1)");
	}

	public function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

	public function update_data($karyawan_id, $data, $table){
		$where = array('karyawan_id' => $karyawan_id);
		$this->db->where($where);
		return $this->db->update($table, $data);
	}

	public function delete_data($karyawan_id, $table){
		$where = array('karyawan_id' => $karyawan_id);
		$this->db->where($where);
		return $this->db->delete($table);
	}

}