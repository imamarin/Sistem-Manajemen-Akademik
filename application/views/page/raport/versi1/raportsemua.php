<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style type="text/css" media="all">
table#nilai,table#ket{
border-right:#000000 solid 1px;
border-bottom:#000000 solid 1px;
z-index:100;
}

table#nilai tr td, table#nilai tr th{
border:#000000 solid 1px;
border-right:none;
border-bottom:none;
}
table#ket tr td, table#ket tr th{
border:#000000 solid 1px;
border-right:none;
border-bottom:none;
}
body{
font-size:12px;
}

b{
	z-index: 200;
}
</style>
<?php
function tanggal($tanggal=NULL){
    $tgl=explode("-",$tanggal);
    $thn=$tgl[0];
    $bln=$tgl[1];
    $day=$tgl[2];
    $b=array('','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');

    $bulan=$b[$bln];
    $t=$day." ".$bulan." ".$thn;
    return $t;
}
?>
</head>
<body>
<img src="image/bg.jpeg" style="position: absolute; z-index: 0;" width="700" height="900" >
<?php
$nis="";
$nama="";

foreach($siswa as $row){
$nis=$row->nisn;
$nama=$row->nama
?>
<h3 style="display:none;">LAPORAN HASIL PENILAIAN AKHIR SEMESTER <?php echo strtoupper($dr->semester); ?></h3>
<table style="width:100%;border-bottom:solid 1px #000000;z-index: 100;" >
<tr>
<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td><td>Kelas</td><td>: <?php echo $row->kdkelas; ?></td>
</tr>
<tr>
<td>Alamat</td><td>: -</td><td>Semester</td><td>: <?php echo $dr->semester; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td><td>Tahun Ajaran</td><td>: <?php echo $dr->tahun; ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td></td><td></td>
</tr>
</table>

</center><br />
<center><b>CAPAIAN HASIL BELAJAR</b></center>
<br />
<br />
<b>A. SIKAP</b>
<b>&nbsp;&nbsp;</b> 
<table style="width:100%;z-index: 100;" id="nilai" cellspacing="0">

<tr>
<th align="center">Predikat</th>
<th align="center">Deskripsi</th>
</tr>

<tr>
<td align="center" style="width:30%;height:20%;">
<?php

if(!isset($spiritual[$row->nisn]) || !isset($sosial[$row->nisn]) ){
    echo "-";
}else{
    echo "B";
}

?>
</td>
<td style="padding-left:5px;">
Sikap Spiritual peserta didik secara umum baik pada:<br />
<?php
$n=1;
if(isset($spiritual)){
    foreach($spiritual as $key=>$v){
        if($key==$row->nisn){
            foreach($v AS $val){
            echo $n.". ".$val."<br>";
            $n++;
            }
        }
        
    }
}else{
    echo "-";
}
?>	
<br />
Sikap Sosial peserta didik secara umum baik pada:<br />
<?php
$n=1;
if(isset($sosial)){
    foreach($sosial as $key=>$v){
        if($key==$row->nisn){
            foreach($v AS $val){
            echo $n.". ".$val."<br>";
            $n++;
            }
        }
        
    }
}else{
    echo "-";
}
?>			
</td>
</tr>

</table>
</div>
<?php
}
?>

