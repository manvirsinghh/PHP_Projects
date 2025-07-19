<?php
include 'config.php';
$patient_id=$_GET['viewid'];
$select_query="SELECT * FROM tblpatient WHERE id='$patient_id'";
$execute_query=mysqli_query($conn,$select_query);
$patient=mysqli_fetch_assoc($execute_query);

$medical_query="SELECT * FROM tblmedicalhistory WHERE ID='$patient_id'";
$execute_medquery=mysqli_query($conn,$medical_query);
$medhistory=mysqli_fetch_assoc($execute_medquery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users | Medical History</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <style>
        body {
            font-family: "Segoe UI", sans-serif;
            background-color: #f9f9f9;
        }
        .sidebar {
            background-color: #f0f0f0;
            min-height: 100vh;
        }
        .sidebar a {
            display: block;
            padding: 12px 20px;
            color: #333;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #ddd;
        }
        .header {
            background: #fff;
            padding: 15px 30px;
            border-bottom: 1px solid #e1e1e1;
        }
        .header h2 {
            margin: 0;
        }
        .main-content {
            padding: 30px;
            background-color: #fff;
        }
        table th {
            background-color: #f7f7f7;
        }
        .breadcrumb {
            background: none;
            padding-left: 0;
        }
    </style>
</head>
<body>

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar p-3">
        <h4 class="mb-4">HMS</h4>
        <a href="dashboard.php">Dashboard</a>
        <a href="book-appointment.php">Book Appointment</a>
        <a href="appointment-history.php">Appointment History</a>
        <a href="">Medical History</a>
    </div>

    <!-- Main Area -->
    <div class="flex-grow-1">
        <div class="header d-flex justify-content-between align-items-center">
            <h>Hospital Management System</h>
            <div>
                <img src="https://img.icons8.com/ios-filled/50/000000/user.png" width="30" alt="User">
                <span><?php echo $patient['PatientName'];?></span>
            </div>
        </div>

        <div class="main-content">
            <h6>USERS | MEDICAL HISTORY</h6>
            <hr>

            <!-- Patient Info Table -->
            <h6 class="text-center">Patient details</h6>
            <table class="table table-bordered mt-3">
                <tr>
                    <th>Patient Name</th>
                    <td><?= $patient['PatientName'] ?></td>
                    <th>Patient Email</th>
                    <td><?= $patient['PatientEmail'] ?></td>
                </tr>
                <tr>
                    <th>Patient Mobile Number</th>
                    <td><?= $patient['PatientContno'] ?></td>
                    <th>Patient Address</th>
                    <td><?= $patient['PatientAdd'] ?></td>
                </tr>
                <tr>
                    <th>Patient Gender</th>
                    <td><?= $patient['PatientGender'] ?></td>
                    <th>Patient Age</th>
                    <td><?= $patient['PatientAge'] ?></td>
                </tr>
                <tr>
                    <th>Patient Medical History (if any)</th>
                    <td><?= $patient['PatientMedhis'] ?></td>
                    <th>Patient Reg Date</th>
                    <td><?= $patient['CreationDate'] ?></td>
                </tr>
            </table>

            <!-- Medical History Table -->
            <h5 class="mt-5">Medical History</h5>
            <table class="table table-striped table-bordered mt-3">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Blood Pressure</th>
                        <th>Weight</th>
                        <th>Blood Sugar</th>
                        <th>Body Temperature</th>
                        <th>Medical Prescription</th>
                        <th>Visit Date</th>
                    </tr>
                </thead>
                <tbody>
                    
                        <tr>
                            <?php  $serialno=1; ?>
                            <td><?= $serialno++; ?></td>
                            <td><?= $medhistory['BloodPressure'] ?></td>
                            <td><?= $medhistory['Weight'] ?></td>
                            <td><?= $medhistory['BloodSugar'] ?></td>
                            <td><?= $medhistory['Temperature'] ?></td>
                            <td><?= $medhistory['MedicalPres'] ?></td>
                            <td><?= $medhistory['CreationDate'] ?></td>
                        </tr>
                 
                </tbody>
            </table>

        </div>
    </div>
</div>

</body>
</html>
