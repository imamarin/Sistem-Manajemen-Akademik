

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
            <h1 class="m-0 text-dark">Data Kehadiran Guru</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kehadiran Guru</a></li>
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
                <div class="col-9">
                  <?= form_open($form_action); ?>
                  <div class="row">
                        
                        <div class="col-sm-12 col-md-2">
                          <label>Tanggal Kehadiran</label>
                          <input type="date" name="tanggal" class="form-control" value="<?= isset($tanggal)?$tanggal:'' ?>">
                        </div>
                        <div class="col-sm-12 col-md-2  d-flex align-items-end">
                          <button type="submit" name="submit" value="Simpan" class="btn btn-primary" style="width: 100%;" >CARI</button>
                        </div>
                        
                    <!-- /.col -->
                  </div>            
                  <?= form_close(); ?>
                </div>
                <div class="col-3">
                  <label>Persentasi Kehadiran Mengajar</label>
                  <h2 id="per">00.00 % </h2>
                </div>
              </div>

            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Nama Guru</th>
                      <?php
                      foreach($setjadwal as $s){
                      ?>
                        <th>Jam ke- <?= $s->jam ?></th>
                      <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $jml=0;
                    $kls="";
                    $stt="";
                    $tot=0;
                    $msk=0;
                    foreach ($guru as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <?php
                      foreach($setjadwal as $s){
                      ?>
                        <td>
                          <?php
                          foreach($jadwal as $j){
                            if($b->kdguru == $j->kdguru AND ($s->idsetjadwal==$j->idsetjadwal OR $jml > 0) ){
                              
                              if($jml<=0){
                                $jml=$j->jml_jam;
                                $kls=$j->kdkelas;
                                $stt=$j->status;
                              }
                              if($stt > 0 ){
                                $msk++;
                                $tot++;
                                ?>
                                <button class="btn btn-success"><?= $kls ?></button>
                                <?php
                              }else{
                                $tot++;
                                ?>
                                <button class="btn btn-danger"><?= $kls ?></button>
                                <?php
                              }
                              
                              break;
                            }
                          }
                          ?>
                        </td> 
                      <?php
                      $jml--;
                      }
                      ?>
                    </tr>
                    <?php
                    $no++;
                    } ?>
                    
                  </tbody>
                </table>
                <?php
                if($tot!=0){
                ?>
                <input type="hidden" value="<?= number_format($msk/$tot*100,1,".","") ?> %" id="tot">
                <?php
                }
                ?>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>

  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/walikelas/upload' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">UPLOAD FILE EXCEL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="file" name="userfile" class="form-control">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" name="submit" value="import">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


<script type="text/javascript">
  window.onload = function(){
    document.getElementById('per').innerHTML = document.getElementById('tot').value;
  }
</script>