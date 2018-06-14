<?php
	ob_start();
	session_start();
	$mon=$_GET["mon"];
	$day=$_GET["day"];
	unset($_SESSION["item"][$mon]);
	header("location:http://localhost:8888/cafe/index/nv.php?pape=thembl#showTG");
?>