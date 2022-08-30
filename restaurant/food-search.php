<?php include('partials-front/menu.php');      ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                    //get the search keyword 
                    // $search= $_POST['search'];
                    $search= mysqli_real_escape_string( $conn,$_POST['search']);
    ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search;  ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php



                //sql query food base on search
                //$search = burger'; drop database name ;
                //"SELECT * FROM tbl_food WHERE titile LIKE '%burger'%' OR description LIKE '%burger'%'";
                $sql="SELECT * FROM tbl_food WHERE titile LIKE '%$search%' OR descrption LIKE '%search%'";

                //execute
                $res=mysqli_query($conn,$sql);

                $count=mysqli_num_rows($res);

                //check wether food avilable or not
                if($count>0)
                {
                    //food avilable
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $title=$row['titile'];
                        $price=$row['price'];
                        $description=$row['descrption'];
                        $image_name=$row['image_name'];

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
                                    <h4><?php echo $title; ?></h4>
                                        <p class="food-price"><?php echo $price; ?></p>
                                     <p class="food-detail">
                                     <?php echo $description; ?>
                                        </p>
                                             <br>

                                     <a href="#" class="btn btn-primary">Order Now</a>
                                 </div>
                                </div>

                        <?php





                    
                        
                    }

                }
                else
                {
                    //food not avilable
                    echo"<div class='error'>Food not Found</div>";

                }
            ?>

           

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');      ?>