<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ajuanmasukmengajar extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'61','katmenu'=>'6'));

    }
    

    public function index(){
        $where3=array(
            'jadwal.semester'=>$this->session->semester,
            'settahunajaran.idtahunajaran'=>$this->session->tahun
        );
        $data['masuk'] = $this->M_ajuan_masuk_mengajar->get_row_join($where3)->result();
        $data['form_action'] = "page/ajuanmasukmengajar/simpanajuan";
        $data['hapus_action'] = "page/ajuanmasukmengajar/hapusajuan/";
        
        $this->template->admin('page/view_data_ajuan_masuk_mengajar',$data);
    }

    public function simpanajuan(){
        if($this->input->post('submit')){
            $where2=array(
                "idajuan" => $this->input->post('idajuan')        
            );
            $query2 = $this->M_ajuan_masuk_mengajar->get_row($where2);
            $cek2=$query2->num_rows();
            if($cek2 > 0 ){
                $data = array(
                    "tanggapan" => $this->input->post('balasan'),
                    "status" => $this->input->post('status'),
                );
                $queri=$this->M_ajuan_masuk_mengajar->update($where2,$data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                    
            }else{
                $this->session->set_flashdata('info',"Data ajuan tidak ada");
            }
            

            redirect('page/ajuanmasukmengajar');
            //echo $cek2;

        }else{
            redirect('page/home');
        }

    }

   
}