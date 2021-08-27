<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class siswa extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'58','katmenu'=>'12'));
    }
    

    public function index(){
        $where = array(
            'walikelas.kdkelas'=>$this->session->kdkelas,
            'settahunajaran.idtahunajaran >='=>$this->session->tahunterima,
        );

        $data['raport'] = $this->M_raport->get_row2($where)->result();                     
        $this->template->admin('page/raport/view_cetak_raport3',$data);
        /*
        $where2=array(
            'siswa.nisn'=>$this->session->nisn,
        );
        $queri = $this->M_siswakelas->get_row_join_walikelas($where2);
        $kelas = $queri->result();
        $data['siswa']=array();
        $data['cetak']=array();
        foreach($kelas as $v){
            $where3=array(
                'siswakelas.kdkelas'=>$v->kdkelas,
                'siswa.status'=>1
            );

            $siswa = $this->M_siswa->get_row_join5($where3)->result();
            foreach($siswa as $v2){
                $data['siswa'][$v->kdkelas][]=$v2->nama;
            }

            $where4 = array(
              'tingkat' => $v->tingkat,
            );
            $cetak = $this->M_template_raport->get_row($where4)->result();
            foreach($cetak as $v2){
                $data['cetak'][$v->tingkat]=$v2->template;
            }
            
        }

        $data['kelas'] = $kelas;
        $this->template->admin('page/raport/view_cetak_raport3',$data);      
        */ 
    }

    public function semua(){
        $where2=array(
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
        );
        $queri = $this->M_walikelas->get_row2($where2);
        $kelas = $queri->result();
        $data['siswa']=array();
        $data['cetak']=array();
        foreach($kelas as $v){
            $where3=array(
                'siswakelas.kdkelas'=>$v->kdkelas,
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );

            $siswa = $this->M_siswa->get_row_join5($where3)->result();
            foreach($siswa as $v2){
                $data['siswa'][$v->kdkelas][]=$v2->nama;
            }

            $where4 = array(
              'tingkat' => $v->tingkat,
              'idtahunajaran' => $this->session->idtahunraport 
            );
            $cetak = $this->M_template_raport->get_row($where4)->result();
            foreach($cetak as $v2){
                $data['cetak'][$v->tingkat]=$v2->template;
            }
            
        }

        $data['kelas'] = $kelas;
        $this->template->admin('page/raport/view_cetak_raport2',$data);      
    }

    function versi($v=NULL,$rap=NULL,$kls=NULL,$g=NULL,$id=NULL,$sms=NULL){
        redirect('page/raport/'.$v.'/'.$rap.'/'.$kls.'/'.$id.'/'.$sms);
        
    }

    function cover($kls=NULL,$start=NULL,$limit=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
            'kelas.kdkelas'=>$kelas
        );
        $queri = $this->M_walikelas->get_row2($where2);
        if($queri->num_rows()>0){
            $where3=array(
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );
            $mulai=$start-1;
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$limit)->result();

            $where=array(
                'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                'dataraport.semester'=>$this->session->semesterraport,
            );
            $data['dr'] = $this->M_raport->get_row($where)->row();

            $this->load->view('page/raport/raport2018/cover.php',$data);
        }
    }

    function raport1($kls=NULL,$start=NULL,$limit=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
            'kelas.kdkelas'=>$kelas
        );
        $queri = $this->M_walikelas->get_row2($where2);
        if($queri->num_rows()>0){
            $where3=array(
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );
            $mulai=$start-1;
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$limit)->result();

            $where=array(
                'siswakelas.kdkelas'=>$kelas,
                'nilaisikapraport.semester'=>$this->session->semesterraport,
                'nilaisikapraport.idtahunajaran'=>$this->session->idtahunraport,
            );
            
            $sikap = $this->M_nilaisikapraport->get_row_siswakelas($where);
            foreach($sikap->result() as $row2){                
                $data[$row2->kategori][$row2->nisn][]=$row2->jenis;
            }
            
            
            //echo $sikap->num_rows();
            $where2=array(
                'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                'dataraport.semester'=>$this->session->semesterraport,
            );
            $data['dr'] = $this->M_raport->get_row($where2)->row();
            $this->load->view('page/raport/raport2018/raport1.php',$data);
        }
    }

    function raport2($kls=NULL,$start=NULL,$limit=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
            'kelas.kdkelas'=>$kelas
        );
        $queri = $this->M_walikelas->get_row2($where2);
        if($queri->num_rows()>0){
            $where3=array(
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );
            $mulai=$start-1;
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$limit)->result();

            $where=array(
                'matpelkelas.kdkelas'=>$kelas,
                'matpelkelas.semester'=>$this->session->semesterraport,
                'matpelkelas.idtahunajaran'=>$this->session->idtahunraport,
                'matpel.kelompok'=>'A'
            );
            
            $data['matpel_A'] = $this->M_matpelkelas->get_row_join_raport($where)->result();

            $where=array(
                'matpelkelas.kdkelas'=>$kelas,
                'matpelkelas.semester'=>$this->session->semesterraport,
                'matpelkelas.idtahunajaran'=>$this->session->idtahunraport,
                'matpel.kelompok'=>'B'
            );
            
            $data['matpel_B'] = $this->M_matpelkelas->get_row_join_raport($where)->result();

            $where=array(
                'matpelkelas.kdkelas'=>$kelas,
                'matpelkelas.semester'=>$this->session->semesterraport,
                'matpelkelas.idtahunajaran'=>$this->session->idtahunraport,
                'matpel.kelompok'=>'C1'
            );
            
            $data['matpel_C'] = $this->M_matpelkelas->get_row_join_raport($where)->result();

            $where="matpelkelas.kdkelas='".$kelas."' AND matpelkelas.semester='".$this->session->semesterraport."'
                 AND matpelkelas.idtahunajaran='".$this->session->idtahunraport."' AND (matpel.kelompok='C2' OR matpel.kelompok='C3')";
            
            $data['matpel_D'] = $this->M_matpelkelas->get_row_join_raport($where)->result();
            
            $where=array(
                'nilairaport.kdkelas'=>$kelas,
                'nilairaport.semester'=>$this->session->semesterraport,
                'nilairaport.idtahunajaran'=>$this->session->idtahunraport,
            );
            
            $nilai = $this->M_detail_nilai_raport->get_row_join($where);
            foreach($nilai->result() as $row2){                
                $data['pengetahuan'][$row2->kdmatpel][$row2->nisn]=$row2->pengetahuan;
                $data['keterampilan'][$row2->kdmatpel][$row2->nisn]=$row2->keterampilan;
                $data['pengetahuan'][$row2->kdmatpel]['kkm']=$row2->kkm;
                $data['keterampilan'][$row2->kdmatpel]['kkm']=$row2->kkm;
            }
            
            //echo print_r($data['pengetahuan']);
            //echo $sikap->num_rows();
            $where2=array(
                'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                'dataraport.semester'=>$this->session->semesterraport,
            );
            $data['dr'] = $this->M_raport->get_row($where2)->row();
            //echo $this->session->tahunraport;
            $this->load->view('page/raport/raport2020/raport2.php',$data);
        }
    }

    function raport3($kls=NULL,$start=NULL,$limit=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
            'kelas.kdkelas'=>$kelas
        );
        $queri = $this->M_walikelas->get_row2($where2);
        if($queri->num_rows()>0){
            $where3=array(
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
                'siswa.status'=>1
            );
            $mulai=$start-1;
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$limit)->result();
            $data['prakerin']=array();
            $data['ekstranama']=array();
            $data['ekstranilai']=array();
            $data['absen']=array();
            $data['kenaikan']=array();
            foreach($data['siswa'] AS $siswa){

                $where=array(
                    'prakerinraport.nisn'=>$siswa->nisn,
                );
                
                $prakerin = $this->M_prakerin_raport->get_row($where);
                foreach($prakerin->result() as $row2){                
                    $data['prakerin'][$siswa->nisn]['dudi']=$row2->dudi;
                    $data['prakerin'][$siswa->nisn]['alamat']=$row2->alamat;
                    $data['prakerin'][$siswa->nisn]['waktu']=$row2->waktu;
                    $data['prakerin'][$siswa->nisn]['nilai']=$row2->nilai;
                }

                $where=array(
                    'nilaiekstraraport.nisn'=>$siswa->nisn,
                    'nilaiekstraraport.semester'=>$this->session->semesterraport,
                    'nilaiekstraraport.idtahunajaran'=>$this->session->idtahunraport,
                );
                
                $ekstra = $this->M_nilaiekstraraport->get_row_ekstra($where);
                foreach($ekstra->result() as $row2){                
                    $data['ekstranama'][$siswa->nisn][]=$row2->nama;
                    $data['ekstranilai'][$siswa->nisn][]=$row2->nilai;
                }

                $where=array(
                    'absensiraport.nisn'=>$siswa->nisn,
                    'absensiraport.semester'=>$this->session->semesterraport,
                    'absensiraport.idtahunajaran'=>$this->session->idtahunraport,
                );
                
                $absen = $this->M_absensi_raport->get_row($where);
                foreach($absen->result() as $row2){                
                    $data['absen'][$siswa->nisn]['izin']=$row2->izin;
                    $data['absen'][$siswa->nisn]['sakit']=$row2->sakit;
                    $data['absen'][$siswa->nisn]['alfa']=$row2->alfa;
                }

                $where=array(
                    'kenaikankelasraport.nisn'=>$siswa->nisn,
                    'kenaikankelasraport.idtahunajaran'=>$this->session->idtahunajaran
                );
                
                $kenaikan = $this->M_kenaikan_raport->get_row($where);
                foreach($kenaikan->result() as $row2){                
                    $data['kenaikan'][$siswa->nisn]['nilai']=$row2->dudi;
                    $data['kenaikan'][$siswa->nisn]['kdkelas']=$row2->alamat;
                }

            }

            
            
            
            //echo $sikap->num_rows();
            $where2=array(
                'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                'dataraport.semester'=>$this->session->semesterraport,
            );
            $data['dr'] = $this->M_raport->get_row($where2)->row();
            $data['walikelas'] = $queri->row();

            //print_r($data['absen']);
            $this->load->view('page/raport/raport2020/raport3.php',$data);
        }
    }


    public function laporan_pdf(){

        $data = array(
            "dataku" => array(
                "nama" => "Petani Kode",
                "url" => "http://petanikode.com"
            )
        );
    
        $this->load->library('pdf');
    
        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "laporan-petanikode.pdf";
        $this->pdf->load_view('laporan_pdf', $data);
    
    
    }

    

   
}