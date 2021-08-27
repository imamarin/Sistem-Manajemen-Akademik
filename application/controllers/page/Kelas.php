<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kelas extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'5','katmenu'=>'1'));

    }
    

    public function index(){
        $data['kelas'] = $this->M_kelas->get_all_join()->result();
        $data['jurusan'] = $this->M_jurusan->get_all()->result();
        $this->template->admin('page/view_kelas',$data);
    }

    public function add(){
        $data=array(
            "nisn"=>$this->input->post('nisn'),
            "nis"=>$this->input->post('nis'),
            "nik"=>$this->input->post('nik'),
            "nama"=>$this->input->post('nama'),
            "jk"=>$this->input->post('jk'),
            "tmplahir"=>$this->input->post('tmplahir'),
            "tgllahir"=>$this->input->post('tgllahir'),
            "asalsekolah"=>$this->input->post('asalsekolah'),
            "alamatsiswa"=>$this->input->post('alamatsiswa'),
            "hpsiswa"=>$this->input->post('hpsiswa'),
            "tglterima"=>$this->input->post('tglterima'),
            "nmayah"=>$this->input->post('nmayah'),
            "nmibu"=>$this->input->post('nmibu'),
            "pekayah"=>$this->input->post('pekayah'),
            "pekibu"=>$this->input->post('pekibu'),
            "alamatorangtua"=>$this->input->post('alamatorangtua'),
            "hporangtua"=>$this->input->post('hporangtua'),
            "tidakaktif"=>"",
            "status"=>$this->input->post('status'),
            "username"=>$this->input->post('username'),
            "password"=>$this->input->post('password'),
        );    
        $data['level'] = $this->M_level->get_all()->result();
        $data['lvl'] = "";
        $data['form_action']='page/siswa/simpan/';
        $this->template->admin('page/view_add_siswa',$data);
    }

    public function simpan(){

        if($this->input->post('submit')){
            $where=array(
            "kdkelas"=>$this->input->post('kdkelas'),
            );
            $query = $this->M_kelas->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "kdkelas"=>$this->input->post('kdkelas'),
                    "tingkat"=>$this->input->post('tingkat'),
                    "kdjurusan"=>$this->input->post('kdjurusan'),                                       
                );
                $queri=$this->M_kelas->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                
            }else{
                $this->session->set_flashdata('info',"Data Tidak Tersimpan");
            }

            redirect('page/kelas');
        }else{
            redirect('page/home');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "kdkelas"=>str_replace("%20", " ", $id),
        );
        $queri=$this->M_kelas->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/kelas");
    }

   
}