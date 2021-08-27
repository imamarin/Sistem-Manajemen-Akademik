<?php

class m_setting extends CI_Model {

	public $table="setting";
    public $id="id";

    public function get_all(){
    	$this->db->order_by($this->id);
    	return $this->db->get($this->table);
    }

	public function add($data){
		$this->db->insert($this->table, $data);
	}

	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}
	
	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}
	
	public function delete($n){
		$this->db->where($this->id,$n);
		$this->db->delete($this->table);
	}

}