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
             <div class="card-body">
              <button class="btn btn-success">Total Hadir: <?= $siswa->hadir ?></button>
              <button class="btn btn-warning">Total Sakit: <?= $siswa->sakit ?></button>
              <button class="btn btn-info">Total Izin: <?= $siswa->izin ?></button>
              <button class="btn btn-danger">Total Alfa: <?= $siswa->alfa ?></button>
             </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Waktu</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach($detail as $v){
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= date('Y-m-d',strtotime($v->waktu)) ?></td>
                        <td>
                          <?php 
                          if($v->keterangan == "h"){
                            echo '<button class="btn btn-success">Hadir</button>';
                          }elseif($v->keterangan == "i"){
                            echo '<button class="btn btn-info">Izin</button>';
                          }elseif($v->keterangan == "s"){
                            echo '<button class="btn btn-warning">Sakit</button>';
                          }else{
                            echo '<button class="btn btn-danger">Tanpa Keterangan</button>';
                          }
                          ?>
                            
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
      
    </section>
  </div>
     