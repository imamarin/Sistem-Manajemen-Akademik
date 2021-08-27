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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<script>
window.print();
</script>
<body>
<?php
foreach($siswa as $row){
?>
<center>
<div align="center" style="page-break-before:always;">
<font size="+2" face="Times New Roman" ><b>
<p style="line-​height: 3;">RAPOR PESERTA DIDIK<br>
SEKOLAH MENENGAH KEJURUAN<br />
(SMK)
</p>
</b>
</font>
<br />
<br />
<br />
<br />
<img src="<?= base_url().'assets/images/tutwuri.JPG' ?>" />
<br />
<br />
<br />
<br />
<font size="+2" face="Times New Roman"><b>Nama Peserta Didik</b></font>
<div style="border:#000000 solid 1px;width:50%;">
<font size="+2" face="Times New Roman"><?php echo Casef($row->nama); ?></font>
</div>
<br />
<br />
<font size="+2" face="Times New Roman"><b>NISN</b></font>
<div style="border:#000000 solid 1px;width:50%;">
<font size="+2" face="Times New Roman"><?php echo $row->nisn; ?></font>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<font size="+2" face="Times New Roman"><b>
KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN	<br />								
REPUBLIK INDONESIA</b>									
</font>
</div>

<!----- identitas sekolah-->
<div align="center" style="page-break-before:always;">
<font size="+2" face="Times New Roman" ><b>
<p style="line-​height: 3;">RAPOR PESERTA DIDIK<br>
SEKOLAH MENENGAH KEJURUAN<br />
(SMK)
</p>
</b>
</font>
<br />
<br />
<font size="+1" face="Times New Roman">
<table cellpadding="15" style="width:100%;">
<tr>
<td>Nama Sekolah</td><td>: SMK YPC Tasikmalaya</td>
</tr>
<tr>
<td>NPSN / NSS</td><td>: 20210704</td>
</tr>
<tr>
<td valign="top">Alamat Sekolah</td><td>: Komplek Pesantren Cintawana<br /> &nbsp;&nbsp;Singaparna -  Tasikmalaya <br /> &nbsp;&nbsp;Kode Pos  : 46414, Telp : (0265)546717</td>
</tr>
<tr>
<td>Kelurahan</td><td>: Cikunten</td>
</tr>
<tr>
<td>Kecamatan</td><td>: Singaparna</td>
</tr>
<tr>
<td>Kabupaten</td><td>: Tasikmalaya</td>
</tr>
<tr>
<td>Provinsi</td><td>: Jawa Barat</td>
</tr>
<tr>
<td>Website</td><td>: www.smk-ypc.sch.id</td>
</tr>
<tr>
<td>Email</td><td>: smkypctasikmalaya@gmail.com</td>
</tr>
</table>
</font>
</div>
<!----- identitas siswa-->
<div align="center" style="page-break-before:always;">
<font size="+2" face="Times New Roman" ><b>
<p style="line-​height: 3;">KETERANGAN TENTANG DIRI PESERTA DIDIK
</p>
</b>
</font>
<br />
<br />
<font size="3" face="Times New Roman">
<table cellpadding="5" style="width:100%;">
<tr>
<td>1.</td><td style="width:40%;">Nama Peserta Didik (Lengkap)</td><td>: <?php echo $row->nama; ?></td>
</tr>
<tr>
<td>2.</td><td>Nomor Indik Siswa Nasional</td><td>: <?php echo $row->nisn; ?></td>
</tr>
<tr>
<?php
$lhr=date("d-m-Y",strtotime($row->tgl_lahir));
?>
<td>3.</td><td>Tempat Tanggal Lahir</td><td>: <?php echo $row->tmp_lahir.", ".$lhr; ?></td>
</tr>
<tr>
<td>4.</td><td>Jenis Kelamin</td><td>: <?php echo $row->jk=="L"?"Laki-Laki":"Perempuan"; ?></td>
</tr>
<tr>
<td>5.</td><td>Agama</td><td>: <?php echo isset($row->agama)?$row->agama:"-"; ?></td>
</tr>
<tr>
<td>6.</td><td>Status dalam Keluarga</td><td>: <?php echo isset($row->statuskeluarga)?$row->statuskeluarga:"-"; ?></td>
</tr>
<tr>
<td>7.</td><td>Anak ke</td><td>: <?php echo isset($row->anakke)?$row->anakke:"-"; ?></td>
</tr>
<tr>
<td>8.</td><td>Alamat Peserta Didik</td><td>: <?php echo isset($row->alamat_siswa)?$row->alamat_siswa:"-"; ?></td>
</tr>
<tr>
<td>9.</td><td>Nomor Telepon Rumah</td><td>: <?php echo $row->hp_siswa; ?></td>
</tr>
<tr>
<td>10.</td><td>Sekolah Asal</td><td>: <?php echo $row->asal_sekolah; ?></td>
</tr>
<tr>
<td>11.</td><td>Diterima di sekolah ini</td><td></td>
</tr>
<tr>
<td></td><td>Di Kelas</td><td>: <?php echo isset($row->kdkelas)?$row->kdkelas:"-"; ?></td>
</tr>
<tr>
<td></td><td>Pada Tanggal</td><td>: <?php echo date("d-m-Y",strtotime($row->tgl_terima)); ?></td>
</tr>
<tr>
<td>12.</td><td>Nama Orang Tua</td><td></td>
</tr>
<tr>
<td></td><td>a. Ayah</td><td>: <?php echo $row->nm_ayah; ?></td>
</tr>
<tr>
<td></td><td>b. Ibu</td><td>: <?php echo $row->nm_ibu; ?></td>
</tr>
<tr>
<td>13.</td><td valign="top">Alamat Orang Tua</td><td>: <?php echo $row->alamat_orangtua; ?></td>
</tr>
<tr>
<td>14.</td><td valign="top">No Tlp/HP Orang Tua</td><td>: <?php echo $row->hp_orangtua; ?></td>
</tr>
<tr>
<td>15.</td><td>Pekerjaan Orang Tua</td><td></td>
</tr>
<tr>
<td></td><td>a. Ayah</td><td>:  <?php echo $row->pek_ayah; ?></td>
</tr>
<tr>
<td></td><td>b. Ibu</td><td>:  <?php echo $row->pek_ibu; ?></td>
</tr>
<tr>
<td>16.</td><td>Nama Wali Peserta Didik</td><td>: <?php echo isset($row->walisiswa)?$row->walisiswa:"-"; ?></td>
</tr>
<tr>
<td>17.</td><td>Alamat Wali Peserta Didik</td><td>: <?php echo isset($row->alamatwali)?$row->alamatwali:"-"; ?></td>
</tr>
<tr>
<td>18.</td><td>Nomor Telepon Rumah / Hp</td><td>: <?php echo isset($row->nohpwali)?$row->nohpwali:"-"; ?></td>
</tr>
<tr>
<td>19.</td><td>Pekerja Wali Peserta Didik</td><td>: <?php echo isset($row->pekwali)?$row->pekwali:"-"; ?></td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td colspan="2" valign="top">
<?php if(isset($row->foto)){ ?>
<br />
<img src="foto/<?php echo $data['foto']; ?>" width="100" height="120"/>
<?php } ?>
</td>
<td valign="top">
    <table align="right">
    <tr>
    <td valign="top">
    <?php
    $arrNamaBulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
    $tgl=explode("-",$dr->tglterimaraport);
    ?>
    Tasikmalaya, <?= $tgl[2]." ".$arrNamaBulan[$tgl[1]]." ".$tgl[0] ?><br />
    Kepala Sekolah
    <br />
    <br />
    <br />
    <br />
    DRS. UJANG SANUSI, MM<br />
    NIP: 1968199704003
    </td>
    </tr>
    </table>
</td>
</tr>
</table>
</font>
</center>
<?php
}

?>
</div>
</body>
</html>
