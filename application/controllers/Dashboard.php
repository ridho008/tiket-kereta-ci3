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

		if($this->input->post('submit')) {
			$data['keyword'] = $this->input->post('keyword');
			$this->session->set_userdata('keyword');
		} else if(!$this->input->post('submit')) {
			$data['keyword'] = $this->session->unset_userdata('keyword');
		} else {
			$data['keyword'] = $this->session->userdata('keyword');
		}

		$this->db->like('nama_stasiun', $data['keyword']);
		$this->db->from('stasiun');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];

		$config['base_url'] = 'http://localhost/tiket-kereta-ci3/dashboard/index';
		// $config['total_rows'] = $this->Dashboard_model->countAllStasiun();
		$config['per_page'] = 3;

		// Style Pagination
		$config['full_tag_open'] = '<ul class="pagination"><li class="page-item">';
		$config['full_tag_close'] = '</li></ul>';

		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</li>';

		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');

		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['stasiun'] = $this->Dashboard_model->getAllStasiun($config['per_page'], $data['start'], $data['keyword']);
		// $data['stasiun'] = $this->db->get('stasiun')->result_array();
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