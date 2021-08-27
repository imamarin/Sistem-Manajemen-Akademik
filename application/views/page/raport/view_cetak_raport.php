<script type="text/javascript">
  function aktif(kls,id2,sms){
      document.location="<?= base_url().'page/raport/nilaisikap/update/' ?>"+id+"/"+id2+"/"+sms;
  }

  function cover(v,kls,k){
      awal = document.getElementById('start'+k).value;
      akhir = document.getElementById('end'+k).value;
      window.open("<?= base_url().'page/raport/cetak/versi/' ?>"+v+"/cover/"+kls+"/"+awal+"/"+akhir,"_blank");
  }

  function raport1(v,kls,k){
      awal = document.getElementById('start'+k).value;
      akhir = document.getElementById('end'+k).value;
      window.open("<?= base_url().'page/raport/cetak/versi/' ?>"+v+"/raport1/"+kls+"/"+awal+"/"+akhir,"_blank");
  }

  function raport2(v,kls,k){
      awal = document.getElementById('start'+k).value;
      akhir = document.getElementById('end'+k).value;
      window.open("<?= base_url().'page/raport/cetak/versi/' ?>"+v+"/raport2/"+kls+"/"+awal+"/"+akhir,"_blank");
  }

  function raport3(v,kls,k){
      awal = document.getElementById('start'+k).value;
      akhir = document.getElementById('end'+k).value;
      window.open("<?= base_url().'page/raport/cetak/versi/' ?>"+v+"/raport3/"+kls+"/"+awal+"/"+akhir,"_blank");
  }

  function transkrip(v,kls,k){
      awal = document.getElementById('start'+k).value;
      akhir = document.getElementById('end'+k).value;
      window.open("<?= base_url().'page/raport/cetak/versi/' ?>"+v+"/transkrip/"+kls+"/"+awal+"/"+akhir,"_blank");
  }

  function ranking(v,kls,sms,thn){
      window.open("<?= base_url().'page/raport/cetak/' ?>"+v+"/"+kls+"/"+sms+"/"+thn,"_blank");
  }

  function suratkeluar(v,kls,k){
      awal = document.getElementById('start'+k).value;
      akhir = document.getElementById('end'+k).value;
      window.open("<?= base_url().'page/raport/cetak/versi/' ?>"+v+"/suratkeluar/"+kls+"/"+awal+"/"+akhir,"_blank");
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
            <h1 class="m-0 text-dark">Cetak Raport</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Cetak Raport</a></li>
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
                Silahkan pilih kelas!  
                <?php 
                if(in_array("Semua Kelas-57", $this->session->fitur)){
                  ?>
                  <a href="<?= base_url('page/raport/cetak/semua') ?>"><button class="btn btn-primary" value="Cover" onclick="">Lihat Semua Kelas</button></a>
                  <?php
                }
                ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>Kelas</th>
                      <th>Cetak</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($kelas as $k=>$b) {
                    ?>
                    <tr>  
                      <td>
                      <?= $b->kdkelas ?>
                      </td>
                      <td>
                        <div class="row">
                            <div class="col-2">
                                <select id="start<?= $k ?>" class="form-control" style="width:100%;">
                                    <?php
                                    for($a=1;$a<=$b->totalsiswa;$a++){
                                        ?>
                                        <option value="<?= $a ?>"><?= $a.". ".strtoupper($siswa[$b->kdkelas][$a-1]) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-1" style="text-align:center;">
                                Sampai Dengan
                            </div>
                            <div class="col-2">
                                <select id="end<?= $k ?>" class="form-control" style="width:100%;">
                                    <?php
                                    for($a=$b->totalsiswa;$a>=1;$a--){
                                        ?>
                                         <option value="<?= $a ?>"><?= $a.". ".strtoupper($siswa[$b->kdkelas][$a-1]) ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-6">
                                <button class="btn btn-success" value="Cover" onclick="cover('<?= $cetak[$b->tingkat] ?>','<?= $b->kdkelas ?>','<?= $k ?>');">Cover dan Identitas</button>
                                <button class="btn btn-success" value="raport1" onclick="raport1('<?= $cetak[$b->tingkat] ?>','<?= $b->kdkelas ?>','<?= $k ?>');">Raport 1</button>
                                <button class="btn btn-success" value="raport2" onclick="raport2('<?= $cetak[$b->tingkat] ?>','<?= $b->kdkelas ?>','<?= $k ?>');">Raport 2</button>
                                <button class="btn btn-success" value="raport3" onclick="raport3('<?= $cetak[$b->tingkat] ?>','<?= $b->kdkelas ?>','<?= $k ?>');">Raport 3</button>
                                <button class="btn btn-info" value="ranking" onclick="ranking('ranking','<?= $b->kdkelas ?>','<?= $this->session->semesterraport ?>','<?= $this->session->idtahunraport ?>');">Ranking</button>
                                <button class="btn btn-danger" value="transkrip" onclick="transkrip('<?= $cetak[$b->tingkat] ?>','<?= $b->kdkelas ?>','<?= $k ?>');">Transkrip</button>
                                <?php
                                $kls=explode(" ",$b->kdkelas);
                                if($this->session->semesterraport=="genap" && strtolower($kls[0])=="xii"){
                                  ?>
                                  <button class="btn btn-warning" value="suratkeluar" onclick="suratkeluar('<?= $cetak[$b->tingkat] ?>','<?= $b->kdkelas ?>','<?= $k ?>');">Surat Keluar</button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                       
                      </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>
     
