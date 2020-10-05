<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
	public function tambahDataStasiun()
	{
		$stasiun['nama_stasiun'] = html_escape($this->input->post('stasiun', true));
		$this->db->insert('stasiun', $stasiun);
	}

	public function ubahDataStasiun($data)
	{
		$stasiun['nama_stasiun'] = html_escape($data['stasiun']);
		$id_stasiun = $data['id_stasiun'];
		$this->db->where('id_stasiun', $id_stasiun);
		$this->db->update('stasiun', $stasiun);
	}

	public function getStasiunById($id)
	{
		return $this->db->get_where('stasiun', ['id_stasiun' => $id])->row_array();
	}

	public function countAllStasiun()
	{
		return $this->db->get('stasiun')->num_rows();
	}

	public function getAllStasiun($limit, $start, $keyword)
	{
		if($keyword) {
			$this->db->like('nama_stasiun', $keyword);
		}
		return $this->db->get('stasiun', $limit, $start)->result_array();
	}

	public function hapusSemuaStasiun($table)
	{
		$this->db->truncate($table);
	}

}