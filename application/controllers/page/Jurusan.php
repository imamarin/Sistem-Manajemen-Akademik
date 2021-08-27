<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jurusan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'6','katmenu'=>'1'));

    }
    

    public function index(){
        $data['jurusan'] = $this->M_jurusan->get_all()->result();
        $this->template->admin('page/view_jurusan',$data);
    }

    public function simpan(){

        if($this->input->post('submit')){
            $where=array(
            "kdjurusan"=>$this->input->post('kdjurusan'),
            );
            $query = $this->M_jurusan->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "kdjurusan"=>$this->input->post('kdjurusan'),
                    "kompetensi"=>$this->input->post('kompetensi'),
                    "program"=>$this->input->post('program'),                                       
                    "bidang"=>$this->input->post('bidang'),                                       
                );
                $queri=$this->M_jurusan->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                
            }else{
                $this->session->set_flashdata('info',"Data Tidak Tersimpan");
            }

            redirect('page/jurusan');
        }else{
            redirect('page/home');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "kdjurusan"=>str_replace("%20", " ", $id),
        );
        $queri=$this->M_jurusan->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/jurusan");
    }

   
}