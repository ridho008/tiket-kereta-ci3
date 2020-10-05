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
		$this->db->where('status', '0');
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
			'alamat' => html_escape($this->input->post('alamat', true)),
			'tanggal' => date('Y-m-d')
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
		$this->db->where('penumpang.no_tiket', $nomor);
		return $this->db->get('penumpang')->result_array();
	}

	public function uploadBuktiPembayaran($bukti, $kode)
	{
		$data = [
			'foto_bukti' => $bukti,
			'status' => '1'
		];

		$this->db->where('no_pembayaran', $kode);
		$this->db->update('pembayaran', $data);
	}

	public function pemilihanKursi($data, $noTiket)
	{
		$this->db->where('no_tiket', $noTiket);
		$this->db->update('penumpang', $data);
	}

	public function pemilihanGerbong($data, $id_penumpang)
	{
		$this->db->where('id_penumpang', $id_penumpang);
		$this->db->update('penumpang', $data);
	}

	public function getPenumpangById($id)
	{
		$this->db->where('id_penumpang', $id);
		return $this->db->get('penumpang')->row_array();
	}

	public function getPenumpangByNoTiket($noTiket)
	{
		$this->db->where('no_tiket', $noTiket);
		return $this->db->get('penumpang')->num_rows();
	}

	public function getTiketByKode($noTiket)
	{
		return $this->db->get_where('tiket', ['no_tiket' => $noTiket])->row_array();
	}

	public function validasiGerbongKursi($gerbong, $bagian, $kursi, $id_jadwal)
	{
		$this->db->where('gerbong', $gerbong);
		$this->db->where('bagian', $bagian);
		$this->db->where('kursi', $kursi);
		$this->db->where('tiket.id_jadwal', $id_jadwal);
		$this->db->join('tiket', 'tiket.no_tiket = penumpang.no_tiket');
		return $this->db->get('penumpang')->num_rows();
	}

	public function ambilTiketPembayaran($noTiket)
	{
		$this->db->select('*, Asal.nama_stasiun AS Asal, Tujuan.nama_stasiun AS Tujuan');
		$this->db->join('jadwal', 'jadwal.id_jadwal = tiket.id_jadwal');
		$this->db->join('stasiun AS Asal', 'jadwal.asal = Asal.id_stasiun', 'left');
		$this->db->join('stasiun AS Tujuan', 'jadwal.tujuan = Tujuan.id_stasiun', 'left');
		$this->db->where('tiket.no_tiket', $noTiket);
		return $this->db->get('tiket')->row_array();
	}

	public function getTiketWhere($noTiket)
	{
		return $this->db->get_where('tiket', ['no_tiket' => $noTiket])->row_array();
	}

	public function getKursiWhere($bagian, $id_jadwal)
	{
		$this->db->select('*, kursi.kursi AS Kursi');
		// $this->db->join('penumpang', 'penumpang.bagian = kursi.bagian_kursi');
		// $this->db->join('tiket', 'tiket.no_tiket = penumpang.no_tiket');
		$this->db->where('kursi.id_jadwal', $id_jadwal);
		$this->db->where('kursi.bagian_kursi', $bagian);
		$this->db->where('kursi.status', 0);
		return $this->db->get('kursi')->result_array();
	}

	public function updateKursi($id_kursi)
	{
		$data = [
			'status' => '1'
		];
		$this->db->where('id_kursi', $id_kursi);
		$this->db->update('kursi', $data);
	}

}