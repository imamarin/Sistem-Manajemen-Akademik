<?php

class m_raport extends CI_Model {

	public $table="dataraport";
    public $id="id";
    
    public function get_all(){
    	$this->db->select('dataraport.*,settahunajaran.idtahunajaran,settahunajaran.tahun');
        $this->db->join('settahunajaran','settahunajaran.idtahunajaran=dataraport.idtahunajaran');
		return $this->db->get($this->table);
	}
	    
	public function get_row($where){
        $this->db->join('settahunajaran','settahunajaran.idtahunajaran=dataraport.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row2($where){
		$this->db->select("kelas.kdkelas, guru.kdguru, guru.nama, dataraport.*, settahunajaran.tahun, (SELECT template FROM templateraport as tr WHERE tr.tingkat=kelas.tingkat AND tr.idtahunajaran=dataraport.idtahunajaran) AS template");
        $this->db->join('settahunajaran','settahunajaran.idtahunajaran=dataraport.idtahunajaran');
        $this->db->join('walikelas','walikelas.idtahunajaran=dataraport.idtahunajaran');
        $this->db->join('kelas','kelas.kdkelas=walikelas.kdkelas');
		$this->db->join('guru','guru.kdguru=walikelas.kdguru');
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
    
    public function update2($data){
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function delete($where){
		$this->db->delete($this->table, $where);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}