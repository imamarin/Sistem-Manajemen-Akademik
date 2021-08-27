<?php

class M_walikelas extends CI_Model {

	public $table="walikelas";

	public function get_all_join(){
		$this->db->join('guru','guru.kdguru=walikelas.kdguru');
		$this->db->join('kelas','kelas.kdkelas=walikelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=walikelas.idtahunajaran');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row($where){
		$this->db->join('guru','guru.kdguru=walikelas.kdguru');
		$this->db->join('kelas','kelas.kdkelas=walikelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=walikelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row2($where){
		$this->db->select('kelas.kdkelas, guru.kdguru, guru.nama, kelas.tingkat, (SELECT COUNT(siswakelas.nisn) FROM siswakelas,siswa WHERE siswakelas.nisn=siswa.nisn AND siswa.status=1 AND siswakelas.kdkelas=kelas.kdkelas AND siswakelas.idtahunajaran=settahunajaran.idtahunajaran) AS totalsiswa');
		$this->db->join('guru','guru.kdguru=walikelas.kdguru');
		$this->db->join('kelas','kelas.kdkelas=walikelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=walikelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	
	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}