<?php
include('../config.php');
$select_query = "SELECT * FROM contact_us";
$execute_query = mysqli_query($conn, $select_query);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unread queries</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
                                    <a class="nav-link" href="">Read Query</a>
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
                    <div class="dashboard-header mt-3">ADMIN | MANAGE UNREAD QUERIES</div>
                    <div class="breadcrumb-text d-flex justify-content-end">Admin / Manage unread queries</div>

                    <p><span>Manage:</span><span> Unread Queries</span></p>
                    <table class="table table-bordered table-striped">
                        <tr>
                            <td>Sr No.</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Contact no</td>
                            <td>Message</td>
                            <td>Query Date</td>
                            <td>Actions</td>
                        </tr>
                        <?php
                        $serialno = 1;
                        while ($row = mysqli_fetch_assoc($execute_query)) {
                            echo "<tr>";
                            echo "<td>" . $serialno++ . "</td>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email_address'] . "</td>";
                            echo "<td>" . $row['mobile_no'] . "</td>";
                            echo "<td>" . $row['message'] . "</td>";
                            echo "<td>" . $row['Query_date'] . "</td>";
                            echo "<td>

                          
                              <a href='query-details.php?id=" . $row['id'] . "' class='btn btn-sm  btn-primary'>  <i class='fa-solid fa-file fa-2x'></i></a>
                          
                          
                          </td>";


                            "</tr>";
                        }

                        ?>
                    </table>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>