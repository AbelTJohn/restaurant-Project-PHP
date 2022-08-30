<?php include('Partials/menu.php');  ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1><br><br>

        <?php
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>


        <form action="" method="post" enctype="multipart/form-data">


            <table class="tbl-30">

                <tr>
                    <td>Title</td>
                    <td><input type="text" name="titile" placeholder="title of food"></td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>
                        <textarea name="descrption" id="" cols="30" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" id="">
                    </td>
                </tr>

                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>

                <tr>
                    <td>Category</td>
                    <td>
                        <select name="category">

                            <?php
                                //create php code to display categories from database
                                //1. Create sql to get all the active categories from database
                                
                                $sql="SELECT * FROM tbl_category WHERE active='Yes'";

                                $res=mysqli_query($conn,$sql);

                                //count rows to check weather we have categories or not

                                $count =mysqli_num_rows($res);
                                //if count is greater than zero we have categoriss else we din't have ctegories
                                if($count>0)
                                {
                                    //we have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the detail of categories
                                        $id=$row['id'];
                                        $title =$row['title'];
                                        ?>
                                        <option value="<?php echo $id; ?>"><?php echo $title;   ?></option>

                                        <?php
                                    }

                                }
                                else
                                {
                                    //we do not have categories
                                    ?>
                                    <option value="0">No category Found</option>
                                    <?php

                                }

                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes" id="">Yes
                        <input type="radio" name="featured" value="no" id="">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php
        
            //check weather the button is ckicked

            if(isset($_POST['submit']))
            {
                //Add food to data base

                //1.get data from form

                $title=mysqli_real_escape_string($conn,$_POST['titile']);
                $descrption =mysqli_real_escape_string($conn,$_POST['descrption']);
                $price =mysqli_real_escape_string($conn,$_POST['price']);
                $category =mysqli_real_escape_string($conn,$_POST['category']);

                //check weather the radio button for featured and active are checked or not

                    if(isset($_POST['featured']))
                    {
                        $featured=$_POST['featured'];

                    }
                    else
                    {
                        $featured="No";

                    }
                    
                    if(isset($_POST['active']))
                    {
                        $active=$_POST['active'];
                    }
                    else
                    {
                        $active="No";
                    }




                //2.Upload the image if selected
                //check weather the image is clicked or not and upload image only if image is selected

                if(isset($_FILES['image']['name']))
                {
                    //get the details
                    $image_name=$_FILES['image']['name'];

                    //check weather the image is selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        //image is selected
                        //A. rename the image 
                        //get the extension of selected image (jpg,png,gif etc)
                        $ext=end(explode('.',$image_name));

                        //create new name
                        $image_name="food-name-".rand(0000,9999).".".$ext; //new image name is like "food-name-555.jpg"


                        //B.Upload the image
                        //get the src path and destination

                        //sourc path is the current location of the image

                        $src=$_FILES['image']['tmp_name'];

                        //destination path for the image to be uploaded
                    $dst="../images/food/".$image_name;
                    
                    //finaly upload food image

                    $upload = move_uploaded_file($src,$dst);

                    //check weathwe image upload of not
                    if($upload == false)
                    {
                        //failed to upload the image 
                        //rediret to add food page with error
                        $_SESSION['upload']="<div class='error'>Failed to upload Image </div>";
                        header('location:'.HOME.'admin/add-food.php');
                    }

                    }
                }
                else
                {
                    $image_name="";//setting default value
                }


                //3.insert into data base
                //crete an sql query
                //for numerical value we do not need to pass value inside quotes
                $sql2="INSERT INTO tbl_food SET titile='$title', descrption='$descrption',price='$price',
                image_name='$image_name',category_id=$category,
                featured='$featured',active='$active'   ";

                //exectute the query
                $res2 = mysqli_query($conn,$sql2);

                    if($res== true)
                    {
                        $_SESSION['add']="<div class='sucess'>Food Added Sucessfully</div>";
                        header('location:'.HOME.'admin/manage-food.php');

                    }
                    else
                    {
                        $_SESSION['add']="<div class='error'>Failed to  Add Food</div>";
                        header('location:'.HOME.'admin/manage-food.php');
                        
                    }

                //4.redirect to manage food page
            }

        ?>

    </div>
</div>







<?php include('Partials/footer.php');  ?>