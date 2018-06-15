<?php 
	include_once("../com.php");
	db_connect();
	$where="TrangThai='HoaDon'";
	if(isset($_GET["submitTim"]))
	{
		
		if(!empty($_GET["inputTim"]))
		{
			$tim=$_GET["inputTim"];
			$where .= " AND NgayLap LIKE '%$tim%' OR TriGia LIKE '%$tim%' OR MaKM LIKE '%$tim%' ";
		}
	}
	$mysql="Select * from phieugoi where $where";
	$query=mysqli_query($conn,$mysql);
	
?>
	<div id="hoadon">
		<div class="container">
			<div id="hd-tittle">
				<h1>DANH SÁCH HOÁ ĐƠN</h1>
			</div>
			<hr>
			<form method="get">
				<div class="row">
					<input type="hidden" name="pape" value="hoadon">
					<div class="col-sm-4">
						<input type="text" name="inputTim" class="form-control search" placeholder="Tìm kiếm" required>
					</div>
					<div class="col-sm-1">
						<button type="submit" name="submitTim" class="btn  btn-color">Tìm</button>
					</div>
				</div>
			</form>
			<div class="col-sm-12 ds-hd">
				<table class="table table-hover">
					<tr>
						<td class="tittle-table">Mã Hoá Đơn</td>
						<td class="tittle-table">Mã Khuyến Mãi</td>
						<td class="tittle-table">Ngày Lập</td>
						<td class="tittle-table">Trị Giá</td>
					</tr>
			<?php 
				while($result=mysqli_fetch_array($query))
				{
			?>
					<tr>
						<td><?php echo $result["MaPG"]; ?></td>
						<td><?php echo $result["MaKM"];?></td>
						<td><?php echo $result["NgayLap"]; ?></td>
						<td><?php echo $result["TriGia"].".000 VND";?></td>
					</tr>
			<?php
				}
			?>
				</table>
			</div>
		</div>
	</div><!-- end biên lai--->
	