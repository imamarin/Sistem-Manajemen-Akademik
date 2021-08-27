<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fingerprint extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('template','form_validation'));
		$this->load->helper('url');
		// $this->session->set_userdata(array('menu'=>'28','katmenu'=>'8'));
	}
	
	public function index()
	{
		$IP  = "192.168.1.206";
		$Key = "141286";

		$Connect = fsockopen($IP, "80", $errno, $errstr, 1);
		if ($Connect) {
			$soap_request = "<GetAttLog>
				<ArgComKey xsi:type=\"xsd:integer\">".$Key."</ArgComKey>
				<Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg>
			</GetAttLog>";

			$newLine = "\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer = "";
			while($Response = fgets($Connect, 1024)) {
				$buffer = $buffer.$Response;
			}
			echo "Berhasil";
		} else echo "Koneksi Gagal";

		$buffer = $this->Parse_Data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
		$buffer = explode("\r\n",$buffer);
		print_r($buffer);
		for ($a=0; $a<count($buffer); $a++) {
		$data=$this->Parse_Data($buffer[$a],"<Row>","</Row>");

		$export[$a]['pin'] = $this->Parse_Data($data,"<PIN>","</PIN>");
		$export[$a]['waktu'] = $this->Parse_Data($data,"<DateTime>","</DateTime>");
		$export[$a]['status'] = $this->Parse_Data($data,"<Status>","</Status>");
		}

		echo '<pre>';
		// print_r($export);


		// if($this->session->iduser){
			
		// 	$this->load->view('page/view_finger');
		// }else{
		// 	$this->load->view('v_login2');
		// }
		
	}	

	public function Parse_Data($data,$p1,$p2) {
		$data = " ".$data;
		$hasil = "";
		$awal = strpos($data,$p1);
		if ($awal != "") {
		$akhir = strpos(strstr($data,$p1),$p2);
		if ($akhir != ""){
			$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
		}
		}
		return $hasil;    
	}

}

