<!doctype html>
                        <html>
                            <head>
                                <meta charset='utf-8'>
                                <meta name='viewport' content='width=device-width, initial-scale=1'>
                                <title>Sistem Manajemen Akademik</title>
                                <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>
                                <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
                                <style>
html {
    height: 100%;
    
}
body {
    color: #000;
    overflow-x: hidden;
    background: url('<?= base_url() ?>assets/images/back21.jpg') no-repeat center center fixed;
    background-size: cover;

}

.card0 {
    box-shadow: 2px 2px 10px 2px #C1C1C1;
    background-image: url('<?= base_url() ?>assets/images/back13.png');
    border-radius: 0px;

}

.card2 {
    margin: 0px 40px
}

.logo {
    width: 200px;
    height: 100px;
    margin-top: 20px;
    margin-left: 35px
}

.image {
    width: 360px;
    height: 280px
}

.border-line {
    border-right: 1px solid #EEEEEE
}

.facebook {
    background-color: #3b5998;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer
}

.twitter {
    background-color: #1DA1F2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer
}

.linkedin {
    background-color: #2867B2;
    color: #fff;
    font-size: 18px;
    padding-top: 5px;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    cursor: pointer
}

.line {
    height: 1px;
    width: 45%;
    background-color: #E0E0E0;
    margin-top: 10px
}

.or {
    width: 10%;
    font-weight: bold
}

.text-sm {
    font-size: 14px !important
}

::placeholder {
    color: #BDBDBD;
    opacity: 1;
    font-weight: 300
}

:-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

::-ms-input-placeholder {
    color: #BDBDBD;
    font-weight: 300
}

input,
textarea {
    padding: 10px 12px 10px 12px;
    border: 1px solid lightgrey;
    border-radius: 2px;
    margin-bottom: 5px;
    margin-top: 2px;
    width: 100%;
    box-sizing: border-box;
    color: #2C3E50;
    font-size: 14px;
    letter-spacing: 1px
}

input:focus,
textarea:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #071a1e;
    outline-width: 0
}

button:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    outline-width: 0
}

a {
    color: inherit;
    cursor: pointer
}

.btn-blue {
    background-color: #1A237E;
    background-color: #074f65;
    width: 150px;
    color: #fff;
    border-radius: 2px
}

.btn-blue:hover {
    background-color: #0e4347;
    color: #fff;
    cursor: pointer
}

.bg-blue {
    color: #fff;
    background-color: #1A237E;
    background-color: #074f65;
}

h3.welcome{
    color: #B0BEC5; 
    width: 100%;
    text-align: right;
    margin-top: -5%;
}

@media screen and (max-width: 991px) {
    .logo {
        margin-left: 20px
    }

    .image {
        width: 300px;
        height: 220px
    }

    .border-line {
        border-right: none
    }

    .card2 {
        border-top: 1px solid #EEEEEE !important;
        margin: 0px 15px
    }

    h3.welcome{
        text-align: center;
    }

}

@media screen and (max-width: 400px){
    .title{
        font-size: smaller;
        margin-left: 15px;
        margin-top: 10px;
    }
}
</style>
                                <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
                                <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
                                <script type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
                                <script type='text/javascript'></script>
                            </head>
                            <body>
<div class="container-fluid px-2 px-md-5 px-lg-2 px-xl-5 py-5 mx-auto">
    <div class="card card0 border-0">
        <div class="row d-flex">
            <div class="col-lg-6">
                <div class="card1 pb-5">
                    <div class="row"> 
                        <div class="col-md-2 col-sm-2 col-2">
                            <img src="<?php echo base_url().'assets/images/smkypc.png'; ?>" class="logo" style="width: 50px;height: 50px;"> 
                        </div>
                        <div class="col-md-6 col-8 title" style="vertical-align: middle;padding-top: 3%;">
                            <label style="font-weight: bold;color: #071a1e;">SISTEM MANAJEMEN AKADEMIK<br>SMK YPC TASIKMALAYA</label>
                        </div>
                    </div>
                    <div class="row px-3 mt-4 mb-5 border-line" style="text-align: left;margin-left: 1%;margin-right: 1%;"> 
                        <div class="col-md-12 col-12">
                            <?= form_open('login/auth'); ?>
                            <div class="row px-3 mb-4">
                                <div class="line" style="width: 40%;"></div> <small class="or text-center" style="width: 20%;">Silahkan Login</small>
                                <div class="line" style="width: 40%;"></div>
                            </div>
                            <div class="row px-3"> <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Username</h6>
                                </label> <input class="mb-4" type="text" name="username" placeholder="Masukan username" required> </div>
                            <div class="row px-3"> <label class="mb-1">
                                    <h6 class="mb-0 text-sm">Password</h6>
                                </label> <input type="password" name="password" placeholder="Masukan password" required> </div>
                            <div class="row px-3 mb-4">
                                <!--
                                <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a>
                            -->
                            </div>
                            <div class="row mb-3 px-3"> <button type="submit" class="btn btn-blue text-center" style="">Login</button> </div>
                            <!--
                            <div class="row mb-4 px-3"> <small class="font-weight-bold">Don't have an account? <a class="text-danger ">Register</a></small> </div>
                        -->
                        <?= form_close(); ?>
                                    
                        </div>
                    <!--
                        <img src="<?php echo base_url().'assets/images/banner.jpg'; ?>" class="image" style="width: 90%;height: 350px;"> 
                    -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card2 card border-0 px-0 py-2">
                    <div class="row mb-4 px-2 py-2">
                        <h3 class="welcome" style="margin-top:3px;color: #166771;">SELAMAT DATANG </h3>
                        <!--
                        <div class="facebook text-center mr-3">
                            <div class="fa fa-facebook"></div>
                        </div>
                        <div class="twitter text-center mr-3">
                            <div class="fa fa-twitter"></div>
                        </div>
                        <div class="linkedin text-center mr-3">
                            <div class="fa fa-linkedin"></div>
                        </div>
                    -->
                    </div>
                    <div class="row px-0 mt-4 mb-5 border-line" style="color: #071a1e; font-size: 12px;"> 
                        <div class="col-md-12 col-12">
                        <h5>PETUNJUK LOGIN</h5>
                            <p>
                                Isikan <b>Username</b> bagi guru dengan kode guru anda, bagi siswa dengan NISN dan isikan <b>Password</b> dengan password anda, kemudian klik login.
                            </p>

                            <h5>CONTACT</h5>
                            <p><b>Telepon</b><br>000 000000</p>
                            <p><b>Email</b><br>smkypctasikmalaya@gmail.com</p>
                            <p><b>Website</b><br>https://www.smk-ypc.sch.id</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-blue py-4">
            <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">Copyright &copy; 2020. SMK YPC Tasikmalaya.</small>
                
                <div class="social-contact ml-4 ml-sm-auto"> <span class="fa fa-facebook mr-4 text-sm"></span> <span class="fa fa-google-plus mr-4 text-sm"></span> <span class="fa fa-linkedin mr-4 text-sm"></span> <span class="fa fa-twitter mr-4 mr-sm-5 text-sm"></span> </div>
            </div>
        </div>
    </div>
</div>
                            </body>
                        </html>