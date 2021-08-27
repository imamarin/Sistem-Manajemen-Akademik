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
<?php
function tgl_indo($tanggal){
	$bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
	$pecahkan = explode('-', $tanggal);
	
	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun
 
	return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}


?>
<table border=0 cellspacing="0" align="center" width="1100px" style="font-family:Times New Roman;font-size:x-large">
	<tr>
		<td><img src="<?= base_url() ?>assets/images/header1.jpg" width="1070px" height="150px"></td>
	</tr>
	<tr valign="top">
		<td>
			<table align="center" border=0 width="900px" style="font-family:Times New Roman; margin-top: -10px;font-size:x-large">
				<tr>
					<td align="Left" width="900px">
					<br>
						<table width="900px" style="font-size:x-large">
                            <tr>
                                <td>Nomor</td><td>: 005/421.5-SMK.YPC/I/2021</td>
								<td align="right" valign="top" width="300">
									Tasikmalaya, <?= tgl_indo(date('Y-m-d')) ?>
								</td>
							</tr>
							<tr>
                                <td>Lampiran</td><td>: 1 Lembar</td>
							</tr>
							<tr>
                                <td>Perihal</td><td><b><u>Permohonan Praktik Kerja Industri</u></b></td>
							</tr>
							<tr>
                                <td valign="top">Kepada</td>
                                <td>
                                    : Yth. Pimpinan Perusahaan/Industri/Lembaga:<br>
                                    <b><?= $ajuan->nmperusahaan ?></b><br>
                                    di <br>
                                    <?= $ajuan->alamat ?>
                                
                                </td>
                            </tr>
                        </table>
					</td>

				</tr>
				<tr>
					<td><b><i><br><br>Bismillaahirrahmaanirrahiim<br>
						Assalaamu’alaikum Wr. Wb.</i></b>
					</td>
				</tr>
				<tr>
					<td>
						<p style="text-indent: 45px;" align="justify">Dalam rangka meningkatkan mutu kompetensi serta membentuk etos kerja di industri maka 
								dengan ini kami sampaikan permohonan melaksanakan Praktek Kerja Lapangan (PKL) di 
								perusahaan yang Bapak/Ibu Pimpin.</p>
						<p style="text-indent: 45px;" align="justify">
								Untuk merealisasikan program tersebut, kami mohon bantuan Bapak/Ibu memberikan 
								kesempatan kepada para siswa kami untuk melaksanakan Praktik Kerja Industri dengan bahan 
								pertimbangan sebagai berikut :
						</p>
						<p>
							<ol type="a">
								<li>Waktu pelaksanaan mulai 26 Juli 2021 sampai dengan  16 Oktober 2021 </li>
								<li>Bidang keahlian :
									<ol type="1">
										<li>    
												Program Studi Keahlian 	: Teknik Elektronika<br>
												<b>Kompetensi Keahlian	: Teknik Elektronika Industri (TEKLIN)</b>
										</li>
										<li>    
												Program Studi Keahlian 	: Teknik Otomotif<br>
												<b>Kompetensi Keahlian	: Teknik Kendaraan Ringan Otomotif (TKRO)</b>
										</li>
										<li>    
												Program Studi Keahlian 	: Teknik Otomotif<br>
												<b>Kompetensi Keahlian	: Teknik dan Bisnis Sepeda Motor (TBSM)</b>
										</li>
										<li>    
												Program Studi Keahlian 	: Teknik Konstruksi dan Properti<br>
												<b>Kompetensi Keahlian	: Desain Permodelan dan Informasi Bangunan (DPIB)</b>
										</li>
										<li>    
												Program Studi Keahlian 	: Teknik Komputer Dan Informatika<br>
												<b>Kompetensi Keahlian	: Rekayasa Perangkat Lunak (RPL)</b>
										</li>
										<li>    
												Program Studi Keahlian 	: Teknik Komputer Dan Informatika<br>
												<b>Kompetensi Keahlian	: Teknik Komputer Jaringan (TKJ)</b>
										</li>
										<li>    
												Program Studi Keahlian 	: Teknik Komputer Dan Informatika<br>
												<b>Kompetensi Keahlian	: Multimedia (MM)</b>
										</li>
									</ol>
								</li>
							</ol>
						</p>
						<p>
								Demikian atas kerjasama dan bantuan Bapak/Ibu/Sdr kami ucapkan terima kasih.
						</p>
					</td>
				</tr>
				<tr>
					<td><b><i>Wassalaamu’alaikum Wr. Wb.</i></b></td>
				</tr>
				<tr>
					<td align="right">
						<table>
							<tr>
								<td><b>Kepala SMK YPC Tasikmalaya</b></td>
							</tr>
							<tr>
								<td>
									<img src="<?= base_url('image/ttd.png') ?>" height="150px">
								</td>
							</tr>
							<tr>
								<td><b><u>Drs. UJANG SANUSI, M.M</u></b></td>
							</tr>
						</table>
					<td>

				</tr>
			</table>
		</td>
	</tr>
	


