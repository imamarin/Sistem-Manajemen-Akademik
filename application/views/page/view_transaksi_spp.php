<script type="text/javascript">
function bayar(n,x,y,z,b){
    //selectItemByValue(document.getElementsByName("pekan")[0],"2");
    //document.getElementsByName("pekan")[0].value=2;

    document.getElementsByName("bulan")[0].value=x;
    document.getElementsByName("bln")[0].innerHTML=x;
    document.getElementsByName("tahun")[0].value=y;
    document.getElementsByName("thn")[0].innerHTML=y;
    document.getElementsByName("by")[0].innerHTML=b;
    document.getElementById("nisn").value=z;
    document.getElementsByName("biaya")[0].value=b;
    document.getElementsByName("btnbayar"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnbayar"+n)[0].setAttribute("data-target","#modal-default");
}  

function hapus(n,x,y,z,b,i){
    document.getElementsByName("bulan")[0].value=x;
    document.getElementsByName("bln")[0].innerHTML=x;
    document.getElementsByName("tahun")[0].value=y;
    document.getElementsByName("thn")[0].innerHTML=y;
    document.getElementById("nisn").value=z;
    document.getElementsByName("biaya")[0].value=b;
    document.getElementsByName("idspp")[0].value=i;
    document.getElementById("title").innerHTML="BATAL PEMBAYARAN SPP";
    document.getElementById("btn").innerHTML="BATALKAN";
    document.getElementById("btn").value="BATAL";
    document.getElementsByName("btnhapus"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnhapus"+n)[0].setAttribute("data-target","#modal-default");

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
            <h1 class="m-0 text-dark">Pembayaran SPP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Pembayaran SPP</a></li>
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
           
              <?php 
              if(in_array("Pencarian Semua-9", $this->session->fitur)){
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
                              ?>
                              <option value="<?= $v->nisn ?>"><?= $v->nama." (".strtoupper($v->nisn).")"; ?></option>
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
                  <div class="col-12 col-md-1 col-sm-12">
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
                    <label>Pembayaran</label>:
                    <p>SPP</p>
                  </div>
                  <div class="col-12 col-md-2 col-sm-12">
                    <label>Biaya</label>:
                    <p><?= $biaya ?></p>
                  </div>
                  <div class="col-12 col-md-2 col-sm-12">
                    <label></label>:
                    <p><button class="btn btn-primary" data-toggle="modal" data-target="#modal-default2">Cetak Transaksi</button></p>

                        <div class="modal fade" id="modal-default2">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h4 class="modal-title" id="title">Pembayaran SPP</h4>
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
                                              <a href="<?= base_url('page/pembayaranspp/cetakspp/').$v->nisn."/".date('Y-m-d', strtotime($v->waktu)) ?>" target="_blank"><button class="btn btn-primary"><i class="fas fa-print"></i></button></a>
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
                      <th>BULAN</th>
                      <th>TAHUN</th>
                      <th>TANGGAL BAYAR</th>
                      <th>KETERANGAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    if($spp!=NULL){
                      $awal=date('Y',strtotime($tgl_terima));
                      $akhir=$awal+3;
                      $blnawal=date('n',strtotime($tgl_terima))-1;
                      $no=1;
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

                          $bln2=bulan($b);
                          $ket="<button type='button' name='btnbayar$no' value='bayar' class='btn btn-danger' data-toggle='' data-target='' datastyle='width: 100%;' onclick='bayar(\"".$no."\",\"".bulan($b)."\",".$a.","."\"".$nisn."\","."\"".$biaya."\");'>LAKUKAN PEMBAYARAN</button>";

                          $waktu="";
                          $ket2="<button type='button' class='btn btn-danger' style='width:100%;'>BELUM BAYAR</button>";
                          foreach ($transaksi2 as $key => $val) {
                                  # code...
                            if(bulan($b)==$val->bulan && $a == $val->tahun){
                              $id=$val->idspp;
                              $ket="<div class='btn-group' style='width:100%;'>
                                    <button type='button' class='btn btn-success' style='width:100%;'>SUDAH BAYAR</button>
                                    <button type='button' class='btn btn-success dropdown-toggle dropdown-icon' data-toggle='dropdown'></button>
                                      <span class='sr-only'>Toggle Dropdown</span>
                                      <div class='dropdown-menu' role='menu'>
                                        <a class='dropdown-item' name='btnhapus$no' data-toggle='' data-target='' onclick='hapus(\"".$no."\",\"".bulan($b)."\",".$a.","."\"".$nisn."\","."\"".$biaya."\",\"".$val->idspp."\");' style='cursor:pointer'>Batalkan</a>
                                      </div>
                                    
                                  </div>";
                              $waktu=$val->waktu;
                              $ket2="<button type='button' class='btn btn-success' style='width:100%;'>SUDAH BAYAR</button>";
                              break;
                            }else{
                              $ket="<button type='button' name='btnbayar$no' value='BAYAR' class='btn btn-danger' style='width: 100%;' data-toggle='' data-target='' onclick='bayar(\"".$no."\",\"".bulan($b)."\",".$a.","."\"".$nisn."\","."\"".$biaya."\");'>LAKUKAN PEMBAYARAN</button>";
                              $waktu="";
                              $ket2="<button type='button' class='btn btn-danger' style='width:100%;'>BELUM BAYAR</button>";
                            }

                          }
                          ?>
                          
                          <tr>
                            <td><?= $no ?></td>
                            <td><?= bulan($b) ?></td>
                            <td><?= $a ?></td>
                            <td><?= $waktu ?></td>
                            <td>
                              <?php
                              if(in_array("Aksi-9", $this->session->fitur)){
                                echo $ket;
                              }else{
                                echo $ket2;
                              }
                              ?>

                              
                            </td>
                          </tr>

                          <?php
                          $no++;
                        }
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
              <h4 class="modal-title" id="title">PEMBAYARAN SPP</h4>
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
                    <label>Bulan</label>:
                    <p name="bln"></p>
                  </div>
                </div>
                <div class="row">  
                  <div class="col-md-4 col-4">
                    <label>Tahun</label>:
                    <p name="thn"></p>
                  </div>
                </div>
                <div class="row">  
                  <div class="col-md-4 col-4">
                    <label>Biaya</label>:
                    <p name="by"></p>
                  </div>
                </div>
                  <input type="hidden" name="nisn" id="nisn">
                  <input type="hidden" name="bulan">
                  <input type="hidden" name="tahun">
                  <input type="hidden" name="biaya">
                  <input type="hidden" name="idspp">
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

