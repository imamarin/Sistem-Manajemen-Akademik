<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class bkbp extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        
    }
    

    public function datasiswakelas(){
        $this->session->set_userdata(array('menu'=>'40','katmenu'=>'10'));
        if($this->input->post('tampil')){
            $where2=array(
                'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                'settahunajaran.status'=>1
            );
            $data['siswa'] = $this->M_siswa->get_row_join2($where2)->result();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['form_action']='page/bkbp/datasiswakelas/';
            $this->template->admin('page/view_siswa_kelas',$data);
        }else{
            $data['siswa'] = array();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['form_action']='page/bkbp/datasiswakelas/';
            $this->template->admin('page/view_siswa_kelas',$data);
        }
        
    }

    public function kasussiswa($act=NULL,$parm=NULL){
        $this->session->set_userdata(array('menu'=>'39','katmenu'=>'10')); 
        if($act=="tindakan"){
            $this->tindakan($parm);
        }else{
            if($this->input->post('submit')){
                $this->simpan();
            }            
            $where2=array(
                'settahunajaran.status'=>1,
                'tindakkasus.bk'=>1
            );

            $where=array(
                'settahunajaran.status'=>1,
            );
            $data['siswa'] = $this->M_tindak_kasus->get_row_join_siswa($where2)->result();
            $data['siswa2'] = $this->M_siswa->get_row_join5($where)->result();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['form_action']='page/kasussiswa/cari/';
            $this->template->admin('page/view_kasus_siswa_bkk',$data);
        }
        
        
    }

    public function tindakan($id=NULL){
        if($this->input->post('submit')){

            if($this->input->post('submit')=="edit"){
                $this->edit();
            }

            if($this->input->post('submit')=="hapus"){
                $this->hapus();
            }

            if($this->input->post('submit')=="tindak"){
                $this->simpantindakan();
            }

            if($this->input->post('submit')=="hapustindakan"){
                $this->hapustindakan();
            }

            $where2=array(
                'siswakelas.nisn'=>$id,
                'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                'settahunajaran.status'=>1
            );

            $where3=array(
                'tindakkasus.nisn'=>$id,
            );
            $data['siswa'] = $this->M_siswa->get_row_join_count_tindakan($where2)->row();
            
            $data['kasus'] = $this->M_tindak_kasus->get_row($where3)->result();
            $data['form_action']='page/bkbp/kasussiswa/';
            $this->template->admin('page/view_kasus_siswa_tindakan_bkbp',$data);
        }else{
            redirect('page/bkbp/kasussiswa');
        }
        
        
    }

    public function simpan(){

        if($this->input->post('submit')=='simpan'){
                $data=array(
                    "nisn"=>$this->input->post('nisn'),
                    "kasus"=>$this->input->post('kasus'),
                    "bk"=>1                                      
                );
                $queri=$this->M_tindak_kasus->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
        }

    }

    public function simpantindakan(){

        if($this->input->post('submit')){
        	if(empty($this->session->kdguru)){
        		$kode=$this->session->kdkaryawan;
        	}else{
        		$kode=$this->session->kdguru;
        	}
                $data=array(
                    "tindakan"=>$this->input->post('tindakan'),
                    "tanggal"=>$this->input->post('tanggal'),                                      
                    "kdguru"=>$kode,                                      
                    "idtindakkasus"=>$this->input->post('idtindakkasus'),                                      
                );
                $queri=$this->M_tindak_kasus_detail->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
        }

    }

    public function edit(){

        if($this->input->post('submit')){
            $where=array(
                'idtindakkasus'=>$this->input->post("idtindakkasus")
            );
                $data=array(
                    "nisn"=>$this->input->post('nisn'),
                    "kasus"=>$this->input->post('kasus'),                                      
                );
                $queri=$this->M_tindak_kasus->update($where,$data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
        }

    }

    
    public function hapus(){
        if($this->input->post('submit')){
            $where=array(
                "idtindakkasus"=>$this->input->post('idtindakkasus'),
            );
            $queri=$this->M_tindak_kasus->delete($where);
            if($queri==TRUE){
                $this->session->set_flashdata('info',"Data telah dihapus");
            }else{
                $this->session->set_flashdata('info',"Data gagal dihapus");
            }  
        }
        
    }

    public function hapustindakan(){
        if($this->input->post('submit')){
            $where=array(
                "idtindakkasusdetail"=>$this->input->post('idtindakkasusdetail'),
            );
            $queri=$this->M_tindak_kasus_detail->delete($where);
            if($queri==TRUE){
                $this->session->set_flashdata('info',"Data telah dihapus");
            }else{
                $this->session->set_flashdata('info',"Data gagal dihapus");
            }  
        }
        
    }

    public function rekapabsensiharian(){
        $this->session->set_userdata(array('menu'=>'41','katmenu'=>'10'));
         if($this->input->post('tampil')){
            $where2=array(
                'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                'settahunajaran.status'=>1
            );
            $where=array(
                'settahunajaran.status'=>1
            );
            $where3=array(
                    'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                    'siswakelas.idtahunajaran'=>$this->input->post('tahun')
                );
            $data['siswa'] = $this->M_siswa->get_row_join_count_absenharian($where3,$this->input->post('semester'))->result();
            $data['tahun'] = $this->M_tahunajaran->get_row($where)->row();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['semester'] = $this->input->post('semester');
            $data['kls'] = $this->input->post('kdkelas');
            $data['form_action']='page/bkbp/rekapabsensiharian/';
            $this->template->admin('page/view_rekap_absensi_harian',$data);
        }else{
            $where2=array(
                'settahunajaran.status'=>1
            );
            $data['siswa'] = array();
            $data['tahun'] = $this->M_tahunajaran->get_row($where2)->row();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['form_action']='page/bkbp/rekapabsensiharian/';
            $this->template->admin('page/view_rekap_absensi_harian',$data);
        }

    }


    

}