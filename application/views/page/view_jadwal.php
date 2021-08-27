<script type="text/javascript">
  function edit(x,a,b,c,d,e,f,g,h){

    $("[name='pekan']").val(a).trigger('change');
    //selectItemByValue(document.getElementsByName("pekan")[0],"2");
    //document.getElementsByName("pekan")[0].value=2;
    $("[name='matpel']").val(b).trigger('change');
    $("[name='kdkelas']").val(c).trigger('change');
    $("[name='hari']").val(d).trigger('change');
    $("[name='jam']").val(e).trigger('change');
    $("[name='tahun']").val(g).trigger('change');

    document.getElementsByName("jml")[0].value=f;
    document.getElementById("title").innerHTML="Edit Data Jadwal";
    document.getElementById("btn").innerHTML="Update";
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-target","#modal-default");
    document.getElementsByName("formData")[0].setAttribute("action","<?= base_url().$update_action ?>"+h);
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
            <h1 class="m-0 text-dark">Data Jadwal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Jadwal</a></li>
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
                  <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i> Tambah Data </button>
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
                      <th>Pekan</th>
                      <th>Hari</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Tahun Ajaran</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jadwal as $b) {
                      ?>
                    <tr>
                      <td>
                        <?php 
                        if(in_array("Edit Data-12", $this->session->fitur) || in_array("Edit Data-20", $this->session->fitur)){
                          ?>
                            <button class="btn btn-info" onclick="edit('<?= $no ?>','<?= $b->pekan; ?>','<?= $b->kdmatpel; ?>','<?= $b->kdkelas; ?>','<?= $b->hari; ?>','<?= $b->jam; ?>','<?= $b->jml_jam; ?>','<?= $b->idtahunajaran; ?>','<?= $b->idjadwal; ?>');" name="editmodal<?= $no ?>"><i class="fa fa-edit"></i></button></a>
                          <?php
                        }

                        if(in_array("Hapus Data-12", $this->session->fitur) || in_array("Edit Data-20", $this->session->fitur)){
                          ?>
                            <button class="btn btn-danger" onclick="hapus('<?= $b->idjadwal ?>')"><i class="fa fa-trash"></i></button></a>
                          <?php
                        }
                        ?>
                      </td>
                        
                      <td><?php echo $b->pekan."-".$b->idjadwal; ?></td>
                      <td><?php echo $b->hari; ?></td>
                      <td><?php echo "Jam ke: ".$b->jam."/ (".$b->start_time.")"; ?></td>
                      <td><?php echo "Jam ke: ".$b->jml."/ (".$b->waktu.")"; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->tahun ?></td>
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
              <h4 class="modal-title" id="title">TAMBAH DATA JADWAL</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Pekan</label>
                    <select id="pekan" name="pekan" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                      <option value="1">1</option>
                      <option value="2">2</option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Mata pelajaran</label>
                    <select name="matpel" class="select2" data-placeholder="Pilih Matpel" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($matpel as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->kdmatpel ?>"><?= $v->matpel ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Kelas</label>
                    <select name="kdkelas" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($kelas as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->kdkelas ?>"><?= $v->kdkelas ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                      <label>Hari</label>
                      <select name="hari" class="select2" data-placeholder="Pilih hari" data-dropdown-css-class="select2-blue" style="width: 100%;" required>
                          <option value="senin">Senin</option>
                          <option value="selasa">Selasa</option>
                          <option value="rabu">Rabu</option>
                          <option value="kamis">Kamis</option>
                          <option value="jumat">Jumat</option>
                          <option value="sabtu">Sabtu</option>
                          <option value="minggu">Minggu</option>
                      </select>
                    </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Jam Ke</label>
                    <select name="jam" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                     <?php
                      for ($a=1;$a <=10;$a++) {
                                        # code...
                      ?>
                        <option value="<?= $a ?>"><?= $a ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Jumlah Jam</label>
                    <input type="text" name="jml" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tahun Ajaran</label>
                    <select name="tahun" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                     <?php
                      foreach ($tahun as $key => $v) {
                                        # code...
                      ?>
                        <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun ?> / <?= $v->semester ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="KIRIM" id="btn">SIMPAN</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
<?php
ini_set('display_errors','off');
?>

