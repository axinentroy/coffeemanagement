<?php
ob_start();
session_start();
?>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>GradCafe</title>
	<link rel="stylesheet" href="css/grad.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		switch($_GET["pape"])
		{
			case "menu":
				echo "<link rel='stylesheet' type='text/css' href='css/menu.css'";break;
			case "donong":
				echo "<link rel='stylesheet' type='text/css' href='css/menu.css'";break;
			case "doan":
				echo "<link rel='stylesheet' type='text/css' href='css/menu.css'";break;
			default:
				echo "<link rel='stylesheet' type='text/css' href='css/trangchu.css'";break;
		}
	?>
	
	
</head>
<body>
<?php 
	unset($_SESSION["inputTen"]);
	unset($_SESSION["inputPass"]);
?>
<?php 
	include_once("com.php");
	if(isset($_POST["submitLogin"]))
	{
		
		if((isset($_POST["inputTen"])) && (isset($_POST["inputPass"])))
		{
			
			$user=$_POST["inputTen"];
			
			$pass=$_POST["inputPass"];
			db_connect();
			$sql_login="Select * From nhanvien Where TenNV= '$user' And MatKhau='$pass'";
			$query_login=db_execute($sql_login);
			$num_row_login=mysqli_num_rows($query_login);

			if($num_row_login>0){
				$_SESSION["inputTen"]=$user;
				$_SESSION["inputPass"]=$pass;
				header("location:index/nv.php");
			}
			else
			{
				echo"<script> alert('Tài khoản không đúng!');</script>";
			}
			
		}	
	}
	db_close();
	
?>
<!-- show của login --->
<div class="general">

	<div class="form-login xora">
		<h3 class="title-form" align="center"> ĐĂNG NHẬP</h3>
		<hr>
		<div class="container">
			<form role="form" method="post">
				<div class="row form">
				
					<label for="inputEmail3" class="col-sm-offset-2 col-sm-3 control-label">TÊN ĐĂNG NHẬP</label>
					<div class="col-sm-5">
					  <input type="type" class="form-control" name="inputTen" id="inputTen" placeholder="--Tên đăng nhập--">
					</div>
				 
				 </div>
				 <div class="form row">
				  <div class="form-group">
					<label for="inputPassword3" class="col-sm-offset-2 col-sm-3 control-label">MẬT KHẨU</label>
					<div class="col-sm-5">
					  <input type="password" class="form-control" name="inputPass" placeholder="--Mật khẩu--">
					</div>
				  </div>
				 </div>
				 <div class="form row">
				  <div class="form-group">
					<div class="col-sm-offset-5 col-sm-6">
					  <div class="checkbox">
						<label>
						  <input type="checkbox"> Ghi nhớ
						</label>
					  </div>
					</div>
				  </div>
				 </div>
				 <div class="form row">
				  <div >
					<div class="col-sm-offset-6 col-sm-1">
						<button type="submit" class="close-dn btn btn-color">Huỷ</button>
					</div>
					<div class="col-sm-2">
						<button type="submit"  name="submitLogin" class="btn-color btn">Đăng nhập</button>
					</div>
				  </div>
				 </div>
			</form>
		</div>
	</div><!-- end show -->
<?php 
	$cart=0;
	if(isset($_SESSION["cart"]))
	{
		$cart=count($_SESSION["cart"]);
	}
?>
	<div class="container-fluid">
		<div class="row">
				<div id="note">
					<div>
						<div class="row">
							<div class=" text-align">
								<div id="color-gh" data-toggle="modal" data-target="#myModal">
									<h5 id="chickGH" slcart="<?php echo $cart; ?>" ><a>Giỏ hàng:  <img class="img-reponsive logo-gh" src="http://imageshack.com/a/img924/3062/wwt0K8.png"></a> <?php echo $cart;?>	</h5>
								</div><!--end giao hang --->
							</div>
						</div>
						<div class="row">
							<div class=" text-center">
								<a href="#" data-toggle="tooltip" data-placement="bottomz" title="Instagram" ><img class="img-responsive " src="http://imageshack.com/a/img923/2285/jigtZt.png"></a>
							</div>
							<div class="col-sm-6 text-center">
								<a href="#" data-toggle="tooltip" data-placement="bottomz" title="Facebook" ><img class="img-responsive" src="http://imageshack.com/a/img924/325/nNKz2O.png"></a>
							</div>
						</div>
					</div>
				</div><!-- end note --->
			
		</div>
	</div>
	<!-- form của giao hàng -->
	
	<div>
		<div class="modal fade form-gh" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="title-form" align="text-center" id="myModalLabel">THÔNG TIN GIỎ HÀNG</h4>
				</div>
		<form method="post">
		<div id="formGH"></div>
