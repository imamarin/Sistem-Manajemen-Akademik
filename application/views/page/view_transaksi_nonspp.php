<script type="text/javascript">
if(window.history.replaceState){
  window.history.replaceState(null,null,window.location.href);
}

function tunai(n,x,y,z,b){
    //selectItemByValue(document.getElementsByName("pekan")[0],"2");
    //document.getElementsByName("pekan")[0].value=2;
    //alert(n+x+y+z+b);
    document.getElementById("tunai_kdkatkeuangan").value=y;
    document.getElementById("biaya").innerHTML=b;
    document.getElementById("tunai_nisn").value=x;
    document.getElementById("tunai_biaya").value=b;
    document.getElementById("title").innerHTML="PEMBAYARAN TUNAI "+z;
    document.getElementById("tunai_metode").value="tunai";
    document.getElementById("btn").innerHTML="BAYAR";
    document.getElementById("btn").value="TUNAI";
    document.getElementsByName("btnbayar"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnbayar"+n)[0].setAttribute("data-target","#modal-default");
}  

function hapus(n,x,y,z,b,i,s){
    document.getElementById("tunai_kdkatkeuangan").value=y;
    document.getElementById("biaya").innerHTML=b;
    document.getElementById("tunai_nisn").value=x;
    document.getElementById("tunai_biaya").value=b;
    document.getElementById("tunai_idnonspp").value=i;
    document.getElementById("tunai_iddetailnonspp").value=s;
    document.getElementById("title").innerHTML="BATALKAN PEMBAYARAN "+z;
    document.getElementById("btn").innerHTML="BATAL";
    document.getElementById("btn").value="BATAL";
    document.getElementsByName("btnhapus"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnhapus"+n)[0].setAttribute("data-target","#modal-default");
}

function angsuran(n,x,y,z,b,t){
    document.getElementById("ang_kdkatkeuangan").value=y;
    document.getElementById("biaya2").innerHTML=b;
    document.getElementById("ang_nisn").value=x;
    document.getElementById("ang_biaya").value=b;
    document.getElementById("ang_metode").value="angsuran";
    document.getElementById("title2").innerHTML="ANGSURAN PEMBAYARAN "+z;
    document.getElementById("btn2").innerHTML="BAYAR";
    document.getElementById("btn2").value="ANGSURAN";
    document.getElementById("sisa").innerHTML=b-t;
    document.getElementsByName("ubay")[0].focus();
    document.getElementsByName("btnangsuran"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnangsuran"+n)[0].setAttribute("data-target","#modal-default2");
}

function detailangsuran(n,x,y,z,b,t,i){
    document.getElementById("dtl_ang_nisn"+n).value=x;
    document.getElementById("dtl_ang_kdkatkeuangan"+n).value=y;
    document.getElementById("dtl_ang_nama"+n).value=z;
    document.getElementById("dtl_ang_biaya"+n).value=b;
    document.getElementById("dtl_ang_total"+n).value=t;
    document.getElementById("dtl_ang_idnonspp"+n).value=i;
    document.getElementsByName("angsuranForm"+n)[0].action="<?= base_url() ?>page/pembayarannonspp/detailangsuran";
    document.getElementsByName("angsuranForm"+n)[0].submit();
}

function angsuran1(n,x,y,z,b,t){
    document.getElementById("ang_kdkatkeuangan").value=y;
    document.getElementById("biaya2").innerHTML=b;
    document.getElementById("ang_nisn").value=x;
    document.getElementById("ang_biaya").value=b;
    document.getElementById("title2").innerHTML="ANGSURAN PEMBAYARAN "+z;
    document.getElementById("btn2").innerHTML="BAYAR";
    document.getElementById("ang_metode").value="angsuran";
    document.getElementById("btn2").value="ANGSURAN1";
    document.getElementById("sisa").innerHTML=b-t;
    document.getElementsByName("ubay")[0].focus();
    document.getElementsByName("btnangsuran"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnangsuran"+n)[0].setAttribute("data-target","#modal-default2");
}
</script>

<?php
function bulan($x){
  $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
  return $bulan[$x];
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
            <h1 class="m-0 text-dark">Pembayaran Keuangan Siswa</h1>
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
            <?php 
            if(in_array("Pencarian Semua-10", $this->session->fitur)){
            ?>
            <div class="card-header">
              <?= form_open($form_action) ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-4">
                      <label>Nama Siswa</label>
                      <select name="nisn" class="select2" data-placeholder="Pilih Siswa" data-dropdown-css-class="select2-blue" style="width: 100%;" required="">
                          <option></option>
                          <?php
                            foreach ($siswa as $key => $v) {
                              # code...
                              if($v->nisn==$nisn){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->nisn ?>" <?= $s ?> ><?= $v->nama." (".strtoupper($v->nisn).")"; ?></option>
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
          <?php
          }
          ?>
            <!-- /.card-header -->
            <div class="card-body">
            <?php
            if($spp!=NULL){
            ?>
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="row">
                  <div class="col-12 col-md-2 col-sm-12">
                    <label>NISN</label>:
                    <p><?= $nisn ?></p>
                  </div>
                  <div class="col-12 col-md-3 col-sm-12">
                    <label>Nama Siswa</label>:
                    <p><?= strtoupper($nama) ?></p>
                  </div>
                  <div class="col-12 col-md-2 col-sm-12">
                    <label>Kelas</label>:
                    <p><?= $kdkelas ?></p>
                  </div>
                  <div class="col-12 col-md-2 col-sm-12">
                    <label>Total Tagihan</label>:
                    <p>
                    <?php
                      $total=0;
                     foreach ($totaltagihan as $key => $val) {
                      $total=$total+($val->biaya-$val->tagihan);
                     }
                     echo "Rp. ".number_format($total,0,'','.');
                    ?>
                    </p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label></label>:
                    <p><button class="btn btn-primary" data-toggle="modal" data-target="#modal-default3">Cetak Transaksi</button></p>

                        <div class="modal fade" id="modal-default3">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="title">Transaksi Pembayaran NON SPP</h4>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                      <table style="width:100%" id="example2" class="table table-bordered table-striped dt-responsive ">
                                        <thead>
                                          <tr>   
                                            <th>No</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Cetak</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                          $no=1;
                                          foreach ($histori as $key => $v) {
                                            # code...
                                            ?>
                                            <tr>
                                              <td><?= $no ?></td>
                                              <td><?= $v->waktu ?></td>
                                              <td>
                                              <a href="<?= base_url('page/pembayarannonspp/cetaknonspp/').$v->nisn."/".date('Y-m-d', strtotime($v->waktu)) ?>" target="_blank"><button class="btn btn-primary"><i class="fas fa-print"></i></button></a>
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
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                              <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                          </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
            }
            ?>
            <div class="row">
              <div class="col-sm-12 col-md-12">
              
                <table id="example4" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>

                    <tr>
                      <th>NO</th>
                      <th>KEUANGAN</th>
                      <th>BIAYA</th>
                      <th>SISA TAGIHAN</th>
                      <th>TANGGAL BAYAR</th>
                      <th>KETERANGAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($spp!=NULL){
                      $no=1;
                      foreach ($keuangan as $key => $val) {
                        $tgl="";
                        $ket="<div class='margin'><div class='btn-group' style='width:100%;'>
                                    <button type='button' class='btn btn-danger' style='width:100%;'>LAKUKAN PEMBAYARAN</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                      <span class='sr-only'>Toggle Dropdown</span>
                                      <div class='dropdown-menu' role='menu'>
                                        <a class='dropdown-item' name='btnbayar$no' data-toggle='' data-target='' onclick='tunai(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\");' style='cursor:pointer'>Tunai</a>
                                        <a class='dropdown-item' name='btnangsuran$no' data-toggle='' data-target='' onclick='angsuran1(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",0);' style='cursor:pointer'>Angsuran</a>
                                      </div>
                                    
                                  </div></div>";
                        $ket2="<button type='button' class='btn btn-danger' style='width:100%;'>BELUM BAYAR</button>";
                        ?>
                          
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $val->nama ?></td>
                        <td><?= "Rp. ".number_format($val->biaya,0,'','.'); ?></td>
                        <td><?= "Rp. ".number_format($val->biaya-$val->tagihan,0,'','.'); ?></td>
                        <?php
                        $angsuran=0;
                        foreach ($transaksi as $key => $v) {
                          if($val->kdkatkeuangan == $v->kdkatkeuangan){
                            $tgl = $v->waktu;
                            if($v->total>=$v->biaya){
                              if($v->metode=="tunai"){
                                $ket="<div class='margin'><div class='btn-group' style='width:100%;'>
                                        <button type='button' class='btn btn-success' style='width:100%;'>SUDAH BAYAR (TUNAI)</button>
                                        <button type='button' class='btn btn-success dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                          <span class='sr-only'>Toggle Dropdown</span>
                                          <div class='dropdown-menu' role='menu'>
                                            <a class='dropdown-item' name='btnhapus$no' data-toggle='' data-target='' onclick='hapus(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",\"".$v->idnonspp."\",\"".$v->iddetailnonspp."\");' style='cursor:pointer'>Batalkan</a>
                                          </div>
                                        
                                      </div></div>";
                                $angsuran=0;
                                $ket2="<button type='button' class='btn btn-success' style='width:100%;'>SUDAH BAYAR</button>";
                              }else{
                                $ket="<div class='margin'><div class='btn-group' style='width:100%;'>
                                        <button type='button' class='btn btn-success' style='width:100%;'>SUDAH BAYAR (ANGSURAN)</button>
                                        <button type='button' class='btn btn-success dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                          <span class='sr-only'>Toggle Dropdown</span>
                                          <div class='dropdown-menu' role='menu'>
                                            <a class='dropdown-item' name='btndetailangsuran$no' style='cursor:pointer' onclick='detailangsuran(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",\"".$v->total."\",\"".$v->idnonspp."\");'>Lihat Detail Angsuran</a>
                                          </div>
                                        
                                      </div></div>";
                                $angsuran=1;
                                $ket2="<div class='margin'><div class='btn-group' style='width:100%;'>
                                        <button type='button' class='btn btn-success' style='width:100%;'>SUDAH BAYAR (ANGSURAN)</button>
                                        <button type='button' class='btn btn-success dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                          <span class='sr-only'>Toggle Dropdown</span>
                                          <div class='dropdown-menu' role='menu'>
                                            <a class='dropdown-item' name='btndetailangsuran$no' style='cursor:pointer' onclick='detailangsuran(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",\"".$v->total."\",\"".$v->idnonspp."\");'>Lihat Detail Angsuran</a>
                                          </div>
                                        
                                      </div></div>";
                              }
                            }else{
                                if($v->metode!="belum bayar"){
                                $ket="<div class='margin'><div class='btn-group' style='width:100%;'>
                                    <button type='button' class='btn btn-warning' style='width:100%;'>ANGSURAN</button>
                                    <button type='button' class='btn btn-warning dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                      <span class='sr-only'>Toggle Dropdown</span>
                                      <div class='dropdown-menu' role='menu'>
                                        <a class='dropdown-item' name='btnangsuran$no' data-toggle='' data-target='' onclick='angsuran(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",\"".$v->total."\");' style='cursor:pointer'>Bayar Angsuran</a>
                                        <a class='dropdown-item' name='btndetailangsuran$no' style='cursor:pointer' onclick='detailangsuran(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",\"".$v->total."\",\"".$v->idnonspp."\");'>Lihat Detail Angsuran</a>
                                      </div>
                                    
                                  </div></div>";  
                                  $angsuran=1;
                                  $ket2="<div class='margin'><div class='btn-group' style='width:100%;'>
                                    <button type='button' class='btn btn-warning' style='width:100%;'>ANGSURAN</button>
                                    <button type='button' class='btn btn-warning dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                      <span class='sr-only'>Toggle Dropdown</span>
                                      <div class='dropdown-menu' role='menu'>
                                       
                                        <a class='dropdown-item' name='btndetailangsuran$no' style='cursor:pointer' onclick='detailangsuran(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",\"".$v->total."\",\"".$v->idnonspp."\");'>Lihat Detail Angsuran</a>
                                      </div>
                                    
                                  </div></div>";
                                }else{
                                  $tgl = "";
                                  $ket="<div class='margin'><div class='btn-group' style='width:100%;'>
                                          <button type='button' class='btn btn-danger' style='width:100%;'>LAKUKAN PEMBAYARAN</button>
                                          <button type='button' class='btn btn-danger dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                            <span class='sr-only'>Toggle Dropdown</span>
                                            <div class='dropdown-menu' role='menu'>
                                              <a class='dropdown-item' name='btnbayar$no' data-toggle='' data-target='' onclick='tunai(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\");' style='cursor:pointer'>Tunai</a>
                                              <a class='dropdown-item' name='btnangsuran$no' data-toggle='' data-target='' onclick='angsuran1(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",0);' style='cursor:pointer'>Angsuran</a>
                                            </div>
                                          
                                        </div></div>";
                                        $angsuran=0;
                                        $ket2="<button type='button' class='btn btn-danger' style='width:100%;'>BELUM BAYAR</button>";
                                }
                            }
                            break;
                          }else{
                            $tgl = "";
                            $ket="<div class='margin'><div class='btn-group' style='width:100%;'>
                                    <button type='button' class='btn btn-danger' style='width:100%;'>LAKUKAN PEMBAYARAN</button>
                                    <button type='button' class='btn btn-danger dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                      <span class='sr-only'>Toggle Dropdown</span>
                                      <div class='dropdown-menu' role='menu'>
                                        <a class='dropdown-item' name='btnbayar$no' data-toggle='' data-target='' onclick='tunai(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\");' style='cursor:pointer'>Tunai</a>
                                        <a class='dropdown-item' name='btnangsuran$no' data-toggle='' data-target='' onclick='angsuran1(\"".$no."\",\"".$nisn."\",\"".$val->kdkatkeuangan."\",\"".strtoupper($val->nama)."\",\"".$val->biaya."\",0);' style='cursor:pointer'>Angsuran</a>
                                      </div>
                                    
                                  </div></div>";
                                  $angsuran=0;
                                  $ket2="<button type='button' class='btn btn-danger' style='width:100%;'>BELUM BAYAR</button>";
                          }
                        }
                        ?>
                        <td><?= $tgl ?></td>
                        <td>
                          <?php 
                          if(in_array("Aksi-10", $this->session->fitur)){

                            echo $ket;

                            if($angsuran==1){
                              ?>
                              <form method="post" name="angsuranForm<?= $no ?>" action="">
                                <input type="hidden" name="nisn" id="dtl_ang_nisn<?= $no ?>">
                                <input type="hidden" name="kdkatkeuangan" id="dtl_ang_kdkatkeuangan<?= $no ?>">
                                <input type="hidden" name="nama" id="dtl_ang_nama<?= $no ?>">
                                <input type="hidden" name="biaya" id="dtl_ang_biaya<?= $no ?>">
                                <input type="hidden" name="idnonspp" id="dtl_ang_idnonspp<?= $no ?>">
                                <input type="hidden" name="total" id="dtl_ang_total<?= $no ?>">
                                <input type="hidden" name="metode" id="dtl_ang_metode<?= $no ?>">
                              </form>
                              <?php
                            }
                          }else{
                            echo $ket2;

                            if($angsuran==1){
                              ?>
                              <form method="post" name="angsuranForm<?= $no ?>" action="">
                                <input type="hidden" name="nisn" id="dtl_ang_nisn<?= $no ?>">
                                <input type="hidden" name="kdkatkeuangan" id="dtl_ang_kdkatkeuangan<?= $no ?>">
                                <input type="hidden" name="nama" id="dtl_ang_nama<?= $no ?>">
                                <input type="hidden" name="biaya" id="dtl_ang_biaya<?= $no ?>">
                                <input type="hidden" name="idnonspp" id="dtl_ang_idnonspp<?= $no ?>">
                                <input type="hidden" name="total" id="dtl_ang_total<?= $no ?>">
                                <input type="hidden" name="metode" id="dtl_ang_metode<?= $no ?>">
                              </form>
                              <?php
                            }
                          }
                          ?>
                        </td>
                      </tr>
                    <?php
                        $no++;
                      }
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

