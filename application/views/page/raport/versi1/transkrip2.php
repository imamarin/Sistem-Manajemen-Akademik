<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>


<style>
table#nilai{
border-right:#000000 solid 1px;
border-bottom:#000000 solid 1px;
}

table#nilai tr td, table#nilai tr th{
border:#000000 solid 1px;
border-right:none;
border-bottom:none;
font-family:Arial, Helvetica, sans-serif;"
}
body{
font-family:Arial, Helvetica, sans-serif;
}
</style>
<html>
<head>
<title></title>
</head>
<body>
<?php
$nis="";
$nama="";

foreach($siswa as $row){
$nis=$row->nisn;
$nama=$row->nama
?>
	<div style="page-break-after:always;background-image:url('<?= base_url('assets/images/transkrip2.jpg'); ?>');background-repeat:no-repeat;background-size:100% 100%;margin-top:1%; padding-top:2%; padding-left:4%;padding-bottom:3%; padding-right:3%;">
		<div style="width:98%;">
			<br />
			<center>
			<h3>TRANSKRIP NILAI HASIL BELAJAR</h3>
			<br />
			<br />
			</center>
			<table style="width:100%;font-size:10px;" >
				<tr>
					<td>Nama Sekolah</td><td>: <?php echo $dr->nmsekolah; ?></td><td>Kelas</td><td>: <?php echo $row->kdkelas; ?></td>
				</tr>
				<tr>
					<td>Nama Peserta Didik</td><td>: <?php echo strtoupper($row->nama); ?></td><td>Semester</td><td>: <?php echo $this->session->semesterraport; ?></td>
				</tr>
				<tr>
					<td>No. Induk / NISN</td><td>: <?php echo $row->nisn; ?></td><td>Tahun Ajaran</td><td>: <?php echo $this->session->tahunraport; ?></td>
				</tr>
			</table>
			<center>
			<table  class="table table-bordered table-hover table-striped" cellspacing="0" style="font-size:11px;width:100%;" id="nilai">
				<thead>
					<tr>
						<th rowspan="2" colspan="2" align="center" valign="middle" style="font-weight:bold;">MATA PELAJARAN</th>
						<?php


						$romawi=array('I','II','III','IV','V','VI');
						$a=0;
						for($a=0;$a < count($romawi);$a++){
						?>
						<th colspan="2" align="center" style="font-weight:bold;">SEMESTER <?php echo $romawi[$a]; ?> </th>
						<?php
						}
						?>
						<th align="center" rowspan="1" style="font-weight:bold;">NILAI UJIAN SEKOLAH</th>
					</tr>
					<tr style="font-weight:bold;">
						<?php
						for($a=0;$a < count($romawi);$a++){
						?>
						<th align="center" valign="middle">Peng</th>
						<th align="center" valign="middle">Ketrm</th>
						<?php
						}
						?>
					</tr>
				</thead>
				<tbody>
					<?php
						if(isset($_GET['hal'])){
						$rec=$_GET['hal'];
						}else{
						$rec=0;
						}

						$thn=array();
						$ks=array();
						$tahun=explode("-",$this->session->tahunraport);
						$kelas=explode(" ",$row->kdkelas);
						$z=2;
						for($t=$tahun[0];$t>=$tahun[0]-2;$t--){
						$tt=$t+1;
						$th=$t."/".$tt;

						if($z==0){
							if(isset($kelas[2])){
								$tk="X ".$kelas[1]." ".$kelas[2];
							}else{
								$tk="X ".$kelas[1];	
							}	
						}elseif($z==1){
							if(isset($kelas[2])){
								$tk="XI ".$kelas[1]." ".$kelas[2];
							}else{
								$tk="XI ".$kelas[1];	
							}	
						}elseif($z==2){
							if(isset($kelas[2])){
								$tk="XII ".$kelas[1]." ".$kelas[2];
							}else{
								$tk="XII ".$kelas[1];	
							}	
						}
						$z--;
						array_push($ks, $tk);
						array_push($thn, $th);
						}
						// Load database kedua
						$db2 = $this->load->database('raport_db', TRUE);
						$matpel1="SELECT DISTINCT(kelasmatpel.kdmatpel),matpel.nmmatpel,matpel.kelompok,matpel.id_matpel AS no FROM rapot2.matpel,rapot2.kelasmatpel,rapot2.siswakelas WHERE matpel.kdmatpel=kelasmatpel.kdmatpel AND kelasmatpel.kdkelas=siswakelas.kelas AND siswakelas.nisn='$row->nisn' AND ((kelasmatpel.tahun='$thn[0]' AND kelasmatpel.kdkelas='$ks[0]') OR (kelasmatpel.tahun='$thn[1]' AND kelasmatpel.kdkelas='$ks[1]') OR (kelasmatpel.tahun='$thn[2]' AND kelasmatpel.kdkelas='$ks[2]')) "; 

						$matpel2="SELECT DISTINCT(matpelkelas.kdmatpel),matpel.matpel as nmmatpel,matpel.kelompok,matpel.nourut AS no FROM datamaster.matpel,datamaster.matpelkelas,datamaster.siswakelas,datamaster.settahunajaran WHERE matpel.kdmatpel=matpelkelas.kdmatpel AND matpelkelas.kdkelas=siswakelas.kdkelas AND matpelkelas.idtahunajaran=settahunajaran.idtahunajaran AND siswakelas.idtahunajaran=settahunajaran.idtahunajaran AND siswakelas.nisn='$row->nisn' AND settahunajaran.tahun='$thn[0]' AND matpelkelas.kdkelas='$ks[0]'"; 
						$matpel=$this->db->query("SELECT q.* FROM ($matpel1 UNION $matpel2) AS q ORDER BY q.no asc")->result_array();
						$no=1;
						$dtn=array();
						foreach ($matpel as $key => $dtm) {
							# code...
							?>
							<tr style="height:20px;">
							<td><?php echo $no; ?></td>
							<td><?php echo $dtm['nmmatpel']; ?></td>
							<?php

							$np=0;
							$tp=0;
							$semes=array('ganjil','genap');
							for($c=2;$c>=0;$c--){
                                if($c==0){
                                    $nilai=$this->db->query("SELECT nilairaport.semester, nilairaport.kdmatpel, settahunajaran.tahun ,pengetahuan, keterampilan FROM nilairaport,detailnilairaport,settahunajaran WHERE nilairaport.idnilairaport=detailnilairaport.idnilairaport AND nilairaport.idtahunajaran=settahunajaran.idtahunajaran AND nisn='$row->nisn' AND kdmatpel='$dtm[kdmatpel]' AND tahun='$thn[$c]'");
                                }else{
                                    $nilai=$db2->query("SELECT*FROM nilai WHERE nisn='$row->nisn' AND kdmatpel='$dtm[kdmatpel]' AND tahun='$thn[$c]'");
                                }
                                $hasil = $nilai->num_rows();
                                $queri=$nilai->result();
                                foreach($queri as $dt){
                                    $s=$dt->semester;
                                    $th=$dt->tahun;
                                    $kd=$dt->kdmatpel;
                                    $dtn['pengetahuan'][$kd][$th][$s]=$dt->pengetahuan;
                                    $dtn['keterampilan'][$kd][$th][$s]=$dt->keterampilan;
                                }

								for($b=0;$b<count($semes);$b++){
									
									
									if(empty($dtn['pengetahuan'][$dtm['kdmatpel']][$thn[$c]][$semes[$b]])){
										?>
										<td align="center">-</td>
										<td align="center">-</td> 
										<?php
									}else{
										//
										?>
										<td align="center">
										<?php 
										if($dtn['pengetahuan'][$dtm['kdmatpel']][$thn[$c]][$semes[$b]]>0){
										echo $dtn['pengetahuan'][$dtm['kdmatpel']][$thn[$c]][$semes[$b]];
										$np=$np+$dtn['pengetahuan'][$dtm['kdmatpel']][$thn[$c]][$semes[$b]];
										$tp++;
										}else{
										echo "-";
										}
										?>
										</td>
										<td align="center">
										<?php 
										if($dtn['keterampilan'][$dtm['kdmatpel']][$thn[$c]][$semes[$b]]>0){
										echo $dtn['keterampilan'][$dtm['kdmatpel']][$thn[$c]][$semes[$b]];
										}else{
										echo "-";
										}
										?>
										</td>          
							            <?php
									}

								}
							}

							$ujian=$this->db->query("SELECT detailujian.nilai FROM ujian,detailujian,settahunajaran WHERE ujian.idujian=detailujian.idujian AND ujian.idtahunajaran=settahunajaran.idtahunajaran AND nisn='$row->nisn' AND kdmatpel='$dtm[kdmatpel]' AND ujian.semester='genap' AND tahun='$thn[0]' AND kategori='us'");
							if($ujian->num_rows()<0){
								?>
								<td align="center">-</td>
								<td align="center">-</td> 
								<?php
							}else{
								$dtn2=$ujian->row_array();
								?>
								<td align="center">
									<?php 
								    if($dtn2['nilai']>0){
								    echo $dtn2['nilai'];
								    }else{
										if($np>0){
											$nil_p=$np/$tp;
											echo ceil($nil_p);
										}else{
											echo "-";
										}
								    	
								    }
								    ?>
								</td>
							<?php
						    }
						    ?>
						    </tr>
						    <?php
							$no++;
						}
						for($r=$no;$r<=29;$r++){
							?>
							<tr style="height:20px;">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							</tr>
							<?php
							}
					?>
				</tbody>
			</table>

			<br />
			<table class="table table-bordered table-hover table-striped" cellspacing="0"  id="nilai" style="font-size:11px;width:100%;">
				<tr>
					<th>NO</th>
					<th>LEMBAGA/INDUSTRI YANG MENSERFIKASI</th>
					<th>ALAMAT</th>
					<th>NILAI</th>
				</tr>
				<?php
				$queri=$this->db->query("SELECT*FROM nilaiujikomraport WHERE nisn='$row->nisn'");
				if($queri->num_rows()>0){
					$ujikom=$queri->row_array();
					?>
					<tr>
					<td >1</td>
					<td><?php echo $ujikom['industri']; ?></td>
					<td><?php echo $ujikom['alamat']; ?></td>
					<td><?php echo $ujikom['praktek']; ?></td>
					</tr>	
				<?php
				}else{
					?>
					<tr>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					<td>-</td>
					</tr>
					<?php	
				}

				?>
				</table>
			<br />

			<table class="table table-bordered table-hover table-striped" cellspacing="0"  id="nilai" style="font-size:11px;width:100%;">
				<tr>
					<th>NO</th>
					<th>TEMPAT PRAKERIN</th>
					<th>ALAMAT</th>
					<th>TOTAL JAM PRAKERIN</th>
					<th>NILAI</th>
				</tr>
			<?php
			$queri=$this->db->query("SELECT*FROM prakerinraport WHERE nisn='$row->nisn'");
			if($queri->num_rows()>0){
				$ujikom=$queri->row_array();
				?>
				<tr>
					<td rowspan="1">1</td>
					<td rowspan="1"><?php echo $ujikom['dudi']; ?></td>
					<td rowspan="1"><?php echo $ujikom['alamat']; ?></td>
					<td rowspan="1"><?php echo $ujikom['waktu']; ?> Jam</td>
					<td><?php echo $ujikom['nilai']; ?></td>
				</tr>
			<?php
			}else{
				?>
				<tr>
					<td rowspan="1">-</td>
					<td rowspan="1">-</td>
					<td rowspan="1">-</td>
					<td>-</td>
				</tr>
				<?php	
			}

			?>
			</table>
			<br />
			<table border="0" style="font-size:12px;width:100%;">
			<tr>
			<td align="right">
				<table style="font-size:12px;" align="right">
				<tr>
				<td>
				<?php
    $arrNamaBulan = array("01"=>"Januari", "02"=>"Februari", "03"=>"Maret", "04"=>"April", "05"=>"Mei", "06"=>"Juni", "07"=>"Juli", "08"=>"Agustus", "09"=>"September", "10"=>"Oktober", "11"=>"November", "12"=>"Desember");
    $tgl=explode("-",$dr->tglterimaraport);
    ?>
    Tasikmalaya, <?= $tgl[2]." ".$arrNamaBulan[$tgl[1]]." ".$tgl[0] ?><br />
				Kepala Sekolah<br />
				<br />
				<br />
				<br />
				<br />
				<b><?php echo strtoupper($dr->kepalasekolah); ?></b><br />
				</td>
				</tr>
				</table>
			</td>
			</tr>
			</table>
			
		</div>
	</div>
<?php
}

$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$finish = $time;
$total_time = round(($finish - $start), 4);
echo "Selesai dalam ".$total_time." detik";

?>