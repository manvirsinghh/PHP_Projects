<?php
 include('header.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Patient Login Card</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container mt-5 d-flex ">
  <div class="login-card card position-relative my-auto">
    <img src="images/patient.jpeg" class="card-img-top1" alt="">
    <div class="card-body">
      <h5 class="card-title">Patient Login</h5>
      <a href="user-login.php" class="btn btn-custom">Click Here</a>
    </div>
  </div>
    <div class="login-card card">
    <img src="images/doctor.jpeg" class="card-img-top2" alt="">
    <div class="card-body">
      <h5 class="card-title">Doctors Login</h5>
      <a href="doctor-login.php" class="btn btn-custom">Click Here</a>
    </div>
  </div>
    <div class="login-card card">
    <img src="images/admin.jpeg" class="card-img-top3" alt="">
    <div class="card-body">
      <h5 class="card-title">Admin Login</h5>
      <a href="admin/login.php" class="btn btn-custom">Click Here</a>
    </div>
  </div>
</div>

</body>
</html>
<?php include 'footer.php';?>