<?php 
	$tt=0;
	if(isset($_SESSION["cart"]))
	{
		foreach($_SESSION["cart"] as $key => $value)
		{
			$du[]=$key;
		}
		$dsDU=implode(',',$du);
		include_once("com.php");
		db_connect();
		$mysql="Select * From menu Where MaMon In ($dsDU) ORDER BY MaMon ASC";
		$query=mysqli_query($conn,$mysql);
		
		while($row=mysqli_fetch_array($query))
		{
			$tt=$tt+(int)$_SESSION["cart"][$row["MaMon"]]*$row["Gia"];
?>
					<hr width="50%">
					<div class="row item-cart <?php echo 'item'.$row['MaMon']; ?>">
						<div class="col-sm-offset-1 col-sm-5">
							<img class="img-responsive" src="hinh/<?php echo $row["HinhAnh"];?>" >
						</div>
						<div class="col-sm-5 form">
							<div class="row form">
								<label class=" col-sm-5 control-label">Tên món:</label>
								<div class="col-sm-7">
									<?php echo $row["TenMon"]; ?>
								</div>
							</div>
							<div class="row form">
								<label class=" col-sm-5 control-label">Giá tiền:</label>
								<div class="col-sm-7">
									<input type="text" class="form-control"  disabled ="true" id="inputGia" value="<?php echo $row["Gia"]; ?>.000 VNĐ">
								</div>
							</div>
							<div class="row form ">
								<label class=" col-sm-5 control-label">Số lượng:</label>
								<div class="col-sm-7">
									<input type="number" ma="<?php echo $row['MaMon'];?>" class="form-control inputSL" value="<?php echo intval($_SESSION["cart"][$row['MaMon']]);?>">
								</div>							
							</div>
							<div class="row col-sm-offset-6">
								<span class="buttonXoa" mamon="<?php echo $row['MaMon'];?>">Xoá</span>
							</div>
						</div>
					</div>
					
<?php 
		}
	
	?>

					
					<div class="row form">
						<div class="form-group">
							<label  class="col-sm-offset-1 col-sm-5 control-label">Tổng tiền: <input type="text" class="form-control col-sm-3" id="showTT" value="<?php echo $tt.".000 VNĐ"; ?>" name="inputTT">
						</div>
					</div>
<?php
	}
?>
					
				<div class="modal-footer">
					<a href="index.php?pape=menu#menu-dl"><button type="button" name="submitTT" class="btn btn-color" data-dismiss="modal">Tiếp tục chọn</button></a>
					<button type="submit" name="submitGH" class="btn btn-color" onclick="tinhTT()">Giao hàng</button>
				</div>
			</form>
			</div>
		</div>
		</div>
	</div><!-- end form giao hang -->
	

<?php
	if(isset($_POST["submitGH"]))
	{ 
		if($cart>0)
		{
			$day= date("Y-m-d");
			$ten=$_POST["inputTen"];
			$dc=$_POST["inputDC"];
			$sdt=$_POST["inputSDT"];
			$tt=$_POST["inputTT"];
			include_once("com.php");
			$sql_bl="INSERT INTO phieugoi(NgayLap,TrangThai,MaKM,TriGia,TenKH,DiaChi,SDT) VALUES ('$day','BienLai','','$tt','$ten','$dc','$sdt')";
			$query_menu=db_execute($sql_bl );
			$last_id = $conn->insert_id;
			$name=$_POST["number"];	
			foreach ($_SESSION["cart"] as $key => $value){
				
				$sql_ct="INSERT INTO ctphieugoi(MaPG,MaMon,SoLuong)VALUES($last_id,$key,$value)";
				db_execute($sql_ct);
				
			}
			
			unset($_SESSION["cart"]);
			header("location:index.php");
		}
		else{
			echo "<script>alert('Giỏ hàng đang trống.Vui lòng chọn đồ uống');</script>";
		}
	}
		
		
		
