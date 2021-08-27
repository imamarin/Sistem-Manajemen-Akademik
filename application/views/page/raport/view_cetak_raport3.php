<script type="text/javascript">
  function aktif(id,id2,thn,sms){
    s=window.confirm("Yakin akan aktifkan data raport ini?");
    if(s){
      document.location="<?= base_url().'page/raport/aktivasi/update/' ?>"+id+"/"+id2+"/"+thn+"/"+sms;
    }
  }

  function download(g,v,kls,id,sms){

    window.open("<?= base_url().'page/raport/siswa/versi/' ?>"+v+"/download/"+kls+"/"+g+"/"+id+"/"+sms,"_blank");
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
                Silahkan pilih data raport yang akan di download!
            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tahun Ajaran</th>
                      <th>Semester</th>
                      <th>Tanggal Terima</th>
                      <th>Download</th>
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
                      <td><?php echo $b->tglterimaraport; ?></td>
                      <td>
                      <button class="btn btn-success" value="Cover" onclick="download('<?= $b->kdguru ?>','<?= $b->template ?>','<?= $b->kdkelas ?>','<?= $b->idtahunajaran ?>','<?= $b->semester ?>');">Silahkan klik ini untuk Download file PDF</button>

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
      