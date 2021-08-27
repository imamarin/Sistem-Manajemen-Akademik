<script type="text/javascript">
if(window.history.replaceState){
  window.history.replaceState(null,null,window.location.href);
}
function edit(n,x,y,z,i,w){
    //selectItemByValue(document.getElementsByName("pekan")[0],"2");
    //document.getElementsByName("pekan")[0].value=2;

    document.getElementById("kdkatkeuangan").value=x;
    document.getElementById("biaya").value=y;
    document.getElementById("biaya2").innerHTML=y;
    document.getElementById("idnonspp").value=z;
    document.getElementById("iddetailnonspp").value=i;
    document.getElementById("waktu").innerHTML=w;
    document.getElementById("title").innerHTML="EDIT PEMBAYARAN <?= $katkeuangan ?>";
    document.getElementById("btn").innerHTML="UBAH";
    document.getElementById("btn").value="UBAH";
    document.getElementsByName("btnedit"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnedit"+n)[0].setAttribute("data-target","#modal-default");
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
            <div class="card-header">
               <?php 
            if(in_array("Pencarian-10", $this->session->fitur)){
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
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <div class="row">
                  <div class="col-md-2 col-2">
                    <label>NISN</label>:
                    <p><?= $nisn ?></p>
                  </div>
                  <div class="col-md-3 col-3">
                    <label>Nama Siswa</label>:
                    <p><?= strtoupper($nama) ?></p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label>Kelas</label>:
                    <p><?= $kdkelas ?></p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label>Pembayaran Angsuran</label>:
                    <p><?= $katkeuangan ?></p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label>Biaya</label>:
                    <p><?= "Rp. ".number_format($biaya,0,'','.'); ?></p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-12">
              
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>UANG MASUK</th>
                      <th>TANGGAL BAYAR</th>
                      <?php 
                        if(in_array("Edit Angsuran-10", $this->session->fitur) || in_array("Hapus Angsuran2-10", $this->session->fitur)){
                      ?>
                      <th>PILIH</th>
                      <?php
                        }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no=1;
                    foreach ($transaksi as $key => $val) {
                      # code...
                    ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= "Rp. ".number_format($val->bayar,0,'','.'); ?></td>
                        <td><?= $val->waktu ?></td>
                        <?php 
                        if(in_array("Edit Angsuran-10", $this->session->fitur) || in_array("Hapus Angsuran2-10", $this->session->fitur)){
                        ?>
                        <td>
                          <form method="post" name="angsuranForm<?= $no ?>" action="<?= base_url()."page/pembayarannonspp/detailangsuran" ?>">
                            <input type="hidden" name="nisn" value="<?= $nisn ?>">
                            <input type="hidden" name="kdkatkeuangan" value="<?= $val->kdkatkeuangan ?>">
                            <input type="hidden" name="nama" value="<?= $katkeuangan ?>">
                            <input type="hidden" name="biaya" value="<?= $val->biaya ?>">
                            <input type="hidden" name="idnonspp" value="<?= $val->idnonspp ?>">
                            <input type="hidden" name="iddetailnonspp" value="<?= $val->iddetailnonspp ?>">
                            <?php 
                            if(in_array("Edit Angsuran-10", $this->session->fitur)){
                            ?>
                            <button type="button" name="btnedit<?= $no ?>" value="edit" class="btn btn-info" onclick="edit('<?= $no ?>','<?= $val->kdkatkeuangan ?>','<?= $val->biaya ?>','<?= $val->idnonspp ?>','<?= $val->iddetailnonspp ?>','<?= $val->waktu ?>');"><i class="fa fa-edit"></i></button>
                            <?php
                            }

                            if(in_array("Hapus Angsuran-10", $this->session->fitur)){
                            ?>
                            <button type="submit" name="hapus" value="hapus"class="btn btn-danger"><i class="fa fa-trash"></i></button>
                            <?php
                            }
                            ?>
                          </form>
                        </td>
                        <?php
                      }
                      ?>
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
            <form method="post" name="editAngsuranForm" action="<?= base_url()."page/pembayarannonspp/detailangsuran" ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="title"> </h4>
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
                    <label>Tanggal Pembayaran</label>:
                    <p id="waktu"></p>
                  </div>
                </div>
                <div class="row">  
                  <div class="col-md-6 col-6">
                    <label>Kelas</label>:
                    <p><?= $kdkelas ?></p>
                  </div>
                  <div class="col-md-6 col-6">
                    <label>Edit Uang Masuk</label>:
                    <p>
                      <input type="text" name="ubay" class="form-control">
                    </p>
                  </div>
                </div>
                  <input type="hidden" name="nisn" value="<?= $nisn ?>">
                  <input type="hidden" name="kdkatkeuangan" id="kdkatkeuangan">
                  <input type="hidden" name="nama" value="<?= $katkeuangan ?>">
                  <input type="hidden" name="biaya" id="biaya">
                  <input type="hidden" name="idnonspp" id="idnonspp">
                  <input type="hidden" name="iddetailnonspp" id="iddetailnonspp">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="edit" class="btn btn-primary" value="BAYAR" id="btn">BAYAR</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


