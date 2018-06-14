<?php
	include("../com.php");
	db_connect();
	
	$bd=$_POST["inputBD"];
	$kt=$_POST["inputKT"];
?>
<style type="text/css" media="print">
	#buttonIn{
		display:none;
	}
	#inputBD,#inputKT{
		width:150px;
		margin-bottom:15px; 
		vertical-align: middle;
		
	}
	label{
		float:left;
		margin-right:10px;
		margin-bottom:10px;
		line-height:30px;
	}
	.inputTT{
		width:150px;
	}
	#footer{
		display:none;
	}
	#submitTK{
		display:none; 
	}
}
</style>
<script type="text/javascript"> 
	function intk(){
		window.print();
		window.close();
	}
	function ktra()
	{
		var bd=document.getElementById("inputBD").value;
		var	kt=document.getElementById("inputKT").value;
		
		if(bd>kt)
		{
			document.getElementById("showLoi").innerHTML = "Vui lòng chọn lại ngày kết thúc!";
			document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			document.getElementById("showLoi").style.marginBottom="20px";
			return false;
		}
		if(bd=="")
		{
			document.getElementById("showLoi").innerHTML = "Vui lòng chọn ngày bắt đầu!";
			document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			document.getElementById("showLoi").style.marginBottom="20px";
			return false;
		}
		if(bd=="")
		{
			document.getElementById("showLoi").innerHTML = "Vui lòng chọn ngày kết thúc!";
			document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			document.getElementById("showLoi").style.marginBottom="20px";
			return false;
		}
		return true;
	}
</script>
<div id="content">
	<div class="container">
		<form method="post">
		<div class="row">
			<div class="col-sm-6 title ">
				<h1>THỐNG KÊ DOANH THU</h1>
				<hr>
			</div>
			<div class="col-sm-offset-2 col-sm-2" id="buttonIn">
				<button type="submit" name="submitIn" onclick="intk();" class="btn  btn-color"><img src="http://imageshack.com/a/img924/669/pNY1FN.png" alt="" />In thống kê</button>
			</div>
		</div>
		<div class="row">
				<div class=" col-sm-offset-2 col-sm-4" id="showLoi">
				</div>
			</div>
		<div class="row">
			<label class="col-sm-1 control-label">Ngày bắt đầu</label>
			<div class="col-sm-2"><input type="date" class="form-control" id="inputBD" name="inputBD" value="<?php echo $bd; ?>" placeholder="Ngày bắt đầu"></div>
			<label class="col-sm-1 control-label">Ngày kết thúc</label>
			<div class="col-sm-2"><input type="date" class="form-control" id="inputKT" value="<?php echo $kt; ?>" name="inputKT"  placeholder="Ngày kết thúc"></div>
			<div class="co-sm-2"><input type="submit" name="submitTK" onclick ="return ktra()" id ="submitTK" class="btn  btn-color" value="Thống kê"></div>
		</div>
		<h3>Thống kê đồ uống</h3>
		<div class="row form">
				<div class="col-sm-offset-1 col-sm-4 ">
					<table id="showTable" class="table table-hover" name="showTable">
						<tr>
							
							<td class="title-table">STT</td>
							<td class="title-table">Tên</td>
							<td class="title-table">Giá</td>
							<td class="title-table">Số lượng</td>  
							<td class="title-table">Thành tiền</td>
						</tr>
<?php 
$tong=0;

if(isset($_POST["submitTK"]))
{
	$bd=$_POST["inputBD"];
	$kt=$_POST["inputKT"];
	$sql_du="Select ct.MaMon,Sum(SoLuong) AS sl From menu du,phieugoi pg ,ctphieugoi ct Where pg.MaPG=ct.MaPG And du.MaMon=ct.MaMon And pg.NgayLap>='$bd' And pg.NgayLap<='$kt' Group by ct.MaMon ";
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
			<div class="col-sm-1"><input type="text"  class="form-control inputTT" value="<?php echo $tong;?>" placeholder="Tổng tiền"></div>
		</div>
	</div>
</div>