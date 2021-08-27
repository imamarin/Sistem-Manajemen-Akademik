<?php

class m_tugas_group extends CI_Model {

	public $table="group_tugas";


	public function get_all($data){
        $this->db->join('tugas','tugas.idtugas=group_tugas.idtugas','left');
        $this->db->join('set_tahunajaran','set_tahunajaran.idtahunajaran=group_tugas.idtahunajaran');
        $this->db->where($data);
		$this->db->order_by("group_tugas.tgl_awal", "asc");
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

	public function get_row_siswa($data){
        $this->db->join('');
		$this->db->where($data);
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
	
	public function hapusGroups($data){
        $this->db->where($data);
		$this->db->delete('group_tugas');
	}
	
	public function hapusModul($data){
		$this->db->where($data);
		$this->db->delete('modul_tugas');
	}
    

}