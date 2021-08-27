<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class matpelguru extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'15','katmenu'=>'4'));
    }
    

    public function index(){
        $where=array(
            'guru.kdguru'=>$this->session->kdguru,
        );
        $data['kelas'] = $this->M_kelas->get_all()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['matpel'] = $this->M_matpel->get_all()->result();
        $data['matpelguru'] = $this->M_matpelguru->get_row_join($where)->result();
        $data['form_action']='page/matpelguru/simpan';
        $data['kls']="";
        //echo $this->M_matpelguru->get_row_join($where)->num_rows();
        $this->template->admin('page/view_matpel_guru',$data);
    }

    public function simpan(){

        if($this->input->post('submit')){
            $where=array(
            "kdmatpel"=>$this->input->post('kdmatpel'),
            "idtahunajaran"=>$this->input->post('tahunajaran'),
            "kdguru"=>$this->session->kdguru,
            );
            $query = $this->M_matpelguru->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "kdmatpel"=>$this->input->post('kdmatpel'),
                    "idtahunajaran"=>$this->input->post('tahunajaran'),
                    "kdguru"=>$this->session->kdguru,                                       
                );
                $queri=$this->M_matpelguru->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                
            }else{
                $this->session->set_flashdata('info',"Data Tidak Tersimpan");
            }

            redirect('page/matpelguru');
        }else{
            redirect('page/home');
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