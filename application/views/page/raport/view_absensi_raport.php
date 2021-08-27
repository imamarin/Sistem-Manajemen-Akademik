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
            <h1 class="m-0 text-dark">Data Kehadiran Siswa (Raport)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data kehadiran Siswa (Raport)</a></li>
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
                       <label>Tahun Ajaran</label>:
                        <p><?= $tahun ?></p>
                      </div>
                      <div class="col-md-6 col-6">
                        <label>Semester</label>:
                        <p><?= $semester ?></p>
                      </div>
                    </div>

                    <form method="post" action="<?php echo base_url($form_action); ?>">
                    <div class="row">                   
                      <div class="col-md-6 col-6">
                        <label>Kelas</label>:
                        <select name="kdkelas" class="form-control">
                          <?php
                            foreach ($kelas as $key => $v) {
                              # code...
                              if($v->kdkelas==$kdkelas){
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
                      <div class="col-md-6 col-6" style="padding-top:10px;">
                        <label> </label><br>
                        <input type="submit" name="submit" class="btn btn-primary" value="Tampilkan">
                      </div>                    
                    </div>
                    </form>                    
                 </div>
               </div>
             </div>
           </div>
         </div>
        <div class="col-12 col-md-8">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body"> 
              INPUT REKAP KEHADIRAN UNTUK RAPORT SISWA
              <br><br>
                <?= form_open($form_action) ?>
                <input type="hidden" value="<?= $kdkelas ?>" name="kdkelas" name="kdkelas">
                <table id="example" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Jenis Kelamin</th>
                      <th>Izin</th>
                      <th>Sakit</th>
                      <th>Alfa</th>
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
                      <td><input type="number" value="<?= $b->izin?$b->izin:0 ?>" name="izin[]" class="form-control"></td>
                      <td><input type="number" value="<?= $b->sakit?$b->sakit:0 ?>" name="sakit[]" class="form-control"></td>
                      <td><input type="number" value="<?= $b->alfa?$b->alfa:0 ?>" name="alfa[]" class="form-control"></td>
                    </tr>
                    <?php
                      $no++;                    
                    } ?>
                </tbody>
              </table>
              <br>
              <?php
              if(in_array("Simpan Data-49", $this->session->fitur)){
                ?>
                <button type="submit" name="submit" value="simpan" class="btn btn-primary">SIMPAN</button>
                <?php
              }
              ?>
              <?= form_close() ?>
            </div>
          </div>
        </div>
      </div>
      <div class="row">

      </div>
      
    </section>
  </div>

  
      