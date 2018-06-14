<?php 
	ob_start();
	$id=$_GET["id"];
	include_once("../com.php");
	db_connect();
	$mysql_ct="Delete from ctphieugoi where MaPG=$id";
	mysql_query($conn,$mysql_ct);
	$mysql="Delete From phieugoi Where MaPG=$id";
	mysqli_query($conn,$mysql);
	header("location:nv.php?pape=bienlai");
	
?>