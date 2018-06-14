<?php
	include_once("../com.php");
	db_connect();
	$sql="Select * From nguyenlieu";
	$query=mysqli_query($conn,$sql);
	
	
?>
<?php 
	if(isset($_POST["submitThem"]))
	{
		$nl=$_POST["inputNL"];
		$sl=$_POST["inputSL"];
		$new_sl;
		$sql_nl="Select * From nguyenlieu Where MaNL=$nl";
		$query_nl=mysqli_query($conn,$sql_nl);
		$row_nl=mysqli_fetch_array($query_nl);
		if($row_nl["SoLuong"] < $sl)
		{
			echo "<script>alert('Hàng trong kho không đủ để xuất hàng');</script>";
		}
		else
		{
			if(isset($_SESSION["nl"][$nl]))
			{
				$new_sl=$_SESSION["nl"][$nl]+$sl;
			}
			else
			{
				$new_sl=$sl;
			}
			$_SESSION["nl"][$nl]=$new_sl;
		}
	}
?>
	<div id="content">
		<div class="container">
			<form method="post">
			<div class="row ">
			    <div class="col-sm-6 title">
				<h1>NHẬP XUẤT HÀNG RA KHO</h4>
			    </div>
			</div>
			<hr>
			<div class="row">
				<div class="col-sm-offset-2 col-sm-4" id="showLoi">
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Mã Biên Lai</label>
					<div class="col-sm-4">
					  <input type="text" disabled="disabled" class="form-control" name="inputMa" id="inputMa" placeholder="Mã biên lai">
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label class="col-sm-2 control-label">Ngày lập</label>
					<div class="col-sm-4">
						<input type="text" class="form-control"  id="showDay" name="inputNgay">
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label class="col-sm-2 control-label">Nguyên liệu</label>
					<div class="col-sm-2">
						<select name="inputNL" id="inputNL" class="form-control">
						    <option value="0" >Chọn nguyên liệu</option> 
		<?php 
			while($row=mysqli_fetch_array($query))
			{
		?>
							<option value="<?php echo $row['MaNL'] ?>"><?php echo $row['TenNL'];?></option>
		<?php 
			}
		
		?>
						</select>
					</div>
					<div class="col-sm-1">
						<input type="number" class="form-control"  name="inputSL" id="inputSL" placeholder="SL">
					</div>	
					<div class="col-sm-1">
						<input type="submit" name="submitThem" class="btn  btn-color" onclick="return check()" value="Thêm">
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-offset-2 col-sm-4 ">
					<table class="table table-hover">
						<tr>
							<td class="title-table">Tên nước</td>
							<td class="title-table">Số lượng</td>
							<td class="title-table">Xoá</td>
						</tr>
<?php 
	$tt=0;
	if(count($_SESSION["nl"])>0)
	{
		foreach($_SESSION["nl"] as $key => $value )
		{
			$sql_ten="Select * From nguyenlieu Where MaNL=$key";
			$query_ten=mysqli_query($conn,$sql_ten);
			$row_ten=mysqli_fetch_array($query_ten);
			$tt=$tt+$value*$row_ten["DonGia"];
?>
		
						<tr> 
							<td><?php echo $row_ten["TenNL"]; ?></td>
							<td> <?php echo $value."/".$row_ten["DonViTinh"]; ?></td>
							<td><a href="xoa_ct_xh.php?nl=<?php echo $key;?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" >
								<img  data-toggle="tooltip" data-placement="bottom" title="Xoá"
								src="../hinh/grad23.png"></a></td>
						</tr>
<?php 
		}
	}
?>
					</table>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Tổng tiền</label>
					<div class="col-sm-4">
					  <input type="text" class="form-control"  value="<?php echo $tt.'.000 VNĐ'; ?>" id="inputTT" placeholder="Tổng tiền">
					</div>
				</div>
			</div>
			<div class="row form ">
				<div class="col-sm-offset-2 col-sm-2">
					<button type="submit" name="submitHuy" class="btn  btn-color">Huỷ Phiếu Xuất</button>
				</div>
				<div class="col-sm-2">
					<button type="submit" name="submitLap" class="btn  btn-color">Lập Phiếu Xuất</button>
				</div>
			</div>
		</div>
	</form>
	</div><!--end content-->
<?php 
	if(isset($_POST["submitHuy"]))
	{
		unset($_SESSION["nl"]);
		header("location:http://localhost:8888/cafe/index/nv.php?pape=nguyenlieu");
	}
	
	if(isset($_POST["submitLap"]))
	{
		if(isset($_SESSION["nl"]))
		{
			$ngay=date("Y-m-d");
			
			$sql_pn="Insert Into phieuxuat(NgayLap,TriGia) Values('$ngay',$tt)";
			db_execute($sql_pn);
			$id = mysqli_insert_id($conn);
			foreach($_SESSION["nl"] as $key => $value )
			{
				$sql_nl="Select * From nguyenlieu Where MaNL=$key";
				$query_nl=mysqli_query($conn,$sql_nl);
				$row_nl=mysqli_fetch_array($query_nl);
				$tien=$row_nl["DonGia"];
				$tt=$key*$value;
				$sql_ct="Insert Into ctphieuxuat(MaPX,MaNL,DonGia,SoLuong) Values ($id,$key,$tien,$value)";
				db_execute($sql_ct);	
				$sl_new=$row_nl["SoLuong"]-$value;
				$sql_update="UPDATE nguyenlieu SET SoLuong=$sl_new WHERE MaNL=$key";
				db_execute($sql_update);
			}
			unset($_SESSION["nl"]);
			header("location:http://localhost:8888/cafe/index/nv.php?pape=nguyenlieu");
		}
		else 
		{
			echo "<script>alert('Vui lòng chọn nguyên liệu');</script>";
		}
	}
?>
 <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script language="javascript">
	function check()
	{
		du=document.getElementById("inputNL").value;
		if(du=="0")
		{
			document.getElementById("showLoi").innerHTML="Chọn lại nguyên liệu!";
			document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			return false;
		}
		var sl=document.getElementById("inputSL").value;
		
		if(sl<0||sl=="")
		{
			document.getElementById("showLoi").innerHTML="Nhập lại số lượng nguyên liệu!";
		  document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			return false;
		}
		return true;
	}
	function resetLoi(){
		document.getElementById("showLoi").innerHTML="";
	    document.getElementById("showLoi").style.height="0px";
	    document.getElementById("showLoi").style.background="white";
	}
	window.onload=function(){
		var d=new Date();
		var day=d.getDate();
		if(day<10){
			day="0"+day;
		}
		var month=d.getMonth();
		var months=Array("01","02","03","04","05","06","07","08","09","10","11","12");
		var year=d.getFullYear();
		document.getElementById("showDay").value=year+"/"+months[month]+"/"+day;
	}
	
</script>	