?>

	<div id="sub-menu">
		<div class="container">
			<div class="row">
				<div class=" pull-left">
					<p>Hotline: 0905 421 421 </p>
				</div>
				<div class="pull-right">
					<ul>
						<li><a href="#"data-toggle="tooltip" data-placement="bottomz" title="Instagram" ><img src="http://imageshack.com/a/img923/1218/Vszuao.png"></a>&nbsp 
						<a href="#"data-toggle="tooltip" data-placement="bottomz" title="Facebook" ><img src="http://imageshack.com/a/img924/7131/UreeVx.png"></a></li>
						<li class="a-color"> <a href="#" data-toggle="tooltip" data-placement="bottomz" title="Ngôn ngữ">VN/EN</a></li>
						<li class="a-color login">
							<a href="#">
							  Đăng nhập</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div><!-- end sub-menu-->
	<div id="bar-logo">
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12" >
					<div id="logo" class="text-center" >
						<img src="http://imageshack.com/a/img924/5995/cg3Bw1.png">
					</div>
				</div>
				
			</div>
		</div>
	</div><!--end logo-->
	
	<div class="stickyheader">	
	  <ul>
		<li><a href="index.php">TRANG CHỦ</a></li>
		<li><a href="index.php?pape=menu#bar">MENU</a></li>
		<li><a href="#">KHUYẾN MÃI</a></li>
		<li><a href="#">LIÊN HỆ</a></li>
		<li><a href="#">GÓP Ý</li>
	  </ul>
	</div><!--end menu-->
 
  <div class="stickyalias"></div>
	<div id="stickyalias"></div>
	<div id="slider-menu">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
		  <!-- Indicators -->
		  <ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>
			<li data-target="#carousel-example-generic" data-slide-to="2"></li>
		  </ol>

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
			<div class="item active">
			  <img class="img-responsive"  src="http://imageshack.com/a/img924/6097/AOANiO.jpg" >
			</div>
			<div class="item">
			  <img class="img-responsive"  src="http://imageshack.com/a/img924/2029/8FKEZ4.jpg">
			</div>
			<div class="item">
			  <img class="img-reponsive"  src="http://imageshack.com/a/img922/9923/KFXvyC.jpg">
			</div>
			
		  </div>

		  <!-- Controls -->
		  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
		  </a>
		  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
		  </a>
		</div>
	</div><!-- end slider menu -->
	<div id="bar">
		<div class="row">
			<div class="container">
				<div class="col-xs-12 col-sm-4 delivery">
					<h5><img class="responsive" src="http://imageshack.com/a/img923/5720/BaPigc.png">
					GIAO HÀNG MIỄN PHÍ</h5>
				</div>
				<div class=" col-xs-12 col-sm-4 hotline">
					<h5><img class="responsive" src="http://imageshack.com/a/img922/5772/k6Fs4i.png">
					HOTLINE: 0905 421 421</h5>
				</div>
				<div class="col-xs-12 col-sm-4 address">
					<h5><img class="responsive" src="http://imageshack.com/a/img922/7015/pyNHwB.png">
					64 LINH TRUNG - THỦ ĐỨC</h5>
				</div>
			</div>
		</div>
	</div ><!--end bar--->
	<div id="content">
		<?php
		switch($_GET["pape"])
		{
			case "trangchu": 
				require("index/trangchu.php");break;
			case "menu":
				require("index/menu.php");break;
			case "donong" :
				require("index/menu_dn.php");break;
			case"doan":
				require("index/menu_da.php");break;
			default:
				require("index/trangchu.php");break;
			
		}
	?>
	</div><!-- end content -->
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-xs-6 col-sm-4">
					<h4>CHÚNG TÔI Ở ĐÂU?</h4>
					<p>47 LINH TRUNG - THỦ ĐỨC <br>
					HOTLINE: 0905 421 421</p>
				</div>
				<div class="col-xs-6 col-sm-4">
					<h4>GIỜ MỞ CỬA</h4>
					<p>T2-CN 8H-22H
				</div>
			</div>
		</div>
	</div><!--footer-->
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script type="text/javascript">	
	$(document).ready(function(){
		$(".buttonXoa").click(function(){
			var id=$(this).attr("mamon");
			$.get("index/xoaGH.php",{id:id},function(data){
				$("#showTT").val('');
				$("#showTT").val(data+".000 VNĐ");
				
			});	
			var xoa=".item"+id;
			$(".item"+id).remove();
		});
		$(".inputSL").change(function(){
			var sl=$(this).val();
			var id=$(this).attr("ma");
			
			$.get("index/suaGH.php",{sl:sl,id:id},function(data){
				$("#showTT").val('');
				$("#showTT").val(data+".000 VNĐ");
			});
			$("#inputSL").val(sl);
		});
		$("#chickGH").click(function(){
			var sl=$(this).attr("slcart");
			$.get("index/formGH.php",{sl:sl},function(data){
				$("#formGH").html(data);
			});
		});
	});
	
	
	
</script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/grad.js"></script>
</body>
</html>