<?php

class m_group_prakerin extends CI_Model {

	public $table="groupprakerin";
    public $id="idgroupprakerin";

	public function get_all(){
		return $this->db->get($this->table);
	}

	public function get_all_join(){
		$this->db->select('ajuanprakerin.idajuanprakerin,siswa.nisn, siswa.nama, siswakelas.kdkelas, perusahaan.nmperusahan, perusahaan.kota, ajuanprakerin.tglpengajuan');
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan');
		$this->db->join('ajuanprakerin','ajuanprakerin.nisn=siswa.nisn');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->order_by('ajuanprakerin.tglpengajuan','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join($where){
		$this->db->select('siswa.nisn, siswa.hp_siswa, siswa.jk, siswa.nama, siswakelas.kdkelas,groupprakerin.idgroupprakerin');
		$this->db->join('siswa','siswa.nisn=groupprakerin.nisn');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('siswa.nama','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join2($where){
		$this->db->select('siswa.nisn, siswa.jk, siswa.nama,jurusan.*');
		$this->db->join('siswa','siswa.nisn=groupprakerin.nisn');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('jurusan','jurusan.kdjurusan=kelas.kdjurusan');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('siswa.nama','desc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row($data){
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function get_row2($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	
	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update2($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}