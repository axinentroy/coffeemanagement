<?php
	session_start();
	ob_start();
	$mon=$_GET["mon"];
	$bl=$_GET["bl"];
	unset($_SESSION["bl"][$mon]);
	//include_once("../com.php");
	//$sql="Delete From ctphieugoi Where MaMon=$mon And MaPG=$bl";
	//db_execute($sql);
	
	header("location:nv.php?pape=suabl&id=$bl&xoa=1#inputSL");
?>