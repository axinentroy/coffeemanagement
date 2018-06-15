
<?php
	include("../com.php");
	db_connect();
	$sql_menu="Select * From menu";
	$query_menu=db_execute($sql_menu);
?>



	<div id="content">
		<div class="container">
<form method="post" onsubmit="return ktr()">
			<div class="row ">
			    <div class="col-sm-6 title">
				<h1>THÊM BIÊN LAI MỚI</h4>
			    </div>
			</div>
			<hr>
			<div class="row">
				<div class=" col-sm-offset-2 col-sm-4" id="showLoi">
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
					<label class="col-sm-2 control-lable">Ngày lập </label>
					<div class="col-sm-4">
						<input type="text" id="showTG" class="form-control" name="inputNgay">
					</div>
				</div>
			</div>
		

			<div class="row form">
				<div id="show"></div>
				<div class="form-group">
					<label class="col-sm-2 control-label">Đồ uống</label>
					<div class="col-sm-2">
						<select class="form-control" id="itemDU" name="dsDU" onclick="resetLoi()">
						  <option value =0 >Chọn đồ uống</option>
						<?php
							while($row_menu=mysqli_fetch_array($query_menu))
							{
						?>
								<option value="<?php echo $row_menu["MaMon"];?>"><?php echo $row_menu["TenMon"];?></option>
						 <?php 
							}
						?>
						</select>
					
					</div>
					<div class="col-sm-1">
						<input type="number" value="1" class="form-control" name="inputSL" id="inputSL" placeholder="SL" onfocus="resetLoi()" >
					</div>	
					<div class="col-sm-1">
						<button type="submit" name="submitThem" class="btn  btn-color" onclick="return ktra()">Thêm</button>
					</div>
				</div>
			</div>
<?php
	if(isset($_POST["submitThem"]))
	{
		
		$du=$_POST["dsDU"];
		$sl=$_POST["inputSL"];
		if(isset($_SESSION["item"][$du]))
		{
			
			$new=$_SESSION["item"][$du]+$sl;
			
		}
		else
		{
			
			$new=$sl;
		}
		$_SESSION["item"][$du]=$new;
		header("location:http://localhost:8888/cafe/index/nv.php?pape=thembl#showTG");
	}
?>			<div class="row form">
				<div class="col-sm-offset-2 col-sm-4 ">
					<table id="showTable" class="table table-hover" name="showTable">
						<tr>
							
							<td class="title-table">Tên nước</td>
							<td class="title-table">Số lượng</td>
							<td class="title-table">Giá</td>
							<td class="title-table">Xoá</td>
						</tr>	
<?php 
$tong=0;
if(isset($_SESSION["item"]))
{
	foreach($_SESSION["item"] as $key => $value)
	{
			
			$sql_ct="Select * From menu Where MaMon=$key";
			$query_ct=mysqli_query($conn,$sql_ct);
			$row_ct=mysqli_fetch_array($query_ct);
			 $tong=$tong+$row_ct["Gia"]*$value;
?> 
						<tr>
							<td><?php echo $row_ct["TenMon"]; ?></td>
							<td><?php echo $value; ?></td>
							<td><?php echo $row_ct["Gia"]*$value; ?></td>
							
							<td><a href="xoa_item_bl.php?mon=<?php echo $key;?>" onclick="return confirm('Bạn có chắc chắn muốn xoá?')" >
								<img  data-toggle="tooltip" data-placement="bottom" title="Xoá"
								src="http://imageshack.com/a/img922/3700/uYzTxM.png"></a></td>
						</tr>
<?php 
	}
}
	$day=date("Y-m-d");
	$sql_km="Select MaKM,Max(TienGiam) As km  From khuyenmai Where NgayKetThuc >= '$day' AND NgayBatDau <= '$day' And TriGiaApDung <= $tong";
	$query_km=mysqli_query($conn,$sql_km);
	$kq_km=mysqli_fetch_array($query_km);
	$ma_km=$kq_km["MaKM"];
	$thanhtoan=(int)$tong -(int)$kq_km['km'];
	


?>
					</table>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Tổng tiền</label>
					<div class="col-sm-4">
					  <input type="text" name="inputTT" class="form-control" value="<?php echo $tong; ?>.000 VNĐ" id="inputTT" placeholder="Tổng tiền" >
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Tiền giảm (Khuyến mãi)</label>
					<div class="col-sm-4">
					  <input type="text" name="inputKM" class="form-control" value="<?php echo $kq_km["km"]; ?>.000 VNĐ" id="inputKM" placeholder="Tiền được giảm">
					</div>
				</div>
			</div>
			<div class="row form">
				<div class="form-group">
					<label  class="col-sm-2 control-label">Thanh toán</label>
					<div class="col-sm-4">
					  <input type="text" name="inputTien" class="form-control"  value="<?php echo $thanhtoan; ?>.000 VNĐ" id="inputTien" placeholder="Tổng tiền thanh toán">
					</div>
				</div>
			</div>
			
			<div class="row form ">
				<div class="col-sm-offset-2 col-sm-2">
					<a href="nv.php?pape=bienlai"><button type="button" name="submitHuy" class="btn  btn-color">Huỷ Biên Lai</button></a>
				</div>
				<div class="col-sm-2">
					<button type="submit" class="btn  btn-color" name="submitBL" onclick="return ktr()" >Thêm Biên Lai</button>
				</div>
			</div>
		</div>
	</div><!--end content-->
