<?php
	$loai=$_GET["loai"];
	$trang=$_GET["trang"];
	$soitem=$_GET["sotrang"];
	$tt=0;
	include_once("../com.php");
	db_connect();
	$start= ($trang-1)*$soitem;
	$sql_show="Select * From menu Where MaLoaiMon=$loai Limit $start ,$soitem";
	$query_show=mysqli_query($conn,$sql_show);
?>
	<?php
	while($row_show=mysqli_fetch_array($query_show))
	{
		$tt++;
		if($tt==1)
		{
			echo "<div class='row item-du'>";
		}
	?>
	
		<div class="col-sm-4 dl-item">
			<div class="logo-oder"><a href="themGH.php?id=<?php echo $row_show["MaMon"]?>&loai=<?php echo $row_show["MaLoaiMon"]; ?>"><img src="http://imageshack.com/a/img924/3904/48Vl6z.png"></a></div>
			<div class="img-du"><a href="themGH.php?id=<?php echo $row_show["MaMon"]?>&loai=<?php echo $row_show["MaLoaiMon"]; ?>"><img class="img-responsive" src="../hinh/<?php echo $row_show["HinhAnh"];?>"></a></div>
			<div class="title-du"><?php echo $row_show["TenMon"]; ?></div>
			<div class="price"><?php echo $row_show["Gia"];?><?php echo ".000 VND"; ?></div>
		</div>
	<?php
		if($tt==3)
		{
			echo "</div>";
			$tt=0;
		}
	}
	db_close();
	?>
	