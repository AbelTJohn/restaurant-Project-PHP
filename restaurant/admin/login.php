<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login-Food order</title>
 <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login">
        <h1 class="text-center">Login</h1> <br><br> 

        <?php
         if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
         }

         if(isset( $_SESSION['no-login-message'])){
            echo  $_SESSION['no-login-message'];
            unset( $_SESSION['no-login-message']);
         }
        ?>

        <!-- login form start here -->
        <form action="" method="post" class="text-center">

        username: <br>
        <input type="text" name="username" placeholder="Enter your name"><br><br>

        Password: <br>
        <input type="password" name="password" placeholder="Enter password"><br><br>

        <input type="submit" name="submit" value="Login" class="btn-primary">
        </form>
        
        <p class="text-center">Created by <a href="">Abel T ohn</a></p>
    </div>
     <!-- login form  END here -->

</body>
</html>

<?php
//CHECK WEATHER THE SUBMIT BUTTON CLICKED OR NOT

if(isset($_POST['submit']))
{
    // 1.GET THE DATA FROM THE FORM
    // $username= $_POST['username'];
    // $password = md5($_POST['password']);
   $username= mysqli_real_escape_string($conn,$_POST['username']);
    $raw_password = md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$raw_password);

    //2.sql to check weather the username or password exits

   $sql= "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    //EXECUTE
    $result =mysqli_query($conn,$sql);
  
    //COUNT ROWS  TO CHECK WEATHER THE USER EXITS OR NOT
    $count = mysqli_num_rows($result);

    if($count==1)
    {
        //USER AVALIABLE AND LOGIN SUCESS

        $_SESSION['login']= "<div class='sucess'>login Sucessfully</div>";

        $_SESSION['user']=$username;//to check weather login or not and logout will unset it

        //redirect
        header('location:'.HOME.'admin/');
    }
    else
    {
        //USER  NOT AVALIABLE AND LOGIN FAIL

         $_SESSION['login']= "<div class='error text-center'>Username or password did not match.</div>";
         //redirect
          header('location:'.HOME.'admin/login.php');
    }
    
}

?>