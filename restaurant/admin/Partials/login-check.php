<?php
//Authorization
//check weather the user is logged in or not
if(!isset($_SESSION['user']))//if user session is not set
{
     //user is not logged in
     //redirect to login with message
     $_SESSION['no-login-message']="<div class='error text-center'>Please login to acesss admin panel</div>";
     //redirect login page
     header('location:'.HOME.'admin/login.php');

}

?>