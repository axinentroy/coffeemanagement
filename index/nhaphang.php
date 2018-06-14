
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
		$gia=$_POST["inputGia"];
		$sl=$_POST["inputSL"];
		
		if(isset($_SESSION["nl"][$nl]))
		{
			$value = $_SESSION["nl"][$nl];
			$mang= explode(',',$value);
			$tien=$mang[0];
			$slg=$mang[1];
			$new_sl=$_SESSION["nl"][$nl]+$slg;
		}
		else
		{
			$new_sl=$sl;
		}
		$_SESSION["nl"]["$nl"]=$gia.",".$new_sl;
	}
?>
	<div id="content">
		<div class="container">
			<div class="row ">
			    <div class="col-sm-6 title">
				<h1>NHẬP HÀNG VÀO KHO</h4>
			    </div>
			</div>
			<hr>
		<form method="post">
			<div class="row">
				<div class="col-sm-offset-2 col-sm-4" id="showLoi">
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Mã Biên Lai</label>
					<div class="col-sm-4">
					  <input type="text" disabled="disabled" class="form-control" id="inputMa" placeholder="Mã biên lai">
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label class="col-sm-2 control-label">Ngày lập</label>
					<div class="col-sm-4">
						<input type="text" id="showTG" value="<?php echo date('Y-m-d');?>" class="form-control" name="inputNgay">
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label class="col-sm-2 control-label">Sản Phẩm</label>
					<div class="col-sm-2" >
						<select class="form-control" id="dsNL" name="inputNL" onclick="resetLoi()">
						  <option value="0">Chọn Sản Phẩm</option>
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
						<input type="number" value="1" class="form-control" id="inputSL" name="inputSL" placeholder="SL" onfocus="resetLoi()">
					</div>
					<div class="col-sm-1">
							<input type="text"  onclick="resetLoi()" class="form-control" id="inputGia" name="inputGia" placeholder="Giá" onfocus="resetLoi()">
					</div>
				</div>
			</div>
					<div class="row">
						
						<div class=" col-sm-offset-2 col-sm-4 text-center">
							<input type="submit" name="submitThem" class="btn  btn-color" onclick="return check()" value="Thêm">
						</div>
					</div>
				
			<div class="row form">
				<div class="col-sm-offset-2 col-sm-4 ">
					<table class="table table-hover" id="showTable">
						<tr>
							<td class="title-table">Tên Sản Phẩm</td>
							<td class="title-table">Số lượng</td>
							<td class="title-table">Giá</td>
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
			$mang= explode(',',$value);
			$tien=$mang[0];
			$slg=$mang[1];
			$tt=$tt+$slg*$tien;
?>
						<tr> 
							<td><?php echo $row_ten["TenNL"]; ?></td>
							<td> <?php echo $slg."/".$row_ten["DonViTinh"]; ?></td>
							<td><?php echo $tien ?></td>
							<td><a href="xoa_ct_nh.php?nl=<?php echo $key;?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" >
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
					<button type="submit" class="btn  btn-color" name="submitHuy">Huỷ Phiếu Nhập</button>
				</div>
				<div class="col-sm-2">
					<button type="submit" class="btn  btn-color" name="submitLap">Lập Phiếu Nhập</button>
				</div>
			</div>
		</form>
		</div>
	</div><!--end content-->
<?php 
	if(isset($_POST["submitHuy"]))
	{
		unset($_SESSION["nl"]);
		header("location:http://localhost:8888/cafe/index/nv.php?pape=nguyenlieu");
	}
	if(isset($_POST["submitLap"]))
	{
		if(count($_SESSION["nl"])>0)
		{
			$ngay=date("Y-m-d");
			
			$sql_pn="Insert Into phieunhap(NgayLap,TriGia) Values('$ngay',$tt)";
			db_execute($sql_pn);
			$id = mysqli_insert_id($conn);
			foreach($_SESSION["nl"] as $key => $value )
			{
				$mang= explode(',',$value);
				$tien=$mang[0];
				$slg=$mang[1];
				$sql_nl="Select * From nguyenlieu Where MaNL=$key";
				$query_nl=mysqli_query($conn,$sql_nl);
				$row_nl=mysqli_fetch_array($query_nl);
				$sl_new=$slg+$row_nl["SoLuong"];
				$gia_new=($tien*$slg+$row_nl["DonGia"]*$row_nl["SoLuong"])/($slg+$row_nl["SoLuong"]);
				$tt=$tien*$slg;
				$sql_ct="Insert Into ctphieunhap(MaPN,MaNL,DonGia,SoLuong) Values ($id,$key,$tien,$slg)";
				db_execute($sql_ct);	
				$sql_update="UPDATE nguyenlieu SET SoLuong=$sl_new , DonGia=$gia_new WHERE MaNL=$key";
				db_execute($sql_update);
			}
			unset($_SESSION["nl"]);
			header("location:http://localhost:8888/cafe/index/nv.php?pape=nguyenlieu");
		}
		else{
			echo "<script>alert('Vui lòng chọn nguyên liệu');</script>";
		}
		
	}
?>
 <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script language="javascript">
	function check()
	{
		var du=document.getElementById("dsNL").value
		if(du==0)
		{
			document.getElementById("showLoi").innerHTML="Vui lòng chọn nguyên liệu!";
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
		var gia=document.getElementById("inputGia").value;
		
		if(gia<0||gia=="")
		{
			document.getElementById("showLoi").innerHTML="Nhập lại giá nguyên liệu!";
			document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			return false;
		}
		var objectDU=document.getElementById("dsNL");
		var du=objectDU.options[objectDU.selectedIndex].text;;
		
		
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