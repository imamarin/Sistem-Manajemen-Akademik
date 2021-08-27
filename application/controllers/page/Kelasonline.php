<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelasonline extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
    }
    
    public function index(){
		$this->template->guru('guru/view_kelas_online');
    }

    public function view($n=NULL,$k=NULL,$t=NULL){

    $row=$this->M_tugas->get_row(array('idtugas'=>$n))->row();
      $data=array(
        "form_action"=>"guru/kelasonline/view/".$n."/".$k,
        'judul' => set_value('judul',$row->judul),
        //'tglpublish' => set_value('tglpublish',$row->tgl_awal),
        //'endtime' => set_value('endtime',$row->tgl_akhir),
        'deskripsi' => set_value('deskripsi',$row->deskripsi),
      );
      $data['kelas']=str_replace("%20", " ", $k);
      $data['file'] = $this->M_tugas->getModuls($n)->result();

      $where=array(
          'chat_kelas.idtugas'=>$n,
      		'chat_kelas.idtahunajaran'=>$t,
      		'chat_kelas.kdkelas'=>str_replace("%20", " ", $k)
      );
      $data['chat']=$this->M_chat->getData($where)->result();

      $data['idtugas']=$n;
      $data['idthn']=$t;
      $data['kdkelas']=str_replace("%20", " ", $k);
      
	  $this->template->guru('guru/view_kelas_online',$data);
    }

    public function add(){
    		$data1=array(
      			'idtugas'=>$this->input->post('idtugas'),
      			'kdkelas'=>$this->input->post('kdkelas'),
      			'waktu'=>date('Y-m-d H:i:s'),
      			'text'=>$this->input->post('pesan'),
            'tahunajaran'=>$this->input->post('thnajaran')
      		);
      		if($this->session->level=="guru"){
      			$data1['kdguru']=$this->session->kodeguru;
      		}else{
      			$data1['nis']=$this->session->nis;
      		}

      		$this->M_chat->addChat($data1);
      		echo "Data Tersimpan";
      		//echo $this->session->level;
      		//echo $this->input->post('idtugas')."Data Tersimpan".$this->input->post('kdkelas');
    }

    public function viewChat(){
    	$where=array(
      		'chat_kelas.idtugas'=>$this->input->post('idtugas'),
          'chat_kelas.kdkelas'=>$this->input->post('kdkelas'),
      		'chat_kelas.idtahunajaran'=>$this->input->post('idtahun'),
      	);
	    $data['siswa']=$this->M_siswa->get_row(array('siswakelas.kdkelas'=>$this->input->post('kdkelas'),'siswakelas.idtahunajaran'=>$this->input->post('idtahun')))->result();
      	$data['chat']=$this->M_chat->getData($where)->result();
      	$this->load->view('guru/view_chat',$data);
    }

}