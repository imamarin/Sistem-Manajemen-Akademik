<style type="text/css">
  img:hover{
    border:solid 3px #2F86F2;
    cursor: pointer;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">SELAMAT DATANG, <?= strtoupper($this->session->nama) ?></h4>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">SMK YPC Tasikmalaya</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              Selamat datang di fasilitas layanan akademik SMK YPC Tasikmalaya. fasilitas ini salah satu bentuk Informasi pelayanan yang ditujukan untuk semua pihak SMK YPC Tasikmalaya, dan diharapkan seluruh jajaran dapat memperoleh informasi tersebut dengan mudah melalui fasilitas ini.
            </div>
            <div class="card-body">
              <div style="border: 1px solid #2F86F2;border-top: 4px solid #2F86F2; padding: 5px;">
                <h4>Pengumuman SMK YPC Tasikmalaya</h4>
                <ul>
                <?php
                  $id=$this->session->idlevel;
                  $tahun=$this->session->tahun;
                  $subjek=$this->session->subjek;
                  $tgl=date('Y-m-d H:i:s');
                  $q=$this->db->query("SELECT * FROM info, detailinfo WHERE info.idinfo=detailinfo.idinfo AND detailinfo.idlevel='$id' AND detailinfo.subjek='$subjek' AND info.tanggal <= '$tgl' AND detailinfo.idtahunajaran='$tahun'  ORDER BY info.tanggal desc")->result();
                  foreach ($q as $key => $v) {
                    # code...
                    ?>
                    <li><b><?= $v->judul ?></b><br>
                        <?= $v->deskripsi ?>
                    </li>
                    <?php
                  }
                ?>
                </ul>
              </div>
              <br>
            </div>
          </div>
        </div>
      </div>
       <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <b>SWITCH ACCESS</b>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-sd-1 col-md-1 col-6" align="center">
                  <a href="https://elearning.smk-ypc.sch.id/login/sinkron/<?= sha1($this->session->username) ?>" target="_blank">
                  <img src="<?= base_url("assets/images/elearning.jpg") ?>" style="width:100%;border-radius: 10px 10px 10px 10px;"><br>
                  <b>E-Learning</b>
                  </a>
                </div>
                <div class="col-sd-1 col-md-1 col-6" align="center">
                  <a href="https://pkg.smk-ypc.sch.id/login/sinkron/<?= sha1($this->session->username) ?>" target="_blank">
                  <img src="<?= base_url("assets/images/penilaian.jpg") ?>" style="width:100%;border-radius: 10px 10px 10px 10px;"><br>
                  <b>PKG</b>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>



<?php
          $nis=$this->session->nisn;
          $q=$this->db->query("SELECT*FROM lapkuisionersiswa WHERE nis='$nis' AND idtahunajaran=3");
          if($q->num_rows()>0){
          ?>
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header text-center justify-content-center align-items-center">
              <div class="row">
                  <div class="col-md-12 col-12 ">
                    <h6 class="modal-title" id="title">HASIL KELULUSAN 2021<br>SMK YPC TASIKMALAYA</h6>
                  </div>
              </div>
            </div>
            <div class="modal-body">
              <?php
              $q=$this->db->query("SELECT*FROM datakelulusan WHERE nisn='$nis'");
              if($q->num_rows()>0){
                $v=$q->row();
              ?> 
              <div class="row">

                  <div class="col-md-12 col-12 justify-content-between">
                    <p>
                    Berdasarkan hasil rapat Dewan Guru SMK YPC Tasikmalya pada tanggal 24 Mei 2021, Kami Menyatakan bahwa atas nama:
                    </p>
                    <p>
                    NISN: <b><?= $this->session->nisn ?></b>
                    <br>Nama: <b><?= $this->session->nama ?></b>
                  </p>
                    <?php
                    if($v->predikat==1){
                    ?>
                    Dinyatakan <b>"LULUS"</b> dari SMK YPC Tasikmalaya Tahun Ajaran 2020/2021.
                    <?php
                    }else{
                      ?>
                    Dinyatakan <b>"BELUM LULUS"</b> dari SMK YPC Tasikmalaya Tahun Ajaran 2020/2021, dengan Alasan "<b><?= $v->ket ?></b>". Harap menghubungi walikelas untuk mengambil surat pemanggilan orang tua dan Segera melakukan perbaikan nilai batas waktu sampai tanggal 31 Mei 2021.
                    <?php
                    }
                    ?>
                    <br>Demikian keterangan kelulusan yang disampaikan, Terima kasih atas perhatiannya. 
                    <br>
                    <br>
                    <br>
                    NB: Untuk Surat Keterangan Lulus yang resmi bisa diambil di sekolah pada tanggal 4 Juni 2021
                  </div>
                </div>
              <?php
            }
            ?>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <?php
    }
    ?>
          