<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thông tin phòng</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<?php
  require("connect.php");
  require("header.php");
    if(isset($_GET['id'])){
         $id= $_GET['id'];
    }
    $sql = "SELECT * FROM phongban WHERE MAPHONG='$id' ";
    $edit=mysqli_query($dbc,$sql);
    $rows = mysqli_fetch_array($edit);

?>
<form action="" method="post" enctype="multipart/form-data">
<table bgcolor="#eeeeee" align="center" width="60%" border="0">
<tr bgcolor="#eeee10">
	<td colspan="2" align="center"><font color="blue"><h2>SỬA Loại PHÒNG</h2></font></td>
</tr>
<tr>
	<td>Mã loại phòng: </td>
	<td><input type="text" name="MAP" size="20" disabled value="<?php echo $rows[0];?> " /></td>
</tr>
<tr>
	<td>Tên loại phòng:</td>
	<td><input type="text" name="TENLP" size="20" value="<?php echo $rows[1];?>" /></td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name ="sua" size="10" value="Chỉnh sửa" /></td>
</tr>
</table>
</form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	$errors=array(); //khởi tạo 1 mảng chứa lỗi
	$malp=$id;
	if(empty($_POST['TENLP'])){
		$errors[]="Bạn chưa nhập tên loại nhân viên";
	}
	else{
		$tenlp=trim($_POST['TENLP']);
	}
	
	if(empty($errors))//neu khong co loi xay ra
	{ 
		$query="UPDATE phongban SET 
        MAPHONG='$malp',
        TENPHONG='$tenlp' WHERE  MAPHONG='$malp'
        ";
		$result=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){//neu them thanh cong
			echo "<div align='center'>Chỉnh sửa thành công!</div>";			
			header("location:maphong.php");
		}
		else //neu khong them duoc
		{
			echo "<p>Có lỗi, không thể sửa được</p>";
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

	mysqli_close($dbc);
	//include 'include/footer-ad.html';
 ?>
</body>