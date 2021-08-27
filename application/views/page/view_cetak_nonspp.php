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
?>
<table cellspacing="0" align="center" width="705px">
	<tr>
		<th colspan=3>TRANSAKSI PEMBAYARAN NON SPP<br><br></th>
	</tr>
    <tr>
        <td width="100px">Tanggal</td><td>:</td><td><?= date('d-m-Y',strtotime($tanggal)) ?></td>
    </tr>
    <tr>
        <td>NISN</td><td>:</td><td><?= $siswa->nisn ?></td>
    </tr>
    <tr>
        <td>Nama Siswa</td><td>:</td><td><?= $siswa->nama ?></td>
    </tr>
	<tr valign="top">
        <td colspan=3>
        <br>
		<table class="table" width="705px">
			<tr>
				<th>NO</th>
				<th>JENIS KEUANGAN</th>
				<th>BAYAR</th>

			</tr>
            <?php
            $no=1;
            $tobay=0;
            foreach($transaksi as $v){
            ?>
			<tr>
				<td><?= $no ?></td>
				<td><?= $v->nama ?></td>
				<td><?= "Rp. ".number_format($v->bayar,0,'','.'); ?></td>

			</tr>
            <?php
            $tobay = $tobay+$v->bayar;
            $no++;
            }
            ?>
            <tr>
                <td colspan=2 align="center">
                    <b>TOTAL BAYAR</b>
                </td>
                <td><?= "Rp. ".number_format($tobay,0,'','.'); ?></td>
            </tr>
		</table>
        </td>
	</tr>
    <tr>
        <td align="right" colspan=3>
        <br>
        Tasikmalaya, <?= date('d-m-Y',strtotime($tanggal) )?>
        <br>
        <br>
        <br>
        <br>
        <?= strtoupper($this->session->nama) ?>
        </td>
    </tr>
</table>
</body>
</html>
<script type="text/javascript">
	window.print();
</script>