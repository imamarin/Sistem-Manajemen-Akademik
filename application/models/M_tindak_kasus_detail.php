<?php

class m_tindak_kasus_detail extends CI_Model {

	public $table="tindakkasusdetail";
    public $id="idtindakkasusdetail";

	public function get_all(){
		$this->db->order_by($this->id,'desc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row($data){

		$this->db->join('guru','guru.kdguru=tindakkasusdetail.kdguru');
		$this->db->where($data);
		$this->db->order_by('idtindakkasus','desc');
		return $this->db->get($this->table);
	}

	public function get_row2($data,$kode){
		$this->db->select("tindakkasusdetail.*, (SELECT nama FROM karyawan WHERE kdkaryawan=tindakkasusdetail.kdguru) AS nmk, (SELECT nama FROM guru WHERE kdguru=tindakkasusdetail.kdguru) AS nmg");
		$this->db->where($data);
		$this->db->order_by('idtindakkasus','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join_siswa($where){
		$this->db->select('siswa.nisn,siswa.nama,siswakelas.kdkelas,kasussiswa.*');
		$this->db->join('siswa','siswa.nisn=kasussiswa.nisn');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->where($where);
		$this->db->order_by('kasussiswa.tgl_laporan','desc');
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