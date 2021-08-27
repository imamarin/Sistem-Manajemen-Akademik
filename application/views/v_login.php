<!DOCTYPE html>
<html lang="en">
<head>
	<title>Belajar Online</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="shortcut icon" href="<?php echo base_url().'assets/login/images/smk.png'; ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/bootstrap/css/bootstrap.min.css'; ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css'; ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css'; ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/animate/animate.css'; ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/css-hamburgers/hamburgers.min.css'; ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/animsition/css/animsition.min.css'; ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/select2/select2.min.css'; ?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/vendor/daterangepicker/daterangepicker.css'; ?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/css/util.css'; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/login/css/main2.css'; ?>">
<!--===============================================================================================-->
</head>
<body style="background-color: #008B8B;">
	
	<div class="limiter">
		<div class="container-login100" style="background-color: #008B8B;">
			<div class="wrap-login100" style="background-color: #008B8B;">
				<div style="margin-top: -10%;" style="background: #008B8B;">
				<?= form_open('login/auth',array("class"=>"login100-form validate-form","style"=>"")); ?>
				<span class="login100-form-title p-b-43">
						<font color='#008B8B'><h1>BELAJAR ONLINE</h1></font> <h4>"SMK YPC TASIKMALAYA"</h4>
						<?php
						?>
				</span>
				<center><img src="<?php echo base_url().'assets/login/images/smkypc.png'; ?>" style="width:50%;height:25%;"></center>
					
					<br>
					
					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<?= form_input("username","",array("class"=>"input100")); ?>
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<?= form_password("password","",array("class"=>"input100")); ?>
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">

					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" style="background-color: #008B8B;">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-46 p-b-20">
						
					</div>

					<div class="login100-form-social flex-c-m">
						
					</div>
				<?= form_close(); ?>
				</div>
				<div class="login100-more" style="background-image: url('<?php echo base_url().'assets/login/images/learning.jpeg'; ?>');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/jquery/jquery-3.2.1.min.js'; ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/animsition/js/animsition.min.js'; ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/bootstrap/js/popper.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/login/vendor/bootstrap/js/bootstrap.min.js'; ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/select2/select2.min.js'; ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/daterangepicker/moment.min.js'; ?>"></script>
	<script src="<?php echo base_url().'assets/login/vendor/daterangepicker/daterangepicker.js'; ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/vendor/countdowntime/countdowntime.js'; ?>"></script>
<!--===============================================================================================-->
	<script src="<?php echo base_url().'assets/login/js/main.js'; ?>"></script>

</body>
</html>