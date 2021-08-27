<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class notif extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'6','katmenu'=>'1'));

    }
    

    public function index(){
        $this->load->view('page/view_notif_jadwal');
    }
   
}