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
            <h1 class="m-0 text-dark">Laporan Transaksi</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan Transaksi</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    

    <section class="content">
      
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <?php 
              if(in_array("Pencarian-18", $this->session->fitur)){
              ?>
              <?= form_open($form_action); ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-2">
                      <label>Dari</label>
                      <input type="date" name="tanggal1" class="form-control" value="<?= $tgl1 ?>">
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Sampai</label>
                      <input type="date" name="tanggal2" class="form-control" value="<?= $tgl2 ?>">
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value="Simpan" class="btn btn-success" style="width: 100%;" ><i class="fas fa-search"></i>Cari</button>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                    <a href="<?= base_url('page/laporantransaksi/cetak/'.$tgl1.'/'.$tgl2) ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-print"></i></button></a>
                    </div>


                <!-- /.col -->
              </div>            
              <?= form_close(); ?>
              <?php
              }
              ?>
            </div>
          </div>
        </div>     
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5>Transaksi SPP</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Waktu Pembayaran</th>
                      <th>NISN</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Uang Masuk</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($spp as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->waktu; ?></td>
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->bulan; ?></td>
                      <td><?php echo $b->tahun; ?></td>
                      <td><?php echo $b->biaya; ?></td>
                      
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

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5>Transaksi Pembayaran Lainnya</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table id="example2" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Waktu Pembayaran</th>
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Jenis Keuangan</th>
                      <th>Uang Masuk</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($nonspp as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->waktu; ?></td>
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->nmsiswa; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->bayar; ?></td>                      
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


