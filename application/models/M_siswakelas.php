<?php

class m_siswakelas extends CI_Model {

	public $table="siswakelas";

	public function get_all(){
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	
	public function get_group_kelas(){
		$this->db->select("kdkelas,count(kdkelas) as jmlsiswa");
		$this->db->group_by('kdkelas');
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

	public function get_row_group_by($data){
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->where($data);
		$this->db->group_by('siswakelas.kdkelas');
		return $this->db->get($this->table);
	}

	public function get_row_join_tahunajaran($where){
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_walikelas($where){
		$this->db->select('kelas.kdkelas, guru.kdguru, guru.nama, kelas.tingkat,settahunajaran.idtahunajaran');
		$this->db->join('siswa','siswa.nisn=siswakelas.nisn');
		$this->db->join('kelas','kelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('walikelas','walikelas.kdkelas=siswakelas.kdkelas');
		$this->db->join('guru','guru.kdguru=walikelas.kdguru');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}


	public function update($n,$data){
		$this->db->where($n);
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
	}

	public function kode_otomatis(){
		$this->db->select('right(kodemitra,4) as kode', false);
		$this->db->order_by('kodemitra','desc');
		$this->db->limit(1);
		$query=$this->db->get('mitra');
		if($query->num_rows()<>0){
			$data=$query->row();
			$kode=intval($data->kode)+1;
		}else{
			$kode=1001;
		}

		/*$kodemax=str_pad($kode,3,"0", STR_PAD_LEFT);
		$kd=1000+$kodemax;*/
		$kodejadi='S'.$kode;

		return $kodejadi;
	}

}