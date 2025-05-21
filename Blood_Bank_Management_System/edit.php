<?php
include("header.php");

if (isset($_GET['username'])) {
    $username = $_GET['username'];

    $sql = "SELECT * FROM donor_details WHERE username='$username'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phonenumber = $_POST['pno'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $blood_group = $_POST['blood_group'];
    $health_issues = $_POST['health_issues'];
    $image = $_FILES['image']['name'];

    // $sql = "UPDATE donor_details SET age='$age', email='$email', pno='$phonenumber', address='$address', state='$state', city='$city' ,blood_group='$blood_group', health_issues='$health_issues', image='$image' WHERE username='$username'";
    if($image){

        $target="uploads/". basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    
     $sql = "UPDATE donor_details SET age='$age', email='$email', pno='$phonenumber', address='$address', state='$state', city='$city' ,blood_group='$blood_group', health_issues='$health_issues', image='$image' WHERE username='$username'";
    }
    else{
        $sql = "UPDATE donor_details SET age='$age', email='$email', pno='$phonenumber', address='$address', state='$state', city='$city' ,blood_group='$blood_group', health_issues='$health_issues'  WHERE username='$username'";
        
    }

    if ($conn->query($sql) === TRUE) {
        header("location:blood_donor_dashboard.php");

        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="wusernameth=device-wusernameth, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <div class="container mt-5 py-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-sm-12">
                <h2 class="text-center mb-4">Check Whether You Are Eligible to Donate Blood</h2>

                <form method="post" enctype="multipart/form-data" class="p-5 border rounded shadow bg-light">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $row['username']; ?>" required disabled>
                    </div>

                    <div class="mb-3">
                        <label for="age" class="form-label">Age</label>
                        <input type="number" name="age" class="form-control" value="<?php echo $row['age']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $row['email']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Phone Number</label>
                        <input type="tel" name="pno" class="form-control" value="<?php echo $row['pno']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" required><?php echo $row['address']; ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Upload Your Image</label>
                        <input type="file" name="image" accept="image/png, image/jpeg, image/jpg">
                        <br>
                        
                    </div>

                    <!-- State (Text Input) -->
                    <div class="mb-3">
                        <label for="state" class="form-label">State</label>
                        <input type="text" name="state" class="form-control" value="<?php echo $row['state']; ?>" required>
                    </div>

                    <!-- City (Text Input) -->
                    <div class="mb-3">
    <label for="city" class="form-label">City</label>
    <select name="city" class="form-select" required>
        <option value="">Select City</option>
        <?php 
        $cities = [
            "Amritsar", "Barnala", "Bathinda", "Farusernamekot", "Fatehgarh Sahib", "Fazilka", "Ferozepur", 
            "Gurdaspur", "Hoshiarpur", "Jalandhar", "Kapurthala", "Ludhiana", "Malerkotla", "Mansa", 
            "Moga", "Muktsar", "Nawanshahr", "Pathankot", "Patiala", "Rupnagar", "Sangrur", "Tarn Taran"
        ];
        foreach ($cities as $city) {
            $selected = ($row['city'] == $city) ? "selected" : "";
            echo "<option value='$city' $selected>$city</option>";
        }
        ?>
    </select>
</div>


                    <div class="mb-3">
                        <label for="blood_group" class="form-label">Blood Group</label>
                        <select name="blood_group" class="form-select" required>
                            <option value="">Select Blood Group</option>
                            <option value="O-" <?php if ($row['blood_group'] == "O-") echo "selected"; ?>>O-</option>
                            <option value="O+" <?php if ($row['blood_group'] == "O+") echo "selected"; ?>>O+</option>
                            <option value="A-" <?php if ($row['blood_group'] == "A-") echo "selected"; ?>>A-</option>
                            <option value="A+" <?php if ($row['blood_group'] == "A+") echo "selected"; ?>>A+</option>
                            <option value="B-" <?php if ($row['blood_group'] == "B-") echo "selected"; ?>>B-</option>
                            <option value="B+" <?php if ($row['blood_group'] == "B+") echo "selected"; ?>>B+</option>
                            <option value="AB-" <?php if ($row['blood_group'] == "AB-") echo "selected"; ?>>AB-</option>
                            <option value="AB+" <?php if ($row['blood_group'] == "AB+") echo "selected"; ?>>AB+</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Do you have any disability or health problem?</label><br>
                        <input type="radio" name="health_issues" value="None" <?php if ($row['health_issues'] == "None") echo "checked"; ?>> None <br>
                        <input type="radio" name="health_issues" value="Diabetes" <?php if ($row['health_issues'] == "Diabetes") echo "checked"; ?>> Diabetes <br>
                        <input type="radio" name="health_issues" value="Hypertension" <?php if ($row['health_issues'] == "Hypertension") echo "checked"; ?>> Hypertension <br>
                        <input type="radio" name="health_issues" value="Heart Disease" <?php if ($row['health_issues'] == "Heart Disease") echo "checked"; ?>> Heart Disease <br>
                    </div>

                    <button type="submit" class="btn w-100 bg-danger">Check Eligibility</button>
                </form>
</body>

</html>