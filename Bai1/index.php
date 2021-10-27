
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thong tin nhân viên</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
<style>
	.table-responsive-stack tr {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: horizontal;
  -webkit-box-direction: normal;
      -ms-flex-direction: row;
          flex-direction: row;
}


.table-responsive-stack td,
.table-responsive-stack th {
   display:block;
/*      
   flex-grow | flex-shrink | flex-basis   */
   -ms-flex: 1 1 auto;
    flex: 1 1 auto;
}

.table-responsive-stack .table-responsive-stack-thead {
   font-weight: bold;
}

@media screen and (max-width: 768px) {
   .table-responsive-stack tr {
      -webkit-box-orient: vertical;
      -webkit-box-direction: normal;
          -ms-flex-direction: column;
              flex-direction: column;
      border-bottom: 3px solid #ccc;
      display:block;
      
   }
   /*  IE9 FIX   */
   .table-responsive-stack td {
      float: left\9;
      width:100%;
   }
}
</style>
</head>
<body>
<?php 
// Ket noi CSDL
require("connect.php");

require("header.php");
// Chuan bi cau truy van & Thuc thi cau truy van
$strSQL = "SELECT * FROM nhanvien";
$result = mysqli_query($dbc,$strSQL);
?>
<form action="" method="get" style="margin-top: 20px;">
<table bgcolor="#eeeeee" align="center" width="70%" border="0" 
	   cellpadding="5" cellspacing="5" style="border-collapse: collapse;">
<tr>
	<td align="center">Mã Nhân Viên: <input type="text" name="manhanvien" size="30" 
				value="<?php if(isset($_GET['tensua'])) echo $_GET['tensua'];?>">
			<input type="submit" name="tim" value="Tìm kiếm"></td>
