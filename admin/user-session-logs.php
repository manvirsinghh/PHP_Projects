<?php
session_start();
include('../config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Session Logs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h3>User Session Logs</h3>
    <table class="table table-bordered">
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
            $query = mysqli_query($conn, "SELECT * FROM userslog ORDER BY id DESC");
            $count = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<tr>";
                echo "<td>" . $count++ . "</td>";
                echo "<td>" . htmlentities($row['username']) . "</td>";
                echo "<td>" . htmlentities($row['userip']) . "</td>";
                echo "<td>" . htmlentities($row['loginTime']) . "</td>";
                echo "<td>" . ($row['logout'] ? htmlentities($row['logout']) : "<span style='color:red;'>Active/Not logged out</span>") . "</td>";
                echo "<td>" . ($row['status'] ? "<span style='color:green;'>Success</span>" : "<span style='color:red;'>Failed</span>") . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
