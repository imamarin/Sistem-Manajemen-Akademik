<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class materi extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->library(array('template','form_validation'));
        $this->load->helper('url');
    }
    
    public function index(){
        $where=array(
          'kdguru'=>$this->session->kodeguru,
        );
        $queri=$this->M_tugas->get_row($where)->result();
        foreach ($queri as $key => $v) {
            # code...
            $data['file'][$key] = $this->M_tugas->getModuls($v->idtugas)->result();    
        }

        $data['tugas']=$queri;
		$this->template->guru('guru/view_list_tugas',$data);
    }

    public function add(){
        $data=array(
            "form_action"=>"guru/materi/simpan/",
            'judul' => set_value('judul',''),
            'deskripsi' => set_value('deskripsi',''),
        );
        $this->template->guru('guru/view_add_tugas',$data);
    }

    function simpan(){
        $hsl="";
        $statusMsg1="";
        $statusMsg2="";
        $statusMsg3="";
        $data=array(
            'judul'=>$this->input->post('judul'),
            'deskripsi'=>$this->input->post('deskripsi'),
            'kdguru'=>$this->session->kodeguru
        );
        $simpan=$this->M_tugas->simpan($data);

        $statusMsg1 = "Data Tersimpan";
       
        
        $where=array(
            'judul'=>$this->input->post('judul'),
            'kdguru'=>$this->session->kodeguru
        );
        $queri=$this->M_tugas->get_row($where);
        $q=$queri->row();

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
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc|ppt|pptx|jpeg'; 
                $config['file_name']=$q->idtugas."-".date('Ymdhis');
                $config['max_size']= 3024;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('upload_File')){
                    $fileData = $this->upload->data();
                    $uploadData[$i]['file'] = $fileData['file_name'];
                    $uploadData[$i]['type'] = $fileData['file_type'];
                    $uploadData[$i]['idtugas'] = $q->idtugas;
                    $statusMsg2 = $statusMsg2."File ".$fileData['file_name']." Terkirim<br>";
                }else{
                    $statusMsg2 = $statusMsg2."File ".$_FILES['upload_Files']['name'][$i]." Tidak Terkirim <br>";
                }
            }            
            if(!empty($uploadData)){
                //Insert file information into the database
                $insert = $this->M_tugas->simpan_modul($uploadData);
 
            }
            
        }
        
        $this->session->set_flashdata('statusMsg1',$statusMsg1);
        $this->session->set_flashdata('statusMsg2',$statusMsg2);
        $this->session->set_flashdata('statusMSg3',$statusMsg3);
        $data=array(
            "form_action"=>"guru/materi/simpan/",
            'judul' => set_value('judul',$this->input->post('judul')),
            'deskripsi' => set_value('deskripsi','deskripsi'),
        );
        redirect('guru/materi');
    }

    public function modulView($f){
        $tipe=explode(".",$f);
        $file=strtolower($tipe[count($tipe)-1]);
        if($file=="jpg" || $file=="png" || $file=="gif" || $file=="jpeg"){
           ?>
           <img src="<?php echo base_url('uploads/files/'.$f); ?>" alt="" style="">
            <?php
        }else if($file=="pdf"){
          echo "<iframe src='".base_url()."uploads/files/".$f."' width='100%' height='100%' frameborder='0'></iframe>";    
          //echo "<embed src = '".base_url()."uploads/files/".$f."' type = 'application/pdf' width='100%' height = '700px'/>";
        }else{
            //echo "<iframe src='https://drive.google.com/viewerng/viewer?url=".base_url()."uploads/files/".$f."&a=v&chrome=true&embedded=true' width='100%' height='100%' frameborder='0'></iframe>";
            echo "<embed src = 'https://view.officeapps.live.com/op/embed.aspx?src=".base_url()."uploads/files/".$f."' width='100%' height = '100%;' frameborder='0'/>";
        }
        //echo "<embed src = 'https://view.officeapps.live.com/op/embed.aspx?src=".base_url()."uploads/files/".$f."' width='100%' height = '100%;' frameborder='0'/>";
        //echo "<embed src = '".base_url()."uploads/files/".$f."' type = 'application/pdf' width='100%' height = '700px'/>";
    }

    public function edit($n=NULL){
      $row=$this->M_tugas->get_row(array('idtugas'=>$n))->row();
      $data=array(
        "form_action"=>"guru/materi/update/".$n,
        'judul' => set_value('judul',$row->judul),
        //'tglpublish' => set_value('tglpublish',$row->tgl_awal),
        //'endtime' => set_value('endtime',$row->tgl_akhir),
        'deskripsi' => set_value('deskripsi',$row->deskripsi),
      );

      $data['file'] = $this->M_tugas->getModuls($n)->result();
      $this->template->guru('guru/view_add_tugas',$data);
    }
    
    public function update($n=NULL)
    {
        $data=array(
              'judul' => $this->input->post('judul'),
              'deskripsi' => $this->input->post('deskripsi'),
        );
        $this->M_tugas->update($n,$data);

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
                $config['allowed_types'] = 'gif|jpg|png|pdf|docx|doc|pptx|ppt|jpeg'; 
                $config['file_name']=$n."-".date('Ymdhis');
                $config['max_size']= 3024;
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
                $where4=array(
                'idtugas'=>$n
                );
                $_id = $this->db->get_where('modul_tugas',$where4)->result();
                foreach($_id as $del){
                    $query = $this->db->delete('modul_tugas',$where4);
                    if($query){
                        unlink("uploads/files/".$del->file);
                    }
                }
                //$this->M_tugas->hapusmodul($where);
                
                $insert = $this->M_tugas->simpan_modul($uploadData);
                $statusMsg = $insert?'Files uploaded successfully.':'Some problem occurred, please try again.';
                $this->session->set_flashdata('statusMsg',$statusMsg);
            }
        }
        redirect('guru/materi/edit/'.$n);      
    }

    public function hapus($n=NULL){
      $this->M_tugas->delete(array('idtugas'=>$n));
      $where4=array(
                'idtugas'=>$n
                );
                $_id = $this->db->get_where('modul_tugas',$where4)->result();
                foreach($_id as $del){
                    $query = $this->db->delete('modul_tugas',$where4);
                    if($query){
                        unlink("uploads/files/".$del->file);
                    }
                }
      redirect('guru/materi');
    }

    public function setting($set=NULL,$n=NULL, $t1=NULL, $t2=NULL,$th=NULL){
        if($set=="edit"){
            $t1=str_replace("%20", " ", $t1);
            $t2=str_replace("%20", " ", $t2);
            $where=array(
            'idtugas'=>$n,
            "DATE_FORMAT(tgl_awal,'%Y-%m-%d %H:%i:%s')="=> date("Y-m-d H:i:s",strtotime($t1)),
            "DATE_FORMAT(tgl_akhir,'%Y-%m-%d %H:%i:%s')="=> date("Y-m-d H:i:s",strtotime($t2))
            );
            $where2=array(
            'group_tugas.idtugas'=>$n,
            );
            $data=array(
                'form_action'=>'guru/materi/updatemateri/'.$n.'/'.$t1.'/'.$t2.'/'.$th,
                'kelas'=>$this->M_kelas->get_all()->result(),
                'tahunajaran'=>$this->M_tahunajaran->get_all()->result(),
                'kelasmateri'=>$this->M_tugas->getRowGroups($where)->result_array(),
                'kelasmateri2'=>$this->M_tugas->getRowGroups($where2)->result_array(),    
                'waktu'=>$this->M_tugas->getRowGroups2($where2)->result(),
                'tglpublish'=>str_replace(" ","T",$t1),
                'endtime'=>str_replace(" ","T",$t2),
                'thnajar'=>$th

            );
            $this->template->guru('guru/view_modul',$data);
           
        }elseif($set=="hapus"){
            $t1=str_replace("%20", " ", $t1);
            $t2=str_replace("%20", " ", $t2);
            $where=array(
            'idtugas'=>$n,
            "DATE_FORMAT(tgl_awal,'%Y-%m-%d %H:%i:%s')="=> date("Y-m-d H:i:s",strtotime($t1)),
            "DATE_FORMAT(tgl_akhir,'%Y-%m-%d %H:%i:%s')="=> date("Y-m-d H:i:s",strtotime($t2))
            );
            $this->M_tugas->hapusGroups($where);
            redirect(base_url().'guru/materi/setting/view/'.$n.'/'.$t1.'/'.$t2);
        }else{
            $where=array(
            'idtugas'=>$n,
            );

            $data=array(
                'form_action'=>'guru/materi/addmateri/'.$n.'/'.$t1.'/'.$t2.'/'.$th,
                'kelas'=>$this->M_kelas->get_all()->result(),
                'tahunajaran'=>$this->M_tahunajaran->get_all()->result(),
                'kelasmateri'=>array(),
                'kelasmateri2'=>$this->M_tugas->getRowGroups($where)->result_array(),    
                'waktu'=>$this->M_tugas->getRowGroups2($where)->result(),
                'tglpublish'=>'',
                'endtime'=>''

            );
            $this->template->guru('guru/view_modul',$data);
        }
        
    }

    

    public function addmateri($n=NULL, $j=NULL, $t1=NULL, $t2=NULL){
            
            $kelas=$this->input->post('kelas');
            $tgl1=$this->input->post('tglpublish');
            $tgl2=$this->input->post('endtime');
            foreach($kelas as $k){
                $where=array(
                    'idtugas'=>$n,
                    'kdkelas'=>$k,
                    "DATE_FORMAT(tgl_awal,'%Y-%m-%d')"=> date("Y-m-d",strtotime($tgl1)),
                    "DATE_FORMAT(tgl_akhir,'%Y-%m-%d')"=> date("Y-m-d",strtotime($tgl2)),
                    'idtahunajaran'=>2
                );
                $q=$this->M_tugas->getRowGroups($where);
                if($q->num_rows()<1){
                    $data2=array(
                        'idtugas'=>$n,
                        'kdkelas'=>$k,
                        'tgl_awal'=>$tgl1,
                        'tgl_akhir'=>$tgl2,
                        "idtahunajaran"=> '2',
                    );
                    $this->M_tugas->simpanGroups($data2);
                }
                
               
            }

        redirect(base_url().'guru/materi/setting/view/'.$n);
                                                                   
    }

    public function updatemateri($n=NULL, $t1=NULL, $t2=NULL,$th=NULL){

        $where=array(
            'idtugas'=>$n,
            "DATE_FORMAT(tgl_awal,'%Y-%m-%d')"=> $t1,
            "DATE_FORMAT(tgl_akhir,'%Y-%m-%d')"=> $t2,
            'idtahunajaran'=>$th
        );
        $this->M_tugas->hapusGroups($where);

        $kelas=$this->input->post('kelas');
        $tgl1=$this->input->post('tglpublish');
        $tgl2=$this->input->post('endtime');
        foreach($kelas as $k){
                $where=array(
                    'idtugas'=>$n,
                    'kdkelas'=>$k,
                    "DATE_FORMAT(tgl_awal,'%Y-%m-%d')"=> date("Y-m-d",strtotime($tgl1)),
                    "DATE_FORMAT(tgl_akhir,'%Y-%m-%d')"=> date("Y-m-d",strtotime($tgl2)),
                    "idtahunajaran"=> $th,
                );
                $q=$this->M_tugas->getRowGroups($where);
                if($q->num_rows()<1){
                    $data2=array(
                        'idtugas'=>$n,
                        'kdkelas'=>$k,
                        'tgl_awal'=>$tgl1,
                        'tgl_akhir'=>$tgl2,
                        'idtahunajaran'=>$th
                    );
                    $this->M_tugas->simpanGroups($data2);
                }
           
        }

        redirect(base_url().'guru/materi/setting/view/'.$n.'/'.$j.'/'.$t1.'/'.$t2);
                                                                   
    }

    public function hapusmodul($n=NULL,$m=NULL){
       
        $where=array(
            'idmodul'=>$m
        );
        $_id = $this->db->get_where('modul_tugas',$where)->row();
        //$this->M_tugas->hapusmodul($where);
        $query = $this->db->delete('modul_tugas',$where);
            if($query){
                unlink("uploads/files/".$_id->file);
            }
        
        
        redirect('guru/materi/edit/'.$n.'/'.$j);
    }

   public function downloadfile($f=NULL){
        redirect("uploads/files/".$f);
    }

    public function validasi_form(){
      $this->form_validation->set_rules('hari','HARI','required');
      $this->form_validation->set_rules('jam','JAM','required');
      $this->form_validation->set_rules('matpel','MATA PELAJARAN','required');
      $this->form_validation->set_rules('kelas','KELAS','required');
    }

}