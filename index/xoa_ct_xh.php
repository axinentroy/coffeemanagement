<?php
	ob_start();
	session_start();
	$nl=$_GET["nl"];
	echo $nl;
	unset($_SESSION["nl"][$nl]);
	header("location:http://localhost:8888/cafe/index/nv.php?pape=xuathang#dsNL");
?>