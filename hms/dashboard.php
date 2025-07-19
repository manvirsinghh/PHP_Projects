<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location:user-login.php');
}


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
        <a href="dashboard.php"><i class="fas fa-home me-2 "></i> Dashboard</a>
        <a href="book-appointment.php"><i class="fas fa-calendar-plus me-2"></i> Book Appointment</a>
        <a href="appointment-history.php"><i class="fas fa-history me-2"></i> Appointment History</a>
        <a href="manage-medhistory.php"><i class="fas fa-notes-medical me-2"></i> Medical History</a>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Top Bar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="title ms-auto me-2">Hospital Management System</div>

            <div class="dropdown user-info me-3">
                <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg me-2"></i>
                    <span><?php echo $_SESSION['user_name']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="user-profile.php">My Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a href="change_password.php" class="dropdown-item">Change password</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-section">
            <h5>USER | DASHBOARD</h5>

            <div class="row dashboard-cards">
                <div class="col-md-4 mb-4">
                    <div class="card p-4 shadow-sm">
                        <i class="fas fa-user"></i>
                        <div class="card-title">My Profile</div>
                        <a href="user-profile.php">Update Profile</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card p-4 shadow-sm">
                        <i class="fas fa-calendar-check"></i>
                        <div class="card-title">My Appointments</div>
                        <a href="appointment-history.php">View Appointment History</a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card p-4 shadow-sm">
                        <i class="fas fa-calendar-plus"></i>
                        <div class="card-title">Book My Appointment</div>
                        <a href="book-appointment.php">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php include 'patient-footer.php';?>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
