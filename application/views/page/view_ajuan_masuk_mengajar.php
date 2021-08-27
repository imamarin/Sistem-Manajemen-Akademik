<script type="text/javascript">
  function edit(x,a,b,c,d,e,f,g,h){

    $("[name='kode']").val(b+"-"+h).trigger('change');
    //selectItemByValue(document.getElementsByName("pekan")[0],"2");
    //document.getElementsByName("pekan")[0].value=2;

    document.getElementById("title").innerHTML="Ajuan Masuk Mengajar";
    document.getElementById("btn").innerHTML="Ajukan";
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-target","#modal-default");
    //document.getElementsByName("coba"+x)[0].value="aaaaaaaaaaa";
    //alert("sadsad");
  }

  function hapus(id){
    s=window.confirm("Hapus Data ini");
    if(s){
      document.location="<?= base_url().$hapus_action ?>"+id;
    }
  }
</script>
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
            <h1 class="m-0 text-dark">Ajukan Masuk Mengajar</h1>
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
            <div class="card-header">
              <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Jadwal</th>
                      <th>Tanggal Kendala Mengajar</th>
                      <th>Alasan</th>
                      <th>Bukti</th>
                      <th>Balasan/Tanggapan</th>
                      <th>Hasil Pengajuan</th>
                      <th>Pilih</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                      foreach($masuk as $v){
                        ?>
                        <tr>
                          <td><?= $no++ ?></td>
                          <td><?= $v->kdmatpel."-".$v->idjadwal ?></td>
                          <td><?= $v->tgl_mengajar ?></td>
                          <td><?= isset($v->alasan)?$v->alasan:"-" ?></td>
                          <td>
                            <?php
                              if($v->bukti!=""){
                                ?>
                                <a href="<?= base_url('uploads/ajuanmengajar/').$v->bukti ?>" download>Download Bukti</a>
                                <?php
                              }else{
                                echo "-";
                              }
                            ?>
                          </td>
                          <td><?= ($v->tanggapan!="")?$v->tanggapan:"-" ?></td>
                          <td>
                            <?php
                              if($v->status==0){
                                ?>
                                  <label class="btn btn-info">Baru</label>
                                <?php
                              }else if($v->status==1){
                                ?>
                                  <label class="btn btn-warning">Proses</label>
                                <?php
                              }else if($v->status==2){
                                ?>
                                  <label class="btn btn-success">Terima</label>
                                <?php
                              }else if($v->status==3){
                                ?>
                                  <label class="btn btn-danger">Tolak</label>
                                <?php
                              }
                            ?>
                          </td>
                          <td>
                            <?php
                            if($v->status==2){
                              ?>
                              <form method="post" action="<?= base_url()."page/masukmengajar/absensisiswa/" ?>">
                              <input type="hidden" name="h_kdmatpel" value="<?= $v->kdmatpel ?>">
                              <input type="hidden" name="h_kdkelas" value="<?= $v->kdkelas ?>">
                              <input type="hidden" name="h_tahun" value="<?= $v->idtahunajaran ?>">
                              <input type="hidden" name="h_idjadwal" value="<?= $v->idjadwal ?>">
                              <input type="hidden" name="h_waktu" value="<?= $v->tgl_mengajar ?>">
                              <button type="submit" name="ajuan" value="input" class="btn btn-info" name="editmodal<?= $no ?>"><i class="fa fa-edit" style="margin-top: 5px;"></i>Input Kehadiran</button>
                            
                              </form>
                              
                              <?php
                            }else{
                              ?>
                              <button class="btn btn-danger" onclick="hapus('<?= $v->idajuan ?>');">Hapus Ajuan</button>
                              <?php
                            }
                            ?>
                          </td>
                        </tr>
                        <?php
                      }
                    ?>
                  </tbody>
              </table>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>Pilih</th>
                      <th>Kode Jadwal</th>
                      <th>Hari</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jadwal as $b) {
                      ?>
                    <tr>
                      <td>

                            <button class="btn btn-info" onclick="edit('<?= $no ?>','<?= $b->pekan; ?>','<?= $b->kdmatpel; ?>','<?= $b->kdkelas; ?>','<?= $b->hari; ?>','<?= $b->jam; ?>','<?= $b->jml_jam; ?>','<?= $b->idtahunajaran; ?>','<?= $b->idjadwal; ?>');" name="editmodal<?= $no ?>">Ajukan</button>
                      </td>
                        
                      <td><?php echo $b->kdmatpel."-".$b->idjadwal; ?></td>
                      <td><?php echo $b->hari; ?></td>
                      <td><?php echo "Jam ke: ".$b->jam."/ (".$b->start_time.")"; ?></td>
                      <td><?php echo "Jam ke: ".$b->jml."/ (".$b->waktu.")"; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tahun ?></td>
                    </tr>
                    <?php
                    $no++;
                    } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" name="formData" action="<?= base_url().$form_action ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="title">AJUAN MASUK MENGAJAR</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Kode Jadwal</label>
                    <input type="text" name="kode" class="form-control" readonly required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tanggal Kendala Mengajar</label>
                    <input type="date" name="tgl" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Alasan Kendala</label>
                    <textarea name="alasan" class="form-control" required></textarea>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Bukti Mengajar (.jpg/.jpeg/.png)</label>
                    <input type="file" name="upload_Files" class="form-control" accept="image/*">
                </div>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="KIRIM" id="btn">SIMPAN</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?php
ini_set('display_errors','off');
?>