</form>
<?php
	if(isset($_POST["submitBL"]))
	{
		if(isset($_SESSION["item"]))
		{
			$sql_bl="Insert Into phieugoi(NgayLap,TrangThai,MaKM,TriGia) Values('$day','BienLai','$ma_km',$thanhtoan)";
			db_execute($sql_bl);
			 $id = mysqli_insert_id($conn);
			foreach($_SESSION["item"] as $key => $value)
			{
				
				$sql_change="Insert Into ctphieugoi(MaPG,MaMon,SoLuong) VALUES('$id','$key','$value')";
				
				db_execute($sql_change);
				unset($_SESSION['item']);
				
			}
			header("location:nv.php?pape=bienlai");
		}
		else{
			echo "<script>alert('Vui lòng chọn đồ uống')</script>";
		}
	
	}
?>	

<script language="javascript">
	function ktr(){
		var tt=document.getElementById("inputTT").value;
		if(tt=='')
		{
			
			document.getElementById("showLoi").innerHTML = "Vui lòng chọn đồ uống!";
			document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			return false;
		}
		else
			return true;
		
	}
	function deleteDU(row){
		document.getElementById("showTable").deleteRow(row.parentElement.parentElement.rowIndex);
		

		for(var j=0;j<r;j++)
		{
			TT=TT+parseInt(table.rows[i].cells[3].innerHTML);
		
		}
		var showTT=TT+".000 VND";
		
		document.getElementById("inputTT").value=showTT;
			
     }
	function add(){
		
		  var kt=1;
		  var objectDU=document.getElementById("itemDU");
		  var du=objectDU.options[objectDU.selectedIndex].text;
		  var mValue=objectDU.value.split(" ");
		  var sl=document.getElementById("inputSL").value;
		  
		  if(sl<0)
		  {
			  kt=0;
			  document.getElementById("showLoi").innerHTML="Nhập lại số lượng đồ uống!";
			  document.getElementById("showLoi").style.height="50px";
				document.getElementById("showLoi").style.background="#d8ab86";
		  }
		  if(sl=='')
		  {	
			kt=0;
			  document.getElementById("showLoi").innerHTML="Nhập lại số lượng đồ uống!";
			  document.getElementById("showLoi").style.height="50px";
				document.getElementById("showLoi").style.background="#d8ab86";
		  }
			  
		  var sl=parseInt(sl);
		  var table=document.getElementById("showTable");
		  var r=table.rows.length;
		  var check=0;
		  if(du =='Chọn đồ uống')
		  {
				kt=0;
				document.getElementById("showLoi").innerHTML="Chưa chọn đồ uống!";
				document.getElementById("showLoi").style.height="50px";
				document.getElementById("showLoi").style.background="#d8ab86";
		  }
		  if(kt==1)
			{
			  for(var i=0;i<r;i++)
				{  
					 if(table.rows[i].cells[0].innerHTML==du)
					{
					  var gia_old=parseInt(table.rows[i].cells[2].innerHTML);
					  var sl_old=parseInt(table.rows[i].cells[1].innerHTML);
					  var sl_new=sl_old+sl;
					  table.rows[i].cells[2].innerHTML=gia_old*sl;
					  table.rows[i].cells[1].innerHTML=sl_new;
					  check=1;
					  TT=0;
					}
				}
				if(check==0)
				{
				  var gia=parseInt(mValue[1]*sl);
				  var newrow=table.insertRow(); 
				
				  var coldu=newrow.insertCell(0);
				  var colsl=newrow.insertCell(1);
				  var colgia=newrow.insertCell(2);
				  var colxoa=newrow.insertCell(3);
			
				  coldu.innerHTML=du;
				  colsl.innerHTML=sl;
				  colgia.innerHTML=gia;
				 
				  colxoa.innerHTML="<img src='http://imageshack.com/a/img922/3700/uYzTxM.png' onclick='deleteDU(this);'>";
				  TT=0;
				}
				var TT=0;
				for(var j=1;j<=r;j++)
				{
					TT=TT+parseInt(table.rows[j].cells[2].innerHTML);
				
				}
				var showTT=TT+".000 VND";
				
				document.getElementById("inputTT").value=showTT;
			}
	  
	}
	
	window.onload = function(){
		
		var days= new Date();
		var date=days.getDate();
		d=date;
		if(date<10)
		{
			d="0"+date;
		}
		var months=new Array("01","02","03","04","05","06","07","08","09","10","11","12");
		var month=days.getMonth();
		
		var year=days.getFullYear();
		
		
		document.getElementById("showTG").value=year+"-"+months[month]+"-"+d;
	}
	function resetLoi(){
		 document.getElementById("showLoi").style.height="0px";
		 document.getElementById("showLoi").style.background="white";
		 document.getElementById("showLoi").innerHTML="";
		 
	 }
	function ktra(){
		var sl=document.getElementById("inputSL").value;
		if(sl<0||sl=='')
		{
		  document.getElementById("showLoi").innerHTML="Nhập lại số lượng đồ uống!";
		  document.getElementById("showLoi").style.height="50px";
			document.getElementById("showLoi").style.background="#d8ab86";
			return false;
		}
		return true;
	}
	
</script>	
	