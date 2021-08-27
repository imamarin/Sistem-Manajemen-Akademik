<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cetak extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'57','katmenu'=>'12'));
        if(empty($this->session->idraport)){
            redirect('page/raport/aktivasi');
        }
    }
    

    public function index(){
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
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
        $this->template->admin('page/raport/view_cetak_raport',$data);      
    }

    public function semua($v=NULL, $k=NULL, $sms=NULL, $id=NULL){
        if(in_array("Semua Kelas-57", $this->session->fitur)){
            if($v==NULL){
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
            }else{
                $kelas = str_replace("%20"," ",$k);
                $where=array(
                    'siswakelas.kdkelas'=>$kelas,
                    'siswakelas.idtahunajaran'=>$id,
                    'siswa.status'=>1
                );

                $data['siswa'] = $this->M_siswa->get_row_ranking($where,$sms,$id)->result();


                $where2=array(
                    'idtahunajaran' => $id
                );


                $row=$this->M_tahunajaran->get_row($where2)->row();
                $data['tahun']=$row->tahun;
                $data['idtahunajaran']=$id;
                $data['kdkelas']=$kelas;
                $data['semester']=$sms;
                $this->template->admin('page/raport/view_ranking',$data);
            }   
        }else{
            redirect('page/home');
        }
    }

    function ranking($k=NULL, $sms=NULL, $id=NULL){
        $kelas = str_replace("%20"," ",$k);
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.idtahunajaran'=>$id,
        );
        $queri = $this->M_walikelas->get_row2($where2)->row();

            $where=array(
                'siswakelas.kdkelas'=>$kelas,
                'siswakelas.idtahunajaran'=>$id,
                'siswa.status'=>1
            );

            $data['siswa'] = $this->M_siswa->get_row_ranking($where,$sms,$id)->result();


            $where2=array(
                'idtahunajaran' => $this->session->idtahunraport
            );


            $row=$this->M_tahunajaran->get_row($where2)->row();
            $data['tahun']=$row->tahun;
            $data['idtahunajaran']=$id;
            $data['kdkelas']=$kelas;
            $data['semester']=$sms;
            $this->template->admin('page/raport/view_ranking',$data);               
    }

    public function siswa(){
        $where2=array(
            'walikelas.kdkelas'=>"XI RPL 1",
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
        $this->template->admin('page/raport/view_cetak_raport3',$data);      
    }

    function versi($v=NULL,$rap=NULL,$kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
        redirect('page/raport/'.$v.'/'.$rap.'/'.$kls.'/'.$start.'/'.$limit.'/'.$g);
        
    }

    function download($v=NULL,$rap=NULL,$kls=NULL,$start=NULL,$limit=NULL,$g=NULL){
        redirect('page/raport/'.$v.'/'.$rap.'/'.$g);
        
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