<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekapabsensiharian extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        if($this->session->profil=="guru"){
            $this->session->set_userdata(array('menu'=>'37','katmenu'=>'9'));
        }else{
            $this->session->set_userdata(array('menu'=>'37','katmenu'=>'7'));
        }
    }
    

    public function index(){
       $where=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.status'=>1
        );
       $where2=array(
            'settahunajaran.status'=>1
        );
        $walikelas=$this->M_walikelas->get_row($where);
        if($walikelas->num_rows()>0){
            $data['siswa'] = array();
            $data['tahun'] = $this->M_tahunajaran->get_row($where2)->row();
            $data['kelas']= $walikelas->result();
            $data['form_action']='page/rekapabsensiharian/tampil';
            $this->template->admin('page/view_rekap_absensi_harian',$data);
        }else{
            redirect('page/home');
        }
    }

    
    public function tampil(){
        if($this->input->post('tampil')){
            $where=array(
                'guru.kdguru'=>$this->session->kdguru,
                'settahunajaran.status'=>1
            );
            $where1=array(
                'settahunajaran.status'=>1
            );
            $walikelas=$this->M_walikelas->get_row($where);
            if($walikelas->num_rows()>0){
                $where2=array(
                    'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                    'siswakelas.idtahunajaran'=>$this->input->post('tahun')
                );
                $data['siswa'] = $this->M_siswa->get_row_join_count_absenharian($where2,$this->input->post('semester'))->result();
                $data['tahun'] = $this->M_tahunajaran->get_row($where1)->row();
                $data['kelas']= $walikelas->result();
                $data['kls'] = $this->input->post('kdkelas');
                $data['semester'] = $this->input->post('semester');
                $data['form_action']='page/rekapabsensiharian/tampil';
                $this->template->admin('page/view_rekap_absensi_harian',$data);
            }else{
                redirect('page/rekapabsensiharian');
            }
        }else{
             redirect('page/rekapabsensiharian');
        }
        
    }

    public function cetak(){
        if($this->input->post('kdkelas')){
            $where=array(
                'guru.kdguru'=>$this->session->kdguru,
                'settahunajaran.status'=>1
            );
            $where1=array(
                'settahunajaran.status'=>1
            );
            $walikelas=$this->M_walikelas->get_row($where);
            if($walikelas->num_rows()>0){
                $where2=array(
                    'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                    'siswakelas.idtahunajaran'=>$this->input->post('tahun')
                );
                $data['siswa'] = $this->M_siswa->get_row_join_count_absenharian($where2,$this->input->post('semester'))->result();
                $data['tahun'] = $this->M_tahunajaran->get_row($where1)->row();
                $data['walikelas']= $walikelas->result();
                $data['kls'] = $this->input->post('kdkelas');
                $data['form_action']='page/rekapabsensiharian/tampil';
                $this->load->view('page/view_cetak_rekap_absensi_harian',$data);
            }else{
                redirect('page/rekapabsensiharian');
            }
        }else{
             redirect('page/rekapabsensiharian');
        }
        
    }

    public function excel(){
        $kls = $this->input->post('kdkelas');

        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Rekap Data Siswa")
             ->setSubject("Siswa")
             ->setDescription("Laporan Rekap Data Siswa")
             ->setKeywords("Rekap Data Siswa");
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "REKAP DATA SISWA "); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->setActiveSheetIndex(0)->setCellValue('A2', strtoupper(str_replace("%20"," ",$kls))); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->mergeCells('A2:G2'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B4', "NISN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C4', "NAMA PESERTA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D4', "HADIR");
        $excel->setActiveSheetIndex(0)->setCellValue('E4', "SAKIT");
        $excel->setActiveSheetIndex(0)->setCellValue('F4', "IZIN");
        $excel->setActiveSheetIndex(0)->setCellValue('G4', "ALFA");

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('F4')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('G4')->applyFromArray($style_col);

        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa


        $where2=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('tahun')
        );
        $siswa = $this->M_siswa->get_row_join_count_absenharian($where2,$this->input->post('semester'))->result();
        

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($siswa as $row){ // Ambil semua data dari hasil eksekusi $sql
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->nisn);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, strtoupper($row->nama));
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->hadir);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->sakit);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->izin);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $row->alfa);

          
          // Khusus untuk no telepon. kita set type kolom nya jadi STRING

          
          // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
          $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);


          
          
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
        $excel->getActiveSheet()->getColumnDimension('G')->setWidth(10);


        // Set orientasi kertas jadi LANDSCAPE
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$kls.'.xlsx');
        $objWriter->save('php://output');
        
    }

    

    
   
}