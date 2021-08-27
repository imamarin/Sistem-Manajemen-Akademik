<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporantransaksi extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'18','katmenu'=>'3'));
    }
    

    public function index(){
        $where=array(
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );

        $where2=array(
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')=" => date('Y-m-d'),
        );
        $data['tgl1'] = date('Y-m-d');
        $data['tgl2'] = date('Y-m-d');
        $data['spp'] = $this->M_spp->get_row_spp_join($where)->result();
        $data['nonspp'] = $this->M_detail_nonspp->get_row_join($where2)->result();
        $data['form_action']='page/laporantransaksi/cari';
        $this->template->admin('page/view_laporan_transaksi',$data);
    }

    public function cari(){
        $where=array(
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')>=" => date('Y-m-d',strtotime($this->input->post('tanggal1'))),
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')<=" => date('Y-m-d',strtotime($this->input->post('tanggal2'))),
        );

        $where2=array(
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')>=" => date('Y-m-d',strtotime($this->input->post('tanggal1'))),
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')<=" => date('Y-m-d',strtotime($this->input->post('tanggal2'))),
        );
        $data['tgl1'] = date('Y-m-d',strtotime($this->input->post('tanggal1')));
        $data['tgl2'] = date('Y-m-d',strtotime($this->input->post('tanggal2')));
        $data['spp'] = $this->M_spp->get_row_spp_join($where)->result();
        $data['nonspp'] = $this->M_nonspp->get_row_nonspp_join($where2)->result();
        $data['form_action']='page/laporantransaksi/cari';
        $this->template->admin('page/view_laporan_transaksi',$data);
    }

    public function cetak($tgl1=NULL, $tgl2=NULL){
        $where=array(
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')>=" => date('Y-m-d',strtotime($tgl1)),
            "DATE_FORMAT(spp.waktu,'%Y-%m-%d')<=" => date('Y-m-d',strtotime($tgl2)),
        );

        $where2=array(
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')>=" => date('Y-m-d',strtotime($tgl1)),
            "DATE_FORMAT(detailnonspp.waktu,'%Y-%m-%d')<=" => date('Y-m-d',strtotime($tgl2)),
        );
        $data['tgl1'] = date('Y-m-d',strtotime($tgl1));
        $data['tgl2'] = date('Y-m-d',strtotime($tgl1));
        $data['spp'] = $this->M_spp->get_row_spp_join($where)->result();
        $data['nonspp'] = $this->M_nonspp->get_row_nonspp_join($where2)->result();
        $data['form_action']='page/laporantransaksi/cari';
        $this->load->view('page/view_cetak_laporan_transaksi',$data);
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