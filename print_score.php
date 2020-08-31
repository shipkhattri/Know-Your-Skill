<?php
	
	session_start();
	$conn = mysqli_connect('localhost','root','','quiz_db');
	    if ($conn->connect_error)
	    {
	    	die("Connection failed: " . $conn->connect_error);
	    }
	    else
	    {
			if(isset($_POST['calc']))
			{
				$output = "";
				$output .= "<table class=\"table table-bordered\" width=\"500px\">";
				$output .= "<tr><th>Student Name</th><th>Score</th></tr>";		
				
				$query1="SELECT * FROM login"; 
			    if ($result = mysqli_query($conn, $query1)) {
				  // Fetch one and one row
					while ($rowl = mysqli_fetch_row($result)) {

						$i=11;
						$total=0;
						$query2 = "SELECT answer FROM questions";
						if ($ans = mysqli_query($conn, $query2)) {
					  	// Fetch one and one row
						while (($rowq = mysqli_fetch_row($ans)) && $i<41) {
				    		
				    		if($rowl[$i]==$rowq[0]){
				    			$total=$total+1;
				    		}
				    		$i++;
				    	}
				    }

				    $query3="UPDATE login SET total_score = $total WHERE id = $rowl[0]";
				    if (mysqli_query($conn, $query3)) {
						//echo "{$rowl[1]} <br>" . "{$rowl[51]} <br>" ;
						$output .= "<tr>";
        				$output .= "<td>".$rowl[1]. "</td>";
        				$output .= "<td>".$rowl[51]. "</td>";
        				$output .= "</tr>";

					} else {
					 	echo "Error updating record: " . mysqli_error($conn);
					}

				  }
				}
				else
				{
					echo "Error description:" . mysqli_error($conn);
				}
				$output .= "</table>";
			}
		}
		
		mysqli_close($conn);
?>
<html>
<head>
<meta charset="UTF-8">
<title>KYS |Registration Form|</title>
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
							</div><!--cmp-info end-->
						</div>
						<div class="container">
										<div class="row justify-content-center">
											<div class="col-md-10 mb-5">
												<h3 class="text-center p-2 text-primary">Total Score of students : </h3>
												<?php
													echo $output;
												?>
										</div>
									</div>
									
									
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