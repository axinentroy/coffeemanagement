<?php
	include_once("../com.php");
	db_connect();
	$id=$_GET["id"];
	$sql_loai="Select * From loaimon";
	$query_loai=mysqli_query($conn,$sql_loai);
	$sql_du="Select * From menu Where MaMon=$id";
	$query_du=mysqli_query($conn,$sql_du);
	$row = mysqli_fetch_array($query_du);
?>
<?php
	if(isset($_POST["submitSua"]))
	{
		
		$ten=$_POST["inputTen"];
		$loai=$_POST["dsLoai"];
		$gia=$_POST["inputGia"];
		if($_FILES["hinh"]["name"])
		{	
			$name=$_FILES["hinh"]["name"];
			$tam=$_FILES["hinh"]["tmp_name"];
			$new="hinh/".$name;
			$upload=move_uploaded_file($tam,$new);
		}
		else
			$name=$_POST["anh_mo_ta"];
		include_once("connect.php");
		$sql_sua="Update menu Set TenMon='$ten',MaLoaiMon='$loai',Gia='$gia',HinhAnh='$name' Where MaMon='$id'";
		$sql_query=mysqli_query($conn,$sql_sua);
		if($loai==2)
		{
			header("location:nv.php?pape=donong");
		}
		if($loai==3)
		{
			header("location:nv.php?pape=doan");
		}
		if($loai==1)
		{
			header("location:nv.php?pape=ql-menu");
		}
	}
?>
<div class="content"></div>
	<div class="container">
			<div class="col-sm-6 title text-center"><h1>SỬA THÔNG TIN ĐỒ UỐNG </h1></div>
		<div class="row">
		</div>
		<div class="row">
			<div class="col-sm-6">
				<hr>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-offset-2 col-sm-4" id="showLoi">
			</div>
		</div>
		<form method="post" enctype="multipart/form-data" onsubmit="return ktra()" >
			<div class="row form">
				<div class="col-sm-2">
					<label class=" control-label">Mã Đồ uống</label>
				</div>
				<div class="col-sm-4">
					<input type="text" value="<?php echo $row["MaMon"]; ?>" name="inputMa" id="inputMa" disabled="disabled" class="form-control" placeholder="Mã đồ uống">
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-2">
					<label class="control-label">Đồ uống</label>
				</div>
				<div class="col-sm-4">
					<input type="text" value="<?php echo $row['TenMon']; ?>" name="inputTen" id="inputTen" class="form-control" placeholder="Tên đồ uống" required>
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-2">
					<label class="control-label">Loại Đồ uống</label>
				</div>
			
				<div class="col-sm-4">
					<select id="dsLoai" name ="dsLoai" class="form-control">
					
		<?php
			while($result=mysqli_fetch_array($query_loai))
			{
		?>
						<option <?php if($row['MaLoaiMon']==$result['MaLoaiMon']) {echo 'selected=\'selected\'';} ?> value="<?php echo $result['MaLoaiMon']; ?>"> <?php echo $result['TenLoaiMon']; ?> </option>
		<?php 
			}
		?>
					</select>
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-2">
					<label class="control-label">Giá</label>
				</div>		
				<div class="col-sm-4">
					<input type="text" value ="<?php echo $row['Gia']; ?>" name="inputGia" id="inputGia" class="form-control" placeholder="Giá đồ uống" required>
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-2">
					<label class="control-label">Hình ảnh</label>
				</div>
				<div>
					<input type="file"  name="hinh" id="exampleInputFile">
					<input type="hidden" name="anh_mo_ta" value="<?php echo $row['HinhAnh']; ?>" />
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-offset-2 col-sm-2">
					<input type="submit" class="btn  btn-color" value="Huỷ" name="submitHuy" />
				</div>
				<div class="col-sm-2 text-center ">
					<input type="submit" class="btn  btn-color" value="Sửa Đồ Uống"  onclick ="return confirm('Bạn có chắc chắn muốn xoá  ko?');" name="submitSua" />
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/javascript">
	function ktra(){
		var gia=document.getElementById("inputGia").value;
		if(gia<0)
		{
			document.getElementById("showLoi").innerHTML="Nhập lại giá!";
			document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			return false;
		}
		return true;
	}
</script>