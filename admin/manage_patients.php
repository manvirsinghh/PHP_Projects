<?php
session_start();
include('../config.php');
$query = mysqli_query($conn, "SELECT * FROM tblpatient ORDER BY CreationDate DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin | Manage Patients</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .container {
      max-width: 95%;
    }
    .table th,
    .table td {
      vertical-align: middle;
    }
    .table thead {
      background-color: #343a40;
      color: #fff;
    }
    h4 {
      font-weight: 600;
      color: #333;
    }
    .badge-age {
      background-color: #6c757d;
    }
  </style>
</head>
<body>

  <div class="container py-4">
    <h4 class="mb-4">All Registered Patients</h4>
    <div class="table-responsive shadow rounded">
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Address</th>
            <th>Registered On</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $cnt = 1;
          if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) { ?>
              <tr>
                <td><?= $cnt++; ?></td>
                <td><?= htmlspecialchars($row['PatientName']); ?></td>
                <td><?= htmlspecialchars($row['PatientContno']); ?></td>
                <td><?= htmlspecialchars($row['PatientEmail']); ?></td>
                <td>
                  <?php if ($row['PatientGender'] == 'Male') {
                    echo '<span class="badge bg-primary">Male</span>';
                  } else {
                    echo '<span class="badge bg-pink text-white">Female</span>';
                  } ?>
                </td>
                <td><span class="badge badge-age"><?= $row['PatientAge']; ?></span></td>
                <td><?= htmlspecialchars($row['PatientAdd']); ?></td>
                <td><span class="text-muted small"><?= $row['CreationDate']; ?></span></td>
              </tr>
          <?php }
          } else {
            echo '<tr><td colspan="8" class="text-center text-muted">No patients found.</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
