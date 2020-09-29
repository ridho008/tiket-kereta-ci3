<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Dashboard';
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
		$data['stasiun'] = $this->db->get('stasiun')->result_array();

		$this->form_validation->set_rules('stasiun', 'Stasiun', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('admin/dashboard', $data);
			$this->load->view('layout/footer');	
		} else {
			$this->Dashboard_model->tambahDataStasiun();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Stasiun Berhasil Ditambahkan.</div>');
			redirect('dashboard');
		}
	}

	public function ubahstasiun()
	{
		$this->Dashboard_model->ubahDataStasiun($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Stasiun Berhasil Diubah.</div>');
		redirect('dashboard');
	}

	public function getubah()
	{
		echo json_encode($this->Dashboard_model->getStasiunById($_POST['id']));
	}

	public function hapus($id)
	{
		$this->db->delete('stasiun', ['id_stasiun' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Stasiun Berhasil Dihapus.</div>');
		redirect('dashboard');
	}


}