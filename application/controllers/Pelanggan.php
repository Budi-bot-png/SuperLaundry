<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller {

	function __construct(){
		parent::__construct();
		// cek sesi login
		if ($this->session->userdata('status') != "login") {
			redirect(base_url().'welcome?pesan=belumlogin');
		}
		$this->load->library('form_validation');
		$this->load->model('data_pelanggan');
	}

	public function index()
	{
		$user['username'] = $this->session->userdata('username');
		$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('pelanggan', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function add()
	{
		$info['datatype'] = 'pelanggan';
		$info['operation'] = 'Input';
		
		$pelanggan_id = $this->input->post('pelanggan_id');
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$jeniskelamin = $this->input->post('jeniskelamin');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');

		$this->load->view('header');

		$records = $this->data_pelanggan->get_records($pelanggan_id)->result();
		if (count($records) == 0) {
			$data = array(
				'pelanggan_id' => $pelanggan_id,
				'nama_pelanggan' => $nama_pelanggan,
				'jeniskelamin' => $jeniskelamin,
				'alamat' => $alamat,
				'no_hp' => $no_hp
			);
			$action = $this->data_pelanggan->insert_data($data,'pelanggan');
			$this->load->view('notifications/insert_success', $info);	
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}
		$this->load->view('source');	
	}

	public function edit()
	{
		$info['datatype'] = 'pelanggan';
		$info['operation'] = 'Ubah';
		
		$pelanggan_id = $this->input->post('pelanggan_id');
		$nama_pelanggan = $this->input->post('nama_pelanggan');
		$jeniskelamin = $this->input->post('jeniskelamin');
		$alamat = $this->input->post('alamat');
		$no_hp = $this->input->post('no_hp');

		$this->load->view('header');

		$data = array(
			'pelanggan_id' => $pelanggan_id,
			'nama_pelanggan' => $nama_pelanggan,
			'jeniskelamin' => $jeniskelamin,
			'alamat' => $alamat,
			'no_hp' => $no_hp
		);
		$action = $this->data_pelanggan->update_data($pelanggan_id, $data,'pelanggan');

		if ($action) {
			$this->load->view('notifications/insert_success', $info);
		} else {
			$this->load->view('notifications/insert_failed', $info);
		}

		$this->load->view('source');	
	}

	public function delete()
	{
		$info['datatype'] = 'pelanggan';

		$pelanggan_id = $this->uri->segment('3');

		$this->load->view('header');

		$action = $this->data_pelanggan->delete_data($pelanggan_id, 'pelanggan');
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
		$this->load->view('laporan/laporan_filter_pelanggan');
		$this->load->view('footer');
		$this->load->view('source');
	}

	public function laporan_filter()
	{
		$user['username'] = $this->session->userdata('username');
		
		$jeniskelamin = $this->input->post('jeniskelamin');

		if ($jeniskelamin == "Semua") {
			$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		} else {
			$data['data_pelanggan'] = $this->db->query("select * from pelanggan where jeniskelamin = '$jeniskelamin'")->result();
		}

		$this->load->view('header');
		$this->load->view('navigation', $user);
		$this->load->view('laporan/laporan_pelanggan', $data);
		$this->load->view('footer');
		$this->load->view('source');
	}

	function print() {	

		$jeniskelamin = $this->uri->segment('3');

		$data['jeniskelamin'] = $jeniskelamin;
		if ($jeniskelamin == "Semua") {
			$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		} else {
			$data['data_pelanggan'] = $this->db->query("select * from pelanggan where jeniskelamin = '$jeniskelamin'")->result();
		}
		
		$this->load->view('print/pelanggan', $data);
	}

	function cetak_pdf() {
		$this->load->library('dompdf_gen');
		
		$jeniskelamin = $this->uri->segment('3');

		$data['jeniskelamin'] = $jeniskelamin;
		if ($jeniskelamin == "Semua") {
			$data['data_pelanggan'] = $this->data_pelanggan->get_data()->result();
		} else {
			$data['data_pelanggan'] = $this->db->query("select * from pelanggan where jeniskelamin = '$jeniskelamin'")->result();
		}
		
		$this->load->view('pdf/pelanggan', $data);
		
		$paper_size = 'A4';
		$orientation = 'landscape';
		$html = $this->output->get_output();
		$this->dompdf->set_paper($paper_size, $orientation);

		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Customer_Data.pdf", array('Attachment'=>0));
	}
}
