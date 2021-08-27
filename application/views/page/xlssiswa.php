<?php

// Load plugin PHPExcel nya
require 'PHPExcel/PHPExcel.php';
// Panggil class PHPExcel nya
$excel = new PHPExcel();
// Settingan awal file excel
$excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Siswa")
             ->setSubject("Siswa")
             ->setDescription("Laporan Semua Data Siswa")
             ->setKeywords("Data Siswa");
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
$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA CALON SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
$excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai F1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
// Buat header tabel nya pada baris ke 3
$excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
$excel->setActiveSheetIndex(0)->setCellValue('B3', "NISN"); 
$excel->setActiveSheetIndex(0)->setCellValue('C3', "NO PESERTA"); 
$excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA PESERTA");
$excel->setActiveSheetIndex(0)->setCellValue('E3', "TEMPAT LAHIR");
$excel->setActiveSheetIndex(0)->setCellValue('F3', "TGL LAHIR");
$excel->setActiveSheetIndex(0)->setCellValue('G3', "JK");
$excel->setActiveSheetIndex(0)->setCellValue('H3', "ASAL SEKOLAH");
$excel->setActiveSheetIndex(0)->setCellValue('I3', "ALAMAT SISWA");
$excel->setActiveSheetIndex(0)->setCellValue('J3', "JURUSAN 1");
$excel->setActiveSheetIndex(0)->setCellValue('K3', "JURUSAN 2");
$excel->setActiveSheetIndex(0)->setCellValue('L3', "NAMA AYAH");
$excel->setActiveSheetIndex(0)->setCellValue('M3', "NAMA IBU");
$excel->setActiveSheetIndex(0)->setCellValue('N3', "PEKERJAAN AYAH");
$excel->setActiveSheetIndex(0)->setCellValue('O3', "PEKERJAAN IBU");
$excel->setActiveSheetIndex(0)->setCellValue('P3', "ALAMAT ORANG TUA");
$excel->setActiveSheetIndex(0)->setCellValue('Q3', "HP ORANG TUA");
$excel->setActiveSheetIndex(0)->setCellValue('R3', "HP SISWA");
$excel->setActiveSheetIndex(0)->setCellValue('S3', "NIK");

// Apply style header yang telah kita buat tadi ke masing-masing kolom header
$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('I3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('J3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('K3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('L3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('M3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('N3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('O3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('P3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('Q3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('R3')->applyFromArray($style_col);
$excel->getActiveSheet()->getStyle('S3')->applyFromArray($style_col);
// Set height baris ke 1, 2 dan 3
$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
$excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
// Buat query untuk menampilkan semua data siswa
$sql = mysql_query("SELECT*FROM register INNER JOIN peserta ON register.id=peserta.id_register LEFT JOIN ortu_reg ON register.id=ortu_reg.id_register")or die(mysql_error());
$no = 1; // Untuk penomoran tabel, di awal set dengan 1
$numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
while($data = mysql_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
  $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
  $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $data['nisn'], PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $data['no_peserta'], PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['nama']);
  $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $data['tmp_lhr']);
  $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $data['tgl_lhr']);
  $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $data['jk']);
  $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow,  $data['sekolah']);
  $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow,  $data['alamat_siswa']);
  $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow,  $data['jur1']);
  $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow,  $data['jur2']);
  $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow,  $data['nm_ayah']);
  $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow,  $data['nm_ibu']);
  $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow,  $data['pkj_ayah']);
  $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow,  $data['pkj_ibu']);
  $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow,  $data['alamat_ortu']);
  $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow,  $data['hp_ortu'],PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow,  $data['hp_siswa'],PHPExcel_Cell_DataType::TYPE_STRING);
  $excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow,  $data['nik'], PHPExcel_Cell_DataType::TYPE_STRING);
  
  // Khusus untuk no telepon. kita set type kolom nya jadi STRING

  
  // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
  $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('F'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('G'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('H'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('I'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('J'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('K'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('L'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('M'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('N'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('O'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('P'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('Q'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('R'.$numrow)->applyFromArray($style_row);
  $excel->getActiveSheet()->getStyle('S'.$numrow)->applyFromArray($style_row);
  
  
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
$excel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$excel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
$excel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
$excel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
// Set orientasi kertas jadi LANDSCAPE
$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
// Set judul file excel nya
$excel->getActiveSheet(0)->setTitle("Laporan Data Calon Siswa");
$excel->setActiveSheetIndex(0);
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="Calon_Siswa.xlsx"'); // Set nama file excel nya
header('Cache-Control: max-age=0');
$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
$write->save('php://output');
?>