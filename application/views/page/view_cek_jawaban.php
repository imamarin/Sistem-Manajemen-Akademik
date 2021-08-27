<script language=javascript>
<!--
var message="";
///////////////////////////////////
function clickIE4(){
   if (event.button==2){
      alert(message);
      return false;
   }
}
function clickNS4(e){
   if (document.layers||document.getElementById&&!document.all){
      if (e.which==2||e.which==3){
      alert(message);
      return false;
      }
   }
}
if (document.layers){
   document.captureEvents(Event.MOUSEDOWN);
   document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
   document.onmousedown=clickIE4;
}
document.oncontextmenu=new Function("return false")
// -->
</script>

<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">HASIL QUIZ - <?= strtoupper($nama) ?></h3>
          </div><!-- /.col -->
          <div class="col-sm-6 float-right" align="right">
            <button class='btn btn-primary'>HASIL AKHIR: <?= $nilaiakhir ?></button>
          </div>
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <section class="content">
      
      <div class="row">
        <div class="col-12">
          <div class="card">

            <!-- /.card-header -->
            <div class="card-body" oncopy='return false' oncut='return false' onpaste='return false'>

                <?php echo form_open($form_action); ?>
                <?php
                $n=0;
                $no=0;
                foreach($soal as $k => $s):
                
                $no++;
                if($s->hasil==0){
                  $bg="bg-info";
                }else{
                  $bg="bg-success";
                }
                ?>
                <div class="row">
                    <div class="col-1 col-sm-1 col-md-1" style="">
                        <div style="width: 100%;height: 100%;padding-top: 5%;" class="<?= $bg ?>" align="center">
                          <h4><?= $no; ?></h4>
                        </div>
                    </div>
                    <div class="col-10 col-sm-10 col-md-10" align="justify" style="margin-left: 1%;">

                        <?= htmlspecialchars_decode($s->soal) ?><br>
                        <?php
                          
                          foreach ($pg[$k] as $key => $v) {
                            # code...
                            $n++;
                            $tiperadio="icheck-primary";
                            $idradio="radioPrimary".$n;

                            //Cek Jawaban
                            if($v->idpg==$jawaban[$k]){
                              $checked="checked";
                            }else{
                              $checked="";
                            }

                            if($v->idpg==$benar[$k]){
                              $tiperadio='icheck-success';
                              $checked2="checked";
                              $idradio="radioPrimary".$n;
                            }else{
                              $checked2="";
                            }
                            ?>
                            <div class="row">
                              <div class="col-sm-12 col-md-12" align="justify">
                              <!-- radio -->
                                <div class="form-group clearfix">
                                  <div class="<?= $tiperadio ?> d-inline">
                                    <input type="radio" name="" id="<?= $idradio ?>" onclick="sendPilihan('<?= $s->idquiz ?>','<?= $v->idpg ?>','<?= $this->session->nis ?>'); "<?= $checked ?> <?= $checked2 ?> disabled>
                                    <label for="<?= $idradio ?>" style="font-weight: normal;" id="label<?= $idradio ?>"><?= $v->text ?></label>
                                  </div>
                                </div>
                              </div>
                            </div>
                              <?php  
                          }
                        ?>
                    </div>
                </div><br>
                <?php endforeach; ?>
                <div class="row">
                  <div class="col-sm-12 col-md-12 col-xs-12" style="margin-top: 2%;" align="center">
                    <a href="<?= base_url().'siswa/tugas/modul/'.$idtugas ?>" class="btn btn-primary">ANDA SUDAH MELAKSANA QUIZ</a>
                   
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
    function sendPilihan(idquiz,idpg,nis) {
      $.post("<?= base_url().'siswa/quiz/addjawaban' ?>",{
        'idquiz':idquiz,
        'idpg':idpg,
        'nis':nis
      },
        function(data, status){

        }
      );
    }
</script>

