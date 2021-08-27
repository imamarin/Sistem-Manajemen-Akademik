<script type="text/javascript">
  if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
  }

  function cetak2(){
    document.getElementsByName("myForm")[0].setAttribute("target","_blank");
    document.getElementsByName("myForm")[0].setAttribute("action","<?= base_url().'page/rekapabsensiharian/cetak' ?>");
    document.getElementsByName("myForm")[0].submit();
    document.getElementsByName("myForm")[0].setAttribute("action","<?= base_url().'page/rekapabsensiharian/tampil' ?>");
    document.getElementsByName("myForm")[0].setAttribute("target","");
  }

  function excel(){
    document.getElementsByName("myForm")[0].setAttribute("action","<?= base_url().'page/rekapabsensiharian/excel' ?>");
    document.getElementsByName("myForm")[0].submit();
    document.getElementsByName("myForm")[0].setAttribute("action","<?= base_url().'page/rekapabsensiharian/tampil' ?>");
    document.getElementsByName("myForm")[0].setAttribute("target","");
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
            <h1 class="m-0 text-dark">Data Rekap Kehadiran Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Rekap Kehadiran Siswa</a></li>
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
              if(in_array("Tampil-37", $this->session->fitur) || in_array("Tampil-41", $this->session->fitur)){
                ?>
              <?= form_open($form_action,array("name"=>"myForm"));?>
                
                <div class="row">
              
                  <div class="col-sm-12 col-md-2">
                      <label>Kelas</label>
                      <select name="kdkelas" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php
                            foreach ($kelas as $key => $v) {
                              # code...
                              if($v->kdkelas==$kls){
                                $pil="selected";
                              }else{
                                $pil="";
                              }
                              ?>
                              <option value="<?= $v->kdkelas ?>" <?= $pil ?>><?= $v->kdkelas ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Semester</label>
                      <select name="semester" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                        <?php
                          if($semester=="ganjil"){
                            $g1="selected";
                          }else{
                            $g1="";
                          }

                          if($semester=="genap"){
                            $g2="selected";
                          }else{
                            $g2="";
                          }
                        ?>
                        <option value="ganjil" <?= $g1 ?> >Ganjil</option>
                        <option value="genap" <?= $g2 ?> >Genap</option>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Tahun Ajaran</label>
                      <select name="tahun" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                        <option value="<?= $tahun->idtahunajaran ?>"><?= $tahun->tahun ?></option>
                      </select>
                    </div>
                    <div class="col-sm-12 col-md-1 d-flex align-items-end">

                      <button type="submit" name="tampil" value="tampil" class="btn btn-primary">Tampilkan</button>
                    </div>
                    <div class="col-sm-12 col-md-1  d-flex align-items-end">
                      <button type="button" onclick="cetak2();" name="cetak" value="cetak" class="btn btn-primary"><i class="fas fa-print"></i></button>
                      &nbsp;<button type="button" onclick="excel();" name="cetak" value="cetak" class="btn btn-success">Eksport .xls</button>
                    </div> 
          
              
              
              </div>
              <?= form_close(); ?>
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
                      <th>NIS/NISN</th>
                      <th>Nama</th>
                      <th>Hadir</th>
                      <th>Sakit</th>
                      <th>Izin</th>
                      <th>Alfa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    ?>
                    <tr style="">
                      <td>
                        <?= $no ?>
                      </td>
                        
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo $b->hadir; ?></td>
                      <td><?php echo $b->sakit; ?></td>
                      <td><?php echo $b->izin; ?></td>
                      <td><?php echo $b->alfa; ?></td>
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
