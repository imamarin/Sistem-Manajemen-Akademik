<?php

class m_siswa extends CI_Model {

	public $table="siswa";
    public $id="nisn";

	public function get_all(){
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	public function get_all_join(){
		$this->db->select('siswa.*, siswakelas.kdkelas, kelas.tingkat, kelas.kdjurusan');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn','left');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas','left');
		return $this->db->get($this->table);
	}

	public function get_all_join2(){
		$this->db->select('siswa.nisn,siswa.nama,siswa.tgl_terima,kelas.kdjurusan, (SELECT COUNT(spp.nisn) FROM spp WHERE spp.nisn=siswa.nisn) AS total');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
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

	public function get_row_join($where){
		$this->db->select('siswa.*, siswakelas.kdkelas, kelas.tingkat, kelas.kdjurusan, user.username, user.password, user.idlevel');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn','left');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas','left');
		$this->db->join('user','user.iduser=siswa.iduser');
		$this->db->where($where);

		return $this->db->get($this->table);
	}

	public function get_row_join2($where){
		$this->db->select('siswa.*, siswakelas.kdkelas, kelas.tingkat, kelas.kdjurusan');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join3($where){
		$this->db->select('siswa.nisn,siswa.nama,siswa.tgl_terima, (SELECT COUNT(spp.nisn) FROM spp WHERE spp.nisn=siswa.nisn) AS total');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		$this->db->group_by('siswa.nisn');
		return $this->db->get($this->table);
	}

	public function get_row_join4($where){
		$this->db->select('siswa.*, siswakelas.kdkelas, kelas.tingkat, kelas.kdjurusan');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join5($where){
		$this->db->select('siswa.nisn, siswa.nama, siswakelas.kdkelas, kelas.tingkat, kelas.kdjurusan');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_absen($where=NULL){
		$this->db->select('siswa.nisn, siswa.nama, siswa.jk, detailabsensi.keterangan, detailabsensi.idabsensi, absensi.*');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('detailabsensi','detailabsensi.nisn=siswakelas.nisn','left');
		$this->db->join('absensi','absensi.idabsensi=detailabsensi.idabsensi','left');
		$this->db->where($where);
		
		return $this->db->get($this->table);
	}

	public function get_row_join_absen2($where,$idjadwal,$waktu){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT detailabsensi.keterangan FROM detailabsensi,absensi WHERE detailabsensi.idabsensi=absensi.idabsensi AND absensi.idjadwal='$idjadwal' AND DATE_FORMAT(absensi.waktu,'%Y-%m-%d')='$waktu' AND detailabsensi.nisn=siswa.nisn) AS keterangan, (SELECT absensi.bahasan FROM detailabsensi,absensi WHERE detailabsensi.idabsensi=absensi.idabsensi AND absensi.idjadwal='$idjadwal' AND DATE_FORMAT(absensi.waktu,'%Y-%m-%d')='$waktu' AND detailabsensi.nisn=siswa.nisn) AS bahasan");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_absenharian($where,$id){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT detailabsensiharian.keterangan FROM detailabsensiharian,absensiharian WHERE detailabsensiharian.idabsensiharian=absensiharian.idabsensiharian AND absensiharian.idabsensiharian='$id' AND detailabsensiharian.nisn=siswa.nisn) AS keterangan");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_count_absenharian($where,$semester){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT COUNT(detailabsensiharian.nisn) FROM detailabsensiharian,absensiharian WHERE detailabsensiharian.idabsensiharian=absensiharian.idabsensiharian AND absensiharian.semester='$semester' AND absensiharian.idtahunajaran=siswakelas.idtahunajaran AND detailabsensiharian.nisn=siswa.nisn AND detailabsensiharian.keterangan='h') AS hadir,(SELECT COUNT(detailabsensiharian.nisn) FROM detailabsensiharian,absensiharian WHERE detailabsensiharian.idabsensiharian=absensiharian.idabsensiharian AND absensiharian.semester='$semester' AND absensiharian.idtahunajaran=siswakelas.idtahunajaran AND detailabsensiharian.nisn=siswa.nisn AND detailabsensiharian.keterangan='i') AS izin,(SELECT COUNT(detailabsensiharian.nisn) FROM detailabsensiharian,absensiharian WHERE detailabsensiharian.idabsensiharian=absensiharian.idabsensiharian AND absensiharian.semester='$semester' AND absensiharian.idtahunajaran=siswakelas.idtahunajaran AND detailabsensiharian.nisn=siswa.nisn AND detailabsensiharian.keterangan='s') AS sakit,(SELECT COUNT(detailabsensiharian.nisn) FROM detailabsensiharian,absensiharian WHERE detailabsensiharian.idabsensiharian=absensiharian.idabsensiharian AND absensiharian.semester='$semester' AND absensiharian.idtahunajaran=siswakelas.idtahunajaran AND detailabsensiharian.nisn=siswa.nisn AND detailabsensiharian.keterangan='a') AS alfa");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_ujian($where,$idujian){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT detailujian.nilai FROM detailujian,ujian WHERE detailujian.idujian=ujian.idujian AND detailujian.idujian='$idujian' AND detailujian.nisn=siswa.nisn) AS nilai");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_rekapabsen($where,$sms,$idjadwal){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.idjadwal='$idjadwal' AND da.keterangan='h' ) AS hadir, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.idjadwal='$idjadwal' AND da.keterangan='i') AS izin, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.idjadwal='$idjadwal' AND da.keterangan='a') AS alfa, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.idjadwal='$idjadwal' AND da.keterangan='s') AS sakit");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->where($where);
		$this->db->order_by('siswa.nama','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join_rekapabsen2($where,$sms,$kdmatpel,$kdguru){
		
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.kdkelas=siswakelas.kdkelas AND j.kdmatpel='$kdmatpel' AND j.kdguru='$kdguru' AND da.keterangan='h' ) AS hadir, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.kdkelas=siswakelas.kdkelas AND j.kdmatpel='$kdmatpel' AND j.kdguru='$kdguru' AND da.keterangan='i') AS izin, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.kdkelas=siswakelas.kdkelas AND j.kdmatpel='$kdmatpel' AND j.kdguru='$kdguru' AND da.keterangan='a') AS alfa, (SELECT COUNT(da.nisn) FROM detailabsensi as da,absensi as a,jadwal as j, setjadwal as sj WHERE da.nisn=siswa.nisn AND a.idabsensi=da.idabsensi AND j.idjadwal=a.idjadwal AND sj.idsetjadwal=j.idsetjadwal AND sj.idtahunajaran=siswakelas.idtahunajaran AND a.semester='$sms' AND j.kdkelas=siswakelas.kdkelas AND j.kdmatpel='$kdmatpel' AND j.kdguru='$kdguru' AND da.keterangan='s') AS sakit");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->where($where);
		$this->db->order_by('siswa.nama','desc');
		return $this->db->get($this->table);
	}

	public function get_row_join_count_kasus($where){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT COUNT(kasussiswa.nisn) FROM kasussiswa WHERE kasussiswa.nisn=siswa.nisn) AS kasus");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_count_bkk($where){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT COUNT(tindakkasus.nisn) FROM tindakkasus as tindakkasus WHERE tindakkasus.nisn=siswa.nisn AND tindakkasus.bk=1) AS kasus");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_count_tindakan($where){
		$this->db->select("siswa.nisn, siswa.nama, siswa.jk, siswakelas.kdkelas, (SELECT COUNT(tindakkasus.nisn) FROM tindakkasus WHERE tindakkasus.nisn=siswa.nisn) AS kasus");
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->where($where);
		return $this->db->get($this->table);
	}

	public function get_row_join_prakerin($where){
		$this->db->select('siswa.nisn, siswa.nama, (SELECT sk.kdkelas FROM siswakelas as sk,settahunajaran as st WHERE sk.idtahunajaran=st.idtahunajaran AND sk.nisn=siswa.nisn AND st.status=1) AS kdkelas, kelas.tingkat, kelas.kdjurusan,perusahaan.nmperusahaan,perusahaan.kota,perusahaan.idperusahaan,ajuanprakerin.status,ajuanprakerin.idpengajuan');
		$this->db->join('siswakelas','siswakelas.nisn=siswa.nisn');
		$this->db->join('kelas','siswakelas.kdkelas=kelas.kdkelas');
		$this->db->join('settahunajaran','settahunajaran.idtahunajaran=siswakelas.idtahunajaran');
		$this->db->join('groupprakerin','groupprakerin.nisn=siswakelas.nisn','left');
		$this->db->join('ajuanprakerin','ajuanprakerin.idpengajuan=groupprakerin.idpengajuan','left');
		$this->db->join('perusahaan','perusahaan.idperusahaan=ajuanprakerin.idperusahaan','left');
		$this->db->join('setprakerin','setprakerin.idprakerin=ajuanprakerin.idprakerin','left');
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
	
	public function get_row2($where){
		$this->db->join('user','user.iduser=siswa.iduser');
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
		$this->db->where($n);
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