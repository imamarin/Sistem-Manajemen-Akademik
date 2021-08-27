<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class datakehadiranguru extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'62','katmenu'=>'4'));
    }
    

    public function index(){
        $daftar_hari = array(
            'Sunday' => 'minggu',
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu'
        );
        $date = date('Y-m-d');
        $namahari = date('l', strtotime($date));
      
        $where=array(
            's.hari'=>$daftar_hari[$namahari],
            'j.semester'=>$this->session->semester,
            'st.idtahunajaran'=>$this->session->tahun
        );
        
        $where2=array(
            //'hari'=>$daftar_hari[$namahari],
            'setjadwal.idtahunajaran'=>$this->session->tahun
        );

        $where3=array(
            'jadwal.semester'=>$this->session->semester,
            'setjadwal.idtahunajaran'=>$this->session->tahun,
            'jadwal.kdguru'=>$this->session->kdguru,
        );

        $data['setjadwal'] = $this->M_setjadwal->get_row3($where2)->result();
        $data['jadwal'] = $this->M_jadwal->get_row2($where3)->result();
        $absensi= $this->M_jadwal->get_row4($where3)->result();
        $data['absensi']=array();
        $data['tggl']=array();
        foreach($absensi as $v){
            $wkt=date('Y-m-d',strtotime($v->waktu));
            $data['absensi'][$v->idjadwal][]=$wkt;
            $data['tggl'][]=$v->hari;
        }
        $data['form_action']='page/kehadiranguru/cari';
        $data['tanggal']=$date;
        $this->template->admin('page/view_data_kehadiran_guru',$data);
    }

    public function cari(){
        $daftar_hari = array(
            'Sunday' => 'minggu',
            'Monday' => 'senin',
            'Tuesday' => 'selasa',
            'Wednesday' => 'rabu',
            'Thursday' => 'kamis',
            'Friday' => 'jumat',
            'Saturday' => 'sabtu'
        );
        $date = $this->input->post('tanggal');
        $namahari = date('l', strtotime($date));
      
        $where=array(
            's.hari'=>$daftar_hari[$namahari],
            'j.semester'=>$this->session->semester,
            'st.idtahunajaran'=>$this->session->tahun
        );
        
        $where2=array(
            'hari'=>$daftar_hari[$namahari],
            'setjadwal.idtahunajaran'=>$this->session->tahun
        );

        $where3=array(
            'jadwal.semester'=>$this->session->semester,
            'setjadwal.idtahunajaran'=>$this->session->tahun
        );

        $data['setjadwal'] = $this->M_setjadwal->get_row2($where2)->result();
        $data['jadwal'] = $this->M_jadwal->get_row3($where3,$date)->result();
        $data['guru'] = $this->M_jadwal->get_row_join3($where)->result();
        $data['form_action']='page/kehadiranguru/cari';
        $data['tanggal']=$date;
        $this->template->admin('page/view_kehadiran_guru',$data);
    }

    public function simpan(){

        if($this->input->post('submit')){
            $where=array(
            "walikelas.kdkelas"=>$this->input->post('kdkelas'),
            "walikelas.idtahunajaran"=>$this->input->post('tahunajaran'),
            );
            $query = $this->M_walikelas->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "kdkelas"=>$this->input->post('kdkelas'),
                    "idtahunajaran"=>$this->input->post('tahunajaran'),
                    "kdguru"=>$this->input->post('kdguru'),                                       
                );
                $queri=$this->M_walikelas->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                
            }else{
                $this->session->set_flashdata('info',"Data Tidak Tersimpan");
            }

            redirect('page/walikelas');
        }else{
            redirect('page/home');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "idwalikelas"=>$id,
        );
        $this->M_walikelas->delete($where);
        $this->session->set_flashdata('info',"Data telah dihapus");
        redirect("page/walikelas");
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
                redirect('page/ujianharian/input');

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
                            "kdguru"=>$row['B'],
                            "kdkelas"=>$row['C'],
                            "idtahunajaran"=>$row['D'],
                        );
                        $where=array(
                            "kdguru"=>$row['B'],
                            "kdkelas"=>$row['C'],
                            "idtahunajaran"=>$row['D'],
                        );

                        $query = $this->M_walikelas->get_row($where)->num_rows();
                        if($query==0){
                            $this->M_walikelas->add($data);
                        }else{
                            $this->M_walikelas->update($where,$data);
                        }
                    }
                    $numrow++;
                }
                //delete file from server
                unlink(realpath('excel/'.$data_upload['file_name']));

                //upload success
                $this->session->set_flashdata('info', '<b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!');
                //redirect halaman
                redirect('page/walikelas');

            }
        }
    }

     public function eksport(){
            include APPPATH.'third_party/PHPExcel.php';
            $excel = new PHPExcel();
            $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data Walikelas")
                 ->setSubject("Data Walikelas")
                 ->setDescription("Laporan Data Walikelas")
                 ->setKeywords("Data Walikelas");
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
            $excel->setActiveSheetIndex(0)->setCellValue('B1', "KODE GURU"); 
            $excel->setActiveSheetIndex(0)->setCellValue('C1', "NAMA GURU");
            $excel->setActiveSheetIndex(0)->setCellValue('D1', "KELAS");
            $excel->setActiveSheetIndex(0)->setCellValue('E1', "TAHUN AJARAN");

            // Apply style header yang telah kita buat tadi ke masing-masing kolom header
            $excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
            $excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);

            // Set height baris ke 1, 2 dan 3
            $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
            $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            // Buat query untuk menampilkan semua data siswa

            $walikelas = $this->M_walikelas->get_all_join()->result();
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
            foreach($walikelas as $row){ // Ambil semua data dari hasil eksekusi $sql
              $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->kdguru);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row->nama);
              $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow,  $row->kdkelas);
              $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->tahun);


              
              // Khusus untuk no telepon. kita set type kolom nya jadi STRING

              
              // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
              $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
              $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);


              
              
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
            ob_end_clean();
            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Data Walikelas.xlsx"');
            $objWriter->save('php://output');
        
        //redirect('page/walikelas');
    }

}