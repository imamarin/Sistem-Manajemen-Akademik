<?php

class m_kelas extends CI_Model {

	public $table="kelas";
    public $id="kdkelas";

	public function get_all(){
		$this->db->order_by('tingkat','asc');
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

	public function get_row_join($data){
		$this->db->join('jurusan','jurusan.kdjurusan=kelas.kdjurusan');
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function get_row_join_jadwal($where){
		$this->db->select("k.kdkelas");
		$this->db->join('jadwal as j','k.kdkelas=j.kdkelas');
		$this->db->join('guru as g','g.kdguru=j.kdguru');
		$this->db->join('setjadwal as s','s.idsetjadwal=j.idsetjadwal');
		$this->db->join('settahunajaran as st','st.idtahunajaran=s.idtahunajaran');
		$this->db->where($where);
		$this->db->group_by('k.kdkelas');
		return $this->db->get($this->table." as k");
		
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
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
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