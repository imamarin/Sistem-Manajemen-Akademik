<?php

class m_nilaiekstraraport extends CI_Model {

	public $table="ekstrakurikuler";
    public $id="idekstra";
    
	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
    }
    
    public function get_all(){
        return $this->db->get($this->table);
    }
    
    public function get_row_ekstra($where){
        $this->db->select('siswa.nama as nmsiswa,nilaiekstraraport.*,ekstrakurikuler.nama');
        $this->db->join('siswa','siswa.nisn=nilaiekstraraport.nisn');
        $this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
        $this->db->join('ekstrakurikuler','ekstrakurikuler.idekstra=nilaiekstraraport.idekstra');
		$this->db->where($where);
		return $this->db->get("nilaiekstraraport");
    }

	public function add($data){
		$this->db->insert("nilaiekstraraport", $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update("nilaiekstraraport",$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function delete($where){
		$this->db->delete("nilaiekstraraport", $where);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
}