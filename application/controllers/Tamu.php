<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Tamu_model');
	}

	public function index()
	{
		$data['title'] = 'Kereta API Indo';
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

}