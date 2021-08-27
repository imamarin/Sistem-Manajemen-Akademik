<?php

class m_prakerin extends CI_Model {

	public $table="setprakerin";
    public $id="idprakerin";

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

}