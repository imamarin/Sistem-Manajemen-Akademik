<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Raport 1</title>
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
}

</style>
</head>
<body>

<?php
$nis="";
$nama="";

foreach($siswa as $row){
$nis=$row->nisn;
$nama=$row->nama
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
<center><b>CAPAIAN HASIL BELAJAR</b></center>
<br />
<br />
<b>A. SIKAP</b>
<b>&nbsp;&nbsp;</b> 
<table style="width:98%;height:200px;margin-left:2%;" id="nilai" cellspacing="0">
<thead>
<tr>
<th align="center">Predikat</th>
<th align="center">Deskripsi</th>
</tr>
</thead>
<tbody>
<td align="center" style="width:30%;">
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
