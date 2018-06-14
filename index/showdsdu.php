<?php
	$loai=$_GET["loai"];
	include("../com.php");
	db_connect();
	mysqli_set_charset($conn,"utf8");
	$sql_menu="Select * From menu Where MaLoaiMon=$loai";
	$query_menu=db_execute($sql_menu);
	while($row_menu=mysqli_fetch_array($query_menu))
	{
		echo '<option value="'.$row_menu["MaMon"].'">'.$row_menu['TenMon'].'</option>';
	}
?>
