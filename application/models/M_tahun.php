<?php

class m_tahun extends CI_Model {

	public $table="settahunajaran";
    public $id="id";

	public function get_all(){
		$this->db->order_by($this->id,'desc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
	}

	public function get_row($data){
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function get_row2($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function update2($data){
		$this->db->update($this->table,$data);
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
	}

}