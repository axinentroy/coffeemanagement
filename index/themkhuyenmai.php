<?php 
	include("../com.php");
	if(isset($_POST["submitThem"]))
	{
		$bd=$_POST["inputBD"];
		$kt=$_POST["inputKT"];
		$ten=$_POST["inputTen"];
		$ap=$_POST["inputAD"];
		$giam=$_POST["inputTG"];
		
		$sql="Insert Into khuyenmai(TenKM,TienGiam,TriGiaApDung,NgayKetThuc,NgayBatDau) Values ('$ten',$giam,$ap,'$kt','$bd')";
		db_execute($sql);
	}
?>
	<div id="content">
		<form method="post">
			<div class="container">
				<div class="row ">
					<div class="col-sm-6 title">
					<h1>THÊM KHUYẾN MÃI MỚI	</h4>
					</div>
				</div>
				<hr>
				<div class="row form">
					<div class="form-group">
						<label  class="col-sm-2 control-label">Mã khuyến mãi</label>
						<div class="col-sm-4">
						  <input type="text" disabled="disabled" class="form-control" id="inputMa" placeholder="Mã khuyến mãi">
						</div>
					</div>
				</div>
				<div class="row form">
					<div class="form-group">
						<label  class="col-sm-2 control-label">Tên Khuyến Mãi</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="inputTen" placeholder="Tên khuyến mãi">
						</div>
					</div>
				</div>
				<div class="row form">
					<div class="form-group">
						<label  class="col-sm-2 control-label">Trị Giá Áp Dụng</label>
						<div class="col-sm-4">
						  <input type="text" class="form-control" name="inputAD" placeholder="Trị giá áp dụng">
						</div>
					</div>
				</div>
				<div class="row form">
					<div class="form-group">
						<label  class="col-sm-2 control-label">Tiền Giảm</label>
						<div class="col-sm-4">
						  <input type="text"  class="form-control" name="inputTG" placeholder="Tiền giảm">
						</div>
					</div>
				</div>
				<div class="row form">
					<div class="form-group">
						<label class="col-sm-2 control-lable">Ngày Bắt Đầu </label>
						<div class="col-sm-4">
							<input type="date" name="inputBD" class="form-control">
						</div>
					</div>
				</div>
				<div class="row form">
					<div class="form-group">
						<label class="col-sm-2 control-lable">Ngày Kết Thúc </label>
						<div class="col-sm-4">
							<input type="date" name="inputKT" class="form-control">
						</div>
					</div>
				</div>
				<div class="row form ">
					<div class="col-sm-offset-2 col-sm-2">
						<a href="http://localhost:8888/cafe/index/nv.php?pape=khuyenmai"><button type="button"  class="btn  btn-color">Huỷ Khuyến Mãi</button></a>
					</div>
					<div class="col-sm-2">
						<button type="submit" name="submitThem" class="btn  btn-color">Thêm Khuyến Mãi</button>
					</div>
				</div>
			</div>
		</form>
	</div><!--end content-->
	