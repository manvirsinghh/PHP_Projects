<?php
session_start();
include('config.php');

if (isset($_SESSION['logid'])) {
    $logid = $_SESSION['logid'];
    mysqli_query($conn, "UPDATE userslog SET logout = NOW() WHERE id = '$logid'");
}

session_unset();
session_destroy();
header("Location: user-login.php?logout=success");
exit();
?>
