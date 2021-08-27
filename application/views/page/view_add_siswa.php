<style type="text/css">
  fieldset.scheduler-border {
    border: 1px groove #E6E6FA !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #E6E6FA;
            box-shadow:  0px 0px 0px 0px #E6E6FA;
}

    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        width:auto;
        padding:0 10px;
        border-bottom:none;
    }
</style>
<?php

  if(in_array("Validasi Pengguna-1", $this->session->fitur) || in_array("Tampil Profil-4", $this->session->fitur)){
    $readonly="";
    $pg3=$this->uri->segment(1)."/".$this->uri->segment(2);
      if($pg3=="page/profil"){
         $readonly2="readonly";
      }else{
        $readonly2="";
      }
  }else{
      $readonly="readonly";
      $readonly2="";
  }
  ?>

    <link href="./bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
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
            <h1 class="m-0 text-dark">Input Data Siswa <?php //echo strtoupper(str_replace("%20"," ",$jdl)); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Modul</a></li>
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
        <div class="col-12 col-sm-12 col-md-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <?php echo form_open($form_action,array('enctype'=>"multipart/form-data")); ?>
                <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Identitas Siswa</legend>
                  <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>NISN</label>
                                <div class="select2-blue">
                                  <input type="text" name="nisn" style="width: 100%;" class="form-control" value="<?= $nisn ?>" <?= $tidakaktif ?> required>
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>NIS</label>
                                <div class="select2-blue">
                                  <input type="text" name="nis" style="width: 100%;" class="form-control" value="<?= $nis ?>" <?= $tidakaktif ?>>
                                </div>
                          </div>
                      </div><br>

                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>NIK</label>
                                <div class="select2-blue">
                                  <input type="text" name="nik" style="width: 100%;" class="form-control" value="<?= $nik ?>">
                                </div>
                          </div>
                      </div><br>
                      
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Nama Siswa </label>
                                <div class="select2-blue">
                                  <input type="text" name="nama" style="width: 100%;" class="form-control" value="<?= $nama?>" required>
                                </div>
                          </div>
                      </div><br>
                      
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Tempat Lahir</label>
                                <div class="select2-blue">
                                  <input type="text" name="tmplahir" style="width: 100%;" class="form-control" value="<?= $tmplahir ?>">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Tanggal Lahir</label>
                                <div class="select2-blue">
                                  <input type="date" name="tgllahir" style="width: 100%;" class="form-control" value="<?= $tgllahir ?>">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Jenis Kelamin</label>
                                <?php
                                  if($jk=="L"){
                                    $l="checked";
                                  }else{
                                    $l="";
                                  }

                                  if($jk=="P"){
                                    $p="checked";
                                  }else{
                                    $p="";
                                  }
                                ?>
                                <div class="select2-blue">
                                  <input type="radio" name="jk" style="" value="L" <?= $l ?> required> Laki-Laki
                                  <input type="radio" name="jk" style="" value="P" <?= $p ?> required> Perempuan
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Anak Ke-</label>
                                <div class="select2-blue">
                                  <input type="number" name="anakke" style="width: 100%;" class="form-control" value="<?= $anakke ?>">
                                </div>
                          </div>
                      </div><br>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Agama</label>
                                <div class="select2-blue">
                                  <input type="text" name="agama" style="width: 100%;" class="form-control" value="<?= $agama ?>" readonly>
                                </div>
                          </div>
                      </div><br>
                      
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Asal Sekolah</label>
                                <div class="select2-blue">
                                  <input type="text" name="asalsekolah" style="width: 100%;" class="form-control" value="<?= $asalsekolah ?>">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Alamat Siswa</label>
                                <div class="select2-blue">
                                  <input type="text" name="alamatsiswa" style="width: 100%;" class="form-control" value="<?= $alamatsiswa ?>">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>No Hp. Siswa</label>
                                <div class="select2-blue">
                                  <input type="text" name="hpsiswa" style="width: 100%;" value="<?= $hpsiswa ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Tanggal Terima</label>
                                <div class="select2-blue">
                                  <input type="date" name="tglterima" readonly style="width: 100%;" value="<?= $tglterima ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Diterima di kelas</label>
                                <div class="select2-blue">
                                  <?php
                                  if($readonly=="readonly" || $readonly2=="readonly"){
                                  ?>
                                  <select name="kdkelas" style="width: 100%;" class="select2" data-dropdown-css-class="select2-blue">
                                    <?php
                                      foreach ($kelas as $key => $v) {
                                        if($kdkelas == $v->kdkelas){
                                          ?>
                                          <option value="<?= $v->kdkelas ?>" selected><?= $v->kdkelas ?></option>
                                          <?php
                                        }
                                      }
                                    ?>
                                    
                                  </select>
                                  <?php 
                                  }else{
                                    ?>
                                  <select name="kdkelas" style="width: 100%;" class="select2" data-dropdown-css-class="select2-blue">
                                    <option></option>
                                    <?php
                                      foreach ($kelas as $key => $v) {
                                        # code...
                                        if($kdkelas == $v->kdkelas){
                                          $kls="selected";
                                        }else{
                                          $kls="";
                                        }
                                        ?>
                                        <option value="<?= $v->kdkelas ?>" <?= $kls ?> ><?= $v->kdkelas ?></option>
                                        <?php
                                      }
                                    ?>
                                    
                                </select>
                                <?php
                              }
                              ?>
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Masuk Tahun Ajaran</label>
                                <div class="select2-blue">
                                  <?php
                                  if($readonly=="readonly" || $readonly2=="readonly"){
                                  ?>
                                  <select name="idtahunajaran" style="width: 100%;" class="select2" data-dropdown-css-class="select2-blue" required>
                                    <?php
                                      foreach ($tahun as $key => $v) {
                                        if($idtahunajaran == $v->idtahunajaran){
                                          ?>
                                          <option value="<?= $v->idtahunajaran ?>" selected ><?= $v->tahun ?></option>
                                          <?php
                                        }
                                      }
                                    ?>
                                    
                                  </select>
                                  <?php 
                                  }else{
                                    ?>
                                  <select name="idtahunajaran" style="width: 100%;" class="select2" data-dropdown-css-class="select2-blue" required>
                                    <?php
                                      foreach ($tahun as $key => $v) {
                                        if($idtahunajaran == $v->idtahunajaran){
                                          $thn="selected";
                                        }else{
                                          $thn="";
                                        }
                                        ?>
                                        <option value="<?= $v->idtahunajaran ?>" <?= $thn ?> ><?= $v->tahun ?></option>
                                        <?php
                                      }
                                    ?>
                                    
                                </select>
                                <?php
                                } 
                                ?>
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Status</label>
                                <?php
                                  if($status==1){
                                    $a="selected";
                                  }else{
                                    $a="";
                                  }

                                  if($status==0){
                                    $t="selected";
                                  }else{
                                    $t="";
                                  }
                                ?>
                                <div class="select2-blue">
                                  <select name="status" class="form-control">
                                    <option value="1" <?= $a ?> >Aktif</option>                                    
                                    <option value="0" <?= $t ?>>Tidak Aktif</option>                                    
                                  </select>
                                </div>
                          </div>
                      </div><br>
                    </div>
                </div>
                </fieldset>
                <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Data Orangtua Siswa</legend>
                  <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Nama Ayah</label>
                                <div class="select2-blue">
                                  <input type="text" name="nmayah" style="width: 100%;" value="<?= $nmayah ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Nama Ibu</label>
                                <div class="select2-blue">
                                  <input type="text" name="nmibu" style="width: 100%;" value="<?= $nmibu ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Pekerjaan Ayah</label>
                                <div class="select2-blue">
                                  <input type="text" name="pekayah" style="width: 100%;" value="<?= $pekayah ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Pekerjaan Ibu</label>
                                <div class="select2-blue">
                                  <input type="text" name="pekibu" style="width: 100%;" value="<?= $pekibu ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Alamat Orangtua</label>
                                <div class="select2-blue">
                                  <input type="text" name="alamatorangtua" style="width: 100%;" value="<?= $alamatorangtua ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>No Hp. Orangtua</label>
                                <div class="select2-blue">
                                  <input type="text" name="hporangtua" style="width: 100%;" value="<?= $hporangtua ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                      
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Nama Wali Peserta Didik</label>
                                <div class="select2-blue">
                                  <input type="text" name="walisiswa" style="width: 100%;" value="<?= $walisiswa ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Alamat Wali Peserta Didik</label>
                                <div class="select2-blue">
                                  <input type="text" name="alamatwali" style="width: 100%;" value="<?= $alamatwali ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Pekerjaan Wali Peserta Didik</label>
                                <div class="select2-blue">
                                  <input type="text" name="pekwali" style="width: 100%;" value="<?= $pekwali ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>No Hp/Tlp. Wali Peserta Didik</label>
                                <div class="select2-blue">
                                  <input type="text" name="nohpwali" style="width: 100%;" value="<?= $nohpwali ?>" class="form-control">
                                </div>
                          </div>
                      </div><br>
                    </div>
                </fieldset>
                <fieldset class="scheduler-border">
                  <legend class="scheduler-border">Validasi Pengguna</legend>

                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Username</label>
                                <div class="select2-blue">
                                <?php
                                  if($readonly=="readonly" || $readonly2=="readonly"){
                                  ?>
                                   <input type="text" name="username" style="width: 100%;" value="<?= $username ?>" class="form-control" readonly  required>
                                  <?php
                                  }else{
                                  ?>
                                  <input type="text" name="username" style="width: 100%;" value="<?= $username ?>" class="form-control"  required>
                                  <?php
                                  }
                                  ?>
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Password</label>
                                <div class="select2-blue">
                                <input type="password" name="password" style="width: 100%;"  placeholder="Silahkan input jika mau diganti password" class="form-control" <?= $readonly ?> >
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Level</label>
                                <div class="select2-blue">
                                  <?php
                                  if($readonly=="readonly" || $readonly2=="readonly"){
                                  ?>
                                  <input type="text" name="idlevel" class="form-control" value="<?= $lvl ?>" readonly>
                                  <?php 
                                  }else{
                                  ?>
                                  <select name="idlevel" class="form-control" required>
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
                                  <?php
                                  }
                                  ?>
                                </div>
                          </div>
                      </div><br>
                </fieldset>
                <div class="row">
                    <?php 
                    if(in_array("Simpan Profil-4", $this->session->fitur)){
                      if($aksi=="update"){
                        $value="UPDATE";
                      }else{
                        $value="SIMPAN";
                      }
                      echo form_submit('submit',$value,array('class'=>'btn btn-primary'));
                    }
                    ?>
                </div><br>
                <?php echo form_close(); ?>
                
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<?php
$this->session->set_flashdata('info',"");
?>

