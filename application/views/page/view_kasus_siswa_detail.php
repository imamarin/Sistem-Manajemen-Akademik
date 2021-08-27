<script type="text/javascript">
  if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
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

              <div class="col-sm-12 col-md-12">
                <div class="row">
                  <div class="col-md-2 col-2">
                    <label>NISN</label>:
                    <p><?= $siswa->nisn ?></p>
                  </div>
                  <div class="col-md-3 col-3">
                    <label>Nama Siswa</label>:
                    <p><?= $siswa->nama ?></p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label>Kelas</label>:
                    <p><?= $siswa->kdkelas ?></p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label>Jumlah Laporan</label>:
                    <p><?= $siswa->kasus ?></p>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>NIS/NISN</th>
                      <th>TANGGAL LAPORAN</th>
                      <th>KETERANGAN KASUS</th>
                      <th>PELAPOR</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($kasus as $b) {
                    ?>
                    <tr style="">
                      <td>
                        <?= $no ?>
                      </td>
                        
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->tgl_laporan; ?></td>
                      <td><?php echo $b->kasus; ?></td>
                      <td>
                        <?php echo $b->nama ?>
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
            <form method="post" action="<?= base_url().'page/kasussiswa/detail/'.$siswa->nisn ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH PENINDAKAN KASUS SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                    <select name="nisn" class="form-control" readonly>
                      <option selected value="<?= $siswa->nisn ?>"><?= $siswa->nama ?></option>
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
      <div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/kasussiswaguru/simpan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH PENINDAKAN KASUS SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                    <select name="nisn" class="form-control" readonly>
                      <option selected value="<?= $siswa->nisn ?>"><?= $siswa->nama ?></option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tanggal Laporan</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Deskripsi Penindakan</label>
                    <textarea name="kasus" class="form-control" rows="5"></textarea>
                </div>
              
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="KIRIM">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>




