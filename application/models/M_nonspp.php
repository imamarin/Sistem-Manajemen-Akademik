<?php

class m_nonspp extends CI_Model {

	public function get_row($where){
		$this->db->where($where);
		return $this->db->get("nonspp");
	}

	public function get_row_join($where){
		$this->db->select('nonspp.*,detailnonspp.*, SUM(detailnonspp.bayar) AS total');
		$this->db->join('detailnonspp','detailnonspp.idnonspp=nonspp.idnonspp','inner');
		$this->db->where($where);
		$this->db->group_by('detailnonspp.idnonspp');
		$this->db->order_by('nonspp.idnonspp asc, detailnonspp.iddetailnonspp desc');
		return $this->db->get("nonspp");
	}

	public function get_row_nonspp_join($where){
		$this->db->select('nonspp.*,detailnonspp.*,siswa.nama as nmsiswa,katkeuangan.nama');
		$this->db->join('detailnonspp','detailnonspp.idnonspp=nonspp.idnonspp','inner');
		$this->db->join('katkeuangan','katkeuangan.kdkatkeuangan=nonspp.kdkatkeuangan','inner');
		$this->db->join('siswa','siswa.nisn=nonspp.nisn');
		$this->db->where($where);
		return $this->db->get("nonspp");
	}

	public function get_row_join2($where){
		$this->db->select('nonspp.*,detailnonspp.*,katkeuangan.*, (SELECT SUM(dns.bayar) FROM detailnonspp as dns,nonspp as ns WHERE dns.idnonspp = ns.idnonspp
		AND ns.kdkatkeuangan=katkeuangan.kdkatkeuangan AND ns.nisn=nonspp.nisn) AS tagihan');
		$this->db->join('detailnonspp','detailnonspp.idnonspp=nonspp.idnonspp','inner');
		$this->db->join('katkeuangan','katkeuangan.kdkatkeuangan=nonspp.kdkatkeuangan','inner');
		$this->db->where($where);
		$this->db->group_by('detailnonspp.idnonspp');
		$this->db->order_by('nonspp.idnonspp asc, detailnonspp.iddetailnonspp desc');
		return $this->db->get("nonspp");
	}

	public function get_row_group($where){
		$this->db->join('detailnonspp','detailnonspp.idnonspp=nonspp.idnonspp');
		$this->db->where($where);
		$this->db->group_by("DATE_FORMAT(detailnonspp.waktu, '%Y-%m-%d')");
		return $this->db->get("nonspp");
	}

	public function add($data){
		$this->db->insert("nonspp", $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function delete($where){
		$this->db->delete("nonspp", $where);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update("nonspp", $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}