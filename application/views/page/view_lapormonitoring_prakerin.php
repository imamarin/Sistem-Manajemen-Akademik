<script type="text/javascript">

  function edit(x,a,b,c,d,e,f){
    var arr=d.split(",");
    $("[name='idperusahaan']").val(a).trigger('change');
    $("[name='tanggal']").val(b).trigger('change');
    $("[name='pengaju']").val(c).trigger('change');
    $("[name='kelompok[]']").val(arr).trigger('change');
    $("[name='status']").val(f).trigger('change');
    document.getElementsByName("idpengajuan")[0].value=e;
    document.getElementById("title").innerHTML="Edit Data Perusahaan";
    document.getElementById("btn").innerHTML="Update";
    document.getElementById("btn").value="edit";
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-target","#modal-default");
    document.getElementsByName("formData")[0].setAttribute("action","<?= base_url().$update_action ?>");
    //document.getElementsByName("coba"+x)[0].value="aaaaaaaaaaa";
    //alert("sadsad");
  }

  function hapus(id,kd){
    s=window.confirm("Hapus Data ini"+id+" "+kd);
    if(s){
      document.location="<?= base_url().$hapus_action ?>"+id+"/"+kd;
    }
  }

  function pengajuan(id){
    document.location="<?= base_url()."page/prakerin/ajuanprakerin/" ?>"
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
            <h1 class="m-0 text-dark">Data Monitoring Prakerin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Monitoring Prakerin</a></li>
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
                      <div class="col-sm-12 col-md-2">
                          <label>Jurusan</label>
                          <select name="kdjurusan" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                              <option value="semua">Semua</option>
                              <?php
                                foreach ($jurusan as $key => $v) {
                                  # code...
                                  if($jur==$v->kdjurusan){
                                    $k="selected";
                                  }else{
                                    $k="";
                                  }
                                  ?>
                                  <option value="<?= $v->kdjurusan ?>" <?= $k ?> ><?= $v->kdjurusan ?></option>
                                  <?php
                                }
                              ?>
                              
                          </select>
                      </div>
                      <div class="col-sm-12 col-md-4">
                          <label>Prakerin</label>
                          <select name="idprakerin" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                              <?php
                                foreach ($prakerin as $key => $v) {
                                  # code...
                                  if($v->idprakerin==$idprakerin){
                                    $p="selected";
                                  }else{
                                    $p="";
                                  }
                                  ?>
                                  <option value="<?= $v->idprakerin ?>" <?= $p ?> ><?= $v->judul ?></option>
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
                      <th>Nama Pemonitoring</th>
                      <th>Nama Perusahaan</th>
                      <th>Kota/Kabupaten</th>
                      <th>Siswa Prakerin</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($ajuan as $b) {
                      if($b->tglmonitoring=="0000-00-00" || $b->tglmonitoring==NULL ){
                        $status=0;
                        $warna="red";
                      }else{
                        $status=1;
                        $warna="";
                      }
                      ?>
                    <tr style="background-color: <?= $warna; ?>">
                      <td><?= $no ?></td>
                      <td><?php echo strtoupper($b->nmguru); ?></td>
                      <td><?php echo strtoupper($b->nmperusahaan); ?></td>
                      <td><?php echo strtoupper($b->kota); ?></td>
                      <td>
                        <button class="btn btn-primary"  data-toggle="modal" data-target="#cekanggota<?= $no ?>">Lihat Siswa</button> 
                          <div class="modal fade" id="cekanggota<?= $no ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form method="post" action="<?= base_url().'page/prakerin/perusahaan' ?>" enctype="multipart/form-data">
                                  <div class="modal-header">
                                    <h4 class="modal-title">KELOMPOK SISWA PRAKERIN</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <table style="width: 100%;">
                                      <tr>
                                        <th>NO</th>
                                        <th>NAMA SISWA</th>
                                        <th>KELAS</th>
                                      </tr>
                                      <?php

                                        $siswa=$this->M_group_prakerin->get_row_join(array('groupprakerin.idpengajuan'=>$b->idpengajuan,'settahunajaran.status'=>1))->result();
                                        foreach ($siswa as $key => $v) {
                                          # code...
                                          ?>
                                          <tr>
                                            <td><?= $key+1 ?></td>
                                            <td><?= strtoupper($v->nama) ?></td>
                                            <td><?= $v->kdkelas ?></td>
                                          </tr>
                                          <?php
                                        }
                                      ?>
                                    </table>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>       
                      </td>
                      <td>

                          <button class="btn btn-info" data-toggle="modal" data-target="#laporMonitoring<?= $no ?>"><i class="fa fa-info"></i> Lapor Hasil Monitoring</button>
                            <div class="modal fade" id="laporMonitoring<?= $no ?>">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <form method="post" action="<?= base_url().'page/prakerin/perusahaan' ?>" enctype="multipart/form-data">
                                  <div class="modal-header">
                                    <h4 class="modal-title">LAPOR HASIL MONITORING</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="row">
                                      <div class="col-sm-12 col-md-12">
                                        <label>Nama DU/DI</label>
                                        <input type="text" value="<?= strtoupper($b->nmperusahaan) ?>" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-12 col-md-12">
                                        <label>Tanggal Monitoring</label>
                                        <input type="date" name="tglmonitoring" class="form-control" value="<?= $b->tglmonitoring ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-sm-12 col-md-12">
                                        <label>Deskripsi Hasil Monitoring</label>
                                        <textarea name="deskripsi" class="form-control" rows="15" id="summernote<?= $no ?>"><?= $b->deskripsi ?></textarea>
                                        </div>
                                    </div>
                                    <script>
                                              $('#summernote<?= $no ?>').summernote({
                                                placeholder: '',
                                                tabsize: 2,
                                                height: 300
                                              });
                                        </script>
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                                </form>
                                </div>
                                <!-- /.modal-content -->
                              </div>
                              <!-- /.modal-dialog -->
                            </div>
                       
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
                    <label>Nama Guru</label>
                    <select name="kdguru" class="form-control select2" style="width: 100%;">
                      <option></option>
                      <?php
                      foreach ($guru as $key => $value) {
                        # code...
                        ?>
                        <option value="<?= $value->kdguru ?>"><?= strtoupper($value->nama); ?></option>
                        <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Nama DU/DI</label>
                  <select name="dudi[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                    <option></option>
                      <?php
                      foreach ($ajuan as $key => $v2) {
                        # code...
                        ?>
                        <option value="<?= $v2->idpengajuan ?>"><?= strtoupper($v2->nmperusahaan); ?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="tingkat" value="<?= $tingkat ?>" class="form-control">
              <input type="hidden" name="kdjurusan" value="<?= $jur ?>" class="form-control">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              //<button type="submit" name="submit" class="btn btn-primary" value="simpan" id="btn">SIMPAN</button>
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
