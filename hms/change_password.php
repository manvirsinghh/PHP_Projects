<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: user-login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password     = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $sql = "SELECT password FROM users WHERE id='$user_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row && password_verify($current_password, $row['password'])) {
        if ($new_password === $confirm_password) {
            $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            $update = "UPDATE users SET password='$new_hashed' WHERE id='$user_id'";
            if (mysqli_query($conn, $update)) {
                echo "<script>alert('Password changed successfully.'); window.location.href='change_password.php';</script>";
                exit;
            } else {
                echo "Failed to update password.";
            }
        } else {
            echo "<script>alert('New passwords do not match.');</script>";
        }
    } else {
        echo "<script>alert('Current password is incorrect.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Change Password | HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .topbar {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            padding: 15px 30px;
        }

        .topbar .title {
            font-size: 20px;
            font-weight: 600;
        }

        .form-container {
            max-width: 600px;
            margin: 40px auto;
        }

        .form-card {
            background: #fff;
            border: 1px solid #e3e3e3;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-card h5 {
            font-weight: bold;
            margin-bottom: 25px;
        }
    </style>
</head>

<body>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 250px; height: 100vh;">
            <h6 class="text-uppercase text-muted mb-3 mt-5">Main Navigation</h6>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="dashboard.php" class="nav-link text-dark">
                        <i class="fas fa-home me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="book-appointment.php" class="nav-link text-dark">
                        <i class="fas fa-calendar-plus me-2"></i> Book Appointment
                    </a>
                </li>
                <li>
                    <a href="appointment-history.php" class="nav-link text-dark">
                        <i class="fas fa-history me-2"></i> Appointment History
                    </a>
                </li>
                <li>
                    <a href="manage-medhistory.php" class="nav-link text-dark">
                        <i class="fas fa-notes-medical me-2"></i> Medical History
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">
                <div class="title ms-auto me-2">Hospital Management System</div>
                <div class="dropdown user-info me-4">
                    <a class="text-dark text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle fa-lg me-1"></i> <?= htmlspecialchars($user_name) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="edit-doctor-profile.php">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Page Content -->
            <div class="p-4 ps-5 pe-5">
                <p class="fw-bold text-secondary">USER | CHANGE PASSWORD</p>
                <div class="form-card">
                    <h5 class="text-dark">Change Password</h5>
                    <form method="post">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-outline-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
