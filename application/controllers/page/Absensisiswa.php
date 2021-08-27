<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class absensisiswa extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'13','katmenu'=>'4'));

    }
    

    public function index(){

        $where=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('tahun')
        );
        $data['siswakelas'] = $this->M_siswa->get_row_join($where)->result();

        $this->template->admin('page/view_absensi_siswa',$data);
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