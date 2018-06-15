<?php
	include("../com.php");
	db_connect();
	$mysql="select * from khuyenmai";
	$query=mysqli_query($conn,$mysql);
	
?>
	<div id="nguyenlieu">
		<div class="container">
			<div id="nl-tittle">
				<h1>DANH SÁCH KHUYẾN MÃI</h1>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-4">
					<input type="text" class="form-control search" placeholder="Tìm kiếm">
				</div>
				<div class="col-sm-1">
					<button type="button" class="btn  btn-color">Tìm</button>
				</div>
				<div class="pull-right">
					<a href="nv.php?pape=themkhuyenmai"><button type="button" class="btn  btn-color">Thêm Khuyến Mãi</button></a>
				</div>
			</div>
			<div class="col-sm-12 ds-nl">
				<table class="table table-hover">
					<tr>
						<td class="tittle-table" >Mã Khuyến Mãi</td>
						<td class="tittle-table">Tên Khuyến Mãi</td>
						<td class="tittle-table">Trị Giá Áp Dụng</td>
						<td class="tittle-table">Tiền Giảm</td>
						<td class="tittle-table">Ngày Bắt Đầu</td>
						<td class="tittle-table">Ngày Kết Thúc</td>
						<td class="tittle-table">Sửa Khuyến Mãi</td>
						<td class="tittle-table">Xoá Khuyến Mãi</td>
					</tr>
			<?php
				while($result=mysqli_fetch_array($query))
				{
			?>
					<tr>
						<td><?php echo $result["MaKM"] ?></td>
						<td><?php echo $result["TenKM"] ?></td>
						<td><?php echo $result["TriGiaApDung"] ?></td>
						<td><?php echo $result["TienGiam"] ?></td>
						<td><?php echo $result["NgayBatDau"] ?></td>
						<td><?php echo $result["NgayKetThuc"] ?></td>
						<td><img data-toggle="tooltip" data-placement="bottom" title="Sửa" src="http://imageshack.com/a/img922/557/225SXm.png"></a></td>
						<td><img data-toggle="tooltip" data-placement="bottom" title="Xoá" src="http://imageshack.com/a/img922/3700/uYzTxM.png"></td>
					</tr>
			<?php
				}
				db_close();
			?>

				</table>
			</div>
		</div>
	</div><!-- end biên lai--->
	
