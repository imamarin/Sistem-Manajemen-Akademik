<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class rekapabsensisiswa extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'14','katmenu'=>'4'));

    }
    

    public function index(){
        $where=array(
            'g.kdguru'=>$this->session->kdguru,
            'j.semester'=>$this->session->semester,
            'st.idtahunajaran'=>$this->session->tahun
        );

        $where2=array(
            'guru.kdguru'=>$this->session->kdguru
        );
        $data['jadwal'] = $this->M_jadwal->get_row_join2($where)->result();
        $data['kelas'] = $this->M_kelas->get_all_join()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['matpel'] = $this->M_matpelguru->get_row_join($where2)->result();
        $this->template->admin('page/view_rekap_absensi_siswa',$data);
    }

    
    function tampil(){
        if($this->input->post('submit')){
            $where2=array(
            'siswakelas.kdkelas'=>$this->input->post('h_kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('h_tahun'),
            );
            $where=array(
                "jadwal.idjadwal"=>$this->input->post('h_idjadwal'),
                "absensi.semester"=>$this->input->post('h_semester'),
                "setjadwal.idtahunajaran"=>$this->input->post('h_tahun'),
            );
            $data['kdmatpel'] = $this->input->post('h_kdmatpel');
            $data['kdkelas'] = $this->input->post('h_kdkelas');
            $data['tahun']=$this->input->post('h_tahun');
            $data['semester']=$this->input->post('h_semester');
            $data['matpel']=$this->input->post('h_matpel');
            $data['idjadwal']=$this->input->post('h_idjadwal');
            $data['siswa'] = $this->M_siswa->get_row_join_rekapabsen2($where2,$this->input->post('h_semester'),$this->input->post('h_kdmatpel'),$this->session->kdguru)->result();
            //$data['absen']=$this->M_absen->get_row3($where)->result();
            //$data['siswa']=$this->M_siswa->get_row_join5($where2)->result();
            //$data['detail']=$this->M_absen_detail->get_row3($where)->result();
            $this->template->admin('page/view_rekap_absensi_siswa_tampil2',$data);
        }else{
            redirect('page/rekapabsensisiswa');
        }
    }

    public function eksport($kdkelas=NULL, $kdmatpel=NULL, $tahun=NULL, $semester=NULL, $matpel=NULL, $idjadwal=NULL){
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "REKAP DATA SISWA ".strtoupper(str_replace("%20"," ",$kdkelas))); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->setActiveSheetIndex(0)->setCellValue('A2', strtoupper(str_replace("%20"," ",$matpel))); // Set kolom A1 dengan tulisan "DATA SISWA"
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
            'siswakelas.kdkelas'=>str_replace("%20"," ",$kdkelas),
            'siswakelas.idtahunajaran'=>$tahun,
        );
        $where=array(
            "jadwal.idjadwal"=>$idjadwal,
            "absensi.semester"=>$semester,
            "setjadwal.idtahunajaran"=>$tahun,
        );
        $data['kdmatpel'] = $kdmatpel;
        $data['tahun']=$tahun;
        $data['semester']=$semester;
        $data['matpel']=$matpel;
        $siswa = $this->M_siswa->get_row_join_rekapabsen2($where2,$semester,$kdmatpel,$this->session->kdguru)->result();
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
        header('Content-Disposition: attachment; filename='.$kdmatpel.' '.str_replace('%20',' ',$kdkelas).'.xlsx');
        $objWriter->save('php://output');
    }

    function histori(){
             if($this->input->post('submit')){
                $where2=array(
                    'siswakelas.kdkelas'=>$this->input->post('h_kdkelas'),
                    'siswakelas.nisn'=>$this->input->post('h_nisn'),
                    'siswakelas.idtahunajaran'=>$this->input->post('h_tahun'),
                );
                $where=array(
                    "jadwal.kdguru"=>$this->session->kdguru,
                    "jadwal.kdmatpel"=>$this->input->post('h_kdmatpel'),
                    'detailabsensi.nisn'=>$this->input->post('h_nisn'),
                    "absensi.semester"=>$this->input->post('h_semester'),
                    "setjadwal.idtahunajaran"=>$this->input->post('h_tahun'),
                );
                $data['siswa'] = $this->M_siswa->get_row_join_rekapabsen2($where2,$this->input->post('h_semester'),$this->input->post('h_kdmatpel'),$this->session->kdguru)->row();
                $data['detail']=$this->M_absen_detail->get_row3($where)->result();
                $data['matpel']=$this->input->post('h_matpel');
                $data['nama']=$this->input->post('h_nama');
                $data['nisn']=$this->input->post('h_nisn');
                $data['semester']=$this->input->post('h_semester');
                $data['kdkelas']=$this->input->post('h_kdkelas');
                $this->template->admin('page/view_rekap_kehadiran_siswa_histori',$data);
            }else{
                redirect('page/rekapabsensisiswa');
            }
    }

    

    
   
}