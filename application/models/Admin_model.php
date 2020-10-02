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

}