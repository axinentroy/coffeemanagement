<?php
	include_once("../com.php");
	db_connect();
	$sql_loai="Select * From loaimon";
	$query_loai=mysqli_query($conn,$sql_loai);
?>
<?php
	if(isset($_POST["submitThem"]))
	{
		if(!empty($_POST["inputTen"]))
		{
			$ten=$_POST["inputTen"];
			
		}
		
		$loai=$_POST["dsLoai"];
		
		if(!empty($_POST["inputGia"]))
		{
			$gia=$_POST["inputGia"];
		
		}
		if($_FILES["hinh"]["name"])
		{	
			$name=$_FILES["hinh"]["name"];
			$tam=$_FILES["hinh"]["tmp_name"];
			
		}
		$new="../hinh/".$name;
		$upload=move_uploaded_file($tam,$new);
		$connect=mysql_connect("localhost","root","");
		$select=mysql_select_db("cafe",$connect);
		$set_lang=mysql_query("set names 'utf8'");
		$sql_them="Insert Into menu(TenMon,MaLoaiMon,Gia,HinhAnh)Values('$ten','$loai','$gia','$name')";
		$sql_query=mysql_query($sql_them);
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

	<div class="container">
		<div class="row">
			<div class="col-sm-6 title text-center"><h1>THÊM ĐỒ UỐNG MỚI</h1></div>
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
					<input type="text" name="inputMa" id="inputMa" disabled="disabled" class="form-control" placeholder="Mã đồ uống">
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-2">
					<label class="control-label">Đồ uống</label>
				</div>
				<div class="col-sm-4">
					<input type="text" name="inputTen" id="inputTen" class="form-control" placeholder="Tên đồ uống" required>
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-2">
					<label class="control-label">Loại Đồ uống</label>
				</div>
			
				<div class="col-sm-4">
					<select id="dsLoai" name ="dsLoai" class="form-control">
					<option value="0">Chọn loại đồ uống</option>
		<?php
			while($result=mysqli_fetch_array($query_loai))
			{
		?>
						<option value="<?php echo $result['MaLoaiMon']; ?>"> <?php echo $result['TenLoaiMon']; ?> </option>
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
					<input type="text" name="inputGia" id="inputGia" class="form-control" placeholder="Giá đồ uống" required>
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-2">
					<label class="control-label">Hình ảnh</label>
				</div>
				<div>
					<input type="file" name="hinh" id="exampleInputFile">
				</div>
			</div>
			<div class="row form">
				<div class="col-sm-offset-2 col-sm-2">
					<a href="http://localhost:8888/cafe/index/nv.php?pape=ql-menu"><input type="button" class="btn  btn-color" value="Huỷ " name="submitHuy" /></a>
				</div>
				<div class="col-sm-2 text-center ">
					<input type="submit" class="btn  btn-color" value="Thêm Đồ Uống" name="submitThem" />
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