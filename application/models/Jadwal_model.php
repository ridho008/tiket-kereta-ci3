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

	public function ubahDataJadwal($data)
	{
		$id_jadwal = $data['id_jadwal'];
		$arr = [
			'nama_kereta' => html_escape($data['nama']),
			'asal' => html_escape($data['asal']),
			'tujuan' => html_escape($data['tujuan']),
			'tgl_berangkat' => html_escape($data['tgl_berangkat']),
			'tgl_sampai' => html_escape($data['tgl_sampai']),
			'kelas' => html_escape($data['kelas'])
		];

		$this->db->where('id_jadwal', $id_jadwal);
		$this->db->update('jadwal', $arr);
	}

	public function getJadwalById($id)
	{
		return $this->db->get_where('jadwal', ['id_jadwal' => $id])->row_array();
	}

}