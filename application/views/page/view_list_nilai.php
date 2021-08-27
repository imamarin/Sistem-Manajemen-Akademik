<script type="text/javascript">
  function atur(t,x,j){
    if(t=="hapus"){
        s=window.confirm("Hapus Data ini");
        if(s){
            document.location="<?php echo base_url(); ?>"+"guru/tugas/"+t+'/'+x;
        }
    }else{
        document.location="<?php echo base_url(); ?>"+"guru/hasil/"+t+'/'+x+'/'+j;
    }
    
  }
</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kelas Pembelajaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Kelas Pembelajaran</a></li>
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
                <table id="example1" class="table table-bordered table-striped table-striped dt-responsive nowrap" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS</th>
                      <th>Nama</th>
                      <th>Kelas</th>
                      <th>Nilai</th>
                      <th>Revisi</th>
                      <th>Pilihan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($kelas as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nis ?></td>
                      <td><?php echo $b->nama ?></td>
                      <td><?php echo $b->kdkelas ?></td>
                      <td><?php echo $b->nilai ?></td>
                      <td><?php echo substr($b->catatan, 0,50)."..." ?></td>
                      <td nowrap="nowrap">
                      <?php
                      echo form_input(array('type'=>'button','value'=>'Lihat Tugas','class'=>'btn btn-primary btn-xs','onclick'=>"atur('nilai',$b->idtugas,'$b->nis');"));
                      //echo " ";
                      ?>
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