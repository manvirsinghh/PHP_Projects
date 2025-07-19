<?php
session_start();
include('config.php');
$doctor_id = $_SESSION['doctor_id'];

$select_query = "SELECT * FROM tblpatient WHERE Docid='$doctor_id' ";
$execute_query = mysqli_query($conn, $select_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Patient | HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f1f2f7;
            padding-top: 60px;
            z-index: 100;
        }

        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: #000;
            text-decoration: none;
            background-color: #fff;
        }

        .sidebar .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            color: #6c757d;
        }

        .topbar {
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 250px;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-title">Main Navigation</div>

        <a href="doctor-dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>

        <a href="appointment-history.php"><i class="fas fa-history me-2"></i> Appointment History</a>

        <!-- Patients Dropdown -->
        <a data-bs-toggle="collapse" href="#patientsSubmenu" role="button" aria-expanded="false" aria-controls="patientsSubmenu">
            <i class="fas fa-user-injured me-2"></i> Patients
            <i class="fas fa-chevron-down float-end"></i>
        </a>
        <div class="collapse" id="patientsSubmenu">
            <ul class="nav flex-column ms-3">
                <li class="nav-item">
                    <a class="nav-link" href="add-patient.php">Add Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-patients.php">Manage Patients</a>
                </li>
            </ul>
        </div>

        <a href="search.php"><i class="fas fa-search me-2"></i> Search</a>
    </div>

    <!-- Topbar -->
    <div class="topbar">
        <h5 class="m-0 ms-auto me-2">Hospital Management System</h5>
        <div class="dropdown">
            <a class="text-dark text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['doctor_name']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">My Profile</a></li>
                <li><a class="dropdown-item text-danger" href="doctor-logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <h6 class="mb-3">DOCTOR | MANAGE PATIENTS</h6>
        <span>Manage: <b>Patients</b></span>

        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Patient Name</th>
                    <th>Patient Contact Number</th>
                    <th>Patient Gender</th>
                    <th>Creation Date</th>
                    <th>Updation Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $serial_no = 1;
                while ($row = mysqli_fetch_assoc($execute_query)) {
                    echo "<tr>";
                    echo "<td>" . $serial_no++ . "</td>";
                    echo "<td>" . htmlspecialchars($row['PatientName']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PatientContno']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['PatientGender']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['CreationDate']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['UpdationDate']) . "</td>";
                    echo '<td>
                  <a href="edit-patient.php?editid=' . $row['id'] . '" class="text-primary me-2"><i class="fas fa-edit"></i></a>
                  <a href="view-patient.php?viewid=' . $row['id'] . '" class="text-info"><i class="fas fa-eye"></i></a>
                </td>';
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>