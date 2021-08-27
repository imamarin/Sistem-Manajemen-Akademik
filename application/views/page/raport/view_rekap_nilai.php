<script type="text/javascript">
  function eksport(){
    document.location="<?= base_url()?>page/datamatpelguru/eksport";
  }


  function tambah(x,gr,a,b,c,d,e,f,g,h){
      $("[name='kdguru']").val(gr).trigger('change');
      $("[name='kdmatpel']").val(a).trigger('change');
      $("[name='kelas']").val(b).trigger('change');
      $("[name='semester']").val(c).trigger('change');
      $("[name='tahun']").val(d).trigger('change');

      document.getElementsByName("kkm")[0].value=e;
      document.getElementsByName("bp")[0].value=f;
      document.getElementsByName("bk")[0].value=g;
      document.getElementsByName("tambahmodal"+x)[0].setAttribute("data-toggle","modal");
      document.getElementsByName("tambahmodal"+x)[0].setAttribute("data-target","#modal-default");
      //document.getElementsByName("coba"+x)[0].value="aaaaaaaaaaa";
      //alert("sadsad");
    }
  
  function cekkkm(x){
    document.getElementsByName("lihatremed"+x)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("lihatremed"+x)[0].setAttribute("data-target","#modal-default2");
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
            <h1 class="m-0 text-dark">Data Rekap Nilai Raport</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Rekap Nilai Raport</a></li>
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
              <?= form_open($form_action); ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-2">
                      <label>Kelas</label>
                      <select name="kdkelas" class="form-control">
                          <?php
                            foreach ($kelas as $key => $v) {
                              # code...
                              if($v->kdkelas==$kls){
                                $pilih="selected";
                              }else{
                                $pilih="";
                              }
                              ?>
                              <option value="<?= $v->kdkelas ?>" <?= $pilih ?>><?= $v->kdkelas ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value="Simpan" class="btn btn-primary" style="width: 100%;" ></i>Tampilkan</button>
                    </div>
                    


                <!-- /.col -->
              </div>            
              <?= form_close(); ?>

            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Mata Pelajaran</th>
                      <th>Nama Guru</th>
                      <th>Siswa diberi nilai</th>
                      <th>Nilai dibawah KKM</th>
                      <th>Lihat Nilai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($matpelkelas as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->matpel; ?><br>kkm: <?= $b->kkm ?>, Bobot Peng: <?= $b->bp ?>, Bobot Ketm: <?= $b->bk ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php $t=ceil($b->jmlsiswa/$b->totalsiswa*100) ?>
                        <?php
                        if($t>=100){
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
                            </div>
                        <?php
                        }elseif($t>=80){
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
                            </div>
                        <?php    
                        }elseif($t>=50){
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-warning progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
                            </div>
                        <?php
                        }else{
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-danger progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
                            </div>
                        <?php    
                        }
                        ?>
                      </td>
                      <td align="center">
                      <a href="#" data-toggle="modal" data-target="#modal-default2<?= $no ?>"><?php echo isset($b->bawahkkm)? $b->bawahkkm : '0'; ?> Siswa, Klik disini untuk melihat siswanya</a>
                      
                      </td>
                      <td>
                      <?php
                        if(isset($b->idnilairaport)){
                      ?>
                          <form method="post" action="<?= base_url()."page/raport/rekapnilai/detail" ?>">
                            <input type="hidden" name="h_kdmatpel" value="<?= $b->kdmatpel ?>">
                            <input type="hidden" name="h_kdguru" value="<?= $b->kdguru ?>">
                            <input type="hidden" name="h_kdkelas" value="<?= $b->kdkelas ?>">
                            <input type="hidden" name="h_tahun" value="<?= $b->idtahunajaran ?>">
                            <input type="hidden" name="h_semester" value="<?= $b->semester ?>">
                            <input type="hidden" name="h_idnilairaport" value="<?= $b->idnilairaport ?>">
                            <button type="submit" name="input" value="input" class="btn btn-primary"><i class="fa fa-sign-in-alt"></i></button>                
                          </form> 
                      <?php
                        }else{
                          ?>
                          <button class="btn btn-danger" onclick="tambah('<?= $no ?>','<?= $b->kdguru ?>','<?= $b->kdmatpel; ?>','<?= $b->kdkelas; ?>','<?= $b->semester; ?>','<?= $b->idtahunajaran; ?>','<?= $b->kkm; ?>','<?= $b->bp; ?>','<?= $b->bk; ?>','<?= $b->idnilairaport; ?>');" name="tambahmodal<?= $no ?>"><i class="fa fa-sign-in-alt"></i></button>
                          <?php
                        }
                      ?>
                      </td>
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
        </div>
      </div>
      
    </section>
  </div>

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" name="formData" action="<?= base_url().'page/raport/rekapnilai/simpan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="title">TAMBAH DATA NILAI RAPORT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Guru</label>
                    <select name="kdguru" data-placeholder="Nama Guru" class="form-control" required readonly>
                     <?php
                      foreach ($guru as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->kdguru ?>"><?= $v->nama ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Kelas</label>
                    <select name="kelas" class="select2" data-placeholder="Kelas" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($kdkelas as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->kdkelas ?>"><?= $v->kdkelas ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Mata Pelajaran</label>
                    <select name="kdmatpel" class="select2" data-placeholder="Mata Pelajaran" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($matpel as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->kdmatpel ?>"><?= $v->matpel ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Semester</label>
                    <select id="semester" name="semester" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                      <option value="ganjil">Ganjil</option>
                      <option value="genap">Genap</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tahun Ajaran</label>
                    <select name="tahun" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($tahun as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nilai KKM</label>
                    <input type="number" name="kkm" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Bobot Nil. Pengetahuan</label>
                    <input type="number" name="bp" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Bobot Nil. Keterampilan</label>
                    <input type="number" name="bk" class="form-control" required>
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
      $no = 1;
      foreach ($matpelkelas as $b) {

                      if(isset($b->idnilairaport)){
                      ?>
                      <div class="modal fade" id="modal-default2<?= $no ?>">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="title">SISWA DIBAWAH KKM</h4>
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
                                            <th>NISN</th>
                                            <th>NAMA</th>
                                            <th>PENGETAHUAN</th>
                                            <th>KETERAMPILAN</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $histori = $this->db->query("SELECT siswa.nisn, siswa.nama, dn.pengetahuan, dn.keterampilan FROM 
                                          detailnilairaport as dn JOIN siswa ON dn.nisn=siswa.nisn JOIN nilairaport as nr ON nr.idnilairaport=dn.idnilairaport
                                          WHERE nr.idnilairaport='$b->idnilairaport' AND siswa.status=1 AND (dn.pengetahuan < nr.kkm OR dn.keterampilan < nr.kkm)  ORDER BY siswa.nama asc")->result();
                                          foreach ($histori as $key => $v) {
                                            # code...
                                            ?>
                                            <tr>
                                              <td><?= $v->nisn?></td>
                                              <td><?= $v->nama ?></td>
                                              <td><?= $v->pengetahuan ?></td>
                                              <td><?= $v->keterampilan ?></td>
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
                        }
                        $no++;
                      }
                        ?>



