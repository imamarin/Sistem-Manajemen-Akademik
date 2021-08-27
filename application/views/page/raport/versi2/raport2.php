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
<b>C. Praktik Kerja Lapangan</b>
<br />
<table style="width:100%;" id="nilai" cellspacing="0">
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
<td><?php echo isset($prakerin[$row->nisn]['nilai'])?$prakerin[$row->nisn]['nilai']:"-"; ?></td>
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

if($this->session->semesterraport=="genap" && isset($kenaikan[$row->nisn])){
	?>

	<br>
	<b>F. Kenaikan Kelas</b>
	<table id="nilai" style="width:100%;">
		<tr>
			<td>
				<?php
	
				if($kenaikan[$row->nisn]['nilai']==1){
					if(strtolower($kls[0])=="x"){
					?>
					Naik ke kelas XI ( Sebelas )<br />
					<?php
					}else if(strtolower($kls[0])=="xi"){
					?>
					Naik ke kelas XII ( Dua belas )<br />
					<?php
					}
					?>
				<?php
				}else{
					if(strtolower($kls[0])=="x"){
					?>
					Tinggal di kelas X ( Sepuluh )<br />
					<?php
					}else if(strtolower($kls[0])=="xi"){
					?>
					Tinggal di kelas XI ( Sebelas )<br />
					<?php
					}
				}
				?>
			</td>
		</tr>
	</table>
	</div>
	<br />
	<br />
	
	<br />
	<br />
	<?php
	
    }
}
?>

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
