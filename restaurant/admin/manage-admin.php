<?php include('partials/menu.php') ?>

    <!-- main Content Section starts -->
    <div class="main-content">
    <div class="wrapper">
   <h1>Manage Admin</h1><br>

   <?php
if(isset($_SESSION['add'])){
    echo $_SESSION['add'];
    unset($_SESSION['add']); //revoming sesion
}

if(isset($_SESSION['delete'])){
    echo $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if(isset($_SESSION['update'])){
    echo $_SESSION['update'];
    unset($_SESSION['update']); //revoming sesion

}
if(isset($_SESSION['password-not-mathch'])){
    echo $_SESSION['password-not-mathch'];
    unset($_SESSION['password-not-mathch']); //revoming sesion
}
if(isset($_SESSION['user-not-found'])){
    echo $_SESSION['user-not-found'];
    unset($_SESSION['user-not-found']); //revoming sesion
}

if(isset($_SESSION['not-changed'])){
    echo $_SESSION['not-changed'];
    unset($_SESSION['not-changed']); //revoming sesion
}
if(isset($_SESSION['changed-password'])){
    echo $_SESSION['changed-password'];
    unset($_SESSION['changed-password']); //revoming sesion
}


   ?>
   <br><br><br>
   <!-- Buttton to add admin -->
   <a href="add-admin.php" class="btn-primary">Add Admin</a>
   <br><br><br>
  <table class="tbl-full">
    <tr>
        <th>S.N</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
       
    </tr>
    <?php
    //query to get all data from the table
$sql= "SELECT * FROM tbl_admin";

$res= mysqli_query($conn,$sql);

if($res==true){
    //count rows
    $count = mysqli_num_rows($res); // function to get all the rows in the database

    $sn=1; //create a varibale and assingn the value 
    if($count>0){
        while($rows=mysqli_fetch_assoc($res))
        {
            //using while loop to get all the data from the data base
            //and while loop will run as long as we have data in database

            //get individual data
            $id=$rows['id'];
            $full_name=$rows['full_name'];
            $username=$rows['username'];
            ?>
<tr>
        <td><?php echo $sn++; ?></td>
        <td><?php echo $full_name; ?></td>
        <td><?php echo $username; ?></td>
      <td>
         <a href="<?php echo HOME; ?>admin\update-password.php?id=<?php echo $id; ?>" class="btn-primary">Chanage Password</a>
          <a href="<?php echo HOME; ?>admin\update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
          <a href="<?php echo HOME; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
      </td>
    </tr>
 

            <?php
        }
    }
}
?>



  </table>
    </div> 
    </div>
    <!-- main Content ends -->



    <?php include('partials/footer.php') ?>