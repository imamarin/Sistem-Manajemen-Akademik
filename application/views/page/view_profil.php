<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Profil</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <section class="content" style="margin-bottom: 2%;">
        <div class="card">
          <div class="container-fluid" style="padding: 2%;">
            <!-- Small boxes (Stat box) -->
                 <?php echo form_open($form_action); ?>
                    <div class="row">
                        
                                <div class="col-12 col-sm-6 col-md-6">
                                    <label>Kode Guru: </label><br>
                                    <?php 
                                    echo $kdguru;
                                    ?>
                                </div>
                    </div>
                    <div class="row">
                        
                                <div class="col-12 col-sm-6 col-md-6"><br>
                                    <label>Nama Guru:</label>
                                    <br>
                                    <?php 
                                    echo form_input('nama',$nama,array('class'=>'form-control'));
                                    echo form_error('nama'); 
                                    ?>
                                </div>
                    </div>
                    <div class="row">
                        
                                <div class="col-12 col-sm-6 col-md-6">
                                    <br>
                                    <label>Ubah Password:</label>
                                    <?php 
                                    echo form_password('password','',array('class'=>'form-control'));
                                    echo form_error('password'); 
                                    ?>
                                </div>
                    </div>
                    <div class="row">
                        
                                <div class="col-12 col-sm-6 col-md-6"><br>
                                    <?php 
                                    echo form_submit('submit','UPDATE',array('class'=>'btn btn-primary'));
                                    ?>
                                </div>
                    </div>
                        <?php
                        echo form_close();
                        ?>
            </div>
        </div>
    </section>
  </div>