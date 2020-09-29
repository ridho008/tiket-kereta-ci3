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
		$this->load->view('layout/header', $data);
		$this->load->view('tamu/index', $data);
		$this->load->view('layout/footer');
	}

}