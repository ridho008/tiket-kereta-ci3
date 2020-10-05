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
			$tiket = $this->Tamu_model->getTiketWhere($data['noTiket']['no_tiket']);

			$data['bagianA'] = $this->Tamu_model->getKursiWhere('a', $tiket['id_jadwal']);
			// var_dump($data['bagianA']); die;
			$data['bagianB'] = $this->Tamu_model->getKursiWhere('b', $tiket['id_jadwal']);
		}
		$this->form_validation->set_rules('kode_boking', 'Kode Booking', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('layout/header', $data);
			$this->load->view('tamu/konfirmasi');
			$this->load->view('layout/footer');
		} else {
			$this->cekKonfirmasi();
		}
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
		
		$result = $this->db->get_where('pembayaran', ['no_pembayaran' => $kodeBoking])->row_array();
		if($result) {
			redirect('tamu/konfirmasi?kode=' . $kodeBoking);
		} else {
			if(count($result) == 0) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Kode Booking Tidak Terdaftar!</div>');
            	redirect('tamu/konfirmasi');
			} 
		}
	}

	public function kirimKonfirmasi()
	{
		$buktiFoto = $_FILES['bukti']['name'];
		$kode = $this->input->post('kode');
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
			   $noTiket = $this->input->post('noTiket');
			   // Pemilihan Kursi
			 //   $data = [
			 //   	   'gerbong' => $this->input->post('gerbong', true),
				//    'bagian' => $this->input->post('bagian', true),
				//    'kursi' => $this->input->post('kursi', true)
				// ];
			 //   $this->Tamu_model->pemilihanKursi($data, $noTiket);
	           $this->Tamu_model->uploadBuktiPembayaran($bukti, $kode);
	           $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Bukti Pembayaran Berhasil Dikirim, Tunggu 24 Jam.</div>');
	           redirect('tamu/konfirmasi');
	        } else {
	        	$error = array('error' => $this->upload->display_errors());
	            $this->load->view('tamu/konfirmasi', $error);     
	        }
		} else {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Anda Harus Upload Bukti Pembayaran.</div>');
			redirect('tamu/konfirmasi?kode=' . $kode);
		}

	}


	public function getgerbong()
	{
		echo json_encode($this->Tamu_model->getPenumpangById($_POST['id']));
	}

	public function pilihgerbong()
	{
		$kode = $this->input->post('kode');
	   	$id_penumpang = $this->input->post('id_penumpang');
		$this->form_validation->set_rules('gerbong', 'Gerbong', 'required|trim');
		$this->form_validation->set_rules('bagian', 'Bagian', 'required|trim');
		// $this->form_validation->set_rules('kursi', 'Kursi', 'required|trim');
		if($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Inputan Gerbong, Bagian, Kursi Wajib Diisi.</div>');
	    	redirect('tamu/konfirmasi?kode=' . $kode);
		} else {
		   	// Pemilihan gerbong, bagian & kursi
		   	$gerbong = $this->input->post('gerbong', true);
		   	$bagian = $this->input->post('bagian', true);
		   	$kursi = $this->input->post('kursi', true);
		   	$noTiket = $this->input->post('no_tiket');

		   	$data = [
		   	   'gerbong' => $gerbong,
			   'bagian' => $bagian,
			   'kursi' => $kursi
			];

			$noPembayaran = $this->Tamu_model->pembayaranByKode($kode['no_tiket'])->row_array();
			// Update Kursi
			$tbTiket = $this->Tamu_model->getTiketByKode($noPembayaran['no_tiket']);
			$this->Tamu_model->updateKursi($kursi);

			// jika kursi sudah ada di pilih
			$tiket = $this->Tamu_model->getTiketByKode($noTiket);
			$id_jadwal = $tiket['id_jadwal'];
			// var_dump($tiket); die;
			$cek  = $this->Tamu_model->validasiGerbongKursi($gerbong, $bagian, $kursi, $id_jadwal);

			if($cek > 0) {
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert"><i class="fas fa-info-circle"></i> Maaf Kursi No. '. $kursi .' Sudah Dipesan Oleh Orang. Silahkan Pilih Nomor Kursi Lainnya.</div>');
			    redirect('tamu/konfirmasi?kode=' . $kode);
			} else {
		   		$this->Tamu_model->pemilihanGerbong($data, $id_penumpang);
			    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Anda Berhasil Memilih Gerbong.</div>');
			    redirect('tamu/konfirmasi?kode=' . $kode);
			}



		}
	}

	public function ubahgerbong()
	{
		$kode = $this->input->post('kode');
	   	$id_penumpang = $this->input->post('id_penumpang');
	   	// Pemilihan Kursi
	   	$data = [
	   	   'gerbong' => $this->input->post('gerbong', true),
		   'bagian' => $this->input->post('bagian', true),
		   'kursi' => $this->input->post('kursi', true)
		];
	   	$this->Tamu_model->pemilihanGerbong($data, $id_penumpang);
	    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"><i class="fas fa-info-circle"></i> Anda Berhasil Mengubah Gerbong.</div>');
	    redirect('tamu/konfirmasi?kode=' . $kode);
	}

	public function cetak()
	{
		$data['title'] = 'Cetak Pembayaran Kereta API';
		$noTiket = $this->input->post('no_tiket');
		$data['detail'] = $this->Tamu_model->ambilTiketPembayaran($noTiket);
		$data['jmlPenumpang'] = $this->Tamu_model->getPenumpangByNoTiket($noTiket);
		$this->load->view('layout/header', $data);
		$this->load->view('cetak/print_pembayaran', $data);
	}

}