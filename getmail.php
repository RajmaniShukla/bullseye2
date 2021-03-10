<?php
    include('db/conn.php');
    $mail = $_GET['text'];
	$req = $_GET['req'];
    $query = "SELECT * FROM user WHERE  email like '$mail'";
    $result = mysqli_query($con,$query);
	if($req =="log"){
		if(mysqli_num_rows($result) > 0 ){
			echo "User Exist";
		}
		else{
			echo "User Does Not Exist";
		}
		
	}else if($req =="reg"){
		if(mysqli_num_rows($result) == 0 ){
			echo "Email Ready";
		}
		else{
			echo "Already Exist";
		}
	
	}
?>