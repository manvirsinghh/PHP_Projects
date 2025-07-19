<?php
session_start();
include('config.php');

if (isset($_GET['id']) && isset($_SESSION['doctor_id'])) {
    $appointment_id = intval($_GET['id']);
    $doctor_id = $_SESSION['doctor_id'];

    // Only allow confirmation if status is still 'Pending'
    $stmt = $conn->prepare("UPDATE appointments SET status = 'Active' WHERE id = ? AND doctor_id = ? AND status = 'Pending'");
    $stmt->bind_param("ii", $appointment_id, $doctor_id);
    $stmt->execute();

    header("Location: appointment-history.php");
    exit;
} else {
    echo "Unauthorized access.";
}
?>
