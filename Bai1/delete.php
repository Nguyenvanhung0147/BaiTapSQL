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
// Ket noi CSDL
require("connect.php");
require("header.php");

  $id=$_REQUEST['id'];
  $thongbao="";
// Chuan bi cau truy van & Thuc thi cau truy van
$strSQL = "SELECT * FROM nhanvien WHERE MANHANVIEN='$id'";
$result = mysqli_query($dbc,$strSQL);
if($_SERVER['REQUEST_METHOD']=='POST'){
  $delete = "DELETE FROM nhanvien WHERE MANHANVIEN='$id'";
  if(mysqli_query($dbc,$delete)){
    echo "Xóa thành công !";
    header('location:index.php');
  }
  else echo "Xóa không thành công !";
}
// Xu ly du lieu tra ve
if(mysqli_num_rows($result) == 0)
{
	echo "Chưa có dữ liệu";
}
else
{
    while($row = mysqli_fetch_array($result)){
    
?>	
   
    <div class="container">
      <div class="row" style="margin-top: 50px;">
        <div class="col-lg-6 col-sm-6">
            <div class="phone hidden-xs">
              <div class="phone-box">
                    <?php echo '<img style="width :250px;float:right" src="images/'.$row['ANH'].'"/>';?>
              </div>
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6" style="display: inline-flex;">
            <h3>
            <?php
                echo 'Mã Nhân Viên: '.$row[0] .'<br>';
                echo 'Họ: '.$row[1] .'<br>';
                echo 'Tên: '.$row[2] .'<br>';
                echo 'Ngày Sinh: '.$row[3] .'<br>';
                echo 'Giới Tính: '.$row[4] .'<br>';
                echo 'Địa chỉ: '.$row[5] .'<br>';
                echo 'Mã Loại Nhân Viên: '.$row[7] .'<br>';
                echo 'Mã phòng: '.$row[0] .'<br>';
            ?>
            </h3>   
      </div>
      </div>
    </div>

    <center>
    <?php
        echo $thongbao;
    ?>
    <form method="POST" enctype="multipart/form-data" style="margin: auto;">
              <input type="submit" value="DELETE" name="delete"  style="height: 20px";> 
            </form>
                     
    <a href='index.php'>Quay lại</a>
    </center>
 <?php
}   
}

//Dong ket noi
mysqli_close($dbc);
?>
</body>
</html>
