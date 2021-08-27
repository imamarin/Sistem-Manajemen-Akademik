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
</style>

<style type="text/css" media="print">

</style>
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
<?php
if($this->session->semesterraport=="genap"){
?>
<b>G. Deskripsi Perkembangan Karakter</b>
<?php
}else{
?>
<b>F. Deskripsi Perkembangan Karakter</b>
<?php
}
?>

<br />
<table style="width:100%;" id="nilai" cellspacing="0">
<thead>
<tr>
<th valign="middle" align="center">Karakter yang dibangun</th>
<th align="center">Deskripsi</th>
</tr>
</thead>
<tbody>

<tr>
<td>Integritas</td>
<td>Ananda memiliki pola kehidupan kemasyarakatan yang tinggi di lingkungan sekolah</td>
</tr>
<tr>
<td>Religius</td>
<td>Ananda menunjukkan ketakwaan pada agama yang dianut dan toleran pada penganut agama yang berbeda</td>
</tr>
<tr>
<td>Nasionalis</td>
<td>Ananda aktif dalam kegiatan Paskibra di Sekolah</td>
</tr>
<tr>
<td>Mandiri</td>
<td>Ananda sering membantu temannya di lingkungan sekolah</td>
</tr>
<tr>
<td>Gotong-royong</td>
<td>Ananda menunjukkan sikap gotong-royong sebagai relawan dalam kegiatan bakti sosial di panti werdha Cahaya Senja</td>
</tr>


</tbody>
</table>
<br>
<?php
if($this->session->semesterraport=="genap"){
?>
<b>H. Catatan Perkembangan Karakter</b>
<?php
}else{
?>
<b>G. Catatan Perkembangan Karakter</b>
<?php
}
?>

<table id="nilai" style="width:100%;height:100px;">
	<tr>
		<td></td>
	</tr>
</table>
</div>




<table style="width:100%;" border="0">
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
	<?php
    $arrNamaBulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
    $tgl=explode("-",$dr->tglterimaraport);
    ?>
    Tasikmalaya, <?= $tgl[2]." ".$arrNamaBulan[$tgl[1]]." ".$tgl[0] ?><br />
Wali Kelas <?php echo $row->kdkelas; ?>
<br />
<br />
<br />

<u><?php echo $walikelas->nama; ?></u><br />
NIP:<?php echo $walikelas->kdguru; ?>
    </td></tr>
    </table>
</td>
</tr>
<tr>

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
    NIP:1968199704003
    </td>
    </tr>
    </table>
</td>

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
