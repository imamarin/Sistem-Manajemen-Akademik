<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hakakses extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');

        //$this->load->library("PHPExcel");
    }
    

    public function index(){
        $data['hakakses']=array();
        $data['level'] = $this->M_hakakses->get_level()->result();
        $data['menu'] = $this->M_menu->get_all_join()->result();
        $data['fiturmenu'] = $this->M_fiturmenu->get_all()->result();
        $data['form_action']='page/hakakses/cari/';
        $data['form_action2']='';
        $data['disabled']='disabled'; 
        $this->template->admin('page/view_hak_akses',$data);
    }

    public function cari(){
        $where=array(
            'idlevel'=>$this->input->post('idlevel')
        );
        $query=$this->M_level->get_row($where);
        if($query->num_rows()<1){
            $data['level'] = $this->M_level->get_all()->result();
            $data['hakakses'] =array();
            $data['fiturmenu'] = $this->M_fiturmenu->get_all()->result();
            $data['menu'] = $this->M_menu->get_all_join()->result();
            $data['lvl'] = $this->input->post('idlevel');
            $data['form_action']='';
            $data['form_action2']='';
            $data['disabled']='disabled';
        }else{
            $data['level'] = $this->M_level->get_all()->result();
            $data['hakakses'] = $this->M_hakakses->get_row($where)->result();
            $data['fiturmenu'] = $this->M_fiturmenu->get_all()->result();
            $data['menu'] = $this->M_menu->get_all_join()->result();
            $data['lvl'] = $this->input->post('idlevel');
            $data['form_action']='page/hakakses/cari/';
            $data['form_action2']='page/hakakses/simpan/'.$this->input->post('idlevel');
            $data['disabled']='';  
        }
        

        $this->template->admin('page/view_hak_akses',$data);
    }

    public function add(){
        $data=array(
            "nisn"=>"",
            "nis"=>"",
            "nik"=>"",
            "nama"=>"",
            "jk"=>"",
            "tmplahir"=>"",
            "tgllahir"=>"",
            "asalsekolah"=>"",
            "alamatsiswa"=>"",
            "hpsiswa"=>"",
            "nmayah"=>"",
            "nmibu"=>"",
            "pekayah"=>"",
            "pekibu"=>"",
            "alamatorangtua"=>"",
            "hporangtua"=>"",
            "tidakaktif"=>"",
            "status"=>"",
        );    
        $data['form_action']='page/siswa/simpan/';
        $this->template->admin('page/view_add_siswa',$data);
    }

    public function simpan($id=NULL){
        $this->M_hakakses->delete(array('idlevel'=>$id));

        $fitur=$this->input->post('fitur');
        foreach ($fitur as $key => $v) {
            $data=array(
                "idlevel"=>$id,
                "idsetfiturmenu"=>$v,
            );
            $where=array(
                "idlevel"=>$id,
                "idsetfiturmenu"=>$v,
            );

            $query = $this->M_hakakses->get_row2($where);
            if($query->num_rows()==0){
                $this->M_hakakses->add($data);
            }
        }
        redirect("page/hakakses/");

    }

    public function simpanlevel(){
        $data=array(
            "idlevel"=>$this->input->post('kdlevel'),
            "level"=>$this->input->post('level'),
        );

        $where=array(
            "idlevel"=>$this->input->post('kdlevel'),
            "level"=>$this->input->post('level'),
        );

        $query = $this->M_level->get_row($where)->num_rows();
        if($query==0){
            $this->M_level->add($data);
            $this->session->set_flashdata('info',"Data Tersimpan");
            redirect("page/hakakses");
        }else{
            $this->session->set_flashdata('info',"Data Tidak Tersimpan");
            redirect("page/hakakses");
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
                "nmayah"=>$row->nm_ayah,
                "nmibu"=>$row->nm_ibu,
                "pekayah"=>$row->pek_ayah,
                "pekibu"=>$row->pek_ibu,
                "alamatorangtua"=>$row->alamat_orangtua,
                "hporangtua"=>$row->hp_orangtua,
                "status"=>$row->status,
            );
            $data['tidakaktif']="disabled";
            $data['form_action']='page/siswa/update/'.$id;
            $this->template->admin('page/view_add_siswa',$data);
        }

    }

    public function update($id=NULL){
        $data=array(
            "nik"=>$this->input->post('nik'),
            "nama"=>$this->input->post('nama'),
            "jk"=>$this->input->post('jk'),
            "tmp_lahir"=>$this->input->post('tmplahir'),
            "tgl_lahir"=>$this->input->post('tgllahir'),
            "asal_sekolah"=>$this->input->post('asalsekolah'),
            "alamat_siswa"=>$this->input->post('alamatsiswa'),
            "hp_siswa"=>$this->input->post('hpsiswa'),
            "nm_ayah"=>$this->input->post('nmayah'),
            "nm_ibu"=>$this->input->post('nmibu'),
            "pek_ayah"=>$this->input->post('pekayah'),
            "pek_ibu"=>$this->input->post('pekibu'),
            "alamat_orangtua"=>$this->input->post('alamatorangtua'),
            "hp_orangtua"=>$this->input->post('hporangtua'),
            "status"=>$this->input->post('status'),
        );

        $where=array(
            "nisn"=>$id,
        );

        $query = $this->M_siswa->get_row($where)->num_rows();
        if($query>0){
            $this->M_siswa->update($where,$data);
            $this->session->set_flashdata('info',"Data telah diubah");
            redirect("page/siswa/edit/".$id);
        }else{
            echo $query;
        }
    }

    public function hapus($id=NULL){

        $where=array(
            "nisn"=>$id,
        );
        $this->M_siswa->delete($where);
        $this->session->set_flashdata('info',"Data telah dihapus");
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
                            if($numrow > 1){
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
                    }
                $numrow++;
            }
            $this->db->insert_batch('siswa', $data);
            //delete file from server
            unlink(realpath('excel/'.$data_upload['file_name']));

            //upload success
            $this->session->set_flashdata('info', '<b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!');
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
        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        $where=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran')
        );
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

        redirect('guru/siswa/kelas/'.$k);
    }

}