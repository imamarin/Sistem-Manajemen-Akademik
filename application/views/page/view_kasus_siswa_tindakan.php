<script type="text/javascript">
  if(window.history.replaceState){
    window.history.replaceState(null,null,window.location.href);
  }

  function edittindak(n,a){
    document.getElementById("idtindakkasus2").value=a;
    document.getElementById("editkasus").innerHTML=document.getElementById("kasus"+n).innerHTML;
    document.getElementsByName("btnedit"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnedit"+n)[0].setAttribute("data-target","#modal-default2");
  }


  function lapor(n,a){
    document.getElementById("idtindakkasus4").value=a;
    document.getElementById("editkasus2").innerHTML=document.getElementById("kasus"+n).innerHTML;
    document.getElementsByName("btnlapor"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btnlapor"+n)[0].setAttribute("data-target","#modal-default5");
  }

  function tindak(n,i){
    document.getElementById("idtindakkasus3").value=i;
    document.getElementsByName("btntindak"+n)[0].setAttribute("data-toggle","modal");
    document.getElementsByName("btntindak"+n)[0].setAttribute("data-target","#modal-default3");
  }
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row" style="padding-top: 1%;">
            <div class="col-12">
                <?php if($this->session->flashdata('info')){ ?>
                <div class="alert alert-info">  
                   <a href="#" class="close" data-dismiss="alert">&times;</a>  
                   <?php echo $this->session->flashdata('info'); ?>  
                </div>  
                <?php } ?>
            </div>
        </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Data Kasus Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kasus Siswa</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    

    <section class="content">
      
      <div class="row">
             
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <?php 
              if(in_array("Tampil-33", $this->session->fitur)){
                ?>
                
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                      <button class="btn btn-primary" data-toggle="modal" data-target="#modal-default">Penindakan Kasus Baru</button>
                    </div>

              </div>

            <?php
              }
              ?>
<br>
<br>
              <div class="row">

              <div class="col-sm-12 col-md-12">
                <div class="row">
                  <div class="col-md-2 col-2">
                    <label>NISN</label>:
                    <p><?= $siswa->nisn ?></p>
                  </div>
                  <div class="col-md-3 col-3">
                    <label>Nama Siswa</label>:
                    <p><?= $siswa->nama ?></p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label>Kelas</label>:
                    <p><?= $siswa->kdkelas ?></p>
                  </div>
                  <div class="col-md-2 col-2">
                    <label>Jumlah Kasus</label>:
                    <p><?= $siswa->kasus ?></p>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">      
                <table id="example2" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr>
                      <th>NO</th>
                      <th>KETERANGAN KASUS</th>
                      <th></th>

                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($kasus as $b) {
                    ?>
                    <tr>
                      <td>
                        <?= $no ?>
                      </td>
                        
                      <td id="kasus<?= $no ?>"><?php echo $b->kasus; ?></td>
                      <td>
                        <form method="post" action="<?= base_url() ?>page/kasussiswa/tindakan/<?= $b->nisn ?>">

                          <button type="button" class="btn btn-primary" onclick="edittindak('<?= $no ?>','<?= $b->idtindakkasus ?>')" data-toggle='' data-target='' name='btnedit<?= $no ?>'><i class="fa fa-edit"></i></button></a>  

                          <input type="hidden" name="kdkelas" value="<?= $siswa->kdkelas ?>">
                          <input type="hidden" id="idtindakkasus" name="idtindakkasus" value="<?= $b->idtindakkasus ?>">
                          <button type="submit" name="submit" value="hapus" class="btn btn-danger" onclick="return confirm('Hapus Data ini ?')"><i class="fa fa-trash"></i></button>
                          
                          <div class="btn-group">
                            <button type="button" class="btn btn-info" data-toggle='modal' data-target='#detail-modal-default<?= $b->idtindakkasus ?>'>Detail Tindakan</button>
                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown"></button>
                              <span class='sr-only'>Toggle Dropdown</span>
                              <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item" name="btntindak<?= $no ?>" onclick="tindak('<?= $no ?>','<?= $b->idtindakkasus ?>');">Tindakan Baru</a>
                                <a class="dropdown-item" name="btnlapor<?= $no ?>" onclick="lapor('<?= $no ?>','<?= $b->idtindakkasus ?>');">Serahkan ke BK</a>
                              </div>
                            
                          </div>
                        

                         
                        </form>

                      </td>

                    </tr> 
                    <?php
                    $no++;
                    } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>
      
     
       <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/kasussiswa/tindakan/'.$siswa->nisn ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH KASUS SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                    <select name="nisn" class="form-control" readonly>
                      <option selected value="<?= $siswa->nisn ?>"><?= $siswa->nama ?></option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Deskripsi Kasus</label>
                    <textarea name="kasus" class="form-control" rows="5"></textarea>
                </div>
              
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="kdkelas" value="<?= $siswa->kdkelas ?>">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="simpan">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-default2">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/kasussiswa/tindakan/'.$siswa->nisn ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">EDIT KASUS SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                    <select name="nisn" class="form-control" readonly>
                      <option selected value="<?= $siswa->nisn ?>"><?= $siswa->nama ?></option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Deskripsi Kasus</label>
                    <textarea name="kasus" class="form-control" rows="5" id="editkasus"></textarea>
                </div>
              
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="kdkelas" value="<?= $siswa->kdkelas ?>">
              <input type="hidden" id="idtindakkasus2" name="idtindakkasus" value="">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="edit">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-default3">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/kasussiswa/tindakan/'.$siswa->nisn ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">PENINDAKAN KASUS SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                    <select name="nisn" class="form-control" readonly>
                      <option selected value="<?= $siswa->nisn ?>"><?= $siswa->nama ?></option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" rows="5" id="tgltindakan"></textarea>
                </div>
              
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Deskripsi Tindakan</label>
                    <textarea name="tindakan" class="form-control" rows="5" id="desctindakan"></textarea>
                </div>
              
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" id="idtindakkasus3" name="idtindakkasus" value="">
              <input type="hidden" name="kdkelas" value="<?= $siswa->kdkelas ?>">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="tindak">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-default4">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/kasussiswaguru/simpan' ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">TAMBAH PENINDAKAN KASUS SISWA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                    <select name="nisn" class="form-control" readonly>
                      <option selected value="<?= $siswa->nisn ?>"><?= $siswa->nama ?></option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Tanggal Laporan</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Deskripsi Penindakan</label>
                    <textarea name="kasus" class="form-control" rows="5"></textarea>
                </div>
              
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="KIRIM">KIRIM</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal-default5">
        <div class="modal-dialog">
          <div class="modal-content">
            <form method="post" action="<?= base_url().'page/kasussiswa/tindakan/'.$siswa->nisn ?>" enctype="multipart/form-data">
            <div class="modal-header">
              <h4 class="modal-title">LAPORKAN KE BK/BP</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Nama Siswa</label>
                    <select name="nisn" class="form-control" readonly>
                      <option selected value="<?= $siswa->nisn ?>"><?= $siswa->nama ?></option>
                    </select>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                    <label>Deskripsi Kasus</label>
                    <textarea name="kasus" class="form-control" rows="5" id="editkasus2" readonly></textarea>
                </div>
              
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <input type="hidden" name="kdkelas" value="<?= $siswa->kdkelas ?>">
              <input type="hidden" id="idtindakkasus4" name="idtindakkasus" value="">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary" value="lapor">LAPOR</button>
            </div>
          </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
