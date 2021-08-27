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
<?php

?>
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
            <h1 class="m-0 text-dark">Data Jadwal Pelajaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Jadwal Pelajaran</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    

    <section class="content">
      
  
      <div class="row">
      <div class="col-12">
          <div class="card">
            <div class="card-header">

            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>Pekan</th>
                      <th>Hari</th>
                      <th>Jam Masuk</th>
                      <th>Jam Keluar</th>
                      <th>Mata Pelajaran</th>
                      <th>Pengajar</th>
                      <th>Token</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($jadwal as $b) {
                      ?>
                    <tr>
                      
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->hari; ?></td>
                      <td><?php echo "Jam ke: ".$b->jam."/ (".$b->start_time.")"; ?></td>
                      <td><?php echo "Jam ke: ".$b->jml."/ (".$b->waktu.")"; ?></td>
                      <td><?php echo $b->matpel; ?></td>
                      <td><?php echo $b->nama ?></td>
                      <td><?php echo $b->token; ?></td>
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

