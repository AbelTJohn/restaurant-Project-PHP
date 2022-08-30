<?php
include('../config/constants.php');
//1.destroy the session
session_destroy();///$_session['user']

//2.redirect to login page
header('location:'.HOME.'admin/login.php');

?>