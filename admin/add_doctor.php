<?php
include('../config.php');
require_once('validation_functions.php');
$query = "SELECT id, specialization FROM doctors_specialization ORDER BY specialization ASC";
$result = mysqli_query($conn, $query);

?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    if (isset($_POST['specialization_id']) && is_numeric($_POST['specialization_id'])) {
        $specialization_id = $_POST['specialization_id'];
    } else {
        $errors[] = "Invalid or missing specialization ID.";
    }

    $doctor_name = $_POST['doctor_name'];
    $doctor_clinic_address = $_POST['doctor_clinic_address'];
    $doctor_consultancy_fee = $_POST['doctor_consultancy_fee'];
    $doctor_contact_number = $_POST['doctor_contact_number'];
    $doctor_email = $_POST['doctor_email'];
    $password_raw = $_POST['password'];
    $confirm_password_raw = $_POST['confirm_password'];


    // Validate phone
    if (!validating_phone_no($doctor_contact_number)) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    // Validate email
    if (!validateEmail($doctor_email)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (!validatePassword($password_raw)) {
        $errors[] = "Password must be at least 8 characters long and include upper/lowercase letters, a number, and a special character.";
    }
    // Confirm password match BEFORE hashing
    if ($password_raw !== $confirm_password_raw) {
        $errors[] = "Passwords do not match.";
    }
    // Check for duplicate doctor in the same specialization
$duplicate_query = "SELECT * FROM doctors WHERE doctor_email = '$doctor_email' AND specialization_id = '$specialization_id'";
$duplicate_result = mysqli_query($conn, $duplicate_query);

if (mysqli_num_rows($duplicate_result) > 0) {
    echo "<script>alert('Doctor already exists with this specialization.');</script>";
} else {
    // Proceed with insert
    $password_hashed = password_hash($password_raw, PASSWORD_DEFAULT);
    $insert_query = "INSERT INTO doctors(specialization_id,doctor_name,doctor_clinic_address,doctor_consultancy_fee,doctor_contact_number,
    doctor_email,password) VALUES('$specialization_id','$doctor_name','$doctor_clinic_address','$doctor_consultancy_fee','$doctor_contact_number','$doctor_email','$password_hashed')";
    $execute_query = mysqli_query($conn, $insert_query);
    if ($execute_query) {
        echo "<script>alert('DOCTOR DETAILS ADDED SUCCESSFULLY');</script>";
    } else {
        echo "<script>alert('Something went wrong');</script>";
    }
}
   // Display validation errors
        foreach ($errors as $error) {
            echo "<script>alert('$error');</script>";
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
                    <a class="nav-link" href=""><i class="fas fa-clock"></i> Doctor Session Logs</a>
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
                    <div class="dashboard-header mt-3">ADMIN | ADD DOCTOR</div>
                    <div class="breadcrumb-text d-flex justify-content-end">Admin / Doctor</div>

                    <!-- <div class="footer-text">HOSPITAL MANAGEMENT SYSTEM</div> -->
                </div>
                <div class="container border border-1 shadow-lg">

                    <form action="" method="post">
                        <h5>Add Doctor</h5>
                        <div class="mb-3">
                            <label for="">Doctor Specialization </label>
                            <select name="specialization_id" class="form-select" required>
                                <option value="" disabled selected>-- Select Specialization --</option>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value='" . $row['id'] . "'>" . $row['specialization'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <!-- <div class="mb-3">
                            <select name="specialization_id" class="form-select" required>
                                <option value="">Select Specialization ID</option>
                                <?php
                                $spec_result = mysqli_query($conn, "SELECT id FROM doctors_specialization");
                                while ($spec = mysqli_fetch_assoc($spec_result)) {
                                    echo "<option value='{$spec['id']}'>{$spec['id']}</option>";
                                }
                                ?>
                            </select>

                        </div> -->
                        <div class="mb-3">
                            <label for="doctor_name" class="form-label">Doctor Name</label>
                            <input type="text" class="form-control" placeholder="Enter Doctor Name" name="doctor_name">

                        </div>
                        <div class="mb-3">
                            <label for="doctor_clinic_address" class="form-label">Doctor Clinic Address</label><br>
                            <textarea name="doctor_clinic_address" id="" placeholder="Enter doctor clinic address" rows="3" cols="110"></textarea>

                        </div>
                        <div class="mb-3">
                            <label for="doctor_consultancy_fee" class="form-label">Doctor Consultancy fee</label>
                            <input type="text" name="doctor_consultancy_fee" class="form-control" placeholder="Enter Doctor consultancy fee">

                        </div>
                        <div class="mb-3">
                            <label for="doctor_contact_number" class="form-label">Doctor Contact No</label>
                            <input type="tel" name="doctor_contact_number" class="form-control" placeholder="Enter Doctor Contact number">

                        </div>
                        <div class="mb-3">
                            <label for="doctor_email" class="form-label">Doctor Email</label>
                            <input type="email" name="doctor_email" class="form-control" placeholder="Enter Doctor Email">

                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">

                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" placeholder="Enter confirm password">

                        </div>

                        <button type="submit" class="border rounded text-info fw-bold bg-success">Submit</button>

                    </form>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>