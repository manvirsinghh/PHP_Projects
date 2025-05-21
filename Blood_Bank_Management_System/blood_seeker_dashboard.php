<?php
 include("header.php");

 if(isset($_SESSION["username"])){
    echo "welcome " .$_SESSION['username'];
 }
 else{
    header("location:blood_seeker_login.php");
 }


?>