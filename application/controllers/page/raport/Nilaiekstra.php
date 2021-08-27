<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nilaiekstra extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'55','katmenu'=>'12'));
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
        $data['ekstra'] = $this->M_nilaiekstraraport->get_all()->result();                     
        $data['hapus_action'] = "page/ujianharian/hapus/";
        $this->template->admin('page/raport/view_nilai_ekstra',$data);      
    }

    function input(){
        if($this->input->post('submit') || $this->input->post('ekstra')){
            $this->hapus();
            $this->simpan();

            $ekstra=explode("|",$this->input->post('ekstra'));
            $where=array(
                'siswakelas.kdkelas'=>$this->input->post('kelas'),
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );

            $where2=array(
                'nilaiekstraraport.idekstra'=>$ekstra[0],
                'siswakelas.kdkelas'=>$this->input->post('kelas'),
                'nilaiekstraraport.semester'=>$this->session->semesterraport,
                'nilaiekstraraport.idtahunajaran'=>$this->session->idtahunraport,
            );

            $data['siswa'] = $this->M_siswa->get_row_join5($where)->result();
            $data['nilaiekstra'] = $this->M_nilaiekstraraport->get_row_ekstra($where2)->result();

            $data['title']=$ekstra[1];
            $data['idekstra']=$ekstra[0];
            $data['idtahunajaran']=$this->session->idtahunraport;
            $data['kdkelas']=$this->input->post('kelas');
            $data['semester']=$this->session->semesterraport;
            $data['form_action'] = "page/raport/nilaiekstra/input";
            $this->template->admin('page/raport/view_input_ekstra',$data);
        }else{
            redirect('page/raport/nilaiekstra');
        }
    }

    public function simpan(){
        if($this->input->post('submit')=="simpan"){

            $nisn=$this->input->post('nisn');
            $nilai=$this->input->post('nilai');
            foreach($nisn as $key=>$v){
                $where=array(
                    'nilaiekstraraport.nisn'=>$v,
                    'nilaiekstraraport.semester'=>$this->session->semesterraport,
                    'nilaiekstraraport.idekstra'=>$this->input->post('idekstra'),
                    'nilaiekstraraport.idtahunajaran'=>$this->session->idtahunraport,
                );

                $queri=$this->M_nilaiekstraraport->get_row_ekstra($where);
                if($queri->num_rows()<1){
                    if(isset($nilai)){
                            $data=array(
                                'nisn'=>$v,
                                'semester'=>$this->session->semesterraport,
                                'idtahunajaran'=>$this->session->idtahunraport,
                                'idekstra'=>$this->input->post('idekstra'),
                                'nilai'=>$nilai,
                            );
                            $queri2=$this->M_nilaiekstraraport->add($data);
                    }else{
                        $data=array(
                            'nisn'=>$v,
                            'semester'=>$this->session->semesterraport,
                            'idtahunajaran'=>$this->session->idtahunraport,
                            'idekstra'=>$this->input->post('idekstra'),
                            'nilai'=>3,
                        );
                        $queri2=$this->M_nilaiekstraraport->add($data);
                    }
                }else{
                    if(isset($nilai)){
                            $data=array(
                                'nisn'=>$v,
                                'semester'=>$this->session->semesterraport,
                                'idtahunajaran'=>$this->session->idtahunraport,
                                'idekstra'=>$this->input->post('idekstra'),
                                'nilai'=>$nilai,
                            );
                            $queri2=$this->M_nilaiekstraraport->update($where,$data);
                    }else{
                        $data=array(
                            'nisn'=>$v,
                            'semester'=>$this->session->semesterraport,
                            'idtahunajaran'=>$this->session->idtahunraport,
                            'idekstra'=>$this->input->post('idekstra'),
                            'nilai'=>3,
                        );
                        $queri2=$this->M_nilaiekstraraport->update($where,$data);
                    }
                }    


            }
        }

    }

    public function hapus(){
        if($this->input->post('submit')=="hapus"){
            $where=array(
                "idnilaiekstra"=>$this->input->post('idnilaiekstra'),
            );
            $queri=$this->M_nilaiekstraraport->delete($where);
            if($queri==TRUE){
                $this->session->set_flashdata('info',"Data telah dihapus");
            }else{
                $this->session->set_flashdata('info',"Data gagal dihapus");
            }
        }
    }

    

   
}