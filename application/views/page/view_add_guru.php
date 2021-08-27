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
                   <?php echo $this->session->flashdata('info'); ?>, <?php echo $this->session->flashdata('info2'); ?>
                </div>  
                <?php } ?>
            </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
              <?php
              if(isset($namaprofil)){
                echo $namaprofil;
              }else{
              ?>
                Input Data Guru <?php //echo strtoupper(str_replace("%20"," ",$jdl)); ?>
              <?php
              }
              ?>
              </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Profil</a></li>
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
                  <legend class="scheduler-border">Identitas Guru</legend>
                  <div class="row">
                    <div class="col-6 col-sm-6 col-md-6">
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Kode Guru</label>
                                <div class="select2-blue">
                                  <input type="text" name="kdguru" style="width: 100%;" class="form-control" value="<?= $kdguru ?>" <?= $tidakaktif ?> required>
                                </div>
                          </div>
                      </div><br>                      
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Nama Guru </label>
                                <div class="select2-blue">
                                  <input type="text" name="nama" style="width: 100%;" class="form-control" value="<?= $nama?>" required>
                                </div>
                          </div>
                      </div><br>
                      
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Tempat Lahir</label>
                                <div class="select2-blue">
                                  <input type="text" name="tmplahir" style="width: 100%;" class="form-control" value="<?= $tmplahir ?>" required>
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Tanggal Lahir</label>
                                <div class="select2-blue">
                                  <input type="date" name="tgllahir" style="width: 100%;" class="form-control" value="<?= $tgllahir ?>" required>
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
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>NUPTK</label>
                                <div class="select2-blue">
                                  <input type="text" name="nuptk" style="width: 100%;" class="form-control" value="<?= $nuptk ?>" required>
                                </div>
                          </div>
                      </div><br>
                      
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>NIP</label>
                                <div class="select2-blue">
                                  <input type="text" name="nip" style="width: 100%;" class="form-control" value="<?= $nip ?>" required>
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Alamat</label>
                                <div class="select2-blue">
                                  <input type="text" name="alamat" style="width: 100%;" class="form-control" value="<?= $alamat ?>" required>
                                </div>
                          </div>
                      </div><br>
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>No Hp</label>
                                <div class="select2-blue">
                                  <input type="text" name="nohp" style="width: 100%;" value="<?= $nohp ?>" class="form-control" required>
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
                                  <select name="status" class="form-control" required="">
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
                  <legend class="scheduler-border">Validasi Pengguna</legend>
                      <?php 
                      if(in_array("Validasi Pengguna-2", $this->session->fitur) || in_array("Tampil Profil-4", $this->session->fitur)){
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
                      <div class="row">
                          <div class="col-12 col-sm-12 col-md-12">
                              <label>Username</label>
                                <div class="select2-blue">
                                  <input type="text" name="username" style="width: 100%;" value="<?= $username ?>" class="form-control" <?= $readonly ?> required>
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

                    //echo form_submit('submit','SIMPAN',array('class'=>'btn btn-primary','disabled'=>'disabled'));
                    if(in_array("Simpan Profil-4", $this->session->fitur)){
                      echo form_submit('submit','SIMPAN',array('class'=>'btn btn-primary'));
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



