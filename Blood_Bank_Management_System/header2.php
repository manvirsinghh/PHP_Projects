<?php
include("config.php");
session_start();
ob_start();
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blood Bank</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="shortcut icon" href="./img/drop.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css">
  <style>
    /* Ensure buttons and dropdowns adjust on small screens */
    @media (max-width: 768px) {
      .navbar-nav {
        text-align: center;
      }
      .dropdown-menu {
        text-align: center;
      }
      .btn-custom {
        width: 100%;
        margin-bottom: 5px;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img src="img/lbb.png" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto">
          <li class="nav-item">
            <a class="nav-link active text-secondary" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-secondary" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-secondary" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active text-secondary" href="upcoming_events.php">Upcoming Events</a>
          </li>

          <?php
          if (!isset($_SESSION['username'])) {
            echo '<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-secondary" href="#" id="registerDropdown" role="button" data-bs-toggle="dropdown">
                      Register
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="blood_donor_register.php">Blood Donor Register</a></li>
                      <li><a class="dropdown-item" href="blood_seeker_register.php">Blood Seeker Register</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-secondary" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown">
                      Login
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="blood_donor_login.php">Blood Donor Login</a></li>
                      <li><a class="dropdown-item" href="blood_seeker_login.php">Blood Seeker Login</a></li>
                    </ul>
                  </li>';
          } else {
            echo '<li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Logout</a>
                  </li>';
          }
          ?>
        </ul>

        <!-- Right-side Buttons -->
        <div class="text-center">
          <?php
          if (isset($_SESSION["username"])) {
            echo '
            <a class="btn btn-custom text-white me-2" style="background-color: #FF4444;" href="blood_seeker.php">Find Donar</a>
            <a class="btn btn-custom text-white" style="background-color: #FF4444;" href="emergency.php">Emergency</a>';
          } else {
            echo '
            <a class="btn btn-custom text-white me-2" style="background-color: #FF4444;" href="detail_dashboard.php">Want to Donate Blood?</a>
            <a class="btn btn-custom text-white" style="background-color: #FF4444;" href="blood_seeker.php">Need Blood?</a>';
          }
          ?>
            </div>
      </div>
    </div>
  </nav>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>
