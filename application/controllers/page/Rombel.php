<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rombel extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        //$this->load->library("PHPExcel");
        $this->session->set_userdata(array('menu'=>'3','katmenu'=>'1'));
    }
    

    public function index(){
        $where="siswa.nisn NOT IN (SELECT nisn FROM siswakelas,settahunajaran WHERE siswakelas.nisn=siswa.nisn AND siswakelas.idtahunajaran=settahunajaran.idtahunajaran AND settahunajaran.status=1)";
        $data['kelas'] = $this->M_kelas->get_all()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['siswa'] = $this->M_siswa->get_row_join($where)->result();
        $data['form_action']='page/rombel/cari/';
        $data['form_action2']='page/rombel/transfer/';
        $data['form_action3']='page/rombel/cetaklembarkehadiran/';
        $data['kls']="";
        $this->template->admin('page/view_rombel',$data);
    }

    public function cari(){
        $where=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran'),
            'siswa.status'=>1
        );
        $data['kelas'] = $this->M_kelas->get_all()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['siswa'] = $this->M_siswa->get_row_join($where)->result();
        $data['kls']=$this->input->post('kdkelas');
        $data['form_action']='page/rombel/cari/';
        $data['form_action2']='page/rombel/transfer/';
        $data['form_action3']='page/rombel/cetaklembarkehadiran/';
        $this->template->admin('page/view_rombel',$data);
    }

    public function add(){
        $data=array(
            "nisn"=>$row->nisn,
            "nik"=>$row->nik,
            "nama"=>$row->nama,
            "jk"=>$row->jk,
            "tmplahir"=>$row->tmp_lahir,
            "tgllahir"=>$row->tgl_lahir,
            "asalsekolah"=>$row->asal_sekolah,
            "alamat_siswa"=>$row->alamat_siswa,
            "hpsiswa"=>$row->hp_siswa,
            "nmayah"=>$row->nm_ayah,
            "nmibu"=>$row->nm_ibu,
            "pekayah"=>$row->pek_ayah,
            "pekibu"=>$row->pek_ibu,
            "alamatorangtua"=>$row->alamat_orangtua,
            "hporangtua"=>$row->hp_orangtua,
        );    
        $data['form_action']='page/siswa/simpan/';
        $this->template->admin('page/view_add_siswa',$data);
    }

    public function transfer(){
        $nisn=$this->input->post('nisn');
        $kdkelas=$this->input->post('kdkelas');
        $tahun=$this->input->post('tahunajaran');

        foreach ($nisn as $key => $v) {
            $data=array(
                "nisn"=>$v,
                "kdkelas"=>$kdkelas,
                "idtahunajaran"=>$tahun,
            );
            $where=array(
                "nisn"=>$v,
                "idtahunajaran"=>$tahun,
            );

            $query = $this->M_siswakelas->get_row($where)->num_rows();
            if($query==0){
                $this->M_siswakelas->add($data);
            }else{
                $this->M_siswakelas->update($where,$data);
            }
            
        }


        redirect("page/rombel/");
        

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
            );
            $data['tidakaktif']="disabled";
            $data['form_action']='page/siswa/update/'.$id;
            $this->template->admin('page/view_add_siswa',$data);
        }else{
            $this->session->set_flashdata('info',"Data Tidak Tersimpan");
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

    public function cetaklembarkehadiran(){
        if($this->input->post('cetak')){

            $where = array(
                "kelas.kdkelas"=>$this->input->post('kdkelas')
            );
    
            $where2=array(
                'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
                'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran'),
                'siswa.status'=>1
            );
    
            $data['kelas']=$this->M_kelas->get_row_join($where)->row();
            $thn=$this->M_tahunajaran->get_row(array('idtahunajaran'=>$this->input->post('tahunajaran')))->row();
            $data['tahun']=$thn->tahun;
            $data['semester']=$this->input->post('semester');
            $data['siswa'] = $this->M_siswa->get_row_join($where2)->result();
            $this->load->view('page/view_lembar_absensi',$data);
        }else{
            $this->eksport2();
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
                            "nisn"=>$row['B'],
                            "kdkelas"=>$row['C'],
                            "idtahunajaran"=>$row['D'],
                        );
                        $where=array(
                            "nisn"=>$row['B'],
                            "idtahunajaran"=>$row['D'],
                        );

                        $query = $this->M_siswakelas->get_row($where)->num_rows();
                        if($query==0){
                            $this->M_siswakelas->add($data);
                        }else{
                            $this->M_siswakelas->update($where,$data);
                        }
                    }
                    $numrow++;
                }
                //delete file from server
                unlink(realpath('excel/'.$data_upload['file_name']));

                //upload success
                $this->session->set_flashdata('info', '<b>PROSES IMPORT BERHASIL!</b> Data berhasil diimport!');
                //redirect halaman
                redirect('page/rombel');

            }
        }
    }

    public function eksport2(){
        include APPPATH.'third_party/PHPExcel.php';
        $excel = new PHPExcel();
        $excel->getProperties()->setCreator('My Notes Code')
             ->setLastModifiedBy('My Notes Code')
             ->setTitle("Data Siswa")
             ->setSubject("Siswa")
             ->setDescription("Laporan Data Kelas")
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
        $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai F1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "NISN"); 
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "NIS"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "NAMA PESERTA");
        $excel->setActiveSheetIndex(0)->setCellValue('E3', "KELAS");


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        // Buat query untuk menampilkan semua data siswa
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        $where2=array(
            'siswakelas.kdkelas'=>$this->input->post('kdkelas'),
            'siswakelas.idtahunajaran'=>$this->input->post('tahunajaran'),
            'siswa.status'=>1
        );

        $siswa = $this->M_siswa->get_row_join($where2)->result();
        foreach($siswa as $row){ // Ambil semua data dari hasil eksekusi $sql
          $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('B'.$numrow, $row->nisn);
          $excel->setActiveSheetIndex(0)->setCellValueExplicit('C'.$numrow, $row->nis2);
          $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->nama);
          $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow,  $row->kdkelas);
          
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
header('Content-Disposition: attachment; filename="rombel siswa.xlsx"');
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