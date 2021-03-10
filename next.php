<?php
	include('db/conn.php');
    $mail = $_GET['level'];
    $query = "SELECT * FROM user WHERE  email like '$mail'";
    $result = mysqli_query($con,$query);
    $u_row = mysqli_fetch_assoc($result);
    $level = $u_row['currrent_level'];
    $point = $u_row['points'];
	
    $sql="SELECT * FROM puzzel WHERE ID = '$level'";
    $result2 = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result2);
    $pt = $row['point'];
    $point = $point + $pt;
    $c_level = $level + 1;
    $query1 = "UPDATE user SET points= '$point', currrent_level= '$c_level'  WHERE email = '$mail'";
    $result = mysqli_query($con,$query1);
    $sql1="SELECT * FROM puzzel WHERE ID = '$c_level'";
    $result3 = mysqli_query($con,$sql1);
    $row = mysqli_fetch_assoc($result3);
    $img_src = $row['img_src'];
    mysqli_close($con);
    header("Location: index.php");
?>