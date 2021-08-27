<?php

class m_soal extends CI_Model {

	public $table="soal";
    public $id="soal.idsoal";

	public function get_all(){
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	public function get_all2($where){
		$this->db->select('soal.*,pilihan_ganda.idpg,pilihan_ganda.text,quiz.idtugas,quiz.idquiz');
		$this->db->join("quiz","quiz.idsoal=soal.idsoal","left");
		$this->db->join("pilihan_ganda","pilihan_ganda.idpg=soal.jawaban","left");
		$this->db->where($where);
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
	}

	public function get_all_kelas($data){
        $this->db->select('siswa.*,siswakelas.kdkelas,hasil_quiz.*');
        $this->db->join('siswakelas','siswakelas.nis=siswa.nis','left');
        $this->db->join('hasil_quiz','siswa.nis=hasil_quiz.nis','left');
        $this->db->join('tugas','tugas.idtugas=hasil_quiz.idtugas','left');
        $this->db->where($data);
		return $this->db->get("siswa");
	}

	public function get_soal($where){
		$this->db->where($where);
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
    }

    public function get_soalquiz($where){
    	$this->db->join("quiz","quiz.idsoal=soal.idsoal","left");
		$this->db->where($where);
		$this->db->order_by($this->id,'asc');
		/*
		if($limit > 0){
			$this->db->limit($limit);
		}
		*/
		return $this->db->get($this->table);
    }
    
    public function get_soal2($where){
    	$this->db->join("tugas","tugas.idtugas=quiz.idtugas");
		$this->db->where($where);
		$this->db->order_by($this->id,'asc');
		return $this->db->get($this->table);
    }

    public function get_row($data){

		$this->db->where($data);
		$this->db->order_by($this->id,'desc');
		return $this->db->get($this->table);
    }
    
    public function get_row_pg($data){
    	$this->db->join("soal","soal.idsoal=pilihan_ganda.idsoal");
		$this->db->where($data);
		return $this->db->get("pilihan_ganda");
	}

	public function get_row_soal($data){
		$this->db->join("quiz","quiz.idquiz=jawaban.idquiz");
		$this->db->where($data);
		return $this->db->get("jawaban");
	}

	public function get_row_soal2($data){
		$this->db->select("quiz.*, jawaban.idjawaban,jawaban.hasil,jawaban.jawaban as jwbuser");
		$this->db->join("quiz","quiz.idquiz=jawaban.idquiz");
		$this->db->where($data);
		return $this->db->get("jawaban");
	}

	public function get_row_hasilquiz($where){
		$this->db->where($where);
		return $this->db->get("hasil_quiz");
	}

	public function get_row_nilai($data){
		$this->db->join('tugas','tugas.idtugas=hasil_quiz.idtugas');
		$this->db->where($data);
		return $this->db->get("hasil_quiz");
	}

	public function get_row_setquiz($data){
		$this->db->where($data);
		return $this->db->get("set_quiz");
	}
	
	public function add($data){
		$this->db->insert($this->table, $data);
    }

    public function addPg($data){
		$this->db->insert("pilihan_ganda", $data);
	}


	public function addhasilquiz($data){
		$this->db->insert("hasil_quiz", $data);
	}

	public function addJawaban($data){
		$this->db->insert("jawaban", $data);
	}

	public function addsetquiz($data){
		$this->db->insert("set_quiz", $data);
	}

	public function updateJawaban($where,$data){
        $this->db->where($where);
		$this->db->update("jawaban",$data);
    }

    public function hapusJawaban($where){
        $this->db->where($where);
		$this->db->delete("jawaban");
    }

    public function updatehasilquiz($where,$data){
        $this->db->where($where);
		$this->db->update("hasil_quiz",$data);
    }

    public function updatesetquiz($where,$data){
        $this->db->where($where);
		$this->db->update("set_quiz",$data);
    }

	public function update($where,$data){
        $this->db->where($where);
		$this->db->update($this->table,$data);
    }

    public function updatepg($where,$data){
        $this->db->where($where);
		$this->db->update("pilihan_ganda",$data);
    }

    public function hapus($where){
        $this->db->where($where);
		$this->db->delete($this->table);
    }

    public function hapuspg($where){
        $this->db->where($where);
		$this->db->delete("pilihan_ganda");
    }

}