<script type="text/javascript">
if(window.history.replaceState){
  window.history.replaceState(null,null,window.location.href);
}
</script>

<?php
function bulan($x){
  $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
  return $bulan[$x];
}

function jmlbulan($tgl_terima){
    $awal=date('Y',strtotime($tgl_terima));
    $akhir=$awal+3;
    $blnawal=date('n',strtotime($tgl_terima))-1;
    $jml = 0;
    for($a=$awal;$a<=$akhir;$a++){

        if($a > $awal && $a < $akhir){
            $bln=0;
            $blnakhir=12;
        }else{
                          
            if($a >= $akhir){
                $bln=0;
                $blnakhir=$blnawal--;
            }else{
                $bln=$blnawal;
                $blnakhir=12;
            }

        }
                        
        for($b=$bln;$b<$blnakhir;$b++){
            $jml++;
        }
    }

    return $jml;
}

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
            <h1 class="m-0 text-dark">Tagihan Keuangan Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pembayaran Keuangan Siswa</a></li>
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
              <?= form_open($form_action) ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-4">
                      <label>KELAS</label>
                        <select name="kdkelas" class="select2" data-placeholder="Kelas" style="width: 100%;" data-dropdown-css-class="select2-blue" required>
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
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value='tampil' class="btn btn-success" style="width: 100%;" >Tampilkan</button>
                    </div>
                <!-- /.col -->
              </div>      
              <?= form_close() ?>      
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-12">
              
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>NISN</th>
                      <th>NAMA SISWA</th>
                      <th>KELAS</th>
                      <th>TAGIHAN SPP</th>
                      <th>TAGIHAN NON SPP</th>
                      <th>CETAK</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    foreach($tagihan as $v){
                    ?>
                    <tr>
                        <td><?= $no ?></td>  
                        <td><?= $v->nisn ?></td>  
                        <td><?= $v->nama ?></td>  
                        <td><?= $v->kdkelas ?></td>  
                        <td><?= (($tb=totBulan($v->tgl_terima)-$v->tagihanspp)<0) ? "0":$tb; ?> Bulan</td>  
                        <td>
                        <?php
                            echo "Rp. ".number_format($v->biaya - $v->tagihannonspp,0,'','.');
                        ?>
                        </td>
                        <td>
                        <a href="<?= base_url('page/tagihankeuangan/cetak/').$v->nisn ?>" target="_blank"><button class="btn btn-primary"><i class="fas fa-print"></i></button></a>
                        </td> 
                    </tr> 
                    <?php
                    $no++;
                    }
                    ?>
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
            <form method="post" name="formData" action="<?= base_url().$form_action2 ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                        
              <div class="row">

                  <div class="col-md-4 col-4">
                    <label>NISN</label>:
                    <p><?= $nisn ?></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4 col-4">
                    <label>Nama Siswa</label>:
                    <p><?= strtoupper($nama) ?></p>
                  </div>
                </div>
                <div class="row">  
                  <div class="col-md-4 col-4">
                    <label>Kelas</label>:
                    <p><?= $kdkelas ?></p>
                  </div>
                </div>
                <div class="row">  
                  <div class="col-md-4 col-4">
                    <label>Biaya</label>:
                    <p id="biaya"></p>
                  </div>
                </div>
                  <input type="hidden" name="nisn" id="tunai_nisn">
                  <input type="hidden" name="kdkatkeuangan" id="tunai_kdkatkeuangan">
                  <input type="hidden" name="biaya" id="tunai_biaya">
                  <input type="hidden" name="idnonspp" id="tunai_idnonspp">
                  <input type="hidden" name="iddetailnonspp" id="tunai_iddetailnonspp">
                  <input type="hidden" name="metode" id="tunai_metode">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="BAYAR" id="btn">BAYAR</button>
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
            <form method="post" name="formData" action="<?= base_url().$form_action2 ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="title2"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                        
              <div class="row">

                  <div class="col-md-6 col-6">
                    <label>NISN</label>:
                    <p><?= $nisn ?></p>
                  </div>
                  <div class="col-md-6 col-6">
                    <label>Biaya</label>:
                    <p id="biaya2"></p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-6">
                    <label>Nama Siswa</label>:
                    <p><?= strtoupper($nama) ?></p>
                  </div>
                  <div class="col-md-6 col-6">
                    <label>Sisa Pembayaran</label>:
                    <p id="sisa"></p>
                  </div>
                </div>
                <div class="row">  
                  <div class="col-md-6 col-6">
                    <label>Kelas</label>:
                    <p><?= $kdkelas ?></p>
                  </div>
                  <div class="col-md-6 col-6">
                    <label>Bayar Berikutnya</label>:
                    <p>
                      <input type="text" name="ubay" class="form-control">
                    </p>
                  </div>
                </div>
                  <input type="hidden" name="nisn" id="ang_nisn">
                  <input type="hidden" name="kdkatkeuangan" id=ang_kdkatkeuangan>
                  <input type="hidden" name="biaya" id="ang_biaya">
                  <input type="hidden" name="idnonspp" id="ang_idnonspp">
                  <input type="hidden" name="iddetailnonspp" id="ang_iddetailnonspp">
                  <input type="hidden" name="metode" id="ang_metode">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="BAYAR" id="btn2">BAYAR</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

