<!DOCTYPE html>

<html lang="en">

	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		
		<!--CSS files-->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">
		
		<!--Tab ICON-->
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logoURL.png" />
		
		<title><?php echo $title ?></title>
		
		<!-- Google Analytics -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-47850929-1', 'perfectforme.org');
		  ga('send', 'pageview');

		</script>
				
	</head>

	<body>
		<header>
		<nav>
			<ul>		
			<?php $s = $this->session->userdata('userId');
				if ($s) { ?>
					<li><a href="<?php echo base_url(); ?>groupHome">Perfect for Me</a></li>
				<?php } else { ?>
					<li><a href="<?php echo base_url(); ?>">Perfect for Me</a></li>
				<?php } ?>
				<li><a href="<?php echo base_url(); ?>about">About</a></li>
				<li><a href="<?php echo base_url(); ?>contact">Contact</a></li>
			</ul>

			<?php echo form_open(base_url()); ?>
				
				<p>
					<?php
					$s = $this->session->userdata('userId'); 
					$helloUser = $this->session->userdata('username');//displays correct user name
					if (!$s){ //if user session isnt logged in, show the login form
						$data = array(
							'name' => 'email',
							'id' => 'email',
							'placeholder' => 'Email',
							'value' => set_value('email'),
							'size' => '40'
						
						);
						echo form_label('Email:', 'email');
						echo form_error('email');
						echo form_input($data, set_value('email')); 
					} else {
						echo "<h4>Welcome, ".ucwords($helloUser)."!</h4>";
						
					} ?>
				</p>

				<p>
					<?php
					if (!$s){ 					
						$data = array(
							'name' => 'password',
							'id' => 'password',
							'placeholder' => 'Password',
							'value' => set_value('password'),
							'size' => '40'
						);
						echo form_label('Password:', 'password');
						echo form_error('password');
						echo form_password($data, set_value('password')); 
					} ?>
				</p>
				
				<p>
					<?php
					if (!$s){ 
						$data = array(
							'name' => 'login',
							'id' => 'login'
						);
						echo form_submit($data, 'Login'); 
					} else {
						$data = array(
							'name' => 'logout',
							'id' => 'logout'
						);
						echo form_submit($data, 'Logout');
					}?>
				</p>
				
			<?php echo form_close(); ?>
	
		</nav>
		</header>

