<?php

class m_tugas extends CI_Model {

	public $table="tugas";
    public $id="idtugas";

	public function get_all(){
		$this->db->order_by($this->id,'asc');
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
		$this->db->where($data);
		$this->db->order_by("tugas.idtugas", "desc");
		return $this->db->get($this->table);
	}

	public function get_row_kelas($data){
		$this->db->join('');
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function get_row2($data){
		$this->db->join('group_tugas','group_tugas.idtugas=tugas.idtugas','left');
		$this->db->join('hasil_tugas','hasil_tugas.idtugas=tugas.idtugas','left');
		$this->db->join('guru','guru.kdguru=tugas.kdguru');
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function get_row3($where,$data){
		$this->db->join('group_tugas','group_tugas.idtugas=tugas.idtugas');
		//$this->db->join('hasil_tugas','hasil_tugas.idtugas=tugas.idtugas');
		$this->db->join('guru','guru.kdguru=tugas.kdguru');
		$this->db->join('siswakelas','siswakelas.idtahunajaran=group_tugas.idtahunajaran');
		$this->db->where($where);
		$this->db->like('tugas.judul',$data,'both');
		$this->db->group_by('tugas.idtugas');
		return $this->db->get($this->table);
	}

	public function get_row4($data){
		$this->db->join('group_tugas','group_tugas.idtugas=tugas.idtugas');
		$this->db->join('guru','guru.kdguru=tugas.kdguru');
		$this->db->where($data);
		return $this->db->get($this->table);
	}
	
	public function get_row5($data){
		$this->db->join('group_tugas','group_tugas.idtugas=tugas.idtugas');
		$this->db->join('guru','guru.kdguru=tugas.kdguru');
		$this->db->where($data);
		$this->db->order_by("group_tugas.tgl_awal", "desc");
		//$this->db->limit("15");
		return $this->db->get($this->table);
	}

	public function get_row6($data){
		$this->db->join('group_tugas','group_tugas.idtugas=tugas.idtugas');
		$this->db->join('guru','guru.kdguru=tugas.kdguru');
		$this->db->join('siswakelas','siswakelas.idtahunajaran=group_tugas.idtahunajaran');
		$this->db->where($data);
		$this->db->order_by("group_tugas.tgl_awal", "desc");
		//$this->db->limit("15");
		return $this->db->get($this->table);
	}

	public function simpan($data){
		$this->db->insert('tugas', $data);
	}

	public function update($n,$data){
		$this->db->where($this->id,$n);
		$this->db->update($this->table,$data);
	}
	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
    }
    
    public function simpan_modul($data = array()){
        $insert = $this->db->insert_batch('modul_tugas',$data);
        return $insert?true:false;
    }
    
    public function getModuls($n=''){
        $this->db->where('idtugas',$n);
        $this->db->from('modul_tugas');
        return $this->db->get();
    }

    public function simpanGroups($data){
		$this->db->insert('group_tugas', $data);
    }
    
    public function getRowGroups($data){
        $this->db->where($data);
		return $this->db->get('group_tugas');
	}


	
	public function getRowGroups2($data){
		$this->db->join('set_tahunajaran','set_tahunajaran.idtahunajaran=group_tugas.idtahunajaran');
        $this->db->where($data);
        $this->db->group_by('tgl_awal,tgl_akhir');
        $this->db->order_by('set_tahunajaran.idtahunajaran','desc');
		return $this->db->get('group_tugas');
	}

	public function getRowGroups3($data){
		$this->db->join('tugas','tugas.idtugas=group_tugas.idtugas');
        $this->db->where($data);
        $this->db->group_by('tgl_awal,tgl_akhir');
		return $this->db->get('group_tugas');
	}
	
	public function getCount(){
		$this->db->select("tugas.kdguru,count(tugas.kdguru) as total");
		$this->db->group_by('kdguru');
		return $this->db->get('tugas');
	}

	public function hapusGroups($data){
        $this->db->where($data);
		$this->db->delete('group_tugas');
	}
	
	public function hapusModul($data){
		$this->db->where($data);
		$this->db->delete('modul_tugas');
	}
    

}