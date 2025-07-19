<?php
include('../config.php');
// Get doctor ID from URL
// Get doctor ID from URL
$doctor_id = $_GET['id'];

// Fetch current doctor data
$query = "SELECT * FROM doctors WHERE id = $doctor_id";
$result = mysqli_query($conn, $query);
$doctor = mysqli_fetch_assoc($result);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $specialization_id = $_POST['specialization_id'];
    $doctor_name = $_POST['doctor_name'];
    $doctor_clinic_address = $_POST['doctor_clinic_address'];
    $doctor_consultancy_fee = $_POST['doctor_consultancy_fee'];
    $doctor_contact_number = $_POST['doctor_contact_number'];
    $doctor_email = $_POST['doctor_email'];

    $update_query = "UPDATE doctors SET 
        specialization_id = '$specialization_id',
        doctor_name = '$doctor_name',
        doctor_clinic_address = '$doctor_clinic_address',
        doctor_consultancy_fee = '$doctor_consultancy_fee',
        doctor_contact_number = '$doctor_contact_number',
        doctor_email = '$doctor_email'
        WHERE id = $doctor_id";

    $run = mysqli_query($conn, $update_query);

    if ($run) {
        echo "<script>alert('Doctor updated successfully'); window.location.href='manage_doctors.php';</script>";
    } else {
        echo "<script>alert('Error updating doctor');</script>";
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
                    <div class="dashboard-header mt-3">ADMIN | EDIT DOCTOR DETAILS</div>
                    <div class="breadcrumb-text d-flex justify-content-end">Admin / Edit Doctors Details</div>


                </div>
                <form method="POST" class="p-4 bg-light border rounded shadow-sm">

                    <div class="mb-3">
                        <label for="specialization_id" class="form-label">Specialization</label>
                        <select name="specialization_id" class="form-select" required>
                            <?php
                            $spec_result = mysqli_query($conn, "SELECT * FROM doctors_specialization");
                            while ($spec = mysqli_fetch_assoc($spec_result)) {
                                $selected = $spec['id'] == $doctor['specialization_id'] ? "selected" : "";
                                echo "<option value='{$spec['id']}' $selected>{$spec['specialization']}</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Doctor Name</label>
                        <input type="text" name="doctor_name" class="form-control" value="<?= htmlspecialchars($doctor['doctor_name']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Clinic Address</label>
                        <textarea name="doctor_clinic_address" class="form-control"><?= htmlspecialchars($doctor['doctor_clinic_address']) ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Consultancy Fee</label>
                        <input type="text" name="doctor_consultancy_fee" class="form-control" value="<?= htmlspecialchars($doctor['doctor_consultancy_fee']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Number</label>
                        <input type="text" name="doctor_contact_number" class="form-control" value="<?= htmlspecialchars($doctor['doctor_contact_number']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="doctor_email" class="form-control" value="<?= htmlspecialchars($doctor['doctor_email']) ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Doctor</button>
                    <a href="manage_doctors.php" class="btn btn-secondary">Cancel</a>
                </form>

            </div>
            <!-- Edit Form -->

        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>