<?php

//Session Starts why here it starts on every where
 session_start();


   //Create Constants to store non repeating values
   define('HOME','http://localhost/restaurant/'); ///site url
   define('LOCALHOST', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_NAME', 'restaurant');

 $conn = mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error()); //Data base connection
 $db_select= mysqli_select_db($conn,DB_NAME)or die(mysqli_error()); //Selecting Database
?>