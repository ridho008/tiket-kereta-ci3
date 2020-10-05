<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function getKonfirmasiPembayaran()
	{
		return $this->db->get_where('pembayaran', ['status' => '1'])->result_array();
	}

	public function perbaruiPembayaran($id)
	{
		$this->db->where('id_pembayaran', $id);
		$this->db->update('pembayaran', ['status' => '2']);
	}

	public function aksiTambahKursi($bagian, $kursi, $id_jadwal)
	{
		for($i = 1; $i <= $kursi; $i++) {
			$data = [
				'id_jadwal' => $id_jadwal,
				'kursi' => $i,
				'bagian_kursi' => $bagian
			];
			$this->db->insert('kursi', $data);
		}
	}

	public function getJadwal()
	{
		$this->db->select('jadwal.*, Asal.nama_stasiun AS Asal, Tujuan.nama_stasiun AS Tujuan');
		$this->db->from('jadwal');
		$this->db->join('stasiun AS Asal', 'jadwal.asal = Asal.id_stasiun', 'left');
		$this->db->join('stasiun AS Tujuan', 'jadwal.tujuan = Tujuan.id_stasiun', 'left');
		return $this->db->get()->result_array();
	}

	public function joinJadwalKursi()
	{
		$this->db->select('*');
		$this->db->from('kursi');
		$this->db->join('jadwal', 'jadwal.id_jadwal = kursi.id_jadwal');
		return $this->db->get()->result_array();
	}

}