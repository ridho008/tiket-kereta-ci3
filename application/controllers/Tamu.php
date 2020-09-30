<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tamu_model');
		$this->load->helper('form');
	}

	public function index()
	{
		$data['title'] = 'Kereta API Indo';
		$data['stasiun'] = $this->db->get('stasiun')->result_array();
		$this->load->view('layout/header', $data);
		$this->load->view('tamu/index');
		$this->load->view('layout/footer');
	}

	public function pembayaran()
	{
		$data['title'] = 'Pembayaran';
		$this->load->view('layout/header', $data);
		$this->load->view('tamu/pembayaran');
		$this->load->view('layout/footer');
	}

	public function cari_tiket()
	{
		$asal = $this->input->post('asal', true);
		$tujuan = $this->input->post('tujuan', true);
		$tgl = $this->input->post('tgl', true);
		$data['title'] = 'Kereta API Indo';
		$data['stasiun'] = $this->db->get('stasiun')->result_array();
		$data['tiket'] = $this->Tamu_model->cariTiket($asal, $tujuan, $tgl);
		$data['penumpang'] = $this->input->post('penumpang');
		$this->load->view('layout/header', $data);
		$this->load->view('tamu/index', $data);
		$this->load->view('layout/footer');
	}

	public function pesan($id)
	{
		$data['title'] = 'Formulir Pesan Tiket Kereta API';
		$data['info'] = $this->Tamu_model->tampilDataInfoPesan($id);
		$this->load->view('layout/header', $data);
		$this->load->view('tamu/form_pesan', $data);
		$this->load->view('layout/footer');
	}

	public function pesanTiket()
	{
		$jmlPenumpang = $this->input->post('penumpang');
		$id_jadwal = $this->input->post('id_jadwal');

		// Generate no tiket
		$cek = $this->Tamu_model->countTiket() + 1;
		$noTiket = 'T00'.$cek;

		// Input Detail Penumpang
		$this->Tamu_model->tambahDataPenumpang($jmlPenumpang, $noTiket);

		// Input Detail Pemesan/Tiket
		$this->Tamu_model->tambahDataTiket($id_jadwal, $noTiket);
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Diri Anda Berhasil Dikirim.</div>');
		redirect('tamu/pembayaran');
	}

}