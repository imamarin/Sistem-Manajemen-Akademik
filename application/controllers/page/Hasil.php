<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class hasil extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        
    }
    
    public function index(){
        $where=array(
          'tugas.kdguru'=>$this->session->kodeguru,
        );
        $data['tugas']=$this->M_tugas_group->get_all($where)->result();


		$this->template->guru('guru/view_list_tugas_hasil',$data);
    }

    public function kelas($n=NULL,$k=NULl,$t=NULL){
        $where=array(
            'siswakelas.kdkelas'=>str_replace('%20'," ",$k),
            'tugas.idtugas'=>$n,
            'siswakelas.idtahunajaran'=>$t
        );
        $q=$this->M_hasil_tugas->get_all($where);
        $data['kelas']=$q->result();
        $this->template->guru('guru/view_list_nilai',$data);
    }

    public function quiz($n=NULL,$k=NULl,$t=NULL){
        $where=array(
            'siswakelas.kdkelas'=>str_replace('%20'," ",$k),
            'tugas.idtugas'=>$n,
            'siswakelas.idtahunajaran'=>$t
        );
        $q=$this->M_quiz->get_all_kelas($where);
        $data['kelas']=$q->result();

        $where0=array(
              'idtugas'=>$n,
        );
        $queri= $this->M_tugas->get_row($where0)->row();
        $data['judul']=$queri->judul;
        $data['idtgs']=$n;
        $data['kls']=$k;
        $this->template->guru('guru/view_list_nilai_quiz',$data);
    }

    public function analisquiz($n=NULL,$k=NULL,$s=NULLL){
        $where0=array(
              'siswa.nis'=>$s,
        );
        $queri= $this->M_siswa->get_row($where0)->row();
        $data['nama']=$queri->nama;

        $queri4=$this->M_quiz->get_row(array("quiz.idtugas"=>$n));
        if($queri4->num_rows()>0){
            //cek judul
            $where0=array(
              'idtugas'=>$n,
            );
            $queri= $this->M_tugas->get_row($where0)->row();
            $data['judul']=$queri->judul;

            

            //cek jawaban
            $where=array(
                'quiz.idtugas'=> $n,
                'jawaban.nis'=> $s,
            );

            $nilaiakhir=0;
            $nilai=0;
            $jml=0;
            $queri2=$this->M_quiz->get_row_soal2($where)->result();
            foreach ($queri2 as $key => $v) {
                # code...
                if($v->jawaban == $v->jwbuser){
   
                    $nilai=$nilai+1;
                }else{
  
                }
                $jml++;

                $where2=array(
                    'quiz.idquiz'=> $v->idquiz,
                );
                $data['pg'][]=$this->M_quiz->get_row_pg($where2)->result();
                $data['jawaban'][]=$v->jwbuser;
                $data['benar'][]=$v->jawaban;

            }
            if($jml!=0){
                $nilaiakhir=ceil(($nilai*100)/$jml);
            }else{
                $nilaiakhir=0;
            }

            $data['nilaiakhir']=$nilaiakhir;
            //cek hasil quiz
            $where3=array(
              'idtugas'=>$n,
              'nis'=>$s
            );
            

            $data['soal']=$queri2;
            $data['form_action']="siswa/quiz/cekJawaban/".$n;
            $data['idtugas']=$n;
            $this->template->guru("guru/view_cek_jawaban",$data);
        }else{
            redirect('guru/hasil/quiz/'.$n.'/'.$k);
        }
    }

    public function nilai($n=NULL,$k=NULl){
        $where=array(
            'hasil_tugas.nis'=>$k,
            'hasil_tugas.idtugas'=>$n
        );
        $q=$this->M_hasil_tugas->get_all($where);
        $hasil=$q->row();
        $data['form_action']="guru/hasil/simpanhasil/".$n.'/'.$k;
        $data['deskripsi']=$hasil->deskripsi;
        $data['file']=$hasil->upload_tugas;
        $data['nama']=strtoupper($hasil->nama);
        $data['nis']=$hasil->nis;
        $data['idtugas']=$n;
        $data['nilai']=$hasil->nilai;
        $data['catatan']=$hasil->catatan;
        $this->template->guru('guru/view_input_nilai',$data);
    }

    public function simpanhasil($n=NULL,$k=NULL){
        $where=array(
            "hasil_tugas.idtugas"=>$n,
            "hasil_tugas.nis"=>$k
        );

        $q=$this->M_hasil_tugas->get_all($where);
        if($q->num_rows()>0){
          $data=array(
            'nilai' => $this->input->post('nilai'),
            'catatan' => $this->input->post('catatan'),
          );
          $this->M_hasil_tugas->update($where,$data);
        }
          
        $d=$q->row();
        redirect('guru/hasil/kelas/'.$n.'/'.$d->kdkelas,$data);
    }

    function simpan(){
        $data=array(
            'judul'=>$this->input->post('judul'),
            'tgl_awal'=>$this->input->post('tglpublish'),
            'tgl_akhir'=>$this->input->post('endtime'),
            'deskripsi'=>$this->input->post('deskripsi'),
            'kdguru'=>$this->session->kodeguru
          );
        
          
        $this->M_tugas->simpan($data);
        redirect('guru/tugas');

    }

    

    public function edit($n=NULL){
      $row=$this->M_tugas->get_row(array('idtugas'=>$n))->row();
      $data=array(
        "form_action"=>"guru/tugas/update/".$n,
        'judul' => set_value('judul',$row->judul),
        'tglpublish' => set_value('tglpublish',$row->tgl_awal),
        'endtime' => set_value('endtime',$row->tgl_akhir),
        'deskripsi' => set_value('deskripsi',$row->deskripsi),
      );
      $this->template->guru('guru/view_add_tugas',$data);
    }
    
    public function update($n=NULL)
    {
        $data=array(
              'judul' => $this->input->post('judul'),
              'tgl_awal' => $this->input->post('tglpublish'),
              'tgl_akhir' => $this->input->post('endtime'),
              'deskripsi' => $this->input->post('deskripsi'),
        );
        $this->M_tugas->update($n,$data);
        redirect('guru/tugas');      
    }

    public function hapus($n=NULL){
      $this->M_tugas->delete(array('idtugas'=>$n));
      redirect('guru/tugas');
    }

    public function modul($n=NULL, $j=NULL){
        $where=array(
            'idtugas'=>$n,
        );

        $data=array(
            'form_action'=>'guru/tugas/simpan_modul/'.$n.'/'.$j,
            'jdl'=>$j,
            'kelas'=>$this->M_kelas->get_all()->result(),
            'kelasmodul'=>$this->M_tugas->getRowGroups($where)->result_array()

        );
        $data['file'] = $this->M_tugas->getModuls($n)->result();
        $this->template->guru('guru/view_modul',$data);
    }

    public function simpan_modul($n=NULL,$j=NULL){
        $data = array();

        $where=array(
            'idtugas'=>$n,
        );
        $this->M_tugas->hapusGroups($where);
        $kelas=$this->input->post('kelas');
        foreach($kelas as $k){
            $data2=array(
                'idtugas'=>$n,
                'kdkelas'=>$k
            );
            $this->M_tugas->simpanGroups($data2);
           
        }

        
        if($this->input->post('submit') && !empty($_FILES['upload_Files']['name'])){
            $filesCount = count($_FILES['upload_Files']['name']);
            for($i = 0; $i < $filesCount; $i++){ 
                //$_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i]; 
                $_FILES['upload_File']['name'] = $_FILES['upload_Files']['name'][$i]; 
                $_FILES['upload_File']['type'] = $_FILES['upload_Files']['type'][$i]; 
                $_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'][$i];
                $_FILES['upload_File']['error'] = $_FILES['upload_Files']['error'][$i]; 
                $_FILES['upload_File']['size'] = $_FILES['upload_Files']['size'][$i]; 
                $uploadPath = 'uploads/files/'; 
                $config['upload_path'] = $uploadPath; 
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc|jpeg'; 
                $config['file_name']=$n."-".date('Ymdhis');
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('upload_File')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file'] = $fileData['file_name'];
                    $uploadData[$i]['type'] = $fileData['file_type'];
                    $uploadData[$i]['idtugas'] = $n;
                }
            }            
            if(!empty($uploadData)){
                //Insert file information into the database
                $insert = $this->M_tugas->simpan_modul($uploadData);
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg',$statusMsg);
            }
        }

        redirect('guru/tugas/modul/'.$n.'/'.$j);
                                                                   
    }

    public function hapusmodul($n=NULL,$j=NULL,$m=NULL){
        $where=array(
            'idmodul'=>$m
        );
        $this->M_tugas->hapusmodul($where);
        redirect('guru/tugas/modul/'.$n.'/'.$j);
    }



    public function view($f=NULL){
        $tipe=explode(".",$f);
        $file=strtolower($tipe[count($tipe)-1]);
        if($file=="jpg" || $file=="png" || $file=="gif" || $file=="jpeg"){
           ?>
           <img src="<?php echo base_url('uploads/tugas/'.$f); ?>" alt="" style="">
            <?php
        }else{
         //echo "<embed src = 'https://view.officeapps.live.com/op/embed.aspx?src=".base_url()."uploads/tugas/".$f."' frameborder='0'/>";
        echo "<iframe src='https://drive.google.com/viewerng/viewer?url=".base_url()."uploads/tugas/".$f."&a=v&chrome=false&embedded=true' width='100%' height='100%' frameborder='0'></iframe>";
      //echo "<embed src = '".base_url()."uploads/tugas/".$f."' type = 'application/pdf' width='100%' height = '700px'/>";
        }
    }

    public function lapexcel($n=NULL,$k=NULl){
      $where=array(
            'siswakelas.kdkelas'=>str_replace('%20'," ",$k),
            'tugas.idtugas'=>$n
        );
        $q=$this->M_quiz->get_all_kelas($where);
        $data['kelas']=$q->result();

        $where0=array(
              'idtugas'=>$n,
        );
        $queri= $this->M_tugas->get_row($where0)->row();
        $data['judul']=$queri->judul;
        $data['idtgs']=$n;
        $data['kls']=$k;
        $this->load->view('guru/view_list_nilai_quiz_excel',$data);
    }

    public function laporan_print(){
      $data['mitra']=$this->M_mitra->get_all()->result();
      $this->load->view('guru/view_laporan_print_mitra',$data);
    }

    public function laporan_pdf(){
      $this->load->library('dompdf_gen');

      $data['mitra']=$this->M_mitra->get_all()->result();
      $this->load->view('guru/view_laporan_pdf_mitra',$data);

      $paper_size  = 'A4'; // ukuran kertas
      $orientation = 'landscape'; //tipe format kertas potrait atau landscape
      $html = $this->output->get_output();

      $this->dompdf->set_paper($paper_size, $orientation);
      //Convert to PDF
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream("laporan_data_mitra.pdf", array('Attachment'=>0));
    }

    public function akun($id=NULL){

      $row=$this->M_mitra->get_akun_row(array('mitra.kodemitra'=>$id))->row();
      if($row->iduser==0){
         $data=array(
        "action_form"=>"guru/mitra/akunadd/".$id,
        'username' =>  set_value('username'),
        'password' => set_value('password')
        );
      }else{
        $data=array(
        "action_form"=>"guru/mitra/akunupdate/".$row->iduser,
        'username' =>  set_value('username',$row->username),
        'password' => set_value('password',$row->password)
        );
      }

      $this->template->guru('guru/v_add_akun',$data);
    }

    public function akunadd($id=NULL){

      $where=array(
            'user.username' => $this->input->post('username')
            );
      echo $this->M_mitra->get_user($where)->num_rows();
      if($this->M_mitra->get_user($where)->num_rows()<1){
        $data=array(
          'username' => $this->input->post('username'),
          'password' => sha1($this->input->post('password')),
          'level'=>'mitra'
        );
        $this->M_mitra->akunadd($data);
        $where=array(
            'user.username' => $this->input->post('username'),
            'user.password' => sha1($this->input->post('password'))
        );
        $row=$this->M_mitra->get_user($where)->row(); 
        $this->M_mitra->update($id,array('iduser'=>$row->id_user));
        $this->session->set_flashdata('alert','Data Berhasil disimpan');
        redirect('guru/mitra/');
      }else{
        $this->session->set_flashdata('alert','Data gagal disimpan');
        redirect('guru/mitra/akun/'.$id);
      }
       
      
    }

    public function akunupdate($id=NULL){
      $data=array(
            'username' => $this->input->post('username'),
            'password' => sha1($this->input->post('password'))
        );
      $this->M_mitra->akunupdate($id,$data);
    }

    public function reset($id=NULL,$kd=NULL){
      $data=array(
            'password' => sha1($kd)
        );
      $this->M_user->update2($id,$data);
    }


    public function export($n=NULL,$k=NULl){
    // Load plugin PHPExcel nya
    include APPPATH.'third_party/PHPExcel/PHPExcel.php';
    $where0=array(
              'idtugas'=>$n,
        );
        $queri= $this->M_tugas->get_row($where0)->row();
     $judul=$queri->judul;

    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('My Notes Code')
                 ->setLastModifiedBy('My Notes Code')
                 ->setTitle($judul)
                 ->setSubject("Siswa")
                 ->setDescription("Laporan Data Nilai Quiz")
                 ->setKeywords("Data Nilai");
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
    $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "NIS"); // Set kolom B3 dengan tulisan "NIS"
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "KELAS"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "NILAI"); // Set kolom E3 dengan tulisan "ALAMAT"
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    $where=array(
            'siswakelas.kdkelas'=>str_replace('%20'," ",$k),
            'tugas.idtugas'=>$n
        );
    $q=$this->M_quiz->get_all_kelas($where);
    $quiz=$q->result();
    $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
    foreach($quiz as $data){ // Lakukan looping pada variabel siswa
      $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
      $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->nis);
      $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->nama);
      $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->kdkelas);
      $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->hasil);
      
      // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
      $excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
      $excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);
      
      $no++; // Tambah 1 setiap kali looping
      $numrow++; // Tambah 1 setiap kali looping
    }
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(5); // Set width kolom A
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); // Set width kolom B
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(25); // Set width kolom C
    $excel->getActiveSheet()->getColumnDimension('D')->setWidth(20); // Set width kolom D
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(30); // Set width kolom E
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Laporan Data Siswa");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Data Siswa.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
  }

    public function validasi_form(){
      $this->form_validation->set_rules('hari','HARI','required');
      $this->form_validation->set_rules('jam','JAM','required');
      $this->form_validation->set_rules('matpel','MATA PELAJARAN','required');
      $this->form_validation->set_rules('kelas','KELAS','required');
    }

}