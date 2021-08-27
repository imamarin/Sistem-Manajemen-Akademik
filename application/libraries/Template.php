<?php
class Template{
    protected $_ci;
    function __construct(){
        $this->_ci=&get_instance();
    }

    function admin($template,$data=NULL){
        $data['_content']=$this->_ci->load->view($template, $data, true);
        $this->_ci->load->view('page/template.php',$data);
    }

    function siswa($template,$data=NULL){
        $data['_content']=$this->_ci->load->view($template, $data, true);
        $this->_ci->load->view('siswa/template.php',$data);
    }

}