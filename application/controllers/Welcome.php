<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller{

	function __construct() {
		parent::__construct();
		$this->load->model('data_user');
		$this->load->library('form_validation');
	}
	
	function index() {
		$this->load->view('header');
		$this->load->view('login');
		$this->load->view('source');
	}

	function login() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->form_validation->set_rules('username','Username','trim|required');
		$this->form_validation->set_rules('password','Password','trim|required');
		if($this->form_validation->run() != false){
			$where = array(
						'username' => $username,
						'password' => md5($password)
					);
			$data = $this->data_user->get_records($where);
			$d = $this->data_user->get_records($where)->row();
			$cek = $data->num_rows();
			if($cek > 0){
				$session = array(
							'user_id'=> $d->user_id,
							'username'=> $d->username,
							'level'=> $d->level,
							'status' => 'login'
						   );
			$this->session->set_userdata($session);
			redirect(base_url().'dashboard');
			} else {
				redirect(base_url().'welcome?pesan=gagal');
			}
		} else {
			$this->load->view('login');
		}
	}

	function logout(){
		$this->session->sess_destroy();
		$this->load->view('header');
		$this->load->view('notifications/logout_success');
		$this->load->view('source');
	}
}
