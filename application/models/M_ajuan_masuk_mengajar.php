<?php

class m_ajuan_masuk_mengajar extends CI_Model {

	public $table="ajuanmasukmengajar";
    public $id="idajuan";

    public function get_all(){
		$this->db->order_by('idajuan','desc');
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
        $this->db->select("ajuanmasukmengajar.*,jadwal.kdmatpel,guru.nama,jadwal.kdkelas,jadwal.kdmatpel,settahunajaran.idtahunajaran");
        $this->db->join('jadwal','jadwal.idjadwal=ajuanmasukmengajar.idjadwal');
		$this->db->join('guru','guru.kdguru=jadwal.kdguru');
		$this->db->join('setjadwal','setjadwal.idsetjadwal=jadwal.idsetjadwal');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=setjadwal.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('idajuan','desc');
		return $this->db->get($this->table);
		
    }
    
    public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    
    public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


}