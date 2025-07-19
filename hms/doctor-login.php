<?php
session_start();
include 'config.php';

$message = '';
if (isset($_GET['logout']) && $_GET['logout'] === 'success') {
    $message = 'You have successfully logout';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM doctors WHERE doctor_email = '$email'");
    // if ($doctor = mysqli_fetch_assoc($query)) {
    //     if (password_verify($password, $doctor['password'])) {
    //         $_SESSION['doctor_id'] = $doctor['id'];
    //         $_SESSION['doctor_name'] = $doctor['doctor_name'];
    //         $_SESSION['doctor_email'] = $doctor['doctor_email'];
    //         header("Location: doctor-dashboard.php");
    //         exit;
    //     } else {
    //         $message = "Incorrect password.";
    //     }
    // } else {
    //     $message = "Doctor not found or inactive.";
    // }
    $ip = $_SERVER['REMOTE_ADDR']; // Get user IP

if ($doctor = mysqli_fetch_assoc($query)) {
    if (password_verify($password, $doctor['password'])) {
        // ✅ Successful login
        $_SESSION['doctor_id'] = $doctor['id'];
        $_SESSION['doctor_name'] = $doctor['doctor_name'];
        $_SESSION['doctor_email'] = $doctor['doctor_email'];

        // Insert success log
        mysqli_query($conn, "INSERT INTO doctorslog (uid, username, userip, loginTime, status)
                             VALUES ('{$doctor['id']}', '{$doctor['doctor_email']}', '$ip', NOW(), 1)");

        header("Location: doctor-dashboard.php");
        exit;
    } else {
        // ❌ Incorrect password
        $message = "Incorrect password.";
        mysqli_query($conn, "INSERT INTO doctorslog (username, userip, loginTime, status)
                             VALUES ('$email', '$ip', NOW(), 0)");
    }
} else {
    // ❌ Doctor not found
    $message = "Doctor not found or inactive.";
    mysqli_query($conn, "INSERT INTO doctorslog (username, userip, loginTime, status)
                         VALUES ('$email', '$ip', NOW(), 0)");
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>HMS | Doctor Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            font-family: Arial, sans-serif;
        }

        .login-container {
            margin-top: 100px;
        }

        .login-box {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #86b7fe;
        }

        .form-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            color: #aaa;
        }

        .form-input {
            padding-left: 35px;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: #777;
            font-size: 14px;
        }

        .message {
            font-size: 14px;
            margin-bottom: 10px;
            color: red;
        }
    </style>
</head>
<body>

<div class="container login-container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h4 class="text-center mb-4">HMS | Doctor Login</h4>
            <div class="login-box">
                <p class="text-primary mb-1">Sign in to your account</p>

                <?php if (!empty($message)) : ?>
                    <div class="message"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="mb-3 position-relative">
                        <span class="form-icon"><i class="fa fa-user"></i></span>
                        <input type="email" name="email" class="form-control form-input" placeholder="Email" required>
                    </div>

                    <div class="mb-3 position-relative">
                        <span class="form-icon"><i class="fa fa-lock"></i></span>
                        <input type="password" name="password" class="form-control form-input" placeholder="Password" required>
                    </div>

                    <div class="mb-3">
                        <a href="#" class="text-decoration-none">Forgot Password ?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Login <i class="fa fa-arrow-circle-right"></i></button>
                </form>
            </div>
            <div class="footer-text mt-3">HOSPITAL MANAGEMENT SYSTEM</div>
        </div>
    </div>
</div>

<!-- Font Awesome for icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/js/all.min.js"></script>

</body>
</html>
