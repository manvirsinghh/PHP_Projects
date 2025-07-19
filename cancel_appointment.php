<?php
session_start();
include('config.php');

if (isset($_GET['id'])) {
    $appointment_id = intval($_GET['id']);
    $doctor_id = $_SESSION['doctor_id']; // Ensure doctor logged in

    // Update appointment status to 'Canceled by you' for security - only if doctor owns appointment
    $sql = "UPDATE appointments SET status = 'Canceled by you' WHERE id = ? AND doctor_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $appointment_id, $doctor_id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $_SESSION['message'] = "Appointment canceled successfully.";
    } else {
        $_SESSION['message'] = "Failed to cancel appointment or unauthorized.";
    }

    $stmt->close();
    header("Location: appointment-history.php");
    exit;
}
?>
