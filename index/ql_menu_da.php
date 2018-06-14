<?php
	$dem=0;
	$connect=mysqli_connect("localhost","root","");
	mysqli_select_db($connect,'cafe');
    
		mysqli_set_charset($connect,"utf8");
	$sql="Select * From menu Where MaLoaiMon='3'";
	$query=mysqli_query($connect,$sql);
?>
<div id="content">
	<div id="menu-du">
		<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<ul>
					<li><a href="nv.php?pape=ql-menu">ĐỒ UỐNG LẠNH</a></li>
					<li><a href="nv.php?pape=donong">ĐỒ UỐNG NÓNG</a></li>
					<li><a href="nv.php?pape=doan">ĐỒ ĂN NHẸ</a>
				</ul>	
				</div>
			</div>
		</div>
		<div class="container">
	
			<div class="pull-right">
				<a href="nv.php?pape=themDU"><button type="button" class="btn  btn-color">Thêm Đồ Uống</button></a>
			</div>

		</div>
	</div><!-- end menu du-->
	<div id="menu-dl">
		<div class="container">
		<?php
			while($row=mysqli_fetch_array($query))
			{
				$dem++;
				if($dem==1)
				{
					echo "<div class='row item-du'>";
				}
		?>
			
				<div class="col-sm-4 dl-item">
					<div class="img-dl"><img  class="img-responsive" src="../hinh/<?php echo $row["HinhAnh"];?>"></div>
					<div class="logo-oder"><a href="nv.php?pape=suaDU&loai=da&id=<?php echo $row["MaMon"] ?>"><img src="http://imageshack.com/a/img922/557/225SXm.png"></a></div>
					<div class="logo-delete"><a href="nv.php?pape=xoaDU&loai=da&id=<?php echo $row["MaMon"] ?>" onclick="return ktra()"><img  src="http://imageshack.com/a/img922/3700/uYzTxM.png"></a></div>
					<div class="title-dl"><?php echo $row["TenMon"]; ?></div>
					<div class="price"><?php echo $row["Gia"];?><?php echo ".000 VND"; ?></div>
				</div>
		<?php
				if($dem==3)
				{
					echo "</div>";
					$dem=0;
				}
			}
			
		?>
		</div>
	</div><!-- menu đồ lạnh -->
</div>
<script type="text/javascript">
	function ktra(){
		 var check=confirm("Bạn có chắc chắn muốn xoá!");
		 return check;
	}
</script>
	