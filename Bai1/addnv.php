<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<title>Thêm Nhân Viên</title>
</head>
<body>
<?php 
require('header.php');
require('connect.php');
?>

<form action="" method="post" enctype="multipart/form-data">
<table bgcolor="#eeeeee" align="center" width="60%" border="0">
<tr bgcolor="#eeee10">
	<td colspan="2" align="center"><font color="blue"><h2>THÊM NHÂN VIÊN</h2></font></td>
</tr>
<tr>
	<td>Mã nhân viên: </td>
	<td><input type="text" name="MANV" size="20" value="<?php if(isset($_POST['MANV'])) echo $_POST['MANV'];?>" /></td>
</tr>
<tr>
	<td>Họ: </td>
	<td><input type="text" name="HO" size="50" value="<?php if(isset($_POST['HO'])) echo $_POST['HO'];?>" /></td>
</tr>
<tr>
	<td>Tên: </td>
	<td><input type="text" name="TEN" size="50" value="<?php if(isset($_POST['TEN'])) echo $_POST['TEN'];?>" /></td>
</tr>
<tr>
	<td>Ngày sinh: </td>
	<td><input type="text" name="NGAYSINH" size="50" value="<?php if(isset($_POST['NGAYSINH'])) echo $_POST['NGAYSINH'];?>" /></td>
</tr>
<tr>
	<td>Giới Tính: </td>
	<td><input type="text" name="GIOITINH" size="50" value="<?php if(isset($_POST['GIOITINH'])) echo $_POST['GIOITINH'];?>" /></td>
</tr>
<tr>
	<td>Địa chỉ: </td>
	<td><input type="text" name="DIACHI" size="50" value="<?php if(isset($_POST['DIACHI'])) echo $_POST['DIACHI'];?>" /></td>
</tr>
<tr>
	<td>Hình ảnh: </td>
	<td><input type="FILE" name ="hinh" size="80" value="<?php if(isset($_POST['hinh'])) echo $_POST['ANH'];?>" /></td>
</tr>
<tr>
	<td>Loại NV:</td>
	<td><select name="loainhanvien">
			<?php 
				$query="select * from loainhanvien";	//Hiển thị tên các hãng sữa
				$result=mysqli_query($dbc,$query);
				if(mysqli_num_rows($result)<>0){
					while($row=mysqli_fetch_array($result)){
						$maloainv=$row['MALOAINV'];
						$tenloainv=$row['TENLOAINV'];
						echo "<option value='$maloainv' "; 
								if(isset($_REQUEST['loainhanvien']) && ($_REQUEST['loainhanvien']==$maloainv)) echo "selected='selected'";
						echo ">$tenloainv</option>";
					}
				}
				mysqli_free_result($result);
			?>								
		</select>
	</td>
</tr>
<tr>
	<td>PHÒNG: </td>
	<td><select name="phongban">
			<?php 
				$query="select * from phongban";	//Hiển thị tên các loại sữa
				$result=mysqli_query($dbc,$query);
				if(mysqli_num_rows($result)<>0){
					while($row=mysqli_fetch_array($result)){
						$maphong=$row['MAPHONG'];
						$tenphong=$row['TENPHONG'];
						echo "<option value='".$maphong."' "; 
							if(isset($_REQUEST['phongban']) && ($_REQUEST['phongban']==$maphong)) echo "selected='selected'";
						echo ">".$tenphong."</option>";
					}
				}
				mysqli_free_result($result);
			?>								
		</select>
	</td>
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
	if(empty($_POST['MANV'])){
		$errors[]="Bạn chưa nhập mã nhân viên";
	}
	else{
		$manv=trim($_POST['MANV']);
	}

	if(empty($_POST['HO'])){
		$errors[]="Bạn chưa nhập họ nhân viên";
	}
	else{
		$honv=trim($_POST['HO']);
	}
	//kiểm tra tên sản phẩm
	if(empty($_POST['TEN'])){
		$errors[]="Bạn chưa nhập tên nhân viên";
	}
	else{
		$tennv=trim($_POST['TEN']);
	}

	if(empty($_POST['NGAYSINH'])){
		$errors[]="Bạn chưa nhập ngày sinh";
	}
	else{
		$ngaysinh=trim($_POST['NGAYSINH']);
	}

	if(empty($_POST['GIOITINH'])){
		$errors[]="Bạn chưa nhập giới tính";
	}
	else{
		$gioitinh=trim($_POST['GIOITINH']);
	}

	if(empty($_POST['DIACHI'])){
		$errors[]="Bạn chưa nhập địa chỉ";
	}
	else{
		$diachi=trim($_POST['DIACHI']);
	}

	if($_FILES['hinh']['name']!=""){
		$hinh=$_FILES['hinh'];
		$ten_hinh=$hinh	['name'];
		$type=$hinh['type'];
		$size=$hinh['size'];
		$tmp=$hinh['tmp_name'];
		if(($type=='image/jpeg' || ($type=='image/bmp') || ($type=='image/gif') && $size<8000))
		{
			move_uploaded_file($tmp,"images/".$ten_hinh);
		}
	}

	$maloainv=$_POST['loainhanvien'];
	$maphong=$_POST['phongban'];
	
	if(empty($errors))//neu khong co loi xay ra
	{ 
		$query="INSERT INTO nhanvien VALUES ('$manv','$honv','$tennv','$ngaysinh','$gioitinh','$diachi','$ten_hinh','$maloainv','$maphong')";
		$result=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){//neu them thanh cong
			echo "<div align='center'>Thêm mới thành công!</div>";			
			$query="Select * from nhanvien WHERE MANV ='". $manv. "'";
			$result=mysqli_query($dbc,$query);
			/*
			if(mysqli_num_rows($result)==1)
			{	$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
				echo '<table align="center" border="1" cellpadding="5" cellspacing="5" style="border-collapse:collapse;">
						<tr bgcolor="#eeeeee"><td colspan="2" align="center"><h3>'.$row['MANV'].' - '.$row['TENNV'].'</h3></td></tr>';		
			}
			*/
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
mysqli_close($dbc);
?>
</body>
</html>

