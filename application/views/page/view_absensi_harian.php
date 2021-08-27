<script type="text/javascript">
  if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
  }
  
  function edit(a,b,c){
    alert(a);
  }

  function absensi(n,t){
    document.getElementById("tanggal").value=t;
    document.getElementsByName("btnabsensi"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnabsensi"+n)[0].setAttribute("data-target","#modal-default");
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
            <h1 class="m-0 text-dark">Absensi Harian Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Absensi Harian Siswa</a></li>
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
                  
                  <div class="col-sm-12 col-md-2">
                      <label>Kelas</label>
                      <select name="kdkelas" class="form-control" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php
                            foreach ($walikelas as $key => $v) {
                              # code...
                              ?>
                              <option value="<?= $v->kdkelas ?>"><?= $v->kdkelas ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div> 
                    
                    
        
              </div>
            </div>
             
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $tgl="2021-01-18";
                    $tanggal1 = date('Y-m-d',strtotime($tgl));
                    $tanggal2 = date('Y-m-d');
                 
                    while ($tanggal2 >= $tanggal1) {
                        
                        ?>
                        <tr>                        
                          <td><?= $no ?></td>
                          <td><?= $tanggal2 ?></td>
                          <td>
                            <?php 
                              if(in_array($tanggal2, $absen)){
                                ?>
                                <button type="button" name="btnabsensi<?= $no ?>" onclick="absensi('<?= $no ?>','<?= $tanggal2 ?>');" value="input" class="btn btn-info">Input Kehadiran</button>
                                <?php
                              }else{
                                ?>
                                <button type="button" name="btnabsensi<?= $no ?>" onclick="absensi('<?= $no ?>','<?= $tanggal2 ?>');" value="input" class="btn btn-danger">Input Kehadiran</button>
                                <?php
                              }
                            ?>
                            
                          </td>
                        </tr>
                        <?php
                        $tanggal2 = date('Y-m-d',strtotime('-1 days',strtotime($tanggal2)));
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

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/absensiharian/input' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">PILIH KEHADIRAN SISWA HARIAN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                      <label>Kelas</label>
                      <select name="kdkelas" class="form-control" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php
                            foreach ($walikelas as $key => $v) {
                              # code...
                              ?>
                              <option value="<?= $v->kdkelas ?>"><?= $v->kdkelas ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                </div>
                
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" class="form-control" value="" required readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Semester</label>
                    <input type="text" name="semester" class="form-control" value="<?= $tahun->semester ?>" required readonly>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tahun Ajaran</label>
                    <input type="text" name="tahun" class="form-control" value="<?= $tahun->tahun ?>" required readonly>
                </div>
              </div>
              
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="idtahun" class="form-control" value="<?= $tahun->idtahunajaran ?>" required>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="KIRIM">LANJUTKAN</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
     