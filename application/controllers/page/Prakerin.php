<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class prakerin extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_flashdata('info', "");
    }
    

    public function datasiswakelas(){
        $this->session->set_userdata(array('menu'=>'42','katmenu'=>'11'));
        if($this->input->post('tampil')){
            $where2=array(
                'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                'settahunajaran.status'=>1
            );
            $data['siswa'] = $this->M_siswa->get_row_join2($where2)->result();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['form_action']='page/prakerin/datasiswakelas/';
            $this->template->admin('page/view_siswa_kelas',$data);
        }else{
            $data['siswa'] = array();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $this->M_kelas->get_all()->result();

            $data['form_action']='page/prakerin/datasiswakelas/';
            $this->template->admin('page/view_siswa_kelas',$data);
        }
        
    }


    public function perusahaan($act=NULL,$params=NULL){
        if($act=="hapus"){
            $this->hapus($params);
        }
        if($this->input->post('submit')){
            $this->simpan();
            $this->edit();
            $this->upload();
        }
        $this->session->set_userdata(array('menu'=>'43','katmenu'=>'11'));

        $data['form_action'] = "page/prakerin/perusahaan";
        $data['hapus_action'] = "page/prakerin/perusahaan/hapus/";
        $data['update_action'] = "page/prakerin/perusahaan/";
        $data['eksport_action'] = "page/prakerin/eksportperusahaan/";
        $data['perusahaan'] = $this->M_perusahaan->get_all()->result();
        $this->template->admin('page/view_perusahaan',$data);
    }

    public function ajuanprakerin($act=NULL,$params=NULL){
        if($this->input->post('submit')=="eksport"){
            $this->eksportajuan();
        }else{
            $this->session->set_userdata(array('menu'=>'44','katmenu'=>'11'));
            if($act=="hapusajuan"){
                $this->hapusajuan($params);
            }

            if($this->input->post('submit')){
                $where=array(
                    'setprakerin.idprakerin'=>$this->input->post('idprakerin')
                );
            }else{
                $where=array(
                    'setprakerin.status'=>1
                );       
            }
            $prakerin = $this->M_prakerin->get_row($where)->row();
            $data['idprakerin'] = $prakerin->idprakerin;
            if($this->input->post('submit')){
                $this->simpanajuan();
                $this->editajuan();
                $this->upload();
                if($this->input->post('kdjurusan')=="semua"){
                    $where2=array(
                        "kelas.tingkat"=>$prakerin->tingkat,
                        'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                    );
                }else{
                    $where2=array(
                        'kelas.kdjurusan'=>$this->input->post('kdjurusan'),
                        "kelas.tingkat"=>$prakerin->tingkat,
                        'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                    );
                }
                $data['tambah']="enabled";    
                $data['eksport']="enabled";    
                
            }else{            
                $where2=array(
                    "DATE_FORMAT(ajuanprakerin.tglpengajuan,'%Y-%m-%d')"=>date('Y-m-d'),
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
                $data['tambah']="disabled";
                $data['eksport']="disabled";
            }
            

            $data['jur']=$this->input->post('kdjurusan');
            $data['prakerin']=$this->M_prakerin->get_all()->result();
            $data['jurusan'] = $this->M_jurusan->get_all()->result();

            $data['form_action'] = "page/prakerin/ajuanprakerin";
            $data['hapus_action'] = "page/prakerin/ajuanprakerin/hapusajuan/";
            $data['update_action'] = "page/prakerin/ajuanprakerin/";
            $data['eksport_action'] = "page/prakerin/eksportajuan/";
            $data['ajuan'] = $this->M_ajuan_prakerin->get_row_join($where2)->result();
            $data['perusahaan'] = $this->M_perusahaan->get_all()->result();

            $where2=array(
                "kelas.tingkat"=>$prakerin->tingkat,
                'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
            );
            $data['siswa2'] = $this->M_siswa->get_row_join5($where2)->result();
            $this->template->admin('page/view_ajuan_prakerin',$data);
        }
        
    }

    public function ajuanprakerinsiswa($act=NULL,$params=NULL){
        if($this->input->post('submit')=="eksport"){
            $this->eksportajuan();
        }else{
            $this->session->set_userdata(array('menu'=>'60','katmenu'=>'11'));
            if($act=="hapusajuan"){
                $this->hapusajuansiswa($params);
            }

            if($this->input->post('submit')){
                $where=array(
                    'setprakerin.idprakerin'=>$this->input->post('idprakerin')
                );
            }else{
                $where=array(
                    'setprakerin.status'=>1
                );       
            }
            $prakerin = $this->M_prakerin->get_row($where)->row();
            $data['idprakerin'] = $prakerin->idprakerin;
            if($this->input->post('submit')){
                $this->simpanajuan();
                $this->editajuan();

                $where2=array(
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
                $data['eksport']="disabled";  
                
            }else{            
                $where2=array(
                    //"DATE_FORMAT(ajuanprakerin.tglpengajuan,'%Y-%m-%d')"=>date('Y-m-d'),
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
                $data['eksport']="disabled";
            }
            

            $data['jur']=$this->input->post('kdjurusan');
            $data['prakerin']=$this->M_prakerin->get_all()->result();
            $data['jurusan'] = $this->M_jurusan->get_all()->result();

            $data['form_action'] = "page/prakerin/ajuanprakerinsiswa";
            $data['hapus_action'] = "page/prakerin/ajuanprakerinsiswa/hapusajuan/";
            $data['update_action'] = "page/prakerin/ajuanprakerinsiswa/";
            $data['eksport_action'] = "page/prakerin/eksportajuan/";
            $data['nisn']=$this->session->nisn;
            $data['ajuan'] = $this->M_ajuan_prakerin->get_row_join_siswa($where2,$data['nisn'])->result();
            $data['perusahaan'] = $this->M_perusahaan->get_all()->result();

            $where2=array(
                "kelas.tingkat"=>$prakerin->tingkat,
                'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
            );
            $data['siswa2'] = $this->M_siswa->get_row_join5($where2)->result();

            $where3=array(
                "kelas.tingkat"=>$prakerin->tingkat,
                'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
            );
            $data['ajuan2'] = $this->M_ajuan_prakerin->get_row_join($where3)->result();
            $this->template->admin('page/view_ajuan_prakerin_siswa',$data);
        }
        
    }

    public function siswaprakerin($act=NULL,$params=NULL){
        $this->session->set_userdata(array('menu'=>'45','katmenu'=>'11'));
        if($this->input->post('submit')){
            $where=array(
                'setprakerin.idprakerin'=>$this->input->post('idprakerin')
            );
        }else{
            $where=array(
                'setprakerin.status'=>1
            );       
        }
        
        $prakerin = $this->M_prakerin->get_row($where)->row();
        $data['idprakerin'] = $prakerin->idprakerin;

        $data['tahunajaran'] = $this->M_tahunajaran->get_all()->row();
        $data['form_action'] = "page/prakerin/siswaprakerin";
        $data['hapus_action'] = "page/prakerin/ajuanprakerin/hapusajuan/";
        $data['update_action'] = "page/prakerin/ajuanprakerin/";
        $data['eksport_action'] = "page/prakerin/eksport/";
        //$data['siswa'] = $this->M_group_prakerin->get_all_join($where)->result();
        $data['perusahaan'] = $this->M_perusahaan->get_all()->result();
        $data['jurusan'] = $this->M_jurusan->get_all()->result();
        if($this->input->post('submit')){
            
            if($act=="hapusajuan"){
                $this->hapusajuan($params);
            }
            if($this->input->post('submit')){
                $this->simpanajuan();
                $this->editajuan();
                $this->upload();
            }
            

            if($this->input->post('kdjurusan')=="semua"){
                $where2=array(
                    "kelas.tingkat"=>$prakerin->tingkat,
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
            }else{
                $where2=array(
                    'kelas.kdjurusan'=>$this->input->post('kdjurusan'),
                    "kelas.tingkat"=>$prakerin->tingkat,
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
            }

            
        }else{
            $where2=array(
                "kelas.tingkat"=>$prakerin->tingkat,
                'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
            );
        }

        $data['jur']=$this->input->post('kdjurusan');
        $data['prakerin']=$this->M_prakerin->get_all()->result();
        $data['siswa'] = $this->M_siswa->get_row_join_prakerin($where2)->result();
        
        $this->template->admin('page/view_siswa_prakerin',$data);
    }

    public function datamonitoring($act=NULL,$params=NULL,$params2=NULL){
        $this->session->set_userdata(array('menu'=>'46','katmenu'=>'11'));
        if($this->input->post('submit')){
            $where=array(
                'setprakerin.idprakerin'=>$this->input->post('idprakerin')
            );
        }else{
            $where=array(
                'setprakerin.status'=>1
            );       
        }
        
        $prakerin = $this->M_prakerin->get_row($where)->row();
        $data['idprakerin'] = $prakerin->idprakerin;

        if($this->input->post('submit')=="eksport"){
            $this->eksportmonitoring();
        }else{
            
            if($act=="hapuspembimbing"){
                $this->hapuspembimbing($params,$params2);
            }
            if($this->input->post('submit')){
                $this->simpanpembimbing();
                $this->editajuan();
                $this->upload();
                if($this->input->post('kdjurusan')=="semua"){
                    $where2=array(
                        'kelas.tingkat'=>$prakerin->tingkat,
                        'ajuanprakerin.status'=>4,
                        'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                    );
                }else{
                    $where2=array(
                        'kelas.kdjurusan'=>$this->input->post('kdjurusan'),
                        'kelas.tingkat'=>$prakerin->tingkat,
                        'ajuanprakerin.status'=>4,
                        'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                    );
                }
                
                $data['tambah']="enabled";
                $data['eksport']="enabled";
            }else{            
                $where2=array(
                    'kelas.tingkat'=>$prakerin->tingkat,
                    'ajuanprakerin.status'=>4,
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
                $data['tambah']="disabled";
                $data['eksport']="disabled";
            }
            
            $where=array(
                'settahunajaran.status'=>1
            );
            $data['jur']=$this->input->post('kdjurusan');
            $data['jurusan'] = $this->M_jurusan->get_all()->result();
            $tahun = $this->M_tahunajaran->get_row($where)->row();
            $data['tahun'] = $tahun->idtahunajaran;
            $data['form_action'] = "page/prakerin/datamonitoring";
            $data['hapus_action'] = "page/prakerin/datamonitoring/hapuspembimbing/";
            $data['update_action'] = "page/prakerin/datamonitoring/";
            $data['eksport_action'] = "page/prakerin/eksport/";
            $data['ajuan'] = $this->M_monitoring_prakerin->get_row_join($where2)->result();
            $data['guru'] = $this->M_guru->get_all()->result();
            $data['prakerin']=$this->M_prakerin->get_all()->result();
            $this->template->admin('page/view_datamonitoring_prakerin',$data);
        }
        
    }

    public function monitoring(){
        $this->session->set_userdata(array('menu'=>'47','katmenu'=>'11'));
        if($this->input->post('submit')){
            $this->simpanmonitoring();
        }
        if($this->input->post('submit')){
            $where4=array(
                'setprakerin.idprakerin'=>1
            );
        }else{
            $where4=array(
                'setprakerin.status'=>1
            );       
        }
        $prakerin = $this->M_prakerin->get_row($where4)->row();
        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'ajuanprakerin.status'=>3,
            'setprakerin.idprakerin'=>$prakerin->idprakerin,
            'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
        );
        
        $data['form_action'] = "page/prakerin/datamonitoring";
        $data['hapus_action'] = "page/prakerin/datamonitoring/hapuspembimbing/";
        $data['update_action'] = "page/prakerin/datamonitoring/";
        $data['eksport_action'] = "page/prakerin/eksport/";
        $data['ajuan'] = $this->M_monitoring_prakerin->get_row_join($where2)->result();
        $this->template->admin('page/view_monitoring_prakerin',$data);
    }

    public function lapormonitoring(){
        $this->session->set_userdata(array('menu'=>'48','katmenu'=>'11'));
        if($this->input->post('submit')){
            $where=array(
                'setprakerin.idprakerin'=>$this->input->post('idprakerin')
            );
        }else{
            $where=array(
                'setprakerin.status'=>1
            );       
        }
        
        $prakerin = $this->M_prakerin->get_row($where)->row();
        $data['idprakerin'] = $prakerin->idprakerin;
        
            if($this->input->post('submit')){
                if($this->input->post('kdjurusan')=="semua"){
                    $where2=array(
                        'ajuanprakerin.status'=>3,
                        'setprakerin.idprakerin'=>$prakerin->idprakerin,
                        'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                    );
                }else{
                    $where2=array(
                        'kelas.kdjurusan'=>$this->input->post('kdjurusan'),
                        'ajuanprakerin.status'=>3,
                        'setprakerin.idprakerin'=>$prakerin->idprakerin,
                        'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                    );
                }
                $data['ajuan'] = $this->M_monitoring_prakerin->get_row_join($where2)->result();
                $data['tambah']="enabled";
                $data['eksport']="enabled";
            }else{            
                $where2=array();
                $data['ajuan'] = array();
                $data['tambah']="disabled";
                $data['eksport']="disabled";
            }
        
        $data['form_action'] = "page/prakerin/lapormonitoring";
        $data['hapus_action'] = "page/prakerin/datamonitoring/hapuspembimbing/";
        $data['update_action'] = "page/prakerin/datamonitoring/";
        $data['eksport_action'] = "page/prakerin/eksport/";
        
        $data['prakerin']=$this->M_prakerin->get_all()->result();
        $data['jurusan']=$this->M_jurusan->get_all()->result();
        $data['jur']=$this->input->post('kdjurusan');
        $this->template->admin('page/view_lapormonitoring_prakerin',$data);
    }

    public function simpan(){

        if($this->input->post('submit')=='simpan'){
                $data=array(
                    "nmperusahaan"=>$this->input->post('nama'),
                    "pemilik"=>$this->input->post('pemilik'),                                  
                    "nohp"=>$this->input->post('nohp'),                                  
                    "kota"=>$this->input->post('kota'),                                  
                    "kelurahan"=>$this->input->post('kelurahan'),                                  
                    "kecamatan"=>$this->input->post('kecamatan'),                                  
                    "alamat"=>$this->input->post('alamat')                                  
                );
                $queri=$this->M_perusahaan->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
        }

    }

    public function simpanajuan(){
        if($this->input->post('submit')=='simpan'){
            
            $where=array(
                //"ajuanprakerin.idperusahaan"=>$this->input->post('idperusahaan'),
                "groupprakerin.nisn"=>$this->input->post('pengaju'),
            );

            $where0=array(
                "ajuanprakerin.idperusahaan"=>$this->input->post('idperusahaan'),
                "ajuanprakerin.idprakerin"=>$this->input->post('idprakerin'),
            );
            $queri=$this->M_ajuan_prakerin->get_row_join_groupprakerin($where0);
            if($queri->num_rows()<1){
                
                $kelompok=$this->input->post('kelompok');
                $queri=$this->M_ajuan_prakerin->get_row_join_groupprakerin($where);
                if($queri->num_rows()<1){
                    $data=array(
                        "idperusahaan"=>$this->input->post('idperusahaan'),
                        "tglpengajuan"=>date('Y-m-d',strtotime($this->input->post('tanggal')))." ".date('H:i:s'),
                        "nisn"=>$this->input->post('pengaju'),                                  
                        "idprakerin"=>$this->input->post('idprakerin'),
                        "status"=>$this->input->post('status'),
                                                    
                    );
                    $queri=$this->M_ajuan_prakerin->add($data);
                    if($queri==TRUE){
                        $where2=array(
                            "idperusahaan"=>$this->input->post('idperusahaan'),
                            "nisn"=>$this->input->post('pengaju'),
                        );
                        $ajuan=$this->M_ajuan_prakerin->get_row($where2)->row();
                        foreach ($kelompok as $key => $value) {
                            # code...
                            $where3=array(
                                "idpengajuan"=>$ajuan->idpengajuan,
                                "nisn"=>$value,
                            );
                            $group=$this->M_group_prakerin->get_row($where3);
                            if($group->num_rows() < 1){
                                $data=array(
                                    "idpengajuan"=>$ajuan->idpengajuan,
                                    "nisn"=>$value,
                                );
                                $this->M_group_prakerin->add($data);
                            }
                            
                        }

                        if(!in_array($this->input->post('pengaju'), $kelompok)){
                            $where3=array(
                                "idpengajuan"=>$ajuan->idpengajuan,
                                "nisn"=>$this->input->post('pengaju'),
                            );
                            $group=$this->M_group_prakerin->get_row($where3);
                            if($group->num_rows() < 1){
                                $data=array(
                                    "idpengajuan"=>$ajuan->idpengajuan,
                                    "nisn"=>$this->input->post('pengaju'),
                                );
                                $this->M_group_prakerin->add($data);
                            }
                        }
                        $this->session->set_flashdata('info',"Data berhasil disimpan");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal disimpan");
                    }
                }else{
                    $this->session->set_flashdata('info',"Siswa tersebut sudah melakukan pengajuan");
                }
            }else{
                $this->session->set_flashdata('info',"Perusahaan yang anda pilih sudah diajukan, silahkan cek di Data Ajuan Prakerin Semua Siswa");
            }
            
        }

    }

    public function simpanpembimbing(){
        if($this->input->post('submit')=='simpan'){
            $dudi=$this->input->post('dudi');
                    foreach ($dudi as $key => $value) {
                        # code...
                        $where3=array(
                            "idpengajuan"=>$value,
                            "kdguru"=>$this->input->post('kdguru'),
                        );
                        $group=$this->M_monitoring_prakerin->get_row($where3);
                        if($group->num_rows() < 1){
                            $data=array(
                                "idpengajuan"=>$value,
                                "kdguru"=>$this->input->post('kdguru'),
                            );
                            $queri=$this->M_monitoring_prakerin->add($data);
                        }else{
                            $d=$group->row();
                            $where=array(
                                'idmonitoringprakerin'=>$d->idmonitoringprakerin
                            );
                            $data=array(
                                "idpengajuan"=>$value,
                                "kdguru"=>$this->input->post('kdguru'),
                            );
                            $queri=$this->M_monitoring_prakerin->update($where,$data);
                        }
                        
                    }
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
        }

    }

    function simpanmonitoring(){
        if($this->input->post('submit')=="simpan"){
            $where3=array(
                "idpengajuan"=>$this->input->post('idpengajuan'),
                "kdguru"=>$this->input->post('kdguru'),
            );
            $group=$this->M_monitoring_prakerin->get_row($where3);
            if($group->num_rows() > 0){
                $d=$group->row();
                $where=array(
                    'idmonitoringprakerin'=>$d->idmonitoringprakerin
                );
                $data=array(
                    "deskripsi"=>$this->input->post('deskripsi'),
                    "tglmonitoring"=>$this->input->post('tglmonitoring'),
                    "tgllaporan"=>date('Y-m-d'),
                );
                $queri=$this->M_monitoring_prakerin->update($where,$data);
            }
        }
    }


    public function edit(){

        if($this->input->post('submit')=="edit"){
            $where=array(
                'idperusahaan'=>$this->input->post("idperusahaan")
            );
            $data=array(
                "nmperusahaan"=>$this->input->post('nama'),
                "pemilik"=>$this->input->post('pemilik'),                                  
                "nohp"=>$this->input->post('nohp'),                                  
                "kota"=>$this->input->post('kota'),                                  
                "kelurahan"=>$this->input->post('kelurahan'),                                  
                "kecamatan"=>$this->input->post('kecamatan'),                                  
                "alamat"=>$this->input->post('alamat')                                     
            );
            $queri=$this->M_perusahaan->update($where,$data);
            if($queri==TRUE){
                 $this->session->set_flashdata('info',"Data berhasil disimpan");
            }else{
                $this->session->set_flashdata('info',"Data gagal disimpan");
            }
        }

    }

    public function editajuan(){
        if($this->input->post('submit')=='edit'){
            $kelompok=$this->input->post('kelompok');

                $data=array(
                    "idperusahaan"=>$this->input->post('idperusahaan'),
                    "nisn"=>$this->input->post('pengaju'),                                  
                    "idprakerin"=>$this->input->post('idprakerin'),                                
                    "status"=>$this->input->post('status'),   
                    "ket"=>$this->input->post('ket')                               
                );
                $where1=array(
                    "idpengajuan"=>$this->input->post('idpengajuan')
                );
                $queri=$this->M_ajuan_prakerin->update($where1,$data);
                $this->M_group_prakerin->delete($where1);
                    
                        foreach ($kelompok as $key => $value) {
                            # code...
                            $where3=array(
                                //"idpengajuan"=>$this->input->post('idpengajuan'),
                                "nisn"=>$value,
                            );
                            $group=$this->M_group_prakerin->get_row($where3);
                            if($group->num_rows() < 1){
                                $data=array(
                                    "idpengajuan"=>$this->input->post('idpengajuan'),
                                    "nisn"=>$value,
                                );
                                $queri2=$this->M_group_prakerin->add($data);
                            }
                            
                        }

                        if(!in_array($this->input->post('pengaju'), $kelompok)){
                            $where3=array(
                                "idpengajuan"=>$this->input->post('idpengajuan'),
                                "nisn"=>$this->input->post('pengaju'),
                            );
                            $group=$this->M_group_prakerin->get_row($where3);
                            if($group->num_rows() < 1){
                                $data=array(
                                    "idpengajuan"=>$this->input->post('idpengajuan'),
                                    "nisn"=>$this->input->post('pengaju'),
                                );
                                $queri2=$this->M_group_prakerin->add($data);
                            }
                        }
                if($queri2==TRUE){  
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
           
        }

    }



    
    public function hapus($id=NULL){
        $where=array(
            'idperusahaan'=>$id
        );
        $queri=$this->M_perusahaan->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }  
        redirect('page/prakerin/perusahaan');
    }

    public function hapusajuan($id=NULL){
        $where=array(
            'idpengajuan'=>$id
        );
        $queri=$this->M_group_prakerin->delete($where);        
        if($queri==TRUE){
            $queri=$this->M_ajuan_prakerin->delete($where);
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }  
        redirect('page/prakerin/ajuanprakerin');
    }

    public function hapusajuansiswa($id=NULL){
        $where=array(
            'idpengajuan'=>$id
        );
        $queri=$this->M_group_prakerin->delete($where);        
        if($queri==TRUE){
            $queri=$this->M_ajuan_prakerin->delete($where);
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }  
        redirect('page/prakerin/ajuanprakerinsiswa');
    }

    public function hapuspembimbing($id=NULL,$kd=NULL){
        $where=array(
            'idpengajuan'=>$id,
            'kdguru'=>$kd
        );
        $queri=$this->M_monitoring_prakerin->delete($where);        
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }  
        redirect('page/prakerin/datamonitoring');
    }

    public function cetakajuan($id=NULL){
        $where = array(
            'groupprakerin.idpengajuan'=>$id,
            'settahunajaran.status'=>1
        );
        $where2 = array(
            'ajuanprakerin.idpengajuan'=>$id
        );
        $data['siswa']=$this->M_group_prakerin->get_row_join2($where)->result();
        $data['jmlsiswa']=$this->M_group_prakerin->get_row_join2($where)->num_rows();
        $data['ajuan'] = $this->M_ajuan_prakerin->get_row_join($where2)->row();
      
        $this->load->view('page/view_cetak_surat_ajuan',$data);
    }

    public function eksportperusahaan(){
        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Perusahaan Prakerin")
             ->setSubject("Prakerin")
             ->setDescription("Laporan Data Perusahaan Prakerin")
             ->setKeywords("Data Perusahaan Prakerin");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PERUSAHAAN PRAKERIN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA DUDI"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "PEMILIK");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NO HANDPHONE");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KOTA/KAB");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "KEL/DESA");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "ALAMAT");


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);



        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        $perusahaan = $this->M_perusahaan->get_all()->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($perusahaan as $row){ // Ambil semua data dari hasil eksekusi $sql
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);

          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow,  $row->nmperusahaan);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow,  $row->pemilik);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow,  $row->nohp);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->kota);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->kelurahan);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $row->kecamatan);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow,  $row->alamat);

          // Khusus untuk no telepon. kita set type kolom nya jadi STRING

          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

            $c=$numrow;
            $excel->getActiveSheet()->getStyle('A'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$c)->applyFromArray($style_row);          
            $excel->getActiveSheet()->getStyle('D'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$c)->applyFromArray($style_row);

          $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
          
          $numrow++;
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);



        // Set orientasi kertas jadi LANDSCAPE
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Perusahaan Pakerin.xlsx"');
        $objWriter->save('php://output');
    }

    public function eksportsiswaprakerin(){
        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Siswa Prakerin")
             ->setSubject("Prakerin")
             ->setDescription("Laporan Data Siswa Prakerin")
             ->setKeywords("Data Siswa Prakerin");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA PRAKERIN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NISN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA SISWA");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "KELAS");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "NAMA DU/DI");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "KOTA/KABUPATEN");


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);



        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        $perusahaan = $this->M_perusahaan->get_all()->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($perusahaan as $row){ // Ambil semua data dari hasil eksekusi $sql
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);

          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow,  $row->nmperusahaan);
          $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow,  $row->pemilik);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow,  $row->nohp);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->kota);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->kelurahan);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $row->kecamatan);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow,  $row->alamat);

          // Khusus untuk no telepon. kita set type kolom nya jadi STRING

          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)

            $c=$numrow;
            $excel->getActiveSheet()->getStyle('A'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$c)->applyFromArray($style_row);          
            $excel->getActiveSheet()->getStyle('D'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$c)->applyFromArray($style_row);

          $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
          
          $numrow++;
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);



        // Set orientasi kertas jadi LANDSCAPE
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Perusahaan Pakerin.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }
   
    public function eksportajuan(){
        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Ajuan Prakerin")
             ->setSubject("Prakerin")
             ->setDescription("Laporan Data Ajuan Prakerin")
             ->setKeywords("Data Ajuan Prakerin");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA AJUAN PRAKERIN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NISN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA SISWA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "KELAS");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "PERUSAHAAN");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "KOTA/KAB");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "KEL/DESA");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "ALAMAT");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "STATUS PENGAJUAN");


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);


        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        if($this->input->post('submit')){
            $where2=array(
                'setprakerin.idprakerin'=>$this->input->post('idprakerin')
            );
        }else{
            $where2=array(
                'setprakerin.status'=>1
            );       
        }
        
        $prakerin = $this->M_prakerin->get_row($where2)->row();
        if($this->input->post('kdjurusan')=="semua"){
                $where=array(
                    "kelas.tingkat"=>$prakerin->tingkat,
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
            }else{
                $where=array(
                    'kelas.kdjurusan'=>$this->input->post('kdjurusan'),
                    "kelas.tingkat"=>$prakerin->tingkat,
                    'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
                );
            }
        $ajuan = $this->M_ajuan_prakerin->get_row_join2($where)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($ajuan as $row){ // Ambil semua data dari hasil eksekusi $sql
          $siswa=$this->M_group_prakerin->get_row_join(array('groupprakerin.idpengajuan'=>$row->idpengajuan,'settahunajaran.status'=>1));
            
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);

          foreach ($siswa->result() as $key => $v) {  
            $c=$numrow+$key;
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$c, $v->nisn);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$c, $v->nama);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('D'.$c, $v->kdkelas);
          }
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->nmperusahaan);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->kota);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $row->kelurahan);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow,  $row->kecamatan);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow,  $row->alamat);
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow,  $row->status);
          $r1=$numrow;
          $r2=$numrow+$key;
          $excel->getActiveSheet()->mergeCells('A'.$r1.':A'.$r2);
          $excel->getActiveSheet()->mergeCells('E'.$r1.':E'.$r2);
          $excel->getActiveSheet()->mergeCells('F'.$r1.':F'.$r2);
          $excel->getActiveSheet()->mergeCells('G'.$r1.':G'.$r2);
          $excel->getActiveSheet()->mergeCells('H'.$r1.':H'.$r2);
          $excel->getActiveSheet()->mergeCells('I'.$r1.':I'.$r2);
          $excel->getActiveSheet()->mergeCells('J'.$r1.':J'.$r2);

          
          // Khusus untuk no telepon. kita set type kolom nya jadi STRING

          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
         
          foreach ($siswa->result() as $key => $v) {  
            $c=$numrow+$key;
            $excel->getActiveSheet()->getStyle('A'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$c)->applyFromArray($style_row);          
            $excel->getActiveSheet()->getStyle('D'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$c)->applyFromArray($style_row);
          }


          
          
          $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
          
          $no++; // Tambah 1 setiap kali looping
          $numrow=$numrow+$key+1; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);


        // Set orientasi kertas jadi LANDSCAPE
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Ajuan Pakerin.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
    }

    public function eksportmonitoring(){
        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Pembimbing Prakerin")
             ->setSubject("Prakerin")
             ->setDescription("Laporan Data Pembimbing Prakerin")
             ->setKeywords("Data Pembimbing Prakerin");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
          'font' => array('bold' => true), // Set font nya jadi bold
          'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
          'alignment' => array(
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
          ),
          'borders' => array(
            'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
            'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
            'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
            'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
          )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA PEMBIMBING PRAKERIN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NAMA PEMBIMBING"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NISN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA SISWA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KELAS");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "PERUSAHAAN");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "KOTA/KAB");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "KEL/DESA");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "KECAMATAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "ALAMAT");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "STATUS PENGAJUAN");


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);


        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        if($this->input->post('submit')){
            $where=array(
                'setprakerin.idprakerin'=>$this->input->post('idprakerin')
            );
        }else{
            $where=array(
                'setprakerin.status'=>1
            );       
        }
        $prakerin = $this->M_prakerin->get_row($where)->row();

        if($this->input->post('kdjurusan')=="semua"){
            $where2=array(
                'kelas.tingkat'=>$prakerin->tingkat,
                'ajuanprakerin.status'=>3,
                'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
            );
        }else{
            $where2=array(
                'kelas.kdjurusan'=>$this->input->post('kdjurusan'),
                'kelas.tingkat'=>$prakerin->tingkat,
                'ajuanprakerin.status'=>3,
                'settahunajaran.idtahunajaran'=>$prakerin->idtahunajaran
            );
        }
        $ajuan = $this->M_monitoring_prakerin->get_row_join3($where2)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($ajuan as $row){ // Ambil semua data dari hasil eksekusi $sql
          $siswa=$this->M_group_prakerin->get_row_join(array('groupprakerin.idpengajuan'=>$row->idpengajuan,'settahunajaran.status'=>1));
            
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row->nmguru);

          foreach ($siswa->result() as $key => $v) {  
            $c=$numrow+$key;
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$c, $v->nisn);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('D'.$c, $v->nama);
            $excel->setActiveSheetIndex(0)->setCellValueExplicit('E'.$c, $v->kdkelas);
          }
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->nmperusahaan);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $row->kota);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow,  $row->kelurahan);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow,  $row->kecamatan);
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow,  $row->alamat);
          $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow,  $row->status);
          $r1=$numrow;
          $r2=$numrow+$key;
          $excel->getActiveSheet()->mergeCells('A'.$r1.':A'.$r2);
          $excel->getActiveSheet()->mergeCells('B'.$r1.':B'.$r2);
          $excel->getActiveSheet()->mergeCells('F'.$r1.':F'.$r2);
          $excel->getActiveSheet()->mergeCells('G'.$r1.':G'.$r2);
          $excel->getActiveSheet()->mergeCells('H'.$r1.':H'.$r2);
          $excel->getActiveSheet()->mergeCells('I'.$r1.':I'.$r2);
          $excel->getActiveSheet()->mergeCells('J'.$r1.':J'.$r2);
          $excel->getActiveSheet()->mergeCells('K'.$r1.':K'.$r2);

          
          // Khusus untuk no telepon. kita set type kolom nya jadi STRING

          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
         
          foreach ($siswa->result() as $key => $v) {  
            $c=$numrow+$key;
            $excel->getActiveSheet()->getStyle('A'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('B'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('C'.$c)->applyFromArray($style_row);          
            $excel->getActiveSheet()->getStyle('D'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('E'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('F'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('G'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('H'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('I'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('J'.$c)->applyFromArray($style_row);
            $excel->getActiveSheet()->getStyle('K'.$c)->applyFromArray($style_row);
          }


          
          
          $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
          
          $no++; // Tambah 1 setiap kali looping
          $numrow=$numrow+$key+1; // Tambah 1 setiap kali looping
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(25); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $excel->getActiveSheet()->getColumnDimension('E')->setWidth(25); // Set width kolom E
        $excel->getActiveSheet()->getColumnDimension('F')->setWidth(25); // Set width kolom F
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
        $excel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        $excel->getActiveSheet()->getColumnDimension('K')->setWidth(20);


        // Set orientasi kertas jadi LANDSCAPE
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Pembimbing Pakerin.xlsx"');
        $objWriter->save('php://output');
    }

    public function upload()
    {
        if($this->input->post('submit')=="import"){
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel.php';

        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            //upload gagal
            $this->session->set_flashdata('info', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
            //redirect halaman
            redirect('page/prakerin/perusahaan');

        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

            $data = array();

            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 1){

                    $data=array(
                        "nmperusahaan"=>$row['B'],
                        "pemilik"=>$row['C'],                                  
                        "nohp"=>$row['D'],                                  
                        "kota"=>$row['E'],                                  
                        "kelurahan"=>$row['F'],                                  
                        "kecamatan"=>$row['G'],                                  
                        "alamat"=>$row['H']
                    );

                    $where=array(
                        "nmperusahaan"=>$row['B'],
                    );  
                    $query = $this->M_perusahaan->get_row($where)->num_rows();
                    if($query<1){
                        $queri=$this->M_perusahaan->add($data); 
                    }else{
                        $queri=$this->M_perusahaan->update($where,$data); 
                    }
                        
                    
                }
                $numrow++;
            }
            //delete file from server
            unlink(realpath('excel/'.$data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('info', '<b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!');
            //redirect halaman
            //redirect('page/karyawan');

        }
    }
    }

    

}