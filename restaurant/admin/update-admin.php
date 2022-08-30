<?php include('partials/menu.php') ?>
<div class="main-content">

<div class="wrapper">
    <h1>Update admin</h1><br><br>
<?php
//1. get the id pf the selected data
$id=$_GET['id'];

//2.create sql query

$sql= "SELECT * FROM tbl_admin WHERE id=$id";

//3.Execute the query
$res= mysqli_query($conn,$sql);

//check weather the query is executed or not
if($res== true){
    //check weather the data is avaliable or not
    $count = mysqli_num_rows($res);
    //check wheather we have admin data or not
    if($count==1){
//get details
$row=mysqli_fetch_assoc($res);
$full_name=$row['full_name'];
$username=$row['username'];
    }else{
//redirect to manage admin page
header('location:'.HOME.'admin/manage-admin.php');
    }
}

?>
    <form action="" method="POST">
       <table class="tbl-30">
        <tr>
            <td>Full name</td>
            <td>
                <input type="text" name="full_name" value="<?php echo $full_name; ?>">
            </td>
        </tr>
        <tr>
            <td>User name</td>
            <td>
        <input type="text" name="username" value="<?php echo $username; ?>">
        </td>
        </tr>

        <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="subimt" value="Update Admin" class="btn-secondary">
            </td>
        </tr>
       </table>
    </form>
</div>
</div>

<?php
//check weather the submit button is clicked
if(isset($_POST['submit'])){
    $id=$_POST['id'];
    $full_name=$_POST['full_name'];
    $username=$_POST['username'];

    $sql = "UPDATE tbl_admin SET full_name='$full_name',username='$username' WHERE id=$id";

$res=mysqli_query($conn,$sql);
if($res==true){
    //query executed updated admin
    $_SESSION['update'] = "<div class='sucess'> Admin updated sucessfully</div>";
//redirect to manage admin
    header('location:'.HOME.'admin/manage-admin.php');
}else{
    //query failed to executed updated admin
    $_SESSION['update']="<div class='sucess'>Admin not updated sucessfully</div>";
//redirect to manage admin
    header('location:'.HOME.'admin/manage-admin.php');
}
}
?>


<?php include('partials/footer.php') ?>