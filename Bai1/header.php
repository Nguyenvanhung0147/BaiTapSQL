

<?php
  session_start();
  if(!empty($_SESSION['username'])){
	  $name=$_SESSION['username'];

  }
  else{
	  header('location:login.php');
  }
?>
<html>
  
</html>

<div class="top-header">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-6">
            <div class="phone hidden-xs">
              <div class="phone-box">
                  <strong>Hotline:</strong>
                  <span>031.363.3364</span>
              </div>
            </div>
            <div class="welcome ">
                Xin chào bạn <?php echo $name?>
            </div>
        </div>
        
        <div class="col-lg-6 col-sm-6" style="display: inline-flex;">
          <div class="welcome ">
             <P> Cảm ơn bạn đã chọn dịch vụ của chúng tôi  </P>
          </div>
          <div class="button-signout" style="margin-left: 20px;">
            <form action="logout.php" method="post">
              <input type="submit" value="SIGN OUT" name="logout"  style="height: 20px";> 
            </form>
            
          </div>
      </div>
      </div>
    </div>
  </div>

<div id="header">
    <h1>CÔNG TY TÀI CHÍNH ABC</h1>
    <h2>VAY NÓNG, THỦ TỤC NHANH , GỌN , LẸ </h2>
</div>
<div style="background-color: lightblue;margin: auto;width: 950px;" id="navigation" >
    <ul>
        <li><a href="index.php">Trang chủ</a></li>
        <li><a href="maloai.php">Mã loại</a></li>
        <li><a href="maphong.php">Mã phòng</a></li>
        <li><a href="addnv.php">Thêm nhan vien</a></li>
        <li><a href="addphong.php">Thêm phòng</a></li>
        <li><a href="addloainv.php">Thêm loại NV</a></li>
        
    </ul>
</div>