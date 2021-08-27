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
            <h1 class="m-0 text-dark">Transaksi Keuangan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Transaksi Keuangan</a></li>
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
                      <label>Nama Siswa</label>
                      <select name="tahunajaran" class="select2" data-placeholder="Pilih Siswa" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php
                            foreach ($siswa as $key => $v) {
                              # code...
                              ?>
                              <option value="<?= $v->nisn ?>"><?= $v->nama." (".strtoupper($v->nisn).")"; ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Keuangan</label>
                      <select name="kdkelas" class="select2" data-placeholder="Pilih Keuangan" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <option></option>
                          <?php
                            foreach ($keuangan as $key => $v) {
                              if($v->kdkatkeuangan=="SPP"){
                                $s="selected";
                              }else{
                                $s="";
                              }
                              ?>
                              <option value="<?= $v->kdkatkeuangan ?>" <?= $s ?> ><?= strtoupper($v->nama) ?></option>
                              <?php
                            }
                          ?>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" class="btn btn-success" style="width: 100%;" >Tampilkan</button>
                    </div>
                    
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <?php 
                      if(in_array("Print Lembar Absensi-3", $this->session->fitur)){
                        ?>
                          <button type="button" class="btn btn-info" style="width: 100%;" data-toggle="modal" data-target="#modal-default2">Print Lembar Absensi</button><br>
                        <?php
                      }
                      ?>
                    </div>

                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <?php 
                      if(in_array("Rombel-3", $this->session->fitur)){
                        ?>
                          <button type="button" class="btn btn-warning" style="width: 100%;" data-toggle="modal" data-target="#modal-default">Rombel</button><br>
                        <?php
                        $readonly=false;
                      }else{
                        $readonly=true;
                      }
                      ?>
                      
                    </div>

                <!-- /.col -->
              </div>            
              <?= form_close(); ?>
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                <?= form_open($form_action2); ?>
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NIS/NISN</th>
                      <th>Nama</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    ?>
                    <tr>
                      <td><?php echo $b->nis." / ".$b->nisn; ?></td>
                      <td><?php echo $b->nama; ?></td>                    
                    </tr>
                    <?php
                    $no++;
                    } ?>
                  </tbody>
                </table>
                

                <?= form_close(); ?>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>

