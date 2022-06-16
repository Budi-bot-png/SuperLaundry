<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_pengeluaran extends CI_Model {

	public function get_data() {
		$this->db->select('*');
		$this->db->from('pengeluaran');
		$this->db->join('karyawan', 'karyawan.karyawan_id = pengeluaran.karyawan_id');
		return $this->db->get();
	}

	public function count_rows() {
		return $this->db->count_all('pengeluaran');
	}

	public function get_records($where){
		$this->db->where($where);
		return $this->db->get('pengeluaran');
	}

	public function filter($dari, $sampai) {
		return $this->db->query("select * from pengeluaran join karyawan on pengeluaran.karyawan_id = karyawan.karyawan_id where tgl_pengeluaran >= '$dari' and tgl_pengeluaran <= '$sampai'");
	}

	public function insert_data($data, $table){
		$this->db->insert($table, $data);
	}

	public function update_data($where, $data, $table){
		$this->db->where($where);
		return $this->db->replace($table, $data);
	}

	public function delete_data($where, $table){
		$this->db->where($where);
		return $this->db->delete($table);
	}

	public function total_gaji(){
		$result = $this->db->query("select sum(gaji_perbulan) as total_gaji from karyawan where aktif = 1")->result();

	    return $result[0]->total_gaji;
	}

	public function total_spend_year(){
		$result = $this->db->query("select sum(total) as total_pengeluaran from pengeluaran where year(tgl_pengeluaran) = year(curdate())")->result();

	    return $result[0]->total_pengeluaran;
	}
}