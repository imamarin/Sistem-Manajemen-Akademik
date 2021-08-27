<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox'  && !(checkboxes[i].disabled) ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
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
            <h1 class="m-0 text-dark">Kompetensi Mata Pelajaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kompetensi Matpel</a></li>
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
              if(in_array("Tambah Data-15", $this->session->fitur)){
              ?>
              <?= form_open($form_action); ?>
              <div class="row">
                    
                    <div class="col-sm-12 col-md-2">
                      <label>Tahun Ajaran</label>
                      <select name="tahunajaran" class="form-control">
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
                    <div class="col-sm-12 col-md-3">
                      <label>Mata Pelajaran</label>
                      <select name="kdmatpel" class="select2" data-placeholder="Pilih Mata Pelajaran" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                          <option></option>
                          <?php
                            foreach ($matpel as $key => $v) {
                              # code...
                              if($v->kdmatpel==$kdmatpel){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->kdmatpel ?>" <?= $s ?> ><?= strtoupper($v->matpel) ?></option>
                              <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value="Simpan" class="btn btn-success" style="width: 100%;" ><i class="fas fa-plus"></i>Simpan</button>
                    </div>


                <!-- /.col -->
              </div>            
              <?= form_close(); ?>
              <?php
            }
            ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Mata Pelajaran</th>
                      <th>Tahum Ajaran</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($matpelguru as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->tahun; ?></td>
                      <td>
                        <?php 
                        if(in_array("Hapus Data-15", $this->session->fitur)){
                          ?>
                            <a href="<?= base_url()."page/matpelguru/hapus/".$b->idmatpelguru ?>" onclick="return confirm('Hapus Data ini ?')"><button class="btn btn-danger"><i class="fa fa-trash"></i></button></a>
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
        </div>
      </div>
      
    </section>
  </div>


