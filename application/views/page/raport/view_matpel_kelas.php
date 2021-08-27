<script type="text/javascript">
  function eksport(){
    document.location="<?= base_url()?>page/datamatpelguru/eksport";
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
            <h1 class="m-0 text-dark">Data Matpel Guru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Matpel Guru</a></li>
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
                              ?>
                              <option value="<?= $v->kdkelas ?>"><?= $v->kdkelas ?></option>
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
                      <label>Mata Pelajaran</label>
                      <select name="kdmatpel" class="select2" data-placeholder="Pilih Mata Pelajaran" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                          <option></option>
                          <?php
                            foreach ($matpel as $key => $v) {
                              # code...
                              if($v->kdmatpel==$kdmatpel){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->kdmatpel ?>" <?= $s ?> ><?= strtoupper($v->matpel) ?></option>
                              <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value="Simpan" class="btn btn-primary" style="width: 100%;" ><i class="fas fa-plus"></i>Simpan</button>
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
                      <th>Nama Guru</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($matpelkelas as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tahun; ?></td>
                      <td>

                            <a href="<?= base_url()."page/raport/matpelkelas/hapus/".sha1($b->idmatpelkelas) ?>" onclick="return confirm('Hapus Data ini ?')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>

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
            <form method="post" action="<?= base_url().'page/datamatpelguru/upload' ?>" enctype="multipart/form-data">
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

