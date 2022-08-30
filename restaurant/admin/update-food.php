<?php  include('Partials/menu.php') ;  ?> 

<?php

    //check weather id is set or not
    if(isset($_GET['id']))
    {
        //get all the details
        $id=$_GET['id'];

        //sql query to get the selectedd food
        $sql2="SELECT * FROM tbl_food WHERE id =$id";
        //execution
        $res2=mysqli_query($conn,$sql2);

        //get the value based on query executde
        $row=mysqli_fetch_assoc($res2);

        //get the individual values of selctedd food

        $title=$row['titile'];
        $descrption=$row['descrption'];
        $price=$row['price'];
        $current_image=$row['image_name'];
        $current_category=$row['category_id'];
        $featured=$row['featured'];
        $active=$row['active'];

    }
    else
    {
        //redirect to manage food
        header('location:'.HOME.'admin/manage-food.php');
    }

?>






<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1> <br><br><br>
       

        <form action="" method="post" enctype="multipart/form-data">


            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td><input type="text" name="titile" value="<?php echo $title;  ?>" ></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                    <textarea name="descrption" value="<?php echo $descrption; ?> " id="" cols="30" rows="5"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price" value="<?php echo $price; ?>" id=""></td>
                </tr>

                <tr>
                    <td>current Image</td>
                    <td>
                        <?php

                            if($current_image=="")
                            {
                                //if image not avilable
                                echo "<div class='error'>Image Not Avialble </div>";
                            }
                            else
                            {
                               // if avilable
                               ?>
                               <img src="<?php echo HOME; ?>images/food/<?php echo $current_image; ?> " height="100px" width="100px" alt="">

                               <?php
                            }

                        ?>
                    </td>
                </tr>

                <tr>
                    <td>Select New Image</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category" id="">

                            <?php
                                //query for get active categories
                                $sql="SELECT * FROM tbl_category WHERE  active='Yes'";
                                //execution
                                $res=mysqli_query($conn,$sql);
                                //count rows
                                $count=mysqli_num_rows($res);

                                ///check weatherr category avialbvle or not
                                if($count>0)
                                {
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        $category_title =$row['title'];
                                        $category_id =$row['id'];

                                        // echo"<option value='$category_id'>$category_title</option>";
                                        ?>
                                        <option <?php if($current_category==$category_id){echo"selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title;   ?></option>

                                        <?php
                                    }

                                }
                                else
                                {
                                    //categorey not avilable
                                    echo"<option value='0'>Categeory is not avilable</option>";
                                }

                            ?>


                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured</td>
                    <td>
                        <input <?php if($featured=="Yes"){echo"checked";} ?> type="radio" name="featured" value="Yes" id="">Yes
                        <input <?php if($featured=="No"){echo"checked";} ?> type="radio" name="featured" value="No" id="">No
                    </td>
                </tr>

                <tr>
                    <td>Active</td>
                    <td>
                        <input <?php if($active=="Yes"){echo"checked";} ?> type="radio" name="active"  value="Yes">Yes
                        <input <?php if($active=="No"){echo"checked";} ?> type="radio" name="active"  value="No">No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php $current_image;?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php

            if(isset($_POST['submit']))
            {
                //1.get all the detailes
                $id=$_POST['id'];
                $title=$_POST['titile'];
                $descrption=$_POST['descrption'];
                $price=$_POST['price'];
                $current_image=$_POST['current_image'];
                $category=$_POST['category'];

                $featured=$_POST['featured'];
                $active=$_POST['active'];

                //2,upload the image

                //check weather upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    $image_name=$_FILES['image']['name'];

                    //chek weather thw image name is avilable or not

                    //Auto rename the image
                    //get the extenstion of our image(.jpj .png ,gif ,etc)eg: food.jpg
                    $tmp=explode('.',$image_name);
                    $ext=end($tmp);
                   

                    $image_name="food-name".rand(0000,9999).'.'.$ext;

                    //get the source path and destination path

                    $src_path=$_FILES['image']['tmp_name'];
                    $des_path="../images/food/".$image_name;

                    //upload the image
                    $upload=move_uploaded_file($src_path,$des_path);

                    //ceck weather the image is upload or not
                    if($upload==false)
                    {
                        $_SESSION['upload']="<div class='error'>Failed to upload new image </div>";
                        header('location:'.HOME.'admin/manage-food.php');
                        die();
                    }

                    ///remove current image
                    if($current_image !=="")
                    {
                        $remove_path="../images/food/".$current_image;
                        $remove=unlink($remove_path);

                        //check weather the image is remove or not
                        if($remove==false)
                        {
                            $_SESSION['remove']="<div class='error'>Failed to remove image</div>";
                            header('location:'.HOME.'admin/manage-food.php');
                            die();
                        }

                    }
                }
                else
                {
                    $image_name=$current_image;
                }
                

                //.4.update database
                $sql3="UPDATE tbl_food SET titile='$title',descrption='$descrption',
                price=$price,image_name='$image_name',category_id='$category',
                featured='$featured',active='$active' WHERE id=$id";

                //execute the sql
                $res3=mysqli_query($conn,$sql3);

                //check weather execute or not
                if($res3==true)
                {
                    $_SESSION['update']="<div class='sucess'>Food Updated Sucessfully</div>";
                    header('location:'.HOME.'admin/manage-food.php');
                }
                else
                {
                    $_SESSION['update']="<div class='error'>Failed to Update Food</div>";
                    header('location:'.HOME.'admin/manage-food.php');
                }




            }


        ?>


    </div>
</div>












<?php  include('Partials/footer.php') ;  ?> 
