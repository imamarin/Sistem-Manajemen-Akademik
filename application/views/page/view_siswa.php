
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
            <h1 class="m-0 text-dark">Data Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Daftar Siswa</a></li>
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
              <?php 
              if(in_array("Tambah Data-1", $this->session->fitur)){
                ?>
                  <a href="<?= base_url()."page/siswa/add" ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button> </a>
                <?php
              }
              ?>
              <?php 
              if(in_array("Eksport Data-1", $this->session->fitur)){
                ?>
                  <button class="btn btn-success" data-toggle="modal" data-target="#modal-default2"><i class="fa fa-download"></i> Eksport Data </button>
                <?php
              }
              ?>             
              <?php 
              if(in_array("Import Data-1", $this->session->fitur)){
                ?>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modal-default"><i class="fa fa-upload"></i> Import Data</button>
                <?php
              }
              ?>
              
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</td>
                      <th>NIS/NISN</th>
                      <th>Nama</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>NIK</th>
                      <th>Asal Sekolah</th>
                      <th>Nama Ayah</th>
                      <th>Nama Ibu</th>
                      <th>Pekerjaan Ayah</th>
                      <th>Pekerjaan Ibu</th>
                      <th>Alamat Orang Tua</th>
                      <th>Alamat Siswa</th>
                      <th>Hp Orang Tua</th>
                      <th>Hp Siswa</th>
                      <th>Diterima Tanggal</th>
                      <th>Status</th>
                      <th>Kelas</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                      if($b->status==0){
                        $warna="red";
                        $class="btn btn-danger";
                        $status="Tidak Aktif";
                        $stt=1;
                      }else{
                        $warna="";
                        $status="Aktif";
                        $class="btn btn-info";
                        $stt=0;
                      }
                    ?>
                    <tr style="color: <?= $warna ?>">
                      
                      <td><?= $no ?></td>  
                      <td><?php echo $b->nis2." / ".$b->nisn; ?></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo $b->tmp_lahir; ?></td>
                      <td><?php echo $b->tgl_lahir; ?></td>
                      <td><?php echo $b->jk; ?></td>
                      <td><?php echo $b->nik; ?></td>
                      <td><?php echo $b->asal_sekolah; ?></td>
                      <td><?php echo $b->nm_ayah; ?></td>
                      <td><?php echo $b->nm_ibu; ?></td>
                      <td><?php echo $b->pek_ayah; ?></td>
                      <td><?php echo $b->pek_ibu; ?></td>
                      <td><?php echo $b->alamat_orangtua; ?></td>
                      <td><?php echo $b->alamat_siswa; ?></td>
                      <td><?php echo $b->hp_orangtua; ?></td>
                      <td><?php echo $b->hp_siswa; ?></td>
                      <td><?php echo $b->tgl_terima; ?></td>
                      <td>
                        <a href="<?= base_url('page/siswa/aktivasi/'.$b->nisn."/".$stt) ?>" class="<?= $class ?>"><?php echo $status; ?></a>
                      </td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td>
                        <?php 
                        if(in_array("Edit Data-1", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/siswa/edit/".$b->nisn ?>"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>  
                          <?php
                        }
                        ?>
                        <?php 
                        if(in_array("Hapus Data-1", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/siswa/hapus/".$b->nisn ?>" onclick="return confirm('Hapus Data ini ?')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                          <?php
                        }
                        ?>
                        <?php 
                        if(in_array("Reset Data-1", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/siswa/reset/".$b->iduser ?>" onclick="return confirm('Reset Data ini ?')"><button class="btn btn-warning">Reset</button></a>
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
      
    </section>
  </div>
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/siswa/upload' ?>" enctype="multipart/form-data">
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
              <button type="submit" class="btn btn-primary">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url()."page/siswa/eksport2" ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">EKSPORT DATA SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                   <label>Tahun Ajaran</label>
                   <select name="tahunajaran" class="form-control" required>
                   <?php
                   foreach ($tahun as $key => $v) {
                    # code...
                   ?>
                    <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun." (".strtoupper($v->semester).")" ?></option>
                   <?php
                    }
                   ?>
                                    
                   </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Kelas</label>
                  <select name="kdkelas" class="form-control" required="">
                    <option value="0">Semua</option>
                    <?php
                    foreach ($kelas as $key => $v) {
                     # code...
                      if($v->kdkelas==$kls){
                        $s="selected";
                      }else{
                        $s="";
                      }
                      ?>
                      <option value="<?= $v->kdkelas ?>" <?= $s ?> ><?= strtoupper($v->kdkelas) ?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Eksport</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



