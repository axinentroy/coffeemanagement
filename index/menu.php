<?php
	include_once("com.php");
	db_connect();
	$sql="Select * From menu Where MaLoaiMon=1 Limit 0,8";
	$query=mysqli_query($conn,$sql);
	$sql_t="Select * From menu Where MaLoaiMon=1";
	$query_t=mysqli_query($conn,$sql_t);
	$tong_sp=mysqli_num_rows($query_t);
?>
	<input type="hidden" value ="<?php echo $tong_sp ?>" id="tongsp"/>
	
	<div class="container">
		<div id="menu-dl">
<?php
while($row=mysqli_fetch_array($query))
{
	$dem++;
	if($dem==1)
	{
		echo "<div class='row item-du'>";
	}
?>
	
			<div class="col-sm-3 dl-item" data-toggle="modal" data-target="#modalShowDetail">
				<div class="img-du"><img class="img-responsive" src="hinh/<?php echo $row["HinhAnh"];?>"></div>
				<div class="title-du"><?php echo $row["TenMon"]; ?></div>
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
		<div id="showThem">Xem Thêm</div>
		
	</div><!-- menu đồ lạnh -->
	<div id="modalShowDetail" class="modal fade modal-info" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content ">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="clearfix">
                        <div class="img-detail">
                            <img class="img-responsive" src="hinh/img-11.png" alt="">
                        </div>
                        <div class="info-detail">
                            <h4>Tanner Good</h4>
                            <p class="price-detail"> Price <span>$300.00</span></p>
                            <p class="detail">
                                A proper delivery system for the caffeine addict in all of us, the Large Mug is a coffee lovers best friend. And daily companion.
                                <br>
                                This vessel holds 12 oz. of your favorite brew, and was designed with special consideration so the handle and body provide a solid yet comfortable grip. Our Large Mug also features a tapered, unglazed foot allowing sets to nest together neatly alongside your pour over setup. Or your Aero Press. Or your french press. One can never have too many brewing methods, right?
                            </p>
                            <div class="submit">
                                <input type="number" min="1" placeholder="1">
                                <button><a href="themGH.php?id=<?php echo $row["MaMon"]?>&loai=<?php echo $row["MaLoaiMon"]; ?>">Thêm vào giỏ hàng</a></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script> 
	var trang=1;
	var tongsp=$("#tongsp").val();
	var sotrang= Math.ceil(tongsp/8);
	if(trang==sotrang)
	{
		document.getElementById("showThem").style.display="none";
	}
	$(document).ready(function(){
		$("#showThem").click(function(){
			 trang=trang+1;
			$.get("index/showmenu.php",{loai:1,trang:trang,sotrang:8},function(data){
				$("#menu-dl").append(data);
			});
			if(trang==sotrang)
			{
				document.getElementById("showThem").style.display="none";
			}
		});
	});
	
</script>
	