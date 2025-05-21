<?php

include("header.php");
include("validation.php");
if(!isset($_SESSION['username'])){
    header("location:blood_donor_login.php");
}
$phone_error = "";
$phonenumber = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $phonenumber = $_POST['pno'];

    // Validate phone number
    $phone_error = validatePhoneNumber($phonenumber);

    // If phone number is valid, proceed with form submission
    if (empty($phone_error)) {
        $username = $_SESSION['username'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $blood_group = $_POST['blood_group'];
        $health_issues = $_POST['health_issues'];
        $image = $_FILES['image']['name'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $target = "uploads/" . basename($image);

            if (!is_dir('uploads')) {
                mkdir('uploads', 0777, true);
            }

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                if ($age >= 18 && $age <= 65 && $health_issues == "None") {
                    $store_health_issue = "No";
                    $sql = "INSERT INTO donor_details (username, age, email, pno, address, state, city, blood_group, health_issues, image) 
                            VALUES ('$username', $age, '$email', '$phonenumber', '$address', '$state', '$city', '$blood_group', '$store_health_issue', '$image')";

                    if ($conn->query($sql) === TRUE) {
                        // echo "<div class='alert alert-success mt-3'>Data inserted successfully.</div>";
                        header("Location: blood_donor_dashboard.php");
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Error inserting data: " . $conn->error . "</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning mt-3'>Not eligible to donate blood.</div>";
                }
            } else {
                echo "<div class='alert alert-danger mt-3'>Error uploading image.</div>";
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn:hover {
            background-color: #BB2D3B;
        }
    </style>
</head>

<body>
    <div class="container mt-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <h2 class="text-center mb-4">Check Whether You Are Eligible to Donate Blood</h2>

                <form method="post" enctype="multipart/form-data" class="p-5 border rounded shadow bg-light">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $_SESSION['username'] ?? ''; ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="tel" name="pno" class="form-control" required value="<?php echo $phonenumber; ?>">
                        <small class="text-danger"><?php echo $phone_error; ?></small>
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Upload Your Image</label>
                        <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" required>
                    </div>

                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" name="state" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select name="city" class="form-select" required>
                            <option value="">Select City</option>
                            <option value="Amritsar">Amritsar</option>
                            <option value="Barnala">Barnala</option>
                            <option value="Bathinda">Bathinda</option>
                            <option value="Faridkot">Faridkot</option>
                            <option value="Fatehgarh Sahib">Fatehgarh Sahib</option>
                            <option value="Fazilka">Fazilka</option>
                            <option value="Ferozepur">Ferozepur</option>
                            <option value="Gurdaspur">Gurdaspur</option>
                            <option value="Hoshiarpur">Hoshiarpur</option>
                            <option value="Jalandhar">Jalandhar</option>
                            <option value="Kapurthala">Kapurthala</option>
                            <option value="Ludhiana">Ludhiana</option>
                            <option value="Mansa">Mansa</option>
                            <option value="Moga">Moga</option>
                            <option value="Muktsar">Muktsar</option>
                            <option value="Nawanshahr">Nawanshahr</option>
                            <option value="Pathankot">Pathankot</option>
                            <option value="Patiala">Patiala</option>
                            <option value="Rupnagar">Rupnagar</option>
                            <option value="Sangrur">Sangrur</option>
                            <option value="Tarn Taran">Tarn Taran</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <select name="blood_group" class="form-select" required>
                            <option value="">Select Blood Group</option>
                            <option value="O-">O-</option>
                            <option value="O+">O+</option>
                            <option value="A-">A-</option>
                            <option value="A+">A+</option>
                            <option value="B-">B-</option>
                            <option value="B+">B+</option>
                            <option value="AB-">AB-</option>
                            <option value="AB+">AB+</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Do you have any disability or health problem?</label><br>
                        <input type="radio" name="health_issues" value="None" checked> None <br>
                        <input type="radio" name="health_issues" value="Diabetes"> Diabetes <br>
                        <input type="radio" name="health_issues" value="Hypertension"> Hypertension <br>
                        <input type="radio" name="health_issues" value="Heart Disease"> Heart Disease <br>
                    </div>

                    <button type="submit" class="btn w-100 bg-danger">Check Eligibility</button>
                    
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>