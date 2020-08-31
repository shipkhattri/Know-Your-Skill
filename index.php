<?php
    session_start();
	    $conn = mysqli_connect('119.18.54.19','knowyfnk_knowyfnk','Daisy@210312#','knowyfnk_quiz_db');
	    if ($conn->connect_error)
	    {
	   		die("Connection failed: " . $conn->connect_error);
	    }
    if (isset($_POST['submit']))
    {
        $secretKey = "6Lfs4qgZAAAAADx2wlYygvFCV-tAC9TXmDXcyAp0";
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];

        $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url);
        $response = json_decode($response);
        if ($response->success)
        {
                $name=$_POST['name'];
                $email=$_POST['email'];
                $pass=$_POST['password'];
                $phone=$_POST['phone'];
                $school=$_POST['school'];
                $class=$_POST['class'];
                $subject=$_POST['subject'];
		        
		        $sql = "SELECT * FROM login WHERE email = '$email' ";
				$result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);
				if ($row > 0) {
				   $msg="Email already exists.";
				}
                else
                {
                    $query="INSERT INTO login (`name`,`email`,`pass`,`phone`,`school`,`class`,`subject`,`payment_status`) VALUES ('$name','$email','$pass','$phone','$school','$class','$subject','0')"; 
			        if(mysqli_query($conn,$query))
					{
			            echo '<script type="text/javascript">
			                    window.onload = function () 
			                    { alert("Successfully Registered. Login here.");
			                    window.location= "https://knowyourskill.online/login.php"; }
			                    </script>';
					}
					else
					{
						echo "Error description:" . mysqli_error($conn);
					}
				}
        }
        else
            $msg="Please check recaptcha.";
    }
?>
<html>
<head>
<meta charset="UTF-8">
<title>KYS |Registration Form</title>
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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<!-- jQuery Library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!-- latest compiled javascript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>

function subjectValidate(){
	var x=document.getElementById('class').value;
	if(x>2 && x<6){
		var array=["English","Maths","All"];
	}
	else{
		var array=["English","Maths","Science","All"];
	}
	var string="";
	for(i=0;i<array.length;i++)
	{
		string=string+"<option>"+array[i]+"</option>";
	}
	string="<div class=\"sn-field\"><select name=\"subject\" required>"+string+"</select>"+
	           "<i class=\"fa fa-book\" aria-hidden=\"true\"></i><span><i class=\"fa fa-ellipsis-h\"></i></span></div>";
	
/*	string="<div class=\"col-lg-12 no-pdd\">"+
				"<div class=\"sn-field\"><select name=\"subject\" required>"+string+
				"</select><i class=\"fa fa-book\" aria-hidden=\"true\"></i>"+
				"<span><i class=\"fa fa-ellipsis-h\"></i></span></div></div>";*/

	document.getElementById('subject').innerHTML=string;
}
</script>
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
									<h3>Registration Form</h3>
<form class="register-form" name="RegForm" id="register-form" action="" method="POST">
										<div class="row">
										<br><br><br>
											<div class="col-lg-12 no-pdd">
											<br><br>
											<div class="row">
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" id="name" name="name" pattern="[A-Za-z ]{1,}" maxlength="50" title="Name must contain alphabets only." placeholder="Full Name" required>
														<i class="la la-user"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="email" id="email" name="email" placeholder="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
														<i class="fa fa-envelope-o" aria-hidden="true"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" id="phone" name="phone" placeholder="Phone No" pattern="[\d*]{10,}" maxlength="10" title="Phone number must contain 10 digits" required>
														<i class="fa fa-phone" aria-hidden="true"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" name="school" placeholder="School" required>
														<i class="fa fa-graduation-cap" aria-hidden="true"></i>
													</div>
												</div>
                                                <div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<select id="class" name="class" onchange="subjectValidate()" required>
															<option value="" disabled selected>Class</option>
											                <option value="3" >3</option>
											                <option value="4" >4</option>
											                <option value="5" >5</option>
											                <option value="6" >6</option>
											                <option value="7" >7</option>
											                <option value="8" >8</option>
											                <option value="9" >9</option>
											                <option value="10" >10</option>
                                                        </select>
														<i class="fa fa-book" aria-hidden="true"></i>
														<span><i class="fa fa-ellipsis-h"></i></span>
													</div>
												</div>
												<div id="subject" class="col-lg-12 no-pdd">
													<div class="sn-field">
														<select name="subject" required>
															<option value="" disabled selected>Subject</option>
                                                        </select>
														<i class="fa fa-book" aria-hidden="true"></i>
														<span><i class="fa fa-ellipsis-h"></i></span>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<label for="password"></label>
														<input type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
  title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Password" required>
														<i class="la la-lock"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<label for="confirm_password"></label>
														<input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
														<i class="la la-lock"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
												        <div class="g-recaptcha" data-sitekey="6Lfs4qgZAAAAAPVaq9cYBk9LZW-CoUsKzNUVUlUv"></div>
												        <span id="captcha_error" class="text-danger"></span>
												    </div>
												</div><br><br>
												<p class="text-danger"><?php echo $msg; ?></p>
												<div class="col-lg-12 no-pdd">
											        <input type="submit" value="REGISTER" class="submit" name="submit" id="submit" style="color:white; float: left; width: 150px; text-align: center;"/>
											    </div>

											</div>
										</form>
										<br>
										<a href="login.php">Already Registered? Login here-></a>

									
									
								</div>		
							</div><!--login-sec end-->
						</div>
					</div>		
				</div><!--signin-pop end-->
			</div><!--signin-popup end-->
		</div><!--sign-in-page end-->


	</div><!--theme-layout end-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/main.js"></script>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/popper.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="lib/slick/slick.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>