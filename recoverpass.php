<?php
	ob_start();
	session_start();
	if(!isset($_SESSION['f_email']) || !isset($_SESSION['code'])){
		header("location:forgotPassword.php");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width,initial-scale=1"/>
		<link rel="stylesheet" href="style/main.css"/>
		<meta name="description" content="An interactive getting started guide for Brackets."/>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<title>Recover Password | Bullseye2.0</title>
	</head>

	<body>
		<div class="header"><center><img src="bullseye.png" style="border:none;"></center></div>
		
		
		<?php
			a:
							if (isset($_GET['submit'])){
								unset($_GET['submit']);
								if($_GET['n_pass'] == $_GET['c_pass']){
									include('db/conn.php');
									$mail=$_SESSION['f_email'];
									$query = "UPDATE user SET password= '".$_GET['c_pass']."' WHERE email like '".$mail."';";
									mysqli_query($con , $query);
									if(!empty($_GET["login"])){
										$_SESSION['email'] = $mail;
										header("location: index.php");
									}
									else {
										session_destroy();
										header('location: user_log.php?error="Password Updated Successfully ..."');
									}
								}
								else{
									echo '<center><p style="font-size:200%; color:darkorange;">Password Does not Match !</p></center>';
									goto a;
								}
							}
							else{
								if($_SESSION['code'] == $_POST['code']){
		?>	
									<div class="container">
										<center><p style="font-size:230%; background-color:#5f5f5f; color:#ffffff;">Enter New Password</p></center>
										<form>
											<input type="password" name="n_pass" placeholder="Enter New Password..." required/>
											<input type="password" name="c_pass" placeholder="Enter confirm New Password..." required/><br/>
											<input type="checkbox" name="login" checked />Keep Login<br/>
											<input type="submit" value="Submit" name = "submit"/>
										</form>
									</div>
		<?php
								}
								else
								{
									header('location: forgotPassword.php?msg="Recovery Code is Incorrect Please try again !."');
								}
							}
						
		?>
	</body>
</html>
