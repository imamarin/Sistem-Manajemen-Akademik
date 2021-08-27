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
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jadwal as $b) {
                      ?>
                    <tr>                        
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->tahun."(".$b->semester.")"; ?></td>
                      <td>
                          <form method="post" action="<?= base_url()."page/kehadiran/tampil/" ?>">
                            <input type="hidden" name="h_kdmatpel" value="<?= $b->kdmatpel ?>">
                            <input type="hidden" name="h_matpel" value="<?= $b->matpel ?>">
                            <input type="hidden" name="h_nama" value="<?= $b->nama ?>">
                            <input type="hidden" name="h_kdguru" value="<?= $b->kdguru ?>">
                            <input type="hidden" name="h_kdkelas" value="<?= $b->kdkelas ?>">
                            <input type="hidden" name="h_tahun" value="<?= $this->session->tahun ?>">
                            <input type="hidden" name="h_semester" value="<?= $this->session->semester ?>">
                            <input type="hidden" name="h_idjadwal" value="<?= $b->idjadwal ?>">
                            <button type="submit" class="btn btn-info" name="submit" value="submit"><i class="fa fa-edit"></i> Rekap Kehadiran</button>
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
     