</table>

<!-- HALAMAN 2 -->
<table border=0 cellspacing="0" align="center" width="1100px" style="font-family:Times New Roman;font-size:x-large;page-break-before: always;">
	<tr>
		<td><img src="<?= base_url() ?>assets/images/header1.jpg" width="1070px" height="150px"></td>
	</tr>
	<tr valign="top">
		<td>
			<table align="center" border=0 width="900px" style="font-family:Times New Roman; margin-top: -10px;font-size:x-large">
				<tr>
					<td align="center" width="900px">
						<h2>DAFTAR CALON PESERTA</h2>
						<h3 style="margin-top:-20px">PRAKTIK KERJA INDUSTRI</h3>
						<h3 style="margin-top:-20px"><u><?= $ajuan->nmperusahaan ?></u></h3>
						<h4 style="margin-top:-20px">TAHUN PELAJARAN 2021/2022</h4>
					</td>

				</tr>
				<tr>
					<td><br>
						<table class="table" width="900px">
							<tr>
								<th>NO</th>
								<th>NAMA SISWA</th>
								<th>NISN</th>
								<th>L/P</th>
								<th>KETERANGAN</th>
							</tr>
							<?php
							$no=1;
							foreach($siswa as $v){
								?>
							<tr>
								<td><?=  $no ?></td>
								<td><?= strtoupper($v->nama) ?></td>
								<td><?= $v->nisn ?></td>
								<td><?= $v->jk ?></td>
								<?php
								if($no==1){
									?>
									<td rowspan="<?= $jmlsiswa ?>">
										<p>Program Studi Keahlian:<br>
										<?= $v->program ?>
										</p>

										<p>Kompetensi Keahlian:<br>
										<b><?= $v->kompetensi ?></b>
										</p>
									</td>
									<?php
								}
								?>
							</tr>
							<?php
							$no++;
							}
							?>
						</table>
					</td>
				</tr>
				
				<tr>
					<td><br>Guna melaksanakan Praktik Kerja Industri (Prakerin) di:
					<br></td>
				</tr>
				<tr>
					<td><br>
						<table>
							<tr>
								<td>Perusahaan/Industri/Lembaga</td><td>: <?= $ajuan->nmperusahaan ?></td>
							</tr>
							<tr>
								<td>Alamat</td><td>: <?= $ajuan->alamat ?></td>
							</tr>
						</table>
						<br>
					</td>
				</tr>
				<tr>
					<td align="right">
					<br>
						<table>
							<tr>
								<td>Tasikmalaya, <?= tgl_indo(date('Y-m-d')) ?><br>Kepala SMK YPC Tasikmalaya</td>
							</tr>
							<tr>
								<td>
									<img src="<?= base_url('image/ttd.png') ?>" height="150px">
								</td>
							</tr>
							<tr>
								<td><b><u>Drs. UJANG SANUSI, M.M</u></b></td>
							</tr>
						</table>
					<td>

				</tr>
				
			</table>
		</td>
	</tr>
	

