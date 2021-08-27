
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
        <div class="col-12 col-md-12">
          <div class="card">
            <div class="card-header">
                <div class="row">
                  
                  <div class="col-sm-12 col-md-4">
                    <?php 
                    if(in_array("Tampil-33", $this->session->fitur)){
                      ?>
                    <?= form_open($form_action);?>
                      
                      <div class="row">
                    
                          <div class="col-sm-12 col-md-9">
                            <label>Kelas</label>
                            <select name="kdkelas" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                                <?php
                                  foreach ($kelas as $key => $v) {
                                    # code...
                                    ?>
                                    <option value="<?= $v->kdkelas ?>"><?= $v->kdkelas ?></option>
                                    <?php
                                  }
                                ?>
                                
                            </select>
                          </div>
                          <div class="col-sm-12 col-md-3 d-flex align-items-end">

                            <button type="submit" name="tampil" value="tampil" class="btn btn-primary">Tampilkan</button>
                          </div>
                      
                    
                    
                      </div>
                    <?= form_close(); ?>
                    <?php
                    }
                    ?>
                  </div>
                  <?php
                  if(isset($cari)){
                    ?>
                    
                    <div class="col-sm-12 col-md-4">
                    <?= form_open($form_action);?>
                      <div class="row">
                        <div class="col-sm-12 col-md-9">
                          <label>Petugas Siswa</label>
                          <select name="nisn" class="select2" data-placeholder="Pilih Siswa" data-dropdown-css-class="select2-blue" style="width: 100%;" required="">
                              <option></option>
                              <?php
                                foreach ($siswa as $key => $v) {
                                  # code...
                                  if($v->nisn==$petugas){
                                    $pilih="selected";
                                  }else{
                                    $pilih="";
                                  }
                                  ?>
                                  <option value="<?= $v->nisn ?>" <?= $pilih ?>><?= $v->nama." (".strtoupper($v->nisn).")"; ?></option>
                                  <?php
                                }
                              ?>
                              
                          </select>
                        </div>
                        <div class="col-sm-12 col-md-3 d-flex align-items-end">
                          <input type="hidden" name="kdkelas" value="<?= $kdkelas ?>">
                          <button type="submit" name="simpan" value='tampil' class="btn btn-success" style="width: 100%;" >Simpan</button>
                        </div> 
                      </div>
                      <?= form_close(); ?>
                    </div>
                   
                    <?php
                  }
                  ?>
                  
                  
                </div>
            </div>

            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <?php 
                      if(in_array("Edit Data-1", $this->session->fitur) || (in_array("Edit Data-33", $this->session->fitur) && $this->uri->segment(2)=="datasiswakelas")){
                      ?>
                      <th>Pilih</th>
                      <?php
                      }
                      ?>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                      if($b->status==0){
                        $warna="red";
                        $status="Tidak Aktif";
                      }else{
                        $warna="";
                        $status="Aktif";
                      }
                    ?>
                    <tr style="color: <?= $warna ?>">
                      <td>
                        <?php 
                        if(in_array("Edit Data-1", $this->session->fitur) || (in_array("Edit Data-33", $this->session->fitur) && $this->uri->segment(2)=="datasiswakelas")){
                          if($this->uri->segment(2)=="datasiswakelas"){
                          ?>
                            <a href="<?= base_url()."page/datasiswakelas/edit/".$b->nisn ?>"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>  
                          <?php
                          }else{
                          ?>
                           <a href="<?= base_url()."page/siswa/edit/".$b->nisn ?>"><button class="btn btn-primary"><i class="fa fa-edit"></i></button></a>
                          <?php
                          }
                        }
                        ?>
                        
                        
                        
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
                      <td><?php echo $status; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
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
      