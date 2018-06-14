<?php 
	$id=$_GET["id"];
	$loai=$_GET["loai"];
	echo $loai;
	include_once("../com.php");
	db_connect();
	$mysql="Delete From menu Where MaMon=$id";
	$query=mysqli_query($conn,$mysql);
	if($loai=="dn")
	{
		header("location:nv.php?pape=donong");
	}
	if($loai=="da")
	{
		header("location:nv.php?pape=doan");
	}
	if($loai=="dl")
	{
		header("location:nv.php?pape=ql-menu");
	}
?>