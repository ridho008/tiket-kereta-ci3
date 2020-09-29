<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {
	public function joinJadwalStasiun()
	{
		$this->db->select('jadwal.*, Asal.nama_stasiun AS Asal, Tujuan.nama_stasiun AS Tujuan');
		$this->db->from('jadwal');
		$this->db->join('stasiun AS Asal', 'jadwal.asal = Asal.id_stasiun', 'left');
		$this->db->join('stasiun AS Tujuan', 'jadwal.tujuan = Tujuan.id_stasiun', 'left');
		return $this->db->get()->result_array();
	}

	public function tambahDataJadwal()
	{
		$data = [
			'nama_kereta' => html_escape($this->input->post('nama', true)),
			'asal' => html_escape($this->input->post('asal', true)),
			'tujuan' => html_escape($this->input->post('tujuan', true)),
			'tgl_berangkat' => html_escape($this->input->post('tgl_berangkat', true)),
			'tgl_sampai' => html_escape($this->input->post('tgl_sampai', true)),
			'kelas' => html_escape($this->input->post('kelas', true)),
			'status' => '1'
		];

		$this->db->insert('jadwal', $data);
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

}