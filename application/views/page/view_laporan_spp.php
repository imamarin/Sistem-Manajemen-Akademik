
<?php
function totBulan($tgl){
  //data awal

  $tgl_mulai=$tgl;
  $tgl_selesai=date('Y-m-d');
   
  //convert
  $timeStart = strtotime($tgl_mulai);
  $timeEnd = strtotime($tgl_selesai);
   
  // Menambah bulan ini + semua bulan pada tahun sebelumnya
  $numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
   
  // hitung selisih bulan
  $numBulan += date("m",$timeEnd)-date("m",$timeStart);
   
  return $numBulan; 
}
?>
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
            <h1 class="m-0 text-dark">Laporan Pembayaran SPP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Laporan Pembayaran SPP</a></li>
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
              if(in_array("Pencarian-21", $this->session->fitur)){
              ?>
              <?= form_open($form_action); ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-2">
                      <label>Tahun Ajaran</label>
                      <select name="tahunajaran" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php
                            foreach ($tahun as $key => $v) {
                              # code...
                              if($v->idtahunajaran == $thn){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->tahun ?>" <?= $s; ?> ><?= $v->tahun; ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Kelas</label>
                      <select name="kdkelas" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                        <option value="semua">Semua</option>
                          <?php
                            foreach ($kelas as $key => $v) {
                              # code...
                              if($v->kdkelas == $kls){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->kdkelas ?>" <?= $s; ?> ><?= $v->kdkelas; ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value="Simpan" class="btn btn-success" style="width: 100%;" ><i class="fas fa-search"></i>Cari</button>
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
              <h5>Laporan Pembayaran SPP</h5>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Total Bulan</th>
                      <th>Tunggakan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo totBulan($b->tgl_terima); ?></td>
                      <td>
                        <?php 
                          $tunggak=totBulan($b->tgl_terima)-intval($b->total);
                          if($tunggak > 0){
                            echo "<button class='btn btn-danger'>$tunggak Bulan</button>";
                          }else{
                            echo "<button class='btn btn-success'>Lunas Pembayaran</button>";
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


