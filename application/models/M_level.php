<?php

class m_level extends CI_Model {

	public $table="level";
    public $id="idlevel";

    public function get_all(){
		$this->db->order_by('idlevel','asc');
		return $this->db->get($this->table);
	}

	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
	}


}