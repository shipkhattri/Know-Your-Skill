<?php
session_start();
//if($_SESSION['i']=='1')
{
  $firstname = $_POST['firstname']; 
  $email = $_POST['email'];
  $amount=$_POST["amount"];
  $status=$_POST["status"];
  $txnid=$_POST["txnid"];
  $posted_hash=$_POST["hash"];
  $key=$_POST["key"];
  $productinfo=$_POST["productinfo"]; 
  $salt="";

// Salt should be same Post Request 

if (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
} else {
    $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
}
$hash = hash("sha512", $retHashSeq);

      $conn = mysqli_connect('119.18.54.19','knowyfnk_knowyfnk','Daisy@210312#','knowyfnk_quiz_db');
      if ($conn->connect_error)
      {
        die("Connection failed: " . $conn->connect_error);
      }
      $query = "UPDATE login SET payment_status='1' WHERE email='$email' ";
      $result = mysqli_query($conn,$query);
      
      $sql="SELECT * FROM login WHERE email='$email' ";
      $res = mysqli_query($conn,$sql);
      $r = mysqli_fetch_array($res, MYSQLI_ASSOC);

	$school = $r["school"];
	$class = $r["class"];
	$subject = $r["subject"];
	$currDate = date("d/m/Y");
?>	
<html>
  <head>
    <title>KYS |RECEIPT|</title>
    <meta charset="UTF-8">
    <title>KYS |RECEIPT|</title>
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

<script type="text/javascript">
    function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        var home = document.getElementById("home");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        home.style.visibility = 'hidden';
        //Print the page content
        window.print()
        //Set the print button to 'visible' again 
        //[Delete this line if you want it to stay hidden after printing]
        printButton.style.visibility = 'visible';
        home.style.visibility = 'visible';
    }
    function goToHome(){
        window.location.href = "https://knowyourskill.online/login.php";
    }
</script>
  </head>
  <body class="sign-in">
  <div class="wrapper">
    

    <div class="sign-in-page">
      <div class="signin-popup">
        <div class="signin-pop">
          <div class="row">

              <div class="login-sec">
                <div class="sign_in_sec current" id="tab-1">
                  <br>
                  <img src="images/logo.jpg" alt="">
                  <img src="images/ikao.png" alt="" style="float:right; padding:20px 100px 0 0;">
                  <div class="container">
                    <div class="row justify-content-center">
                      <div class="col-md-10 mb-5">
                        <h2 class="text-center p-2 text-primary">KNOW YOUR SKILL ONLINE EXAM</h2><br>
                        
                        <h5 class="text-center">Organised By Individual Knowledge Assessment Olympiad Pvt. Ltd.</h5><br>
                        <hr>
                        <h5 class="text-center"><u>Receipt for successfull payment of fees for KYS online exam conducted by IKAO </u></h5>
                        <h5 class="text-center"><u>Course: 2020-21</u></h5><br><br>
                        
                        <h5>Name Of the student : <?php echo $firstname;?></h5><br>
                        <h5>School : <?php echo $school;?></h5><br>
                        <h5>Class : <?php echo $class;?></h5><br>
                        <h5>Subject : <?php echo $subject;?></h5><br>
                        <h5>Date of payment : <?php echo $currDate;?></h5><br>
                        <h5>Payment Reference ID : <?php echo $txnid;?></h5><br>
                        <h5>Payment Status : <?php echo $status;?></h5><br>
                        <h5>Amount : <?php echo $amount;?></h5><br>
                        <br><br>
                        <h5>We hereby acknowledge with thanks, the receipt of Rs.<?php echo $amount;?> from the afore mentioned student towards payment for KYS Onine Exam, details of which are shown above</h5><br>
                        <h5><b>Note:</b></h5><br>
                        <h5>If you encounter any issue, please write to: kysexam@gmail.com  Chargeback through the bank will not be entertained.</h5><br>
                        <img src="images/signature.png" style="float:right; padding:0 25px 0 0;">
                        <br><br><br><br><br><br>
                        <h5 style="float:right; padding:0 20px 0 0;">Exam Controller</h5><br>
                        <hr>
                        <p>119 BLK-D, PKT-4, SECTOR-20, ROHINI EXTN., DELHI-110086; &nbsp&nbsp Tel: +918802334029; &nbsp&nbsp Email:kysexam@gmail.com &nbsp&nbspWeb url: knowyourskill.org</p><br><br>
						<input id="printpagebutton" type="button" value="Print" onclick="printpage()" class="submit" style="color:white; width: 150px; text-align: center; align-items: center;"/>
						<input id="home" type="button" value="Home" onclick="goToHome()" class="submit" style="color:white; width: 150px; text-align: center; align-items: center;"/>
				
                        
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

<?php
}
?>