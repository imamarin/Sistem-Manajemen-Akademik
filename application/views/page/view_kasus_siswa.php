<script type="text/javascript">
  if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
  }

  function action2(n,a){
    var frm="myform"+n;
    document.getElementById("myform1").submit();
    
  }

  function coba(){
    document.getElementById("myformed").submit();
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
            <h1 class="m-0 text-dark">Data Kasus Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kasus Siswa</a></li>
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
              if(in_array("Tampil-32", $this->session->fitur)){
                ?>
              <?= form_open($form_action);?>
                
                <div class="row">
              
                  <div class="col-sm-12 col-md-2">
                      <label>Kelas</label>
                      <select name="kdkelas" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php
                            foreach ($walikelas as $key => $v) {
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
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS/NISN</th>
                      <th>Nama</th>
                      <th>Jumlah Laporan</th>
                      <th>Lihat Detail Kasus</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    ?>
                    <tr style="">
                      <td>
                        <?= $no ?>
                      </td>
                        
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo $b->kasus; ?></td>
                      <td>
                        <form action="<?= base_url().'page/kasussiswa/detail/'.$b->nisn ?>" method="post">
                          <input type="hidden" name="kdkelas" value="<?= $b->kdkelas ?>">
                          <button type="submit" value="submit" name="submit" class="btn btn-info">Lihat Detail Laporan</button>
                        </form>
                        <form action="<?= base_url().'page/kasussiswa/tindakan/'.$b->nisn ?>" method="post">
                          <input type="hidden" name="kdkelas" value="<?= $b->kdkelas ?>">
                          <button type="submit" value="submit" name="submit" class="btn btn-warning">Tindakan</button>
                        </form>
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
            <form method="post" action="<?= base_url().'page/datasiswakelas/upload' ?>" enctype="multipart/form-data">
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
            <form method="post" action="<?= base_url()."page/datasiswakelas/eksport2" ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">EKSPORT DATA SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                   <label>Tahun Ajaran</label>
                   <select name="tahunajaran" class="form-control" required>
                   <?php
                   foreach ($tahun as $key => $v) {
                    # code...
                   ?>
                    <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun." (".strtoupper($v->semester).")" ?></option>
                   <?php
                    }
                   ?>
                                    
                   </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Kelas</label>
                  <select name="kdkelas" class="form-control" required="">
                    <option value="0">Semua</option>
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
              <button type="submit" class="btn btn-primary">Eksport</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



