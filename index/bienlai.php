<?php 
	unset($_SESSION["item"]);
	unset($_SESSION['bl']);
	include_once("../com.php");
	db_connect();
	$where ="TrangThai='BienLai'";
	
?>
<?php
	if(isset($_GET["submitTim"]))
	{
		if(!empty($_GET["inputTim"]))
		{
			$tim=$_GET["inputTim"];
			$where .= "And NgayLap LIKE '%$tim%' OR TriGia LIKE '%$tim%' OR MaKM LIKE '%$tim%'";
		}
		
			
		
	}
	$sql="Select * From phieugoi where $where";
	$query=mysqli_query($conn,$sql);
?>
	<div id="bienlai">
		<div class="container">
			<div id="bl-tittle">
				<h1>DANH SÁCH BIÊN LAI</h1>
			</div>
			<hr>
			<form role="form" method="get">
				<input type="hidden" name="pape" value="bienlai">

				<div class="row">
					<div class="col-sm-4">
						<input type="text" class="form-control search" name="inputTim" placeholder="Tìm kiếm" required>
					</div>
					<div class="col-sm-1">
						<button type="submit" name="submitTim" class="btn-color btn">Tìm kiếm</button>
					</div>
					<div class="pull-right">
						<a href="nv.php?pape=thembl"><button type="button" name="submitThem" class="btn  btn-color">Thêm Biên Lai</button></a>
					</div>
				</div>
			</form>
			
			<div class="col-sm-12 ds-bl">
				<table class="table table-hover">
					<tr>
						<td class="tittle-table">Mã Biên Lai</td>
						<td class="tittle-table">Ngày</td>
						<td class="tittle-table">Mã Khuyến Mãi</td>
						<td class="tittle-table">Trị Giá</td>
						<td class="tittle-table">Họ Tên KH</td>
						<td class="tittle-table">Địa Chỉ</td>
						<td class="tittle-table">SĐT</td>
						<td class="tittle-table">Sửa</td>
						<td class="tittle-table">Xoá</td>
						<td class="tittle-table">Thanh toán</td>
					</tr>
			<?php
				while($resulf=mysqli_fetch_array($query))
				{
			?>
					<tr>
						<td> <?php echo $resulf["MaPG"] ?></td>
						<td><?php echo $resulf["NgayLap"]?></td>
						<td><?php echo $resulf["MaKM"] ?></td>
						<td><?php echo $resulf["TriGia"] ?>.000 VNĐ</td> 
						<td><?php echo $resulf["TenKH"] ?></td> 
						<td><?php echo $resulf["DiaChi"] ?></td> 
						<td><?php echo $resulf["SDT"] ?></td> 
						<td><a href="nv.php?pape=suabl&id=<?php echo $resulf['MaPG'] ?>" ><img data-toggle="tooltip" data-placement="bottom" title="Sửa" src="http://imageshack.com/a/img922/557/225SXm.png"></a></td>
						<td><a onclick="return confirm('Bạn có chắc chắn muốn xoá?')" href="nv.php?pape=xoabl&id=<?php echo $resulf['MaPG'] ?>"> <img  data-toggle="tooltip" data-placement="bottom" title="Xoá" src="http://imageshack.com/a/img922/3700/uYzTxM.png"></a></td>
						<td><a id="thanhtoan" target="_blank" onclick="return confirm('Bạn có chắc chắn muốn thanh toán?')" href="nv.php?pape=thanhtoan&id=<?php echo $resulf['MaPG'] ?>"><img  data-toggle="tooltip" data-placement="bottom" title="Thanh toán" src="http://imageshack.com/a/img923/6374/NZ1LYA.png"></a></td>
					</tr>
			<?php
				}
			?>
				</table>
			</div>
		</div>
	</div><!-- end biên lai--->
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#thanhtoan").click(function(){
			location.reload();
		});
	});
</script>

