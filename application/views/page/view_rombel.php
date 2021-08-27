<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox'  && !(checkboxes[i].disabled) ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
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
            <h1 class="m-0 text-dark">Data Rombel</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Rombel</a></li>
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
                      <label>Tahun Ajaran</label>
                      <select name="tahunajaran" class="form-control">
                          <?php
                            foreach ($tahun as $key => $v) {
                              # code...
                              ?>
                              <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun." (".strtoupper($v->semester).")"; ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Kelas</label>
                      <select name="kdkelas" class="form-control">
                          <option></option>
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
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" class="btn btn-success" style="width: 100%;" >Tampilkan</button>
                    </div>
                    
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <?php 
                      if(in_array("Print Lembar Absensi-3", $this->session->fitur)){
                        ?>
                          <button type="button" class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#modal-default2">Print Lembar Absensi</button><br>
                        <?php
                      }
                      ?>
                    </div>

                    <div class="col-sm-12 col-md-3  d-flex align-items-end">
                      <?php 
                      if(in_array("Rombel-3", $this->session->fitur)){
                        ?>
                          
                          <div class="btn-group" style="width: 100%;">
                            <button type="button" class="btn btn-warning" style="width: 100%;" >Rombel</button>
                            <button type="button" id="dropdownSubMenu1" class="btn btn-warning dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown"> </button>                             
                              <div aria-labelledby="dropdownSubMenu1" class="dropdown-menu" role="menu">
                                <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#modal-default">Input Rombel</a>
                                <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#modal-default3">Import Rombel (xlsx)</a>
                              </div>
                            
                          </div>
                        <?php
                        $readonly=false;
                      }else{
                        $readonly=true;
                      }
                      ?>
                      
                    </div>

                <!-- /.col -->
              </div>            
              <?= form_close(); ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <?= form_open($form_action2); ?>
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <?php 
                      if($readonly==false){
                      ?>
                      <th align="center"><input type="checkbox" onchange="checkAll(this)" name="chk[]" class="form-control" style="width:20px;float: left;" > <label style="margin-left: 5px;margin-top: 5px;">Pilih</label></th>
                      <?php
                      }
                      ?>
                      <th>NIS/NISN</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Tingkat</th>
                      <th>Jurusan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    ?>
                    <tr>
                      <?php 
                      if($readonly==false){
                      ?>
                      <td align="center"><input type="checkbox" name="nisn[]" value="<?= $b->nisn ?>" class="form-control" style="width:20px;"> <?= $no ?></td>
                      <?php
                      }
                      ?>
                      <td><?php echo $b->nis2." / ".$b->nisn; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tingkat; ?></td>
                      <td><?php echo $b->kdjurusan; ?></td>
                    </tr>
                    <?php
                    $no++;
                    } ?>
                  </tbody>
                </table>
                <div class="modal fade" id="modal-default">
                  <div class="modal-dialog">
                    <div class="modal-content">
                     
                      <div class="modal-header">
                        <h4 class="modal-title">Pemindahan Siswa ke ..?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            <div class="row">
                              <div class="col-sm-12 col-md-12">
                                <label>Tahun Ajaran</label>
                                <select name="tahunajaran" class="select2" data-dropdown-css-class="select2-blue">
                                    <?php
                                      foreach ($tahun as $key => $v) {
                                        # code...
                                        ?>
                                        <option value="<?= $v->idtahunajaran ?>"><?= strtoupper($v->tahun) ?></option>
                                        <?php
                                      }
                                    ?>
                                    
                                </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12 col-md-12">
                                <label>Kelas</label>
                                <select name="kdkelas" class="select2" data-dropdown-css-class="select2-blue">
                                    <option></option>
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
                        <button type="submit" class="btn btn-primary">KIRIM</button>
                      </div>

                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

                <?= form_close(); ?>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>

<div class="modal fade" id="modal-default2">
                  <div class="modal-dialog">
                    <div class="modal-content">
                     <?= form_open($form_action3, array("target"=>'blank')); ?>
                      <div class="modal-header">
                        <h4 class="modal-title">Cetak Lembar Kehadiran</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                            
                            <div class="row">
                              <div class="col-sm-12 col-md-12">
                                <label>Tahun Ajaran</label>
                                <select name="tahunajaran" class="select2" data-dropdown-css-class="select2-blue" required>
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
                                <label>Semester</label>
                                <select name="semester" class="select2" data-dropdown-css-class="select2-blue" required>
                                    <option value="ganjil">Ganjil</option>
                                    <option value="genap">Genap</option>
                                </select>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-sm-12 col-md-12">
                                <label>Kelas</label>
                                <select name="kdkelas" class="select2" data-dropdown-css-class="select2-blue" required>
                                    <option></option>
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
                        <button type="submit" name="cetak" class="btn btn-primary" value="cetak"><i class="fa fa-print"></i> CETAK</button>
                        <button type="submit" name="excel" class="btn btn-success" value="excel"><i class="fa fa-edit"></i> EXCEL</button>
                      </div>
                      <?= form_close(); ?>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
                </div>

<div class="modal fade" id="modal-default3">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/rombel/upload' ?>" enctype="multipart/form-data">
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
              <button type="submit" class="btn btn-primary" name="submit" value="import">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>