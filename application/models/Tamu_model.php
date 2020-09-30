<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tamu_model extends CI_Model {
	public function cariTiket($asal, $tujuan, $tgl)
	{
		$this->db->select('jadwal.*, Asal.nama_stasiun AS Asal, Tujuan.nama_stasiun AS Tujuan');
		$this->db->from('jadwal');
		$this->db->join('stasiun AS Asal', 'jadwal.asal = Asal.id_stasiun', 'left');
		$this->db->join('stasiun AS Tujuan', 'jadwal.tujuan = Tujuan.id_stasiun', 'left');
		// $this->db->join('stasiun', 'stasiun.id_stasiun = jadwal.asal');
		// $this->db->join('stasiun', 'stasiun.id_stasiun = jadwal.tujuan');
		$this->db->where('asal', $asal);
		$this->db->where('tujuan', $tujuan);
		$this->db->like('tgl_berangkat', $tgl);
		return $this->db->get()->result_array();
	}

	public function tampilDataInfoPesan($id)
	{
		$this->db->select('jadwal.*, Asal.nama_stasiun AS Asal, Tujuan.nama_stasiun AS Tujuan');
		$this->db->from('jadwal');
		$this->db->join('stasiun AS Asal', 'jadwal.asal = Asal.id_stasiun', 'left');
		$this->db->join('stasiun AS Tujuan', 'jadwal.tujuan = Tujuan.id_stasiun', 'left');
		$this->db->where('jadwal.id_jadwal', $id);
		return $this->db->get()->row_array();
	}

	public function tambahDataPenumpang($jmlPenumpang, $noTiket)
	{
		for($i = 1; $i <= $jmlPenumpang; $i++) {
			$data = [
				'no_tiket' => $noTiket,
				'nama_penumpang' => $this->input->post('nama' . $i),
				'no_identitas' => $this->input->post('no_identitas' . $i)
			];
			$this->db->insert('penumpang', $data);
		}
	}

	public function tambahDataTiket($id_jadwal, $noTiket)
	{
		$data = [
			'no_tiket' => $noTiket,
			'id_jadwal' => $id_jadwal,
			'nama_pemesan' => html_escape($this->input->post('nama_pemesan', true)),
			'email' => html_escape($this->input->post('email', true)),
			'no_telp' => html_escape($this->input->post('no_telp', true)),
			'alamat' => html_escape($this->input->post('alamat', true))
		];

		$this->db->insert('tiket', $data);
	}

	public function countTiket()
	{
		return $this->db->get('tiket')->num_rows();
	}

	public function countPembayaran()
	{
		return $this->db->get('pembayaran')->num_rows();
	}

	public function tambahDataPembayaran($noPembayaran, $totalPembayaran, $noTiket)
	{
		$data = [
			'no_pembayaran' => $noPembayaran,
			'no_tiket' => $noTiket,
			'total_pembayaran' => $totalPembayaran,
			'status' => '0'
		];

		$this->db->insert('pembayaran', $data);
	}

	public function pembayaranByKode($kodeBoking)
	{
		$this->db->where('no_pembayaran', $kodeBoking);
		return $this->db->get('pembayaran');
	}

	public function cekKonfirmasi($nomor)
	{
		$this->db->where('no_tiket', $nomor);
		return $this->db->get('penumpang')->result_array();
	}

	public function uploadBuktiPembayaran($bukti, $kode)
	{
		$data = [
			'foto_bukti' => $bukti
		];

		$this->db->where('no_pembayaran', $kode);
		$this->db->update('pembayaran', $data);
	}

}