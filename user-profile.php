<?php
session_start();
include('config.php');

// Simulating login (use actual session in real project)
$user_id = $_SESSION['user_id']; // Make sure this is set after login

// Fetch user data
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $city = $_POST['city'];

    $update = "UPDATE users SET name='$name', email='$email', gender='$gender',city='$city' WHERE id=$user_id";
    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Profile updated successfully'); window.location='user-profile.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #f8f9fa;">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">My Profile</h4>
                </div>
                <div class="card-body">
                    <form method="POST" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label d-block">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
                                    <?= $user['gender'] === 'Male' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="male">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
                                    <?= $user['gender'] === 'Female' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="female">Female</label>
                            </div>

                            
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">City</label>
                            <input type="text" name="city" value="<?= htmlspecialchars($user['city']) ?>" class="form-control" required>
                        </div>

                        <div class="col-12 mt-3 text-center">
                            <button type="submit" class="btn btn-outline-primary ">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
