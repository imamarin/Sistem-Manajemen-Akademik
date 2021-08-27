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

  function hapus(id){
    s=window.confirm("Hapus Data ini");
    if(s){
      document.location="<?= base_url().$hapus_action ?>"+id;
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
            <h1 class="m-0 text-dark">Data Siswa Prakerin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Siswa Prakerin</a></li>
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
              if(in_array("Tambah Data-12", $this->session->fitur) || in_array("Tambah Data-20", $this->session->fitur)){
                ?>
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
                      <!--
                      <div class="col-sm-12 col-md-2">
                          <label>Tingkat</label>
                          <select name="tingkat" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                            <?php
                            if($tingkat==10){
                              $x="selected";
                            }else{
                              $x="";
                            }

                            if($tingkat==11){
                              $xi="selected";
                            }else{
                              $xi="";
                            }

                            if($tingkat==12){
                              $xii="selected";
                            }else{
                              $xii="";
                            }
                            ?>
                            <option value="12" <?= $xii ?> >XII</option>
                            <option value="11" <?= $xi ?> >XI</option>
                            <option value="10" <?= $x ?> >X</option>
                              
                          </select>
                      </div>
                    -->
                      <div class="col-sm-12 col-md-1 d-flex align-items-end">

                          <button type="submit" name="submit" value="tampil" class="btn btn-primary">Tampilkan</button>
                      </div>
                      <?php 
                      if(in_array("Eksport Data-45", $this->session->fitur)){
                        ?>
                          
                        <?php
                      }
                      ?>    
                  </div>
                  <?= form_close(); ?>
                <?php
              }
              ?>

        
              
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NISN</th>
                      <th>Nama Siswa</th>
                      <th>Kelas</th>
                      <th>Nama Perusahaan</th>
                      <th>Kota/Kabupaten</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                      ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?php echo strtoupper($b->nisn); ?></td>
                      <td>
                        <?php echo strtoupper($b->nama); $kel[$no]=array(); ?><br>
                         
                      </td>
                      <td><?php echo strtoupper($b->kdkelas); ?></td>
                      <td><?php echo strtoupper($b->nmperusahaan); ?></td>
                      <td><?php echo strtoupper($b->kota); ?></td>
                      <td>
                        <?php 
                          if($b->status==0){
                            ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-danger">Belum Pengajuan</button>                   
                            </div>
                            <?php
                          }elseif($b->status==1){
                            ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-primary">Pengajuan</button>          
                            </div>
                            <?php
                          }elseif($b->status==2){
                            ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-info">Pengambilan Surat</button>          
                            </div>
                            <?php

                          }elseif($b->status==3){
                            ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-warning">Tidak Diterima</button>          
                            </div>
                            <?php

                          }else{
                            ?>
                            <div class="btn-group">
                              <button type="button" class="btn btn-success">Diterima</button>            
                            </div>
                            
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
                    <select name="idperusahaan" class="form-control select2" style="width: 100%;">
                      <option></option>
                      <?php
                      foreach ($perusahaan as $key => $value) {
                        # code...
                        ?>
                        <option value="<?= $value->idperusahaan ?>"><?= strtoupper($value->nmperusahaan); ?></option>
                        <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Tanggal Pengajuan</label>
                  <input type="date" name="tanggal" class="form-control">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Nama Pengaju</label>
                  <select name="pengaju" class="form-control select2" style="width: 100%;">
                      <option></option>
                      <?php
                      foreach ($siswa2 as $key => $v1) {
                        # code...
                        ?>
                        <option value="<?= $v1->nisn ?>"><?= strtoupper($v1->nama); ?></option>
                        <?php
                      }
                      ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Kelompok Prakerin</label>
                  <select name="kelompok[]" class="select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                    <option></option>
                      <?php
                      foreach ($siswa2 as $key => $v2) {
                        # code...
                        ?>
                        <option value="<?= $v2->nisn ?>"><?= strtoupper($v2->nama); ?></option>
                        <?php
                      }
                      ?>
                  </select>
                  </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <label>Status Pengajuan</label>
                  <select name="status" class="form-control select2" style="width: 100%;">
                      <option value="1">Pengajuan</option>
                      <option value="2">Diterima</option>
                      <option value="0">Tidak Diterima</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="idtahunajaran" value="<?= $tahun ?>" class="form-control">
              <input type="hidden" name="idpengajuan" value="" class="form-control">
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
