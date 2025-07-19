
<?php
session_start();
include '../config.php';
// Ensure the user is logged in, otherwise redirect to login page
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}
$admin_id = $_SESSION['admin_id'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $sql = "SELECT password FROM admins WHERE id='$admin_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row && password_verify($current_password, $row['password'])) {
        if ($new_password === $confirm_password) {
            //Hash the new password
            $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);
            //Update the new password
            $update = "UPDATE admins SET password='$new_hashed' WHERE id='$admin_id'";
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
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
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



                    <a class="nav-link" href="#"><i class="fas fa-procedures"></i> Patients</a>
                    <a class="nav-link" href="#"><i class="fas fa-history"></i> Appointment History</a>
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

                    <a class="nav-link" href="#"><i class="fas fa-clock"></i> Doctor Session Logs</a>
                    <a class="nav-link" href="#"><i class="fas fa-user-clock"></i> User Session Logs</a>
                    <a class="nav-link" href="#"><i class="fas fa-chart-line"></i> Reports</a>
                    <a class="nav-link" href="#"><i class="fas fa-search"></i> Patient Search</a>
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

                <div class="p-3">
                    <div class="dashboard-header mt-3">ADMIN | CHANGE PASSWORD</div>
                    <div class="breadcrumb-text d-flex justify-content-end">Admin / Change Password</div>
                
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