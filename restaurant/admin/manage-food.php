<?php include('partials/menu.php'); ?>


<div class="main-content">
<div class="wrapper">
<h1>Manage Category</h1><br><br>
<!-- Buttton to add admin -->
<a href="<?php echo HOME; ?>admin/add-food.php" class="btn-primary">Add Food</a>
   <br><br><br>

   <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset($_SESSION['unauthorised']))
        {
            echo $_SESSION['unauthorised'];
            unset($_SESSION['unauthorised']);
        }
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
       


        ?>
<table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Actions</th>
       
    </tr>
        
        <?php

          //crete a sql query to get all the food
          $sql="SELECT * FROM tbl_food";

          //execute
          $res=mysqli_query($conn,$sql);

          $count=mysqli_num_rows($res);

          //create a serial num varialbe
          $sn=1;


          if($count>0)
          {
            //we have the data
            while($row=mysqli_fetch_assoc($res))
            {
              $id=$row['id'];
              $title=$row['titile'];
              $price=$row['price'];
              $image_name=$row['image_name'];
              $featured=$row['featured'];
              $active=$row['active'];
              ?>

                <tr>
                    
                    <td><?php echo $sn++;  ?></td>
                    <td><?php echo $title;  ?></td>
                    <td><?php echo $price;  ?></td>
                    <td>
                      <?php 
                          //check weather we have image or not
                          if($image_name!="")
                          {
                            ?>
                            <img src="<?php echo HOME; ?>images/food/<?php echo $image_name; ?>" width="100px" height="50px">

                            <?php
                            

                          }
                          else
                          {
                            
                            echo "<div class='error'> Image Not Added</div>";
                          }

                       ?>
                     </td>
                    <td><?php echo $featured;  ?></td>
                    <td><?php echo $active;  ?></td>
                  
                  <td>
                      <a href="<?php echo HOME; ?>admin\update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                      <a href="<?php echo HOME; ?>admin\delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?> " class="btn-danger">Delete Food</a>
                  </td>
                </tr>









                <?php
            }
          }
          else
          {
            //food not added in the data base
            echo"<tr> <td colspan='7' class='error'>Food Not Added Yet</td></tr>";
          }

        ?>



  
   
  </table>
</div>
</div>













<?php include('partials/footer.php');  ?>