<?php

class m_perusahaan extends CI_Model {

	public $table="perusahaan";
    public $id="idperusahaan";

	public function get_all(){
		$this->db->order_by('nmperusahaan','asc');
		return $this->db->get($this->table);
	}

	public function get_all_join(){
		$this->db->join('jurusan','jurusan.kdjurusan=kelas.kdjurusan');
		$this->db->order_by('kelas.tingkat','asc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row($data){
		$this->db->where($data);
		return $this->db->get($this->table);
	}
	
	public function get_row2($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_user($where){
		$this->db->where($where);
		return $this->db->get('user');
	}

	public function update_user($where,$data){
		$this->db->where($where);
		$this->db->update('user',$data);
	}
	
	public function get_akun_row($where){
		$this->db->join('user','user.id_user=mitra.iduser','left');
		$this->db->order_by('mitra.iduser','asc');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function akunupdate($n,$data){
		$this->db->where('user.id_user',$n);
		$this->db->update('user',$data);
	}

	public function akunadd($data){
		$this->db->insert('user', $data);
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function update2($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

}