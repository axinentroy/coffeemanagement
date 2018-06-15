<?php
	include_once("com.php");
	db_connect();
	$sql="Select * From menu Where MaLoaiMon=1 Limit 0,8";
	$query=mysqli_query($conn,$sql);
	$sql_t="Select * From menu Where MaLoaiMon=1";
	$query_t=mysqli_query($conn,$sql_t);
	$tong_sp=mysqli_num_rows($query_t);
?>
	<input type="hidden" value ="<?php echo $tong_sp ?>" id="tongsp"/>
	<div id="menu-du">
		<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul>
					<li><a href="index.php?pape=menu#bar">ĐỒ UỐNG LẠNH</a></li>
					<li><a href="index.php?pape=donong#bar">ĐỒ UỐNG NÓNG</a></li>
					<li><a href="index.php?pape=doan#bar">ĐỒ ĂN NHẸ</a>
				</ul>
			</div>
		</div>
		</div>
	</div><!-- end menu du-->
	
	<div class="container">
		<div id="menu-dl">
<?php
while($row=mysqli_fetch_array($query))
{
	$dem++;
	if($dem==1)
	{
		echo "<div class='row item-du'>";
	}
?>
	
			<div class="col-sm-3 dl-item">
				<div class="logo-oder"><a href="index/themGH.php?id=<?php echo $row["MaMon"]?>&loai=<?php echo $row["MaLoaiMon"]; ?>"><img src="http://imageshack.com/a/img924/3904/48Vl6z.png"></a></div>
				<div class="img-du"><a href="index/themGH.php?id=<?php echo $row["MaMon"]?>&loai=<?php echo $row["MaLoaiMon"]; ?>"><img class="img-responsive" src="hinh/<?php echo $row["HinhAnh"];?>"></a></div>
				<div class="title-du"><?php echo $row["TenMon"]; ?></div>
				<div class="price"><?php echo $row["Gia"];?><?php echo ".000 VND"; ?></div>
			</div>
<?php
	if($dem==4)
	{
		echo "</div>";
		$dem=0;
	}
}
?>
		</div>
		<div id="showThem">Xem Thêm</div>
		
	</div><!-- menu đồ lạnh -->
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript"> 
	var trang=1;
	var tongsp=$("#tongsp").val();
	var sotrang= Math.ceil(tongsp/8);
	if(trang==sotrang)
	{
		document.getElementById("showThem").style.display="none";
	}
	$(document).ready(function(){
		$("#showThem").click(function(){
			 trang=trang+1;
			$.get("index/showmenu.php",{loai:1,trang:trang},function(data){
				$("#menu-dl").append(data);
			});
			if(trang==sotrang)
			{
				document.getElementById("showThem").style.display="none";
			}
		});
	});
	
</script>
	