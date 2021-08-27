<script type="text/javascript">
  function edit(a,b,c){
    alert(a);
  }
</script>
<?php
$daftar_hari = array('Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
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
            <h1 class="m-0 text-dark">Data Masuk Mengajar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Jadwal</a></li>
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
                Jika ada kendala silahkan ajukan permintaan kehadiran, klik tombol ini <a href="<?= base_url('page/masukmengajar/ajuan') ?>"> <label class="btn btn-primary">Pengajuan</label> </a>
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      
                      <th>Pekan</th>
                      <th>Hari</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jadwal as $b) {
                      ?>
                    <tr>                        
                      <td><?php echo $b->pekan; ?></td>
                      <td><?php echo $b->hari; ?></td>
                      <td><?php echo "Jam ke: ".$b->jam."/ (".$b->start_time.")"; ?></td>
                      <td><?php echo "Jam ke: ".$b->jml."/ (".$b->waktu.")"; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tahun."(".$b->semester.")"; ?></td>
                      <td>
                        <?php 
                        if(in_array("Masuk Mengajar-13", $this->session->fitur)){
                          ?>
                          <form method="post" action="<?= base_url()."page/masukmengajar/absensisiswa/" ?>">
                            <input type="hidden" name="h_kdmatpel" value="<?= $b->kdmatpel ?>">
                            <input type="hidden" name="h_kdkelas" value="<?= $b->kdkelas ?>">
                            <input type="hidden" name="h_tahun" value="<?= $b->idtahunajaran ?>">
                            <input type="hidden" name="h_idjadwal" value="<?= $b->idjadwal ?>">
                            
                            <?php
                            $hari=date('w');
                            if(strtolower($daftar_hari[$hari])==$b->hari && date('H:i:s',strtotime($b->start_time))<=date('H:i:s') && date('H:i:s',strtotime($b->waktu))>=date('H:i:s') ){
                            ?>
                            <!--<input type="text" class="form-control" name="token" value="" placeholder="Masukan Token Input Kehadiran" required><br>-->
                            <button type="submit" name="submit" value="input" class="btn btn-info" name="editmodal<?= $no ?>"><i class="fa fa-edit" style="margin-top: 5px;"></i>Input Kehadiran</button>
                            <?php
                             }
                            ?>
                            
                          </form>  
                          <button class="btn btn-warning" data-toggle="modal" data-target="#modal-default<?= $no ?>" style="margin-top: 5px;">Histori Mengajar</button>
                          <?php
                        }
                        ?>
                      </td>
                    </tr>
                    <?php
                    $no++;
                    } ?></td>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>
  <?php 
              if(in_array("Masuk Mengajar-13", $this->session->fitur)){
                    $no = 1;
                    foreach ($jadwal as $b) {
                  ?>
  <div class="modal fade" id="modal-default<?= $no ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="title">HISTORI JAM MENGAJAR</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                      <table style="width:100%" id="example2" class="table table-bordered table-striped dt-responsive ">
                                        <thead>
                                          <tr>   
                                            <th>Semester</th>
                                            <th>Waktu</th>
                                            <th>Bahasan</th>
                                            <th></th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $where4=array(
                                              "idjadwal"=>$b->idjadwal,
                                          );
                                          $histori = $this->M_absen->get_row($where4)->result();
                                          foreach ($histori as $key => $v) {
                                            # code...
                                            ?>
                                            <tr>
                                              <td><?= $v->semester?></td>
                                              <td><?= $v->waktu ?></td>
                                              <td><?= $v->bahasan ?></td>
                                              <td>
                                              <form method="post" action="<?= base_url()."page/masukmengajar/absensisiswa/" ?>">
                                                <input type="hidden" name="h_kdmatpel" value="<?= $b->kdmatpel ?>">
                                              <input type="hidden" name="h_kdkelas" value="<?= $b->kdkelas ?>">
                                              <input type="hidden" name="h_tahun" value="<?= $b->idtahunajaran ?>">
                                              <input type="hidden" name="h_waktu" value="<?= $v->waktu ?>">
                                              <input type="hidden" name="h_idjadwal" value="<?= $b->idjadwal ?>">
                                                <button type="submit" name="lihat" value="lihat" class="btn btn-info"><i class="fas fa-sign-in-alt"></i></button>
                                              </form>
                                              </td>
                                            </tr>
                                            <?php
                                          }
                                          ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>

                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                          <?php
                        $no++;
                        }
                      }
                        ?>
