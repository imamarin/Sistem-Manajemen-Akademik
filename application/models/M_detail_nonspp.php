<?php

class m_detail_nonspp extends CI_Model {

	public function get_row($where){
		$this->db->where($where);
		return $this->db->get("detailnonspp");
	}

	public function get_row_join($where){
		$this->db->select('nonspp.*,detailnonspp.*,siswa.nama as nmsiswa,katkeuangan.nama');
		$this->db->join('nonspp','nonspp.idnonspp=detailnonspp.idnonspp','inner');
		$this->db->join('siswa','siswa.nisn=nonspp.nisn');
		$this->db->join('katkeuangan','katkeuangan.kdkatkeuangan=nonspp.kdkatkeuangan');
		$this->db->where($where);
		$this->db->order_by('detailnonspp.waktu asc');
		return $this->db->get("detailnonspp");
	}

	public function add($data){
		$this->db->insert("detailnonspp", $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function delete($where){
		$this->db->delete("detailnonspp", $where);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update("detailnonspp", $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}