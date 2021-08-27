<?php

class m_kat_keuangan extends CI_Model {

	public $table="katkeuangan";
    public $id="kdkatkeuangan";

	public function get_all(){
		$this->db->join('settahunajaran','katkeuangan.idtahunajaran=settahunajaran.idtahunajaran');
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	public function get_all2(){
		$this->db->join('settahunajaran','katkeuangan.idtahunajaran=settahunajaran.idtahunajaran');
		$this->db->group_by($this->id);
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	
	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row($where){
		$this->db->join('settahunajaran','katkeuangan.idtahunajaran=settahunajaran.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row2($where,$n){
		$this->db->select("katkeuangan.*, (SELECT SUM(bayar) FROM detailnonspp,nonspp WHERE detailnonspp.idnonspp = nonspp.idnonspp
		AND nonspp.kdkatkeuangan=katkeuangan.kdkatkeuangan AND nonspp.nisn=$n) AS tagihan");
		$this->db->join('settahunajaran','katkeuangan.idtahunajaran=settahunajaran.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row3($where,$n){
		$this->db->select("katkeuangan.biaya, (SELECT SUM(bayar) FROM detailnonspp,nonspp WHERE detailnonspp.idnonspp = nonspp.idnonspp
		AND nonspp.kdkatkeuangan=katkeuangan.kdkatkeuangan AND nonspp.nisn=$n) AS tagihan");
		$this->db->join('settahunajaran','katkeuangan.idtahunajaran=settahunajaran.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}