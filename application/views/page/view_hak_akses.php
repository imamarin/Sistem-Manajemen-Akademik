
<script>
function mySubmit() {
  document.getElementById("myForm").submit();
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
            <h1 class="m-0 text-dark">Pengaturan Hak Akses</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Daftar Sasiwa</a></li>
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
              <?= form_open($form_action) ?>
              <div class="row">                 
                    <div class="col-sm-12 col-md-2">
                      <label>Level</label>
                      <select name="idlevel" class="form-control">
                          <option value="0"></option>
                          <?php
                            foreach ($level as $key => $v) {
                              # code...
                              if($v->idlevel==$lvl){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->idlevel ?>" <?= $s ?> ><?= strtoupper($v->level) ?></option>
                              <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" class="btn btn-success" style="width: 100%;" >Tampilkan</button>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="button" class="btn btn-primary" style="width: 100%;" data-toggle="modal" data-target="#modal-default2" >Tambah Level</button>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="button" class="btn btn-primary" style="width: 100%;" onclick="mySubmit();" >Simpan Hak Akses</button>
                    </div>
                    
              </div>
              <?= form_close(); ?>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form method="post" action="<?= base_url().$form_action2 ?>" id="myForm">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KATEGORI</th>
                      <th>MENU</th>
                      <th>FITUR</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($menu as $b) {
                    ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $b->kategori ?></td>
                      <td><?= $b->menu ?></td>
                      <td>
                        <?php
                        $pilih="";
                          foreach ($fiturmenu as $key => $v) {
                            # code...
                            if($v->idsetmenu == $b->idsetmenu){

                              foreach ($hakakses as $key => $val) {
                                # code...
                                if($val->idsetfiturmenu==$v->idsetfiturmenu){
                                  $pilih="checked";
                                  break;
                                }else{
                                  $pilih="";
                                }
                              }
                              echo "<input type='checkbox' name='fitur[]' value='$v->idsetfiturmenu' $pilih $disabled > $v->fitur";
                              echo "&nbsp;&nbsp;&nbsp;";
                            }

                          }
                        ?>
                      </td>
                    </tr>
                    <?php
                    $no++;
                    } ?>
                </tbody>
              </table>
            </form>
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
            <form method="post" action="<?= base_url()."page/hakakses/simpanlevel" ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH LEVEL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                   <label>Kode Level</label>
                   <input type="text" name="kdlevel" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                   <label>Nama Level</label>
                   <input type="text" name="level" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



