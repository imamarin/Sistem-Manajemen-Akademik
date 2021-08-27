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
            <h1 class="m-0 text-dark">Input Kehadiran Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Input Kehadiran</a></li>
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
                        <label>Tahun Ajaran</label>:
                        <p><?= $tahun ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <label>Mata Pelajaran</label>:
                        <p><?= $matpel ?></p>
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
              <div class="row">
                <div class="col-12">
                  <label>TANGGAL: <?= date('d-m-Y',strtotime($waktu)) ?> JAM: <?= $jam ?></label>
                </div>
              </div>     
              <?= form_open($form_action) ?> 
                <table id="example" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Jenis Kelamin</th>
                      <th>Kehadiran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $bahasan="";
                    $token="";
                    foreach ($siswa as $b) {
                      ?>
                    <tr>                        
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nisn; ?><input type="hidden" name="nisn[]" value="<?= $b->nisn ?>"></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo $b->jk; ?></td>
                      <td>
                        <?php
                        $h="";$i="";$s="";$a="";$n="";
                        if(isset($b->keterangan)){
                          if($b->keterangan=="h"){
                            $h="selected";
                          }else{
                            $h="";
                          }
                          if($b->keterangan=="i"){
                            $i="selected";
                          }else{
                            $i="";
                          }
                          if($b->keterangan=="s"){
                            $s="selected";
                          }else{
                            $s="";
                          }
                          if($b->keterangan=="a"){
                            $a="selected";
                          }else{
                            $a="";
                          }
                          if($b->keterangan==NULL){
                            $n="selected";
                          }else{
                            $n="";
                          }
                        }

                        if($lihat==1 && $b->keterangan==NULL){
                            $n="selected";
                        }else{
                            $n="";
                        }
                        ?>
                        <select name="ket[]" class="form-control" required="required">
                          <option value="h" <?= $h ?> >HADIR</option>
                          <option value="i" <?= $i ?> >IZIN</option>
                          <option value="s" <?= $s ?> >SAKIT</option>
                          <option value="a" <?= $a ?> >ALFA</option>
                          <option <?= $n ?> ></option>
                        </select>
                      </td>
                    </tr>
                    <?php
                      $no++;
                      if(isset($b->bahasan)){
                        $bahasan=$b->bahasan;
                      }

                      if(isset($b->token)){
                        $bahasan=$b->bahasan;
                      }
                    
                    } ?>
                </tbody>
              </table>

              <label>POKOK BAHASAN</label>
              <textarea name="bahasan" class="form-control"><?= $bahasan ?></textarea><br> 
              <input type="hidden" name="h_kdmatpel" value="<?= $kdmatpel ?>">
              <input type="hidden" name="h_kdkelas" value="<?= $kdkelas ?>">
              <input type="hidden" name="h_tahun" value="<?= $idtahunajaran ?>">
              <input type="hidden" name="h_idjadwal" value="<?= $idjadwal ?>">
              <input type="hidden" name="h_semester" value="<?= $semester ?>">
              <input type="hidden" name="h_waktu" value="<?= $waktu ?>">
              <input type="hidden" name="ajuan" value="<?= $ajuan ?>">
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

  
      