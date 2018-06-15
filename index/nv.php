<?php
ob_start();
session_start();
?>
<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
	<meta charset="UTF-8">
	<title>GradCafe</title>
	<link rel="stylesheet" href="../css/nv.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		switch($_GET["pape"])
		{
			case "bienlai": echo "<link rel='stylesheet' type='text/css' href='../css/bienlai.css'>";break;
			case "hoadon": echo "<link rel='stylesheet' type='text/css' href='../css/hoadon.css'>";break;
			case "nguyenlieu": echo "<link rel='stylesheet' type='text/css' href='../css/nguyenlieu.css'>";break;
			case "thembl": echo"<link rel='stylesheet' type='text/css' href='../css/thembl.css'>";break;
			case "suabl": echo"<link rel='stylesheet' type='text/css' href='../css/thembl.css'>";break;
			case "nhaphang": echo "<link rel='stylesheet' type='text/css' href='../css/nhaphang.css'>";break;
			case "xuathang": echo "<link rel='stylesheet' type='text/css' href='../css/xuathang.css'>";break;
			case "ql-menu" :echo "<link rel='stylesheet' type='text/css' href='../css/ql_menu.css'>";break;
			case "donong" :echo "<link rel='stylesheet' type='text/css' href='../css/ql_menu.css'>";break;
			case "doan" :echo "<link rel='stylesheet' type='text/css' href='../css/ql_menu.css'>";break;
			case "khuyenmai":echo "<link rel='stylesheet'type='text/css' href='../css/nguyenlieu.css'>";break;
			case "themkhuyenmai":echo "<link rel='stylesheet' type='text/css' href='../css/thembl.css'>";break;
			case "themDU":echo "<link rel='stylesheet' type='text/css' href='../css/thembl.css'>";break;
			case "suaDU":echo "<link rel='stylesheet' type='text/css' href='../css/thembl.css'>";break;
			case "thongke": echo "<link rel='stylesheet' type='text/css' href='../css/thembl.css'>";break;
			
			default: echo "<link rel='stylesheet' type='text/css' href='../css/inf.css'>";break;
		}
	?>
</head>
<body>
<?php
	if(isset($_SESSION["inputTen"]))
	{
?>
	<?php
	$dem=0;
	$conn=mysqli_connect("localhost","root","");
	$select=mysqli_select_db($conn,'cafe');	
	$set_lang=mysqli_set_charset($conn,"utf8");
	$sql="Select * From menu Where MaLoaiMon='1'";
	$query=mysqli_query($conn, $sql);
?>
	<div id="menu">
		<nav  role="navigation">
		  <div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<div class="container">
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<div class="pull-right">
				  <ul class="nav navbar-nav pull-right color">
					
					<li class="dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">QL BÁN HÀNG <span class="caret"></span></a>
					  <ul class="color-dropdown">
						<li><a href="nv.php?pape=bienlai">BIÊN LAI</a></li>
						<li><a href="nv.php?pape=hoadon">HOÁ ĐƠN</a></li>
					  </ul>
					</li>
					<li >
						<a href="nv.php?pape=thongke"> THỐNG KÊ </a>
						
					</li>
					<li >
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">ADMIN <span class="caret"></span></a>
					  <ul class=" color-dropdown">
						<li><a href="nv.php?pape=ql-menu">QL MENU</a></li>
						<li><a href="nv.php?pape=khuyenmai">KHUYẾN MÃI</a></li>
						<li><a href="nv.php?pape=nguyenlieu" >QL NGUYÊN LIỆU</a></li>
						
					  </ul>
					</li>
				  </ul>
			  </div>
			  <div class="color pull-left">
				
					<a href="nv.php"><img class="img-responsive" src="http://imageshack.com/a/img922/9946/KmgsWY.png"></a>
					
			  </div>
			</div>
			</div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</div><!--end menu-->
	<div id="content">
		<?php
			switch($_GET["pape"])
			{
				case"hoadon":require("hoadon.php");break;
				case"bienlai":require("bienlai.php");break;
				case"nguyenlieu":require("nguyenlieu.php");break;
				case"thembl": require("thembl.php");break;
				case"suabl": require("suabl.php");break;
				case"nhaphang": require("nhaphang.php");break;
				case"xuathang": require("xuathang.php");break;
				case"ql-menu":require("ql_menu.php");break;
				case"donong":require("ql_menu_dn.php");break;
				case"doan": require("ql_menu_da.php");break;
				case"khuyenmai": require("khuyenmai.php");break;
				case"themkhuyenmai":require("themkhuyenmai.php");break;
				case"xoabl":require("xoabl.php");break;
				case"thanhtoan":require("thanhtoan.php");break;
				case"themDU":require("themDU.php");break;
				case"xoaDU":require("xoaDU.php");break;
				case"suaDU":require("suaDU.php");break;
				case "thongke":require("thongke.php");break;
				
				default:require("inf.php");break;
			}
		?>
	</div><!-- end content-->
	
	<div id="footer">
		<div class="container">
			<div class="row">
				<div class="col-sm-4">
					<h4>CHÚNG TÔI Ở ĐÂU?</h4>
					<p>47 LINH TRUNG - THỦ ĐỨC <br>
					HOTLINE: 0905 421 421</p>
				</div>
				<div class="col-sm-4">
					<h4>GIỜ MỞ CỬA</h4>
					<p>T2-CN 8H-22H
				</div>
			</div>
		</div>
	</div><!--footer-->
<?php
	}
	else{
		header("location:http://localhost:8888/cafe/index.php");
	}
?>
	<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	
</body>
</html>