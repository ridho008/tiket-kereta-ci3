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

}