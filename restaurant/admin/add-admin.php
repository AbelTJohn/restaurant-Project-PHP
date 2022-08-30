<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <br>
        <h1>Add Admin</h1>
        <br><br><br>

        <?php

if(isset($_SESSION['add']))
{
    echo $_SESSION['add'];
    unset($_SESSION['add']);
}
        ?>

        <form action="" method="POST">

        <table class="tbl-30">

        <tr>
            <td>Full Name</td>
            <td><input type="text" name="full_name" placeholder="Enter your Name"></td>
        </tr>
        <tr>
            <td>User Name</td>
            <td><input type="text" name="user_name" placeholder="Enter your Username"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password" placeholder="Enter your Password"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" value="Add Admin" name="submit" class="btn-secondary">

        </td>
    </tr>
        </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>



<?php
//Process the value from form and save it in database
//check where the button is clicked or not

if(isset($_POST['submit'])){
    //Button Clicked

    //get the data from the form
    $full_name= mysqli_real_escape_string($conn,$_POST['full_name']);
    $user_name=mysqli_real_escape_string($conn,$_POST['user_name']);
    $raw_password=md5($_POST['password']);
    $password=mysqli_real_escape_string($conn,$raw_password);

    //sql query to save the data into data base

    $sql="INSERT INTO tbl_admin SET full_name='$full_name',username='$user_name',password='$password'";


 //excute the query and save into data base
 $res=mysqli_query($conn,$sql) or die();

 //chek wheather the query is excuted data 

 if($res==true)
 {
    //Create a session variable to display message
    $_SESSION['add'] ="Admin added sucessfully";
    //redirect page
    header("location:".HOME.'admin/manage-admin.php');
 }
 else
 {
    // echo"data not inserted";

    //Create a session variable to display message
    $_SESSION['add'] =" Fail to add Admin ";
    //redirect page
    header("location:".HOME.'admin/add-admin.php');
 }



}

?>