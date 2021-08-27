<script type="text/javascript">
  function atur(t,x,y){
    if(t=="hapus"){
        s=window.confirm("Hapus Data ini");
        if(s){
            document.location="<?php echo base_url(); ?>"+"guru/quiz/"+t+'/'+x+'/'+y;
        }
    }else{
        document.location="<?php echo base_url(); ?>"+"guru/quiz/"+t+'/'+x+"/"+y;
    }
    
  }
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Daftar Sasiwa</a></li>
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

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <?= form_open($form_action) ?>
               
            
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>Pilih</th>
                      <th>Nisn</th>
                      <th>Nama</th>
                      <th>Tempat Lahir</th>
                      <th>Tanggal Lahir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    ?>
                    <tr>
                      <td><input type="checkbox" name="nisn[]" value="<?= $b->nis ?>"></td>
                      <td>
                      <?php 
                      echo $b->nisn; 
                      ?>
                        
                      </td>
                      <td>
                      <?php 
                      echo $b->nama; 
                      ?>
                        
                      </td>
                      <td><?php echo $b->tmp_lahir; ?></td>
                      <td><?php echo $b->tgl_lahir; ?></td>
                    </tr>
                    <?php
                    $no++;
                    } ?>
                </tbody>
              </table>
               <div class="col-sm-12 col-md-3  d-flex align-items-end">
                      <button type="submit" class="form-control bg-warning" style="width: 100%;" id="waktu">Reset Password</button>
                    </div>
              <?= form_close(); ?>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>



