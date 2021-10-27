<html>
    <head>
        <title>Xóa nhân viên</title>
    </head>
    <body>
        <?php 
            require('connect.php');
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <table bgcolor="#eeeeee" align="center" width="60%" border="0">
                <tr bgcolor="#eeee10">
                        <td colspan="2" align="center"><font color="blue"><h2>XÓA NHÂN VIÊN </h2></font></td>
                </tr>
                <tr>
                        <td>Mã nhân viên cần xóa: </td>
                        <td><input type="text" name="MANV" size="20" value="<?php if(isset($_POST['MANV'])) echo $_POST['MANV'];?>" /></td>
                </tr>
                <tr>
                        <td colspan="2" align="center"><input type="submit" name ="xoa" size="10" value="Xóa nhân viên" /></td>
                </tr>
            </table>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD']=="POST"){
                $errors=array(); //khởi tạo 1 mảng chứa lỗi
                //kiem tra ma nhan vien
                if(empty($_POST['MANV'])){
                        $errors[]="Bạn chưa nhập mã nhân viên";
                }
                else{
                        $ma_nv=trim($_POST['MANV']);
                }
                if(empty($errors)){
                $sql = "DELETE FROM nhanvien WHERE MANV='$ma_nv'";
                $result=mysqli_query($dbc,$sql);
                if(mysqli_affected_rows($dbc)==1){
                    //xoa thanh cong
                    echo "<div align='center'>Xóa thành thành công!</div>";
                }
                else //neu khong them duoc
		{
			echo "<p>Có lỗi, không thể xóa được</p>";
			echo "<p>".mysqli_error($dbc)."<br/><br />Query: ".$sql."</p>";	
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


