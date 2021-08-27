<?php

class m_menu extends CI_Model {

	public $table="setmenu";
    public $id="setmenu.idsetmenu";

    public function get_all_join(){
    	$this->db->join('setmenukategori','setmenukategori.idsetmenukategori=setmenu.idsetmenukategori');
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
	}


}