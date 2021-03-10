<?php
	ob_start();
	session_start();
?>
<!DOCTYPE html>
<html>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6961308232874424",
    enable_page_level_ads: true
  });
</script>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="stylesheet" href="style/main.css"/>
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon" />
		<meta name="description" content="An interactive getting started guide for Brackets."/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<title>Forgot Password | Bullseye2.0</title>
	</head>

	<body>
		<div class="header"><center><img src="bullseye.png" style="border:none;"></center></div>
		<div class="container"  id ="email_form">
			<center><p style="font-size:230%; background-color:#5f5f5f; color:#ffffff;">Forgot Password</p></center>
			<center><p style="font-size:200%; color:darkorange;"><?php echo @$_GET["error"];?></p></center>
				<form>
					<input type="email" name="f_email" placeholder="Enter Your Email Address..." required/>
					<input type="submit" value="Submit" name = "submit"/>
				</form>
		</div>
		<?php
			if(isset($_GET['submit'])){
				$mail = $_GET['f_email'];
				include('db/conn.php');
				$query = "SELECT * FROM user WHERE  email like '$mail'";
				$result = mysqli_query($con,$query);
				if(mysqli_num_rows($result) > 0 ){
					@$code = rand();
					 $to = $mail;
					 $subject = "BullsEye2 Recover Password";
					 $message = "<b>This verification code is as bellow.</b>";
					 $message .= "<h1>".$code."</h1>";
					 $header = "From:recover@bullseye2.com \r\n";
					 $header .= "MIME-Version: 1.0\r\n";
					 $header .= "Content-type: text/html\r\n";
					 $retval = mail ($to,$subject,$message,$header);
					 
					 if( $retval == true ) {
					 	$_SESSION['code']=$code;
						$_SESSION['f_email']=$mail;
						if(!empty(@$_GET['msg'])){
							$msg= $_GET['msg'];
						}else{
							$msg= "Recovery code has been sent to your Email...";
						}
						
		?>
					<script>
						$(document).ready(function(){
								$("#email_form").hide();
						});
					</script>
					<div class="container" id = "code_form">
						<center><p style="font-size:230%; background-color:#5f5f5f; color:#ffffff;">Enter Recovery Code</p></center>
						<center><p style="font-size:200%; color:darkorange;"><?php echo $msg;?></p></center>
						<form action="recoverpass.php" method="post" >
							<input type="text" name="code" placeholder="Enter Recovery code..." required/>
							<input type="submit" value="Submit" name = "submit"/>
						</form>
					</div>
		<?php
					}
					else{
						session_destroy();
						header('location: forgotPassword.php?error="Email could not be sent! Please try later..."');
					}
				}
				else{
					header('location: forgotPassword.php?error="No user found with this Email."');
				}
			}
		?>
	</body>
</html>
