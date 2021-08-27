<script type="text/javascript">
  function eksport(){
    document.location="<?= base_url()?>page/datamatpelguru/eksport";
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
            <h1 class="m-0 text-dark">Data Nilai Ekstrakurikuler (<?= $title ?>)</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Nilai Ekstrakurikuler</a></li>
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

              <?= form_open($form_action); ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-2">
                      <label>Kelas</label>
                      <p><?= $kdkelas ?> 
                      <input type="hidden" value="<?= $idekstra ?>" name="idekstra" ?> 
                      <input type="hidden" value="<?= $idekstra ?>|<?= $title ?>" name="ekstra" ?> 
                      <input type="hidden" value="<?= $kdkelas ?>" name="kelas" ?> 
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <label>Nama Siswa</label>
                        <div class="select2-blue">
                            <select name="nisn[]" class="select2" multiple="multiple" data-placeholder="Pilih Siswa" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                                <?php
                                foreach ($siswa as $key => $v) {
                                # code...
                                ?>
                                <option value="<?= $v->nisn ?>" ><?= strtoupper($v->nama) ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3">
                        <label>Nilai Ekstra</label>
                        <div class="select2-blue">
                            <select name="nilai" class="select2" data-placeholder="Nilai Ekstrakurikuler" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                                <option value="3">Sangat Baik</option>
                                <option value="2">Baik</option>
                                <option value="1">Cukup Baik</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value="simpan" class="btn btn-primary" style="width: 100%;" ><i class="fas fa-plus"></i>Simpan</button>
                    </div>
                    


                <!-- /.col -->
              </div>            
              <?= form_close(); ?>

            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Nilai</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($nilaiekstra as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->nmsiswa; ?></td>
                      <td><?php echo $b->nilai; ?></td>
                      <td>

                          <form method="post" action="<?= base_url()."page/raport/nilaiekstra/input/" ?>">
                            <input type="hidden" value="<?= $idekstra ?>" name="idekstra" ?> 
                            <input type="hidden" value="<?= $idekstra ?>|<?= $title ?>" name="ekstra" ?> 
                            <input type="hidden" value="<?= $kdkelas ?>" name="kelas" ?> 
                            <input type="hidden" value="<?= $b->idnilaiekstra ?>" name="idnilaiekstra" ?> 
                          
                           <button class="btn btn-danger" onclick="" type="submit" name="submit" value="hapus"><i class="fa fa-trash"></i></button>
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
        </div>
      </div>
      
    </section>
  </div>

<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/select2/js/select2.full.min.js"></script>

<script type="text/javascript">
    $(function () {
  //Initialize Select2 Elements
          $('.select2').select2()

          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          })
      });
</script>

