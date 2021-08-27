<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nilaisikap extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'51','katmenu'=>'12'));
        if(empty($this->session->idraport)){
            redirect('page/raport/aktivasi');
        }
    }
    

    public function index(){
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
        );
        $data['kelas'] = $this->M_walikelas->get_row($where2)->result();                     
        $data['sikap'] = $this->M_nilaisikapraport->get_group()->result();                     
        $data['hapus_action'] = "page/ujianharian/hapus/";
        $this->template->admin('page/raport/view_nilai_sikap',$data);      
    }

    function input(){
        if($this->input->post('submit') || $this->input->post('kategori')){

            $this->simpan();

            $where=array(
                'siswakelas.kdkelas'=>$this->input->post('kelas'),
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );

            $where2=array(
                'nilaisikapraport.kategori'=>$this->input->post('kategori'),
                'siswakelas.kdkelas'=>$this->input->post('kelas'),
                'nilaisikapraport.semester'=>$this->session->semesterraport,
                'nilaisikapraport.idtahunajaran'=>$this->session->idtahunraport,
            );

            $where3=array(
                'kategori'=>$this->input->post('kategori'),
            );

            $data['siswa'] = $this->M_siswa->get_row_join5($where)->result();
            $data['sikap'] = $this->M_nilaisikapraport->get_row_sikap($where3)->result();
            $sikap = $this->M_nilaisikapraport->get_row($where2)->result();
            $kategori=$this->input->post('kategori');
            $data[$kategori]=array();
            foreach($sikap as $row2){
                
                $data[$kategori][$row2->nisn][$row2->jenis]=$row2->nilai;
            }


            $where2=array(
                'idtahunajaran'=>$this->session->idtahunraport
            );

            $row=$this->M_tahunajaran->get_row($where2)->row();

            $data['kategori']=$this->input->post('kategori');
            $data['tahun']=$row->tahun;
            $data['idtahunajaran']=$this->session->idtahunraport;
            $data['kdkelas']=$this->input->post('kelas');
            $data['semester']=$this->session->semesterraport;
            $data['form_action'] = "page/raport/nilaisikap/input";
            $this->template->admin('page/raport/view_nilai_sikap_add',$data);
        }else{
            redirect('page/raport/nilaisikap');
        }
    }

    public function simpan($kat=NULL){
        if($this->input->post('submit')=="simpan"){

            $nisn=$this->input->post('nisn');
            $sikap=$this->input->post('sikap');
            foreach($nisn as $key=>$v){
                $where=array(
                    'nisn'=>$v,
                    'semester'=>$this->session->semesterraport,
                    'kategori'=>$this->input->post('kategori'),
                    'idtahunajaran'=>$this->session->idtahunraport,
                );

                $queri=$this->M_nilaisikapraport->delete($where);
                    if(isset($sikap[$key])){
                        foreach($sikap[$key] as $key2=>$v2){
                            $data=array(
                                'nisn'=>$v,
                                'semester'=>$this->session->semesterraport,
                                'idtahunajaran'=>$this->session->idtahunraport,
                                'kategori'=> $this->input->post('kategori'),
                                'jenis'=>$v2,
                                'nilai'=>1,
                            );
                            $queri2=$this->M_nilaisikapraport->add($data);
                        }
                    }



            }
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "idujian"=>$id,
        );
        $queri=$this->M_nilairaport->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/ujianharian");
    }

    

   
}