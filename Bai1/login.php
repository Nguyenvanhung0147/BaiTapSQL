<?php
  session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>LOGIN</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<style>
   body{
    margin: 0;
    padding: 0;
    background:url(images/backgound-img2.jpeg);
    background-size:cover ;
    background-position:center ;
    font-family: sans-serif;

}

.loginbox{
    width: 320px;
    height: 420px;
    background:sandybrown;
    color: snow;
    top: 50%;
    left: 50%;
    position: absolute;
    transform: translate(-50%,-50%);
    box-sizing: border-box;
    padding: 70px 30px;

}

.avatar{
    width: 100px;
    height: 100px;
    border-radius: 50%;
    position: absolute;
    top:-50px;
    left: 111px;
}
.h1{
    margin: 0;
    padding: 0 0 20px;
    text-align: center;
    font-size: 22px;

}

.loginbox p{
    margin: 0;
    padding: 0;
    font-weight: bold;
}

.loginbox input{
    width: 100%;
    margin-bottom: 20px;

}
.loginbox input[type="text"], input[type=password]
{
    border: none;
    border-bottom: 1px solid #fff ;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;    
}
.loginbox input[type="submit"]{
    border: none;
    outline: none;
    height: 40px;
    background: #fff;
    color: sandybrown;
    font-size: 18px;
    border-radius: 20px;
}

.loginbox input[type="submit"]:hover{
    cursor: pointer;
    background: #ffc107;
    color: black;
    
}
.loginbox a{
    text-decoration: none;
    font-size: 16px;
    line-height: 20px;
    color: #fff;
}
.loginbox a:hover{
    color: black;
}
.loginbox h1{
    text-align: center;
}
</style>
</head>
<body>

<?php
require("connect.php");
  $error=array();
  $username="";
  $password="";
  $usernameErr="";
  $passwordErr="";
  $accountErr="";
  $thongbao="";

  if($_SERVER['REQUEST_METHOD']=='POST'){
      $username = $_POST['username'];
      $password = $_POST['password'];
    
      if((empty($password))&&(empty($username))){
        $accountErr=" vui long nhap tai khoan";
        $error[]= $accountErr;
        $thongbao=$accountErr;
      }
        else if(empty($username)){
            $usernameErr="vui long nhap username";
            $error[]= $usernameErr;
            //echo $usernameErr;
            $thongbao=$usernameErr;
        }
            else if(empty($password)){
                $passwordErr=" vui long nhap pass";
                $error[]= $passwordErr;
               // echo $passwordErr;
               $thongbao=$passwordErr;
            }
    
      if(empty($error)){
          $sql = "SELECT * FROM user WHERE username='$username' AND pass='$password'"; 
          $result =mysqli_query($dbc,$sql);

          if(mysqli_num_rows($result)>0){
             
              $_SESSION['username']=$username;
              header('location: index.php');
              
             }  
            else{
                    echo "vui long nhap chinh xac tai khoan ";
              }

      }
  }

 ?>


        <div class="loginbox">
            <img src="images/icon2.png" class="avatar">
                <h1>LOGIN HERE</h1>
                <form action="login.php" method="post">
                    <P>Username</P>
                    <input type="text" name="username" placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" name="password" placeholder="Enter Password">
                  
                    <input type="submit" name="login" value="Login">
                    <h2><?php echo$thongbao?> </h2>
                </form>
        </div>
</body>