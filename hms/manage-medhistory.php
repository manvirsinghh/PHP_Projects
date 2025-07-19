<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: user-login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name=$_SESSION['user_name'];
$user_query = mysqli_query($conn, "SELECT PatientName FROM tblpatient WHERE ID = '$user_id'");
$user = mysqli_fetch_assoc($user_query);

$query = mysqli_query($conn, "SELECT * FROM tblpatient");
$cnt = 1;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Medical History | HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            position: fixed;
            height: 100vh;
            background-color: #f5f6fa;
            padding-top: 30px;
            border-right: 1px solid #dee2e6;
        }

        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: #333;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #e9ecef;
        }

        .topbar {
            margin-left: 250px;
            padding: 15px 30px;
            background-color: white;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }

        table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .page-title {
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .breadcrumb {
            font-size: 0.9rem;
            background: none;
            padding: 0;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <h5 class="text-center mb-4">HMS</h5>
        <a href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="book-appointment.php"><i class="fas fa-calendar-check me-2"></i> Book Appointment</a>
        <a href="appointment-history.php"><i class="fas fa-history me-2"></i> Appointment History</a>
        <a href="manage-medhistory.php" fas fa-notes-medical me-2"></i> Medical History</a>
    </div>

    <div class="topbar">
        <div>
            <span class="fs-5 fw-semibold">Hospital Management System</span>
        </div>
        <div class="dropdown">
            <a href="#" class="text-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>
                <?php echo htmlspecialchars($user_name); ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <div class="page-title">USERS | MEDICAL HISTORY</div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Users</li>
                        <li class="breadcrumb-item active" aria-current="page">View Medical History</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Patient Contact Number</th>
                        <th>Patient Gender</th>
                        <th>Creation Date</th>
                        <th>Updation Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_array($query)) { ?>
                        <tr>
                            <td><?php echo $cnt++; ?></td>
                            <td><?php echo $row['PatientName']; ?></td>
                            <td><?php echo $row['PatientContno']; ?></td>
                            <td><?php echo $row['PatientGender']; ?></td>
                            <td><?php echo $row['CreationDate']; ?></td>
                            <td><?php echo $row['UpdationDate']; ?></td>
<td>
    <a href="view-medhistory.php?viewid=<?php echo $row['id']; ?>" class="text-dark" title="View">
        <i class="fas fa-eye"></i>
    </a>
</td>




                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

</body>

</html>