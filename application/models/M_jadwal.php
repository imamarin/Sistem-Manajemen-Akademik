<?php

class m_jadwal extends CI_Model {

	public $table="jadwal";
    public $id="idjadwal";

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
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	public function get_row($where){
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row2($where2){
		$this->db->select('jadwal.*,setjadwal.*,(SELECT COUNT(idabsensi) FROM absensi WHERE absensi.idjadwal=jadwal.idjadwal) AS status');
		$this->db->join('setjadwal','setjadwal.idsetjadwal=jadwal.idsetjadwal');
		$this->db->where($where2);
		$this->db->order_by('setjadwal.jam','asc');
		return $this->db->get($this->table);
	}

	public function get_row3($where2,$tgl){
		$this->db->select("jadwal.*,setjadwal.*,(SELECT COUNT(idabsensi) FROM absensi WHERE absensi.idjadwal=jadwal.idjadwal AND DATE_FORMAT(absensi.waktu,'%Y-%m-%d') = '$tgl' ) AS status");
		$this->db->join('setjadwal','setjadwal.idsetjadwal=jadwal.idsetjadwal');
		$this->db->where($where2);
		$this->db->order_by('setjadwal.jam','asc');
		return $this->db->get($this->table);
	}

	public function get_row4($where2){
		$this->db->select("setjadwal.idsetjadwal,jadwal.idjadwal,jadwal.kdmatpel,jadwal.kdkelas,jadwal.kdguru,jadwal.jml_jam,setjadwal.hari,setjadwal.jam,absensi.waktu");
		$this->db->join('setjadwal','setjadwal.idsetjadwal=jadwal.idsetjadwal');
		$this->db->join('absensi','absensi.idjadwal=jadwal.idjadwal');
		$this->db->where($where2);
		$this->db->order_by("absensi.waktu",'desc');
		$this->db->order_by('setjadwal.jam','asc');
		return $this->db->get($this->table);
	}

	public function get_row_join($where){
		$this->db->select("st.*,j.pekan,j.idjadwal,j.jml_jam,s.*,g.*,k.kdkelas,m.*,(s.jam+j.jml_jam)-1 as jml, j.token, j.timetoken, (SELECT sj.end_time FROM setjadwal as sj WHERE sj.hari=s.hari AND sj.idtahunajaran=s.idtahunajaran AND sj.jam=jml) as waktu");
		$this->db->join('matpel as m','m.kdmatpel=j.kdmatpel');
		$this->db->join('kelas as k','k.kdkelas=j.kdkelas');
		$this->db->join('guru as g','g.kdguru=j.kdguru');
		$this->db->join('setjadwal as s','s.idsetjadwal=j.idsetjadwal');
		$this->db->join('settahunajaran as st','st.idtahunajaran=s.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table." as j");
		
	}

	public function get_row_join2($where){
		$this->db->select("st.*,j.pekan,j.idjadwal,j.jml_jam,s.*,g.*,k.kdkelas,m.*,(s.jam+j.jml_jam)-1 as jml, (SELECT sj.end_time FROM setjadwal as sj WHERE sj.hari=s.hari AND sj.idtahunajaran=s.idtahunajaran AND sj.jam=jml) as waktu");
		$this->db->join('matpel as m','m.kdmatpel=j.kdmatpel');
		$this->db->join('kelas as k','k.kdkelas=j.kdkelas');
		$this->db->join('guru as g','g.kdguru=j.kdguru');
		$this->db->join('setjadwal as s','s.idsetjadwal=j.idsetjadwal');
		$this->db->join('settahunajaran as st','st.idtahunajaran=s.idtahunajaran');
		$this->db->where($where);
		$this->db->group_by('m.kdmatpel, k.kdkelas');
		return $this->db->get($this->table." as j");
		
	}

	public function get_row_join3($where){
		$this->db->select("g.kdguru,g.nama");
		$this->db->join('guru as g','g.kdguru=j.kdguru');
		$this->db->join('setjadwal as s','s.idsetjadwal=j.idsetjadwal');
		$this->db->join('settahunajaran as st','st.idtahunajaran=s.idtahunajaran');
		$this->db->where($where);
		$this->db->group_by('g.kdguru');
		$this->db->order_by('g.nama','asc');
		return $this->db->get($this->table." as j");
		
	}

	public function get_row_join4($where,$having){
		$this->db->select("st.*,j.pekan,j.idjadwal,j.jml_jam,s.*,g.*,k.kdkelas,m.*,(s.jam+j.jml_jam)-1 as jml, j.token, j.timetoken, (SELECT sj.end_time FROM setjadwal as sj WHERE sj.hari=s.hari AND sj.idtahunajaran=s.idtahunajaran AND sj.jam=jml) as waktu");
		$this->db->join('matpel as m','m.kdmatpel=j.kdmatpel');
		$this->db->join('kelas as k','k.kdkelas=j.kdkelas');
		$this->db->join('guru as g','g.kdguru=j.kdguru');
		$this->db->join('setjadwal as s','s.idsetjadwal=j.idsetjadwal');
		$this->db->join('settahunajaran as st','st.idtahunajaran=s.idtahunajaran');
		$this->db->where($where);
		$this->db->having($having);		
		return $this->db->get($this->table." as j");
		
	}

	public function get_row_join5($where){
		$this->db->select("st.*,j.pekan,j.idjadwal,j.jml_jam,s.*,g.*,k.kdkelas,m.*,(s.jam+j.jml_jam)-1 as jml, j.token, j.timetoken, (SELECT sj.end_time FROM setjadwal as sj WHERE sj.hari=s.hari AND sj.idtahunajaran=s.idtahunajaran AND sj.jam=jml) as waktu");
		$this->db->join('matpel as m','m.kdmatpel=j.kdmatpel');
		$this->db->join('kelas as k','k.kdkelas=j.kdkelas');
		$this->db->join('guru as g','g.kdguru=j.kdguru');
		$this->db->join('setjadwal as s','s.idsetjadwal=j.idsetjadwal');
		$this->db->join('settahunajaran as st','st.idtahunajaran=s.idtahunajaran');
		$this->db->where($where);
		$this->db->order_by('j.timetoken','desc');
		return $this->db->get($this->table." as j");
		
	}

	public function update($where,$data){
		$this->db->where($where);
		$this->db->update($this->table,$data);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}

	
	public function delete($where){
		$this->db->where($where);
		$this->db->delete($this->table);
		return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
	}


}