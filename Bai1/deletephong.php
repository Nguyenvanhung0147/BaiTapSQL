<?php
require("connect.php");
  $id=$_REQUEST['id'];
  
// Chuan bi cau truy van & Thuc thi cau truy van

  $delete = "DELETE FROM phongban WHERE MAPHONG='$id'";
  if(mysqli_query($dbc,$delete)){
    echo "Xóa thành công !";
    header('location:maphong.php');
  }
  else echo "Xóa không thành công !";

?>