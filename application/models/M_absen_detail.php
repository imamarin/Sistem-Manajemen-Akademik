<?php

class m_absen_detail extends CI_Model {

	public $table="detailabsensi";
    public $id="iddetailabsensi";

	public function get_all(){
		$this->db->join('siswa','siswa.nis=absensi.nis');
		$this->db->join('siswakelas','siswakelas.nis=siswa.nis');
		$this->db->join('kelas','kelas.idkelas=siswakelas.idkelas');		
		$this->db->order_by('siswa.'.$this->id,'asc');
		return $this->db->get($this->table);
	}

	public function get_all2(){
		$this->db->join('kelas','kelas.idkelas=siswa.idkelas');
		$this->db->order_by("siswa.".$this->id,'asc');
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

	public function get_row3($where){
		$this->db->select('absensi.idjadwal,absensi.waktu,setjadwal.*,jadwal.*,detailabsensi.*');
		$this->db->join('absensi','absensi.idabsensi=detailabsensi.idabsensi');
		$this->db->join('jadwal','jadwal.idjadwal=absensi.idjadwal');
		$this->db->join('setjadwal','setjadwal.idsetjadwal=jadwal.idsetjadwal');		
		$this->db->where($where);
		$this->db->order_by('absensi.waktu','asc');
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