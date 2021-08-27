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

<style type="text/css" media="print">

</style>
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
<td>Alamat</td><td>: -</td><td>Semester</td><td>: <?php echo $this->session->semesterraport; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td><td>Tahun Ajaran</td><td>: <?php echo $this->session->tahunraport; ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td></td><td></td>
</tr>
</table>

</center><br />
<b>B. Pengetahuan dan Keterampilan</b>
<br />
<table style="width:100%;" id="nilai" cellspacing="0">
<thead>
<tr>
<th colspan="2" rowspan="2" valign="middle" align="center" style="width:20%;">MATA PELAJARAN</th>
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
<td colspan="10"><b>Muatan Nasional</b></td>
</tr>
<?php
$n=1;
foreach($matpel_A AS $row1){
?>
<tr>
	<td align="center" style="width:3%;"><?php echo $n; ?></td>
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
<td colspan="10"><b>Muatan Kewilayahan</b></td>
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
		$kkm=$keterampilan[$row1->kdmatpel]['kkm'];
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
<td colspan="10"><b>Dasar Bidang Keahlian</b></td>
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
<td colspan="10"><b>Dasar Program Keahlian</b></td>
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
</body>
</html>
