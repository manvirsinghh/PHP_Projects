<?php
session_start();
include 'config.php';
if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor-login.php");
    exit;
}
$doctor_id = $_SESSION['doctor_id'];
$query = "SELECT d.*, s.specialization AS spec_name
          FROM doctors d
          LEFT JOIN doctors_specialization s ON d.specialization_id = s.id
          WHERE d.id = '$doctor_id'";
$result = mysqli_query($conn, $query);
$doctor = mysqli_fetch_assoc($result);

//update query for profile 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['doctor_name'];
    $address = $_POST['clinic_address'];
    $fee = $_POST['consultancy_fee'];
    $contact = $_POST['contact_number'];
    $email = $_POST['email'];

    $update_query = "UPDATE doctors SET 
                        doctor_name = '$name',
                        doctor_clinic_address = '$address',
                        doctor_consultancy_fee = '$fee',
                        doctor_contact_number = '$contact',
                        doctor_email = '$email'
                    WHERE id = '$doctor_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Profile updated successfully!'); window.location.href='edit-doctor-profile.php';</script>";
        exit;
    } else {
        echo "<script>alert('Update failed!');</script>";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard | HMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .dashboard-cards .card {
            border: none;
            text-align: center;
            transition: 0.3s;
            cursor: pointer;
        }

        .dashboard-cards .card:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .dashboard-cards .card i {
            font-size: 30px;
            margin-bottom: 10px;
            color: #0d6efd;
        }

        .dashboard-cards .card-title {
            font-size: 18px;
            font-weight: 500;
        }

        .dashboard-cards .card a {
            font-size: 14px;
            color: #0d6efd;
            text-decoration: none;
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-title">Main Navigation</div>

        <a href="doctor-dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>

        <a href="appointment-history.php"><i class="fas fa-history me-2"></i> Appointment History</a>

        <!-- Patients Dropdown -->
        <a data-bs-toggle="collapse" href="#patientsSubmenu" role="button" aria-expanded="false" aria-controls="patientsSubmenu">
            <i class="fas fa-user-injured me-2"></i> Patients
            <i class="fas fa-chevron-down float-end"></i>
        </a>
        <div class="collapse" id="patientsSubmenu">
            <ul class="nav flex-column ms-3">
                <li class="nav-item">
                    <a class="nav-link" href="add-patient.php">Add Patients</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manage-patients.php">Manage Patients</a>
                </li>
            </ul>
        </div>

        <a href="search.php"><i class="fas fa-search me-2"></i> Search</a>
    </div>


    <!-- Content -->
    <div class="content">

        <!-- Top Bar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <div class="title ms-auto me-2">Hospital Management System</div>

            <div class="dropdown user-info me-3">
                <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle fa-lg me-2"></i>
                    <span><?php echo $_SESSION['doctor_name']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="edit-doctor-profile.php">My Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item text-danger" href="doctor-logout.php">Logout</a></li>
                </ul>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-section">
            <h5>DOCTOR | EDIT DOCTOR DETAILS</h5>


        </div>
        <div class="form bg-white p-2 ">
            <p>Edit Doctor</p>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Specialization</label>
                    <input type="text" class="form-control w-50"   value="<?php echo $doctor['spec_name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Name</label>
                    <input type="text" class="form-control w-50" name="doctor_name" value="<?php echo $doctor['doctor_name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Clinic address</label><br>
                    <textarea name="clinic_address"  rows="2" cols="50" class="w-50"><?php echo $doctor['doctor_clinic_address']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Consultancy fee</label>
                    <input type="text" class="form-control w-50" name="consultancy_fee"  value="<?php echo $doctor['doctor_consultancy_fee']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Contact Number</label>
                    <input type="tel" class="form-control w-50" name="contact_number"  value="<?php echo $doctor['doctor_contact_number']; ?>">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Doctor Email</label>
                    <input type="email" class="form-control w-50"  name="email" value="<?php echo $doctor['doctor_email']; ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-outline-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>