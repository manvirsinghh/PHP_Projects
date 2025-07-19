<?php

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    

    $insert_query = "INSERT INTO patients(name,address,city,gender,email,password) VALUES('$name','$address','$city','$gender','$email','$password')";
    $execute_query = mysqli_query($conn, $insert_query);
    if($execute_query){
      echo "<script>alert('Registration successful.You can login now');
      window.location.href='registration.php';
      </script>";

    }
    else{
        echo "Invalid credentials";
    }
}

?>













<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HMS | Patient Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-3 text-center">HMS | Patient Registration</h4>

                    <form method="post">
                        <fieldset class="border p-3 rounded mb-4">
                            <legend class="float-none w-auto px-2 text-info fw-bold">Sign Up</legend>
                            <p>Enter your personal details below:</p>

                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Full Name" name="name">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Address" name="address">
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="City" name="city">
                            </div>

                            <div class="mb-3">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                            </div>
                        </fieldset>

                        <p class="mb-2">Enter your account details below:</p>

                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                            <input type="email" class="form-control" placeholder="Email" name="email">
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </div>
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" class="form-control" placeholder="Password Again" name="confirm_password"> 
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="agree">
                            <label class="form-check-label" for="agree">I agree</label>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary">
                                Submit <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>

                        <div class="text-center">
                            Already have an account? <a href="user-login.php">Log-in</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>