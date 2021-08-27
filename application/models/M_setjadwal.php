<?php

class m_setjadwal extends CI_Model {

	public $table="setjadwal";
    public $id="idsetjadwal";

	public function get_all(){
		$this->db->order_by($this->id,'desc');
		return $this->db->get($this->table);
	}

	public function get_all2(){
		$this->db->join('kelas','kelas.idkelas=siswa.idkelas');
		$this->db->order_by("siswa.".$this->id,'asc');
		return $this->db->get($this->table);
	}

	public function add($data){
		$this->db->insert($this->table, $data);
	}

	public function get_row($data){
		$this->db->join('matpel','matpel.kdmatpel=jadwal.kdmatpel');
		$this->db->join('kelas','kelas.idkelas=jadwal.idkelas');
		$this->db->join('guru','guru.kodeguru=jadwal.kodeguru');
		$this->db->join('setjadwal','setjadwal.idsetjadwal=jadwal.idsetjadwal');
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function get_row2($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row3($where){
		$this->db->where($where);
		$this->db->order_by('hari','asc');
		$this->db->order_by('jam','asc');
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
	}

	public function update2($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
	}

	public function kode_otomatis(){
		$this->db->select('right(kodemitra,4) as kode', false);
		$this->db->order_by('kodemitra','desc');
		$this->db->limit(1);
		$query=$this->db->get('mitra');
		if($query->num_rows()<>0){
			$data=$query->row();
			$kode=intval($data->kode)+1;
		}else{
			$kode=1001;
		}

		/*$kodemax=str_pad($kode,3,"0", STR_PAD_LEFT);
		$kd=1000+$kodemax;*/
		$kodejadi='S'.$kode;

		return $kodejadi;
	}

}