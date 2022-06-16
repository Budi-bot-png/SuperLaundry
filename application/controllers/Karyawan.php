<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		};
		$this->load->library('form_validation');
		$this->load->model('data_karyawan');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$data['data_karyawan'] = $this->data_karyawan->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('karyawan', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'karyawan';
		$info['operation'] = 'Input';
		
		$karyawan_id = $this->input->post('karyawan_id');
		$nama_karyawan = $this->input->post('nama_karyawan');
		$jeniskelamin = $this->input->post('jeniskelamin');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$gaji_perbulan = $this->input->post('gaji_perbulan');
		$tgl_bergabung = $this->input->post('tgl_bergabung');
		$tgl_berhenti = $this->input->post('tgl_berhenti');

		$aktif = 0;

		if ($tgl_berhenti == null) {
			$aktif = 1;
		}

		$this->load->view('header');

		$records = $this->data_karyawan->get_records($karyawan_id)->result();
		if (count($records) == 0) {
			$data = array(
				'karyawan_id' => $karyawan_id,
				'nama_karyawan' => $nama_karyawan,
				'jeniskelamin' => $jeniskelamin,
				'alamat' => $alamat,
				'no_hp' => $no_hp,
				'gaji_perbulan' => $gaji_perbulan,
				'tgl_bergabung' => $tgl_bergabung,
				'tgl_berhenti' => $tgl_berhenti,
				'aktif' => $aktif
			);
			$action = $this->data_karyawan->insert_data($data,'karyawan');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'karyawan';
		$info['operation'] = 'Ubah';
		
		$karyawan_id = $this->input->post('karyawan_id');
		$nama_karyawan = $this->input->post('nama_karyawan');
		$jeniskelamin = $this->input->post('jeniskelamin');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');
		$gaji_perbulan = $this->input->post('gaji_perbulan');
		$tgl_bergabung = $this->input->post('tgl_bergabung');
		$tgl_berhenti = $this->input->post('tgl_berhenti');

		$aktif = 0;

		if ($tgl_berhenti == null) {
			$aktif = 1;
		}

		$this->load->view('header');

		$data = array(
			'karyawan_id' => $karyawan_id,
			'nama_karyawan' => $nama_karyawan,
			'jeniskelamin' => $jeniskelamin,
			'alamat' => $alamat,
			'no_hp' => $no_hp,
			'gaji_perbulan' => $gaji_perbulan,
			'tgl_bergabung' => $tgl_bergabung,
			'tgl_berhenti' => $tgl_berhenti,
			'aktif' => $aktif
		);
		$action = $this->data_karyawan->update_data($karyawan_id, $data,'karyawan');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'karyawan';

		$karyawan_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_karyawan->delete_data($karyawan_id, 'karyawan');
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
		$this->load->view('laporan/laporan_filter_karyawan');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');

		$dari = $this->input->post('dari');
		$sampai = $this->input->post('sampai');

		$data['data_karyawan'] = $this->data_karyawan->filter($dari, $sampai)->result();

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_karyawan', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_karyawan'] = $this->data_karyawan->filter($dari, $sampai)->result();
		
		$this->load->view('print/karyawan', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$dari = $this->uri->segment('3');
		$sampai = $this->uri->segment('4');

		$data['dari'] = $dari;
		$data['sampai'] = $sampai;
		$data['data_karyawan'] = $this->data_karyawan->filter($dari, $sampai)->result();
		
		$this->load->view('pdf/karyawan', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Employee_Data.pdf", array('Attachment'=>0));
	}
}
