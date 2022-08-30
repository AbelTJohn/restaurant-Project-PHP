<?php include('partials-front/menu.php');      ?>

<?php
   //check weather the id is passes or not
   if(isset($_GET['category_id']))
   {
        //category is ids set and get the id
        $category_id=$_GET['category_id'];
        //CATEGORY TITILEbased on category id

        $sql="SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the query
        $res=mysqli_query($conn,$sql);

        //get the value from databasse
        $row= mysqli_fetch_assoc($res);

        //get the title
        $category_title=$row['title'];

   }
   else
   {
    //redirect
    header('location:'.HOME);
   }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php  echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //create sql qurey to get foods based on seleceted category
                $sql2="SELECT * FROM tbl_food WHERE category_id=$category_id";

                //execute
                $res2=mysqli_query($conn,$sql2);

                $count2=mysqli_num_rows($res2);

                //check weather food is avilable or not
                if($count2>0)
                {
                    //food is avilable
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id=$row2['id'];
                        $title=$row2['titile'];
                        $price=$row2['price'];
                        $description=$row2['descrption'];
                        $image_name=$row2['image_name'];
                        ?>

                            <div class="food-menu-box">
                                <div class="food-menu-img">

                                <?php
                                    //image name is avilable or not
                                    if($image_name=="")
                                    {
                                        //image not avilable
                                        echo "<div class='error'>Image Not Avilable</div>";
                                    }
                                    else
                                    {
                                        //image avilable
                                        ?>
                                         <img src="<?php echo HOME; ?>images/food/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>

                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $title;  ?></h4>
                                    <p class="food-price"><?php echo $price;  ?></p>
                                    <p class="food-detail">
                                    <?php echo $description;  ?>
                                    </p>
                                    <br>

                                    <a href="<?php echo HOME;  ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>



                        <?php
                    }
                }
                else
                {
                    //food not avilable
                    echo "<div class='error'>Food Not Found</div>";
                }


            ?>

            

           


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');      ?>