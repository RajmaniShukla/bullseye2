<?php
			ob_start();
			session_start();
			if(!isset($_SESSION['email'])){
				header("location:user_log.php");
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
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="google-site-verification" content="xCnPMn-KXHVpdQ0RYyni-djhlDPxp9AAGK6HAnBMK-Q" />
        <title>BULLS EYE 2.0</title>
		<link rel="stylesheet" href="style/main.css">
		<link rel="shortcut icon" href="img/logo.jpg" type="image/x-icon" />
        <meta name="description" content="An interactive getting started guide for Brackets.">
		<script src="javascript/encrypt.js"></script>
		<script>
			function checkans(con,id) {
		    	var input = SHA256(document.getElementById("ans").value.toLowerCase());
				if ( input == con){
					 	window.location.assign("next.php?level="+ id);
						alert('Correct answer');
				}else {
					alert('wrong answer');
				}
			}
		</script>
			<script>
			function ajax(){
				loadDoc('ajax/leader.php', leader);
				loadDoc('ajax/rank.php', rank);
				loadDoc('ajax/level.php', level);
				loadDoc('ajax/point.php', point);
			}
				function loadDoc(url, cFunction) {
				  var xhttp;
				  xhttp=new XMLHttpRequest();
				  xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					  cFunction(this);
					}
				  };
				  xhttp.open("GET", url, true);
				  xhttp.send();
				}
				function rank(xhttp) {
				  document.getElementById("rank").innerHTML = xhttp.responseText;
				  setInterval(loadDoc('ajax/rank.php', rank), 3000);
				}
				function leader(xhttp) {
				  document.getElementById("leadership").innerHTML = xhttp.responseText;
				  setInterval(loadDoc('ajax/leader.php', leader), 3101);
				}
				function level(xhttp) {
				  document.getElementById("level").innerHTML = xhttp.responseText;
				  setInterval(loadDoc('ajax/level.php', level), 3022);
				}
				function point(xhttp) {
				  document.getElementById("point").innerHTML = xhttp.responseText;
				  setInterval(loadDoc('ajax/point.php', point), 3053);
				}
				function img_load(src){
					var xhttp;
				   xhttp=new XMLHttpRequest();
				   xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					 //alert(this.responseText);
						if (src == this.responseText){
						 	img_load(src);
						}
						else{
							document.location.reload(true);
							//document.getElementById("puz_img").src = this.responseText;
							img_load(src);
						}
					}
				  };
				  xhttp.open("GET","ajax/puz_img.php", true);
				  xhttp.send();
				}
		</script>
    </head>
	
    <body onload ="" >
        <div class="header"><center><img src="bullseye.png" style="border:none;"></center></div>
        <?php include('db/conn.php'); ?>
        <div style="height:auto;">
		<?php
			$uid = @$_SESSION['email'];
			$uquery = "SELECT * FROM `user` WHERE email = '$uid';";
			$uresult = mysqli_query($con , $uquery );
			$urow = mysqli_fetch_assoc($uresult);
			$current_level = $urow['currrent_level'];
			$gender = $urow['gender'];
			if($gender == 'male'){
				$gen_src = "img/u_m.png";
			}
			else if($gender == 'female'){
				$gen_src = "img/u_f.png";
			}
		?>
		<div class="div3">
			<label style="display: block; font-size: 150%; font-family: monospace;color:#9c9c9c;"><b>Profile</b></label>
        	<div class="div31">
				<hr size="3px" color="#9c9c9c" style="margin: 0px;"/>
            	<div style="overflow: hidden;background-color:#1c72b9c9;color:#dadada;">
          			<img src="<?php echo $gen_src?>" style="float: left; margin: 10px; color: black; width: 50px; border-radius: 30px; border: 2px solid; padding: 0px;">
					<p style="font-size:18px; text-align: center; margin: 0px; font-weight: 800; "> <?php echo $urow['name']?> </p>
					<p> 
						<b> Level &#58; &nbsp; <label id="level"></label> </b>
                		<b style="float: right;padding-right: 10px;"> Points &#58; &nbsp; <label id="point"></label> </b>
           			<br/>         
						<b style="float:left;"> Rank &#58; <label id="rank"></label> </b> 
           			</p> 
						<a href="logout.php" >
							<input type="submit" value="log out" style="width: auto; font-size: 12px; box-shadow: 0px 2px 5px 0px #2b2b2b; background-color: red; color: #f9e1e1; padding: 5px 15px; margin: 8px 8px; border: none; border-radius: 4px; cursor: pointer; float: right;"></input>
						</a>
					</div>
						<div id="fb">
							<a href="https://www.facebook.com/bullseye.rrsimt" target="_blank"><img src="img/facebook.jpg" alt="Facebook Page" ></img></a>
						</div>
				</div>
            </div>
			<div class="div2">
				<label style="font-size:150%;font-family: monospace;color:#9c9c9c;box-shadow: inset 0px 0px 20px 0px #b5b5b5;"><b>Guess The IDEA</b></label>
				<hr size="3px" color="#9c9c9c" style="   margin: 0px;"/>
				<?php
					$query2 = "SELECT * FROM `puzzel` WHERE ID = '".$current_level."';";
					$result2 = mysqli_query($con,$query2);
					if(mysqli_num_rows($result2) > 0 ) {
						$row = mysqli_fetch_assoc($result2);
						$ID = $row["ID"] ;
						$img_src = $row["img_src"];
						$answer = $row["ans"];
						$pt = $row["point"];
					}
				?>
				<img src="<?php echo @$img_src ?>" onload="img_load('<?php echo @$img_src ?>')" alt="Puzzel" id="puz_img" height="auto" width="550px" style=" box-shadow: 4px 8px 35px 1px grey;">
				<input type="text" id="ans" name="answer" placeholder="Your Answer..." required />
				<input type="Submit" value="Submit" onClick="checkans('<?php echo hash('sha256' , $answer);?>','<?php echo @$uid?>');">
			</div>
			<!-- google ads sence -->
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<script>
				  (adsbygoogle = window.adsbygoogle || []).push({
				    google_ad_client: "ca-pub-6961308232874424",
				    enable_page_level_ads: true
				  });
				</script>
           	<div class="div1">
				<label style="font-size:150%;font-family: monospace;color:#9c9c9c;"><b>Leaderboard</b></label>
				<hr size="3px" color="#9c9c9c" style="   margin: 0px;"/>
                <div class="div11">
				 	<div id ='leadership' >	     
						<div class="loader"></div>
				 	</div>
                </div>
			</div>
        </div>
    <div class="footer"><center><p>&copy; Copyright&nbsp;2018</p></center></div>
    </body>
		 <script>window.onload = function(){ajax();}</script>
</html>