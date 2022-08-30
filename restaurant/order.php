<?php include('partials-front/menu.php');      ?>

<?php
    //CHECK WEATHER FOOD ID IS SET OR NOT
    if(isset($_GET['food_id']))
    {
        //get the food id and details of the seleted food
        $food_id=$_GET['food_id'];

        ///get the details of the selected food
        $sql="SELECT * FROM tbl_food WHERE id=$food_id";

        $res=mysqli_query($conn,$sql);

        ///count
        $count=mysqli_num_rows($res);
        
        //check whether the data is avilable or not

        if($count==1)
        {
            //we have data 
            //GET THE DATA FROM THE DATABASE
            $row=mysqli_fetch_assoc($res);

            $title=$row['titile'];
            $price=$row['price'];
            $image_name=$row['image_name'];

        }
        else
        {
            //food not avilable
            //redirect
            header('location:'.HOME);
        }

    }
    else
    {
        ///redirect to homepage
        header('location:'.HOME);

    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" class="order" method="POST">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php

                            //check weather thw image is avilable
                            if($image_name=="")
                            {
                                //image not avilable
                                echo "<div class='error'>IMAGE NOT AVILABLE</div>";

                            }
                            else
                            {
                                //image avilable
                                ?>
                                <img src="<?php echo HOME; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">

                                <?php

                            }

                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;  ?>">
                        <p class="food-price"><?php echo $price;  ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Abel T John " class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. abel@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php

                //check weather submit button clickede or not
                if(isset($_POST['submit']))
                {
                    ///get allthe details from form
                    $food=$_POST['food'];
                    $price=$_POST['price'];
                    $qty=$_POST['qty'];

                    $total=$price * $qty;

                    $order_date=date("Y-m-d h:i:sa");

                    $status="Orderd"; ///ordered ,on delvery ,delivered, cancell

                    $coustomer_name=$_POST['full-name'];
                    $coustomer_contact=$_POST['contact'];
                    $coustomer_email=$_POST['email'];
                    $coustomer_address=$_POST['address'];

                    //save the data
                    //create sql

                    $sql3="INSERT INTO tbl_order SET
                    food='$food',price=$price,qty=$qty,
                    total=$total,order_date='$order_date',
                    status='$status',customer_name='$coustomer_name',
                    customer_contact='$coustomer_contact',customer_email='$coustomer_email',
                    customer_address='$coustomer_address'";
                   
                    
                    // echo $sql2; die();
                    //execute                                               
                    $res2=mysqli_query($conn,$sql3);

                    //check weather executed sucessfully or not

                    if($res2==true)
                    {
                        //query executed and oder saved
                        $_SESSION['order']="<div class='sucess text-center'>Order Placed </div>";
                        //redirect to home
                        header("location:".HOME);

                    }
                    else
                    {
                        //failed to save order
                        $_SESSION['order']="<div class='error text-center'>Falied to order</div>";
                        //redirect to home
                        header("location:".HOME);

                    }



                }

            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');      ?>