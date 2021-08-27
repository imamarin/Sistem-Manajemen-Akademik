<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kehadiran extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'30','katmenu'=>'7'));

    }
    

    public function index(){
        $where=array(
            'k.kdkelas'=>$this->session->kdkelas,
            'st.semester'=>$this->session->semester,
            's.idtahunajaran'=>$this->session->tahun
        );

        $data['jadwal'] = $this->M_jadwal->get_row_join2($where)->result();
        $this->template->admin('page/view_kehadiran_siswa',$data);
    }

    
    function tampil(){
        if($this->input->post('submit')){
            if($this->input->post('submit')){
                $where2=array(
                    'siswakelas.kdkelas'=>$this->session->kdkelas,
                    'siswakelas.nisn'=>$this->session->nisn,
                    'siswakelas.idtahunajaran'=>$this->session->tahun,
                );
                $where=array(
                    "jadwal.kdguru"=>$this->input->post('h_kdguru'),
                    "jadwal.kdmatpel"=>$this->input->post('h_kdmatpel'),
                    'detailabsensi.nisn'=>$this->session->nisn,
                    "absensi.semester"=>$this->session->semester,
                    "setjadwal.idtahunajaran"=>$this->session->tahun,
                );
                $data['siswa'] = $this->M_siswa->get_row_join_rekapabsen2($where2,$this->session->semester,$this->input->post('h_kdmatpel'),$this->input->post('h_kdguru'))->row();
                $data['detail']=$this->M_absen_detail->get_row3($where)->result();
                $data['matpel']=$this->input->post('h_matpel');
                $data['nama']=$this->input->post('h_nama');
                $this->template->admin('page/view_rekap_kehadiran_siswa_tampil',$data);
            }else{
                redirect('page/kehadiran');
            }
        }else{
            redirect('page/kehadiran');

        }
    }

    

    
   
}