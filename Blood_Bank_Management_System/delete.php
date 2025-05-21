<?php
include 'config.php'; // Include your database connection file

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    // Simple DELETE query with JOIN
    $query = "DELETE bdr, ddt 
              FROM blood_donor_registration bdr
              JOIN donor_details ddt 
              ON bdr.username = ddt.username
              WHERE bdr.username = '$username'";

    if ($conn->query($query) === TRUE) {
    header("location:logout.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $conn->close();
}
?>
