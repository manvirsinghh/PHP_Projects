<?php
include("config.php");
include 'validation.php'; // Make sure you have the validatePhoneNumber function here.
session_start();

// Check if event_id is provided
if (!isset($_GET['event_id']) || empty($_GET['event_id'])) {
    die("Invalid event selected.");
}

$event_id = $_GET['event_id'];

// Fetch event details
$event_query = "SELECT * FROM events WHERE id = $event_id";
$event_result = mysqli_query($conn, $event_query);
$event = mysqli_fetch_assoc($event_result);

if (!$event) {
    die("Event not found.");
}

// Initialize error messages
$errors = [];
$success_message = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $blood_group = $_POST['blood_group'];
    $city = $_POST['city'];

    // Validate phone number
    $phoneError = validatePhoneNumber($phone);
    if (!empty($phoneError)) {
        $errors['phone'] = $phoneError;
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $query = "INSERT INTO camp_registrations (event_id, name, email, phone, blood_group, city) 
                  VALUES ('$event_id', '$name', '$email', '$phone', '$blood_group', '$city')";
        
        if (mysqli_query($conn, $query)) {
            header("location:upcoming_events.php");
        } else {
            $errors['database'] = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for Blood Camp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="text-center text-danger">Register for Blood Donation Camp</h2>
    <div class="card p-4 mt-3 shadow">
        <h4 class="text-center text-primary"><?php echo $event['blood_camp_name']; ?></h4>
        <p class="text-center"><strong>Location:</strong> <?php echo $event['location']; ?> | <strong>Date:</strong> <?php echo $event['calendar']; ?></p>

        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" value="<?php echo isset($name) ? $name : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>">
                <?php if (isset($errors['phone'])): ?>
                    <div class="text-danger"><?php echo $errors['phone']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Blood Group</label>
                <select class="form-control" name="blood_group" required>
                    <option value="">Select</option>
                    <option value="A+" <?php echo (isset($blood_group) && $blood_group == "A+") ? 'selected' : ''; ?>>A+</option>
                    <option value="A-" <?php echo (isset($blood_group) && $blood_group == "A-") ? 'selected' : ''; ?>>A-</option>
                    <option value="B+" <?php echo (isset($blood_group) && $blood_group == "B+") ? 'selected' : ''; ?>>B+</option>
                    <option value="B-" <?php echo (isset($blood_group) && $blood_group == "B-") ? 'selected' : ''; ?>>B-</option>
                    <option value="O+" <?php echo (isset($blood_group) && $blood_group == "O+") ? 'selected' : ''; ?>>O+</option>
                    <option value="O-" <?php echo (isset($blood_group) && $blood_group == "O-") ? 'selected' : ''; ?>>O-</option>
                    <option value="AB+" <?php echo (isset($blood_group) && $blood_group == "AB+") ? 'selected' : ''; ?>>AB+</option>
                    <option value="AB-" <?php echo (isset($blood_group) && $blood_group == "AB-") ? 'selected' : ''; ?>>AB-</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">City</label>
                <input type="text" class="form-control" name="city" value="<?php echo isset($city) ? $city : ''; ?>">
            </div>

            <button type="submit" class="btn btn-danger w-100">Register</button>
        </form>
    </div>
</div>

</body>
</html>