</table>

<table border=0 cellspacing="0" align="center" width="1100px" style="font-family:Times New Roman;font-size:x-large;page-break-before: always;">
	<tr>
		<td><img src="<?= base_url() ?>assets/images/header1.jpg" width="1070px" height="150px"></td>
	</tr>
	<tr valign="top">
		<td>
			<table align="center" border=0 width="900px" style="font-family:Times New Roman; margin-top: -10px;font-size:x-large">
				<tr>
					<td align="left" width="900px">
					<br>
						<table width="900px" style="font-size:x-large">
							<tr>
                                <td><b>Hal: Surat Balasan Permohonan Tempat Prakerin</b></td>
							</tr>
							<tr>
								<td>
								Kepada Yth:<br>
								<b>Kepala SMK YPC Tasikmalaya</b><br>
								di<br>
								SMK YPC Tasikmalaya <br>

								</td>
							</tr>
						</table>
					</td>

				</tr>
				<tr>
					<td align="justify">
					<br><br>
					Dengan hormat,<br>
					Berdasarkan surat permohonan tempat praktik kerja industri yang kami terima 005/421.5-SMK.YPC/I/2021, 
					maka dengan ini kami sampaikan bahwa kami atas nama Perusahaan/Lembaga/Intansi <b><?= $ajuan->nmperusahaan ?></b> 
					dengan ini menyatakan: <b>MENERIMA / MENOLAK</b> siswa untuk melaksanakan praktik kerja industri di tempat kami.
					<br>Adapun alasan / catatan khusus kami bahwa : .....................................................................................   ................................................................................................................................................................
					<br>
					Siswa yang dapat kami terima adalah:	
					</td>
				</tr>
				
				<tr>
					<td>
						<table class="table" width="900px">
							<tr>
								<th>NO</th>
								<th>NAMA SISWA</th>
								<th>NISN</th>
								<th>KOMPETENSI KEAHLIAN</th>
							</tr>
							<tr>
							<?php
							$no=1;
							foreach($siswa as $v){
								?>
							<tr>
								<td><?=  $no ?></td>
								<td><?= strtoupper($v->nama) ?></td>
								<td><?= $v->nisn ?></td>
								<td><?= $v->kompetensi ?></td>
							</tr>
							<?php
							$no++;
							}
							?>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td><br>
					Demikian surat balasan ini kami sampaikan, untuk menjadi tahu adanya.
					</td>
				</tr>
				<tr>
					<td align="right">
						<table>
							<tr>
								<td>Tasikmalaya, <?= tgl_indo(date('Y-m-d')) ?><br> <br> Hormat Kami</td>
							</tr>
							<tr>
								<td>
									<br><br><br>
								</td>
							</tr>
							<tr>
								<td><b><u>.........................................</u></b></td>
							</tr>
						</table>
					<td>

				</tr>
				<tr>
					<td>(Nama & Cap Perusahaan/lembaga/Instansi)</td>
				</tr>

				<tr>
					<td width="1000px">
					<br>
						<table align="left" width="1000px" cellpadding=15 border=0>
							<tr>
								<td align="center" colspan=2><u><b>Identitas Perusahaan</b></u></td>
							</tr>
							<tr>
								<td width="380px">Nama Perusahaaan/lembaga/Instansi</td><td>:........................................................................................</td>
							</tr>
							<tr>
								<td>Nama Pimpinan </td><td>:........................................................................................</td>
							</tr>
							<tr>
								<td>Alamat Perusahaan/lembaga/instansi</td><td>:........................................................................................
								</td>
							</tr>
							<tr>
								<td></td><td>:........................................................................................
								</td>
							</tr>
							<tr>
								<td>No. Telp/Hp </td><td>:........................................................................................</td>
							</tr>
						</table>
					</td>


				</tr>
				
			</table>
		</td>
	</tr>
	

</table>
</body>
</html>
<script type="text/javascript">
	window.print();
</script>