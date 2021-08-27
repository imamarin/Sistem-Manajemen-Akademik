
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
            <h1 class="m-0 text-dark">Data Karyawan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Karyawan</a></li>
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
              if(in_array("Tambah Data-8", $this->session->fitur)){
                ?>
                  <a href="<?= base_url()."page/karyawan/add" ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</button> </a>
                <?php
              }
              ?> 
              <?php 
              if(in_array("Eksport Data-8", $this->session->fitur)){
                ?>
                  <a href="<?= base_url()."page/karyawan/eksport2" ?>"><button class="btn btn-success"><i class="fa fa-download"></i> Eksport Data</button></a>
                <?php
              }
              ?>            
              <?php 
              if(in_array("Import Data-8", $this->session->fitur)){
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
                      <th>No</th>
                      <th>Kode Karyawan</th>
                      <th>Nama</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                      <th>Jenis Kelamin</th>
                      <th>NIK</th>
                      <th>Alamat</th>
                      <th>No. Hp</th>
                      <th>Status</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($karyawan as $b) {
                      if($b->status==0){
                        $warna="red";
                        $status="Tidak Aktif";
                      }else{
                        $warna="";
                        $status="Aktif";
                      }
                    ?>
                    <tr style="color: <?= $warna ?>">
                      <td><?= $no ?></td>
                      <td><?php echo $b->kdkaryawan; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->tmp_lahir; ?></td>
                      <td><?php echo $b->tgl_lahir; ?></td>
                      <td><?php echo $b->jk; ?></td>
                      <td><?php echo $b->nik; ?></td>
                      <td><?php echo $b->alamat; ?></td>
                      <td><?php echo $b->no_hp; ?></td>
                      <td><?php echo $status; ?></td>
                      <td>
                        <?php 
                        if(in_array("Edit Data-8", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/karyawan/edit/".$b->kdkaryawan ?>"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>  
                          <?php
                        }
                        ?>
                        <?php 
                        if(in_array("Hapus Data-8", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/Karyawan/hapus/".$b->kdkaryawan ?>" onclick="return confirm('Hapus Data ini ?')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                          <?php
                        }
                        ?>
                        <?php 
                        if(in_array("Reset Data-8", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/karyawan/reset/".$b->iduser ?>" onclick="return confirm('Reset Data ini ?')"><button class="btn btn-warning">Reset</button></a>
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
            <form method="post" action="<?= base_url().'page/karyawan/upload' ?>" enctype="multipart/form-data">
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



