<?php

class m_hasil_tugas extends CI_Model {

	public $table="hasil_tugas";


	public function get_all($data){
        $this->db->select('siswa.*,siswakelas.kdkelas,hasil_tugas.deskripsi,hasil_tugas.upload_tugas,hasil_tugas.catatan,hasil_tugas.nilai,hasil_tugas.idtugas');
        $this->db->join('siswakelas','siswakelas.nis=siswa.nis','left');
        $this->db->join('hasil_tugas','siswa.nis=hasil_tugas.nis','left');
        $this->db->join('tugas','tugas.idtugas=hasil_tugas.idtugas','left');
        $this->db->where($data);
		return $this->db->get("siswa");
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
		return $this->db->get($this->table);
	}

	public function get_row_siswa($data){
        $this->db->join('');
		$this->db->where($data);
		return $this->db->get($this->table);
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
	}

	public function updateModul($where,$data = array()){
		$this->db->where($where);
		$update = $this->db->update_batch($this->table,$data);
		return $update?true:false;
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