<script type="text/javascript">
  function hapus(id){
    s=window.confirm("Hapus Data ini");
    if(s){
      document.location="<?= base_url().$hapus_action ?>"+id;
    }
  }

  function edit(x,a,b,c,d,e,f,g,h){
    $("[name='kdmatpel']").val(a).trigger('change');
    $("[name='kdkelas']").val(b).trigger('change');
    $("[name='semester']").val(c).trigger('change');
    $("[name='tahun']").val(d).trigger('change');

    document.getElementsByName("kkm")[0].value=e;
    document.getElementsByName("bp")[0].value=f;
    document.getElementsByName("bk")[0].value=g;
    document.getElementById("title").innerHTML="Edit Data Nilai Raport";
    document.getElementById("btn").innerHTML="Update";
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("editmodal"+x)[0].setAttribute("data-target","#modal-default");
    document.getElementsByName("formData")[0].setAttribute("action","<?= base_url().'page/raport/nilairaport/update/'?>"+h);
    //document.getElementsByName("coba"+x)[0].value="aaaaaaaaaaa";
    //alert("sadsad");
  }

  function tambah(){

    document.getElementsByName("kkm")[0].value=0;
    document.getElementsByName("bp")[0].value=0;
    document.getElementsByName("bk")[0].value=0;
    document.getElementById("title").innerHTML="Tambah Data Nilai Raport";
    document.getElementById("btn").innerHTML="SIMPAN";
    document.getElementsByName("tambahmodal")[0].setAttribute("data-toggle","modal");
    document.getElementsByName("tambahmodal")[0].setAttribute("data-target","#modal-default");
    document.getElementsByName("formData")[0].setAttribute("action","<?= base_url().'page/raport/nilairaport/simpan'?>");
    //document.getElementsByName("coba"+x)[0].value="aaaaaaaaaaa";
    //alert("sadsad");
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
            <h1 class="m-0 text-dark">Daftar Penilaian Raport</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Daftar Penilaian Raport</a></li>
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
              if(in_array("Tampil-49", $this->session->fitur)){
                ?>
                  <button class="btn btn-primary" onclick="tambah();" name="tambahmodal"><i class="fa fa-plus"></i> Tambah Data </button>
                <?php
              }
              ?>

              <?php 
                if(in_array("Semua Guru-49", $this->session->fitur)){
                  ?>
                  <a href="<?= base_url('page/raport/nilairaport/semua') ?>"><button class="btn btn-success" value="Cover" onclick="">Lihat Semua Guru</button></a>
                  <?php
                }
                ?>
              

            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>KKM</th>
                      <th>Tahun Ajaran</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($raport as $b) {
                    ?>
                    <tr>  
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->kkm; ?></td>
                      <td><?php echo $b->tahun." (".$b->semester.")"; ?></td>
                      <td>             
                          <form method="post" action="<?= base_url()."page/raport/nilairaport/input/" ?>">
                            <input type="hidden" name="h_kdmatpel" value="<?= $b->kdmatpel ?>">
                            <input type="hidden" name="h_kdkelas" value="<?= $b->kdkelas ?>">
                            <input type="hidden" name="h_tahun" value="<?= $b->idtahunajaran ?>">
                            <input type="hidden" name="h_semester" value="<?= $b->semester ?>">
                            <input type="hidden" name="h_idnilairaport" value="<?= $b->idnilairaport ?>">
                            <button type="submit" name="input" value="input" class="btn btn-primary">Input Nilai</button> 

                            <button type="button" class="btn btn-danger" onclick="hapus('<?= $b->idnilairaport ?>')"><i class="fa fa-trash"></i></button>                        
                            <button type="button" class="btn btn-info" onclick="edit('<?= $no ?>','<?= $b->kdmatpel; ?>','<?= $b->kdkelas; ?>','<?= $b->semester; ?>','<?= $b->idtahunajaran; ?>','<?= $b->kkm; ?>','<?= $b->bobotpengetahuan; ?>','<?= $b->bobotketerampilan; ?>','<?= $b->idnilairaport; ?>');" name="editmodal<?= $no ?>"><i class="fa fa-edit"></i></button>
                          </form>               
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
            <form method="post" name="formData" action="<?= base_url().'page/raport/nilairaport/simpan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title" id="title">TAMBAH DATA NILAI RAPORT</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Kelas</label>
                    <select name="kdkelas" class="select2" data-placeholder="Kelas" data-dropdown-css-class="select2-blue" required>
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
                    <label>Mata Pelajaran</label>
                    <select name="kdmatpel" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
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
                    <label>Semester</label>
                    <select id="semester" name="semester" class="select2" data-placeholder="Hari Ke-" data-dropdown-css-class="select2-blue" required>
                      <?php
                      if($this->session->semesterraport=="ganjil"){
                        $ganjil="selected";
                        ?>
                        <option value="ganjil" <?= $ganjil ?>>Ganjil</option>
                        <?php
                      }else{
                        $ganjil="";
                      }

                      if($this->session->semesterraport=="genap"){
                        $genap="selected";
                        ?>
                        <option value="genap" <?= $genap ?>>Genap</option>
                        <?php
                      }else{
                        $genap="";
                      }
                      ?>
                      
                      
                    </select>
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
                        <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun ?></option>
                      <?php
                      }
                      ?>
                                    
                    </select>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nilai KKM</label>
                    <input type="number" name="kkm" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Bobot Nil. Pengetahuan</label>
                    <input type="number" name="bp" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Bobot Nil. Keterampilan</label>
                    <input type="number" name="bk" class="form-control" required>
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

