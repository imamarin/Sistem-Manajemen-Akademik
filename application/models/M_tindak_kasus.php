<?php

class m_tindak_kasus extends CI_Model {

	public $table="tindakkasus";
    public $id="idtindakkasus";

	public function get_all(){
		$this->db->order_by($this->id,'desc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row($data){
		
		$this->db->where($data);
		$this->db->order_by('idtindakkasus','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join_siswa($where){
		$this->db->select('siswa.nisn,siswa.nama,siswakelas.kdkelas,COUNT(siswa.nisn) AS kasus');
		$this->db->join('siswa','siswa.nisn=tindakkasus.nisn');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->group_by('siswa.nisn');
		return $this->db->get($this->table);
	}

	public function get_count($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function update2($data){
		$this->db->update($this->table,$data);
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}