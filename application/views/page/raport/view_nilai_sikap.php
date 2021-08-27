<script type="text/javascript">
  function aktif(kls,id2,sms){
      document.location="<?= base_url().'page/raport/nilaisikap/update/' ?>"+id+"/"+id2+"/"+sms;
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
            <h1 class="m-0 text-dark">Data Nilai Sikap</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Nilai Sikap</a></li>
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
                Silahkan pilih kategori sikap!
            </div>
            <!-- /.card-header -->
            <div class="card-body">  
            <form method="post" action="<?= base_url()."page/raport/nilaisikap/input" ?>">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>Kelas</th>
                      <th>Kategori Sikap</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    
                    ?>
                    
                    <tr>  
                      <td>
                      <select name="kelas" class="form-control">
                      <?php
                      foreach ($kelas as $b) {
                        ?>
                        <option value="<?= $b->kdkelas ?>"><?= $b->kdkelas ?></option>
                        <?php
                      }
                      ?>
                      </select>
                      </td>
                      <td>
                        <?php
                        foreach($sikap as $row){
                          ?>
                            <button type="submit" name="kategori" class="btn btn-success" value="<?= $row->kategori ?>"><?= strtoupper($row->kategori) ?></button>
                          <?php
                        }
                        ?>

                      </td>
                    </tr>
                </tbody>
              </table>
              </form>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>
     
