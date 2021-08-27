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
            <h1 class="m-0 text-dark">Input Nilai Sikap Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Input Nilai Sikap</a></li>
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
        <div class="col-12 col-md-12">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-3 col-3">
                        <label>Kelas</label>:
                        <p><?= $kdkelas ?></p>
                      </div>
                      <div class="col-md-3 col-3">
                       <label>Tahun Ajaran</label>:
                        <p><?= $tahun ?></p>
                      </div>
                      <div class="col-md-3 col-3">
                        <label>Semester</label>:
                        <p><?= $semester ?></p>
                      </div>
                    </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body"> 

              
              <?= form_open($form_action,array("enctype"=>"multipart/form-data")) ?>            
                <table id="example" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Nama DU/DI</th>
                      <th>Alamat DU/DI</th>
                      <th style="width: 10%;">Jumlah Jam Kerja</th>
                      <th style="width: 10%;">Nilai Prakerin</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($prakerin as $b) {
                    ?>
                    <tr>                        
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nisn1; ?><input type="hidden" name="nisn[]" value="<?= $b->nisn1 ?>"></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><input type="text" value="<?= isset($b->dudi)?$b->dudi:$b->dudi2 ?>" name="dudi[]" class="form-control"></td>
                      <td><textarea class="form-control" name="alamatdudi[]"><?= isset($b->alamat)?$b->alamat:$b->alamat2 ?></textarea></td>
                      <td><input type="number" value="<?= $b->waktu ?>" name="waktu[]" class="form-control"></td>
                      <td><input type="number" value="<?= $b->nilai ?>" name="nilai[]" class="form-control"></td>
                    </tr>
                    <?php
                      $no++;                    
                    } ?>
                </tbody>
              </table>
              <input type="hidden" name="kelas" value="<?= $kdkelas ?>">
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

  
      