<?php
include('../config/constants.php');

//1.get the id of admin to be deleted

$id=$_GET['id'];

//2.create sql query to delete admin

$sql= "DELETE FROM tbl_admin WHERE id=$id";

//Execute the query

$res= mysqli_query($conn,$sql);

//check weather the query ecectued sucessfully or not
if($res=true){
//  echo" Admin Deleted";
//create session variable displayn message
$_SESSION['delete']="<div class='sucess'>Delete admin sucessfully</div>";

header('location:'.HOME.'admin/manage-admin.php');

}else{
    $_SESSION['delete']="<div class='error'>failed to delete admin</div>";
    header('location:'.HOME.'admin/manage-admin.php');

}
//3rediret to manage admin page with a message(ssucess or error)


?>