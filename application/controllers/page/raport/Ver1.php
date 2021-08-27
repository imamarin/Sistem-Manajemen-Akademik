<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ver1 extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'57','katmenu'=>'12'));

    }
    

    function cover($kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        if($g==NULL){
            $kdguru=$this->session->kdguru;
        }else{
            $kdguru=$g;
        }
        $where2=array(
            'guru.kdguru'=>$kdguru,
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
            /*
            $where=array(
                'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                'dataraport.semester'=>$this->session->semesterraport,
            );
            */
            $where=array(
                'dataraport.id'=>$this->session->idraport,
            );
            $data['dr'] = $this->M_raport->get_row($where)->row();

            $this->load->view('page/raport/versi1/cover.php',$data);
        }
    }

    function raport1($kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        if($g==NULL){
            $kdguru=$this->session->kdguru;
        }else{
            $kdguru=$g;
        }
        $where2=array(
            'guru.kdguru'=>$kdguru,
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
            if($start>0){
                $mulai=$start-1;
                $akhir=$limit-$mulai;
            }else{
                $mulai=0;   
                $akhir=1;
            }
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$akhir)->result();

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
            $this->load->view('page/raport/versi1/raport1.php',$data);
        }
    }

    function raport2($kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        if($g==NULL){
            $kdguru=$this->session->kdguru;
        }else{
            $kdguru=$g;
        }
        $where2=array(
            'guru.kdguru'=>$kdguru,
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
            $akhir=$limit-$mulai;
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$akhir)->result();

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
                //'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                //'dataraport.semester'=>$this->session->semesterraport,
                'dataraport.id'=>$this->session->idraport,
            );
            $data['dr'] = $this->M_raport->get_row($where2)->row();
            //echo $this->session->tahunraport;
            $this->load->view('page/raport/versi1/raport2.php',$data);
        }
    }

    function raport3($kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
       
        $kelas = str_replace("%20"," ",$kls);
        if($g==NULL){
            $kdguru=$this->session->kdguru;
        }else{
            $kdguru=$g;
        }
        $where2=array(
            'guru.kdguru'=>$kdguru,
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
            $akhir=$limit-$mulai;
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$akhir)->result();
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
                    'kenaikanraport.nisn'=>$siswa->nisn,
                    'kenaikanraport.idtahunajaran'=>$this->session->idtahunraport,
                    'kenaikanraport.semester'=>$this->session->semesterraport
                );
                
                $kenaikan = $this->M_kenaikan_raport->get_row($where);
                foreach($kenaikan->result() as $row2){                
                    $data['kenaikan'][$siswa->nisn]['nilai']=$row2->nilai;
                    //$data['kenaikan'][$siswa->nisn]['kdkelas']=$row2->alamat;
                }

            }

            
            
            
            //echo $sikap->num_rows();
            $where2=array(
                //'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                //'dataraport.semester'=>$this->session->semesterraport,
                'dataraport.id'=>$this->session->idraport,
            );

            $data['dr'] = $this->M_raport->get_row($where2)->row();
            $data['walikelas'] = $queri->row();
            
            //print_r($data['absen']);
            $this->load->view('page/raport/versi1/raport3.php',$data);
            //print_r($data['kenaikan']);
        }
    }

    function suratkeluar($kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
        $kelas = str_replace("%20"," ",$kls);
        if($g==NULL){
            $kdguru=$this->session->kdguru;
        }else{
            $kdguru=$g;
        }
        $where2=array(
            'guru.kdguru'=>$kdguru,
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
            $akhir=$limit-$mulai;
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$akhir)->result();
            $where2=array(
                //'dataraport.idtahunajaran'=>$this->session->idtahunraport,
                //'dataraport.semester'=>$this->session->semesterraport,
                'dataraport.id'=>$this->session->idraport,
            );
    
            $data['dr'] = $this->M_raport->get_row($where2)->row();
            $data['walikelas'] = $queri->row();
            $this->load->view('page/raport/versi1/suratkeluar.php',$data);
        }else{
            redirect('page/raport/cetak');
        }

        
    }

    function download($kls=NULL,$id=NULL,$sms=NULL){
        $kelas=$this->session->kdkelas;

        $where2=array(
            'settahunajaran.idtahunajaran'=>$id,
            'kelas.kdkelas'=>$kelas
        );
        $queri = $this->M_walikelas->get_row2($where2);
        if($queri->num_rows()>0){
            $where3=array(
                'siswakelas.nisn'=>$this->session->nisn,
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$id,
                'siswa.status'=>1
            );
            $data['siswa'] = $this->M_siswa->get_row_join6($where3,0,1)->result();

            $where=array(
                'dataraport.idtahunajaran'=>$id,
                'dataraport.semester'=>$sms,
            );
            $data['dr'] = $this->M_raport->get_row($where)->row();

            //$this->load->view('page/raport/versi1/cover.php',$data);


        /////////////////////////////////

            $where3=array(
                'siswakelas.nisn'=>$this->session->nisn,
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$id,
                'siswa.status'=>1
            );

            $data['siswa'] = $this->M_siswa->get_row_join6($where3,0,1)->result();

            $where=array(
                'siswakelas.kdkelas'=>$kelas,
                'nilaisikapraport.semester'=>$sms,
                'nilaisikapraport.idtahunajaran'=>$id,
            );
            
            $sikap = $this->M_nilaisikapraport->get_row_siswakelas($where);
            foreach($sikap->result() as $row2){                
                $data[$row2->kategori][$row2->nisn][]=$row2->jenis;
            }
            
            
            //echo $sikap->num_rows();
            $where2=array(
                'dataraport.idtahunajaran'=>$id,
                'dataraport.semester'=>$this->session->semesterraport,
            );
            $data['dr'] = $this->M_raport->get_row($where2)->row();


        //////////////////////////////////////////

            $where3=array(
                'siswakelas.nisn'=>$this->session->nisn,
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$id,
                'siswa.status'=>1
            );

            $data['siswa'] = $this->M_siswa->get_row_join6($where3,0,1)->result();

            $where=array(
                'matpelkelas.kdkelas'=>$kelas,
                'matpelkelas.semester'=>$sms,
                'matpelkelas.idtahunajaran'=>$id,
                'matpel.kelompok'=>'A'
            );
            
            $data['matpel_A'] = $this->M_matpelkelas->get_row_join_raport($where)->result();

            $where=array(
                'matpelkelas.kdkelas'=>$kelas,
                'matpelkelas.semester'=>$sms,
                'matpelkelas.idtahunajaran'=>$id,
                'matpel.kelompok'=>'B'
            );
            
            $data['matpel_B'] = $this->M_matpelkelas->get_row_join_raport($where)->result();

            $where=array(
                'matpelkelas.kdkelas'=>$kelas,
                'matpelkelas.semester'=>$sms,
                'matpelkelas.idtahunajaran'=>$id,
                'matpel.kelompok'=>'C1'
            );
            
            $data['matpel_C'] = $this->M_matpelkelas->get_row_join_raport($where)->result();

            $where="matpelkelas.kdkelas='".$kelas."' AND matpelkelas.semester='".$sms."' AND matpelkelas.idtahunajaran='".$id."' AND (matpel.kelompok='C2' OR matpel.kelompok='C3')";        
            $data['matpel_D'] = $this->M_matpelkelas->get_row_join_raport($where)->result();
            
            $where=array(
                'nilairaport.kdkelas'=>$kelas,
                'nilairaport.semester'=>$sms,
                'nilairaport.idtahunajaran'=>$id,
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
                'dataraport.idtahunajaran'=>$id,
                'dataraport.semester'=>$sms,
            );
            $data['dr'] = $this->M_raport->get_row($where2)->row();
            //echo $this->session->tahunraport;
           // $this->load->view('page/raport/versi1/raport2.php',$data);


        ////////////////////////////////////////////////////

            $where3=array(
                'siswakelas.nisn'=>$this->session->nisn,
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$id,
                'siswa.status'=>1
            );

            $data['siswa'] = $this->M_siswa->get_row_join6($where3,0,1)->result();
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
                    'nilaiekstraraport.semester'=>$sms,
                    'nilaiekstraraport.idtahunajaran'=>$id,
                );
                
                $ekstra = $this->M_nilaiekstraraport->get_row_ekstra($where);
                foreach($ekstra->result() as $row2){                
                    $data['ekstranama'][$siswa->nisn][]=$row2->nama;
                    $data['ekstranilai'][$siswa->nisn][]=$row2->nilai;
                }

                $where=array(
                    'absensiraport.nisn'=>$siswa->nisn,
                    'absensiraport.semester'=>$sms,
                    'absensiraport.idtahunajaran'=>$id,
                );
                
                $absen = $this->M_absensi_raport->get_row($where);
                foreach($absen->result() as $row2){                
                    $data['absen'][$siswa->nisn]['izin']=$row2->izin;
                    $data['absen'][$siswa->nisn]['sakit']=$row2->sakit;
                    $data['absen'][$siswa->nisn]['alfa']=$row2->alfa;
                }

                $where=array(
                    'kenaikankelasraport.nisn'=>$siswa->nisn,
                    'kenaikankelasraport.idtahunajaran'=>$id
                );
                
                $kenaikan = $this->M_kenaikan_raport->get_row($where);
                foreach($kenaikan->result() as $row2){                
                    $data['kenaikan'][$siswa->nisn]['nilai']=$row2->dudi;
                    $data['kenaikan'][$siswa->nisn]['kdkelas']=$row2->alamat;
                }

            }

            $where2=array(
                'dataraport.idtahunajaran'=>$id,
                'dataraport.semester'=>$sms,
            );
            $data['dr'] = $this->M_raport->get_row($where2)->row();
            $data['walikelas'] = $queri->row();

            //$this->load->library('pdf');
            //$this->pdf->set_option('isRemoteEnabled', TRUE);

            //$this->pdf->setPaper('A4', 'potrait');
            //$this->pdf->set_option('isRemoteEnabled', TRUE);
            //$this->pdf->set_option('isPhpEnabled', TRUE);
            //$this->pdf->set_option('isJavascriptEnabled', TRUE);
            //$this->pdf->set_option('isHTML5ParserEnabled', TRUE);
            //$this->pdf->set_option('isCssEnabled', TRUE);
            //$this->pdf->filename = "raport-".$this->session->nisn.".pdf";
            //$this->pdf->load_view('page/raport/versi1/raportsemua.php', $data);
   
            
            //$this->load->view('page/raport/versi1/raportsemua.php', $data);
           

            $this->load->library('pdf');
            $this->pdf->set_option('isRemoteEnabled', TRUE);
            $this->pdf->setPaper('A4', 'potrait');
            $this->pdf->filename = "Raport.pdf";
            $this->pdf->load_view('page/raport/versi1/raportsemua', $data);
        }
    }

    function transkrip($kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
        $kelas = str_replace("%20"," ",$kls);
        $where3=array(
            'siswakelas.kdkelas'=>$kelas,
            'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
            'siswa.status'=>1
        );
        if($start>0){
            $mulai=$start-1;
            $akhir=$limit-$mulai;
        }else{
            $mulai=0;   
            $akhir=1;
        }
        $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$akhir)->result();
        $where2=array(
            'dataraport.idtahunajaran'=>$this->session->idtahunraport,
            'dataraport.semester'=>$this->session->semesterraport,
        );
        $data['dr'] = $this->M_raport->get_row($where2)->row();
        $this->load->view('page/raport/versi1/transkrip2.php',$data);
    }

    function transkrip2($kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
        $kelas = str_replace("%20"," ",$kls);
        $where3=array(
            'siswakelas.kdkelas'=>$kelas,
            'siswakelas.idtahunajaran'=>$this->session->idtahunraport,
            'siswa.status'=>1
        );
        if($start>0){
            $mulai=$start-1;
            $akhir=$limit-$mulai;
        }else{
            $mulai=0;   
            $akhir=1;
        }
        $data['siswa'] = $this->M_siswa->get_row_join6($where3,$mulai,$akhir)->result();
        $where2=array(
            'dataraport.idtahunajaran'=>$this->session->idtahunraport,
            'dataraport.semester'=>$this->session->semesterraport,
        );
        $data['dr'] = $this->M_raport->get_row($where2)->row();
        $this->load->view('page/raport/versi1/transkrip2.php',$data);
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

   
}