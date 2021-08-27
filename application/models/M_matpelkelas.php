<?php

class m_matpelkelas extends CI_Model {

	public $table="matpelkelas";
    public $id="idmatpelkelas";

	public function get_all(){
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	public function get_all_join(){
		$this->db->join('guru','guru.kdguru=matpelkelas.kdguru');
        $this->db->join('matpel','matpel.kdmatpel=matpelkelas.kdmatpel');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=matpelkelas.idtahunajaran');
		return $this->db->get($this->table);
	}

	public function get_row($where){
        
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row_join($where){
		$this->db->join('guru','guru.kdguru=matpelkelas.kdguru');
        $this->db->join('matpel','matpel.kdmatpel=matpelkelas.kdmatpel');
        $this->db->join('walikelas','walikelas.kdkelas=matpelkelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=matpelkelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_raport($where){
		$this->db->select('matpel.*, guru.nama, matpelkelas.*, settahunajaran.idtahunajaran');
		$this->db->join('guru','guru.kdguru=matpelkelas.kdguru');
        $this->db->join('matpel','matpel.kdmatpel=matpelkelas.kdmatpel');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=matpelkelas.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('matpel.nourut','asc');
		return $this->db->get($this->table);
	}

	public function get_row_join_rekap($where,$sms){
		$this->db->select("matpel.*, guru.nama, guru.kdguru, matpelkelas.idmatpelkelas, walikelas.kdkelas, settahunajaran.idtahunajaran, '$sms' as semester");
		$this->db->select("(SELECT COUNT(siswakelas.kdkelas) FROM siswakelas,siswa WHERE siswakelas.nisn=siswa.nisn AND siswakelas.kdkelas=walikelas.kdkelas AND siswakelas.idtahunajaran=settahunajaran.idtahunajaran AND siswa.status=1) AS totalsiswa");
		$this->db->select("(SELECT SUM(IF(detailnilairaport.pengetahuan >= 1 OR detailnilairaport.keterampilan >= 1,1,0)) FROM detailnilairaport,nilairaport as nr, siswakelas WHERE nr.idnilairaport=detailnilairaport.idnilairaport AND siswakelas.nisn=detailnilairaport.nisn AND nr.kdguru=guru.kdguru AND nr.kdmatpel=matpel.kdmatpel AND nr.kdkelas=walikelas.kdkelas AND siswakelas.kdkelas=walikelas.kdkelas AND nr.semester='$sms' AND nr.idtahunajaran=settahunajaran.idtahunajaran) AS jmlsiswa");
		$this->db->select("(SELECT SUM(IF(detailnilairaport.pengetahuan < nr.kkm OR detailnilairaport.keterampilan < nr.kkm,1,0)) FROM detailnilairaport,nilairaport as nr, siswa WHERE nr.idnilairaport=detailnilairaport.idnilairaport AND nr.kdguru=guru.kdguru AND nr.kdmatpel=matpel.kdmatpel AND nr.kdkelas=walikelas.kdkelas AND detailnilairaport.nisn=siswa.nisn AND siswa.status=1 AND  nr.semester='$sms' AND nr.idtahunajaran=settahunajaran.idtahunajaran) AS bawahkkm");
		$this->db->select("(SELECT idnilairaport FROM nilairaport as nr WHERE nr.kdguru=guru.kdguru AND nr.kdmatpel=matpel.kdmatpel AND nr.kdkelas=walikelas.kdkelas AND nr.semester='$sms' AND nr.idtahunajaran=settahunajaran.idtahunajaran) AS idnilairaport");
		$this->db->select("(SELECT kkm FROM nilairaport as nr WHERE nr.kdguru=guru.kdguru AND nr.kdmatpel=matpel.kdmatpel AND nr.kdkelas=walikelas.kdkelas AND nr.semester='$sms' AND nr.idtahunajaran=settahunajaran.idtahunajaran) AS kkm");
		$this->db->select("(SELECT bobotpengetahuan FROM nilairaport as nr WHERE nr.kdguru=guru.kdguru AND nr.kdmatpel=matpel.kdmatpel AND nr.kdkelas=walikelas.kdkelas AND nr.semester='$sms' AND nr.idtahunajaran=settahunajaran.idtahunajaran) AS bp");
		$this->db->select("(SELECT bobotketerampilan FROM nilairaport as nr WHERE nr.kdguru=guru.kdguru AND nr.kdmatpel=matpel.kdmatpel AND nr.kdkelas=walikelas.kdkelas AND nr.semester='$sms' AND nr.idtahunajaran=settahunajaran.idtahunajaran) AS bk");
		$this->db->join('guru','guru.kdguru=matpelkelas.kdguru');
        $this->db->join('matpel','matpel.kdmatpel=matpelkelas.kdmatpel');
        $this->db->join('walikelas','walikelas.kdkelas=matpelkelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=matpelkelas.idtahunajaran');

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

	public function update($n,$data){
		$this->db->where($this->id,$n);
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
	}

}