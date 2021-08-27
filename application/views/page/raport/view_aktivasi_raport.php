<script type="text/javascript">
  function aktif(id,id2,thn,sms){
    s=window.confirm("Yakin akan aktifkan data raport ini?");
    if(s){
      document.location="<?= base_url().'page/raport/aktivasi/update/' ?>"+id+"/"+id2+"/"+thn+"/"+sms;
    }
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
            <h1 class="m-0 text-dark">Daftar Data Raport</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Daftar Data Raport</a></li>
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
                Silahkan aktifkan data raport yang akan di kelola!
            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tahun Ajaran</th>
                      <th>Semester</th>
                      <th>Kepala Sekolah</th>
                      <th>Tanggal Terima</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($raport as $b) {
                    ?>
                    <tr>  
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->tahun; ?></td>
                      <td><?php echo $b->semester; ?></td>
                      <td><?php echo $b->kepalasekolah; ?></td>
                      <td><?php echo $b->tglterimaraport; ?></td>
                      <td>
                        <?php 
                        $thn=str_replace("/","-",$b->tahun);
                        if($this->session->idraport==$b->id){
                          ?>
                            <button class="btn btn-success" onclick="aktif('<?= $b->id ?>','<?= $b->idtahunajaran ?>','<?= $thn ?>','<?= $b->semester ?>');">Aktif</button>
                          <?php
                        }else{
                          ?>
                            <button class="btn btn-danger" onclick="aktif('<?= $b->id ?>','<?= $b->idtahunajaran ?>','<?= $thn ?>','<?= $b->semester ?>');">Tidak Aktif</button>
                          <?php
                        }
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
      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/raport/nilairaport/simpan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH DATA UJIAN HARIAN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Kelas</label>
                    <select name="kdkelas" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($kelas as $key => $v) {
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
                    <label>Mata Pelajaran</label>
                    <select name="kdmatpel" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($matpel as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->kdmatpel ?>"><?= $v->matpel ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Semester</label>
                    <select id="semester" name="semester" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                      <option value="ganjil">Ganjil</option>
                      <option value="genap">Genap</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tahun Ajaran</label>
                    <select name="tahun" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($tahun as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="KIRIM">SIMPAN</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

