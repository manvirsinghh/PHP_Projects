<?php
session_start();
include 'config.php';

$uid = $_SESSION['doctor_id'];
$ip = $_SERVER['REMOTE_ADDR'];

// Update latest login entry
mysqli_query($conn, "UPDATE doctorslog SET logoutTime = NOW() 
                     WHERE uid = '$uid' AND logoutTime IS NULL 
                     ORDER BY loginTime DESC LIMIT 1");

session_unset();
session_destroy();

header("Location: doctor-login.php?logout=success");
exit;
