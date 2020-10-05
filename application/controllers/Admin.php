<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Login';
		$this->cekLogin();
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('admin/login');
			$this->load->view('layout/footer');	
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		$admin = $this->db->get_where('admin', ['username' => $username])->row_array();

		if($admin != null) {
			if(sha1($password) == $admin['password']) {
				$data = [
					'username' => $admin['username'],
					'id_admin' => $admin['id_admin']
				];
				$this->session->set_userdata($data);
				$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">'. $data['username'] .' Berhasil Masuk ke Dashboard</div>');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah!!.</div>');
				redirect('admin');
			}
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akun tidak terdaftar!!.</div>');
			redirect('admin');
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('id_admin');
		$this->session->unset_userdata('username');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Logout.</div>');
		redirect('admin');
	}

	public function cekLogin()
	{
		if($this->session->userdata('username')) {
			redirect('dashboard');
		}
	}

	// Konfirmasi Pembayaran
	public function pembayaran()
	{
		$data['title'] = 'Konfirmasi Pembayaran';
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
		$data['pembayaran'] = $this->Admin_model->getKonfirmasiPembayaran();
		$this->load->view('layout/header', $data);
		$this->load->view('admin/pembayaran/index');
		$this->load->view('layout/footer');
	}

	public function verifikasi($id)
	{
		$this->Admin_model->perbaruiPembayaran($id);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Berhasil Melakukan Konfirmasi Pembayaran.</div>');
		redirect('admin/pembayaran');
	}

	// Kelola Gerbong
	public function gerbong()
	{
		$data['title'] = 'Kelola Gerbong';
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
		$data['kursi'] = $this->Admin_model->joinJadwalKursi();
		$data['jadwal'] = $this->Admin_model->getJadwal();
		$this->load->view('layout/header', $data);
		$this->load->view('admin/gerbong/index');
		$this->load->view('layout/footer');
	}

	public function tambahKursi()
	{
		$bagian = $this->input->post('bagian');
		$kursi = $this->input->post('kursi');
		$id_jadwal = $this->input->post('jadwal');
		$this->Admin_model->aksiTambahKursi($bagian, $kursi, $id_jadwal);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">'.$kursi.' Kursi Dijadwal '. $id_jadwal .' Berhasil Ditambahkan.</div>');
		redirect('admin/gerbong');
	}

}