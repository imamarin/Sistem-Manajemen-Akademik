<style type="text/css">
	.table {
		border-collapse: collapse;
	}
 
	.table, .table th, .table td {
		border: 1px solid black;
        padding-left: 5px;
	}
</style>   
<center><h2>REKAP ABSENSI HARIAN SISWA<br>KELAS <?= strtoupper($kls) ?></h2></center>
                <table class="table" style="width:100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>NIS/NISN</th>
                      <th>Nama</th>
                      <th>Hadir</th>
                      <th>Sakit</th>
                      <th>Izin</th>
                      <th>Alfa</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($siswa as $b) {
                    ?>
                    <tr style="">
                      <td>
                        <?= $no ?>
                      </td>
                        
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo strtoupper($b->nama); ?></td>
                      <td><?php echo $b->hadir; ?></td>
                      <td><?php echo $b->sakit; ?></td>
                      <td><?php echo $b->izin; ?></td>
                      <td><?php echo $b->alfa; ?></td>
                    </tr>
                    <?php
                    $no++;
                    } ?>
                </tbody>
              </table>
<script>
window.print();
</script>