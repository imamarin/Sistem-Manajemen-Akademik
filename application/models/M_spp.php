<?php

class m_spp extends CI_Model {

	public function get_row_spp($where){
		$this->db->where($where);
		return $this->db->get("spp");
	}

	public function get_row_spp_join($where){
		$this->db->join('siswa','siswa.nisn=spp.nisn');
		$this->db->where($where);
		$this->db->order_by('spp.waktu asc');
		return $this->db->get("spp");
	}

	public function get_row_spp_join2($where){
		$this->db->join('siswa','siswa.nisn=spp.nisn');
		$this->db->where($where);
		return $this->db->get("spp");
	}

	public function get_row_group($where){
		$this->db->where($where);
		$this->db->group_by("DATE_FORMAT(waktu, '%Y-%m-%d')");
		return $this->db->get("spp");
	}

	public function get_row_tagihan($where){
		$this->db->select("siswa.nisn,siswa.nama,siswa.tgl_terima,siswakelas.kdkelas,
		(SELECT COUNT(idspp) FROM spp WHERE spp.nisn=siswa.nisn) AS tagihanspp,
		(SELECT SUM(dns.bayar) FROM detailnonspp as dns,nonspp as ns WHERE dns.idnonspp = ns.idnonspp
		AND ns.nisn=siswa.nisn) AS tagihannonspp,
		(SELECT SUM(kk.biaya) FROM katkeuangan as kk WHERE kk.nama != 'SPP' AND kk.idtahunajaran=siswa.idtahunajaran 
		AND (kk.jurusan='semua' OR kk.jurusan = kelas.kdjurusan) ) AS biaya");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('settahunajaran','siswakelas.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get("siswa");
	}


	public function add($data){
		$this->db->insert("spp", $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function delete($where){
		$this->db->delete("spp", $where);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}