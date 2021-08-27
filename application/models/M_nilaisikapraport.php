<?php

class m_nilaisikapraport extends CI_Model {

	public $table="nilaisikapraport";
    public $id="idnilaisikapraport";
    
	public function get_row($where){
		$this->db->join('siswakelas','siswakelas.nisn=nilaisikapraport.nisn');
		$this->db->where($where);
		return $this->db->get($this->table);
	}
	
	public function get_row_siswakelas($where){
		$this->db->join('siswakelas','siswakelas.nisn=nilaisikapraport.nisn');
		$this->db->where($where);
		return $this->db->get($this->table);
    }
    
    public function get_group(){
        $this->db->group_by('kategori');
		return $this->db->get("sikap");
    }
    
    public function get_row_sikap($where){
		$this->db->where($where);
		return $this->db->get("sikap");
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