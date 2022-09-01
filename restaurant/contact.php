<?php  include('partials-front/menu.php') ?>
<!-- Contact Form Starts Here  -->
<div class="Contact-from">
    <div class="container">
      <center><h1>Contact Form</h1></center>
        <br><br>

        <form action="" method="post">
        <table class="text-center">
            
        <tr>
            <td>Name:</td>
            <td><input type="text" name="name" placeholder="Enter Your name"></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email" placeholder="Enter Your Email"></td>
        </tr>
        <tr>
            <td>Phone Number:</td>
            <td><input type="number" name="num" placeholder="Enter Your Phone Number"></td>
        </tr>
        <tr>
            <td>How I help You?</td>
            <td>
                <input type="text" name="help" placeholder="Enter your Message....">
            </td>
        </tr>
        <tr>
            <td><input type="submit" name="submit" class=" btn-contact text-white" value="Contact"></td>
        </tr>
        
        </table>
        </form>

    </div>
</div>
<!-- Contact Form ends Here  -->



<?php  include('partials-front/footer.php') ?>