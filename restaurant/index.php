<?php include('partials-front/menu.php'); ?>




    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="<?php HOME; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
if(isset($_SESSION['order']))
{
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}


?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php

                //create sql query to displat categories from database
                $sql="SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";
                //execute
                $res=mysqli_query($conn,$sql);

                //count to check weather category is avilable or not
                $count=mysqli_num_rows($res);
                
                if($count>0)
                {
                    //categorey is avilable
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the value like id title image_name
                        $id=$row['id'];
                        $title=$row['title'];
                        $image_name=$row['image_name'];
                        ?>

                            <a href="<?php echo HOME;  ?>category-foods.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">

                                <?php 

                                //check weather the image is avilable or not

                                if($image_name=="")
                                {
                                    echo  "<div class='error'> Image Not Avilable</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo HOME; ?>images/category/<?php echo $image_name; ?>" alt="Food category" class="img-responsive img-curve">

                                    <?php
                                }
                                
                                ?>
                                    

                                    <h3 class="float-text text-white"><?php echo $title;   ?></h3>
                                </div>
                            </a>

                        <?php
                    }
                }
                else
                {
                    //categorie not avilable
                    echo "<div class='error'>Category Not Avilable</div>";

                }


            ?>

           

           

          

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                //geeting foods from the database that are active and featured
                //sql query

                $sql2="SELECT * FROM tbl_food WHERE active='yes' AND featured='yes' LIMIT 6";

                //execution
                $res=mysqli_query($conn,$sql2);

                $count2=mysqli_num_rows($res);

                //check weather avilable or not
                if($count2>0)
                {
                    //food avilable
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get all datas
                        $id=$row['id'];
                        $titile=$row['titile'];
                        $price=$row['price'];
                        $descrption=$row['descrption'];
                        $image_name=$row['image_name'];

                        ?>
                          <div class="food-menu-box">
                                <div class="food-menu-img">

                                <?php

                                    if($image_name=="")
                                    {
                                        //image not avilable
                                        echo"<div class='error'>Image Not Avilable</div>";

                                    }
                                    else
                                    {
                                        //image avilable
                                        ?>
                                        <img src="<?php echo HOME; ?>images/food/<?php echo $image_name;  ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                        <?php


                                    }

                                ?>
                                     
                                 </div>

                                 <div class="food-menu-desc">
                                      <h4><?php  echo $titile;  ?></h4>
                                        <p class="food-price"><?php echo $price;  ?></p>
                                         <p class="food-detail">
                                          <?php echo $descrption;  ?>
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
                    echo"<div class='error'>Food Not Avilable</div>";

                }

            ?>



          

           



            <div class="clearfix"></div>



        </div>

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

   <?php include('partials-front/footer.php');      ?>