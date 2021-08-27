<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fingerprint extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('template','form_validation'));
		$this->load->helper('url');
		$this->session->set_userdata(array('menu'=>'28','katmenu'=>'8'));
	}
	
	public function index()
	{
		if($this->session->iduser){
			
			$this->load->view('page/view_finger');
		}else{
			$this->load->view('v_login2');
		}
		
	}

}

