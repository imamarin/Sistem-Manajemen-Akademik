<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class matpelkelas extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'50','katmenu'=>'12'));
        if(empty($this->session->idraport)){
            redirect('page/raport/aktivasi');
        }
    }
    

    public function index(){
        $this->simpan();

        if($this->input->post('submit')){
            $where=array(
                'walikelas.kdkelas'=>$this->input->post('kdkelas'),
                'walikelas.kdguru'=>$this->session->kdguru,
                'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
                'matpelkelas.semester'=>$this->session->semesterraport,
            );

            $where2=array(
                'kelas.kdkelas'=>$this->input->post('kdkelas'),
                'guru.kdguru'=>$this->session->kdguru,
                'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
            );
        }else{
            $where=array(
                'walikelas.kdguru'=>$this->session->kdguru,
                'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
                'matpelkelas.semester'=>$this->session->semesterraport,
            );

            $where2=array(
                'guru.kdguru'=>$this->session->kdguru,
                'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
            );
        }

        $data['kelas'] = $this->M_walikelas->get_row($where2)->result();
        $data['guru'] = $this->M_guru->get_all()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['matpel'] = $this->M_matpel->get_all()->result();
        $data['matpelkelas'] = $this->M_matpelkelas->get_row_join($where)->result();
        $data['form_action']='page/raport/matpelkelas/';
        $data['kls']="";
        //echo $this->M_matpelguru->get_row_join($where)->num_rows();
        $this->template->admin('page/raport/view_matpel_kelas',$data);
    }

    public function semua(){
        if(in_array("Semua kelas-50", $this->session->fitur)){
            $this->simpan();

            if($this->input->post('submit')){
                $where=array(
                    'walikelas.kdkelas'=>$this->input->post('kdkelas'),
                    'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
                    'matpelkelas.semester'=>$this->session->semesterraport,
                );

                $where2=array(
                    'kelas.kdkelas'=>$this->input->post('kdkelas'),
                    'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
                );
            }else{
                $where=array(
                    'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
                    'matpelkelas.semester'=>$this->session->semesterraport,
                );

                $where2=array(
                    'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
                );
            }

            $data['kelas'] = $this->M_walikelas->get_row($where2)->result();
            $data['guru'] = $this->M_guru->get_all()->result();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['matpel'] = $this->M_matpel->get_all()->result();
            $data['matpelkelas'] = $this->M_matpelkelas->get_row_join($where)->result();
            $data['form_action']='page/raport/matpelkelas/semua';
            $data['kls']="";
            //echo $this->M_matpelguru->get_row_join($where)->num_rows();
            $this->template->admin('page/raport/view_matpel_kelas',$data);
        }else{
            redirect('page/raport/matpelkelas');
        }
    }

    public function simpan(){

        if($this->input->post('submit')){
            $where=array(
                "kdmatpel"=>$this->input->post('kdmatpel'),
                "kdkelas"=>$this->input->post('kdkelas'),
                "semester"=>$this->session->semesterraport,
                "idtahunajaran"=>$this->session->idtahunraport,
            );
            $query = $this->M_matpelkelas->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "kdmatpel"=>$this->input->post('kdmatpel'),
                    "kdkelas"=>$this->input->post('kdkelas'),
                    "kdguru"=>$this->input->post('kdguru'),
                    "semester"=>$this->session->semesterraport,
                    "idtahunajaran"=>$this->session->idtahunraport,                                       
                );
                $queri=$this->M_matpelkelas->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                
            }else{
                $this->session->set_flashdata('info',"Data Tidak Tersimpan");
            }

            //redirect('page/raport/matpelkelas');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "sha1(idmatpelkelas)"=>$id,
        );
        $this->M_matpelkelas->delete($where);
        $this->session->set_flashdata('info',"Data telah dihapus");
        redirect("page/raport/matpelkelas");
    }

    

}