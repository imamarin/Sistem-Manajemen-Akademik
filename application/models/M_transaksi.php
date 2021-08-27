<?php

class m_transaksi extends CI_Model {

	public function get_row_spp($where){
		$this->db->where($where);
		return $this->db->get("spp");
	}


}