<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->library('form_validation');
		$this->load->model('data_pengeluaran');
		$this->load->model('data_karyawan');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$data['data_pengeluaran'] = $this->data_pengeluaran->get_data()->result();
		$data['data_karyawan'] = $this->data_karyawan->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('pengeluaran', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'pengeluaran';
		$info['operation'] = 'Input';
		
		$detail = $this->input->post('detail');
		$total = $this->input->post('total');
		$tgl_pengeluaran = $this->input->post('tgl_pengeluaran');
		$karyawan_id = $this->input->post('karyawan_id');

		$pengeluaran_id = date('YmdHis');

		$this->load->view('header');

		$where = array(
			'pengeluaran_id' => $pengeluaran_id
		);
		$records = $this->data_pengeluaran->get_records($where)->result();

		if (count($records) == 0) {
			$data = array(
				'pengeluaran_id' => $pengeluaran_id,				
				'detail' => $detail,
				'total' => $total,
				'tgl_pengeluaran' => $tgl_pengeluaran,
				'karyawan_id' => $karyawan_id
			);
			$action = $this->data_pengeluaran->insert_data($data,'pengeluaran');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function bayar_gaji()
	{
		$info['datatype'] = 'pengeluaran';
		$info['operation'] = 'Input';

		$detail = 'Employee Salary Payment '.date('F Y');
		$total = $this->data_pengeluaran->total_gaji();;
		$tgl_pengeluaran = date('Y-m-d');
		$karyawan_id = 'K000'; //Bu Rindu

		$pengeluaran_id = date('YmdHis');

		$this->load->view('header');

		$where = array(
			'pengeluaran_id' => $pengeluaran_id
		);
		$records = $this->data_pengeluaran->get_records($where)->result();

		if (count($records) == 0) {
			$data = array(
				'pengeluaran_id' => $pengeluaran_id,				
				'detail' => $detail,
				'total' => $total,
				'tgl_pengeluaran' => $tgl_pengeluaran,
				'karyawan_id' => $karyawan_id
			);
			$action = $this->data_pengeluaran->insert_data($data,'pengeluaran');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'pengeluaran';
		$info['operation'] = 'Ubah';
		
		$pengeluaran_id = $this->input->post('pengeluaran_id');
		$detail = $this->input->post('detail');
		$total = $this->input->post('total');
		$tgl_pengeluaran = $this->input->post('tgl_pengeluaran');
		$karyawan_id = $this->input->post('karyawan_id');

		$this->load->view('header');

		$where = array(
			'pengeluaran_id' => $pengeluaran_id
		);
		$data = array(
			'pengeluaran_id' => $pengeluaran_id,				
			'detail' => $detail,
			'total' => $total,
			'tgl_pengeluaran' => $tgl_pengeluaran,
			'karyawan_id' => $karyawan_id
		);
		$action = $this->data_pengeluaran->update_data($where, $data,'pengeluaran');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

			
		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'pengeluaran';

		$pengeluaran_id = $this->uri->segment('3');

		$where = array(
			'pengeluaran_id' => $pengeluaran_id
		);

		$this->load->view('header');

		$action = $this->data_pengeluaran->delete_data($where, 'pengeluaran');
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
		$this->load->view('laporan/laporan_filter_pengeluaran');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_pengeluaran'] = $this->data_pengeluaran->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_pengeluaran', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_pengeluaran'] = $this->data_pengeluaran->filter($dari, $sampai)->result();
		
		$this->load->view('print/pengeluaran', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_pengeluaran'] = $this->data_pengeluaran->filter($dari, $sampai)->result();
		
		$this->load->view('pdf/pengeluaran', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Expenditure_Data.pdf", array('Attachment'=>0));
	}
}
