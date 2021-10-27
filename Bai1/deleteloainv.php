<?php
require("connect.php");
  $id=$_REQUEST['id'];
  
// Chuan bi cau truy van & Thuc thi cau truy van

  $delete = "DELETE FROM loainhanvien WHERE MALOAINV='$id'";
  if(mysqli_query($dbc,$delete)){
    echo "Xóa thành công !";
    header('location:maloai.php');
  }
  else echo "Xóa không thành công !";

?>