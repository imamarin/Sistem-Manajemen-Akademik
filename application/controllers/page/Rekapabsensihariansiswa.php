<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekapabsensihariansiswa extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'38','katmenu'=>'7'));

    }
    
    
    function index(){

                $where2=array(
                    'siswakelas.kdkelas'=>$this->session->kdkelas,
                    'siswakelas.nisn'=>$this->session->nisn,
                    'siswakelas.idtahunajaran'=>$this->session->tahun,
                );
                $where=array(
                    'detailabsensiharian.nisn'=>$this->session->nisn,
                    "absensiharian.semester"=>$this->session->semester,
                    "absensiharian.idtahunajaran"=>$this->session->tahun,
                );
                $data['siswa'] = $this->M_siswa->get_row_join_count_absenharian($where2,$this->session->semester)->row();
                $data['detail']=$this->M_absen_detail_harian->get_row_join($where)->result();
                $this->template->admin('page/view_rekap_kehadiran_siswa_harian',$data);

    }

    

    
   
}