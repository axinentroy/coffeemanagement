<?php
	$dem=0;
	
	$connect=mysqli_connect("localhost","root","");
	mysqli_select_db($connect,'cafe');
    
	mysqli_set_charset($connect,"utf8");
	$sql="Select * From menu Where MaLoaiMon='1'";
	$query=mysqli_query($connect,$sql);
?>
<div id="content">
	<div id="menu-du">
		<div class="container">
		<div class="row">
			<div class="col-sm-12 stickyheader">
				<ul>
					<li><a href="nv.php?pape=menu">ĐỒ UỐNG LẠNH</a></li>
					<li><a href="nv.php?pape=donong">ĐỒ UỐNG NÓNG</a></li>
					<li><a href="nv.php?pape=doan">ĐỒ ĂN NHẸ</a>
				</ul>	
				</div>
			</div>
		</div>
		<div class="stickyalias"></div>
		<div class="container">
	
			<div class="pull-right">
				<a href="nv.php?pape=themDU"><button type="button" class="btn  btn-color">Thêm Đồ Uống</button></a>
			</div>

		</div>
	</div><!-- end menu du-->
	<div id="menu-dl">
		<div class="container">
		<?php
			while($row=mysqli_fetch_array($query))
			{
				$dem++;
				if($dem==1)
				{
					echo "<div class='row item-du'>";
				}
		?>
			
				<div class="col-sm-3 dl-item">
					<div class="img-dl"><img  class="img-responsive" src="../hinh/<?php echo $row["HinhAnh"];?>"></div>
					<div class="logo-oder"><a href="nv.php?pape=suaDU&id=<?php echo $row["MaMon"]?>&loai=dl" ><img src="http://imageshack.com/a/img922/557/225SXm.png"></a></div>
					<div class="logo-delete"><a onclick="return confirm('Bạn có chắc chắn xóa không ?')" href="nv.php?pape=xoaDU&id=<?php echo $row["MaMon"]?>&loai=dl"><img  src="http://imageshack.com/a/img922/3700/uYzTxM.png"></a></div>
					<div class="title-dl"><?php echo $row["TenMon"]; ?></div>
					<div class="price"><?php echo $row["Gia"];?><?php echo ".000 VND"; ?></div>
				</div>
		<?php
				if($dem==4)
				{
					echo "</div>";
					$dem=0;
				}
			}
		?>
		</div>
	</div><!-- menu đồ lạnh -->
</div>
<script type="text/javascript">
	function ktra(){
		 var check=confirm("Bạn có chắc chắn muốn xoá!");
		 return check;
	}
	$(function(){
        // Check the initial Poistion of the Sticky Header
        var stickyHeaderTop = $('.stickyheader').offset().top;
 
        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('.stickyheader').css({position: 'fixed', top: '0px', opacity: '0.5', background:'black' });
                        $('.stickyalias').css('display', 'block');
						$('.stickyheader ul li a').css({opacity: '1'});
                } else {
                        $('.stickyheader').css({position: 'static', top: '0px',opacity: '1' ,background: '#ab5c27'});
                        $('.stickyalias').css('display', 'none');
                }
        });
  });
</script>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>