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
<h3>KETERANGAN PINDAH SEKOLAH</h3>
<table style="width:100%;border-bottom:solid 1px #000000;" >
<tr>
<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td>
</tr>
<tr>
<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td>
</tr>
<tr>
<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td>
</tr>
</table>
<br>
<table border="1" cellspacing="0"  class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
        <th colspan="4" align="center" height="40">KELUAR</th>
        </tr>
        <tr>
            <th align="center" width="100">Tanggal</th>
            <th align="center" width="150"> Kelas yang Ditinggalkan</th>
            <th align="center">Sebab-sebab keluar atau Atas Permintaaan Tertulis</th>
            <th align="center">Tanda Tangan Kepala Sekolah, Stempel Sekolah, dan Tanda Tangan Orang Tua/Wali</th>
        </tr>
    </thead>
    <tbody style="overflow:auto;">
    <?php
    $arrNamaBulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
    $tgl=explode("-",$dr->tglterimaraport);
    ?>
        <tr>
            <td valign="top" align="center" style="vertical-align: middle;"><?= $tgl[2]." ".$arrNamaBulan[$tgl[1]]." ".$tgl[0] ?></td>
            <td valign="top" align="center" style="vertical-align: middle;"><?php echo $row->kdkelas; ?></td>
            <td valign="top" align="center" style="vertical-align: middle;"><?php echo "LULUS"; ?></td>
            <td valign="top" style="padding-top:30px;padding-left:30px;padding-bottom:30px;">
            
    Tasikmalaya, <?= $tgl[2]." ".$arrNamaBulan[$tgl[1]]." ".$tgl[0] ?> <br />
            Kepala Sekolah<br />
                <br />
                <br />
                <br />
                <b>   <u> <?php echo strtoupper($dr->kepalasekolah); ?></u></b><br />
    NIP:1968199704003<br /><br /><br />
            Orang Tua/Wali,
                <br />
                <br />
                <br />
                ________________________<br />
            </td>
        </tr>
    </tbody>
</table>
</div>
<?php
}
?>
</body>
</html>
