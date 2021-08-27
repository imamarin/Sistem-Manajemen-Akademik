
<style type="text/css">
	.table {
		border-collapse: collapse;
	}
 
	.table, .table th, .table td {
		border: 1px solid black;
        padding-left: 5px;
	}
</style>
<center><h2>LAPORAN TRANSAKSI KEUANGAN SISWA<br><?= $tgl1 ?> s/d <?= $tgl2 ?></h2></center>
<h3> A. PEMBAYARAN SPP </h3>
                <table class="table" style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Waktu Pembayaran</th>
                      <th>NISN</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Uang Masuk</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($spp as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->waktu; ?></td>
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->bulan; ?></td>
                      <td><?php echo $b->tahun; ?></td>
                      <td><?php echo $b->biaya; ?></td>
                      
                    </tr>
                    <?php
                    $no++;
                    } ?>
                  </tbody>
                </table>
<h3> B. PEMBAYARAN NON SPP </h3>
                <table id="example2" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Waktu Pembayaran</th>
                      <th>NISN</th>
                      <th>Nama</th>
                      <th>Jenis Keuangan</th>
                      <th>Uang Masuk</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($nonspp as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->waktu; ?></td>
                      <td><?php echo $b->nisn; ?></td>
                      <td><?php echo $b->nmsiswa; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td><?php echo $b->bayar; ?></td>                      
                    </tr>
                    <?php
                    $no++;
                    } ?>
                  </tbody>
                </table>
<script>
window.print();
</script>