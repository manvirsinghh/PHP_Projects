<?php
include('../config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM doctors_specialization WHERE id=$id");
    $doctor = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);

    // Check if another specialization with the same name exists
    $check_query = "SELECT * FROM doctors_specialization WHERE LOWER(specialization) = LOWER('$specialization') AND id != $id";
    $check_result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('This specialization already exists.');</script>";
    } else {
        // $update_query = "UPDATE doctors_specialization SET specialization='$specialization' WHERE updated_at=NOW(),id=$id";
        $update_query = "UPDATE doctors_specialization SET specialization='$specialization', updated_at=NOW() WHERE id=$id";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('Doctor Specialization updated successfully.'); window.location.href='doctor_specialization.php';</script>";
            exit;
        } else {
            echo "<script>alert('Something went wrong.');</script>";
        }
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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

   
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
                    <div class="admin-profile">
                        <img src="../images/admin.jpeg" class="rounded me-2" alt="Admin" width="30" height="30">
                        Admin <i class="fas fa-chevron-down ms-1"></i>

                    </div>
                </div>

                <div class="p-3">
                    <div class="dashboard-header mt-3">ADMIN | EDIT DOCTOR SPECIALIZATION</div>
                    <div class="breadcrumb-text d-flex justify-content-end">Admin / Edit Doctor Specialization</div>

                    <!-- <div class="footer-text">HOSPITAL MANAGEMENT SYSTEM</div> -->
                </div>
                <div class="container mt-5 w-100 ">
                    <div class="card shadow p-4">
                        <h6 class="mb-4 ">Edit Doctor Specialization</h6>
                        <form method="post">
                            <div class="mb-3">
                                <label for="specialization" class="form-label">Doctor Specialization</label>
                                <input type="text" class="form-control" id="specialization" name="specialization" value="<?php echo htmlspecialchars($doctor['specialization'] ?? '', ENT_QUOTES); ?>" required>

                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>
<