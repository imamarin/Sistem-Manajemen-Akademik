<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class nilaiprakerin extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'56','katmenu'=>'12'));
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
        $data['hapus_action'] = "page/ujianharian/hapus/";
        $this->template->admin('page/raport/view_nilai_prakerin',$data);      
    }

    function input(){
        if($this->input->post('submit')){

            $this->simpan();

            $where=array(
                'siswakelas.kdkelas'=>$this->input->post('kelas'),
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );


            $data['prakerin'] = $this->M_prakerin_raport->get_row_join_prakerinraport($where)->result();

            $where2=array(
                'idtahunajaran'=>$this->session->idtahunraport
            );

            $row=$this->M_tahunajaran->get_row($where2)->row();

            $data['tahun']=$row->tahun;
            $data['idtahunajaran']=$this->session->idtahunraport;
            $data['kdkelas']=$this->input->post('kelas');
            $data['semester']=$this->session->semesterraport;
            $data['form_action'] = "page/raport/nilaiprakerin/input";
            $this->template->admin('page/raport/view_nilai_prakerin_add',$data);
        }else{
            redirect('page/raport/nilaiprakerin');
        }
    }

    public function simpan(){
        if($this->input->post('submit')=="simpan"){

            $nisn=$this->input->post('nisn');
            $dudi=$this->input->post('dudi');
            $alamatdudi=$this->input->post('alamatdudi');
            $waktu=$this->input->post('waktu');
            $nilai=$this->input->post('nilai');
            foreach($nisn as $key=>$v){
                $where=array(
                    'nisn'=>$v,
                );
                $queri=$this->M_prakerin_raport->delete($where);
                $queri=$this->M_prakerin_raport->get_row($where);
                if($queri->num_rows()<1){
                    $data=array(
                        'nisn'=>$v,
                        'idtahunajaran'=>$this->session->idtahunraport,
                        'nilai'=>isset($nilai[$key])?$nilai[$key]:0,
                        'waktu'=>isset($waktu[$key])?$waktu[$key]:0,
                        'alamat'=>isset($alamatdudi[$key])?$alamatdudi[$key]:"-",
                        'dudi'=>isset($dudi[$key])?$dudi[$key]:"-",
                    );
                    $queri2=$this->M_prakerin_raport->add($data);
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data berhasil disimpan");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal disimpan");
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