<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jadwalmengajarguru extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'20','katmenu'=>'6'));

    }
    

    public function index(){
        $data['guru'] = $this->M_guru->get_all()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['form_action'] = 'page/jadwalmengajarguru/tampil';
        $this->template->admin('page/view_jadwal_mengajar',$data);
    }

    public function tampil($kdguru=NULL){
        $where=array(
            'g.kdguru'=>$kdguru,
            'j.semester'=>$this->session->semester,
            'st.idtahunajaran'=>$this->session->tahun
        );

        $where2=array(
            'guru.kdguru'=>$kdguru,
            'settahunajaran.idtahunajaran'=>$this->session->tahun
        );
        $data['jadwal'] = $this->M_jadwal->get_row_join($where)->result();
        $data['kelas'] = $this->M_kelas->get_all_join()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['matpel'] = $this->M_matpelguru->get_row_join($where2)->result();
        $data['form_action'] = "page/jadwalmengajarguru/simpan/$kdguru";
        $data['hapus_action'] = "page/jadwalmengajarguru/hapus/$kdguru/";
        $data['update_action'] = "page/jadwalmengajarguru/update/$kdguru/";

        $this->template->admin('page/view_jadwal',$data);
    }

    
    public function simpan($id=NULL){

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
                    "kdguru"=>$id,
                    "idsetjadwal"=>$row->idsetjadwal,
                    "pekan"=>$this->input->post('pekan'),
                );
                $query = $this->M_jadwal->get_row($where);
                $cek=$query->num_rows();
                
                if($cek < 1){
                    $data=array(
                        "kdkelas"=>$this->input->post('kdkelas'),
                        "kdmatpel"=>$this->input->post('matpel'),
                        "kdguru"=>$id,
                        "pekan"=>$this->input->post('pekan'),
                        "idsetjadwal"=>$row->idsetjadwal,
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
            

            redirect('page/jadwalmengajarguru/tampil/'.$id);
            //echo $cek2;

        }else{
            redirect('page/home');
        }

    }

    public function update($kdguru=NULL,$id=NULL){

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
                        "kdguru"=>$kdguru,
                        "pekan"=>$this->input->post('pekan'),
                        "idsetjadwal"=>$row->idsetjadwal,
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
            

            redirect('page/jadwalmengajarguru/tampil/'.$kdguru);
            //echo $cek2;

        }else{
            redirect('page/home');
        }

    }

    public function hapus($kdguru=NULL,$id=NULL){

        $where=array(
            "idjadwal"=>$id,
        );
        $queri=$this->M_jadwal->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/jadwalmengajarguru/tampil/".$kdguru);
    }

   
}