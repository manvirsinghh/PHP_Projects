<?php
session_start();
include('config.php');

if (!isset($_SESSION['id'])) {
    header("Location: user-login.php");
    exit;
}

$userId = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = '$userId'");
$user = mysqli_fetch_assoc($query); // This gets the user info as an associative array
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Dashboard | HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-title">Main Navigation</div>
        <a href="dashboard.php"><i class="fas fa-home me-2 "></i> Dashboard</a>
        <a href="book-appointment.php"><i class="fas fa-calendar-plus me-2"></i> Book Appointment</a>
        <a href="#"><i class="fas fa-history me-2"></i> Appointment History</a>
        <a href="#"><i class="fas fa-notes-medical me-2"></i> Medical History</a>
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Top Bar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="title ms-auto me-2">Hospital Management System</div>

            <div class="dropdown user-info me-3">
                <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg me-2"></i>

                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="edit-profile.php">My Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="#">Change Password</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-section">
            <h5>USER | EDIT PROFILE</h5>


        </div>
        <!-- <div class="form">
            <form action="" method="post">
                <h5>Book Appointment</h5>
                <div class="mb-3">
                    <label for="">Doctor Specialization</label>
                    <input type="text" value="">
                </div>
                <div class="mb-3">
                    <label for="">Doctors</label>
                    <input type="text" value="">
                </div>
                <div class="mb-3">
                    <label for="">Consulatancy fee</label>
                    <input type="text" value="">
                </div>
                <div class="mb-3">
                    <label for="">Date</label>
                    <input type="date">
                </div>
                <div class="mb-3">
                    <label for="">Time</label>
                    <input type="time">
                </div>
                <button type="submit">Submit</button>
            </form>
        </div> -->
        <div class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-header  text-dark">
                    <h5 class="mb-0">Edit Profile</h5>

                </div>
                <div class="card-body">
                    <span><?php echo $_SESSION['user_name']; ?> Profile</span>
                    <hr>
                    <form action="" method="post">
                        <!-- Specialization Dropdown -->
                        <div class="mb-3">
                            <label class="form-label">User Name</label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">City</label>
                            <input type="text" name="city" class="form-control" value="<?= htmlspecialchars($user['city']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gender</label>
                            <input type="text" name="gender" class="form-control" value="<?= htmlspecialchars($user['gender']) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">User Email</label>
                            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>">
                        </div>

                        <!-- Submit -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>