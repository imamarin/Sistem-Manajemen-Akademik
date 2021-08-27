<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapnilaius extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'66','katmenu'=>'5'));

    }
    

    public function index(){
        $data['thn']="";
        $data['kelas'] = array();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['form_action'] = "page/rekapnilaius/tampil";
        $this->template->admin('page/view_rekap_us',$data);
    }

    function tampil(){
        $data['thn']=$this->input->post('tahun');
        $where = array(
            'idtahunajaran'=>$this->input->post('tahun'),
            'kelas.tingkat'=>12
        );
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['form_action'] = "page/rekapnilaius/tampil";
        $data['kelas']=$this->M_siswakelas->get_row_group_by($where)->result();
        $this->template->admin('page/view_rekap_us',$data);
    }

    public function eksport($kls=NULL,$thn=NULL){

            include APPPATH.'third_party/PHPExcel.php';

            $kls=str_replace("%20"," ",$kls);
            $excel = new PHPExcel();
            $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data Rekap Nilai US")
                 ->setSubject("Data Rekap")
                 ->setDescription("Laporan Rekap Nilai US 2021")
                 ->setKeywords("Data Ujian");
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
            $excel->setActiveSheetIndex(0)->setCellValue('E1', "KELAS");

            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);

            $query=$this->db->query("SELECT matpel.matpel,matpel.kdmatpel FROM ujian,matpel WHERE ujian.kdmatpel=matpel.kdmatpel AND ujian.kategori='us' AND
            ujian.semester='genap' AND ujian.idtahunajaran=$thn AND ujian.kdkelas='$kls' GROUP BY ujian.kdmatpel")->result();
            $abjad='F';
            $matpel=array();
            foreach ($query as $key => $v) {
                $excel->setActiveSheetIndex(0)->setCellValue($abjad.'1', $v->matpel);
                $excel->getActiveSheet()->getStyle($abjad.'1')->applyFromArray($style_col);
                $matpel[$key]=$v->kdmatpel;
                $abjad++;
            }

            // Set height baris ke 1, 2 dan 3
            $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            // Buat query untuk menampilkan semua data siswa
            $where=array(
                    'siswakelas.kdkelas'=>$kls,
                    'siswakelas.idtahunajaran'=>$thn,
                );

            $siswa = $this->M_siswa->get_row_join5($where)->result();
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
            foreach($siswa as $row){ // Ambil semua data dari hasil eksekusi $sql
              $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->nisn);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row->nama);
              $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow,  $row->jk);
              $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->kdkelas);

              // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
              $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);

              $abjad='F';
              foreach ($matpel as $key => $v) {
                  # code...
                  $query=$this->db->query("SELECT detailujian.nilai FROM ujian,detailujian WHERE ujian.idujian=detailujian.idujian AND 
                  ujian.kdmatpel='$v' AND ujian.kategori='us' AND ujian.idtahunajaran=$thn AND 
                  ujian.kdkelas='$kls' AND detailujian.nisn='$row->nisn'");
                  if($query->num_rows()<1){
                    $excel->setActiveSheetIndex(0)->setCellValue($abjad.$numrow, "-");
                    $excel->getActiveSheet()->getStyle($abjad.$numrow)->applyFromArray($style_row);
                  }else{
                    $row2=$query->row();
                    $excel->setActiveSheetIndex(0)->setCellValue($abjad.$numrow,  $row2->nilai);
                    $excel->getActiveSheet()->getStyle($abjad.$numrow)->applyFromArray($style_row);
                  }
                  $abjad++;
              }

              
              // Khusus untuk no telepon. kita set type kolom nya jadi STRING

              
              


              
              
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


            // Set orientasi kertas jadi LANDSCAPE
            $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            ob_end_clean();
            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Rekap Nilai US "'.$kls.'".xlsx"');
            $objWriter->save('php://output');

    }

  

   
}