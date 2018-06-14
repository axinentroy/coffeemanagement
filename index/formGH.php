
<?php 
	$sl=$_GET["sl"];
	if($sl>0)
	{
?>
				
				<div class="modal-body">
					<div class="row form">
						<div class="form-group">
							<label  class="col-sm-offset-1 col-sm-3 control-label">Tên quý khách</label>
							<div class="col-sm-7">
							  <input type="text" class="form-control" name="inputTen" placeholder="Họ và tên" required>
							</div>
						</div>
					</div>
					<div class="row form">
						<div class="form-group">
							<label  class="col-sm-offset-1 col-sm-3 control-label">Địa điểm</label>
							<div class="col-sm-7">
							  <input type="text" class="form-control" name="inputDC" placeholder="Địa điểm giao hàng" required>
							</div>
						</div>
					</div>
					<div class="row form">
						<div class="form-group">
							<label  class="col-sm-offset-1 col-sm-3 control-label">Số điện thoại</label>
							<div class="col-sm-7">
							  <input type="text" class="form-control"  name="inputSDT" placeholder="Số điện thoại" required>
							</div>
						</div>
					</div>
				<div id="dsGH">
<?php 
	}
	else
	{
?>
		<h5>Giỏ hàng trống.Vui lòng chọn đồ uống</h5>
<?php
	}
?>
			