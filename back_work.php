<?php
    ob_start();
	session_start();
?>
<!DOCTYPE>
<html>
	<head>
        <meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" href="style/main.css">
		<title>BULLS EYE 2.0</title>
	</head>

	<body>
		<?php
			include('db/conn.php');
		?>
		<?php 
			$temp = $_GET["work"];
			if ( $temp == "'login'" ){
				$email = $_POST['uemail'];
				$pass = $_POST['upass'];
				b:
				$query = "SELECT * FROM `user` WHERE email like '$email' and password like '$pass';";
				$result  = mysqli_query($con,$query);
				if(mysqli_num_rows($result) > 0 ) {
					$row = mysqli_fetch_assoc($result);
					$ID = $row["email"] ;
					$_SESSION['email'] = $ID;
					if(!empty($_POST["remember"])){
						setcookie ("uemail",$email,time()+ (365 * 24 * 60 * 60));
						setcookie ("upass",$pass,time()+ (365 * 24 * 60 * 60));
					}else {
						if(isset($_COOKIE["uemail"])) {
							setcookie ("uemail","");
						}
						if(isset($_COOKIE["upass"])) {
							setcookie ("upass","");
						}
					}
					header('location: index.php');
				}else {
					header('location: user_log.php?error="Email or Password invalid !"');
				}
			}else if ($temp == "'register'" ){
				$name = $_POST["uname"];
				$email = $_POST["uemail"];
				$pass = $_POST["upass"];
				$gender = $_POST["gender"];
				$query1 = "SELECT `email` FROM `user` WHERE email like '$email'";
				$result1 = mysqli_query($con , $query1);
				if(mysqli_num_rows($result1) == 0 ) {
					
					 @$code = rand();
					 $_SESSION['code']= $code;
					 $to = $email;
					 $subject = "BullsEye2 Email Verification";
					 $message = "<b>Your Verification Code is.</b>";
					 $message .= "<h1>".$code."</h1>";
					 $header = "From:verify@bullseye2.com \r\n";
					 $header .= "MIME-Version: 1.0\r\n";
					 $header .= "Content-type: text/html\r\n";
					 $retval = mail ($to,$subject,$message,$header);
					 if( $retval == true ) {
						echo "Email sent successfully...";
					 }else {
						echo "Email could not be sent...";
					 }
					 z:
				
					 ?>
					 <div class="container">
					 	<center><p style="font-size:230%; background-color:#5f5f5f; color:#ffffff;">Email Varification</p></center>
						 
						 <?php
						 	$_SESSION['upass']= $pass;
						 	$_SESSION['uemail']= $email;
						 	$_SESSION['uname']= $name;
						 	$_SESSION['ugender']= $gender;
						 ?>
						 <form>
							 <input type="text" name="code" placeholder="Enter Code Here..." required/>
							 <input type="submit" value="Submit" name = "submit"/>
						 </form>
					</div>
					 <?php
					 
				}else{
				    
				    header('location: user_log.php?error="Email alredy exist !"');
				}
				
			
			}
			
			else if (!empty($_GET['submit'])){
				unset($_GET['submit']);
				if($_SESSION['code'] == $_GET['code']){
				$name=$_SESSION['uname'];
				$gender=$_SESSION['ugender'];
				$email=$_SESSION['uemail'];
				$pass=$_SESSION['upass'];
				$query = "INSERT INTO `user`(`name`, `gender` ,`points`, `currrent_level`, `email`, `password`) VALUES ('$name','$gender','0','1','$email','$pass');";
				mysqli_query($con , $query);
				unset($_SESSION['uname']);
				unset($_SESSION['ugender']);
				unset($_SESSION['uemail']);
				unset($_SESSION['upass']);
				goto b;
				}
				else
				{
					echo '<center><p style="font-size:200%; color:darkorange;">The Code You Have Entered is Incorrect please enter again !</p></center>';
					goto z;
				}
			}
			
		else {
			header('location: user_log.php?error="Some error occure ! login Again"');
			}
		?>
	</body>
</html>
