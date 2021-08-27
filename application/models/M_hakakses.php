<?php

class m_hakakses extends CI_Model {

	public $table="hakakses";
    public $id="idhakakses";

	public function get_all(){
		$this->db->order_by('tingkat','asc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
	}

	public function get_row($where){
		$this->db->join('setfiturmenu','setfiturmenu.idsetfiturmenu=hakakses.idsetfiturmenu');
		$this->db->join('setmenu','setmenu.idsetmenu=setfiturmenu.idsetmenu');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row2($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_level(){
		return $this->db->get("level");
	}

	public function get_fiturmenu(){
		return $this->db->get("level");
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