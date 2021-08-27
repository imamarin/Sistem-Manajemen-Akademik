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

   function hapus(id){
    s=window.confirm("Hapus Data ini");
    if(s){
      document.location="<?= base_url().$hapus_action ?>"+id;
    }
  }

  function eksport(id){
    document.location="<?= base_url()?>page/walikelas/eksport/"+id;
  }

  function tahun(id){
    document.location="<?= base_url()?>page/walikelas/index/"+id;
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
            <h1 class="m-0 text-dark">Data Walikelas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Walikelas</a></li>
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
              if(in_array("Tambah Data-27", $this->session->fitur)){
              ?>
              <?= form_open($form_action); ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-2">
                      <label>Tahun Ajaran</label>
                      <select name="tahunajaran" class="form-control" onchange="tahun(this.value);">
                          <?php
                            foreach ($tahun as $key => $v) {
                              # code...
                              if($v->idtahunajaran == $id){
                                $pilih = "selected";
                              }else{
                                $pilih ="";
                              }
                              ?>
                              <option value="<?= $v->idtahunajaran ?>" <?= $pilih ?> ><?= $v->tahun ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <label>Guru</label>
                      <select name="kdguru" class="select2" data-placeholder="Pilih Guru" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                          <option></option>
                          <?php
                            foreach ($guru as $key => $v) {
                              # code...
                              if($v->kdguru==$kdguru){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->kdguru ?>" <?= $s ?> ><?= strtoupper($v->nama) ?></option>
                              <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <label>Kelas</label>
                      <select name="kdkelas" class="select2" data-placeholder="Pilih Mata Pelajaran" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                          <option></option>
                          <?php
                            foreach ($kelas as $key => $v) {
                              # code...
                              if($v->kdkelas==$kdkelas){
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
                      <button type="submit" name="submit" value="Simpan" class="btn btn-primary" style="width: 100%;" ><i class="fas fa-plus"></i>Simpan</button>
                    </div>
                    <?php 
                    if(in_array("Eksport Data-27", $this->session->fitur)){
                    ?>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <div class="btn-group" style="width: 100%;">
                            <button type="button" onclick="eksport(<?= $id ?>);" class="btn btn-success" style="width: 100%;" >Eksport Data</button>
                            <?php 
                            if(in_array("Import Data-27", $this->session->fitur)){
                            ?>
                            <button type="button" id="dropdownSubMenu1" class="btn btn-success dropdown-toggle dropdown-hover dropdown-icon" data-toggle="dropdown"> </button>                             
                              <div aria-labelledby="dropdownSubMenu1" class="dropdown-menu" role="menu">
                                <a class="dropdown-item" style="cursor: pointer;" data-toggle="modal" data-target="#modal-default">Impor Data (xlsx)</a>
                              </div>
                              <?php
                            }
                            ?>
                            
                      </div>
                    </div>
                    <?php
                    }
                    ?>

                <!-- /.col -->
              </div>            
              <?= form_close(); ?>
              <?php
            }
            ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Nama Guru</th>
                      <th>Kelas</th>
                      <th>Tahum Ajaran</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($walikelas as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tahun; ?></td>
                      <td>
                        <?php 
                        if(in_array("Hapus Data-19", $this->session->fitur)){
                          ?>
                            <button class="btn btn-danger" onclick="hapus('<?= $b->idwalikelas ?>')"><i class="fa fa-trash"></i></button>
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
            <form method="post" action="<?= base_url().'page/walikelas/upload' ?>" enctype="multipart/form-data">
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


