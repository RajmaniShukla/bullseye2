<?php
	include('../db/conn.php');
	session_start();
	$uid = @$_SESSION['email'];
	$uquery = "SELECT * FROM `user` WHERE email = '$uid';";
	$uresult = mysqli_query($con , $uquery );
	$urow = mysqli_fetch_assoc($uresult);
	echo $urow['currrent_level'];
?>