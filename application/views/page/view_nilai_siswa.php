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
            <h1 class="m-0 text-dark">Input Nilai Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Input Nilai</a></li>
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
        <div class="col-12 col-md-4">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <label>Kelas</label>:
                        <p><?= $kdkelas ?></p>
                      </div>
                      <div class="col-md-6 col-6">
                        <label>Nama Ujian</label>:
                        <p><?= $judul ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <label>Mata Pelajaran</label>:
                        <p><?= $matpel ?></p>
                      </div>
                      <div class="col-md-6 col-6">
                        <label>Kategori</label>:
                        <p><?= $kategori ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-6">
                       <label>Tahun Ajaran</label>:
                        <p><?= $tahun ?></p>
                      </div>
                      <div class="col-md-6 col-6">
                        <label>Semester</label>:
                        <p><?= $semester ?></p>
                      </div>
                    </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
        <div class="col-12 col-md-8">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body"> 

              
              <?= form_open($form_action,array("enctype"=>"multipart/form-data")) ?> 
                <?php 
              if(in_array("Eksport Data-24", $this->session->fitur) || in_array("Eksport Data-25", $this->session->fitur) || in_array("Eksport Data-26", $this->session->fitur) || in_array("Eksport Data-64", $this->session->fitur)){
                ?>
                  <button class="btn btn-success" type="submit" name="eksport" value="eksport"><i class="fa fa-download"></i> Ekspor Data</button>
                <?php
              }
              ?>            
              <?php 
              if(in_array("Import Data-24", $this->session->fitur) || in_array("Import Data-25", $this->session->fitur) || in_array("Import Data-26", $this->session->fitur) || in_array("Import Data-64", $this->session->fitur)){
                ?>
                  <button class="btn btn-info" type="button" data-toggle="modal" data-target="#modal-default"><i class="fa fa-upload"></i> Impor Data</button>
                  <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content">
                       
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
                          <button type="submit" name="submit" value="import" class="btn btn-primary">KIRIM</button>
                        </div>
                    
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                <?php
              }
              ?> <br><br>

                <table id="example" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Jenis Kelamin</th>
                      <th>Nilai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                      ?>
                    <tr>                        
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nisn; ?><input type="hidden" name="nisn[]" value="<?= $b->nisn ?>"></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo $b->jk; ?></td>
                      <td><input type="text" name="nilai[]" class="form-control" value="<?= isset($b->nilai)?$b->nilai:'0' ?>" required>
                      </td>
                    </tr>
                    <?php
                      $no++;                    
                    } ?>
                </tbody>
              </table>
              <input type="hidden" name="h_kdmatpel" value="<?= $kdmatpel ?>">
              <input type="hidden" name="h_kdkelas" value="<?= $kdkelas ?>">
              <input type="hidden" name="h_tahun" value="<?= $idtahunajaran ?>">
              <input type="hidden" name="h_idujian" value="<?= $idujian ?>">
              <input type="hidden" name="h_semester" value="<?= $semester ?>">
              <input type="hidden" name="h_judul" value="<?= $judul ?>">
              <input type="hidden" name="h_kategori" value="<?= $kategori ?>">
              <button type="submit" name="submit" value="simpan" class="btn btn-primary">SIMPAN</button>
              <?= form_close() ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">

      </div>
      
    </section>
  </div>

  
      