<!-- RAPORT 2 -->
<?php
foreach($siswa as $row){
?>
<div style="page-break-before:always;">
<img src="image/bg.jpeg" style="position: absolute; z-index: 0;" width="700" height="900" >
<center>
<h3 style="display:none;">LAPORAN HASIL PENILAIAN AKHIR SEMESTER <?php echo strtoupper($dr->semester); ?></h3>
<table style="width:100%;border-bottom:solid 1px #000000;z-index: 100;" >
<tr>
<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td><td>Kelas</td><td>: <?php echo $row->kdkelas; ?></td>
</tr>
<tr>
<td>Alamat</td><td>: -</td><td>Semester</td><td>: <?php echo $dr->semester; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td><td>Tahun Ajaran</td><td>: <?php echo $dr->tahun; ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td></td><td></td>
</tr>
</table>

</center><br />
<b>B. Pengetahuan dan Keterampilan</b>
<br />
<table style="width:100%;z-index: 100;" id="nilai" cellspacing="0">
<thead>
<tr>
<th colspan="2" rowspan="2" valign="middle" align="center">MATA PELAJARAN</th>
<th rowspan="2" valign="middle" align="center" style="width:5%;">KB</th>
<th colspan="2" align="center">Pengetahuan</th>
<th rowspan="2" valign="middle" align="center" style="width:5%;">KB</th>
<th colspan="2" align="center">Keterampilan</th>
</tr>
<tr>
<th align="center" style="width:3%;">Nilai</th>
<th align="center" style="width:3%;">Predikat</th>
<th align="center" style="width:3%;">Nilai</th>
<th align="center" style="width:3%;">Predikat</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="8"><b>Muatan Nasional</b></td>
</tr>
<?php
$n=1;
foreach($matpel_A AS $row1){
?>
<tr>
	<td align="center" style="width:1%;"><?php echo $n; ?></td>
	<td><?php echo $row1->matpel; ?><br /><?php echo ucwords($row1->nama); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanA=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanA="-";
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?= $pengetahuanA; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($pengetahuanA<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($pengetahuanA<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($pengetahuanA<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanA=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$keterampilanA="-";
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?php echo $keterampilanA; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($keterampilanA<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($keterampilanA<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($keterampilanA<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
</tr>
<?php
$n++;
}
?>

<tr>
<td colspan="8"><b>Muatan Kewilayahan</b></td>
</tr>
<?php
$n=1;
foreach($matpel_B AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
	<td><?php echo $row1->matpel; ?><br /><?php echo ucwords($row1->nama); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanB=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanB="-";
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?= $pengetahuanB; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($pengetahuanB<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($pengetahuanB<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($pengetahuanB<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanB=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$keterampilan[$row1->kdmatpel][$row->nisn];
	}else{
		$keterampilanB="-"; 
		$kkm=0;
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?php echo $keterampilanB; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($keterampilanB<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($keterampilanB<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($keterampilanB<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
</tr>
<?php
$n++;
}
?>


<tr>
<td colspan="8"><b>Dasar Bidang Keahlian</b></td>
</tr>
<?php
$n=1;
foreach($matpel_C AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
	<td><?php echo $row1->matpel; ?><br /><?php echo ucwords($row1->nama); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanC=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanC="-"; 
		$kkm=0;
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?= $pengetahuanC; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($pengetahuanC<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($pengetahuanC<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($pengetahuanC<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanC=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$keterampilan[$row1->kdmatpel]['kkm'];
	}else{
		$keterampilanC="-";
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?php echo $keterampilanC; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($keterampilanC<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($keterampilanC<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($keterampilanC<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
</tr>
<?php
$n++;
}
?>


<tr>
<td colspan="8"><b>Dasar Program Keahlian</b></td>
</tr>
<?php
$n=1;
foreach($matpel_D AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
	<td><?php echo $row1->matpel; ?><br /><?php echo ucwords($row1->nama); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanD=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanD="-"; 
		$kkm=0;
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?= $pengetahuanD; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($pengetahuanD<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($pengetahuanD<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($pengetahuanD<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanD=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$keterampilan[$row1->kdmatpel]['kkm'];
	}else{
		$keterampilanD="-";
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $kkm; ?></td>
	<td align="center"><?php echo $keterampilanD; ?></td>
	<td align="center" >
	<?php
	$range=(100-$kkm)/3;
	$range=floor($range);
	if($keterampilanD<$kkm){
	$desk="Peserta didik belum mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "D";
	}else if($keterampilanD<=$kkm+$range){
	$desk="Peserta didik cukup mampu untuk menerima dan menyerap materi pembelajaran, namun belum tuntas dan perlu mendapat perhatian orang tua";
	echo "C";
	}else if($keterampilanD<=$kkm+$range+$range){
	$desk="Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru ";
	echo "B";
	}else{
	$desk="Sangat Baik, Peserta didik mampu menerima dan menyerap materi pembelajaran yang diberikan oleh guru";
	echo "A";
	}
	?>
	</td>
</tr>
<?php
$n++;
}
?>
</tbody>
<tfoot>
</tfoot>
</table>

</div>
<?php
}
?>

<!-- RAPORT 3 -->
<?php
foreach($siswa as $row){
?>
<div style="page-break-before:always;">
<img src="image/bg.jpeg" style="position: absolute; z-index: 0;" width="700" height="900" >
<center>
<h3 style="display:none;">LAPORAN HASIL PENILAIAN AKHIR SEMESTER <?php echo strtoupper($dr->semester); ?></h3>
<table style="width:100%;border-bottom:solid 1px #000000;z-index: 100;" >
<tr>
<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td><td>Kelas</td><td>: <?php echo $row->kdkelas; ?></td>
</tr>
<tr>
<td>Alamat</td><td>: -</td><td>Semester</td><td>: <?php echo $dr->semester; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td><td>Tahun Ajaran</td><td>: <?php echo $dr->tahun; ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td></td><td></td>
</tr>
</table>

</center><br />
<b>C. Praktik Kerja Lapangan</b>
<br />
<table style="width:100%;z-index:100;" id="nilai" cellspacing="0">
<thead>
<tr>
<th valign="middle" align="center" style="width:5%;">No</th>
<th valign="middle" align="center"> Mitra DU/DI</th>
<th align="center">Lokasi</th>
<th valign="middle" align="center">Lamanya</th>
<th align="center">Nilai</th>
</tr>
</thead>
<tbody>
<?php
$no=1;
if(isset($prakerin)){
?>
<tr>
<td align="center">1. </td>
<td><?php echo isset($prakerin[$row->nisn]['dudi'])?$prakerin[$row->nisn]['dudi']:"-"; ?></td>
<td><?php echo isset($prakerin[$row->nisn]['alamat'])?$prakerin[$row->nisn]['alamat']:"-"; ?></td>
<td><?php echo isset($prakerin[$row->nisn]['waktu'])?$prakerin[$row->nisn]['waktu']:"-"; ?></td>
<td><?php echo isset($prakerin[$row->nisn]['nilai'])?$prakerin[$row->nisn]['nilai']:"mm"; ?></td>
</tr>
<?php
}else{
?>
<tr>
<td align="center">1</td>
<td>-</td>
<td>-</td>
<td>-</td>
<td>-</td>
</tr>
<?php
}
?>
</tbody>
</table>
<br />
<b>D. Ekstrakurikuler</b>
<br />
<table style="width:100%;z-index:100;" id="nilai" cellspacing="0">
<thead>
<tr>
<th valign="middle" align="center" style="width:5%;">No</th>
<th valign="middle" align="center" style="width:30%;"> Kegiatan Ekstrakurikuler</th>
<th align="center">Keterangan</th>
</tr>
</thead>
<tbody>
<?php

$no=1;
if(isset($ekstranama[$row->nisn])){
    foreach($ekstranama[$row->nisn] AS $key=>$val){
    ?>
    <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $val; ?></td>
    <td>
        <?php
        if($ekstranilai[$row->nisn][$key]==1){
        echo "Peserta didik cukup dalam mengikuti kegiatan";
        }else if($ekstranilai[$row->nisn][$key]==2){
        echo "Peserta didik baik dan aktif dalam mengikuti kegiatan";
        }else if($ekstranilai[$row->nisn][$key]==3){
        echo "Peserta didik Sangat aktif dalam mengikuti kegiatan";
        }else{
        echo "-";
        }
        ?>
    </td>
    </tr>
    <?php
    $no++;
    }

    $j=count($ekstranama[$row->nisn]);
    if($j<=3){
            for($r=$j+1;$r<=3;$r++){
            ?>
            <tr>
            <td align="center"><?php echo $r; ?></td>
            <td>-</td>
            <td>-</td>
            </tr>
            <?php
            }
    }
}else{
?>
    <tr>
    <td align="center">1</td>
    <td>-</td>
    <td>-</td>
    </tr>
    <tr>
    <td align="center">2</td>
    <td>-</td>
    <td>-</td>
    </tr>
    <tr>
    <td align="center">3</td>
    <td>-</td>
    <td>-</td>
    </tr>
<?php
}
?>
</tbody>
</table>
<br />
<b>E. Prestasi</b>
<br />
<table style="width:100%;" id="nilai" cellspacing="0">
<thead>
<tr>
<th valign="middle" align="center" style="width:5%;">No</th>
<th valign="middle" align="center" style="width:30%;">Jenis Prestasi</th>
<th align="center">Keterangan</th>
</tr>
</thead>
<tbody>
<tr>
<td align="center">1</td>
<td>-</td>
<td>-</td>
</tr>
<tr>
<td align="center">2</td>
<td>-</td>
<td>-</td>
</tr>
<tr>
<td align="center">3</td>
<td>-</td>
<td>-</td>
</tr>
</tr>
</tbody>
</table>
<br />
<b>F. Ketidakhadiran</b>
<br />
<table id="ket" cellspacing="0" style="width:30%;">
<tr>
<td align="center">1</td><td>Sakit</td><td align="center"><?= isset($absen[$row->nisn]['sakit'])?$absen[$row->nisn]['sakit']:"-"; ?></td>
</tr>
<tr>
<td align="center">2</td><td>Izin</td><td align="center"><?= isset($absen[$row->nisn]['izin'])?$absen[$row->nisn]['izin']:"-"; ?></td>
</tr>
<tr>
<td align="center">3</td><td>Tanpa Keterangan</td><td align="center"><?= isset($absen[$row->nisn]['alfa'])?$absen[$row->nisn]['alfa']:"-"; ?></td>
</tr>
</table>
<br />
<b>G. Catatan Walikelas</b>
<br />
<table id="ket" cellspacing="0" style="width:100%;">
<tr>
<td align="center" style="height:10%;"> </td>
</tr>
</table>
<br />
<br />
<b>H. Tanggapan Orang Tua/WaliCatatan Wali Kelas</b>
<br />
<table id="ket" cellspacing="0" style="width:100%;">
<tr>
<td align="center" style="height:10%;"> </td>
</tr>
</table>

<div style="z-index:100;">
<?php
$kls=explode(" ",$row->kdkelas);


if($this->session->semesterraport=="genap" && strtolower($kls[0])=="xii"){
?>
	<br />
	<br />
	Keputusan :<br />
	Berdasarkan hasil yang dicapai pada semester 1 dan 6, peserta didik ditetapkan
	<br />
    <b>Lulus / <strike>Tidak Lulus</strike></b>
<?php
}else{

if(isset($kenaikan[$row->nisn])){
	?>

	<br />
	<br />
	Keputusan :<br />
	Berdasarkan hasil yang dicapai pada semester 1 dan 2, peserta didik ditetapkan
	<br />
	<br />
	<?php
	
		if($kenaikan[$row->nisn]['nilai']==1){
			if(strtolower($kls[0])=="x"){
			?>
			Naik kelas XI ( Sebelas )<br />
			Tinggal di kelas - ( - )<br />
			<?php
			}else if(strtolower($kls[0])=="xi"){
			?>
			Naik kelas XII ( Dua belas )<br />
			Tinggal di kelas - ( - )<br />
			<?php
			}
			?>
		<?php
		}else{
			if(strtolower($kls[0])=="x"){
			?>
			Naik kelas - ( - )<br />
			Tinggal di kelas X ( Sepuluh )<br />
			<?php
			}else if(strtolower($kls[0])=="xi"){
			?>
			Naik kelas - ( - )<br />
			Tinggal di kelas XI ( Sebelas )<br />
			<?php
			}
		}
	?>
	<br />
	<br />
	<?php
	
    }
}
?>

<table style="width:100%;z-index:100;" border="0">
<tr>
<td valign="top">
    <table>
    <tr>
    <td>
    Mengetahui: <br />
    Orang Tua/Wali<br />
    <br />
    <br />
    <br />
    ............................
    </td>
    </tr>
    </table>
</td>
<td valign="top">
    <table align="right">
    <tr><td>
    Tasikmalaya, <?php echo tanggal($dr->tglterimaraport); ?><br />
Wali Kelas <?php echo $row->kdkelas; ?>
<br />
<br />
<br />

<?php echo $walikelas->nama; ?><br />
NIP:
    </td></tr>
    </table>
</td>
</tr>
<tr>
<?php
if(strtolower($this->session->semesterraport)=="genap"){
?>
<td colspan="2" align="center">
    <table>
    <tr>
    <td>
    Mengetahui: <br />
    Kepala Sekolah<br />
    <br />
    <br />
    <br />
    <?php echo strtoupper($dr->kepalasekolah); ?><br />
    NIP:-
    </td>
    </tr>
    </table>
</td>
<?php
}
?>
</tr>
</table>
<?php

?>
</div>
<?php
}
?>
</body>
</html>
