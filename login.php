<?php
	session_start();
	$conn = mysqli_connect('119.18.54.19','knowyfnk_knowyfnk','Daisy@210312#','knowyfnk_quiz_db');
	if ($conn->connect_error)
	{
	    die("Connection failed: " . $conn->connect_error);
    }
	$msg = '';

	if(isset($_POST["signin"]))
	{
		$_SESSION['email']=$_POST['email'];
 		$e=$_POST['email'];
 		$p=$_POST['password'];
 		if(empty($e))
		{
			$msg="please enter email";
		}
		else if(!filter_var($e,FILTER_VALIDATE_EMAIL))
		{
			$msg="please enter valid email";
		}
		else if(empty($p))
		{
			$msg="please enter correct password";
		}
		else
		{
			$query = "SELECT * FROM login WHERE email='$e' AND pass='$p' ";
			$result = mysqli_query($conn,$query);
			$row = mysqli_num_rows($result);
			$r = mysqli_fetch_array($result, MYSQLI_ASSOC);

			if($row>0)
			{
				if($r["payment_status"]=='0')
					header("Location: https://knowyourskill.online/payu.php");
				else
					header("Location: https://knowyourskill.online/instructions.php");
				die();
			}
			else
			{
				$msg="Invalid email or password";
			}
		}	
 	}
?>
<html>
	<head>
		<title>Login</title>
		<meta charset="UTF-8">
		<title>KYS |LOGIN|</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<link rel="stylesheet" type="text/css" href="css/animate.css">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
		<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="css/responsive.css">
	</head>
	<body class="sign-in">
	<div class="wrapper">
		<div class="sign-in-page">
			<div class="signin-popup">
				<div class="signin-pop">
					<div class="row">
						<div class="col-lg-6">
							<div class="cmp-info">
								<div class="cm-logo">
									<img src="images/logo.jpg" alt="">
									<p></p>
									
								</div><!--cm-logo end-->	
								<img src="images/reg.png" alt="">			
							</div><!--cmp-info end-->
						</div>
						<div class="col-lg-6">
							<div class="login-sec">					
								<div class="sign_in_sec current" id="tab-1">
									<br><br><br>
									<h3>Login</h3>
									<form method="POST" class="register-form" id="register-form" action="" >
										<div class="row">
										
										<div class="col-lg-12 no-pdd">
										<br><br>
										<label for="email">User id :</label><br><br>
											<div class="sn-field">	
										<input type="email" name="email" id="email" placeholder="example@example.com" required>
											<i class="la la-user"></i>
											</div><!--sn-field end-->
										<label for="password">Password :</label><br><br>
											<div class="sn-field">								
										<input type="password" name="password" id="password" placeholder="password" required>
											<i class="la la-lock"></i>
											</div><!--sn-field end-->
											</div>
											 <p class="text-danger"><?php echo $msg; ?></p>
											 <br><br><br><br>
											 <div class="col-lg-12 no-pdd">
											<input type="submit" value="LOGIN" class="submit" name="signin" id="submit" style="color:white; width: 150px; text-align: center;"/>
											</div>
												
											<br><br><br><br>
											<center><a href="index.php" title="" >New user Register here -></a></center>
											</div>
											<br><br>
										</div>
									</form>
								</div><!--sign_in_sec end-->	
							</div>
						</div>		
					</div><!--signin-pop end-->
				</div><!--signin-popup end-->
			</div><!--sign-in-page end-->
		</div><!--theme-layout end-->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>