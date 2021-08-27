<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jadwalmengajar extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'12','katmenu'=>'4'));

    }
    

    public function index(){
        $where=array(
            'g.kdguru'=>$this->session->kdguru,
            'j.semester'=>$this->session->semester,
            'st.idtahunajaran'=>$this->session->tahun
        );

        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.status'=>1,
            
        );
        $data['jadwal'] = $this->M_jadwal->get_row_join($where)->result();
        $data['kelas'] = $this->M_kelas->get_all_join()->result();
        $data['tahun'] = $this->M_tahunajaran->get_row(array('settahunajaran.status'=>1))->result();
        $data['matpel'] = $this->M_matpelguru->get_row_join($where2)->result();
        $data['form_action'] = "page/jadwalmengajar/simpan";
        $data['hapus_action'] = "page/jadwalmengajar/hapus/";
        $data['update_action'] = "page/jadwalmengajar/update/";
        
        $this->template->admin('page/view_jadwal',$data);
    }

    public function simpan(){

        if($this->input->post('submit')){
            $where2=array(
                "hari"=>strtolower($this->input->post('hari')),
                "jam"=>$this->input->post('jam'),
                "idtahunajaran"=>$this->input->post('tahun'),
            
            );
            $query2 = $this->M_setjadwal->get_row2($where2);
            $cek2=$query2->num_rows();
            $row=$query2->row();
            if($cek2 > 0 ){
                $where=array(
                    "kdkelas"=>$this->input->post('kdkelas'),
                    "kdmatpel"=>$this->input->post('matpel'),
                    "kdguru"=>$this->session->kdguru,
                    "idsetjadwal"=>$row->idsetjadwal,
                    "semester"=>$this->session->semester,
                    "pekan"=>$this->input->post('pekan'),
                );
                $query = $this->M_jadwal->get_row($where);
                $cek=$query->num_rows();
                
                if($cek < 1){
                    $data=array(
                        "kdkelas"=>$this->input->post('kdkelas'),
                        "kdmatpel"=>$this->input->post('matpel'),
                        "kdguru"=>$this->session->kdguru,
                        "pekan"=>$this->input->post('pekan'),
                        "idsetjadwal"=>$row->idsetjadwal,
                        "semester"=>$this->session->semester,
                        "jml_jam"=>$this->input->post('jml'),                                      
                    );
                    $queri=$this->M_jadwal->add($data);
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data berhasil disimpan");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal disimpan");
                    }
                    
                }else{
                    $this->session->set_flashdata('info',"Data Tidak Tersimpan");
                }
            }else{
                $this->session->set_flashdata('info',"Hari dan jam tidak tersedia");
            }
            

            redirect('page/jadwalmengajar');
            //echo $cek2;

        }else{
            redirect('page/home');
        }

    }

    public function update($id=NULL){

        if($this->input->post('submit')){
            $where2=array(
                "hari"=>strtolower($this->input->post('hari')),
                "jam"=>$this->input->post('jam'),
                "idtahunajaran"=>$this->input->post('tahun'),
            );
            $query2 = $this->M_setjadwal->get_row2($where2);
            $cek2=$query2->num_rows();
            $row=$query2->row();
            if($cek2 > 0 ){
                $where=array(
                    "idjadwal"=>$id,
                );
                $query = $this->M_jadwal->get_row($where);
                $cek=$query->num_rows();
                
                if($cek > 0){
                    $data=array(
                        "kdkelas"=>$this->input->post('kdkelas'),
                        "kdmatpel"=>$this->input->post('matpel'),
                        "kdguru"=>$this->session->kdguru,
                        "pekan"=>$this->input->post('pekan'),
                        "idsetjadwal"=>$row->idsetjadwal,
                        "semester"=>$this->session->semester,
                        "jml_jam"=>$this->input->post('jml'),                                      
                    );
                    $queri=$this->M_jadwal->update($where,$data);
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data berhasil diubah");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal diubah");
                    }
                    
                }
            }else{
                $this->session->set_flashdata('info',"Hari dan jam tidak tersedia");
            }
            

            redirect('page/jadwalmengajar');
            //echo $cek2;

        }else{
            redirect('page/home');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "idjadwal"=>$id,
        );
        $queri=$this->M_jadwal->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/jadwalmengajar");
    }

   
}