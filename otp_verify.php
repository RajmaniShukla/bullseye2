<?php
	ob_start();
	session_start();
	include('db/conn.php');
	
	if($_SESSION['code'] == $_POST['code']){
		$query = "INSERT INTO `user`(`name`, `gender` ,`points`, `currrent_level`, `email`, `password`) VALUES ('$name','$gender','0','1','$email','$pass');";
		if(mysqli_query($con , $query)){
			header('location: back_work.php?work="login"');
		}else{
			header('location: back_work.php?error="Some Error Occure Please Try Again! "');
		}
	}
	else
	{
		header('location: back_work.php?error="The Code You Have Entered is Incorrect please enter again "');
	}
?>