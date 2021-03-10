<?php
	include('../db/conn.php');
	session_start();
	echo @$_SESSION['rank'];
?>