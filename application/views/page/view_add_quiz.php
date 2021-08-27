<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah SOAL QUIZ</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Tambah Soal</a></li>
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
                <?php echo form_open($form_action); ?>
                <div class="row">
                    <div class="col">
                        <label>Deskripsi Soal</label>
                        <?php
                         $c=htmlspecialchars_decode($soal);
                         echo form_textarea('soal',$c,array('class'=>'form-control','id'=>'summernote'));
                         ?>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label>Pilihan 1</label><br>
                        <?php
                            $pil0=htmlspecialchars_decode($pilihan[0]);
                            echo form_textarea('pilihan[0]',$pil0,array('class'=>'form-control','id'=>'summernote1'));
                        ?>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label>Pilihan 2</label><br>
                        <?php
                             $pil1=htmlspecialchars_decode($pilihan[1]);
                            echo form_textarea('pilihan[1]',$pil1,array('class'=>'form-control','id'=>'summernote2'));
                        ?>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label>Pilihan 3</label><br>
                        <?php
                             $pil2=htmlspecialchars_decode($pilihan[2]);
                            echo form_textarea('pilihan[2]',$pil2,array('class'=>'form-control','id'=>'summernote3'));
                        ?>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label>Pilihan 4</label><br>
                        <?php
                             $pil3=htmlspecialchars_decode($pilihan[3]);
                            echo form_textarea('pilihan[3]',$pil3,array('class'=>'form-control','id'=>'summernote4'));
                        ?>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label>Pilihan 5</label><br>
                        <?php
                            $pil4=htmlspecialchars_decode($pilihan[4]);
                            echo form_textarea('pilihan[4]',$pil4,array('class'=>'form-control','id'=>'summernote5'));
                        ?>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6">
                        <label>Jawaban</label><br>
                        <?php
                            if($jawaban=="1"){
                                $j1="selected";
                            }else{
                                $j1="";
                            }
                            if($jawaban=="2"){
                                $j2="selected";
                            }else{
                                $j2="";
                            }
                            if($jawaban=="3"){
                                $j3="selected";
                            }else{
                                $j3="";
                            }
                            if($jawaban=="4"){
                                $j4="selected";
                            }else{
                                $j4="";
                            }
                            if($jawaban=="5"){
                                $j5="selected";
                            }else{
                                $j5="";
                            }

                        ?>
                        <select name="jawaban" class="form-control" style="width: 100%;">
                        <option value="1" <?= $j1 ?>>Pilihan 1</option>
                        <option value="2" <?= $j2 ?>>Pilihan 2</option>
                        <option value="3" <?= $j3 ?>>Pilihan 3</option>
                        <option value="4" <?= $j4 ?>>Pilihan 4</option>
                        <option value="5" <?= $j5 ?>>Pilihan 5</option>
                        </select>
                    </div>
                </div><br>
                <div class="row">
                    
                    <div class="col-sm-3 col-md-3">
                        <?php 
                        echo form_submit('submit','SIMPAN',array('class'=>'btn btn-primary'));
                        ?>
                    </div>
                </div>

                
                <?php echo form_close(); ?>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

 <script>
      $('#summernote').summernote({
        placeholder: '',
        tabsize: 2,
        height: 300
      });
      $('#summernote1').summernote({
        placeholder: '',
        tabsize: 2,
        height: 100
      });
      $('#summernote2').summernote({
        placeholder: '',
        tabsize: 2,
        height: 100
      });
      $('#summernote3').summernote({
        placeholder: '',
        tabsize: 2,
        height: 100
      });
      $('#summernote4').summernote({
        placeholder: '',
        tabsize: 2,
        height: 100
      });
      $('#summernote5').summernote({
        placeholder: '',
        tabsize: 2,
        height: 100
      });

    </script>

<script>
function myFunction() {
  var h = document.getElementById("listPg");
  h.insertAdjacentHTML("afterend", "<div class='row' id='listPg'><div class='col-12 col-sm-6 col-md-6'><label>Pilihan 1</label><br><textarea class='form-control'></textarea></div></div><br>");
}
</script>



