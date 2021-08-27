<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporanspp extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'21','katmenu'=>'3'));
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

        
        $data['siswa'] = array();
        $data['form_action']='page/laporanspp/cari';
        $this->template->admin('page/view_laporan_spp',$data);
    }

    public function cari(){
        $where=array(
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );

        $where2=array(
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );

        $where3=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'settahunajaran.tahun'=>$this->input->post('tahunajaran'),
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

        $data['form_action']='page/laporanspp/cari';
        $this->template->admin('page/view_laporan_spp',$data);
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