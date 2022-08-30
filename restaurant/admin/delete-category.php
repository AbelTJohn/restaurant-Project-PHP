<?php
include('../config/constants.php');

//echo "delete page;
//check weather the id and image_name 

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //get the value and delete

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    //remove the physical image file is avilable
    if($image_name !="")
    {
        //image is avilable.so removeit.
        $path="../images/category/".$image_name;
        //remove the image
        $remove = unlink($path);

        if($remove == false)
        {
            //set the sesion message
            $_SESSION['remove']="<div class='error'>Failed to remove the category image.</div>";
            //redirect to manage category page
            header('location:'.HOME.'admin/manage-category.php');
            //stop the process
            die();
        }
    }


    //delete data from the database
    $sql="DELETE FROM tbl_category WHERE id=$id";

    //execute
    $res=mysqli_query($conn,$sql);

    //check weather the data is deleted from data base
    if($res==true)
    {
        //set sucess message
        $_SESSION['delete']= "<div class='sucess'>Cateory deleted sucessfully.</div>";

        header('location:'.HOME.'admin/manage-category.php');
    }
    else{
        //set fail mesage
        $_SESSION['delete']= "<div class='error'> Failed  to cateory delete.</div>";

        header('location:'.HOME.'admin/manage-category.php');
    }
}
else
{
    //rdirect to manage category
    header('location:'.HOME.'admin/manage-category.php');

}


?>