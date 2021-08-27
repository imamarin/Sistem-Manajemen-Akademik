<?php

class m_absen_detail_harian extends CI_Model {

	public $table="detailabsensiharian";
    public $id="iddetailabsensiharian";

	public function add($data){
		$this->db->insert($this->table, $data);
	}

	public function get_row($data){
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function get_row_join($data){
		$this->db->join('absensiharian','absensiharian.idabsensiharian=detailabsensiharian.idabsensiharian');
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	
	public function update($n,$data){
		$this->db->where($n);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
	}


}