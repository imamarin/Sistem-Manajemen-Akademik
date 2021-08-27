<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class aktivasi extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'52','katmenu'=>'12'));

    }
    

    public function index(){
            $data['raport'] = $this->M_raport->get_all()->result();                     
            $data['hapus_action'] = "page/ujianharian/hapus/";
            $this->template->admin('page/raport/view_aktivasi_raport',$data);      
    }

    public function update($id=NULL,$id2=NULL,$thn=NULL,$sms=NULL){
        $this->session->set_flashdata('info',"Data berhasil di aktivasi");
        $this->session->unset_userdata(array('idtahunraport','semesterraport','tahunraport','idraport'));
        $this->session->set_userdata(array('idtahunraport'=>$id2));
        $this->session->set_userdata(array('tahunraport'=>$thn));
        $this->session->set_userdata(array('semesterraport'=>$sms));
        $this->session->set_userdata(array('idraport'=>$id));
        /*
        $aktif=array(
            "statusraport"=>1,
        );

        $tidakaktif=array(
            "statusraport"=>0,
        );

        $where=array(
            "id"=>$id,
        ); 

        $query = $this->M_raport->get_row($where)->num_rows();
        if($query>0){
            $queri=$this->M_raport->update2($tidakaktif); 
            $queri2=$this->M_raport->update($where,$aktif); 
            if($queri2==TRUE){
                $this->session->set_flashdata('info',"Data berhasil di aktivasi");
                $this->session->set_userdata(array('idtahunraport'=>$id2));
                $this->session->set_userdata(array('semesterraport'=>$sms));
                $this->session->set_userdata(array('idraport'=>$id));
            }else{
                $this->session->set_flashdata('info',"Data gagal di aktivasi");
                $this->session->set_userdata(array('idtahunraport'=>$id2));
                $this->session->set_userdata(array('idraport'=>$id));
            }
            
        }
        redirect("page/raport/aktivasi");
        */
        redirect("page/raport/aktivasi");
    }

    public function hapus($id=NULL){

        $where=array(
            "idujian"=>$id,
        );
        $queri=$this->M_nilairaport->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/ujianharian");
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
        if($this->input->post('submit')=="import"){
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
                        "pengetahuan"=>$row['E'],
                        "keterampilan"=>$row['F'],
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