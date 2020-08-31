<?php
  $firstname = $_POST['firstname']; 
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $amount=$_POST["amount"];

  $status=$_POST["status"];
  $txnid=$_POST["txnid"];
  $posted_hash=$_POST["hash"];
  $key=$_POST["key"];
  $productinfo=$_POST["productinfo"]; 
  $salt="";

// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
    
    echo '<script type="text/javascript">
          window.onload = function () 
          { alert("Failed Transaction. Click OK to redirect to login page.");
            window.location= "https://knowyourskill.online/login.php";
          }
        </script>';
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

              <div class="login-sec">
                <div class="sign_in_sec current" id="tab-1">
                  <br><br><br><br>
                  <img src="images/logo.jpg" alt="">
                  <br><br><br><br>
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="col-md-10 mb-5">
                        <h3 class="text-center p-2 text-primary" style="color: red; ">Failed Transaction</h3>
                        <h4 class="text-center p-2 text-primary">Your Transaction ID for this transaction is <?php echo $txnid; ?></h4>
                        <h4 class="text-center p-2 text-primary">You may try again later by clicking OK and login from the portal.</h4>
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

</body>
</html>
