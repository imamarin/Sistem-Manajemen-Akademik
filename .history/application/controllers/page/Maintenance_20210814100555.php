<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('template','form_validation'));
		$this->load->helper('url');
		$this->session->set_userdata(array('menu'=>'28','katmenu'=>'8'));
	}
	
	public function index()
	{
		if($this->session->iduser){
			$q=$this->M_siswa->get_all();
			if($q->num_rows()>0){
				$data['countSiswa']=$q->num_rows();
			}else{
				$data['countSiswa']=0;
			}
			$this->template->admin('page/view_home',$data);
		}else{
			$this->load->view('v_login2');
		}
		
	}

	function logout(){
        $this->session->sess_destroy();
        redirect('page/login');
    }

    function logmasuk(){
    	$this->load->view('guru/view_log_masuk');
    }
    function logmasukchat(){
    	$this->load->view('guru/view_log_masuk_chat');
    }
	

}

