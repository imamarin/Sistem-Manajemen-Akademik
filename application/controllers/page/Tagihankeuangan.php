<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class tagihankeuangan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'63','katmenu'=>'3'));
        
    }
    

    public function index(){
        if($this->input->post('submit')){
            $where = array(
                'siswakelas.kdkelas' => $this->input->post('kdkelas'),
                'settahunajaran.status' => 1,
            );
        }else{
            $where = array(
                'settahunajaran.status' => 1,
            );
        }
        
        $data['kelas'] = $this->M_kelas->get_all()->result();
        $data['tagihan'] = $this->M_spp->get_row_tagihan($where)->result();
        $data['form_action']="";
        $this->template->admin('page/view_tagihan_keuangan',$data);
    }


    public function cetak($nisn=NULL){
        $where2=array(
            'spp.nisn'=>$nisn,
        );

        $where3=array(
            'nonspp.nisn'=>$nisn,
        );

        $data['siswa'] = $this->M_siswa->get_row_join2(array('siswa.nisn'=>$nisn))->row();
        $idtahunajaran=$data['siswa']->idtahunajaran;
        $kdjurusan=$data['siswa']->kdjurusan;
        $data['tgl_terima']=$data['siswa']->tgl_terima;
        
        $data['transaksispp'] = $this->M_spp->get_row_spp($where2)->result();

        $where4=array(
            "katkeuangan.nama !=" => "SPP",
            "katkeuangan.idtahunajaran" => $idtahunajaran,
            "(katkeuangan.jurusan='semua' OR katkeuangan.jurusan ='$kdjurusan')"=>NULL,
        );
        $data['keuangan'] = $this->M_kat_keuangan->get_row2($where4,$nisn)->result();
        $data['transaksinonspp'] = $this->M_nonspp->get_row_join($where3)->result();

        $where = array(
            'siswa.nisn' => $nisn,
            'settahunajaran.status' => 1,
        );
        $data['tagihan'] = $this->M_spp->get_row_tagihan($where)->row();
        $this->load->view('page/view_cetak_tagihan',$data);
    }

   
}