<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class profil extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'4','katmenu'=>'2'));
    }
    
    public function index(){
      if($this->session->profil=="guru"){
        $this->guru();
      }else if($this->session->profil=="karyawan"){
        $this->karyawan();
      }else if($this->session->profil=="siswa"){
        $this->siswa();
      }else{
        echo $this->session->profil;
      }
    }

    public function guru(){
        $where=array(
            'user.iduser'=>$this->session->iduser,
        );
        $query = $this->M_guru->get_row2($where)->num_rows();
        if($query>0){
            $row = $this->M_guru->get_row2($where)->row();
            $data=array(
                "kdguru"=>$row->kdguru,
                "nuptk"=>$row->nuptk,
                "nip"=>$row->nip,
                "nama"=>$row->nama,
                "jk"=>$row->jk,
                "tmplahir"=>$row->tmp_lahir,
                "tgllahir"=>$row->tgl_lahir,
                "alamat"=>$row->alamat,
                "nohp"=>$row->no_hp,
                "status"=>$row->status,
            );
            
            $data['namaprofil']=$row->nama;
            $where=array(
                "iduser"=>$row->iduser,
            );

            $query = $this->M_user->get_row($where)->num_rows();
            if($query>0){
                $row = $this->M_user->get_row($where)->row();
                $data["username"]=$row->username;
                $data["password"]=$row->password;
                $data["lvl"]=$row->idlevel;         
            }
            $data['level'] = $this->M_level->get_all()->result();
            $data['tidakaktif']="readonly";
            $data['form_action']='page/guru/update/profil';

            $this->template->admin('page/view_add_guru',$data);
          }else{
            redirect('login/out/');
          }
    } 

    public function karyawan(){
        $where=array(
            'user.iduser'=>$this->session->iduser,
        );
        $query = $this->M_karyawan->get_row2($where)->num_rows();
        if($query>0){
            $row = $this->M_karyawan->get_row2($where)->row();
            $data=array(
                "kdkaryawan"=>$row->kdkaryawan,
                "nik"=>$row->nik,
                "nama"=>$row->nama,
                "jk"=>$row->jk,
                "tmplahir"=>$row->tmp_lahir,
                "tgllahir"=>$row->tgl_lahir,
                "alamat"=>$row->alamat,
                "nohp"=>$row->no_hp,
                "status"=>$row->status,
            );
            
            $data['namaprofil']=$row->nama;
            $where=array(
                "iduser"=>$row->iduser,
            );

            $query = $this->M_user->get_row($where)->num_rows();
            if($query>0){
                $row = $this->M_user->get_row($where)->row();
                $data["username"]=$row->username;
                $data["password"]=$row->password;
                $data["lvl"]=$row->idlevel;         
            }
            $data['level'] = $this->M_level->get_all()->result();
            $data['tidakaktif']="readonly";
            $data['form_action']='page/karyawan/update/profil';

            $this->template->admin('page/view_add_karyawan',$data);
          }else{
            redirect('login/out/');
          }
    }

    public function siswa(){
        $where=array(
            'user.iduser'=>$this->session->iduser,
        );
        $query = $this->M_siswa->get_row2($where)->num_rows();
        if($query>0){
            $row = $this->M_siswa->get_row2($where)->row();
            $data=array(
              "nisn"=>$row->nisn,
              "nis"=>$row->nis,
              "nik"=>$row->nik,
              "nama"=>$row->nama,
              "jk"=>$row->jk,
              "tmplahir"=>$row->tmp_lahir,
              "tgllahir"=>$row->tgl_lahir,
              "asalsekolah"=>$row->asal_sekolah,
              "alamatsiswa"=>$row->alamat_siswa,
              "hpsiswa"=>$row->hp_siswa,
              "tglterima"=>$row->tgl_terima,
              "kdkelas"=>$row->kdkelas,
              "idtahunajaran"=>$row->idtahunajaran,
              "nmayah"=>$row->nm_ayah,
              "nmibu"=>$row->nm_ibu,
              "pekayah"=>$row->pek_ayah,
              "pekibu"=>$row->pek_ibu,
              "alamatorangtua"=>$row->alamat_orangtua,
              "hporangtua"=>$row->hp_orangtua,
              "status"=>$row->status,
              "agama"=>$row->agama,
              "anakke"=>$row->anakke,
              "walisiswa"=>$row->walisiswa,
              "pekwali"=>$row->pekwali,
              "alamatwali"=>$row->alamatwali,
              "nohpwali"=>$row->nohpwali,
            );
            
            $data['namaprofil']=$row->nama;

            $where=array(
                "iduser"=>$row->iduser,
            );

            $query = $this->M_user->get_row($where)->num_rows();
            if($query>0){
                $row = $this->M_user->get_row($where)->row();
                $data["username"]=$row->username;
                $data["password"]=$row->password;
                $data["lvl"]=$row->idlevel;         
            }
            $data['level'] = $this->M_level->get_all()->result();
            $data['tidakaktif']="readonly";
            $data['form_action']='page/siswa/update/profil';
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['aksi'] = "simpan";
            $this->template->admin('page/view_add_siswa',$data);
          }else{
            redirect('login/out/');
          }
    }

    public function update($n=NULL)
    {
      $this->validasi_form();
      if ($this->form_validation->run()==TRUE){
        //configurasi upload Gambar
        $config['upload_path'] = './assets/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['file_name'] = 'gambar'.time();

        $this->load->library('upload',$config);
        $data=array(
              'nama' => $this->input->post('nama'),
        );
        $data2=array(
          'password' => sha1($this->input->post('password')),
        );
        $password=$this->input->post('password');

          $this->M_guru->update2(array('iduser'=>$n),$data);
          if(!empty($password)){
            $this->M_user->update(array('iduser'=>$n),$data2);
          }
          $this->session->set_flashdata('pesan',"<div class='alert alert-success alert-message'>Data Berhasil Dirubah</div>");
          redirect('guru/profil');
      }else{
        $data=array(
          "form_action"=>"guru/update/".$n,
          'nama' => set_value('nama'),
          'password' => set_value('password'),
        );
        $this->template->display('guru/profil',$data);
      }
      
      
    }

    public function validasi_form(){
      $this->form_validation->set_rules('nama','NAMA GURU','required');
    }

}