<?php

class m_nilairaport extends CI_Model {

	public $table="nilairaport";
	public $id="idnilairaport";
	
	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join($where){
		$this->db->join('matpel','matpel.kdmatpel=nilairaport.kdmatpel');
		$this->db->join('kelas','kelas.kdkelas=nilairaport.kdkelas');
		$this->db->join('guru','guru.kdguru=nilairaport.kdguru');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=nilairaport.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join1($where){
		$this->db->select('nilairaport.*, matpel.*, kelas.*, guru.*, settahunajaran.tahun');
		$this->db->join('matpel','matpel.kdmatpel=nilairaport.kdmatpel');
		$this->db->join('kelas','kelas.kdkelas=nilairaport.kdkelas');
		$this->db->join('guru','guru.kdguru=nilairaport.kdguru');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=nilairaport.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join2($where,$nisn){
		$this->db->select("matpel.matpel, kelas.kdkelas, nilairaport.judul, settahunajaran.tahun, settahunajaran.semester, (SELECT du.nilai FROM detailnilairaport as du WHERE du.nisn='$nisn' AND du.idnilairaport=nilairaport.idnilairaport) AS nilai");
		$this->db->join('matpel','matpel.kdmatpel=nilairaport.kdmatpel');
		$this->db->join('kelas','kelas.kdkelas=nilairaport.kdkelas');
		$this->db->join('guru','guru.kdguru=nilairaport.kdguru');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=nilairaport.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join3($where){
		$this->db->select('nilairaport.*, matpel.*, kelas.*, guru.*, settahunajaran.tahun');
		$this->db->select("(SELECT SUM(IF(detailnilairaport.pengetahuan >= 1 OR detailnilairaport.keterampilan >= 1,1,0)) FROM detailnilairaport WHERE  detailnilairaport.idnilairaport=nilairaport.idnilairaport ) AS jmlsiswa");
		$this->db->select("(SELECT COUNT(siswakelas.kdkelas) FROM siswakelas,siswa WHERE siswakelas.nisn=siswa.nisn AND siswakelas.kdkelas=kelas.kdkelas AND siswakelas.idtahunajaran=settahunajaran.idtahunajaran AND siswa.status=1) AS totalsiswa");
		$this->db->join('matpel','matpel.kdmatpel=nilairaport.kdmatpel');
		$this->db->join('kelas','kelas.kdkelas=nilairaport.kdkelas');
		$this->db->join('guru','guru.kdguru=nilairaport.kdguru');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=nilairaport.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function delete($where){
		$this->db->delete($this->table, $where);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}