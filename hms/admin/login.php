<?php
session_start();
include '../config.php';

$error = ''; // Step 1

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT id, username, password FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            // $_SESSION['admin_username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid email or password."; // Step 2
        }
    }
     else {
        $error = "Invalid email or password."; // Show this if no user found
    }
}
?>

<?php
// session_start();
include '../config.php';

$error = ''; // Step 1

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $query = "SELECT id, username, password FROM admins WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_username'] = $row['username'];
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }

        .login-box {
            background: #fff;
            padding: 30px 25px;
            width: 100%;
            max-width: 400px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-box h3 {
            font-weight: 300;
            margin-bottom: 15px;
            color: #333;
        }

        .login-box legend {
            font-size: 18px;
            margin-bottom: 10px;
            color: #007bff;
        }

        .login-box p {
            font-size: 14px;
            color: #555;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .input-group {
            position: relative;
            margin-bottom: 15px;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #aaa;
        }

        .input-group input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 4px;
            font-size: 15px;
            margin-top: 10px;
        }

        button[type="submit"] i {
            margin-left: 5px;
        }

        .back-link {
            display: block;
            text-align: left;
            margin-top: 15px;
            font-size: 13px;
            color: #007bff;
            text-decoration: none;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #666;
        }
    </style>
</head>
<body>

    <div class="login-box">
        <h3>Admin Login</h3>
        <form method="post">
            <fieldset>
                <legend>Sign in to your account</legend>
                <p>Please enter your name and password to log in.</p>

                <?php if (!empty($error)): ?>
                    <div class="error-message"><?php echo $error; ?></div>
                <?php endif; ?>

                <div class="input-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit">Login <i class="fas fa-arrow-right"></i></button>
                <a class="back-link" href="../index.php">Bacto Home Page</a>
            </fieldset>
        </form>
        <div class="footer">HOSPITAL MANAGEMENT SYSTEM</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
