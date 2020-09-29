<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		cekSession();
		$this->load->model('Jadwal_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Kelola Jadwal';
		$data['admin'] = $this->db->get_where('admin', ['username' => $this->session->userdata('username')])->row_array();
		$data['jadwal'] = $this->Jadwal_model->joinJadwalStasiun();
		$data['stasiun'] = $this->db->get('stasiun')->result_array();
		$this->form_validation->set_rules('nama', 'Nama Kereta', 'required|trim');
		$this->form_validation->set_rules('asal', 'Stasiun Asal', 'required|trim');
		$this->form_validation->set_rules('tujuan', 'Stasiun Tujuan', 'required|trim');
		$this->form_validation->set_rules('tgl_berangkat', 'Tanggal Berangkat', 'required|trim');
		$this->form_validation->set_rules('tgl_sampai', 'Tanggal Sampai', 'required|trim');
		$this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('admin/jadwal/index', $data);
			$this->load->view('layout/footer');	
		} else {
			$this->Jadwal_model->tambahDataJadwal();
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jadwal Stasiun Berhasil Ditambahkan.</div>');
			redirect('jadwal');
		}
	}

	public function ubahjadwal()
	{
		$this->Jadwal_model->ubahDataJadwal($_POST);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jadwal Stasiun Berhasil Diubah.</div>');
		redirect('jadwal');
	}

	public function getjadwal()
	{
		echo json_encode($this->Jadwal_model->getJadwalById($_POST['id']));
	}

	public function hapus($id)
	{
		$this->db->delete('jadwal', ['id_jadwal' => $id]);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Jadwal Stasiun Berhasil Dihapus.</div>');
		redirect('jadwal');
	}


}