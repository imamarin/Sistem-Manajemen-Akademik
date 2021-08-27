<script type="text/javascript">
  function hapus(id){
    s=window.confirm("Hapus Data ini");
    if(s){
      document.location="<?= base_url().$hapus_action ?>"+id;
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
            <h1 class="m-0 text-dark">Data Ujian UTS</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Ujian UTS</a></li>
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
              <?php 
              if(in_array("Tambah Data-25", $this->session->fitur)){
                ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Data </button>
                <?php
              }
              ?>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Ujian</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($ujian as $b) {
                    ?>
                    <tr>  
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->judul; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tahun." (".$b->semester.")"; ?></td>
                      <td>
                        <?php 
                        if(in_array("Hapus Data-25", $this->session->fitur) || in_array("Input Nilai-25", $this->session->fitur)){
                          ?>               
                            <form method="post" action="<?= base_url()."page/ujianuts/input/" ?>">
                            <input type="hidden" name="h_kdmatpel" value="<?= $b->kdmatpel ?>">
                            <input type="hidden" name="h_kdkelas" value="<?= $b->kdkelas ?>">
                            <input type="hidden" name="h_tahun" value="<?= $b->idtahunajaran ?>">
                            <input type="hidden" name="h_idujian" value="<?= $b->idujian ?>">
                            <input type="hidden" name="h_judul" value="<?= $b->judul ?>">
                            <input type="hidden" name="h_kategori" value="<?= $b->kategori ?>">

                            <button type="submit" name="input" value="input" class="btn btn-primary">Input Nilai</button> <button type="button" class="btn btn-danger" onclick="hapus('<?= $b->idujian ?>')"><i class="fa fa-trash"></i></button>                        
                          </form>               
                            
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
            <form method="post" action="<?= base_url().'page/ujianuts/simpan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH DATA UJIAN UTS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Ujian</label>
                    <input type="text" name="judul" class="form-control" required>
                </div>
              </div>
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

