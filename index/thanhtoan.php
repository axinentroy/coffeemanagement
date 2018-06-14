<?php
	ob_start();
	$id=$_GET["id"];
	include("../com.php");
	db_connect();
	$mysql="Update phieugoi Set TrangThai='HoaDon' Where MaPG=$id";
	mysqli_query($conn,$mysql);
	
	
?>
<style type="text/css">
	
	body {
    margin: 0;
    padding: 0;
    background-color: #FAFAFA;
    font: 12pt "Tohoma";
}
* {
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}
.logo img{
    width:150px;
}
.page {
    width: 21cm;
    overflow:hidden;
    min-height:297mm;
    padding: 2.5cm;
    margin-left:auto;
    margin-right:auto;
    background: white;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
    padding: 1cm;
    border: 5px red solid;
    height: 237mm;
    outline: 2cm #FFEAEA solid;
}
 @page {
 size: A4;
 margin: 0;
}
button {
    width:100px;
    height: 24px;
}
.header {
    overflow:hidden;
}
.logo {
    background-color:#FFFFFF;
    text-align:left;
    float:left;
}
.company {
    padding-top:24px;
    text-transform:uppercase;
    background-color:#FFFFFF;
    text-align:right;
    float:right;
    font-size:16px;
}
.title {
    text-align:center;
    position:relative;
    font-size: 15px;
    color: #ab5c27;
    top:1px;
}
.footer-left {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    float:left;
    font-size: 12px;
    bottom:1px;
}
.footer-right {
    text-align:center;
    text-transform:uppercase;
    padding-top:24px;
    position:relative;
    height: 150px;
    width:50%;
    color:#000;
    font-size: 12px;
    float:right;
    bottom:1px;
}
.TableData {
    background:#ffffff;
    font: 11px;
    width:100%;
    border-collapse:collapse;
    font-family:Verdana, Arial, Helvetica, sans-serif;
    font-size:12px;
    border:thin solid #d3d3d3;
}
.TableData TH {
    background: rgba(0,0,255,0.1);
    text-align: center;
    font-weight: bold;
    color: #000;
    border: solid 1px #ccc;
    height: 24px;
}
.TableData TR {
    height: 24px;
    border:thin solid #d3d3d3;
}
.TableData TR TD {
    padding-right: 2px;
    padding-left: 2px;
    border:thin solid #d3d3d3;
}
.TableData TR:hover {
    background: rgba(0,0,0,0.05);
}
.TableData .cotSTT {
    text-align:center;
    width: 10%;
}
.TableData .cotTenSanPham {
    text-align:left;
    width: 40%;
}
.TableData .cotHangSanXuat {
    text-align:left;
    width: 20%;
}
.TableData .cotGia {
    text-align:right;
    width: 120px;
}
.TableData .cotSoLuong {
    text-align: center;
    width: 50px;
}
.TableData .cotSo {
    text-align: right;
    width: 120px;
}
.TableData .tong {
    text-align: right;
    font-weight:bold;
    text-transform:uppercase;
    padding-right: 4px;
}
.TableData .cotSoLuong input {
    text-align: center;
}
@media print {
 @page {
 margin: 0;
 border: initial;
 border-radius: initial;
 width: initial;
 min-height: initial;
 box-shadow: initial;
 background: initial;
 page-break-after: always;
}
}
#footer{
	display:none;
}
.result{
	margin-left:400px;
	margin-top:20px;
	
	
}
.result span{
	color:#ab5c27;
	margin-right:5px;
}
</style>
<script type="text/javascript">

window.onload= function () { 
	window.print();
	window.close();   
}  
</script>
<body>
<div id="page" class="page">
    <div class="header">
        <div class="logo"><img src="http://imageshack.com/a/img924/5995/cg3Bw1.png"/></div>
        
    </div>
  <br/>
  <div class="title">
        HÓA ĐƠN THANH TOÁN
        <br/>
        -------oOo-------
  </div>
  <br/>
  <br/>
  <table class="TableData">
    <tr>
      <th>STT</th>
      <th>Tên</th>
      <th>Đơn giá</th>
      <th>Số lượng</th>
      <th>Thành tiền</th>
    </tr>
<?php
	$tt=0;
	$stt=0;
	$sql="Select * From ctphieugoi ct,menu Where ct.MaPG=$id And ct.MaMon=menu.MaMon";
	$query=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($query))
	{
		$stt=$stt+1;
		$tt=$tt+$row["Gia"]*$row["SoLuong"];
?>
	<tr>
		<td><?php echo $stt; ?></td>
		<td><?php echo $row["TenMon"]; ?></td>
		<td><?php echo $row["Gia"]; ?></td>
		<td><?php echo $row["SoLuong"]; ?></td>
		<td><?php echo $row["Gia"]*$row["SoLuong"]; ?></td>
	</tr>
<?php
	}
?>
	</table>
<?php 
	$sql_t="Select * From phieugoi pg Where MaPG=$id";
	$query_t=mysqli_query($conn,$sql_t);
	$row_t=mysqli_fetch_array($query_t);
	
?>
	<div class="result"><span>Khuyến mãi:</span>-<?php echo $tt-$row_t["TriGia"].".000 VNĐ";?> </div>
	<div class="result"><span>Tổng tiền:</span> <?php echo $row_t["TriGia"].".000 VNĐ"; ?> </div>

</div>	
</body>
