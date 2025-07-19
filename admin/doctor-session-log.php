<?php
session_start();
include('../config.php');

// Optional: only allow admin or doctor to access
if (!isset($_SESSION['doctor_id'])) {
    header('Location: ../doctor-login.php');
    exit;
}
$doctorId = $_SESSION['doctor_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Session Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">Doctor Session Logs</h3>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>Username</th>
                <th>User IP</th>
                <th>Login Time</th>
                <th>Logout Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = mysqli_query($conn, "SELECT * FROM doctorslog WHERE uid = '$doctorId' ORDER BY loginTime DESC");
        $count = 1;
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>{$count}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['userip']}</td>";
            echo "<td>{$row['loginTime']}</td>";
            echo "<td>" . ($row['logoutTime'] ? $row['logoutTime'] : '<span class="text-danger">Active/Not logged out</span>') . "</td>";
            echo "<td>" . ($row['status'] ? '<span class="text-success">Success</span>' : '<span class="text-danger">Failed</span>') . "</td>";
            echo "</tr>";
            $count++;
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
