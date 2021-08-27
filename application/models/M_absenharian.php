<?php

class m_absenharian extends CI_Model {

	public $table="absensiharian";

	public function get_all(){
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
	}

	public function get_row($data){
		$this->db->where($data);
		return $this->db->get($this->table);
	}


	public function get_row2($where){
		$this->db->join('user','user.iduser=siswa.iduser');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row3($data){
		$this->db->join('jadwal','jadwal.idjadwal=absensi.idjadwal');
		$this->db->join('setjadwal','setjadwal.idsetjadwal=jadwal.idsetjadwal');		
		$this->db->where($data);
		$this->db->order_by('absensi.waktu','asc');
		return $this->db->get($this->table);
	}

	public function get_row4($data){
		$this->db->join('detailabsensiharian','detailabsensiharian.idabsensiharian=absensiharian.idabsensiharian');
		$this->db->join('siswakelas','siswakelas.nisn=detailabsensiharian.nisn');
		$this->db->where($data);
		$this->db->group_by('absensiharian.waktu');
		return $this->db->get($this->table);
	}

	public function update($n,$data){
		$this->db->where($n);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
	}


}