<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekapnilai extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'53','katmenu'=>'12'));
        if(empty($this->session->idraport)){
            redirect('page/raport/aktivasi');
        }
    }
    

    public function index(){
        $where=array(
            'walikelas.kdguru'=>$this->session->kdguru,
            'walikelas.kdkelas'=>$this->input->post('kdkelas'),
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
            'matpelkelas.semester'=>$this->session->semesterraport
        );

        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.idtahunajaran'=>$this->session->idtahunraport,
        );

        $data['kelas'] = $this->M_walikelas->get_row($where2)->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        if($this->input->post('submit')){
            $data['matpelkelas'] = $this->M_matpelkelas->get_row_join_rekap($where,$this->session->semesterraport)->result();   
            $data['kdkelas'] = $this->M_kelas->get_all()->result();
            $data['matpel'] = $this->M_matpel->get_all()->result();
            $data['guru'] = $this->M_guru->get_all()->result();
        }else{
            $data['matpelkelas'] = array();
            $data['kdkelas'] = array();
            $data['matpel'] = array();
            $data['guru'] = array();
        }
        $data['form_action']='page/raport/rekapnilai/';
        $data['kls']=$this->input->post('kdkelas');
        //echo $this->M_matpelguru->get_row_join($where)->num_rows();
        $this->template->admin('page/raport/view_rekap_nilai',$data);
    }

    public function simpan(){

        if($this->input->post('submit')){

            $data=array(
                "kdguru"=>$this->input->post('kdguru'),
                "kdmatpel"=>$this->input->post('kdmatpel'),
                "kdkelas"=>$this->input->post('kelas'),
                "semester"=>$this->input->post('semester'),
                "idtahunajaran"=>$this->input->post('tahun'),                               
                "kkm"=>$this->input->post('kkm'),                               
                "bobotpengetahuan"=>$this->input->post('bp'),                               
                "bobotketerampilan"=>$this->input->post('bk')                               
            );

            $where = array(
                "kdguru"=>$this->input->post('kdguru'),
                "kdmatpel"=>$this->input->post('kdmatpel'),
                "kdkelas"=>$this->input->post('kelas'),
                "semester"=>$this->input->post('semester'),
                "idtahunajaran"=>$this->input->post('tahun'),
            );

            $q=$this->M_nilairaport->get_row($where);
            if($q->num_rows()<1){
                $queri=$this->M_nilairaport->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
            }else{
                $this->session->set_flashdata('info',"Data sudah ada");
            }
            

            redirect('page/raport/rekapnilai');
        }else{
            redirect('page/home');
        }
    }

    public function detail(){
        if($this->input->post('eksport')){
            $this->eksport();
        }else{
            if($this->input->post('input') || $this->input->post('submit') || $this->input->post('import')){

                $this->upload();
                $this->simpan2();
                
                $where=array(
                    'siswakelas.kdkelas'=>$this->input->post('h_kdkelas'),
                    'siswakelas.idtahunajaran'=>$this->input->post('h_tahun'),
                    'siswa.status'=>1
                );

                $data['siswa'] = $this->M_siswa->get_row_join_nilai_raport($where,$this->input->post('h_idnilairaport'))->result();


                $where2=array(
                    'idtahunajaran'=>$this->input->post('h_tahun')
                );

                $where3=array(
                    'kdmatpel'=>$this->input->post('h_kdmatpel')
                );

                $row=$this->M_tahunajaran->get_row($where2)->row();
                $row2=$this->M_matpel->get_row($where3)->row();

            
                $data['tahun']=$row->tahun;
                $data['idtahunajaran']=$this->input->post('h_tahun');
                $data['kdkelas']=$this->input->post('h_kdkelas');
                $data['idnilairaport']=$this->input->post('h_idnilairaport');
                $data['semester']=$this->session->semesterraport;
                $data['matpel']=$row2->matpel;
                $data['kdmatpel']=$row2->kdmatpel;
                $data['walikelas']=1;
                $data['form_action'] = "page/raport/rekapnilai/detail";
                $this->template->admin('page/raport/view_nilai_raport',$data);
            }else{
                redirect('page/raport/rekapnilai');
            }
        }
    }

    public function simpan2(){

        if($this->input->post('submit')=='simpan'){

            $nisn=$this->input->post('nisn');
            $nilai_p=$this->input->post('nilai_p');
            $nilai_k=$this->input->post('nilai_k');
            $h=0;
            foreach ($nisn as $key => $value) {
                $data=array(
                    "nisn"=>$value,
                    "pengetahuan"=>$nilai_p[$key],
                    "keterampilan"=>$nilai_k[$key],
                    "idnilairaport"=>$this->input->post('h_idnilairaport')
                );

                $where=array(
                    "nisn"=>$value,
                    "idnilairaport"=>$this->input->post('h_idnilairaport'),
                );  

                $query = $this->M_detail_nilai_raport->get_row($where)->num_rows();
                if($query<1){
                    $queri=$this->M_detail_nilai_raport->add($data); 
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data berhasil disimpan1");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal disimpan2");
                    }
                }else{
                    $queri2=$this->M_detail_nilai_raport->update($where,$data); 
                    if($queri2==TRUE){
                        $this->session->set_flashdata('info',$queri2);
                    }else{
                        $this->session->set_flashdata('info',$queri2);
                    }
                }
            }
            
        }

    }

    public function eksport(){
        if($this->input->post("eksport")){
            include APPPATH.'third_party/PHPExcel.php';
            $excel = new PHPExcel();
            $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data Nilai Raport")
                 ->setSubject("Data Nilai Raport")
                 ->setDescription("Laporan Nilai Raport")
                 ->setKeywords("Data Nilai Raport");
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


            // Buat header tabel nya pada baris ke 3
            $excel->setActiveSheetIndex(0)->setCellValue('A1', "NO"); 
            $excel->setActiveSheetIndex(0)->setCellValue('B1', "NISN"); 
            $excel->setActiveSheetIndex(0)->setCellValue('C1', "NAMA SISWA");
            $excel->setActiveSheetIndex(0)->setCellValue('D1', "JK");
            $excel->setActiveSheetIndex(0)->setCellValue('E1', "NILAI PENGETAHUAN");
            $excel->setActiveSheetIndex(0)->setCellValue('F1', "NILAI KETERAMPILAN");

            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('F1')->applyFromArray($style_col);

            // Set height baris ke 1, 2 dan 3
            $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            // Buat query untuk menampilkan semua data siswa
            $where=array(
                    'siswakelas.kdkelas'=>$this->input->post('h_kdkelas'),
                    'siswakelas.idtahunajaran'=>$this->input->post('h_tahun'),
                    'siswa.status'=>1
                );

            $siswa = $this->M_siswa->get_row_join_nilai_raport($where,$this->input->post('h_idnilairaport'))->result();
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
            foreach($siswa as $row){ // Ambil semua data dari hasil eksekusi $sql
              $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->nisn);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row->nama);
              $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow,  $row->jk);
              $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->pengetahuan);
              $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->keterampilan);


              
              // Khusus untuk no telepon. kita set type kolom nya jadi STRING

              
              // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
              $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);


              
              
              $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
              
              $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
            // Set width kolom
            $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
            $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
            $excel->getActiveSheet()->getColumnDimension('C')->setWidth(15); // Set width kolom C
            $excel->getActiveSheet()->getColumnDimension('D')->setWidth(25); // Set width kolom D
            $excel->getActiveSheet()->getColumnDimension('E')->setWidth(15); // Set width kolom E
            $excel->getActiveSheet()->getColumnDimension('F')->setWidth(15); // Set width kolom F


            // Set orientasi kertas jadi LANDSCAPE
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            ob_end_clean();
            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Data Nilai Raport.xlsx"');
            $objWriter->save('php://output');
        }
    }

    public function upload()
    {
        if($this->input->post("import")){
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
            redirect('page/raport/nilairaport/input');

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
                        "nisn"=>$row['B'],
                        "pengetahuan"=>(empty($row['E']))?"0":$row['E'],
                        "keterampilan"=>(empty($row['F']))?"0":$row['F'],
                        "idnilairaport"=>$this->input->post('h_idnilairaport')
                    );

                    $where=array(
                        "nisn"=>$row['B'],
                        "idnilairaport"=>$this->input->post('h_idnilairaport'),
                    );  
                    $query = $this->M_detail_nilai_raport->get_row($where)->num_rows();
                    if($query<1){
                        $queri=$this->M_detail_nilai_raport->add($data); 
                    }else{
                        $queri=$this->M_detail_nilai_raport->update($where,$data); 
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