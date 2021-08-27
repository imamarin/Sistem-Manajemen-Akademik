<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
window.print();
</script>
<style>
table#nilai,table#ket{
border-right:#000000 solid 1px;
border-bottom:#000000 solid 1px;
}

table#nilai tr td, table#nilai tr th{
border:#000000 solid 1px;
border-right:none;
border-bottom:none;
padding:8px;
}
table#ket tr td, table#ket tr th{
border:#000000 solid 1px;
border-right:none;
border-bottom:none;
}
body{
font-size:12px;
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

foreach($siswa as $row){
?>
<div style="page-break-before:always;">
<center>
<h3 style="display:none;">LAPORAN HASIL PENILAIAN AKHIR SEMESTER <?php echo strtoupper($this->session->semesterraport); ?></h3>
<table style="width:100%;border-bottom:solid 1px #000000;" >
<tr>
<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td><td>Kelas</td><td>: <?php echo $row->kdkelas; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo casef($row->nama); ?></td><td>Tahun Ajaran</td><td>: <?php echo $this->session->tahunraport; ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td></td><td></td>
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
</body>
</html>
