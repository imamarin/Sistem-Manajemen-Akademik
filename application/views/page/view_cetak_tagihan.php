<!DOCTYPE html>
<html>
<head>
<title>SMK YPC Tasikmalaya</title>

</head>
<body>
<style type="text/css">
	.table {
		border-collapse: collapse;
	}
 
	.table, .table th, .table td {
		border: 1px solid black;
        padding-left: 5px;
	}
</style>
<?php
$namaBulan = array("Januari","Februaru","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");


function bulan($x){
  $bulan=array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
  return $bulan[$x];
}

function jmlbulan($tgl_terima){
  $awal=date('Y',strtotime($tgl_terima));
  $akhir=$awal+3;
  $blnawal=date('n',strtotime($tgl_terima))-1;
  $jml = 0;
  for($a=$awal;$a<=$akhir;$a++){

      if($a > $awal && $a < $akhir){
          $bln=0;
          $blnakhir=12;
      }else{
                        
          if($a >= $akhir){
              $bln=0;
              $blnakhir=$blnawal--;
          }else{
              $bln=$blnawal;
              $blnakhir=12;
          }

      }
                      
      for($b=$bln;$b<$blnakhir;$b++){
          $jml++;
      }
  }

  return $jml;
}

function totBulan($tgl){
  //data awal

  $tgl_mulai=$tgl;
  $tgl_selesai=date('Y-m-d');
   
  //convert
  $timeStart = strtotime($tgl_mulai);
  $timeEnd = strtotime($tgl_selesai);
   
  // Menambah bulan ini + semua bulan pada tahun sebelumnya
  $numBulan = 1 + (date("Y",$timeEnd)-date("Y",$timeStart))*12;
   
  // hitung selisih bulan
  $numBulan += date("m",$timeEnd)-date("m",$timeStart);
   
  return $numBulan; 
}
?>
<table cellspacing="0" align="center" width="705px">
	  <tr>
		    <th colspan=3>TAGIHAN KEUANGAN SISWA<br><br></th>
	  </tr>
    <tr>
        <td>NISN</td><td>:</td><td><?= $siswa->nisn ?></td>
    </tr>
    <tr>
        <td>NAMA SISWA</td><td>:</td><td><?= $siswa->nama ?></td>
    </tr>
    <tr>
        <td>KELAS</td><td>:</td><td><?= $siswa->kdkelas ?></td>
    </tr>
	  <tr valign="top">
        <td colspan=3>
          <br>
          <table class="table" width="705px">
            <tr>
                <th colspan=4>TAGIHAN SPP: 
                <?php
                $totbln=totBulan($tagihan->tgl_terima)-$tagihan->tagihanspp;
                if($totbln<0){
                  echo 0;
                }else{
                  echo $totbln;
                }
                ?> 
                
                BULAN</th>
            </tr>
            <tr>
                      <th>NO</th>
                      <th>BULAN</th>
                      <th>TAHUN</th>
                      <th>KETERANGAN</th>
            </tr>
          
                  <?php
                          if($totbln>0){
                            $awal=date('Y',strtotime($tgl_terima));
                            $akhir=date('Y');
                            $blnawal=date('n',strtotime($tgl_terima))-1;
                            $no=1;
                            for($a=$awal;$a<=$akhir;$a++){

                              if($a > $awal && $a < $akhir){
                                $bln=0;
                                $blnakhir=12;
                              }else{
                                
                                if($a >= $akhir){
                                  $bln=0;
                                  $bakhir=date('n');
                                  $blnakhir=$bakhir;
                                }else{
                                  $bln=$blnawal;
                                  $blnakhir=12;
                                }

                              }
                              
                              for($b=$bln;$b<$blnakhir;$b++){

                                $bln2=bulan($b);

                                $waktu="";
                                $ket2="BELUM BAYAR";
                                foreach ($transaksispp as $key => $val) {
                                        # code...
                                  if(bulan($b)==$val->bulan && $a == $val->tahun){
                                    $id=$val->idspp;
                                    $waktu=$val->waktu;
                                    $ket2="SUDAH BAYAR";
                                    break;
                                  }else{
                                    $waktu="";
                                    $ket2="BELUM BAYAR";
                                  }

                                }
                                ?>
                                <?php
                                if($ket2=="BELUM BAYAR"){
                                ?>
                                <tr>
                                  <td><?= $no ?></td>
                                  <td><?= bulan($b) ?></td>
                                  <td><?= $a ?></td>
                                  <td>
                                    <?php
                                      echo $ket2;
                                    ?>                            
                                  </td>
                                </tr>
                                <?php
                                $no++;
                                }
                                ?>
                                <?php
                                
                              }
                            }
                          }      
                          ?>

          </table>
        </td>
	</tr>
  <tr>
      <td colspan=3>
      <br>
          <table id="" class="table table-bordered table-striped dt-responsive " width="705px">
                  <thead>
                    <tr>
                        <th colspan=5>TAGIHAN KEUANGAN: <?php echo "Rp. ".number_format($tagihan->biaya - $tagihan->tagihannonspp,0,'','.'); ?></th>
                    </tr>
                    <tr>
                      <th>NO</th>
                      <th>KEUANGAN</th>
                      <th>BIAYA</th>
                      <th>SISA TAGIHAN</th>
                      <th>KETERANGAN</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                      $no=1;
                      foreach ($keuangan as $key => $val) {
                        $tgl="";
                        $ket2="BELUM BAYAR";
                        $angsuran=0;
                        foreach ($transaksinonspp as $key => $v) {
                          if($val->kdkatkeuangan == $v->kdkatkeuangan){
                            $tgl = $v->waktu;
                            if($v->total>=$v->biaya){
                              if($v->metode=="tunai"){
                                $ket2="SUDAH BAYAR";
                              }else{
                                $angsuran=1;
                                $ket2="ANGSURAN";
                              }
                            }else{
                                if($v->metode!="belum bayar"){
                                  $angsuran=1;
                                  $ket2="ANGSURAN";
                                }else{
                                  $angsuran=0;
                                  $ket2="BELUM BAYAR";
                                }
                            }
                            break;
                          }else{

                            $ket2="BELUM BAYAR";
                          }
                        }
                      ?>

                      <?php
                      $tag = $val->biaya-$val->tagihan;
                      if($tag > 0 ){
                      ?>
                      <tr>
                        <td><?= $no ?></td>
                        <td><?= $val->nama ?></td>
                        <td><?= "Rp. ".number_format($val->biaya,0,'','.'); ?></td>
                        <td><?= "Rp. ".number_format($val->biaya-$val->tagihan,0,'','.'); ?></td>                          
                        <td>
                          <?php 
                            echo $ket2;
                          ?>
                        </td>
                      </tr>
                      <?php
                      $no++;
                      }
                      ?>
                    <?php
                        
                      }
                    ?>
                  </tbody>
                </table>
                    
      </td>
  </tr>

</table>
</body>
</html>
<script type="text/javascript">
	window.print();
</script>