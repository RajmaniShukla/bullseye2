<?php
	ob_start();
	session_start();
	if(isset($_SESSION['email'])){
		header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
    <head>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-6961308232874424",
    enable_page_level_ads: true
  });
</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="google-site-verification" content="xCnPMn-KXHVpdQ0RYyni-djhlDPxp9AAGK6HAnBMK-Q" />
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <title>BULLS EYE 2.0 | Login | Register</title>
		<link rel="stylesheet" href="style/main.css">
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon" />
	    <meta name="description" content="An interactive getting started guide for Brackets.">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$("#login").click(function(){
					$(".reg").hide();
					$(".log").show();
				});
				$("#register").click(function(){
					$(".reg").show();
					$(".log").hide();
				});
			});
			
			function Mail(req,str) {
			  var xhttp;
			  if (str.length == 0) { 
				document.getElementById("txtHint").innerHTML = "";
				return;
			  }
			  xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(req == 'log'){
						document.getElementById("txtHint").innerHTML = this.responseText;
						if(this.responseText == 'User Does Not Exist')
							$("input[type=submit]").prop("disabled", true);
						else
							$("input[type=submit]").prop("disabled", false);
				  		}
					else{
						document.getElementById("txtHint1").innerHTML = this.responseText;
						if(this.responseText == 'Already Exist')
							$("input[type=submit]").prop("disabled", true);
						else
							$("input[type=submit]").prop("disabled", false);
						}
				}
			  };
			  xhttp.open("GET", "getmail.php?req="+req+"&text="+str, true);
			  xhttp.send();   
			}
		</script>
    </head>
    <body>
		<div class="header"><center><img src="bullseye.png" style="border:none;"></center></div>
		<div class="container">
			<table align="center" width="100%" style="    border-spacing: 0px;">
				<tr class="tab1">
					<th style="width:25%;"><button style="font-size:200%; " id="login">Login</button></th>
					<th><button style="font-size:200%;" id ="register">Register</button></th>
				</tr>
                <tr><td colspan="2"><center><p style="font-size:200%; color:darkorange;"><?php echo @$_GET["error"];?></p></center></td></tr>
				<form action="back_work.php?work='login'" method="post">
				<tr class="log">
					<td style="text-align :right;"><label for="uemail" style="font-size:200%;">Email:</label></td>
					<td><input type="email" name="uemail" placeholder="Your Email ID..." onkeyup="Mail('log',this.value)" value="<?php if(isset($_COOKIE["uemail"])) { echo $_COOKIE["uemail"]; } ?>" required ><br><span id="txtHint"></span></td>
				</tr>
				<tr class="log">
					<td style="text-align :right;"><label for="upass" style="font-size:200%;">Password:</label></td>
					<td><input type="password" name="upass" placeholder="Your Password.." value="<?php if(isset($_COOKIE["upass"])) { echo $_COOKIE["upass"]; } ?>" required></td>
				</tr>
				<tr class="log">
					<td></td>
					<td><input type="checkbox" name="remember" <?php if(isset($_COOKIE["uemail"])) { ?> checked <?php } ?> />Remember Me.</td>
				</tr>
				<tr class="log">
					<td></td>
					<td><input type="submit" value="Login" name="login" ></td>
				</tr>
			  </form>
			  <tr class="log">
					<td></td>
					<td><a href="forgotPassword.php" style="text-decoration:none;">Forgot password?</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="help.php" style="text-decoration:none;">Need Help?</a></td>
				</tr>
			  
			  <form action="back_work.php?work='register'" method="post">
			  	<tr style="display:none;" class="reg">
					<td style="text-align :right;"><label for="uname" style="font-size:200%;">Name:</label></td>
					<td><input type="text" name="uname" placeholder="Your name..." required></td>
				</tr>
				<tr style="display:none;" class="reg">
					<td style="text-align :right;"><label for="uemail" style="font-size:200%;">Email:</label></td>
					<td><input type="email" name="uemail" placeholder="Your Email ID..." onkeyup="Mail('reg',this.value)" required><br><span id="txtHint1"></span></td>
				</tr>
				<tr class="reg" style="display:none;">
                 	<td style="text-align :right;"><label style="font-size:200%;">Male:</label></td>
				    <td><input  type="radio" name="gender" value="male" checked style="height: 30px;width: 30px;cursor: pointer;"></td>
				</tr>
				<tr class="reg" style="display:none;">
				    <td style="text-align :right;"><label style="font-size:200%;">Female:</label></td>
                    <td><input  type="radio" name="gender" value="female" style="height: 30px;width: 30px;cursor: pointer;"></td>
				</tr>
				<tr style="display:none;" class="reg">
					<td style="text-align :right;"><label for="upass" style="font-size:200%;">Password:</label></td>
					<td><input type="password" name="upass" placeholder="Your Password.." required></td>
				</tr>
				<tr class="reg" style="display:none;">
					<td></td>
					<td><input type="checkbox" name="remember" <?php if(isset($_COOKIE["uemail"])) { ?> checked <?php } ?> />Remember Me.</td>
				</tr>
				<tr style="display:none;" class="reg">
					<td></td>
					<td><input type="submit" value="Submit" ></td>
				</tr>
				
			  </form>
			</table>
			
        </div>
    </body>
</html>