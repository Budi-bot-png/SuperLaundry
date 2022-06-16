<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_transaksi extends CI_Model {

	public function get_data() {
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
		$this->db->join('karyawan', 'karyawan.karyawan_id = transaksi.karyawan_id');
		$this->db->order_by('transaksi_id', 'desc');
		return $this->db->get();
	}

	public function count_rows() {
		return $this->db->count_all('transaksi');
	}

	public function count_active() {
		$this->db->select('*');
	    $this->db->from('transaksi');
	    $this->db->where('tgl_selesai','0000-00-00');
	    $num_results = $this->db->count_all_results();

	    return $num_results;
	}

	public function get_records($where){
		$this->db->where($where);
		return $this->db->get('transaksi');
	}

	public function get_full_records($where){
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->join('pelanggan', 'pelanggan.pelanggan_id = transaksi.pelanggan_id');
		$this->db->join('karyawan', 'karyawan.karyawan_id = transaksi.karyawan_id');
		$this->db->where($where);
		return $this->db->get();
	}

	public function filter($dari, $sampai) {
		return $this->db->query("select * from transaksi join karyawan on transaksi.karyawan_id = karyawan.karyawan_id join pelanggan on transaksi.pelanggan_id = pelanggan.pelanggan_id where tgl_selesai >= '$dari' and tgl_selesai <= '$sampai'");
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

	public function total_income_year(){
	    $result = $this->db->query("select sum(total) as total_pendapatan from transaksi where year(tgl_selesai) = year(curdate())")->result();

	    return $result[0]->total_pendapatan;
	}
}