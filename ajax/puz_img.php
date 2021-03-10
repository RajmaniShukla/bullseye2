<?php
	include('../db/conn.php');
	session_start();
	$uid = @$_SESSION['email'];
	$uquery = "SELECT * FROM `user` WHERE email = '$uid';";
	$uresult = mysqli_query($con , $uquery );
	$urow = mysqli_fetch_assoc($uresult);
	$query2 = "SELECT * FROM `puzzel` WHERE ID = '".$urow['currrent_level']."';";
	$result2 = mysqli_query($con,$query2);
	$row = mysqli_fetch_assoc($result2);
	echo $row["img_src"];
?>