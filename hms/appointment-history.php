<?php
session_start();
include('config.php'); 

$doctor_id = $_SESSION['doctor_id'];

$sql = "SELECT 
            a.id AS appointment_id,
            p.name AS patient_name,
            ds.specialization,
            a.consultancy_fee,
            a.appointment_date,
            a.appointment_time,
            a.created_at,
            a.status
        FROM appointments a
        JOIN users p ON a.patient_id = p.id
        JOIN doctors d ON a.doctor_id = d.id
        JOIN doctors_specialization ds ON d.specialization_id = ds.id
        WHERE d.id = ?
        ORDER BY a.appointment_date DESC, a.appointment_time DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $doctor_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard | HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            left: 0;
            top: 0;
            background-color: #f1f2f7;
            padding-top: 60px;
            color: white;
        }

        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: black;
            text-decoration: none;
            transition: 0.3s;
            background-color: #FFFFFF;
        }



        .sidebar .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            color: #adb5bd;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .topbar {
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar .title {
            font-size: 20px;
            font-weight: bold;
        }

        .topbar .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dashboard-section h5 {
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .dashboard-cards .card {
            border: none;
            text-align: center;
            transition: 0.3s;
            cursor: pointer;
        }

        .dashboard-cards .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .dashboard-cards .card i {
            font-size: 30px;
            margin-bottom: 10px;
            color: #0d6efd;
        }

        .dashboard-cards .card-title {
            font-size: 18px;
            font-weight: 500;
        }

        .dashboard-cards .card a {
            font-size: 14px;
            color: #0d6efd;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-title">Main Navigation</div>
        <a href="doctor-dashboard.php"><i class="fas fa-home me-2 "></i> Dashboard</a>

        <a href="appointment-history.php"><i class="fas fa-history me-2"></i> Appointment History</a>
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

    <!-- Content -->
    <div class="content">

        <!-- Top Bar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="title ms-auto me-2">Hospital Management System</div>

            <div class="dropdown user-info me-3">
                <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg me-2"></i>
                    <span><?php echo $_SESSION['doctor_name']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="user-profile.php">My Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="doctor-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-section">
            <h5>DOCTOR APPOINTMENT HISTORY</h5>


        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Patient Name</th>
                    <th>Specialization</th>
                    <th>Consultancy Fee</th>
                    <th>Appointment Date / Time</th>
                    <th>Created At</th>
                    <th>Current Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1;
                while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $i++ ?></td>
                        <td><?= htmlspecialchars($row['patient_name']) ?></td>
                        <td><?= htmlspecialchars($row['specialization']) ?></td>
                        <td><?= htmlspecialchars($row['consultancy_fee']) ?></td>
                        <td><?= htmlspecialchars($row['appointment_date']) . ' / ' . date('h:i A', strtotime($row['appointment_time'])) ?></td>
                        <td><?= htmlspecialchars($row['created_at']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td>
                            <?php
                            $status = strtolower($row['status']);

                            if ($status === 'pending') {
                                // Show both Confirm and Cancel
                                echo '<a href="confirm_appointment.php?id=' . $row['appointment_id'] . '" onclick="return confirm(\'Confirm this appointment?\');">Confirm</a> | ';
                                echo '<a href="cancel_appointment.php?id=' . $row['appointment_id'] . '" onclick="return confirm(\'Cancel this appointment?\');">Cancel</a>';
                            } elseif ($status === 'active') {
                                // Only show Cancel
                                echo '<a href="cancel_appointment.php?id=' . $row['appointment_id'] . '" onclick="return confirm(\'Cancel this appointment?\');">Cancel</a>';
                            } else {
                                // Status is Canceled
                                echo 'Canceled';
                            }
                            ?>
                        </td>


                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>