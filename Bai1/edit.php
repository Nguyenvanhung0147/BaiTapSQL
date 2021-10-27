<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Thông tin nhân viên</title>
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
    $sql = "SELECT * FROM nhanvien WHERE MANHANVIEN='$id' ";
    $edit=mysqli_query($dbc,$sql);
    $rows = mysqli_fetch_array($edit);

?>
<form action="" method="post" enctype="multipart/form-data">
<table bgcolor="#eeeeee" align="center" width="60%" border="0">
<tr bgcolor="#eeee10">
	<td colspan="2" align="center"><font color="blue"><h2>SỬA NHÂN VIÊN</h2></font></td>
</tr>
<tr>
	<td>Mã nhân viên: </td>
	<td><input type="text" name="MANV" size="20" disabled value="<?php echo $rows[0];?> " /></td>
</tr>
<tr>
	<td>Họ: </td>
	<td><input type="text" name="HO" size="50" value="<?php echo $rows[1];?>" /></td>
</tr>
<tr>
	<td>Tên: </td>
	<td><input type="text" name="TEN" size="50" value="<?php echo $rows[2];?>" /></td>
</tr>
<tr>
	<td>Ngày sinh: </td>
	<td><input type="text" name="NGAYSINH" size="50" value="<?php echo $rows[3]?>" /></td>
</tr>
<tr>
	<td>Giới Tính: </td>
	<td><input type="text" name="GIOITINH" size="50" value="<?php echo $rows[4]?>" /></td>
</tr>
<tr>
	<td>Địa chỉ: </td>
	<td><input type="text" name="DIACHI" size="50" value="<?php echo $rows[5]?>" /></td>
</tr>
<tr>
	<td>Hình ảnh: </td>
	<td><input type="FILE" name ="hinh" size="80" value="<?php if(isset($_POST['hinh'])) echo $_POST['ANH'];?>" /></td>
</tr>
<tr>
	<td>Loại NV:</td>
	<td><select name="loainhanvien">
			<?php 
				$query="select * from loainhanvien";	
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
				$query="select * from phongban";	
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
	<td colspan="2" align="center"><input type="submit" name ="sua" size="10" value="Chỉnh sửa" /></td>
</tr>
</table>
</form>
<?php
if($_SERVER['REQUEST_METHOD']=="POST"){
	$errors=array(); //khởi tạo 1 mảng chứa lỗi
	//kiem tra ma sua
	$manv=$id;

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
		$query="UPDATE nhanvien SET 
        MANHANVIEN='$manv',
        HO='$honv',
        TEN='$tennv',
        NGAYSINH='$ngaysinh',
        DIACHI='$diachi',
        ANH='$ten_hinh',
        MALOAINV='$maloainv',
        MAPHONG='$maphong' WHERE  MANHANVIEN='$manv'
        ";
		$result=mysqli_query($dbc,$query);
		if(mysqli_affected_rows($dbc)==1){//neu them thanh cong
			echo "<div align='center'>Chỉnh sửa thành công!</div>";			
			header("location:index.php");
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