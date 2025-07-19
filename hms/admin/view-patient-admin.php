<?php
session_start();
include('../config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Get patient ID from URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid patient ID.";
    exit();
}

$patientId = intval($_GET['id']);
$query = "SELECT * FROM tblpatient WHERE id = $patientId";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Patient not found.";
    exit();
}

$patient = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | View Patient</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">Patient Details</h3>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <td><?= htmlspecialchars($patient['PatientName']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($patient['PatientEmail']) ?></td>
        </tr>
        <tr>
            <th>Contact Number</th>
            <td><?= htmlspecialchars($patient['PatientContno']) ?></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td><?= htmlspecialchars($patient['PatientGender']) ?></td>
        </tr>
        <tr>
            <th>Age</th>
            <td><?= htmlspecialchars($patient['PatientAge']) ?></td>
        </tr>
        <tr>
            <th>Medical History</th>
            <td><?= nl2br(htmlspecialchars($patient['PatientMedhis'])) ?></td>
        </tr>
        <tr>
            <th>Registered On</th>
            <td><?= htmlspecialchars($patient['CreationDate']) ?></td>
        </tr>
        <tr>
            <th>Last Updated</th>
            <td><?= htmlspecialchars($patient['UpdationDate']) ?></td>
        </tr>
    </table>

    <a href="search-patient.php" class="btn btn-secondary mt-3">Back to Search</a>
</div>
</body>
</html>