</tr>
</table>
</form>
<?php
// Xu ly du lieu tra ve
if(mysqli_num_rows($result) == 0)
{
	echo "Chưa có dữ liệu";
}
else
{	
?>
	<div class="container">

   <h2>NHÂN VIÊN</h2>
   <table class="table table-bordered table-striped table-responsive-stack" style="text-align: center;margin: auto">
      <thead class="thead-dark">
         <tr>
            <th style="background-color: black;color :white">Mã Nhân Viên</th>
            <th style="background-color: black;color :white">Họ </th>
            <th style="background-color: black;color :white">Tên</th>
			<th style="background-color: black;color :white">Ngày sinh</th>
            <th style="background-color: black;color :white">Giới tính</th>
            <th style="background-color: black;color :white">Địa chỉ</th>
			<th style="background-color: black;color :white">Ảnh</th>
            <th style="background-color: black;color :white">Mã loại NV</th>
            <th style="background-color: black;color :white">Mã Phòng</th>
			<th style="background-color: black;color :white"></th>
         </tr>
      </thead>
      <tbody>
         <?php
		 	 if($_SERVER['REQUEST_METHOD']=='GET')
			{
			if(empty($_GET['manhanvien'])){

			
		 	$stt=1;
		 	while ($row = mysqli_fetch_array($result))
			 {
				 if($stt%2!=0)
				 {
                echo "<tr>";
					 echo "<td>$row[0]</td>";
					 echo "<td>$row[1]</td>";
					 echo "<td>$row[2]</td>";
					 echo "<td>$row[3]</td>";
					 echo "<td>$row[4]</td>";
					 echo "<td>$row[5]</td>";
					 echo '<td><img style="width :50px" src="images/'.$row['ANH'].'"/></td>';
					 echo "<td>$row[7]</td>";
					 echo "<td>$row[8]</td>";
					 echo "<td>
                          <a href='delete.php?id=$row[0]'><i class='fas fa-trash-alt'></i></a>
                          <a href='edit.php?id=$row[0]'><i class='fas fa-edit'></i></a>
                          <a href='info.php?id=$row[0]'><i class='fas fa-info-circle'></i></a>
                          </td>";
					 echo "</tr>";
                
				 }
				 else
				 {
					 echo "<tr style='background-color: lightblue;'>";
					 echo "<td>$row[0]</td>";
					 echo "<td>$row[1]</td>";
					 echo "<td>$row[2]</td>";
					 echo "<td>$row[3]</td>";
					 echo "<td>$row[4]</td>";
					 echo "<td>$row[5]</td>";
					 echo '<td><img style="width :50px" src="images/'.$row['ANH'].'"/></td>';
					 echo "<td>$row[7]</td>";
					 echo "<td>$row[8]</td>";
                echo "<td>
                  <a href='delete.php?id=$row[0]'><i class='fas fa-trash-alt'></i></a>
                  <a href='edit.php?id=$row[0]'><i class='fas fa-edit'></i></a>
                  <a href='info.php?id=$row[0]'><i class='fas fa-info-circle'></i></a>
                     </td>";
                  echo "</tr>";
				 }
					 $stt+=1;
			 }
			}
			else if(!empty($_GET['manhanvien'])) 
			{
			$manv=$_GET['manhanvien'];	
			$query="Select * 
		      from nhanvien
		      WHERE MANHANVIEN like '%$manv%'";
			  $timkiem=mysqli_query($dbc,$query);		
				if(mysqli_num_rows($timkiem)<>0)
				{	$rows=mysqli_num_rows($timkiem);
					echo "<div align='center'><b>Có $rows nhân viên được tìm thấy.</b></div>";
			while($row=mysqli_fetch_array($timkiem, MYSQLI_ASSOC))
			{	
				echo "<tr>";
					 echo "<td>$row[MANHANVIEN]</td>";
					 echo "<td>$row[HO]</td>";
					 echo "<td>$row[TEN]</td>";
					 echo "<td>$row[NGAYSINH]</td>";
					 echo "<td>$row[GIOITINH]</td>";
					 echo "<td>$row[DIACHI]</td>";
					 echo '<td><img style="width :50px" src="images/'.$row['ANH'].'"/></td>';
					 echo "<td>$row[MALOAINV]</td>";
					 echo "<td>$row[MAPHONG]</td>";
					 echo "<td>
					 <a href='delete.php?id=$row[MANHANVIEN]'><i class='fas fa-trash-alt'></i></a>
					 <a href='edit.php?id=$row[MANHANVIEN]'><i class='fas fa-edit'></i></a>
					 <a href='info.php?id=$row[MANHANVIEN]'><i class='fas fa-info-circle'></i></a>
					 </td>";
				 echo "</tr>";
			}
		}
		else echo "<div><b>Không tìm thấy nhân viên này.</b></div>";
	}
}
		 ?>
      </tbody>
   </table>
   
   
   
   
   
   


</div>
<?php
}

//Dong ket noi
mysqli_close($dbc);
?>
<script>
	$(document).ready(function() {

   
// inspired by http://jsfiddle.net/arunpjohny/564Lxosz/1/
$('.table-responsive-stack').find("th").each(function (i) {
   
   $('.table-responsive-stack td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">'+ $(this).text() + ':</span> ');
   $('.table-responsive-stack-thead').hide();
});





$( '.table-responsive-stack' ).each(function() {
var thCount = $(this).find("th").length; 
var rowGrow = 100 / thCount + '%';
//console.log(rowGrow);
$(this).find("th, td").css('flex-basis', rowGrow);   
});




function flexTable(){
if ($(window).width() < 768) {
   
$(".table-responsive-stack").each(function (i) {
   $(this).find(".table-responsive-stack-thead").show();
   $(this).find('thead').hide();
});
   
 
// window is less than 768px   
} else {
   
   
$(".table-responsive-stack").each(function (i) {
   $(this).find(".table-responsive-stack-thead").hide();
   $(this).find('thead').show();
});
   
   

}
// flextable   
}      

flexTable();

window.onresize = function(event) {
 flexTable();
};






// document ready  
});

</script>

</body>
</html>
