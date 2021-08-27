<?php

class m_tahunajaran extends CI_Model {

	public $table="settahunajaran";
    public $id="idtahunajaran";

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