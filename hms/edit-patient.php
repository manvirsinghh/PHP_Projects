<?php
session_start();
include('config.php');

if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor-login.php");
    exit;
}

$doctor_id = $_SESSION['doctor_id'];

// Fetch patients assigned to the doctor
$select_query = "SELECT * FROM tblpatient WHERE Docid = '$doctor_id'";
$execute_query = mysqli_query($conn, $select_query);
$row = mysqli_fetch_assoc($execute_query);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $age = $_POST['age'];
    $history = $_POST['history'];

    $update_query = "UPDATE tblpatient SET 
        PatientName = '$name',
        PatientContno = '$contact',
        PatientGender = '$gender',
        PatientAdd = '$address',
        PatientAge = '$age',
        PatientMedhis = '$history',
         UpdationDate = NOW()
        WHERE Docid = '$doctor_id'" ;

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Patient updated successfully'); window.location.href='manage-patients.php';</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Patient | HMS</title>
   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f1f2f7;
            padding-top: 60px;
            z-index: 100;
        }

        .sidebar a {
            padding: 15px 20px;
            display: block;
            color: #000;
            text-decoration: none;
            background-color: #fff;
        }

        .sidebar .menu-title {
            padding: 10px 20px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 14px;
            color: #6c757d;
        }

        .topbar {
            background-color: white;
            padding: 15px 30px;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-left: 250px;
        }

        .content {
            margin-left: 250px;
            padding: 30px;
        }
    </style>
</head>

<body>

    <div class="sidebar position-fixed">
        <div class="menu-title">Main Navigation</div>
        <a href="doctor-dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="appointment-history.php"><i class="fas fa-history me-2"></i> Appointment History</a>
        <a href="#"><i class="fas fa-user-injured me-2"></i> Patients</a>
        <a href="#"><i class="fas fa-search me-2"></i> Search</a>
    </div>

    <div class="topbar">
        <h5 class="m-0 ms-auto me-2">Hospital Management System</h5>
        <div class="dropdown">
            <a class="text-dark text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i> <?php echo $_SESSION['doctor_name']; ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="#">My Profile</a></li>
                <li><a class="dropdown-item text-danger" href="doctor-logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h6 class="mb-3">PATIENTS | ADD PATIENTS</h6>

        <div class="form border border-1 border-light shadow-lg p-3 w-50">
            <span>Add Patient</span>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="" class="form-label">Patient Name</label>
                    <input type="text" class="form-control" name="name" value="<?php echo $row['PatientName'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Patient Contact No</label>
                    <input type="tel" class="form-control" name="contact" value="<?php echo $row['PatientContno']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Gender</label><br>
                    <input type="radio" name="gender" value="Male" <?php if ($row['PatientGender'] == 'Male') echo 'checked'; ?>> Male
                    <input type="radio" name="gender" value="Female" <?php if ($row['PatientGender'] == 'Female') echo 'checked'; ?>> Female
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Patient Address</label><br>
                    <textarea name="address" rows="2" cols="50" class="form-control"><?php echo $row['PatientAdd']; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="">Patient Age</label>
                    <input type="text" class="form-control" name="age" value="<?php echo $row['PatientAge']; ?>">
                </div>

                <div class="mb-3">
                    <label for="">Medical History</label>
                    <textarea name="history" rows="2" cols="50" class="form-control"><?php echo $row['PatientMedhis']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Creation Date</label>
                    <input type="text" class="form-control" value="<?php echo $row['CreationDate']; ?>">
                </div>
             
                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-secondary text-info">Update</button>
                </div>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
</body>

</html>