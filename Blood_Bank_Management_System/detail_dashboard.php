<?php 
session_start(); // Start the session
include("config.php");

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: blood_donor_login.php"); 
    exit();
}

$name = $_SESSION['username']; // Get the username from session

// Query to check if username exists in donor_details table
$sql = "SELECT * FROM donor_details WHERE username = '$name'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    header("Location: blood_donor_dashboard.php"); // Redirect to dashboard if user exists
} else {
    header("Location: blood_donor_details.php"); // Redirect to details page if user doesn't exist
}

// Close database connection
$conn->close();
?>





