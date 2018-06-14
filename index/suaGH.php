<?php
	session_start();
	$id=$_GET["id"];
	$sl=$_GET["sl"];
	$_SESSION["cart"][$id]=$sl;
	$tt=0;
	include_once("../com.php");
	db_connect();
	foreach ($_SESSION["cart"] as $key => $value)
	{
		
		$mysql="Select * From menu Where MaMon=$key";
		$query=mysqli_query($conn,$mysql);
		$row=mysqli_fetch_array($query);
		$tt=$tt+$value*$row["Gia"];
	}
	echo $tt;
?>