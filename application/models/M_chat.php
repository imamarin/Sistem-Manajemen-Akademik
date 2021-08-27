<?php

class M_chat extends CI_Model{
	
	public $table="chat_kelas";

	function getData($where){
		$this->db->select("chat_kelas.*, (SELECT siswa.nama FROM siswa WHERE siswa.nis=chat_kelas.nis) as namasiswa, (SELECT guru.nama FROM guru WHERE guru.kdguru=chat_kelas.kdguru) as namaguru");
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	function addChat($data){
		$this->db->insert($this->table,$data);
	}
}