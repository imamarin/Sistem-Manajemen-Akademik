<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<style  type="text/css" media="all">
table#nilai,table#ket{
border-right:#000000 solid 1px;
border-bottom:#000000 solid 1px;
z-index : 100;
}

table#nilai tr td, table#nilai tr th{
border:#000000 solid 1px;
border-right:none;
border-bottom:none;
padding: 6px;
}
table#ket tr td, table#ket tr th{
border:#000000 solid 1px;
border-right:none;
border-bottom:none;
padding: 6px;
}
body{
font-size:12px;
}
b{
	z-index: 300;
}

</style>


<?php
function Casef($n){
	$kalimat=explode(" ",$n);
	$kalimatbaru=array();
	foreach($kalimat as $kal){
	$kata1=ucfirst(strtolower($kal));
	$kalimatbaru[]=$kata1;
	}
	
	$newtext=implode(" ",$kalimatbaru);
	return $newtext;
}
?>
</head>
<body>

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
<img src="image/bg.jpeg" style="position: absolute; z-index: 0;" width="700" height="900">

<?php
foreach($siswa as $row){
?>
<div style="z-index: 100;">
<center>

<table style="width:100%;border-bottom:solid 1px #000000; z-index: 200;">
<tr>
<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td><td>Kelas</td><td>: <?php echo $row->kdkelas; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td><td>Semester</td><td>: <?php echo $dr->semester; ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td>Tahun Ajaran</td><td>: <?php echo $dr->tahun; ?></td>
</tr>
</table>

</center><br />
<b>A. Nilai Akademik</b>
<br />
<table style="width:100%;" id="nilai" cellspacing="0">
<thead>
<tr>
<th align="center" style="width:4%;">No</th>
<th valign="middle" align="center" style="84%">MATA PELAJARAN</th>
<th align="center" style="width:3%;">Pengetahuan</th>
<th align="center" style="width:3%;">Keterampilan</th>
<th align="center" style="width:3%;">Nilai Akhir</th>
<th align="center" style="width:3%;">Predikat</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan="6"><b>A. Muatan Nasional</b></td>
</tr>
<?php
$n=1;
$arrmatpel=array();
foreach($matpel_A AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
	<td><?php echo Casef($row1->matpel); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanA=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanA=0;
		$kkm=0; 
	}
	?>
	<td align="center"><?= $pengetahuanA; ?></td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanA=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$keterampilanA=0;
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $keterampilanA; ?></td>
	<td align="center">
	<?php
	if(isset($bp[$row1->kdmatpel]) OR isset($bk[$row1->kdmatpel])){
		$nilbp=$bp[$row1->kdmatpel];
		$nilbk=$bk[$row1->kdmatpel];
	}else{
		$nilbp=0;
		$nilbk=0;
	}
	$nilaiakhir=($pengetahuanA*$nilbp)+($keterampilanA*$nilbk);
	$nilaiakhir=$nilaiakhir/100;
	echo ceil($nilaiakhir);
	?>
	</td>
	<td align="center" >
	<?php
	if($nilaiakhir>=95){
		$predikat="A+";
	}else if($nilaiakhir>=90){
		$predikat="A";
	}else if($nilaiakhir>=85){
		$predikat="A-";
	}else if($nilaiakhir>=80){
		$predikat="B+";
	}else if($nilaiakhir>=75){
		$predikat="B";
	}else if($nilaiakhir>=70){
		$predikat="B-";
		$arrmatpel[]=Casef($row1->matpel);
	}else if($nilaiakhir>=60){
		$predikat="C";
		$arrmatpel[]=Casef($row1->matpel);
	}else{
		$predikat="D";
		$arrmatpel[]=Casef($row1->matpel);
	}
	echo $predikat;
	?>
	</td>
</tr>
<?php
$n++;
}
?>

<tr>
<td colspan="6"><b>B. Muatan Kewilayahan</b></td>
</tr>
<?php
$n=1;
foreach($matpel_B AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
	<td><?php echo Casef($row1->matpel); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanB=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanB=0;
		$kkm=0; 
	}
	?>
	<td align="center"><?= $pengetahuanB; ?></td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanB=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$keterampilan[$row1->kdmatpel][$row->nisn];
	}else{
		$keterampilanB=0; 
		$kkm=0;
	}
	?>
    <td align="center"><?php echo $keterampilanB; ?></td>
	<td align="center">
	<?php
	if(isset($bp[$row1->kdmatpel]) OR isset($bk[$row1->kdmatpel])){
		$nilbp=$bp[$row1->kdmatpel];
		$nilbk=$bk[$row1->kdmatpel];
	}else{
		$nilbp=0;
		$nilbk=0;
	}
	$nilaiakhir=($pengetahuanB*$nilbp)+($keterampilanB*$nilbk);
	$nilaiakhir=$nilaiakhir/100;
	echo ceil($nilaiakhir);
	?>
	</td>
	<td align="center" >
	<?php
	if($nilaiakhir>=95){
		$predikat="A+";
	}else if($nilaiakhir>=90){
		$predikat="A";
	}else if($nilaiakhir>=85){
		$predikat="A-";
	}else if($nilaiakhir>=80){
		$predikat="B+";
	}else if($nilaiakhir>=75){
		$predikat="B";
	}else if($nilaiakhir>=70){
		$predikat="B-";
		$arrmatpel[]=Casef($row1->matpel);
	}else if($nilaiakhir>=60){
		$predikat="C";
		$arrmatpel[]=Casef($row1->matpel);
	}else{
		$predikat="D";
		$arrmatpel[]=Casef($row1->matpel);
	}
	echo $predikat;
	?>
	</td>
