<?php
	session_start();
	$id=$_GET["id"];
	include("../com.php");
	
	
	
?>
<?php 
	
	if(!isset($_GET["xoa"]))
	{
		db_connect();
		$sql="Select * From ctphieugoi Where MaPG=$id";
		$query=mysqli_query($conn,$sql);
		while($row=mysqli_fetch_array($query))
		{
			$_SESSION["bl"][$row["MaMon"]]=$row["SoLuong"];
		}
	}
	
	
?>
	<div id="con">
		<div class="container">
			<div class="row ">
			    <div class="col-sm-6 title">
				<h1>SỬA BIÊN LAI</h4>
			    </div>
			</div>
			<hr>
			<div class="row">
				<div class=" col-sm-offset-2 col-sm-4" id="showLoi">
				</div>
			</div>
		<form method="post">
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Mã Biên Lai</label>
					<div class="col-sm-4">
					  <input type="text" disabled="disabled" class="form-control" id="inputMa" placeholder="Mã biên lai" 
						value="<?php echo $id; ?>">
					</div>
				</div>
			</div>

			<div class="row form">
				<div class="form-group">
					<label class="col-sm-2 control-label">Đồ uống</label>
					<div class="col-sm-2">
						<select name="dsDU" class="form-control">
<?php 
	db_connect();
	$mysql_du="Select * From menu";
	$query_du =mysqli_query($conn,$mysql_du);
	while($resulf_du=mysqli_fetch_array($query_du))
	{
?>
						  <option value="<?php echo $resulf_du['MaMon'];?>"><?php echo $resulf_du["TenMon"]; ?> </option>
<?php
	}
	
?>
						</select>
					</div>
					<div class="col-sm-1">
						<input type="text" class="form-control" name="inputSL" onclick="resetLoi()" id="inputSL" placeholder="SL">
					</div>	
					<div class="col-sm-1">
						<button type="submit" name="submitThem" onclick ="return ktra()" class="btn  btn-color">Thêm</button>
					</div>
				</div>
			</div>
<?php 
	if(isset($_POST["submitThem"]))
	{
		$du=$_POST["dsDU"];
		$sl=$_POST["inputSL"];
		if(isset($_SESSION["bl"][$du]))
		{
			
			$new=$_SESSION["bl"][$du]+$sl;
			
		}
		else
		{
			
			$new=$sl;
		}
		
		$_SESSION["bl"][$du]=$new;
		header("location:http://localhost:8888/cafe/index/nv.php?pape=suabl&id=$id#inputMa");
	}

?> 

			<div class="row form">
				<div class="col-sm-offset-2 col-sm-4 ">
					<table class="table table-hover">
						<tr>
							<td class="title-table">Tên nước</td>
							<td class="title-table">Số lượng</td>
							<td class="title-table">Giá</td>
							<td class="title-table">Xoá</td>
						</tr>


<?php 
$tong=0;
if(isset($_SESSION["bl"]))
{
	foreach($_SESSION["bl"] as $key => $value)
	{
			
			$sql_ct="Select * From menu Where MaMon=$key";
			$query_ct=mysqli_query($conn,$sql_ct);
			$row_ct=mysqli_fetch_array($query_ct);
			$tong=$tong+$row_ct["Gia"]*$value;
?> 
						<tr>
							<td><?php echo $row_ct["TenMon"]; ?></td>
							<td><?php echo $value; ?></td>
							<td><?php echo $row_ct["Gia"]*$value; ?></td>
							
							<td><a href="xoactbl.php?mon=<?php echo $key;?>&bl=<?php echo $id; ?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" >
								<img  data-toggle="tooltip" data-placement="bottom" title="Xoá"
								src="http://imageshack.com/a/img922/3700/uYzTxM.png"></a></td>
						</tr>
<?php 
	}
}
	$day=date("Y-m-d");
	$sql_km="Select MaKM,Max(TienGiam) As km  From khuyenmai Where NgayKetThuc >= '$day' AND NgayBatDau <= '$day' And TriGiaApDung <= $tong";
	$query_km=mysqli_query($conn,$sql_km);
	$kq_km=mysqli_fetch_array($query_km);
	$ma_km=$kq_km["MaKM"];
	$thanhtoan=(int)$tong -(int)$kq_km['km'];
	
	

?>
					
					</table>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Tổng tiền</label>
					<div class="col-sm-4">
					  <input type="text" class="form-control" id="inputTT" value="<?php echo $tong; ?>.000 VNĐ"placeholder>
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Tiền giảm (Khuyến mãi)</label>
					<div class="col-sm-4">
					  <input type="text" name="inputKM" class="form-control" value="<?php echo $kq_km["km"]; ?>.000 VNĐ" id="inputKM" placeholder="Tiền được giảm">
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Thanh toán</label>
					<div class="col-sm-4">
					  <input type="text" name="inputTien" class="form-control"  value="<?php echo $thanhtoan; ?>.000 VNĐ" id="inputTien" placeholder="Tổng tiền thanh toán">
					</div>
				</div>
			</div>
			<div class="row form ">
				<div class="col-sm-offset-2 col-sm-2">
					<a href="http://localhost:8888/cafe/index/nv.php?pape=bienlai"><button type="button" class="btn  btn-color">Huỷ</button></a>
				</div>
				<div class="col-sm-2">
					<button type="submit" name="submitSua" onclick="return confirm('Bạn có chắc chắn muốn sửa?')" class="btn  btn-color">Sửa Mới</button>
				</div>
			</div>
		</div>
	</form>
<?php 
	if(isset($_POST["submitSua"]))
	{
		
		$sql_delete="Delete From ctphieugoi Where MaPG=$id";
		db_execute($sql_delete);
		foreach($_SESSION["bl"] as $key => $value)
		{
			
			$sql_change="Insert Into ctphieugoi(MaPG,MaMon,SoLuong) VALUES('$id','$key','$value')";
			db_execute($sql_change);
			unset($_SESSION['bl']);
			
		}
		$sql_update="UPDATE phieugoi SET TriGia=$thanhtoan,MaKM=$ma_km WHERE MaPG=$id";
		db_execute($sql_update);
		header("location:nv.php?pape=bienlai");
	}
	
?>

	</div><!--end content-->
<script type="text/javascript">
	function resetLoi(){
		 document.getElementById("showLoi").style.height="0px";
		 document.getElementById("showLoi").style.background="white";
		 document.getElementById("showLoi").innerHTML="";
		 
	 }
	function ktra(){
		var sl=document.getElementById("inputSL").value;
		if(sl<0||sl=='')
		{
		  document.getElementById("showLoi").innerHTML="Nhập lại số lượng đồ uống!";
		  document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			return false;
		}
		return true;
	}
	window.onload = function(){
		
		var days= new Date();
		var date=days.getDate();
		d=date;
		if(date<10)
		{
			d="0"+date;
		}
		var months=new Array("01","02","03","04","05","06","07","08","09","10","11","12");
		var month=days.getMonth();
		
		var year=days.getFullYear();
		
		
		document.getElementById("showTG").value=year+"-"+months[month]+"-"+d;
	}
</script>	
	