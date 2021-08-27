<script type="text/javascript">
  function edit(a,b,c){
    alert(a);
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
            <h1 class="m-0 text-dark">Rekap Kehadiran Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Rekap Kehadiran</a></li>
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
             
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NISN</th>
                      <th>Nama</th>
                      <?php
                      $p=1;
                      foreach($absen as $k=>$v){
                      ?>
                      <th title="<?php echo $v->waktu; ?>"><?php echo "P".$p; ?></th>
                      <?php
                      $p++;
                      }
                      ?>
                      <th>Hadir</th>
                      <th>Sakit</th>
                      <th>Izin</th>
                      <th>Alfa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                      $h=0;
                      $i=0;
                      $a=0;
                      $s=0;
                      ?>
                    <tr>                        
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <?php
                        foreach($absen as $v){
                      ?>
                          <td>
                          <?php
                            foreach($detail as $d){
                              if($b->nisn==$d->nisn && $v->waktu==$d->waktu && $v->idabsensi==$d->idabsensi){
                              ?>
                              <?php echo $d->keterangan; ?>
                              <?php
                                if(!empty($d->keterangan)){
                                   if($d->keterangan=="h"){                            
                                      $h++;
                                    }elseif($d->keterangan=="a"){
                                      $a++;
                                    }elseif($d->keterangan=="i"){
                                      $i++;
                                    }elseif($d->keterangan=="s"){
                                      $s++;
                                    }
                                }else{
                                  $a++;
                                }
                                 
                            }
                          }
                       ?>
                              </td>
                                  <?php
                          
                          }
                          ?>
                      <td><?php echo $h; ?></td>
                      <td><?php echo $s; ?></td>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $a; ?></td>
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
     