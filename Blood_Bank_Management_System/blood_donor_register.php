<?php 
include("header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Registration</title>
    <link rel="stylesheet" href="style4.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
       
            <div class="col-md-6">
            <h3 class="text-center fw-bold mb-3">Blood Donor Registration</h3>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Check if email or username already exists
                    $check_email_sql = "SELECT * FROM blood_donor_registration WHERE email='$email'";
                    $check_username_sql = "SELECT * FROM blood_donor_registration WHERE username='$username'";
                    $email_result = $conn->query($check_email_sql);
                    $username_result = $conn->query($check_username_sql);

                    if ($email_result->num_rows > 0) {
                        echo '<div class="alert alert-danger text-center fw-bold p-2 mb-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Email already exists!
                              </div>';
                    } 
                    else if ($username_result->num_rows > 0) {
                        echo '<div class="alert alert-danger text-center fw-bold p-2 mb-3" role="alert">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i> Username already exists!
                              </div>';
                    } 
                    else {
                        $sql = "INSERT INTO blood_donor_registration(email, username, password) VALUES('$email','$username','$password')";

                        
                        if ($conn->query($sql) === TRUE) {
                            header("Location: blood_donor_login.php");
                            exit();
                        } else {
                            echo '<div class="alert alert-danger text-center fw-bold p-2 mb-3" role="alert">
                                    Something went wrong. Please try again later.
                                  </div>';
                        }
                    }
                }
                ?>
                  <div class="p-4 rounded shadow bg-white">
                    <form method="post">
                        <div class="mb-3">
                            <label for="email" class="fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control input-field" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="username" class="fw-bold">Create Username</label>
                            <input type="text" name="username" class="form-control input-field" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="fw-bold">Create Password</label>
                            <input type="password" name="password" class="form-control input-field" required>
                        </div>

                        <button type="submit" class="btn btn-custom w-100 bg-danger text-white">Submit</button>

                        <h6 class="text-center mt-3">Already have an Account? 
                            <a href="blood_donor_login.php" class="text-danger">Login as Blood Donor</a>
                        </h6>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

