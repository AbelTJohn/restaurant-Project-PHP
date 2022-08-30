<?php include('Partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br> <br>

        <?php

           //CHECK WEATHER THE ID IS SET OR NOT
           if(isset($_GET['id']))
           {
            //get the id and all other details
            $id=$_GET['id'];

            //create sql query to get all other details
            $sql="SELECT * FROM tbl_category WHERE id=$id";

            //execution
            $res=mysqli_query($conn,$sql);

            //count the rows to check weather the id is valid or not
            $count=mysqli_num_rows($res);

               if($count==1)
               {
                 //get all data
                 $row= mysqli_fetch_assoc($res);
                 $id=$row['id'];
                 $title= $row['title'];
                 $current_image=$row['image_name'];
                 $featured = $row['featured'];
                 $active=$row['active'];

                }
                 else
                {
                   //message
                   $_SESSION['no-category-found']= "<div class='error'>Category Not Found</div>";
                   header('location:'.HOME.'admin/manage-category.php');

                }

           }
           else
           {
            //rediret to manage category
            header('loaction:'.HOME.'admin/manage-category.php');

           }

        ?>

        <form action="" method="post" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
                <td>Current Image</td>
                <td>
                    <?php
                        if($current_image != "")
                        {
                            //display image
                            ?>
                            <img src="<?php echo HOME; ?>images/category/<?php echo $current_image; ?>" width="100px" alt="">

                            <?php
                        }
                        else
                        {
                            //display message
                            echo "<div class='error'>Image Not Added</div>";
                        }

                    ?>
                </td>
            </tr>
            
            <tr>
                <td>New Image</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes" id="">Yes
                    <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No" id="">No
                </td>
            </tr>

            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active"  value="Yes" id="">Yes
                    <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active"  value="No" id="" > No
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>" >
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" value="Update Category" name="submit">
                </td>
            </tr>

        </table>
        </form>

        <?php

                if(isset($_POST['submit']))
                {
                    // echo "clicked";
                    //1.get alll the values from the form
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //2.updating the image if selected

                    //check weathear the image is selected or not
                    if(isset($_FILES['image']['name']))
                    {
                        //get the image detatils
                        $image_name=$_FILES['image']['name'];

                        //check weather the image is avilabve or not
                        if($image_name!="")
                        {
                            //image is avilable

                            //upload the image


                            //Auto rename the image
                            //get the extenstion of our image(.jpj .png ,gif ,etc)eg: food.jpg
                            $ext=end(explode('.',$image_name));

                            //rename the image
                            $image_name = "food_category_".rand(000,999,).'.'.$ext; //food_category_834.jpg


                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path ="../images/category/".$image_name;

                            //finally upload the image
                            $upload = move_uploaded_file($source_path,$destination_path);

                            //check weather the oimage is uploaded or not 
                            //and if the image is not uploaded then we will stop the process and redirect with error mesage
                            if($upload==false)
                            {
                                //set meassage
                                $_SESSION['upload']= "<div class='error'> Failed to upload </div>";

                                header('loaction:'.HOME.'admin/manage-category.php');
                                //stop the process
                                die();
                            }



                            //remove the current image if avaliable

                            if($current_image !="")
                            {
                                $remove_path="../images/category/".$current_image;
                                $remove=unlink($remove_path);
    
                                //check weather the image is removed or not 
                                //if fail to remnove display message and stop process
    
                                if($remove==false)
                                {
                                    //failed to remove
                                    $_SESSION['failed-remove']="<div class='error'>Failed to remove</div>";
                                    header('location:'.HOME.'admin/manage-category.php');
                                    die();
                                }

                            }

                           

                        }
                        else
                        {
                            $image_name=$current_image;

                        }

                    }
                    else
                    {
                        $image_name=$current_image;
                    }


                    //3.updating the data base

                    $sql2="UPDATE tbl_category SET title='$title', image_name='$image_name', featured='$featured', active='$active'
                    WHERE id=$id";

                    // execution
                    $res2=mysqli_query($conn,$sql2);

                    //check weather executed or not
                    if($res2==true)
                    {
                        $_SESSION['update']="<div class='sucess'>Category updated sycessfully</div>";
                        header('location:'.HOME.'admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['update']="<div class='sucess'>Failed to  updated Category </div>";
                        header('location:'.HOME.'admin/manage-category.php');
                    }



                }

        ?>



    </div>
</div>




<?php include('Partials/footer.php'); ?>

