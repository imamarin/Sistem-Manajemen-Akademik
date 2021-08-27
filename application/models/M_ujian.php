<?php

class m_ujian extends CI_Model {

	public $table="ujian";
	public $id="idujian";
	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join($where){
		$this->db->join('matpel','matpel.kdmatpel=ujian.kdmatpel');
		$this->db->join('kelas','kelas.kdkelas=ujian.kdkelas');
		$this->db->join('guru','guru.kdguru=ujian.kdguru');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=ujian.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join2($where,$nisn){
		$this->db->select("matpel.matpel, kelas.kdkelas, ujian.judul, settahunajaran.tahun, settahunajaran.semester, (SELECT du.nilai FROM detailujian as du WHERE du.nisn='$nisn' AND du.idujian=ujian.idujian) AS nilai");
		$this->db->join('matpel','matpel.kdmatpel=ujian.kdmatpel');
		$this->db->join('kelas','kelas.kdkelas=ujian.kdkelas');
		$this->db->join('guru','guru.kdguru=ujian.kdguru');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=ujian.idtahunajaran');
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