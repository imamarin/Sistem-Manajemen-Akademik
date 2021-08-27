<script type="text/javascript">


  function edit(x,a,b,c,d,e,f,g,h){

    document.getElementsByName("nama")[0].value=a;
    document.getElementsByName("pemilik")[0].value=b;
    document.getElementsByName("nohp")[0].value=c;
    document.getElementsByName("kota")[0].value=d;
    document.getElementsByName("kelurahan")[0].value=e;
    document.getElementsByName("kecamatan")[0].value=f;
    document.getElementsByName("alamat")[0].value=g;
    document.getElementsByName("idperusahaan")[0].value=h;
    document.getElementById("title").innerHTML="Edit Data Perusahaan";
    document.getElementById("btn").innerHTML="Update";
    document.getElementById("btn").value="edit";
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-target","#modal-default");
    document.getElementsByName("formData")[0].setAttribute("action","<?= base_url().$update_action ?>");
    //document.getElementsByName("coba"+x)[0].value="aaaaaaaaaaa";
    //alert("sadsad");
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
            <h1 class="m-0 text-dark">Data Perusahaan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Perusahaan</a></li>
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
              if(in_array("Tambah Data-43", $this->session->fitur)){
                ?>
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Data </button>
                <?php
              }
              ?>

              <?php 
              if(in_array("Eksport Data-43", $this->session->fitur)){
                ?>
                  <a href="<?= base_url()."page/prakerin/eksportperusahaan" ?>"><button class="btn btn-success"><i class="fa fa-download"></i> Eksport Data</button></a>
                <?php
              }
              ?>            
              <?php 
              if(in_array("Import Data-43", $this->session->fitur)){
                ?>
                  <button class="btn btn-info" data-toggle="modal" data-target="#modal-default2"><i class="fa fa-upload"></i> Import Data</button>
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
                      <th>Nama Perusahaan</th>
                      <th>Pemilik</th>
                      <th>No. Handphone</th>
                      <th>Kota/Kabupaten</th>
                      <th>Kelurahan/Desa</th>
                      <th>Kecamatan</th>
                      <th>ALamat</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($perusahaan as $b) {
                      ?>
                    <tr>
                      <td>
                        <?php 
                        if(in_array("Edit Data-43", $this->session->fitur)){
                          ?>
                            <button class="btn btn-info" onclick="edit('<?= $no ?>','<?= $b->nmperusahaan ?>','<?= $b->pemilik ?>','<?= $b->nohp ?>','<?= $b->kota ?>','<?= $b->kelurahan ?>','<?= $b->kecamatan ?>','<?= $b->alamat ?>','<?= $b->idperusahaan ?>');" name="editmodal<?= $no ?>"><i class="fa fa-edit"></i></button></a>
                          <?php
                        }

                        if(in_array("Hapus Data-43", $this->session->fitur)){
                          ?>
                            <button class="btn btn-danger" onclick="hapus('<?= $b->idperusahaan ?>')"><i class="fa fa-trash"></i></button></a>
                          <?php
                        }
                        ?>
                      </td>
                        
                      <td><?php echo strtoupper($b->nmperusahaan); ?></td>
                      <td><?php echo strtoupper($b->pemilik); ?></td>
                      <td><?php echo strtoupper($b->nohp); ?></td>
                      <td><?php echo strtoupper($b->kota); ?></td>
                      <td><?php echo strtoupper($b->kelurahan); ?></td>
                      <td><?php echo strtoupper($b->kecamatan); ?></td>
                      <td><?php echo strtoupper($b->alamat); ?></td>
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
            <form method="post" name="formData" action="<?= base_url().$form_action ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="title">TAMBAH DATA PERUSAHAAN</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Perusahaan</label>
                    <input type="text" name="nama" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Pemilik Perusahaan</label>
                  <input type="text" name="pemilik" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>No. Handphone</label>
                  <input type="text" name="nohp" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Kota / Kabupaten</label>
                  <input type="text" name="kota" class="form-control">
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Keluarahan / Desa</label>
                  <input type="text" name="kelurahan" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Kecamatan</label>
                    <input type="text" name="kecamatan" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Alamat</label>
                  <textarea name="alamat" class="form-control"></textarea>
                </div>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="idperusahaan" class="form-control">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="simpan" id="btn">SIMPAN</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/prakerin/perusahaan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">UPLOAD FILE EXCEL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="file" name="userfile" class="form-control">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" value="import" class="btn btn-primary">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
