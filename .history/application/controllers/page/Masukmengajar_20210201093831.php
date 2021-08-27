<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class masukmengajar extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'13','katmenu'=>'4'));

    }
    

    public function index(){
        $where=array(
            'g.kdguru'=>$this->session->kdguru,
            'j.semester'=>$this->session->semester,
            's.idtahunajaran'=>$this->session->tahun
        );

        $where2=array(
            'guru.kdguru'=>$this->session->kdguru
        );
        $data['jadwal'] = $this->M_jadwal->get_row_join($where)->result();
        $data['kelas'] = $this->M_kelas->get_all_join()->result();
        $data['tahun'] = $this->M_tahunajaran->get_all()->result();
        $data['matpel'] = $this->M_matpelguru->get_row_join($where2)->result();
        $this->template->admin('page/view_masuk_mengajar',$data);
    }

    public function absensisiswa(){
        if($this->input->post('submit') || $this->input->post('lihat') || $this->input->post('ajuan')){
            $this->simpan2();
            /*
            $where = array(
                "idjadwal"=>$this->input->post('h_idjadwal'),
                "DATE_FORMAT(timetoken,'%Y-%m-%d')" => date("Y-m-d"),
                "token"=>$this->input->post('token')
            );
            */
            //$query=$this->M_jadwal->get_row($where);
            //if(($this->input->post('token') && $query->num_rows() > 0) || $this->input->post('ajuan')){

                $where=array(
                    'siswakelas.kdkelas'=>$this->input->post('h_kdkelas'),
                    'siswakelas.idtahunajaran'=>$this->input->post('h_tahun'),
                    'siswa.status'=>1
                );
                if($this->input->post('lihat')){
                    $waktu=date('Y-m-d',strtotime($this->input->post('h_waktu')));
                    $jam=date('H:i:s',strtotime($this->input->post('h_waktu')));
                    $data['lihat']=1;
                    $data['ajuan']=0;
                }else{
                    if($this->input->post('ajuan')){
                        $waktu=date('Y-m-d',strtotime($this->input->post('h_waktu')));
                        $jam="00:00:00";
                        $data['lihat']=0;
                        $data['ajuan']=1;
                    }else{
                        $waktu=date('Y-m-d');
                        $jam=date('H:i:s');
                        $data['lihat']=0;
                        $data['ajuan']=0;
                    }
                }
                
                $data['siswa'] = $this->M_siswa->get_row_join_absen2($where,$this->input->post('h_idjadwal'),$waktu)->result();


                $where2=array(
                    'idtahunajaran'=>$this->input->post('h_tahun')
                );

                $where3=array(
                    'kdmatpel'=>$this->input->post('h_kdmatpel')
                );

                $row=$this->M_tahunajaran->get_row($where2)->row();
                $row2=$this->M_matpel->get_row($where3)->row();

            
                $data['waktu']=$waktu;
                $data['jam']=$jam;
                $data['tahun']=$row->tahun;
                $data['idtahunajaran']=$row->idtahunajaran;
                $data['kdkelas']=$this->input->post('h_kdkelas');
                $data['idjadwal']=$this->input->post('h_idjadwal');
                $data['semester']=$row->semester;
                $data['matpel']=$row2->matpel;
                $data['kdmatpel']=$row2->kdmatpel;
                $data['form_action'] = "page/masukmengajar/absensisiswa";
                $this->template->admin('page/view_absensi_siswa',$data);
            //}else{
              //  redirect('page/masukmengajar');
            //}

        }else{
            redirect('page/masukmengajar');
        }
    }

    function simpan(){
        if($this->input->post('submit')){
            $ket=$this->input->post('ket');
            foreach ($ket as $key => $value) {
                # code...
                echo $value;
            }
        }
    }



    public function simpan2(){

        if($this->input->post('submit')=='simpan'){
            $where=array(
                "DATE_FORMAT(waktu,'%Y-%m-%d')" => date("Y-m-d",strtotime($this->input->post('h_waktu'))),
                "idjadwal"=>$this->input->post('h_idjadwal'),
                "semester"=>$this->input->post('h_semester'),
            );
            $query = $this->M_absen->get_row($where);
            $cek=$query->num_rows();
            
            if($cek < 1){
                if($this->input->post('ajuan')==1){
                    $wkt=date("Y-m-d",strtotime($this->input->post('h_waktu')));
                }else{
                    $wkt=date("Y-m-d H:i:s");
                }

                
                $data=array(
                    "waktu"=>$wkt,
                    "bahasan"=>$this->input->post('bahasan'),
                    "semester"=>$this->input->post('h_semester'),
                    "idjadwal"=>$this->input->post('h_idjadwal'),                
                );
                $this->M_absen->add($data);

                $where=array(
                    "DATE_FORMAT(waktu,'%Y-%m-%d')" => date("Y-m-d", strtotime($wkt)),
                    "idjadwal"=>$this->input->post('h_idjadwal'),
                    "semester"=>$this->input->post('h_semester'),
                );
                $query = $this->M_absen->get_row($where);
                $d=$query->row();

                $nisn=$this->input->post('nisn');
                $ket=$this->input->post('ket');
                $h=0;
                foreach ($nisn as $key => $value) {
                    $data=array(
                        "nisn"=>$value,
                        "keterangan"=>$ket[$key],
                        "idabsensi"=>$d->idabsensi
                    );

                    $where=array(
                        "nisn"=>$value,
                        "idabsensi"=>$d->idabsensi,
                    );  
                    $query = $this->M_absen_detail->get_row($where)->num_rows();
                    if($query<1){
                        $queri=$this->M_absen_detail->add($data); 
                        if($queri==TRUE){
                            $h++;
                        }           
                                        
                    }
                }
                    
            }else{
                $d=$query->row();
                $where=array(
                    "idabsensi"=>$d->idabsensi
                );
                $data=array(
                    //"waktu"=>date("Y-m-d H:i:s"),
                    "bahasan"=>$this->input->post('bahasan'),
                    "idjadwal"=>$this->input->post('h_idjadwal'),                
                );
                $this->M_absen->update($where,$data);

                $nisn=$this->input->post('nisn');
                $ket=$this->input->post('ket');
                $h=0;
                foreach ($nisn as $key => $value) {
                    $data=array(
                        "nisn"=>$value,
                        "keterangan"=>$ket[$key],
                        "idabsensi"=>$d->idabsensi
                    );

                    $where=array(
                        "nisn"=>$value,
                        "idabsensi"=>$d->idabsensi,
                    );  
                    $query = $this->M_absen_detail->get_row($where)->num_rows();
                    if($query<1){
                        $queri=$this->M_absen_detail->add($data); 
                        if($queri==TRUE){
                            $h++;
                        }           
                                        
                    }else{
                        $queri=$this->M_absen_detail->update($where,$data); 
                        if($queri==TRUE){
                            $h++;
                        } 
                    }
                }
            }
        }

    }

    public function update($id=NULL){

        if($this->input->post('submit')){
            $where2=array(
                "hari"=>strtolower($this->input->post('hari')),
                "jam"=>$this->input->post('jam'),
                "idtahunajaran"=>$this->input->post('tahun'),
            );
            $query2 = $this->M_setjadwal->get_row2($where2);
            $cek2=$query2->num_rows();
            $row=$query2->row();
            if($cek2 > 0 ){
                $where=array(
                    "idjadwal"=>$id,
                );
                $query = $this->M_jadwal->get_row($where);
                $cek=$query->num_rows();
                
                if($cek > 0){
                    $data=array(
                        "kdkelas"=>$this->input->post('kdkelas'),
                        "kdmatpel"=>$this->input->post('matpel'),
                        "kdguru"=>$this->session->kdguru,
                        "pekan"=>$this->input->post('pekan'),
                        "idsetjadwal"=>$row->idsetjadwal,
                        "jml_jam"=>$this->input->post('jml'),                                      
                    );
                    $queri=$this->M_jadwal->update($where,$data);
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data berhasil diubah");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal diubah");
                    }
                    
                }
            }else{
                $this->session->set_flashdata('info',"Hari dan jam tidak tersedia");
            }
            

            redirect('page/jadwalmengajar');
            //echo $cek2;

        }else{
            redirect('page/home');
        }

    }

    public function hapus($id=NULL){

        $where=array(
            "kdkelas"=>str_replace("%20", " ", $id),
        );
        $queri=$this->M_kelas->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/kelas");
    }


    //AJUAN MASUK MENGAJAR
    public function ajuan(){
        $where=array(
            'g.kdguru'=>$this->session->kdguru,
            'j.semester'=>$this->session->semester,
            'st.idtahunajaran'=>$this->session->tahun
        );

        $where2=array(
            'guru.kdguru'=>$this->session->kdguru,
            'settahunajaran.status'=>1,
            
        );

        $where3=array(
            'jadwal.kdguru'=>$this->session->kdguru,
            'jadwal.semester'=>$this->session->semester,
            'settahunajaran.idtahunajaran'=>$this->session->tahun
        );
        $data['jadwal'] = $this->M_jadwal->get_row_join($where)->result();
        $data['masuk'] = $this->M_ajuan_masuk_mengajar->get_row_join($where3)->result();
        $data['kelas'] = $this->M_kelas->get_all_join()->result();
        $data['tahun'] = $this->M_tahunajaran->get_row(array('settahunajaran.status'=>1))->result();
        $data['matpel'] = $this->M_matpelguru->get_row_join($where2)->result();
        $data['form_action'] = "page/masukmengajar/simpanajuan";
        $data['hapus_action'] = "page/masukmengajar/hapusajuan/";
        
        $this->template->admin('page/view_ajuan_masuk_mengajar',$data);
    }

    public function simpanajuan(){
        if($this->input->post('submit')){
            if(!empty($_FILES['upload_Files']['name'])){
                $_FILES['upload_File']['name'] = $_FILES['upload_Files']['name']; 
                $_FILES['upload_File']['type'] = $_FILES['upload_Files']['type']; 
                $_FILES['upload_File']['tmp_name'] = $_FILES['upload_Files']['tmp_name'];
                $_FILES['upload_File']['error'] = $_FILES['upload_Files']['error']; 
                $_FILES['upload_File']['size'] = $_FILES['upload_Files']['size']; 
                $uploadPath = 'uploads/ajuanmengajar'; 
                $config['upload_path'] = $uploadPath; 
                $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
                $config['file_name']=$this->input->post('kode').date('Ymdhis');
                $config['max_size']= 5024;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('upload_File')){
                    $fileData = $this->upload->data();
                    $uploadData['file'] = $fileData['file_name'];
                    $uploadData['type'] = $fileData['file_type'];
                }else{
                    $this->session->set_flashdata('info'.$this->upload->display_errors());
                    $uploadData['file'] = "";
                    $uploadData['type'] = "";
                }
            }else{
                $uploadData['file'] = "";
                $uploadData['type'] = "";
            }

            $jadwal = explode("-",$this->input->post('kode'));
            $where2=array(
                "idjadwal" => $jadwal[1], 
                "tgl_mengajar" => $this->input->post('tgl')          
            );
            $query2 = $this->M_ajuan_masuk_mengajar->get_row($where2);
            $cek2=$query2->num_rows();
            $row=$query2->row();
            if($cek2 < 1 ){
                $data = array(
                    "idjadwal" => $jadwal[1], 
                    "tgl_mengajar" => $this->input->post('tgl'),
                    "alasan" => $this->input->post('alasan'),
                    "bukti" => $uploadData['file'],
                );
                $queri=$this->M_ajuan_masuk_mengajar->add($data);
                if($queri==TRUE){
                    $this->session->set_flashdata('info',"Data berhasil disimpan");
                }else{
                    $this->session->set_flashdata('info',"Data gagal disimpan");
                }
                    
            }else{
                $this->session->set_flashdata('info',"Jadwal tersebut sudah diajukan, silahkan cek kembali data ajuan");
            }
            

            redirect('page/masukmengajar/ajuan');
            //echo $cek2;

        }else{
            redirect('page/home');
        }

    }

    public function hapusajuan($id=NULL){
        $where=array(
            "idajuan"=>$id,
        );
        $q= $this->M_ajuan_masuk_mengajar->get_row($where)->row();

        
        $queri=$this->M_ajuan_masuk_mengajar->delete($where);
        if($queri==TRUE){
            unlink("uploads/ajuanmengajar/".$q->bukti);
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/masukmengajar/ajuan");
    }

   
}