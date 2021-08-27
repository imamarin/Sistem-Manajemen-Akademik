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
            <div class="card-header">
              <div class="row">
                  <div class="col-2">
                    <a href="<?= base_url().'page/rekapabsensisiswa/eksport/'.$kdkelas.'/'.$kdmatpel.'/'.$tahun.'/'.$semester.'/'.$matpel.'/'.$idjadwal ?>"><button class="btn btn-success"><i class="fa fa-download"></i> Eksport Data </button></a>
                  </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Hadir</th>
                      <th>Sakit</th>
                      <th>Izin</th>
                      <th>Alfa</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                      ?>
                    <tr>                        
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo $b->hadir; ?></td>
                      <td><?php echo $b->sakit; ?></td>
                      <td><?php echo $b->izin; ?></td>
                      <td><?php echo $b->alfa; ?></td>
                      <td>
                        <form method="post" action="<?= base_url()."page/rekapabsensisiswa/histori/" ?>">
                            <input type="hidden" name="h_kdmatpel" value="<?= $kdmatpel ?>">
                            <input type="hidden" name="h_matpel" value="<?= $matpel ?>">
                            <input type="hidden" name="h_nama" value="<?= $b->nama ?>">
                            <input type="hidden" name="h_nisn" value="<?= $b->nisn ?>">
                            <input type="hidden" name="h_kdkelas" value="<?= $b->kdkelas ?>">
                            <input type="hidden" name="h_tahun" value="<?= $tahun ?>">
                            <input type="hidden" name="h_semester" value="<?= $semester ?>">
                            <button type="submit" class="btn btn-info" name="submit" value="submit"><i class="fa fa-edit"></i> Histori Kehadiran</button>
                          </form>
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
      
    </section>
  </div>
     