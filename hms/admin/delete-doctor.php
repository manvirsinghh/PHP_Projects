<?php
include('../config.php');


// Check if 'id' is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<script>alert('Invalid Doctor ID'); window.location.href='manage_doctors.php';</script>";
    exit;
}

$doctor_id = (int)$_GET['id'];

// Verify doctor exists
$check_query = "SELECT id FROM doctors WHERE id = $doctor_id LIMIT 1";
$check_result = mysqli_query($conn, $check_query);

if (mysqli_num_rows($check_result) === 0) {
    echo "<script>alert('Doctor not found'); window.location.href='manage_doctors.php';</script>";
    exit;
}

// Perform deletion
$delete_query = "DELETE FROM doctors WHERE id = $doctor_id";
$run = mysqli_query($conn, $delete_query);

if ($run) {
    echo "<script>alert('Doctor deleted successfully'); window.location.href='manage_doctors.php';</script>";
} else {
    echo "<script>alert('Error deleting doctor: " . mysqli_error($conn) . "'); window.location.href='manage_doctors.php';</script>";
}
?>
