
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
            <h1 class="m-0 text-dark">Data Kelas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kelas</a></li>
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
              if(in_array("Tambah Data-5", $this->session->fitur)){
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
                      <th>Pilih</th>
                      <th>Kelas</th>
                      <th>Tingkat</th>
                      <th>Jurusan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($kelas as $b) {
                      ?>
                    <tr>
                      <td>
                        <?php 
                        if(in_array("Hapus Data-5", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/kelas/hapus/".$b->kdkelas ?>" onclick="return confirm('Hapus Data ini ?')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
                          <?php
                        }
                        ?>
                        </td>
                        
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tingkat; ?></td>
                      <td><?php echo $b->kompetensi; ?></td>
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
            <form method="post" action="<?= base_url().'page/kelas/simpan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH DATA KELAS</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Kelas</label>
                    <input type="text" name="kdkelas" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tingkat</label>
                    <select name="tingkat" class="form-control" required>
                      <option value="10">X</option>
                      <option value="11">XI</option>
                      <option value="12">XII</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Jurusan</label>
                    <select name="kdjurusan" class="form-control" required>
                     <?php
                      foreach ($jurusan as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->kdjurusan ?>"><?= $v->kompetensi ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="KIRIM">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?php
ini_set('display_errors','off');
?>

