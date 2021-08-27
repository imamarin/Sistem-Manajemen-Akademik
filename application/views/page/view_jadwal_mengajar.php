<script type="text/javascript">
  function checkAll(ele) {
       var checkboxes = document.getElementsByTagName('input');
       if (ele.checked) {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox'  && !(checkboxes[i].disabled) ) {
                   checkboxes[i].checked = true;
               }
           }
       } else {
           for (var i = 0; i < checkboxes.length; i++) {
               if (checkboxes[i].type == 'checkbox') {
                   checkboxes[i].checked = false;
               }
           }
       }
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
            <h1 class="m-0 text-dark">Kompetensi Mata Pelajaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Data Kompetensi Matpel</a></li>
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
            <!-- /.card-header -->
            <div class="card-body">  
            <div class="row">
              <div class="col-sm-12 col-md-12">
                
                <table id="example1" class="table table-bordered table-striped dt-responsive " style="width:100%">
                  <thead>
                    <tr> 
                      <th>No</th>
                      <th>Kode Guru</th>
                      <th>Nama Guru</th>
                      <th>Tahun Ajaran</th>
                      <th>Pilih</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($guru as $b) {
                    ?>
                    <tr>
                      <td><?php echo $no; ?></td>
                      <td><?php echo $b->kdguru; ?></td>
                      <td><?php echo $b->nama; ?></td>
                      <td>
                        <select name="tahunajaran" class="select2" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php
                            foreach ($tahun as $key => $v) {
                              # code...
                              ?>
                              <option value="<?= $v->idtahunajaran ?>"><?= $v->tahun."(".$v->semester.")" ?></option>
                              <?php
                            }
                          ?>
                          
                      </select>
                      </td>
                      <td>
                        <?php 
                        if(in_array("Hapus Data-15", $this->session->fitur)){
                          ?>
                          <a href="<?= base_url().'page/jadwalmengajarguru/tampil/'.$b->kdguru ?>">
                            <button class="btn btn-info" ><i class="fa fa-edit"></i> Set Jadwal Mengajar</button>
                          </a>
                          <?php
                        }
                        ?>
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
        </div>
      </div>
      
    </section>
  </div>


