<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="warpper">
        <h1>Add Category</h1>
        <br>
        
        <?php

        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
         ?>
<br><br><br>
        <!-- Add category form starts here --->
        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image</td>
                    <td>
                        <input type="file" name="image" id="">
                    </td>
                </tr>


                <tr>
                    <td>Featured</td>
                    <td>
                        <input type="radio" name="featured" value="yes" id="">Yes
                        <input type="radio" name="featured" value="no" id="">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes" id="">Yes
                        <input type="radio" name="active" value="no" id="">No
                    </td>
                    <tr>
                        <td colspan="2">
                            <input type="submit" value="Add category" name="submit" class="btn-secondary">

                        </td>
                    </tr>
                </tr>
            </table>
        </form>

         <!-- Add category form starts here --->

         <?php
         //check weather the button is clicked
         if(isset($_POST['submit']))
         {
            //echo clicked;

            //1.get the value from the category form
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            
            //FOR RADIO BUTTON INPUT ,WE NEED TO CHECK WEATHER THE BUTTON IS CLICKED OR NOT
            if(isset($_POST['featured']))
            {
                //get from thr value from the form
                $featured=$_POST['featured'];

            }
            else
            {
                $featured = "No";

            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];

            }
            else
            {
                $active = 'No';

            }

            //CHECK WEATHER THE IMAGE IS SELECTED OR NOT AND SET THE VALUE FOR IMAGE NAME ACCORIDINGLY
            // print_r($_FILES['image']);
            
            // die();//break the code
            if(isset($_FILES['image']['name']))
            {
                //upload the image
                //to upload image we need image name, source path and destination path
                $image_name = $_FILES['image']['name'];

                //upload the image only if image is selected
                if($image_name != "")
                {
                           
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

                            header('loaction:'.HOME.'admin/add-category.php');
                            //stop the process
                            die();
                        }

                 }
            }
            else
            {
                //dont upload the image and set the image name value as blank
                $image_name="";
            }

            //2.Create sql query to insert into database
            $sql = " INSERT INTO tbl_category SET title='$title',image_name='$image_name',featured='$featured',active='$active'";
            
            //execute
            $res=mysqli_query($conn,$sql);

            //4.check weather the query executed or not and data added or not
            if($res==true)
            {
                //Query executed 
                $_SESSION['add']="<div class='sucess'>Category Added Sucessfully.</div>";
                header('location:'.HOME.'/admin/manage-category.php');

            }
            else
            {
                //failed 
                $_SESSION['add']="<div class='error'> Failed to add Category .</div>";
                header('location:'.HOME.'/admin/add-category.php');
                

            }
         }

         ?>








    </div>
</div>





<?php include('partials/footer.php'); ?>