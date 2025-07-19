<?php
session_start();
include '../config.php';
// Ensure the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
//Count total users
$user_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM users");
$user_count = mysqli_fetch_assoc($user_count_query)['total'];
// Count Doctors
$doctor_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM doctors");
$doctor_count = mysqli_fetch_assoc($doctor_count_query)['total'];

// Count Appointments
$appointment_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM appointments");
$appointment_count = mysqli_fetch_assoc($appointment_count_query)['total'];
// Count Patients
$patient_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tblpatient");
$patient_count = mysqli_fetch_assoc($patient_count_query)['total'];

// Count New Queries (where admin_remark is empty or NULL)
$query_count_query = mysqli_query($conn, "SELECT COUNT(*) AS total FROM contact_us WHERE admin_remark IS NULL OR admin_remark = ''");
$query_count = mysqli_fetch_assoc($query_count_query)['total'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        .dropdown-menu-custom {
            position: absolute;
            top: 100%;
            right: 0;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: 160px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .dropdown-item {
            padding: 10px 15px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .dropdown-item:hover {
            background-color: #f0f0f0;
        }

        .d-none {
            display: none;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-2 sidebar">
                <h5 class="text-center mb-4">HMS</h5>
                <nav class="nav flex-column">
                    <a class="nav-link" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#doctorsMenu" role="button" aria-expanded="false" aria-controls="doctorsMenu">
                            <i class="fas fa-user-md"></i> Doctors
                        </a>
                        <div class="collapse" id="doctorsMenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item"><a class="nav-link" href="doctor_specialization.php">Doctor Specialization</a></li>
                                <li class="nav-item"><a class="nav-link" href="add_doctor.php">Add Doctor</a></li>
                                <li class="nav-item"><a class="nav-link" href="manage_doctors.php">Manage Doctors</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#usersMenu" role="button" aria-expanded="false" aria-controls="usersMenu">
                            <i class="fas fa-users"></i> Users
                        </a>
                        <div class="collapse" id="usersMenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="manage_users.php">Manage Users</a>
                                </li>
                            </ul>
                        </div>
                    </li>



                   
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#patientMenu" role="button" aria-expanded="false" aria-controls="usersMenu">
                            <i class="fas fa-users"></i> Patients
                        </a>
                        <div class="collapse" id="patientMenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="manage_patients.php">Manage Patients</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <a class="nav-link" href="appointment-history.php"><i class="fas fa-history"></i> Appointment History</a>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#ContactusqueryMenu" role="button" aria-expanded="false" aria-controls="usersMenu">
                            <i class="fas fa-question-circle"></i> Contact us Queries
                        </a>
                        <div class="collapse" id="ContactusqueryMenu">
                            <ul class="nav flex-column ms-3">
                                <li class="nav-item">
                                    <a class="nav-link" href="unread_queries.php">Unread Query</a>
                                    <a class="nav-link" href="read-query.php">Read Query</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <a class="nav-link" href="doctor-session-log.php"><i class="fas fa-clock"></i> Doctor Session Logs</a>
                    <a class="nav-link" href="user-session-logs.php"><i class="fas fa-user-clock"></i> User Session Logs</a>
                    <a class="nav-link" href="patient-report.php"><i class="fas fa-chart-line"></i>Patient Reports</a>
                    <a class="nav-link" href="doctor-report.php"><i class="fas fa-chart-line"></i>Doctor Reports</a>
                    <a class="nav-link" href="search-patient.php"><i class="fas fa-search"></i> Patient Search</a>
                </nav>
            </div>

            <!-- Content -->
            <div class="col-md-10">
                <div class="topbar d-flex justify-content-end align-items-center">
                    <div>
                        <h4 class="me-2 ">Hospital Management System</h4>

                    </div>
                    <div class="admin-profile position-relative" onclick="toggleDropdown()">
                        <img src="../images/admin.jpeg" class="rounded me-2" alt="Admin" width="30" height="30">
                        Admin <i class="fas fa-chevron-down ms-1"></i>
                        <div id="dropdownMenu" class="dropdown-menu-custom d-none">
                            <a href="change-password.php" class="dropdown-item">Change Password</a>
                            <a href="logout.php" class="dropdown-item">Logout</a>
                        </div>

                    </div>
                </div>

                <div class="p-3 mb-5">
                    <div class="dashboard-header mt-3">ADMIN | DASHBOARD</div>
                    <div class="breadcrumb-text d-flex justify-content-end">Admin / Dashboard</div>
                    <div class="row g-4 mt-2">

                        <div class="col-md-4">
                            <div class="card-box">
                                <i class="fas fa-users"></i>
                                <h6>Manage Users</h6>
                                <p class="text-muted">Total Users: <?php echo $user_count ;?></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card-box">
                                <i class="fas fa-user-md"></i>
                                <h6>Manage Doctors</h6>
                                <p class="text-muted">Total Doctors: <?php echo $doctor_count;?></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card-box">
                                <i class="fas fa-calendar-check"></i>
                                <h6>Appointments</h6>
                                <p class="text-muted">Total Appointments: <?php echo $appointment_count;?></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card-box">
                                <i class="fas fa-procedures"></i>
                                <h6>Manage Patients</h6>
                                <p class="text-muted">Total Patients: <?php echo $patient_count;?></p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card-box">
                                <i class="fas fa-envelope-open-text"></i>
                                <h6>New Queries</h6>
                                <p class="text-muted">Total New Queries: <?php echo $query_count;?></p>
                            </div>
                        </div>

                    </div>
                   
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    <script>
        function toggleDropdown() {
            const menu = document.getElementById("dropdownMenu");
            menu.classList.toggle("d-none");
        }
    </script>

</html>
<?php include 'admin-footer.php';?>