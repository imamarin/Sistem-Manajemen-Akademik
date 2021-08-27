<?php

class m_ajuan_prakerin extends CI_Model {

	public $table="ajuanprakerin";
    public $id="idpengajuan";

	public function get_all(){
		$this->db->order_by('tglpengajuan','desc');
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
		$this->db->select('ajuanprakerin.idpengajuan, ajuanprakerin.ket, siswa.nisn, siswa.nama, siswa.hp_siswa, (SELECT siswakelas.kdkelas FROM siswakelas,settahunajaran WHERE siswakelas.idtahunajaran=settahunajaran.idtahunajaran AND siswakelas.nisn=siswa.nisn AND settahunajaran.status=1) AS kdkelas, perusahaan.nmperusahaan, perusahaan.idperusahaan, perusahaan.kota, perusahaan.alamat, ajuanprakerin.tglpengajuan, ajuanprakerin.status');
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan','left');
		//$this->db->join('setprakerin','setprakerin.idprakerin=ajuanprakerin.idprakerin');
		$this->db->join('siswa','siswa.nisn=ajuanprakerin.nisn','left');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('ajuanprakerin.tglpengajuan','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join_siswa($where,$nisn){
		$this->db->select("ajuanprakerin.idpengajuan,  ajuanprakerin.ket, siswa.nisn, siswa.nama, (SELECT siswakelas.kdkelas FROM siswakelas,settahunajaran WHERE siswakelas.idtahunajaran=settahunajaran.idtahunajaran AND siswakelas.nisn=siswa.nisn AND settahunajaran.status=1) AS kdkelas, perusahaan.nmperusahaan, perusahaan.idperusahaan, perusahaan.kota, ajuanprakerin.tglpengajuan, ajuanprakerin.status, (SELECT COUNT(gp.idgroupprakerin) FROM groupprakerin as gp WHERE gp.idpengajuan = ajuanprakerin.idpengajuan AND gp.nisn='$nisn' ) AS ajuan");
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan','left');
		//$this->db->join('setprakerin','setprakerin.idprakerin=ajuanprakerin.idprakerin');
		$this->db->join('siswa','siswa.nisn=ajuanprakerin.nisn','left');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('ajuanprakerin.tglpengajuan','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join2($where){
		$this->db->select('ajuanprakerin.idpengajuan, siswa.nisn, siswa.nama, (SELECT siswakelas.kdkelas FROM siswakelas,settahunajaran WHERE siswakelas.idtahunajaran=settahunajaran.idtahunajaran AND siswakelas.nisn=siswa.nisn AND settahunajaran.status=1) AS kdkelas, perusahaan.*, ajuanprakerin.tglpengajuan, ajuanprakerin.status');
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan');
		$this->db->join('siswa','siswa.nisn=ajuanprakerin.nisn');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('ajuanprakerin.tglpengajuan','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join_groupprakerin($where){
		$this->db->select('ajuanprakerin.idperusahaan, groupprakerin.nisn');
		$this->db->join('groupprakerin','groupprakerin.idpengajuan=ajuanprakerin.idpengajuan');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_group_by($where){
		$this->db->select('perusahaan.*, ajuanprakerin.tglpengajuan, ajuanprakerin.status');
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan');
		$this->db->join('siswa','siswa.nisn=ajuanprakerin.nisn');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->group_by('ajuanprakerin.tglpengajuan','desc');
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