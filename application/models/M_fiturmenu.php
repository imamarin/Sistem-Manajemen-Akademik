<?php

class m_fiturmenu extends CI_Model {

	public $table="setfiturmenu";
    public $id="idsetfiturmenu";

    public function get_all(){
    	$this->db->join('setmenu','setmenu.idsetmenu=setfiturmenu.idsetmenu');
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
	}


}