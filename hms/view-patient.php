<?php
session_start();
include('config.php');

if (!isset($_SESSION['doctor_id'])) {
  header("Location: doctor-login.php");
  exit;
}

$doctor_id = $_SESSION['doctor_id'];
$vid = isset($_GET['viewid']) ? $_GET['viewid'] : null;
// Fetch patients assigned to the doctor
$select_query = "SELECT * FROM tblpatient WHERE Docid = '$doctor_id' AND ID = '$vid'";
$execute_query = mysqli_query($conn, $select_query);
if (isset($_POST['submit'])) {

  $vid = $_GET['viewid'];
  $blood_pressure = $_POST['blood_pressure'];
  $blood_sugar = $_POST['blood_sugar'];
  $weight = $_POST['weight'];
  $temperature = $_POST['temperature'];
  $prescription = $_POST['prescription'];


  $query = mysqli_query($conn, "INSERT INTO  tblmedicalhistory(PatientID,BloodPressure,BloodSugar,Weight,Temperature,MedicalPres)value('$vid','$blood_pressure','$blood_sugar','$weight','$temperature','$prescription')");
  if ($query) {
    echo '<script>alert("Medical history has been added.")</script>';
    echo "<script>window.location.href ='manage-patients.php'</script>";
  } else {
    echo '<script>alert("Something Went Wrong. Please try again")</script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Patient | HMS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    h2,
    h4 {
      text-align: center;
    }

    .btn {
      display: block;
      margin: 0 auto;
      padding: 10px 20px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn:hover {
      background-color: #0056b3;
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
    <h6 class="mb-3">DOCTOR | MANAGE PATIENTS</h6>
    <span>Manage: <b>Patients</b></span>

    <?php while ($row = mysqli_fetch_assoc($execute_query)) { ?>
      <h2 class="mt-5">Patient Details</h2>
      <table class="table table-bordered w-100">
        <tr>
          <th>Patient Name</th>
          <td><?php echo $row['PatientName']; ?></td>
          <th>Patient Email</th>
          <td><?php echo $row['PatientEmail']; ?></td>
        </tr>
        <tr>
          <th>Mobile Number</th>
          <td><?php echo $row['PatientContno']; ?></td>
          <th>Address</th>
          <td><?php echo $row['PatientAdd']; ?></td>
        </tr>
        <tr>
          <th>Gender</th>
          <td><?php echo $row['PatientGender']; ?></td>
          <th>Age</th>
          <td><?php echo $row['PatientAge']; ?></td>
        </tr>
        <tr>
          <th>Medical History</th>
          <td><?php echo $row['PatientMedhis']; ?></td>
          <th>Registration Date</th>
          <td><?php echo $row['CreationDate']; ?></td>
        </tr>
      </table>

      <!-- Medical History Section -->
      <!-- <h4 class="mt-4">Medical History</h4>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Blood Pressure</th>
                    <th>Weight</th>
                    <th>Blood Sugar</th>
                    <th>Body Temperature</th>
                    <th>Prescription</th>
                    <th>Visit Date</th>
                </tr>
            </thead>
            <tbody>
               
            </tbody>
        </table> -->
      <?php

      $ret = mysqli_query($conn, "SELECT * FROM tblmedicalhistory WHERE PatientID='$vid'");
      $cnt = 1; // ✅ Initialize the counter

      ?>
      <table id="datatable" class="table table-bordered dt-responsive nowrap">
        <tr align="center">
          <th colspan="8">Medical History</th>
        </tr>
        <tr>
          <th>#</th>
          <th>Blood Pressure</th>
          <th>Weight</th>
          <th>Blood Sugar</th>
          <th>Body Temperature</th>
          <th>Medical Prescription</th>
          <th>Visit Date</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_array($ret)) {
        ?>
          <tr>
            <td><?php echo $cnt; ?></td>
            <td><?php echo $row['BloodPressure']; ?></td>
            <td><?php echo $row['Weight']; ?></td>
            <td><?php echo $row['BloodSugar']; ?></td>
            <td><?php echo $row['Temperature']; ?></td>
            <td><?php echo $row['MedicalPres']; ?></td>
            <td><?php echo $row['CreationDate']; ?></td>
          </tr>
        <?php $cnt++;
        } ?>

        <!-- Trigger Button -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#medicalHistoryModal">
          Add Medical History
        </button>
        <!-- Modal HTML -->
        <div class="modal fade" id="medicalHistoryModal" tabindex="-1" aria-labelledby="medicalHistoryModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <form method="POST">
                <div class="modal-header">
                  <h5 class="modal-title" id="medicalHistoryModalLabel">Add Medical History</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                  <div class="container">
                    <div class="row mb-3">
                      <div class="col-md-4 text-end">
                        <label for="bp" class="form-label">Blood Pressure :</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="bp" name="blood_pressure" placeholder="Blood Pressure">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-4 text-end">
                        <label for="sugar" class="form-label">Blood Sugar :</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="sugar" name="blood_sugar" placeholder="Blood Sugar">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-4 text-end">
                        <label for="weight" class="form-label">Weight :</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="weight" name="weight" placeholder="Weight">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-4 text-end">
                        <label for="temp" class="form-label">Body Temperature :</label>
                      </div>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="temp" name="temperature" placeholder="Body Temperature">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <div class="col-md-4 text-end">
                        <label for="prescription" class="form-label">Prescription :</label>
                      </div>
                      <div class="col-md-8">
                        <textarea class="form-control" id="prescription" name="prescription" placeholder="Medical Prescription" rows="4"></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>

                </div>
              </form>
            </div>
          </div>
        </div>

        <hr class="my-5">
      <?php } ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>