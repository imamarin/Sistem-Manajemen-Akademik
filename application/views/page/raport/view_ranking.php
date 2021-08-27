
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
            <h1 class="m-0 text-dark">Ranking Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Ranking Siswa</a></li>
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
        <div class="col-12 col-md-4">
          <div class="row">
            <div class="col-12 col-md-12">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-6 col-6">
                        <label>Kelas</label>:
                        <p><?= $kdkelas ?></p>
                      </div>
                      <div class="col-md-6 col-6">
                        <label>Semester</label>:
                        <p><?= $semester ?></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 col-6">
                       <label>Tahun Ajaran</label>:
                        <p><?= $tahun ?></p>
                      </div>
                      
                    </div>
                 </div>
               </div>
             </div>
           </div>
         </div>
        <div class="col-12 col-md-8">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body"> 
                <table id="example" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Rata-Rata Nilai</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    if(empty($b->rata) || empty($b->totmatpel)){
                      $r=0;
                    }else{
                      $r=number_format($b->rata/$b->totmatpel,2,".","");
                    }
                    ?>
                    <tr>                        
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo strtoupper($b->kdkelas); ?></td>
                      <td><?php echo $r; ?></td>
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

  

  
      