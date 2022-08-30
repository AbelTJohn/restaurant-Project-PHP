<?php
include('../config/constants.php');

    if(isset($_GET['id']) && isset($_GET['image_name']))  //either use && or AND
    {

        //process to delete
        //1.get id and image name
        $id=$_GET['id'];
        $image_name=$_GET['image_name'];

        //2.remove the image if avilable
        //check weather the image is avilable or not and delete only if avialble
        if($image_name !="")
        {
            //it has image need to remove from the folder
            //get image path
            $path="../images/food/".$image_name;

            $remove=unlink($path);

            //check weather the image is removed or not
            if($remove==false)
            {
                //failed to remove
                $_SESSION['upload']="<div class='error'>Failed to remove image file </div>";
                header('location:'.HOME.'admin/manage-food.php');
                die();
            }
        }


        //3.delete food from database
        $sql="DELETE FROM tbl_food WHERE id=$id";

        //execution
        $res=mysqli_query($conn,$sql);

        //check weather the query executed or not and set the sesion message resp
        if($res==true)
        {
            //food deleted
            $_SESSION['delete']="<div class='sucess'>Food Deleted Sucessfully</div>";
            header('location:'.HOME.'admin/manage-food.php');

        }
        else
        {
            //failed to delete
            $_SESSION['delete']="<div class='error'>Fail to  Delete Food</div>";
            header('location:'.HOME.'admin/manage-food.php');

        }


        //4.redirect to manage food


    }
    else
    {

        //redirect to manage foood page
        $_SESSION['unauthorised']="<div class='error'>Unauthorised Acess</div>";
        header('loaction:'.HOME.'admin/manage-food.phph');

    }





?>