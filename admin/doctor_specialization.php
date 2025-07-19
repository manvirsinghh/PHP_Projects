<?php
include('../config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);

    // Check if specialization already exists (case-insensitive)
    $select_query = "SELECT * FROM doctors_specialization WHERE LOWER(specialization)=LOWER('$specialization')";
    $check_result = mysqli_query($conn, $select_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('This specialization is already exists in the database.');</script>";
    } else {
        $insert_query = "INSERT INTO doctors_specialization(specialization) VALUES('$specialization')";
        $execute_query = mysqli_query($conn, $insert_query);
        if ($execute_query) {
            echo "<script>alert('Doctor Specialization added successfully.');</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.');</script>";
        }
    }
}
$select_query = "SELECT * FROM doctors_specialization ORDER BY id ASC";
$select_result = mysqli_query($conn, $select_query);
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
                                    <a class="nav-link" href="#">Manage Users</a>
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
                    <div class="dashboard-header mt-3">ADMIN | ADD DOCTOR SPECIALIZATION</div>
                    <div class="breadcrumb-text d-flex justify-content-end">Admin / Add Doctor Specialization</div>

                    <!-- <div class="footer-text">HOSPITAL MANAGEMENT SYSTEM</div> -->
                </div>
                <div class="container mt-5 w-100 ">
                    <div class="card shadow p-4">
                        <h4 class="mb-4 text-center">Doctor Specialization</h4>
                        <form method="post">
                            <div class="mb-3">
                                <label for="specialization" class="form-label">Doctor Specialization</label>
                                <input type="text" class="form-control" id="specialization" name="specialization" required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Manage doctor specialization -->
                <div class="container">
                    <h5 class="fw-lighter mt-3">Manage Doctor Specialization</h5>
                    <table class="table table-bordered table-striped">
                        <tr class="fw-lighter">
                            <th>Sr No.</th>
                            <th>Specialization</th>
                            <th>Creation Date</th>
                            <th>Updation Date</th>
                            <th>Actions</th>
                        </tr>

                        <?php
                        $serial_no = 1;
                        if (mysqli_num_rows($select_result) > 0) {
                            while ($row = mysqli_fetch_assoc($select_result)) {
                                echo "<tr>";
                                echo "<td>" . $serial_no++ . "</td>";
                                echo "<td>" . $row['specialization'] . "</td>";
                                echo "<td>" . $row['created_at'] . "</td>";
                                echo "<td>" . $row['updated_at'] . "</td>";
                                echo "<td>
                <a href='edit-doctor-specialization.php?id=" . $row['id'] . "'><i class='fa-regular fa-pen-to-square'></i></a>
                &nbsp;
                <a href='delete-doctor-specialization.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'><i class='fa-solid fa-trash'></i></a>
              </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No records found.</td></tr>";
                        }
                        ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>
<