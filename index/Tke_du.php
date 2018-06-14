<?php
	include("../com.php");
	db_connect();
	
	
?>
<div id="content">
	<div class="container">
		<form method="post">
		<div class="row">
			<div class="col-sm-6 title ">
				<h1>THỐNG KÊ DOANH THU</h1>
				<hr>
			</div>
			<div class="col-sm-offset-2 col-sm-2">
				<button type="submit" name="submitIn" class="btn  btn-color"><img src="http://imageshack.com/a/img924/669/pNY1FN.png" alt="" />In thống kê</button>
			</div>
		</div>
		<div class="row">
			<label class="col-sm-1 control-label">Ngày bắt đầu</label>
			<div class="col-sm-2"><input type="date" class="form-control" name="inputBD" placeholder="Ngày bắt đầu"></div>
			<label class="col-sm-1 control-label">Ngày kết thúc</label>
			<div class="col-sm-2"><input type="date" class="form-control" name="inputKT"  placeholder="Ngày kết thúc"></div>
			<div class="co-sm-2"><input type="submit" name="submitTK" class="btn  btn-color" value="Thống kê"></div>
		</div>
		<h3>Thống kê đồ uống</h3>
		<div class="row form">
				<div class="col-sm-offset-1 col-sm-4 ">
					<table id="showTable" class="table table-hover" name="showTable">
						<tr>
							
							<td class="title-table">STT</td>
							<td class="title-table">Tên</td>
							<td class="title-table">Giá</td>
							<td class="title-table">SL</td>
							<td class="title-table">Thành tiền</td>
						</tr>
<?php 
$tong=0;

if(isset($_POST["submitTK"]))
{
	$bd=$_POST["inputBD"];
	$kt=$_POST["inputKT"];
	$sql_du="Select ct.MaMon,Count(SoLuong) AS sl From menu du,phieugoi pg ,ctphieugoi ct Where pg.MaPG=ct.MaPG And du.MaMon=ct.MaMon And pg.NgayLap>='$bd' And pg.NgayLap<='$kt' Group by ct.MaMon ";
    $query_du=mysqli_query($conn,$sql_du);
	if(mysqli_num_rows($query_du)>0)
	{
		while($row_du=mysqli_fetch_array($query_du))
		{
			$stt=$stt+1;
			$id=$row_du['MaMon'];
			$sql_ct="Select * From menu Where MaMon=$id";
			$query_ct=mysqli_query($conn,$sql_ct);
			$row_ct=mysqli_fetch_array($query_ct);
			$tong=$tong+$row_du["sl"]*$row_ct["Gia"];
?>
						<tr>
							<td><?php echo $stt; ?></td>
							<td><?php echo $row_ct["TenMon"];?></td>
							<td><?php echo $row_ct["Gia"]; ?></td>
							<td><?php echo $row_du["sl"]; ?></td>
							<td><?php echo $row_du["sl"]*$row_ct["Gia"]; ?></td>
						</tr>
<?php
		}
	}
}
?>
					</table>
				</div>
		</div>
		<div class="row">
			<label class="col-sm-offset-3 col-sm-1 control-label">Tổng tiền</label>
			<div class="col-sm-1"><input type="text" class="form-control" value="<?php echo $tong;?>" placeholder="Tổng tiền"></div>
		</div>
		<h3>Thống kê nhập hàng</h3>
<?php
	
?>
		<div class="row form">
				<div class="col-sm-offset-1 col-sm-4 ">
					<table id="showTable" class="table table-hover" name="showTable">
						<tr>
							
							<td class="title-table">STT</td>
							<td class="title-table">Tên NL</td>
							<td class="title-table">Giá</td>
							<td class="title-table">SL</td>
							<td class="title-table">Thành tiền</td>
						</tr>
<?php
$tong_nh=0;
if(isset($_POST["submitTK"]))
{
	$bd=$_POST["inputBD"];
	$kt=$_POST["inputKT"];
	$sql_nh="Select MaNL,Count(SoLuong)As sl From phieunhap pn,ctphieunhap ct Where pn.MaPN=ct.MaPN And NgayLap>='$bd' And NgayLap <= '$kt' Group by MaNL";
	$query_nh=mysqli_query($conn,$sql_nh);
	$tt=0;
	if(mysqli_num_rows($query_du)>0)
	{
		while($row_nh=mysqli_fetch_array($query_nh))
		{	
			$id=$row_nh["MaNL"];		
			$tt=$tt+1;
			$sql_nl="Select * From nguyenlieu Where MaNL=$id";
			$query_nl=mysqli_query($conn,$sql_nl);
			$row_nl=mysqli_fetch_array($query_nl);
			$tong_nh=$tong_nh+$row_nl["DonGia"]*$row_nh["sl"];
?>
						<tr>
							<td><?php echo $tt; ?></td>
							<td><?php echo $row_nl["TenNL"]; ?></td>
							<td><?php echo $row_nl["DonGia"]; ?></td>
							<td><?php echo $row_nh["sl"]; ?></td>
							<td><?php echo $row_nh["sl"]*$row_nl["DonGia"];?></td>
						</tr>
<?php 
		
		}
	}
}
?>
					</table>
				</div>
		</div>
		<div class="row">
			<label class="col-sm-offset-3 col-sm-1 control-label">Tổng tiền</label>
			<div class="col-sm-1"><input type="text" class="form-control" value="<?php echo $tong_nh;?>" placeholder="Tổng tiền"></div>
		</div>				
	</form>
	</div>
</div>