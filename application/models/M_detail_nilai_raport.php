<?php

class m_detail_nilai_raport extends CI_Model {

	public $table="detailnilairaport";
	public $id="iddetailnilairaport";

	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join($where){
		$this->db->select('nilairaport.kdmatpel,nilairaport.kkm,nilairaport.bobotpengetahuan as bp,nilairaport.bobotketerampilan as bk,detailnilairaport.pengetahuan,detailnilairaport.keterampilan,detailnilairaport.nisn');
		$this->db->join('nilairaport','nilairaport.idnilairaport=detailnilairaport.idnilairaport');
		$this->db->where($where);
		return $this->db->get($this->table);
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