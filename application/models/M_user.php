<?php

class m_user extends CI_Model {

	public $table="user";
    public $id="iduser";

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
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}
	
	public function delete($n){
		$this->db->where($this->id,$n);
		$this->db->delete($this->table);
	}

	public function add_log($data){
		$this->db->insert("log_masuk",$data);
	}

	public function get_row_log($where){
		$this->db->where($where);
		return $this->db->get("log_masuk");
	}

	public function get_group_log2($where){
		$this->db->join('user','log_masuk.iduser=user.iduser');
		$this->db->where($where);
		$this->db->group_by('user.iduser');
		return $this->db->get("log_masuk");
	}
	
	public function get_count_log3($where){
		$this->db->select('siswakelas.kdkelas');
		$this->db->join('user','log_masuk.iduser=user.iduser');
		$this->db->join('siswa','user.iduser=siswa.iduser');
		$this->db->join('siswakelas','siswa.nis=siswakelas.nis');
		$this->db->where($where);
		$this->db->group_by('siswa.iduser,siswakelas.kdkelas');
		return $this->db->get("log_masuk");
	}

}