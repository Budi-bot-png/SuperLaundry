<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		};
		$this->load->library('form_validation');
		$this->load->model('data_transaksi');
		$this->load->model('data_pelanggan');
		$this->load->model('data_karyawan');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$data['data_transaksi'] = $this->data_transaksi->get_data()->result();
		$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		$data['data_karyawan'] = $this->data_karyawan->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('transaksi', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Input';
		
		$pelanggan_id = $this->input->post('pelanggan_id');
		$karyawan_id = $this->input->post('karyawan_id');
		$berat = $this->input->post('berat');
		$tgl_order = $this->input->post('tgl_order');
		$tgl_selesai = $this->input->post('tgl_selesai');

		date_default_timezone_set("Asia/Jakarta");
		$transaksi_id = date('YmdHis');
		$total = $berat * 7000;

		$this->load->view('header');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$records = $this->data_transaksi->get_records($where)->result();

		if (count($records) == 0) {
			$data = array(
				'transaksi_id' => $transaksi_id,
				'pelanggan_id' => $pelanggan_id,
				'karyawan_id' => $karyawan_id,
				'berat' => $berat,
				'total' => $total,
				'tgl_order' => $tgl_order,
				'tgl_selesai' => $tgl_selesai
			);
			$action = $this->data_transaksi->insert_data($data,'transaksi');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Ubah';
		
		$transaksi_id = $this->input->post('transaksi_id');
		$pelanggan_id = $this->input->post('pelanggan_id');
		$karyawan_id = $this->input->post('karyawan_id');
		$berat = $this->input->post('berat');
		$tgl_order = $this->input->post('tgl_order');
		$tgl_selesai = $this->input->post('tgl_selesai');

		$total = $berat * 7000;

		$this->load->view('header');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$data = array(
			'transaksi_id' => $transaksi_id,
			'pelanggan_id' => $pelanggan_id,
			'karyawan_id' => $karyawan_id,
			'berat' => $berat,
			'total' => $total,
			'tgl_order' => $tgl_order,
			'tgl_selesai' => $tgl_selesai
		);
		$action = $this->data_transaksi->update_data($where, $data,'transaksi');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

			
		$this->load->view('source');	
	}

	public function done()
	{
		$info['datatype'] = 'transaksi';
		$info['operation'] = 'Ubah';
		
		$transaksi_id = $this->uri->segment('3');
		$tgl_selesai = date('Y-m-d'); //Tambahkan tgl selesai order

		$action = $this->db->query("update transaksi set tgl_selesai = '$tgl_selesai' where transaksi_id = '$transaksi_id'");

		$this->load->view('header');
		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}	
		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'transaksi';

		$transaksi_id = $this->uri->segment('3');

		$where = array(
			'transaksi_id' => $transaksi_id
		);

		$this->load->view('header');

		$action = $this->data_transaksi->delete_data($where, 'transaksi');
		if ($action) {
			$this->load->view('notifications/delete_success', $info);
		} else {
			$this->load->view('notifications/delete_failed', $info);
		}

		$this->load->view('source');
	}

	public function laporan()
	{
		$user['username'] = $this->session->userdata('username');
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_filter_transaksi');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_transaksi'] = $this->data_transaksi->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_transaksi', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_transaksi'] = $this->data_transaksi->filter($dari, $sampai)->result();
		
		$this->load->view('print/transaksi', $data);
	}

	function print_nota() {	

		$transaksi_id = $this->uri->segment('3');

		$where = array(
			'transaksi_id' => $transaksi_id
		);
		$data['data_transaksi'] = $this->data_transaksi->get_full_records($where)->result();
		
		$this->load->view('print/nota_transaksi', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_transaksi'] = $this->data_transaksi->filter($dari, $sampai)->result();
		
		$this->load->view('pdf/transaksi', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Transaction_Detail.pdf", array('Attachment'=>0));
	}
}
