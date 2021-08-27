<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox'  && !(checkboxes[i].disabled) ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
       }
   }

   function hapus(id){
    s=window.confirm("Hapus Data ini");
    if(s){
      document.location="<?= base_url().$hapus_action ?>"+id;
    }
  }

  function eksport(){
    document.location="<?= base_url()?>page/walikelas/eksport";
  }

 </script>
<?php
function tgl_indo($t){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $t);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row" style="padding-top: 1%;">
            <div class="col-12">
                <?php if($this->session->flashdata('info')){ ?>
                <div class="alert alert-info">  
                   <a href="#" class="close" data-dismiss="alert">&times;</a>  
                   <?php echo $this->session->flashdata('info'); ?>  
                </div>  
                <?php } ?>
            </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rekap Kehadiran Guru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kehadiran Guru</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    

    <section class="content">
      
      <div class="row">
             
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
           
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
         
                <table class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Tanggal Jadwal Mengajar</th>
                      <?php
                      for($no=1;$no<=10;$no++){
                      ?>
                        <th>Jam ke- <?= $no ?></th>
                      <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $jml=0;
                    $kls="";
                    $stt="";
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
                    
                    
                    $tgl="2021-01-18";
                    $tanggal1 = date('Y-m-d',strtotime($tgl));
                    $tanggal2 = date('Y-m-d');
                    
                    while ($tanggal2 >= $tanggal1) {
                      $namahari2 = date('l', strtotime($tanggal2));
                      if(in_array($daftar_hari[$namahari2], $tggl)){
                      ?>
                      <tr>
                        <td><?php echo $no; ?></td>
                        <td><b><?php echo tgl_indo($tanggal2); ?></b></td>
                        <?php
                        $namahari = date('l', strtotime($tanggal2));
                        $set=1;
                        foreach($setjadwal as $s){
                          if($s->hari==$daftar_hari[$namahari]){
                              ?>
                                  <td>
                                  <?php
                                
                                  foreach($jadwal as $j){
                                      if($s->idsetjadwal==$j->idsetjadwal OR $jml > 0 ){
                                      
                                        if($jml<=0){
                                            $jml=$j->jml_jam;
                                            $kls=$j->kdkelas;  
                                            if(isset($absensi[$j->idjadwal])){
                                              $stt=in_array($tanggal2,$absensi[$j->idjadwal]);
                                            }else{
                                              $stt=FALSE;
                                            }                                       
                                        }

                                        

                                        if($stt==TRUE){
                                            ?>
                                            <button class="btn btn-success"><?= $kls." " ?></button>
                                            <?php
                                        }else{
                                            ?>
                                            <button class="btn btn-danger"><?= $kls." " ?></button>
                                            <?php
                                        }
                                        
                                        break;
                                      }
                                    
                                  }
                                  ?>
                                  </td> 
                              <?php
                              $jml--;
                          }
                          
                        }
                        ?>
                      </tr>
                      <?php
                      
                      $no++;
                        }
                      $tanggal2 = date('Y-m-d',strtotime('-1 days',strtotime($tanggal2)));
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/walikelas/upload' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">UPLOAD FILE EXCEL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="file" name="userfile" class="form-control">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit" value="import">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


