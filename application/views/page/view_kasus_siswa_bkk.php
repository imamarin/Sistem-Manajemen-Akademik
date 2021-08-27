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

                
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Penindakan Kasus Baru</button>
                    </div>

              </div>

            </div>
            
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS/NISN</th>
                      <th>Nama</th>
                      <th>Kelas</th>
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
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->kasus; ?></td>
                      <td>
                        <form action="<?= base_url().'page/bkbp/kasussiswa/tindakan/'.$b->nisn ?>" method="post">
                          <input type="hidden" name="kdkelas" value="<?= $b->kdkelas ?>">
                          <button type="submit" value="submit" name="submit" class="btn btn-info">Lihat Detail Laporan</button>
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
            <form method="post" action="<?= base_url().'page/bkbp/kasussiswa/' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH KASUS SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                      <select name="nisn" class="select2" data-placeholder="Pilih Siswa" data-dropdown-css-class="select2-blue" style="width: 100%;" required="">
                          <option></option>
                          <?php
                            foreach ($siswa2 as $key => $v) {
                              # code...
                              ?>
                              <option value="<?= $v->nisn ?>"><?= strtoupper($v->nama)." (".$v->nisn.") - ".$v->kdkelas; ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Deskripsi Kasus</label>
                    <textarea name="kasus" class="form-control" rows="5"></textarea>
                </div>
              
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="simpan">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      