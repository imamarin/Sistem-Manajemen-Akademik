<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategorikeuangan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'17','katmenu'=>'3'));
    }
    

    public function index(){
        $data['kategori'] = $this->M_kat_keuangan->get_all()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['form_action']='page/kategorikeuangan/simpan';
        $data['hapus_action']='page/kategorikeuangan/hapus/';
        $data['update_action']='page/kategorikeuangan/update/';
        $this->template->admin('page/view_kat_keuangan',$data);
    }

    public function simpan(){

        if($this->input->post('submit')){
            $where=array(
            "kdkatkeuangan"=>$this->input->post('kode'),
            "settahunajaran.idtahunajaran"=>$this->input->post('tahunajaran'),
            );
            $query = $this->M_kat_keuangan->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "kdkatkeuangan"=>$this->input->post('kode'),
                    "nama"=>$this->input->post('nama'),
                    "biaya"=>$this->input->post('biaya'),
                    "idtahunajaran"=>$this->input->post('tahunajaran') 
                );
                $queri=$this->M_kat_keuangan->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                
            }else{
                $this->session->set_flashdata('info',"Data Tidak Tersimpan");
            }

            redirect('page/kategorikeuangan');
        }else{
            redirect('page/home');
        }

    }

    public function update(){

        if($this->input->post('submit')){
            $where=array(
            "kdkatkeuangan"=>$this->input->post('kode'),
            "settahunajaran.idtahunajaran"=>$this->input->post('tahunajaran'),
            );
            $query = $this->M_kat_keuangan->get_row($where);
            $cek=$query->num_rows();
            
            if($cek > 0){
                $where2=array(
                "kdkatkeuangan"=>$this->input->post('kode'),
                "idtahunajaran"=>$this->input->post('tahunajaran'),
                );
                $data=array(
                    "kdkatkeuangan"=>$this->input->post('kode'),
                    "nama"=>$this->input->post('nama'),
                    "biaya"=>$this->input->post('biaya'),
                    "idtahunajaran"=>$this->input->post('tahunajaran') 
                );
                $queri=$this->M_kat_keuangan->update($where2,$data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil diubah");
                }else{
                    $this->session->set_flashdata('info',"Data gagal diubah");
                }
                
            }

            redirect('page/kategorikeuangan');
        }else{
            redirect('page/home');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "kdkatkeuangan"=>$id,
        );
        $this->M_kat_keuangan->delete($where);
        $this->session->set_flashdata('info',"Data telah dihapus");
        redirect("page/kategorikeuangan");
    }

}