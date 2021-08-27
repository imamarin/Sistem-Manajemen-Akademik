<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kasussiswaguru extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'34','katmenu'=>'4'));

    }
    

    public function index(){
        $where2=array(
            'settahunajaran.status'=>1
        );
        $where3=array(
            'kasussiswa.kdguru'=>$this->session->kdguru,
        );
        $data['kasus'] = $this->M_kasus_siswa->get_row_join_siswa($where3)->result();
        $data['siswa'] = $this->M_siswa->get_row_join5($where2)->result();
        $data['form_action']='page/kasussiswaguru/cari/';
        $data['hapus_action']='page/kasussiswaguru/hapus/';
        $this->template->admin('page/view_kasus_siswa_guru',$data);

    }

    public function simpan(){

        if($this->input->post('submit')){

                $data=array(
                    "nisn"=>$this->input->post('nisn'),
                    "tgl_laporan"=>$this->input->post('tanggal'),
                    "kasus"=>$this->input->post('kasus'),                                       
                    "kdguru"=>$this->session->kdguru,                                       
                );
                $queri=$this->M_kasus_siswa->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }

            redirect('page/kasussiswaguru');
        }else{
            redirect('page/kasussiswaguru');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "idkasussiswa"=>$id,
        );
        $queri=$this->M_kasus_siswa->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/kasussiswaguru");
    }

   
}