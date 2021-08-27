<script type="text/javascript">
  function edit(a,b,c,d){
    
    document.getElementsByName("kode")[0].value=a;
    document.getElementsByName("nama")[0].value=b;
    document.getElementsByName("biaya")[0].value=c;
    document.getElementsByName("tahunajaran")[0].value=d;
    document.getElementById("btn2").innerHTML="Update";
    document.getElementsByName("formData")[0].setAttribute("action","<?= base_url().$update_action ?>");
    document.getElementsByName("kode")[0].setAttribute("readonly",true);
  }

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
            <h1 class="m-0 text-dark">Kategori Keuangan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Kategori Keuangan</a></li>
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
              if(in_array("Tambah Data-17", $this->session->fitur)){
              ?>
              <form name="formData" method="post" action="<?= base_url().$form_action ?>" >
              <div class="row">
                    
                    <div class="col-sm-12 col-md-2">
                      <label>Kode Keuangan</label>
                      <input type="text" name="kode" class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <label>Nama Keuangan</label>
                      <input type="text" name="nama" class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-3">
                      <label>Biaya</label>
                      <input type="text" name="biaya" class="form-control">
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Tahun Ajaran</label>
                      <select name="tahunajaran" class="form-control">
                          <?php
                            foreach ($tahun as $key => $v) {
                              # code...
                              ?>
                              <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun." (".strtoupper($v->semester).")"; ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2  d-flex align-items-end">
                      <button type="submit" name="submit" value="simpan" class="btn btn-success" style="width: 100%;" id="btn2">Simpan</button>
                    </div>
                <!-- /.col -->
              </div>            
              </form>
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
                      <th>Kode Keuangan</th>
                      <th>Nama Keuangan</th>
                      <th>Biaya</th>
                      <th>Tahun Ajaran</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($kategori as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->kdkatkeuangan; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->biaya; ?></td>
                      <td><?php echo $b->tahun; ?></td>
                      <td>
                        <?php 
                        if(in_array("Edit Data-17", $this->session->fitur)){
                          ?>
                            <button class="btn btn-info" onclick="edit('<?= $b->kdkatkeuangan ?>','<?= $b->nama ?>','<?= $b->biaya ?>','<?= $b->idtahunajaran ?>')"><i class="fa fa-edit"></i></button>
                          <?php
                        }

                        if(in_array("Hapus Data-17", $this->session->fitur)){
                          ?>
                            <button class="btn btn-danger" onclick="hapus('<?= $b->kdkatkeuangan ?>')"><i class="fa fa-trash"></i></button>
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


