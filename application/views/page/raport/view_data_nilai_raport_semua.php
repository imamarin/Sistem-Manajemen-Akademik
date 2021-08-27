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

            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Guru</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>KKM</th>
                      <th>Tahun Ajaran</th>
                      <th>Keterangan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($raport as $b) {
                    ?>
                    <tr>  
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->kdkelas; ?></td>
                      <td><?php echo $b->kkm; ?></td>
                      <td><?php echo $b->tahun." (".$b->semester.")"; ?></td>
                      <td><?php $t=ceil($b->jmlsiswa/$b->totalsiswa*100) ?>
                        <?php
                        if($t>=100){
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-success progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
                            </div>
                        <?php
                        }elseif($t>=80){
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
                            </div>
                        <?php    
                        }elseif($t>=50){
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-warning progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
                            </div>
                        <?php
                        }else{
                        ?>
                            <div class="progress">
                                <div class="progress-bar bg-danger progress-bar-striped" role="progressbar"
                                    aria-valuenow="<?= $t ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $t ?>%">
                                    <span><?= $t ?>% (<?= $b->jmlsiswa ?> Orang)</span>
                                </div>
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
     

