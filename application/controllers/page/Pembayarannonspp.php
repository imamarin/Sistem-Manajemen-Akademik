<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembayarannonspp extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'10','katmenu'=>'3'));
        
    }
    

    public function index(){
        $this->session->set_flashdata('info',"");
        if($this->input->post('submit') || in_array("Pencarian persiswa-9", $this->session->fitur)){
            $data['spp'] = 1;
            if($this->input->post('submit')=="TUNAI" || $this->input->post('submit')=="ANGSURAN1"){
                $this->bayar();
            }

            if($this->input->post('submit')=="BATAL"){
                $this->hapusnonspp();
            }

            if($this->input->post('submit')=="ANGSURAN"){
                $this->angsuran();
            }

            if(in_array("Pencarian Semua-9", $this->session->fitur))
            {
                $where=array(
                    'siswa.nisn'=>$this->input->post('nisn'),
                );
                $where2=array(
                    'nisn'=>$this->input->post('nisn'),
                );
                $where3=array(
                    'siswa.nisn'=>$this->input->post('nisn'),
                    'settahunajaran.status'=>1
                );
            }else{
                $where=array(
                    'siswa.nisn'=>$this->session->nisn,
                );
                $where2=array(
                    'nisn'=>$this->session->nisn,
                );
                $where3=array(
                    'siswa.nisn'=>$this->session->nisn,
                    'settahunajaran.status'=>1
                );
            }
            
            $data['siswa'] = $this->M_siswa->get_all()->result();
            $siswa=$this->M_siswa->get_row_join2($where3);
            if($siswa->num_rows() < 1){
                $siswa=$this->M_siswa->get_row_join2($where)->row();
            }else{
                $siswa=$this->M_siswa->get_row_join2($where3)->row();

            }
            $data['nisn'] = $siswa->nisn;
            $data['nama'] = $siswa->nama;
            $data['kdkelas'] = $siswa->kdkelas;
            $where4=array(
                "katkeuangan.nama !=" => "SPP",
                "katkeuangan.idtahunajaran" => $siswa->idtahunajaran,
                "(katkeuangan.jurusan='semua' OR katkeuangan.jurusan ='$siswa->kdjurusan')"=>NULL,
            );
            $data['keuangan'] = $this->M_kat_keuangan->get_row2($where4,$siswa->nisn)->result();
            $data['totaltagihan'] = $this->M_kat_keuangan->get_row3($where4,$siswa->nisn)->result();
            $data['transaksi'] = $this->M_nonspp->get_row_join($where2)->result();
            $data['histori'] = $this->M_nonspp->get_row_group($where2)->result();
            
            $data['form_action']='page/pembayarannonspp';
            $data['form_action2']='page/pembayarannonspp';
            $data['form_action3']='page/pembayarannonspp';
            $data['kls']="";
            $this->template->admin('page/view_transaksi_nonspp',$data);
        }else{
            $this->session->set_flashdata('info',"");
            $data['spp'] = NULL;
            $data['transaksi2'] = array();
            $where=array(
                "siswa.status"=>1
            );
            $data['siswa'] = $this->M_siswa->get_all()->result();
            $data['keuangan'] = $this->M_kat_keuangan->get_all2()->result();
            $data['form_action']='page/pembayarannonspp';
            $data['form_action2']='page/pembayarannonspp';
            $data['form_action3']='page/pembayarannonspp';
            $data['kls']="";
            $this->template->admin('page/view_transaksi_nonspp',$data);
        }

    }

    public function bayar(){
        if($this->input->post('submit')=="TUNAI" || $this->input->post('submit')=="ANGSURAN1"){
            $where=array(
                "nisn"=>$this->input->post('nisn'),
                "kdkatkeuangan"=>$this->input->post('kdkatkeuangan'),
            );
            $query = $this->M_nonspp->get_row($where);
            $cek=$query->num_rows();
            $row = $query->row();
            if($cek < 1){
                $data=array(
                    "nisn" =>$this->input->post('nisn'),
                    "kdkatkeuangan" => $this->input->post('kdkatkeuangan'),          
                    "biaya" => $this->input->post('biaya'),                                       
                    "metode" => $this->input->post('metode'),                                       
                );
                $queri=$this->M_nonspp->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan3");
                    $row=$this->M_nonspp->get_row($where)->row();
                    if($this->input->post('metode')=="tunai"){
                        $data=array(
                            "bayar" =>$this->input->post('biaya'),       
                            "idnonspp" => $row->idnonspp,
                            "waktu" => date('Y-m-d H:i:s'),                                       
                            "iduser" => $this->session->iduser,                                     
                        );
                    }else{
                        $data=array(
                            "bayar" =>$this->input->post('ubay'),       
                            "idnonspp" => $row->idnonspp,
                            "waktu" => date('Y-m-d H:i:s'),                                       
                            "iduser" => $this->session->iduser,                                     
                        );
                    }
                    $queri=$this->M_detail_nonspp->add($data);
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data berhasil disimpan");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal disimpan");
                    }
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                
            }else{
                if($this->input->post('metode')=="tunai"){
                    $data=array(
                        "bayar" =>$this->input->post('biaya'),       
                        "idnonspp" => $row->idnonspp,
                        "waktu" => date('Y-m-d H:i:s'),                                       
                        "iduser" => $this->session->iduser,                                     
                    );
                }else{
                    $data=array(
                        "bayar" =>$this->input->post('ubay'),       
                        "idnonspp" => $row->idnonspp,
                        "waktu" => date('Y-m-d H:i:s'),                                       
                        "iduser" => $this->session->iduser,                                     
                    );

                    $data2=array(                                            
                        "metode" => $this->input->post('metode'),                                       
                    );
                    $queri=$this->M_nonspp->update($where,$data2);
                }
                $queri=$this->M_detail_nonspp->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
            }
        }
    }

    public function angsuran(){
        if($this->input->post('submit')=="ANGSURAN"){
            $where=array(
                "nisn"=>$this->input->post('nisn'),
                "kdkatkeuangan"=>$this->input->post('kdkatkeuangan'),
            );
            $query = $this->M_nonspp->get_row($where);
            $cek=$query->num_rows();
            $row = $query->row();
            if($cek > 0){
                $data=array(
                    "bayar" =>$this->input->post('ubay'),       
                    "idnonspp" => $row->idnonspp,
                    "waktu" => date('Y-m-d H:i:s'),                                       
                    "iduser" => $this->session->iduser,                                       
                );
                $queri=$this->M_detail_nonspp->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
            }
        }
    }

    public function detailangsuran(){
        if($this->input->post('hapus')){
            $where=array(
                "iddetailnonspp"=>$this->input->post('iddetailnonspp'),
            );
            $queri=$this->M_detail_nonspp->delete($where);
            if($queri==TRUE){
                $this->session->set_flashdata('info',"Data berhasil dibatalkan"); 
            }else{
                $this->session->set_flashdata('info',"Data gagal dibatalkan");
            } 
        }

        if($this->input->post('edit')){
            $this->editnonspp();
        
        }

        if($this->input->post('idnonspp')){

            $where=array(
                'siswa.status'=>$this->input->post('nisn'),
            );
            $where2=array(
                'siswa.nisn'=>$this->input->post('nisn'),
                'nonspp.idnonspp' => $this->input->post('idnonspp')
            );
            $where3=array(
                'siswa.nisn'=>$this->input->post('nisn'),
                'settahunajaran.status'=>1
            );
            
            $data['siswa'] = $this->M_siswa->get_all()->result();
            $siswa=$this->M_siswa->get_row_join2($where3)->row();
            $data['nisn'] = $siswa->nisn;
            $data['nama'] = $siswa->nama;
            $data['kdkelas'] = $siswa->kdkelas;
            $data['biaya'] = $this->input->post('biaya');
            $data['katkeuangan'] = $this->input->post('nama');
            $where4=array(
                "kdkatkeuangan !=" => "SPP",
                "katkeuangan.idtahunajaran" => $siswa->idtahunajaran
            );
            $data['keuangan'] = $this->M_kat_keuangan->get_row($where4)->result();
            $data['transaksi'] = $this->M_detail_nonspp->get_row_join($where2)->result();

            
            $data['form_action']='page/pembayarannonspp';
            $data['form_action2']='page/pembayarannonspp';
            $data['form_action3']='page/pembayarannonspp';
            $data['kls']="";
            $this->template->admin('page/view_transaksi_angsuran',$data);
        }else{
            redirect('page/pembayarannonspp');
        }
    }


    

    public function hapusnonspp(){
        if($this->input->post('submit')=="BATAL"){
            $where=array(
                "iddetailnonspp"=>$this->input->post('iddetailnonspp'),
            );
            $queri=$this->M_detail_nonspp->delete($where);
            if($queri==TRUE){
                $where=array(
                    "idnonspp"=>$this->input->post('idnonspp'),
                );
                $queri=$this->M_nonspp->delete($where);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil dibatalkan"); 
                }else{
                    $this->session->set_flashdata('info',"Data gagal dibatalkan");
                } 
            }else{
                $this->session->set_flashdata('info',"Data gagal dibatalkan");
            }
            
        }
    }

    public function editnonspp(){
        if($this->input->post('edit')=="UBAH"){
            $where=array(
                "iddetailnonspp"=>$this->input->post('iddetailnonspp'),
            );

            $data=array(
                "bayar"=>$this->input->post('ubay'),
            );
            $queri=$this->M_detail_nonspp->update($where,$data);
            if($queri==TRUE){
                $this->session->set_flashdata('info',"Data berhasil dibatalkan"); 
            }else{
                $this->session->set_flashdata('info',"Data gagal dibatalkan");
            }
            
        }
    }

    public function cetaknonspp($nisn=NULL, $tgl=NULL){
        $where2=array(
            'nonspp.nisn'=>$nisn,
            "DATE_FORMAT(detailnonspp.waktu, '%Y-%m-%d') =" => $tgl
        );

        $data['siswa'] = $this->M_siswa->get_row(array('nisn'=>$nisn))->row();
        $data['tanggal'] = $tgl;

        $data['transaksi'] = $this->M_nonspp->get_row_join2($where2)->result();
        $this->load->view('page/view_cetak_nonspp',$data);
    }

   
}