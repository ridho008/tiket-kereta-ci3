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

	public function konfirmasi()
	{
		$data['title'] = 'Pembayaran';
		if($this->input->get('kode')) {
			$kode = $this->input->get('kode');
			$data['noTiket'] = $this->Tamu_model->pembayaranByKode($kode)->row_array();
			$data['detail'] = $this->Tamu_model->cekKonfirmasi($data['noTiket']['no_tiket']);
		}
		$this->load->view('layout/header', $data);
		$this->load->view('tamu/konfirmasi');
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
		$harga = $this->input->post('harga');

		// Generate no pembayaran
		$cekPembayaran = $this->Tamu_model->countPembayaran() + 1;
		$noPembayaran = 'P'. date('Y') . $cekPembayaran;
		$totalPembayaran = $jmlPenumpang * $harga;

		// Input Pembayaran
		// Generate no tiket
		$cek = $this->Tamu_model->countTiket() + 1;
		$noTiket = 'T00'.$cek;
		$this->Tamu_model->tambahDataPembayaran($noPembayaran, $totalPembayaran, $noTiket);

		

		// Input Detail Penumpang
		$this->Tamu_model->tambahDataPenumpang($jmlPenumpang, $noTiket);

		// Input Detail Pemesan/Tiket
		$this->Tamu_model->tambahDataTiket($id_jadwal, $noTiket);
		$this->session->set_flashdata('nomor', $noPembayaran);
		$this->session->set_flashdata('total', $totalPembayaran);
		redirect('pembayaran', $totalPembayaran);
	}

	public function pembayaran()
	{
		$data['title'] = 'Pembayaran';
		$this->load->view('layout/header', $data);
		$this->load->view('tamu/pembayaran', $data);
		$this->load->view('layout/footer');
	}

	public function cekKonfirmasi()
	{
		$kodeBoking = html_escape($this->input->post('kode_boking', true));
		redirect('tamu/konfirmasi?kode=' . $kodeBoking);
	}

	public function kirimKonfirmasi()
	{
		$buktiFoto = $_FILES['bukti']['name'];

		if($buktiFoto) {
			$config['upload_path']          = './assets/img/bukti/';
            $config['allowed_types']        = 'jpg|png';
            $config['max_size']             = 2048;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('bukti')) {
               $bukti = $this->upload->data('file_name');
			   $kode = $this->input->post('kode');
               $this->Tamu_model->uploadBuktiPembayaran($bukti, $kode);
               $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti Pembayaran Berhasil Dikirim, Tunggu 24 Jam.</div>');
               redirect('tamu/konfirmasi');
            } else {
            	$error = array('error' => $this->upload->display_errors());
                $this->load->view('tamu/konfirmasi', $error);     
            }
		}
	}

}