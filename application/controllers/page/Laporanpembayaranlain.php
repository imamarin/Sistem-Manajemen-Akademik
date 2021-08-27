<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporanpembayaranlain extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'22','katmenu'=>'3'));
    }
    

    public function index(){
        $where=array(
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );

        $where2=array(
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );


        $where3=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran'),
            'siswa.status'=>1
        );
        $data['kls']='';
        $data['thn']='';
        $data['spp'] = $this->M_spp->get_row_spp_join($where)->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['kelas'] = $this->M_kelas->get_all()->result();

        
        //echo $thn1;
        $data['siswa'] = array();
        $data['katkeuangan'] = array();
        $data['form_action']='page/laporanpembayaranlain/cari';
        $this->template->admin('page/view_laporan_nonspp',$data);
    }

    public function cari(){
        if($this->input->post('submit')){
        $where=array(
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );

        $where2=array(
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );

        $where3=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran'),
            'siswa.status'=>1
        );
        $data['kls']=$this->input->post('kdkelas');
        $data['thn']=$this->input->post('tahunajaran');
        $data['spp'] = $this->M_spp->get_row_spp_join($where)->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['kelas'] = $this->M_kelas->get_all()->result();
        if($this->input->post('kdkelas')=="semua"){
            $data['siswa'] = $this->M_siswa->get_all_join2()->result();
        }else{
            $data['siswa'] = $this->M_siswa->get_row_join3($where3)->result();
        }

        $kelas=$this->M_kelas->get_row(array('kdkelas'=>$this->input->post('kdkelas')))->row();
        $rowtahun = $this->M_tahunajaran->get_row(array('idtahunajaran'=>$this->input->post('tahunajaran')))->row();
        if($kelas->tingkat==10){
            $tahun=$rowtahun->tahun;
        }elseif($kelas->tingkat==11){
            $thn=explode("/", $rowtahun->tahun);
            $thn1=$thn[0]-1;
            $thn2=$thn[1]-1;
            $tahun=$thn1."/".$thn2;
        }elseif($kelas->tingkat==12){
            $thn=explode("/", $rowtahun->tahun);
            $thn1=$thn[0]-2;
            $thn2=$thn[1]-2;
            $tahun=$thn1."/".$thn2;
        }

        $where4=array(
            "settahunajaran.tahun"=>$tahun,
            "katkeuangan.nama !="=>'SPP',
            "(katkeuangan.jurusan='semua' OR katkeuangan.jurusan ='$kelas->kdjurusan')"=>NULL,
        );
        $data['katkeuangan'] = $this->M_kat_keuangan->get_row($where4)->result();
        

        $data['form_action']='page/laporanpembayaranlain/cari';
        $this->template->admin('page/view_laporan_nonspp',$data);
        }else{
            redirect('page/laporanpembayaranlain');
        }
    }

    public function hapus($id=NULL){

        $where=array(
            "idmatpelguru"=>$id,
        );
        $this->M_matpelguru->delete($where);
        $this->session->set_flashdata('info',"Data telah dihapus");
        redirect("page/matpelguru");
    }

}