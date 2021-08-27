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
	}
</style>
<table border=0 cellspacing="0" align="center" width="705px">
	<tr>
		<td><img src="<?= base_url() ?>assets/images/header.jpg" width="705px" height="100px"></td>
	</tr>
	<tr valign="top">
		<td>
			<table border=0 width="705px" style="font-family:calibri; margin-top: -10px">
				<tr>
					<td colspan="6" align="center">
						<h2>DAFTAR HADIR SISWA</h2>
					</td>
				</tr>
				<tr valign="bottom">
					<td><b>Bidang Kehlian</b></td>
					<td>:</td>
					<td><?= $kelas->bidang ?></td>
					<td><b>KELAS</b></td>
					<td>:</td>
					<td><font size="5"><?= $kelas->kdkelas ?></font></td>
				</tr>
				<tr>
					<td><b>Program Kehlian</b></td>
					<td>:</td>
					<td><?= $kelas->program ?></td>
					<td><b>TH. Pelajaran</b></td>
					<td>:</td>
					<td><?= $tahun ?> <b>Semester</b>: <?= $semester?></td>
				</tr>
				<tr>
					<td><b>Kompetensi Kehlian</b></td>
					<td>:</td>
					<td><?= $kelas->kompetensi ?></td>
					<td><b>Mata Pelajaran</b></td>
					<td>:</td>
					<td>______________________</td>
				</tr>
			</table>

			<table class="table" width="705px" style="font-family:calibri;">
				<tr>
					<th rowspan="3" width="20px">NO</th>
					<th rowspan="3">NISN</th>
					<th rowspan="3">NAMA SISWA</th>
					<th rowspan="3" width="20px">L/P</th>
					<th colspan="14">TANGGAL</th>
					<th rowspan="3">KET</th>
				</tr>
				<tr>
					<?php
					for ($i=0; $i < 14; $i++) { 
						# code...
						echo "<th height='40px' width='20px'></th>";
					}
					?>
				</tr>
				<tr>
					<?php
					for ($i=1; $i <= 14; $i++) { 
						# code...
						echo "<th> $i </th>";
					}
					?>
				</tr>
				<?php
				for ($i=1; $i <=36 ; $i++) { 
					$ada=0;
					?>
					<tr height="20px">
					<?php
					foreach ($siswa as $key => $v) {
						# code.
						if($i==$key+1){
							?>
							
								<td align="center"><?= $i ?></td>
								<td align="center"><?= $v->nisn ?></td>
								<td>&nbsp;&nbsp;<?= $v->nama ?></td>
								<td align="center"><?= $v->jk ?></td>
								<?php
								for ($a=1; $a <= 14; $a++) { 
									# code...
									echo "<td></td>";
								}
								?>
								<td></td>
							</tr>
							<?php
							$ada=1;
							break;
						}
							
						
						
					}
					if($ada==0){
						?>

								<td><?= $i ?></td>
								<td></td>
								<td></td>
								<td></td>
								<?php
								for ($a=1; $a <= 14; $a++) { 
									# code...
									echo "<td></td>";
								}
								?>
								<td></td>
							</tr>
							<?php
					}
				}
				?>
				
			</table>
		</td>
	</tr>
	<tr>
		<table width="705px" align="center" height="200px">
			<tr>
				<td colspan="5" align="right">
					Tasikmalaya,......................20....
				</td>
			</tr>
			<tr>
				<td>
					<div>
						_________________________<br>NIP
					</div>
				</td>
				<td></td>
				<td>
					<div>
						_________________________<br>NIP
					</div>
				</td>
				<td></td>
				<td>
					<div>
						_________________________<br>NIP
					</div>
				</td>
				<td></td>
			</tr>
		</table>
	</tr>
</table>
</body>
</html>
<script type="text/javascript">
	window.print();
</script>