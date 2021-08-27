<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class jadwalpelajaran extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
        $this->session->set_userdata(array('menu'=>'29','katmenu'=>'7'));

    }
    

    public function index(){

        $hari=date('w');
        $daftar_hari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');

        $where2=array(
            'k.kdkelas'=>$this->session->kdkelas,
            'j.semester'=>$this->session->semester,
            's.idtahunajaran'=>$this->session->tahun,
            's.hari'=>$daftar_hari[$hari],
            "CONVERT(s.start_time,TIME) <= " => date("H:i:s"),
            
        );

        $having=array(
            "CONVERT(waktu,TIME) >= " => date("H:i:s")
        );

        $data['jadwal2']=$this->M_jadwal->get_row_join4($where2,$having);
        if($data['jadwal2']->num_rows()>0){
            $data['row']=$data['jadwal2']->row();
            $val=$data['row']->idjadwal;
        }else{
            $data['row']="";
            $val="";
        }

        $data2=array(
            'token'=>$this->token(),
            'timetoken'=>date('Y-m-d H:i:s')
        );
        $this->M_jadwal->update(array('idjadwal'=>$val),$data2);

        $where=array(
            'k.kdkelas'=>$this->session->kdkelas,
            'j.semester'=>$this->session->semester,
            's.idtahunajaran'=>$this->session->tahun
        );

        $data['jadwal'] = $this->M_jadwal->get_row_join5($where)->result();


        
        $this->template->admin('page/view_jadwal_siswa',$data);
    }

    public function simpan(){

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
                    "kdkelas"=>$this->input->post('kdkelas'),
                    "kdmatpel"=>$this->input->post('matpel'),
                    "kdguru"=>$this->session->kdguru,
                    "idsetjadwal"=>$row->idsetjadwal,
                    "pekan"=>$this->input->post('pekan'),
                );
                $query = $this->M_jadwal->get_row($where);
                $cek=$query->num_rows();
                
                if($cek < 1){
                    $data=array(
                        "kdkelas"=>$this->input->post('kdkelas'),
                        "kdmatpel"=>$this->input->post('matpel'),
                        "kdguru"=>$this->session->kdguru,
                        "pekan"=>$this->input->post('pekan'),
                        "idsetjadwal"=>$row->idsetjadwal,
                        "jml_jam"=>$this->input->post('jml'),                                      
                    );
                    $queri=$this->M_jadwal->add($data);
                    if($queri==TRUE){
                        $this->session->set_flashdata('info',"Data berhasil disimpan");
                    }else{
                        $this->session->set_flashdata('info',"Data gagal disimpan");
                    }
                    
                }else{
                    $this->session->set_flashdata('info',"Data Tidak Tersimpan");
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
            "idjadwal"=>$id,
        );
        $queri=$this->M_jadwal->delete($where);
        if($queri==TRUE){
            $this->session->set_flashdata('info',"Data telah dihapus");
        }else{
            $this->session->set_flashdata('info',"Data gagal dihapus");
        }
        redirect("page/jadwalmengajar");
    }

    public function token(){
        //jumlah panjang karakter angka dan huruf.
        $length_abjad = "2";
        $length_angka = "4";

        //huruf yg dimasukan, kecuali I,L dan O
        $huruf = "ABCDEFGHJKMNPRSTUVWXYZ";

        //mulai proses generate huruf
        $i = 1;
        $txt_abjad = "";
        while ($i <= $length_abjad) {
            $txt_abjad .= $huruf{mt_rand(0,strlen($huruf))};
            $i++;
        }

        //mulai proses generate angka
        $datejam = date("His");
        $time_md5 = rand(time(), $datejam);
        $cut = substr($time_md5, 0, $length_angka);	

        //mennggabungkan dan mengacak hasil generate huruf dan angka
        $acak = str_shuffle($txt_abjad.$cut);

        

        return $acak;
    }

   
}