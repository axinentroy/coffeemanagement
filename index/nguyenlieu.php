<?php 
	include_once("../com.php");
	db_connect();
	if(isset($_GET["submitTim"]))
	{
		
		if(!empty($_GET["inputTim"]))
		{
			$tim=$_GET["inputTim"];
			$where = "DonViTinh LIKE '%$tim%' OR SoLuong LIKE '%$tim%' OR TenNL LIKE '%$tim%' OR DonGia LIKE '%$tim%' ";
			$mysql="Select * from nguyenlieu where $where";
		}
	}
	else{
	$mysql="Select * from nguyenlieu";
	}
	$query=mysqli_query($conn,$mysql);
	
?>
	<div id="nguyenlieu">
		<div class="container">
			<div id="nl-tittle">
				<h1>NGUYÊN LIỆU CÒN TRONG KHO</h1>
			</div>
			<hr>
			<form method="get">
				<div class="row">
					<input type="hidden" name="pape" value="nguyenlieu">
					<div class="col-sm-4">
						<input type="text" class="form-control search" name="inputTim" placeholder="Tìm kiếm" required>
					</div>
					<div class="col-sm-1">
						<button type="submit"  name="submitTim" class="btn  btn-color">Tìm</button>
					</div>
					<div class="pull-right">
						<a href="nv.php?pape=nhaphang"><button type="button" class="btn  btn-color">Nhập hàng</button></a>
						<a href="nv.php?pape=xuathang"><button type="button" class="btn  btn-color">Xuất hàng</button></a>
					</div>
				</div>
			</form>
			<div class="col-sm-12 ds-nl">
				<table class="table table-hover">
					<tr>
						<td class="tittle-table" >Mã Nguyên Liệu</td>
						<td class="tittle-table">Tên Nguyên Liệu</td>
						<td class="tittle-table">Giá</td>
						<td class="tittle-table">Số Lượng</td>
					</tr>
		<?php 
				while($result=mysqli_fetch_array($query))
				{
		?>
					<tr>
						<td><?php echo $result["MaNL"]; ?></td>
						<td><?php echo $result["TenNL"]; ?></td>
						<td><?php echo $result["DonGia"].".000 VNĐ/".$result["DonViTinh"]; ?></td>
						<td><?php echo $result["SoLuong"]." ".$result["DonViTinh"]; ?></td>
					</tr>
		<?php 
				}
		?>

				</table>
			</div>
		</div>
	</div><!-- end biên lai--->
	
