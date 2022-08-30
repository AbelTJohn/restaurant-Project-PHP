<?php include('partials/menu.php'); ?>

    <!-- main Content Section starts -->
    <div class="main-content">
    <div class="wrapper">
   <h1>DASHBOARD</h1><br><br>

   <?php
         if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
         }
        ?>
        <br><br>

   <div class="col-4 text-center">

   <?php

   $sql="SELECT * FROM tbl_category";

   $res=mysqli_query($conn,$sql);

   //count rows
   $count=mysqli_num_rows($res);


   ?>
    <h1><?php echo $count;?></h1> <br>
    Categories
   </div>


   <div class="col-4 text-center">
   <?php

$sql2="SELECT * FROM tbl_food";

$res2=mysqli_query($conn,$sql2);

//count rows
$count2=mysqli_num_rows($res2);


?>
    <h1><?php echo $count2; ?></h1> <br>
   Foods
   </div>


   <div class="col-4 text-center">
   <?php

$sql3="SELECT * FROM tbl_order";

$res3=mysqli_query($conn,$sql3);

//count rows
$count3=mysqli_num_rows($res3);


?>
    <h1><?php echo $count3; ?></h1> <br>
    Total Orders
   </div>


   <div class="col-4 text-center">

   <?php
   ///create sql qury to get the total
   //aggregate  function in sql

$sql4="SELECT SUM(total) AS total FROM tbl_order WHERE status='Delivered'";

$res4=mysqli_query($conn,$sql4);

//count rows
$row=mysqli_fetch_assoc($res4);

//get the total revenue
$total_revenu=$row['total'];


?>
    <h1><?php echo $total_revenu; ?></h1> <br>
    Revenu Generated
   </div>
   <div class="clearfix"></div>
  </div>

    </div>
    <!-- main Content ends -->



   <?php include('partials/footer.php'); ?>