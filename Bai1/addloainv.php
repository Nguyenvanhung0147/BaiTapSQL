<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<title>Thêm Loại Nhân Viên</title>
</head>
<body>
<?php 
require('header.php');
require('connect.php');
?>
<form action="" method="post" enctype="multipart/form-data">
<table bgcolor="#eeeeee" align="center" width="60%" border="0">
<tr bgcolor="#eeee10">
	<td colspan="2" align="center"><font color="blue"><h2>THÊM LOẠI NHÂN VIÊN</h2></font></td>
</tr>
<tr>
	<td>Mã Loại nhân viên: </td>
	<td><input type="text" name="MALNV" size="20" value="<?php if(isset($_POST['MALNV'])) echo $_POST['MALNV'];?>" /></td>
</tr>
<tr>
	<td>Tên Loại nhân viên: </td>
	<td><input type="text" name="TENLNV" size="20" value="<?php if(isset($_POST['TENLNV'])) echo $_POST['TENLNV'];?>" /></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name ="them" size="10" value="Thêm mới" /></td>
</tr>
</table>
</form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	$errors=array(); //khởi tạo 1 mảng chứa lỗi
	//kiem tra ma sua
	if(empty($_POST['MALNV'])){
		$errors[]="Bạn chưa nhập mã nhân viên";
	}
	else{
		$malnv=($_POST['MALNV']);
	}

	if(empty($_POST['TENLNV'])){
		$errors[]="Bạn chưa nhập họ nhân viên";
	}
	else{
		$tenlnv=($_POST['TENLNV']);
	}

    if(empty($errors))//neu khong co loi xay ra
	{ 
		$query="INSERT INTO loainhanvien VALUES ('$malnv','$tenlnv')";
		$result=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){//neu them thanh cong
			echo "<div align='center'>Thêm mới thành công!</div>";			
			header("location:maloai.php");
		}
		else //neu khong them duoc
		{
			echo "<p>Có lỗi, không thể thêm được</p>";
			//echo "<p>".mysqli_error($dbc)."<br/><br />Query: ".$query."</p>";	
		}
	}
	else
	{//neu co loi
		echo "<h2>Lá»—i</h2><p>Có lỗi xảy ra:<br/>";
		foreach($errors as $msg)
		{
			echo "- $msg<br /><\n>";
		}
		echo "</p><p>Hãy thử lại.</p>";
	}
}
?>