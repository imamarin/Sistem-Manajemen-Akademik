<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ujianus extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'64','katmenu'=>'5'));

    }
    

    public function index(){
        $this->session->set_flashdata('info', "");
        if(isset($this->session->nisn)){
            $where=array(
                'kategori'=>"us",
                'kelas.kdkelas'=>$this->session->kdkelas
            );
            $data['ujian'] = $this->M_ujian->get_row_join2($where,$this->session->nisn)->result();
            $this->template->admin('page/view_ujian_us_siswa',$data);
        }else{
            $where=array(
                'guru.kdguru'=>$this->session->kdguru,
                'kategori'=>"us"
            );

            $where3=array(
                'guru.kdguru'=>$this->session->kdguru
            );
            $where4=array(
                'settahunajaran.status'=>1
            );
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['matpel'] = $this->M_matpel->get_all()->result();
            $data['tahun'] = $this->M_tahunajaran->get_row($where4)->result();
            $data['ujian'] = $this->M_ujian->get_row_join($where)->result();
            $data['hapus_action'] = "page/ujianus/hapus/";
            $this->template->admin('page/view_ujian_us',$data);
        }
    }

    function input(){

        if($this->input->post('eksport')){
            $this->eksport();
        }else{
        if($this->input->post('input') || $this->input->post('submit')){
            
            $this->upload();

            $this->simpan2();
            $where=array(
                'siswakelas.kdkelas'=>$this->input->post('h_kdkelas'),
                'siswakelas.idtahunajaran'=>$this->input->post('h_tahun'),
                'siswa.status'=>1
            );

            $data['siswa'] = $this->M_siswa->get_row_join_ujian($where,$this->input->post('h_idujian'))->result();


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
            $data['idujian']=$this->input->post('h_idujian');
            $data['judul']=$this->input->post('h_judul');
            $data['kategori']=$this->input->post('h_kategori');
            $data['semester']=$row->semester;
            $data['matpel']=$row2->matpel;
            $data['kdmatpel']=$row2->kdmatpel;
            $data['form_action'] = "page/ujianus/input";
            $this->template->admin('page/view_nilai_siswa',$data);
        }else{
            redirect('page/ujianus');
        }
        }
    }

    public function simpan(){

        if($this->input->post('submit')){

            $data=array(
                "kdguru"=>$this->session->kdguru,
                "judul"=>$this->input->post('judul'),
                "kdmatpel"=>$this->input->post('kdmatpel'),
                "kdkelas"=>$this->input->post('kdkelas'),
                "kategori"=>'us',
                "semester"=>$this->input->post('semester'),
                "idtahunajaran"=>$this->input->post('tahun')                               
            );
            $queri=$this->M_ujian->add($data);
            if($queri==TRUE){
                $this->session->set_flashdata('info',"Data berhasil disimpan");
            }else{
                $this->session->set_flashdata('info',"Data gagal disimpan");
            }

            redirect('page/ujianus');
        }else{
            redirect('page/home');
        }

    }

    public function simpan2(){

        if($this->input->post('submit')=='simpan'){

            $nisn=$this->input->post('nisn');
            $nilai=$this->input->post('nilai');
            $h=0;
            foreach ($nisn as $key => $value) {
                $data=array(
                    "nisn"=>$value,
                    "nilai"=>$nilai[$key],
                    "idujian"=>$this->input->post('h_idujian')
                );

                $where=array(
                    "nisn"=>$value,
                    "idujian"=>$this->input->post('h_idujian'),
                );  
                $query = $this->M_detail_ujian->get_row($where)->num_rows();
                if($query<1){
                    $queri=$this->M_detail_ujian->add($data); 
                }else{
                    $queri=$this->M_detail_ujian->update($where,$data); 
                }
            }
            
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "idujian"=>$id,
        );

        $queri=$this->M_detail_ujian->delete($where);
        
        
        $queri2=$this->M_ujian->delete($where);
        if($queri2==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/ujianus");
    }

    public function eksport(){
        if($this->input->post("eksport")){
            include APPPATH.'third_party/PHPExcel.php';
            $excel = new PHPExcel();
            $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle("Data us")
                 ->setSubject("Data Ujian")
                 ->setDescription("Laporan Data Ujian")
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
            $excel->setActiveSheetIndex(0)->setCellValue('E1', "NILAI");

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
            $where=array(
                    'siswakelas.kdkelas'=>$this->input->post('h_kdkelas'),
                    'siswakelas.idtahunajaran'=>$this->input->post('h_tahun'),
                    'siswa.status'=>1
                );

            $siswa = $this->M_siswa->get_row_join_ujian($where,$this->input->post('h_idujian'))->result();
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
            foreach($siswa as $row){ // Ambil semua data dari hasil eksekusi $sql
              $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->nisn);
              $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row->nama);
              $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow,  $row->jk);
              $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  isset($row->nilai)?$row->nilai:0);


              
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
            PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
            ob_end_clean();
            // We'll be outputting an excel file
            header('Content-type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="Data Nilai US.xlsx"');
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
            redirect('page/ujianus/input');

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
                        "nilai"=>$row['E'],
                        "idujian"=>$this->input->post('h_idujian')
                    );

                    $where=array(
                        "nisn"=>$row['B'],
                        "idujian"=>$this->input->post('h_idujian'),
                    );  
                    $query = $this->M_detail_ujian->get_row($where)->num_rows();
                    if($query<1){
                        $queri=$this->M_detail_ujian->add($data); 
                    }else{
                        $queri=$this->M_detail_ujian->update($where,$data); 
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