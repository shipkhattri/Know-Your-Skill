<?php
	session_start();
	#session variable so that only users from payu.php can go to sucess.php 
	$_SESSION['i']=1;
	$e=$_SESSION['email'];
	$conn = mysqli_connect('119.18.54.19','knowyfnk_knowyfnk','Daisy@210312#','knowyfnk_quiz_db');
	if ($conn->connect_error)
	{
	    die("Connection failed: " . $conn->connect_error);
    }
    $query = "SELECT * FROM login WHERE email='$e' ";
	$result = mysqli_query($conn,$query);
	$r = mysqli_fetch_array($result, MYSQLI_ASSOC);

	$name = $r["name"]; 
	$email = $r["email"];
	$phone = $r["phone"];
	$school = $r["school"];
	$class = $r["class"];
	$subject = $r["subject"];

	$MERCHANT_KEY = "aueUmwKc";
	$SALT = "o85RYYLxE6";
	$txnid="KYS".strval(uniqid());
	$surl="https://knowyourskill.online/success.php";
	$furl="https://knowyourskill.online/failure.php";
	$productInfo="KYS Online exam";
	if($subject=="English" || $subject=="Maths" || $subject=="Science"){
		$amount=116.66;
	}
	elseif($subject=="All"){
		$amount=350.00;
	}

	$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
	$hashString=$MERCHANT_KEY."|".$txnid."|".$amount."|".$productInfo."|".$name."|".$email."|||||||||||".$SALT;

	$hash = strtolower(hash('sha512', $hashString));
?>

<html>
<head>
<meta charset="UTF-8">
<title>KYS |PAYMENT REQUEST|</title>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
</head>


<body class="sign-in">
	

	<div class="wrapper">
		

		<div class="sign-in-page">
			<div class="signin-popup">
				<div class="signin-pop">
					<div class="row">

							<div class="login-sec">
								<div class="sign_in_sec current" id="tab-1">
									<br><br><br><br>
									<img src="images/logo.jpg" style="margin-right:15px;float:left;" alt=""><br><br><br><br>
									<p style="font-weight: bold;margin-left:81px;float:left;font-size:28px;color:green;">PAYUMONEY PAYMENT REQUEST FORM </p>
									<br><br><br><br><br><br>
									<div class="container">
										<div class="row justify-content-center">
											<div class="col-md-10 mb-5">
												
												<form action="https://secure.payu.in/_payment"  name="payuform" method=POST >
													<input type="hidden" name="key" value="<?php echo $MERCHANT_KEY;?>" />
													<input type="hidden" name="hash"  value="<?php echo $hash;?>" />
													<input type="hidden" name="txnid" value="<?php echo $txnid;?>"/>
													<input type="hidden" name="password" value="<?php echo $pass;?>"/>
													<table width="400px" style="font-size: 20px;">

													<tr>
														<th>Product Info: </th>
														<td><div class="input-form"><input name="productinfo" value="<?php echo $productInfo;?>" style="border:0; color:black; font-size: 20px;" readonly/></div></td>
													</tr>
													<tr>
														<th>Name: </th>
														<td><div class="input-form"><input name="firstname" id="firstname" value="<?php echo $name;?>" style="border: 0; color:black; font-size: 20px;" readonly/></div></td>
													</tr>
													<tr>
														<th>Email: </th>
														<td><div class="input-form"><input name="email" id="email"  value="<?php echo $email;?>" style="border: 0; color:black; font-size: 20px;" readonly/></div></td>
													</tr>
													<tr>
														<th>Phone: </th>
														<td><div class="input-form"><input name="phone" value="<?php echo $phone;?> " style="border: 0; color:black; font-size: 20px;" readonly/></div></td>
													</tr>
													<tr>
														<th>School: </th>
														<td><div class="input-form"><input name="school" id="school" value="<?php echo $school;?> " style="border: 0; color:black; font-size: 20px;" readonly/></div></td>
													</tr>
													<tr>
														<th>Class: </th>
														<td><div class="input-form"><input name="class" value="<?php echo $class;?> " style="border: 0; color:black; font-size: 20px;" readonly/></div></td>
													</tr>
													<tr>
														<th>Subject: </th>
														<td><div class="input-form"><input name="subject" value="<?php echo $subject;?> " style="border: 0; color:black; font-size: 20px;" readonly/></div></td>
													</tr>
													<tr>
														<th style="color:blue;">Total Amount: </th>
														<td><div class="input-form"><input name="amount" value="<?php echo $amount;?>" style="border: 0; color:blue; font-size: 20px;" readonly/></div></td>
													</tr>
													
													<input type="hidden" name="surl"  size="64" value="<?php echo $surl;?> " /></td>
													<input type="hidden" name="furl"  size="64" value="<?php echo $furl;?> " /></td>
													<input type="hidden" name="service_provider" value="payu_paisa" />
													
													</table>
													<br><br>
													<div class="input-form-submit">
															<input type="submit" value="Pay Now" class="submit" style="font-size:20px; color:white; height:48px; width:150; padding-right:50px;"/>
														</div>
													</form>
										</div>
									</div>
									
									
								</div>		
							</div><!--login-sec end-->
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