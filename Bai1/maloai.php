<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thong tin nhân viên</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<body>
<?php 
// Ket noi CSDL
require("connect.php");
require("header.php");
// Chuan bi cau truy van & Thuc thi cau truy van
$strSQL = "SELECT * FROM loainhanvien";
$result = mysqli_query($dbc,$strSQL);
// Xu ly du lieu tra ve
if(mysqli_num_rows($result) == 0)
{
	echo "Chưa có dữ liệu";
}
else
{
?>	
<form action="" method="get" style="margin-top: 20px;">
<table bgcolor="#eeeeee" align="center" width="70%" border="0" 
	   cellpadding="5" cellspacing="5" style="border-collapse: collapse;">
<tr>
	<td align="center">Mã Loại Nhân Viên: <input type="text" name="maloai" size="30" 
				value="<?php if(isset($_GET['tensua'])) echo $_GET['tensua'];?>">
			<input type="submit" name="tim" value="Tìm kiếm"></td>
</tr>
</table>
</form>
	<div class="container">

<h2 style="text-align: center;">LOẠI NHÂN VIÊN</h2>
<table class="table table-bordered table-striped table-responsive-stack" style="text-align: center;margin: auto;">
   <thead class="thead-dark">
	  <tr>
		 <th style="background-color: black;color :white">Mã Loại Nhân Viên</th>
		 <th style="background-color: black;color :white">Tên loại Nhân Viên </th>
		 <th style="background-color: black;color :white"></th>
	  </tr>
   </thead>
   <tbody>
	  <?php
		  $stt=1;
		  if($_SERVER['REQUEST_METHOD']=='GET')
		  {
		  	if(empty($_GET['maloai'])){

		  while ($row = mysqli_fetch_array($result))
		  {
			  if($stt%2!=0)
			  {	echo "<tr>";
				  echo "<td>$row[0]</td>";
				  echo "<td>$row[1]</td>";
				  echo "<td>
				  <a href='deleteloainv.php?id=$row[MALOAINV]'><i class='fas fa-trash-alt'></i></a>
				  <a href='editloainv.php?id=$row[MALOAINV]'><i class='fas fa-edit'></i></a>
				  </td>";
				  echo "</tr>";
			  }
			  else
			  {
				  echo "<tr style='background-color: lightblue;'>";
				  echo "<td>$row[0]</td>";
				  echo "<td>$row[1]</td>";
				  echo "<td>
				  <a href='deleteloainv.php?id=$row[MALOAINV]'><i class='fas fa-trash-alt'></i></a>
				  <a href='editloainv.php?id=$row[MALOAINV]'><i class='fas fa-edit'></i></a>
				  </td>";
				  echo "</tr>";
			  }
				  $stt+=1;
		  }
		} else if(!empty($_GET['maloai'])) 
		{
		$maloainv=$_GET['maloai'];	
		$query="Select * 
		  from loainhanvien
		  WHERE MALOAINV like '%$maloainv%'";
		  $timkiem=mysqli_query($dbc,$query);		
			if(mysqli_num_rows($timkiem)<>0)
			{	$rows=mysqli_num_rows($timkiem);
				echo "<div align='center'><b>Có $rows Loại nhân viên được tìm thấy.</b></div>";
		while($row=mysqli_fetch_array($timkiem, MYSQLI_ASSOC))
		{	
			echo "<tr>";
				 echo "<td>$row[MALOAINV]</td>";
				 echo "<td>$row[TENLOAINV]</td>";
				 echo "<td>
					 <a href='deleteloainv.php?id=$row[MALOAINV]'><i class='fas fa-trash-alt'></i></a>
					 <a href='editloainv.php?id=$row[MALOAINV]'><i class='fas fa-edit'></i></a>
					 </td>";
			 echo "</tr>";
		}
	}
	else echo "<div><b>Không tìm thấy loại nhân viên này.</b></div>";
}
	}
	  ?>
   </tbody>
</table>







</div>
<?php
}
?>
<?php
//Dong ket noi
mysqli_close($dbc);
?>
</body>
</html>
