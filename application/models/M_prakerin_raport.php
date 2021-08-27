<?php

class m_prakerin_raport extends CI_Model {

	public $table="prakerinraport";
    public $id="idprakerinraport";

	public function get_all(){
		$this->db->order_by($this->id,'desc');		
		return $this->db->get($this->table);
	}

	public function get_all_group(){
		$this->db->group_by('tahun');
		$this->db->order_by($this->id,'desc');		
		return $this->db->get($this->table);
	}


	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_prakerinraport($where){
		$this->db->where($where);
		return $this->db->get("prakerinraport");
	}

	public function get_row_join_prakerinraport($where){
		$this->db->select('siswa.nisn as nisn1, siswa.nama, siswa.jk, siswakelas.kdkelas,prakerinraport.*, perusahaan.nmperusahaan AS dudi2,perusahaan.alamat AS alamat2');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
        $this->db->join('prakerinraport','prakerinraport.nisn=siswakelas.nisn','left');
        $this->db->join('groupprakerin','groupprakerin.nisn=siswakelas.nisn','left');
        $this->db->join('ajuanprakerin','ajuanprakerin.idpengajuan=groupprakerin.idpengajuan','left');
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan','left');
		$this->db->where($where);
		return $this->db->get("siswa");
    }

    public function get_row_join_prakerinraport2($where){
		$this->db->select('siswa.nisn as nisn1, siswa.nama, siswa.jk, siswakelas.kdkelas,perusahaan.nmperusahaan AS dudi,perusahaan.alamat AS alamat,"0" AS nilai, "0" AS waktu');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
        $this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
        
		$this->db->join('ajuanprakerin','ajuanprakerin.nisn=siswakelas.nisn','left');
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan','left');
		$this->db->where($where);
		return $this->db->get("siswa");
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