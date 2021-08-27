<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class datasiswakelas extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'33','katmenu'=>'9'));
    }
    

    public function index(){
        $where=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.status'=>1
        );
        $walikelas=$this->M_walikelas->get_row($where);
        if($walikelas->num_rows()>0){
            $data['siswa'] = array();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas']= $walikelas->result();
            $data['form_action']='page/datasiswakelas/cari/';
            $this->template->admin('page/view_siswa_kelas',$data);
        }else{
            redirect('page/home');
        }
        
    }

    public function cari(){
        $this->update();
        $this->editpetugas();
        $where=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.status'=>1
        );
        $walikelas=$this->M_walikelas->get_row($where);
        if($walikelas->num_rows()>0){
            $where2=array(
                'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                'settahunajaran.status'=>1
            );
            $data['siswa'] = $this->M_siswa->get_row_join2($where2)->result();
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $walikelas->result();
            $data['walikelas']= $walikelas->result();
            $data['cari']=1;
            $data['kdkelas']=$this->input->post('kdkelas');
            $where=array(
                "walikelas.idtahunajaran"=>$this->session->tahun,
                "walikelas.kdguru"=>$this->session->kdguru,
                "walikelas.kdkelas"=>$this->input->post('kdkelas'),
            );
            $q=$this->M_walikelas->get_row($where)->row();
            $data['petugas']=$q->nisn;
            $data['form_action']='page/datasiswakelas/cari/';
            $this->template->admin('page/view_siswa_kelas',$data);
        }else{
            redirect('page/home');
        }
        
    }


    public function edit($id=NULL){

        
        $where=array(
            "nisn"=>$id,
        );
        $query = $this->M_siswa->get_row($where)->num_rows();
        if($query>0){
            $row = $this->M_siswa->get_row($where)->row();
            $data=array(
                "nisn"=>$row->nisn,
                "nis"=>$row->nis,
                "nik"=>$row->nik,
                "nama"=>$row->nama,
                "jk"=>$row->jk,
                "tmplahir"=>$row->tmp_lahir,
                "tgllahir"=>$row->tgl_lahir,
                "asalsekolah"=>$row->asal_sekolah,
                "alamatsiswa"=>$row->alamat_siswa,
                "hpsiswa"=>$row->hp_siswa,
                "tglterima"=>$row->tgl_terima,
                "kdkelas"=>$row->kdkelas,
                "idtahunajaran"=>$row->idtahunajaran,
                "nmayah"=>$row->nm_ayah,
                "nmibu"=>$row->nm_ibu,
                "pekayah"=>$row->pek_ayah,
                "pekibu"=>$row->pek_ibu,
                "alamatorangtua"=>$row->alamat_orangtua,
                "hporangtua"=>$row->hp_orangtua,
                "status"=>$row->status,
                "agama"=>$row->agama,
                "anakke"=>$row->anakke,
                "walisiswa"=>$row->walisiswa,
                "pekwali"=>$row->pekwali,
                "alamatwali"=>$row->alamatwali,
                "nohpwali"=>$row->nohpwali,
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
            $data['tahun'] = $this->M_tahunajaran->get_all()->result();
            $data['kelas'] = $this->M_kelas->get_all()->result();
            $data['tidakaktif']="readonly";
            $data['aksi']="update";
            $data['form_action']='page/datasiswakelas/cari/';
            $this->template->admin('page/view_add_siswa',$data);
        }

    }

    public function editpetugas(){
        if($this->input->post('simpan')){
            $where=array(
                "walikelas.idtahunajaran"=>$this->session->tahun,
                "walikelas.kdguru"=>$this->session->kdguru,
                "walikelas.kdkelas"=>$this->input->post('kdkelas'),
            );
            $q=$this->M_walikelas->get_row($where);
            if($q->num_rows()>0){
                $data=array(
                    "walikelas.nisn"=>$this->input->post('nisn')
                );
                $this->M_walikelas->update($where,$data);
            }
           
        }
    }

    public function update($id=NULL){
        if($this->input->post('submit')=="UPDATE"){
            $where=array(
                "nisn"=>$this->input->post('nisn'),
            );
            $query = $this->M_siswa->get_row($where);
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
                //$this->M_user->update($where2,$data);

                $data=array(
                    "nik"=>$this->input->post('nik'),
                    "nama"=>$this->input->post('nama'),
                    "jk"=>$this->input->post('jk'),
                    "tmp_lahir"=>$this->input->post('tmplahir'),
                    "tgl_lahir"=>$this->input->post('tgllahir'),
                    "asal_sekolah"=>$this->input->post('asalsekolah'),
                    "alamat_siswa"=>$this->input->post('alamatsiswa'),
                    "hp_siswa"=>$this->input->post('hpsiswa'),
                    "tgl_terima"=>$this->input->post('tglterima'),
                    "idtahunajaran"=>$this->input->post('idtahunajaran'),
                    "kdkelas"=>$this->input->post('kdkelas'),
                    "nm_ayah"=>$this->input->post('nmayah'),
                    "nm_ibu"=>$this->input->post('nmibu'),
                    "pek_ayah"=>$this->input->post('pekayah'),
                    "pek_ibu"=>$this->input->post('pekibu'),
                    "alamat_orangtua"=>$this->input->post('alamatorangtua'),
                    "hp_orangtua"=>$this->input->post('hporangtua'),
                    "status"=>$this->input->post('status'),
                    "agama"=>$this->input->post('agama'),
                    "anakke"=>$this->input->post('anakke'),
                    "walisiswa"=>$this->input->post('walisiswa'),
                    "pekwali"=>$this->input->post('pekwali'),
                    "alamatwali"=>$this->input->post('alamatwali'),
                    "nohpwali"=>$this->input->post('nohpwali'),
                );

                $where=array(
                    "nisn"=>$this->input->post('nisn'),
                );

                $queri=$this->M_siswa->update($where,$data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data telah diubah");
                }else{
                    $this->session->set_flashdata('info',"Data gagal diubah");
                }
            }else{
                $this->session->set_flashdata('info',"Data tidak ditemukan");               
                $this->add();  
            }    
        }
    }


    public function hapus($id=NULL){

        $where=array(
            "nisn"=>$id,
        );
        $queri=$this->M_siswa->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/siswa");
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
                echo $row['R'];
                if($numrow > 1){
                    $where=array(
                    "username"=>$row['R'],
                    );
                    $query = $this->M_user->get_row($where);
                    $cek=$query->num_rows();
                    
                    if($cek < 1){
                        $data=array(
                            "username"=>$row['R'],
                            "password"=>$row['S'],
                            "idlevel"=>$row['T'],
                            "profil"=>"siswa"                    
                        );
                        $this->M_user->add($data);
                        
                        $where=array(
                            "username"=>$row['R'],
                        );
                        $query = $this->M_user->get_row($where);
                        $d=$query->row();
                        $data2=array(
                            'nisn'=> $row['A'],
                            'nis'=> $row['B'],
                            'nama'=> $row['C'],
                            'tmp_lahir'=> $row['D'],
                            'tgl_lahir'=> $row['E'],
                            'jk'=> $row['F'],
                            'asal_sekolah'=> $row['G'],
                            'alamat_siswa'=> $row['H'],
                            'nm_ayah'=> $row['I'],
                            'nm_ibu'=> $row['J'],
                            'pek_ayah'=> $row['K'],
                            'pek_ibu'=> $row['L'],
                            'alamat_orangtua'=> $row['M'],
                            'hp_orangtua'=> $row['N'],
                            'hp_siswa'=> $row['O'],
                            'nik'=> $row['P'],
                            'tgl_terima'=> $row['Q'],
                            "status"=>$row['U'],
                            "iduser"=>$d->iduser,
                        );

                        $where=array(
                            "nisn"=>$row['A'],
                        );

                        $query = $this->M_siswa->get_row($where)->num_rows();
                        if($query==0){
                            $this->M_siswa->add($data2);
                            $this->session->set_flashdata('info', '<b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!');
                        }
                    }
                    /*
                    array_push($data, array(
                        'nisn'=> $row['A'],
                        'nis'=> $row['B'],
                        'nama'=> $row['C'],
                        'tmp_lahir'=> $row['D'],
                        'tgl_lahir'=> $row['E'],
                        'jk'=> $row['F'],
                        'asal_sekolah'=> $row['G'],
                        'alamat_siswa'=> $row['H'],
                        'nm_ayah'=> $row['I'],
                        'nm_ibu'=> $row['J'],
                        'pek_ayah'=> $row['K'],
                        'pek_ibu'=> $row['L'],
                        'alamat_orangtua'=> $row['M'],
                        'hp_orangtua'=> $row['N'],
                        'hp_siswa'=> $row['O'],
                        'nik'=> $row['P'],
                        'tgl_terima'=> $row['Q'],
                    ));

                    array_push($data, array(
                        'username'=> $row['A'],
                        'nis'=> $row['B'],
                        'nama'=> $row['C'],
                    ));

                    */


                }
                $numrow++;
            }
            //$this->db->insert_batch('siswa', $data);
            //delete file from server
            unlink(realpath('excel/'.$data_upload['file_name']));

            //upload success
           
            //redirect halaman
            redirect('page/siswa');

        }
    }

    public function eksport2(){
        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA SISWA"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:Q1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NISN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NIS"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA PESERTA");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "TEMPAT LAHIR");
        $excel->setActiveSheetIndex(0)->setCellValue('F3', "TGL LAHIR");
        $excel->setActiveSheetIndex(0)->setCellValue('G3', "JK");
        $excel->setActiveSheetIndex(0)->setCellValue('H3', "ASAL SEKOLAH");
        $excel->setActiveSheetIndex(0)->setCellValue('I3', "ALAMAT SISWA");
        $excel->setActiveSheetIndex(0)->setCellValue('J3', "NAMA AYAH");
        $excel->setActiveSheetIndex(0)->setCellValue('K3', "NAMA IBU");
        $excel->setActiveSheetIndex(0)->setCellValue('L3', "PEKERJAAN AYAH");
        $excel->setActiveSheetIndex(0)->setCellValue('M3', "PEKERJAAN IBU");
        $excel->setActiveSheetIndex(0)->setCellValue('N3', "ALAMAT ORANG TUA");
        $excel->setActiveSheetIndex(0)->setCellValue('O3', "HP ORANG TUA");
        $excel->setActiveSheetIndex(0)->setCellValue('P3', "HP SISWA");
        $excel->setActiveSheetIndex(0)->setCellValue('Q3', "NIK");
        $excel->setActiveSheetIndex(0)->setCellValue('R3', "TANGGAL TERIMA");
        $excel->setActiveSheetIndex(0)->setCellValue('S3', "USERNAME");
        $excel->setActiveSheetIndex(0)->setCellValue('T3', "PASSWORD");
        $excel->setActiveSheetIndex(0)->setCellValue('U3', "LEVEL");

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
        $excel->getActiveSheet()->getStyle('T3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('U3')->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa

        if($this->input->post('kdkelas')==0){
            $where=array(
                'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran')
            );
        }else{
            $where=array(
                'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran')
            );
        }
        $siswa_data = $this->M_siswa->get_row_join($where)->result();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach($siswa_data as $row){ // Ambil semua data dari hasil eksekusi $sql
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->nisn);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row->nis);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->nama);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->tmp_lahir);
          $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow,  $row->tgl_lahir);
          $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow,  $row->jk);
          $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow,  $row->asal_sekolah);
          $excel->setActiveSheetIndex(0)->setCellValue('I'.$numrow,  $row->alamat_siswa);
          $excel->setActiveSheetIndex(0)->setCellValue('J'.$numrow,  $row->nm_ayah);
          $excel->setActiveSheetIndex(0)->setCellValue('K'.$numrow,  $row->nm_ibu);
          $excel->setActiveSheetIndex(0)->setCellValue('L'.$numrow,  $row->pek_ayah);
          $excel->setActiveSheetIndex(0)->setCellValue('M'.$numrow,  $row->pek_ibu);
          $excel->setActiveSheetIndex(0)->setCellValue('N'.$numrow,  $row->alamat_orangtua);
          $excel->setActiveSheetIndex(0)->setCellValue('O'.$numrow,  $row->hp_orangtua);
          $excel->setActiveSheetIndex(0)->setCellValue('P'.$numrow,  $row->hp_siswa);
          $excel->setActiveSheetIndex(0)->setCellValue('Q'.$numrow,  $row->nik, PHPExcel_Cell_DataType::TYPE_NUMERIC);
          $excel->setActiveSheetIndex(0)->setCellValue('R'.$numrow,  $row->tgl_terima);
          $excel->setActiveSheetIndex(0)->setCellValue('S'.$numrow,  $row->username);
          $excel->setActiveSheetIndex(0)->setCellValue('T'.$numrow,  $row->password);
          $excel->setActiveSheetIndex(0)->setCellValue('U'.$numrow,  $row->idlevel);
          
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
          $excel->getActiveSheet()->getStyle('T'.$numrow)->applyFromArray($style_row);
          $excel->getActiveSheet()->getStyle('U'.$numrow)->applyFromArray($style_row);

          
          
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
        $excel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
        $excel->getActiveSheet()->getColumnDimension('U')->setWidth(15);

        // Set orientasi kertas jadi LANDSCAPE
        $objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        ob_end_clean();
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data Siswa.xlsx"');
        $objWriter->save('php://output');
    }

    public function reset($k=NULL){
        $nisn=$this->input->post('nisn');
        foreach ($nisn as $key => $v) {
            $data=array(
                'password'=>sha1("smkypc2020"),
            );

           $this->M_user->update(array('username'=>$v),$data);
        }

        redirect('guru/datasiswakelas/kelas/'.$k);
    }

}