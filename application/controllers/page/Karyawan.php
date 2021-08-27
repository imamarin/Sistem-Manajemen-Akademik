<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class karyawan extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'8','katmenu'=>'1'));
    }
    

    public function index(){
        $data['karyawan'] = $this->M_karyawan->get_all()->result();
        $this->template->admin('page/view_karyawan',$data);
    }

    public function add(){
        $data=array(
            "kdkaryawan"=>$this->input->post('kdkaryawan'),
            "nik"=>$this->input->post('nik'),
            "nama"=>$this->input->post('nama'),
            "jk"=>$this->input->post('jk'),
            "tmplahir"=>$this->input->post('tmplahir'),
            "tgllahir"=>$this->input->post('tgllahir'),
            "alamat"=>$this->input->post('alamat'),
            "nohp"=>$this->input->post('nohp'),
            "tidakaktif"=>"",
            "status"=>$this->input->post('status'),
            "username"=>$this->input->post('username'),
            "password"=>$this->input->post('password'),
        );    
        $data['level'] = $this->M_level->get_all()->result();
        $data['lvl'] = "";
        $data['form_action']='page/karyawan/simpan/';
        $this->template->admin('page/view_add_karyawan',$data);
    }

    public function simpan(){
        if($this->input->post('submit')){
            $where=array(
                "username"=>$this->input->post('username'),
            );
            $query = $this->M_user->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                $data=array(
                    "username"=>$this->input->post('username'),
                    "password"=>sha1($this->input->post('password')),
                    "idlevel"=>$this->input->post('idlevel'),
                    "profil"=>"karyawan"                    
                );
                $this->M_user->add($data);

                
                $where=array(
                    "username"=>$this->input->post('username'),
                );
                $query = $this->M_user->get_row($where);
                $d=$query->row();

                $data=array(
                    "kdkaryawan"=>$this->input->post('kdkaryawan'),
                    "nik"=>$this->input->post('nik'),
                    "nama"=>$this->input->post('nama'),
                    "jk"=>$this->input->post('jk'),
                    "tmp_lahir"=>$this->input->post('tmplahir'),
                    "tgl_lahir"=>$this->input->post('tgllahir'),
                    "alamat"=>$this->input->post('alamat'),
                    "no_hp"=>$this->input->post('nohp'),
                    "status"=>$this->input->post('status'),
                    "iduser"=>$d->iduser,
                );

                $where=array(
                    "kdkaryawan"=>$this->input->post('kdkaryawan'),
                );

                $query = $this->M_karyawan->get_row($where)->num_rows();
                if($query==0){
                    $queri=$this->M_karyawan->add($data); 
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data telah disimpan");
                    }else{
                        $this->session->set_flashdata('info',"Data karyawan disimpan");
                    }             
                    redirect("page/karyawan/add");                
                }else{
                    $this->session->set_flashdata('info',"Kode guru sudah ada");
                    $this->add();                   
                }
                    
            }
        }else{
            redirect('page/home');
        }
        

    }

    public function edit($id=NULL){
        $where=array(
            "kdkaryawan"=>$id,
        );
        $query = $this->M_karyawan->get_row($where)->num_rows();
        if($query>0){
            $row = $this->M_karyawan->get_row($where)->row();
            $data=array(
                "kdkaryawan"=>$row->kdkaryawan,
                "nik"=>$row->nik,
                "nama"=>$row->nama,
                "jk"=>$row->jk,
                "tmplahir"=>$row->tmp_lahir,
                "tgllahir"=>$row->tgl_lahir,
                "alamat"=>$row->alamat,
                "nohp"=>$row->no_hp,
                "status"=>$row->status,
            );
            

            $where=array(
                "iduser"=>$row->iduser,
            );

            $query = $this->M_user->get_row($where)->num_rows();
            if($query>0){
                $row = $this->M_user->get_row($where)->row();
                $data["username"]=$row->username;
                $data["password"]=$row->password;
                $data["lvl"]=$row->idlevel;         
            }
            $data['level'] = $this->M_level->get_all()->result();
            $data['tidakaktif']="readonly";
            $data['form_action']='page/karyawan/update/'.$id;

            $this->template->admin('page/view_add_karyawan',$data);
        }
    }

    public function info($id=NULL){
        $where=array(
            "kdguru"=>$id,
        );
        $query = $this->M_guru->get_row($where)->num_rows();
        if($query>0){
            $row = $this->M_guru->get_row($where)->row();
            $data=array(
                "kdguru"=>$row->kdguru,
                "nuptk"=>$row->nuptk,
                "nip"=>$row->nip,
                "nama"=>$row->nama,
                "jk"=>$row->jk,
                "tmplahir"=>$row->tmp_lahir,
                "tgllahir"=>$row->tgl_lahir,
                "alamat"=>$row->alamat,
                "nohp"=>$row->no_hp,
                "status"=>$row->status,
            );
            $data['tidakaktif']="disabled";
            $data['form_action']='page/guru/update/'.$id;
            $this->template->admin('page/view_info_guru',$data);
        }else{
            $this->session->set_flashdata('info',"Data tidak ditemukan!");
        }
    }

    public function update($pg=NULL){
        if($this->input->post('submit')){
            $where=array(
                "kdkaryawan"=>$this->input->post('kdkaryawan'),
            );
            $query = $this->M_karyawan->get_row($where);
            $cek=$query->num_rows();
            $d=$query->row();
            if($cek > 0){
                $data=array(
                    "username"=>$this->input->post('username'),
                    "password"=>sha1($this->input->post('password')),
                    "idlevel"=>$this->input->post('idlevel'),                    
                );
                $where2=array(
                    "iduser"=>$d->iduser
                );
                
                $password=$this->input->post('password');
                if(!empty($password)){
                    $queri=$this->M_user->update($where2,$data);
                    if($queri==TRUE){
                        $this->session->set_flashdata('info2',"password telah diubah");
                    }else{
                        $this->session->set_flashdata('info2',"password gagal diubah");
                    }
                }  

                $data=array(
                    "kdkaryawan"=>$this->input->post('kdkaryawan'),
                    "nik"=>$this->input->post('nik'),
                    "nama"=>$this->input->post('nama'),
                    "jk"=>$this->input->post('jk'),
                    "tmp_lahir"=>$this->input->post('tmplahir'),
                    "tgl_lahir"=>$this->input->post('tgllahir'),
                    "alamat"=>$this->input->post('alamat'),
                    "no_hp"=>$this->input->post('nohp'),
                    "status"=>$this->input->post('status'),
                );

                $where=array(
                    "kdkaryawan"=>$this->input->post('kdkaryawan'),
                );

                $queri=$this->M_karyawan->update($where2,$data); 
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data telah diubah");
                }else{
                    $this->session->set_flashdata('info',"Data gagal diubah");
                }

                if($pg=="profil"){
                    redirect("page/profil/");
                }else{
                    redirect("page/karyawan/");
                }              
                                    
                    
            }else{
                $this->session->set_flashdata('info',"Data tidak tersimpan");               
                $this->add();
            }
        }else{
            redirect('page/home');
        }
    }

    public function hapus($id=NULL){

        $where=array(
            "kdkaryawan"=>$id,
        );

        $queri=$this->M_karyawan->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        } 

        redirect("page/karyawan");
    }

    public function upload()
    {
        // Load plugin PHPExcel nya
        include APPPATH.'third_party/PHPExcel.php';

        $config['upload_path'] = realpath('excel');
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['max_size'] = '10000';
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {

            //upload gagal
            $this->session->set_flashdata('notif', '<div class="alert alert-danger"><b>PROSES IMPORT GAGAL!</b> '.$this->upload->display_errors().'</div>');
            //redirect halaman
            redirect('import/');

        } else {

            $data_upload = $this->upload->data();

            $excelreader     = new PHPExcel_Reader_Excel2007();
            $loadexcel         = $excelreader->load('excel/'.$data_upload['file_name']); // Load file yang telah diupload ke folder excel
            $sheet             = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);

            $data = array();

            $numrow = 1;
            foreach($sheet as $row){
                if($numrow > 1){
                    $where=array(
                    "username"=>$row['K'],
                    );
                    $query = $this->M_user->get_row($where);
                    $cek=$query->num_rows();
                    
                    if($cek < 1){
                        $data=array(
                            "username"=>$row['J'],
                            "password"=>$row['K'],
                            "idlevel"=>$row['L'],
                            "profil"=>"karyawan"                    
                        );
                        $this->M_user->add($data);
                        
                        $where=array(
                            "username"=>$row['K'],
                        );
                        $query = $this->M_user->get_row($where);
                        $d=$query->row();
                        $data2=array(
                            'kdkaryawan'=> $row['A'],
                            'nama'=> $row['B'],
                            'tmp_lahir'=> $row['C'],
                            'tgl_lahir'=> $row['D'],
                            'jk'=> $row['E'],
                            'nik'=> $row['F'],
                            'alamat'=> $row['G'],
                            'no_hp'=> $row['H'],
                            'status'=> $row['I'],
                            "iduser"=>$d->iduser,
                        );

                        $where=array(
                            "kdkaryawan"=>$row['A'],
                        );

                        $query = $this->M_karyawan->get_row($where)->num_rows();
                        if($query==0){
                            $this->M_guru->add($data2);
                            $this->session->set_flashdata('info', '<b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!');
                        }
                        
                    }
                }
                $numrow++;
            }
            //delete file from server
            unlink(realpath('excel/'.$data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('info', '<b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!');
            //redirect halaman
            redirect('page/karyawan');

        }
    }

    public function eksport2(){
        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Karyawan")
             ->setSubject("Karyawan")
             ->setDescription("Laporan Data Karyawan")
             ->setKeywords("Data Guru");
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA KARYAWAN"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "KODE KARYAWAN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA KARYAWAN");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "TEMPAT LAHIR");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "TGL LAHIR");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "JK");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "NIK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "ALAMAT");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "NO. HP");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "STATUS");

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

        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        $karyawan_data = $this->M_karyawan->get_all_join()->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($karyawan_data as $row){ // Ambil semua data dari hasil eksekusi $sql
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->kdkaryawan);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row->nama);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow,  $row->tmp_lahir);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->tgl_lahir);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->jk);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $row->nik);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow,  $row->alamat);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow,  $row->no_hp);
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow,  $row->status);

          
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


        // Set orientasi kertas jadi LANDSCAPE
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Karyawan.xlsx"');
        $objWriter->save('php://output');
    }

    public function reset($id=NULL){
        $data=array(
           'password'=>sha1("smkypc2020"),
        );

        $this->M_user->update(array('iduser'=>$id),$data);
        

        redirect('page/siswa');
    }


}