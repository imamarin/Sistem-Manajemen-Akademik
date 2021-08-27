<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absensiharian extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        if($this->session->profil=="guru"){
            $this->session->set_userdata(array('menu'=>'35','katmenu'=>'9'));
        }else{
            $this->session->set_userdata(array('menu'=>'36','katmenu'=>'7'));
        }
    }
    

    public function index(){
        $where=array(
            'settahunajaran.status'=>1
        );
        if($this->session->profil=="guru"){
            $where2=array(
                'guru.kdguru'=>$this->session->kdguru,
                'settahunajaran.status'=>1
            );
        }else{
            $where2=array(
                'kelas.kdkelas'=>$this->session->kdkelas,
                'settahunajaran.status'=>1
            );
        }
        
        $walikelas=$this->M_walikelas->get_row($where2);
        $data['walikelas']= $walikelas->result();
        $wk=$walikelas->row();


        $data['tahun'] = $this->M_tahunajaran->get_row($where)->row();
        $data['absen'] = array();
        $where3 = array(
            "siswakelas.kdkelas"=>$wk->kdkelas,
            "absensiharian.semester"=>$this->session->semester,              
            "absensiharian.idtahunajaran"=>$this->session->tahun, 
        );
        $absen = $this->M_absenharian->get_row4($where3)->result();
        foreach ($absen as $key => $v) {
            # code...
            $data['absen'][]=date('Y-m-d',strtotime($v->waktu));
        }
        $this->template->admin('page/view_absensi_harian',$data);
       //echo $wk->nisn;
    }

    
    function input(){
        if($this->input->post('submit')){
           $this->simpan();
           $where=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('idtahun')
            );
           $where2=array(
            "DATE_FORMAT(absensiharian.waktu,'%Y-%m-%d')"=>$this->input->post('tanggal')
           );
            $queri=$this->M_absenharian->get_row($where2);
            if($queri->num_rows()>0){
                $d=$queri->row();
                $id=$d->idabsensiharian;
            }else{
                $id="";
            }
            $waktu=$this->input->post('tanggal');
            $data['siswa'] = $this->M_siswa->get_row_join_absenharian($where,$id)->result();
            $data['tanggal'] = $this->input->post('tanggal');
            $data['kdkelas'] = $this->input->post('kdkelas');
            $data['semester'] = $this->input->post('semester');
            $data['tahun'] = $this->input->post('tahun');
            $data['idtahun'] = $this->input->post('idtahun');
            $data['form_action']="page/absensiharian/input";
            $this->template->admin('page/view_absensi_siswa_harian',$data);
        }else{
            redirect('page/absensiharian');
        }
    }

    public function simpan(){

        if($this->input->post('submit')=='simpan'){
            $where=array(
                "DATE_FORMAT(waktu,'%Y-%m-%d')" => date("Y-m-d",strtotime($this->input->post('tanggal'))),
                "semester"=>$this->input->post('semester'),
            );
            $query = $this->M_absenharian->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "waktu"=>date("Y-m-d",strtotime($this->input->post('tanggal'))),
                    "semester"=>$this->input->post('semester'),              
                    "idtahunajaran"=>$this->input->post('idtahun'),              
                );
                $this->M_absenharian->add($data);

                $where=array(
                    "DATE_FORMAT(waktu,'%Y-%m-%d')" => date("Y-m-d",strtotime($this->input->post('tanggal'))),
                    "semester"=>$this->input->post('semester'),
                    "idtahunajaran"=>$this->input->post('idtahun'),
                );
                $query = $this->M_absenharian->get_row($where);
                $d=$query->row();

                $nisn=$this->input->post('nisn');
                $ket=$this->input->post('ket');
                $h=0;
                foreach ($nisn as $key => $value) {
                    $data=array(
                        "nisn"=>$value,
                        "keterangan"=>$ket[$key],
                        "idabsensiharian"=>$d->idabsensiharian
                    );

                    $where=array(
                        "nisn"=>$value,
                        "idabsensiharian"=>$d->idabsensiharian,
                    );  
                    $query = $this->M_absen_detail_harian->get_row($where)->num_rows();
                    if($query<1){
                        $queri=$this->M_absen_detail_harian->add($data); 
                        if($queri==TRUE){
                            $h++;
                        }           
                                        
                    }
                }
                    
            }else{
                $d=$query->row();

                $nisn=$this->input->post('nisn');
                $ket=$this->input->post('ket');
                $h=0;
                foreach ($nisn as $key => $value) {
                    $data=array(
                        "nisn"=>$value,
                        "keterangan"=>$ket[$key],
                        "idabsensiharian"=>$d->idabsensiharian
                    );

                    $where=array(
                        "nisn"=>$value,
                        "idabsensiharian"=>$d->idabsensiharian,
                    );  
                    $query = $this->M_absen_detail_harian->get_row($where)->num_rows();
                    if($query<1){
                        $queri=$this->M_absen_detail_harian->add($data); 
                        if($queri==TRUE){
                            $h++;
                        }           
                                        
                    }else{
                        $queri=$this->M_absen_detail_harian->update($where,$data); 
                        if($queri==TRUE){
                            $h++;
                        } 
                    }
                }
            }
        }

    }

    public function petugas(){

    }

    

    
   
}