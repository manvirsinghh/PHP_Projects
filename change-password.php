<?php
session_start();
include 'config.php';
if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor-login.php");
    exit;
}
$doctor_id = $_SESSION['doctor_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $sql = "SELECT password FROM doctors WHERE id='$doctor_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row && password_verify($current_password, $row['password'])) {
        if ($new_password === $confirm_password) {
            //Hash the new password
            $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            //Update the new password
            $update = "UPDATE doctors SET password='$new_hashed' WHERE id='$doctor_id'";
            if (mysqli_query($conn, $update)) {
                echo "<script>alert('Password changed successfully.'); window.location.href='change-password.php';</script>";
                exit;
            } else {
                echo "Failed to update password";
            }
        } else {
            echo "New password do not match.";
        }
    } else {
        echo "Current Password is incorrect.";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard | HMS</title>
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
                    <li><a class="dropdown-item" href="edit-doctor-profile.php">My Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">

                    </li>
                    <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                    <li>
                        <hr class="dropdown-divider">

                    </li>
                    <li><a class="dropdown-item text-danger" href="doctor-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-section">
            <h5>DOCTOR | CHANGE PASSWORD</h5>


        </div>
        <div class="form bg-white p-2">
            <p class="fw-bolder">Change Password</p>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Current Password</label>
                    <input type="text" class="form-control w-50" name="current_password" placeholder="Enter current password">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">New Password</label>
                    <input type="text" class="form-control w-50" name="new_password" placeholder="Enter new password">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Confirm Password</label>
                    <input type="text" class="form-control w-50" name="confirm_password" placeholder="Enter confirm password">
                </div>
                <div class="btn">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>