</tr>
<?php
$n++;
}
?>


<tr>
<td colspan="6"><b>C. Muatan Peminatan Kejuruan</b></td>
</tr>
<tr>
<td colspan="6"><b>C1. Dasar Bidang Keahlian</b></td>
</tr>
<?php
$n=1;
foreach($matpel_C AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
	<td><?php echo Casef($row1->matpel); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanC=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanC=0; 
		$kkm=0;
	}
	?>
	<td align="center"><?= $pengetahuanC; ?></td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanC=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$keterampilan[$row1->kdmatpel]['kkm'];
	}else{
		$keterampilanC=0;
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $keterampilanC; ?></td>
	<td>
	<?php
	if(isset($bp[$row1->kdmatpel]) OR isset($bk[$row1->kdmatpel])){
		$nilbp=$bp[$row1->kdmatpel];
		$nilbk=$bk[$row1->kdmatpel];
	}else{
		$nilbp=0;
		$nilbk=0;
	}
	$nilaiakhir=($pengetahuanC*$nilbp)+($keterampilanC*$nilbk);
	$nilaiakhir=$nilaiakhir/100;
	echo ceil($nilaiakhir);
	?>
	</td>
	<td align="center" >
	<?php
	if($nilaiakhir>=95){
		$predikat="A+";
	}else if($nilaiakhir>=90){
		$predikat="A";
	}else if($nilaiakhir>=85){
		$predikat="A-";
	}else if($nilaiakhir>=80){
		$predikat="B+";
	}else if($nilaiakhir>=75){
		$predikat="B";
	}else if($nilaiakhir>=70){
		$predikat="B-";
		$arrmatpel[]=Casef($row1->matpel);
	}else if($nilaiakhir>=65){
		$predikat="C";
		$arrmatpel[]=Casef($row1->matpel);
	}else{
		$predikat="D";
		$arrmatpel[]=Casef($row1->matpel);
	}

	echo $predikat;
	?>
	</td>
</tr>
<?php
$n++;
}
?>


<tr>
<td colspan="6"><b>C2. Dasar Program Keahlian</b></td>
</tr>
<?php
$n=1;
foreach($matpel_D AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
	<td><?php echo Casef($row1->matpel); ?></td>
	<?php
	if(isset($pengetahuan[$row1->kdmatpel][$row->nisn])){
		$pengetahuanD=$pengetahuan[$row1->kdmatpel][$row->nisn];
		$kkm=$pengetahuan[$row1->kdmatpel]['kkm'];
	}else{
		$pengetahuanD=0; 
		$kkm=0;
	}
	?>
	<td align="center"><?= $pengetahuanD; ?></td>
	<?php
	if(isset($keterampilan[$row1->kdmatpel][$row->nisn])){
		$keterampilanD=$keterampilan[$row1->kdmatpel][$row->nisn];
		$kkm=$keterampilan[$row1->kdmatpel]['kkm'];
	}else{
		$keterampilanD=0;
		$kkm=0; 
	}
	?>
	<td align="center"><?php echo $keterampilanD; ?></td>
	<td align="center">
	<?php
	if(isset($bp[$row1->kdmatpel]) OR isset($bk[$row1->kdmatpel])){
		$nilbp=$bp[$row1->kdmatpel];
		$nilbk=$bk[$row1->kdmatpel];
	}else{
		$nilbp=0;
		$nilbk=0;
	}
	$nilaiakhir=($pengetahuanD*$nilbp)+($keterampilanD*$nilbk);
	$nilaiakhir=$nilaiakhir/100;
	echo ceil($nilaiakhir);
	?>
	</td>
	<td align="center" >
	<?php
	if($nilaiakhir>=95){
		$predikat="A+";
	}else if($nilaiakhir>=90){
		$predikat="A";
	}else if($nilaiakhir>=85){
		$predikat="A-";
	}else if($nilaiakhir>=80){
		$predikat="B+";
	}else if($nilaiakhir>=75){
		$predikat="B";
	}else if($nilaiakhir>=70){
		$predikat="B-";
		$arrmatpel[]=Casef($row1->matpel);
	}else if($nilaiakhir>=65){
		$predikat="C";
		$arrmatpel[]=Casef($row1->matpel);
	}else{
		$predikat="D";
		$arrmatpel[]=Casef($row1->matpel);
	}

	echo $predikat;
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
<br>
<b>B. Catatan Akademik</b>
<table id="nilai" style="width:100%;height:100px;">
	<tr>
		<td valign="top">
			<label>
				Ananda perlu meningkatkan kompetensi pengetahuan dan keterampilan pada mata pelajaran <?= implode(", ",$arrmatpel) ?> sebagai 
				bekal pembelajaran kompetensi kejuruan di tingkat berikutnya.
			</label>
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

<table style="width:100%;border-bottom:solid 1px #000000;z-index:100;" >
<tr>
<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td><td>Kelas</td><td>: <?php echo $row->kdkelas; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td><td>Semester</td><td>: <?php echo $dr->semester; ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td>Tahun Ajaran</td><td>: <?php echo $dr->tahun; ?></td>
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
<table style="width:100%;" id="nilai" cellspacing="0">
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
<b>E. Ketidakhadiran</b>
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
<br />

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

<table style="width:100%;z-index:200" border="0">
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
if(strtolower($this->session->semesterraport)=="ganjil"){
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
