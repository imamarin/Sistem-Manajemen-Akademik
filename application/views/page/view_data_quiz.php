<script type="text/javascript">
  function atur(t,x,y){
    if(t=="hapus"){
        s=window.confirm("Hapus Data ini");
        if(s){
            document.location="<?php echo base_url(); ?>"+"guru/quiz/"+t+'/'+x+'/'+y;
        }
    }else{
        document.location="<?php echo base_url(); ?>"+"guru/quiz/"+t+'/'+x+"/"+y;
    }
    
  }
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Quiz</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Daftar Quiz</a></li>
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
              <div class="row">
                <div class="col-sm-12 col-md-7">
                  <?= form_open($form_action) ?>
                  <div class="row">
                    <div class="col-sm-12 col-md-2"  d-flex align-items-end>
                      <label>Durasi(Menit)</label><br>
                      <input type="number" name="durasi" class="form-control" value="<?= $durasi ?>">
                    </div>
                    <div class="col-sm-12 col-md-2">
                      <label>Jumlah Soal</label>
                      <input type="number" name="jml" class="form-control" value="<?= $jml ?>">
                    </div>
                    <div class="col-sm-12 col-md-3  d-flex align-items-end">
                      <button class="form-control bg-success" style="width: 100%;" id="waktu">SIMPAN</button>
                    </div>
                  </div>
                <?= form_close() ?>
                </div>
                <div class="col-sm-12 col-md-2 d-flex align-items-end" style="border:solid 0px black;">
                  <a href="<?php echo base_url().'guru/quiz/import/'.$n; ?>" style="width: 100%;"> 
                  <button class="form-control bg-info" style="width: 100%;" id="waktu">Transfer Soal</button></a>
                </div>
                <div class="col-sm-12 col-md-3 d-flex align-items-end" style="border:solid 0px black;">
                  <a href="<?php echo base_url().'guru/quiz/add/'.$n; ?>" style="width: 100%;"> 
                  <button class="form-control bg-primary" style="width: 100%;" id="waktu">Tambah Soal Baru</button></a>
                </div><!-- /.col -->
                <!-- /.col -->
              </div><!-- /.row --> 
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>soal</th>
                      <th>Jawaban</th>
                      <th>Pilihan</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($quiz as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td>
                        <?php
                        $text=str_replace("[script]", "<xmp>", $b->soal);
                        $text=str_replace("[/script]", "</xmp>", $text);
                        echo htmlspecialchars_decode($text);
                        ?>
                      </td>
                      <td><?php echo htmlspecialchars_decode($b->text); ?></td>
                      <td>
                      <?php
                      echo form_input(array('type'=>'button','value'=>'EDIT','class'=>'btn btn-success btn-xs','onclick'=>"atur('edit',$b->idtugas,$b->idsoal);"));
                      echo " ";
                      echo form_input(array('type'=>'button','value'=>'HAPUS','class'=>'btn btn-danger btn-xs','onclick'=>"atur('hapus',$b->idtugas,$b->idquiz,$b->idsoal);"));
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



