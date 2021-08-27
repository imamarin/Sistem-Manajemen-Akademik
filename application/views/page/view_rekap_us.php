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
            <h1 class="m-0 text-dark">Rekap Nilai US</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Rekap Nilai US</a></li>
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

            <?= form_open($form_action);?>  
                  <div class="row">               
                      <div class="col-sm-12 col-md-4">
                          <label>Tahun Ajaran</label>
                          <select name="tahun" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                              <?php
                                foreach ($tahun as $key => $v) {
                                  # code...
                                  if($v->idtahunajaran==$thn){
                                    $p="selected";
                                  }else{
                                    $p="";
                                  }
                                  ?>
                                  <option value="<?= $v->idtahunajaran ?>" <?= $p ?> ><?= $v->tahun ?></option>
                                  <?php
                                }
                              ?>
                              
                          </select>
                      </div>
                      <div class="col-sm-12 col-md-1 d-flex align-items-end">
                          <button type="submit" name="submit" value="tampil" class="btn btn-primary">Tampilkan</button>
                      </div>
                    </div>
                  <?= form_close() ?>
            

            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kelas</th>
                      <th>Eksport Data</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($kelas as $b) {
                    ?>
                    <tr>  
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td>
                        <a href="<?= base_url().'page/rekapnilaius/eksport/'.$b->kdkelas.'/'.$thn ?>" target="_blank">Download</a>
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
     