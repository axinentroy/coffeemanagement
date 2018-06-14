<?php
	session_start();
	$id=$_GET["id"];
	unset($_SESSION['cart'][$id]);
	$tt=0;
	include_once("../com.php");
	db_connect();
	$mysql="Select * From menu Where MaMon=$id";
	$query=mysqli_query($conn,$mysql);
	foreach ($_SESSION["cart"] as $key => $value)
	{
		$mysql="Select * From menu Where MaMon=$key";
		$query=mysqli_query($conn,$mysql);
		$row=mysqli_fetch_array($query);
		$tt=$tt+$value*$row["Gia"];
	}
	//$sl=count($_SESSION["cart"]);
	//$mang = array($tt,$sl);
	//$in=json_encode($mang);
	//echo $in;
	echo $tt;
?>
