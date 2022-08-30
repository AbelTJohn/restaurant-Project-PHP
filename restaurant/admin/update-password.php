<?php include('partials/menu.php'); ?>

<div class="maun-content">
    <div class="wrapper">
        <h1>Change Password</h1><br><br>

        <?php
if(isset($_GET['id'])){

    $id=$_GET['id'];

}


?>
        <form action="" method="post">

            <table class="tbl-30">
                <tr>
                    <td>Current Password:</td>
                    <td><input type="password" name="old_password" placeholder="Enter old password"></td>
                </tr>
                <tr>
                    <td>New password</td>
                    <td><input type="password" name="new_password" placeholder="Enter new password"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="confirm_password" id="" placeholder="Confirm password"></td>
                </tr>
                <tr>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <td colspan="2"><input type="submit" value="Change Password" name="submit" class="btn-secondary"></td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
 //check wheather the submit button is clicked or not

 if(isset($_POST['submit'])){
    //echo clicked

    //1.get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

       //2.check wheather the user with current id and current password exits or not
       $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";

            //3.check wheather the new password and confirm password match or not

            $res=mysqli_query($conn,$sql);

        if($res==true){
            //check weather data is avaliable or not
            $count=mysqli_num_rows($res);
    
            if($count==1)
            {
                echo "User Founnd";
                //   user does exists and password can be changed
                //   check weather the new password and confirm password match ot not

               if($new_password==$confirm_password)
               {
                      //update password
                    //   echo "Password match";
                       $sql2= "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";
                      //execution
                      $res2 = mysqli_query($conn,$sql2);
                      //check weather the query executed or not
                    if($res2==true){
                        //user does not exists and set a message and redirect
                        $_SESSION['changed-password']= "<div class='sucess'>Password Change</div>";
                        //redirect
                         header('location:'.HOME.'admin/manage-admin.php');

                    }else{
                         //user does not exists and set a message and redirect
                        $_SESSION['not-changed']= "<div class='error'>Failed to change password</div>";
                        //redirect
                        header('location:'.HOME.'admin/manage-admin.php');
                        }
               }else{
                      //user does not exists and set a message and redirect
                      $_SESSION['password-not-mathch']= "<div class='error'>password didnot match</div>";
                     //redirect
                     header('location:'.HOME.'admin/manage-admin.php');
                     }
           }else{
                   //user does not exists and set a message and redirect
                   $_SESSION['user-not-found']= "<div class='error'>user Not Found</div>";
                   //redirect
                   header('location:'.HOME.'admin/manage-admin.php');
                      }
        }
             //4.change password if all above is true

 }

 


?>



<?php include('partials/footer.php'); ?>