<?php
include("header2.php");
include("validation.php");

$phone_error = "";
$phone = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $address = $_POST['address'];
    $maplink = $_POST['mapLink'];
    $phone = $_POST['phone'];

    $phone_error = validatePhoneNumber($phone);

    if (empty($phone_error)) {
        $sql = "INSERT INTO emergency (address, mapLink, phone) VALUES ('$address', '$maplink', '$phone')";
        if (mysqli_query($conn, $sql)) {
          // echo "record added successfully";
           header("Location: " . $_SERVER['PHP_SELF']); 
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light ">
    <div class="container mt-5">
        <div class="card shadow-lg">
        <div class="card-header bg-danger text-white text-center py-3 shadow-sm">
    <h3 class="mb-0 fw-bold"> Submit Your Details</h3>
</div>

            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <div class="mb-3">
                        <label for="mapLink" class="form-label">Google Maps Link</label>
                        <input type="url" class="form-control" id="mapLink" name="mapLink" required oninput="updateMap()">
                    </div>

                    <div class="mb-3 text-center">
                        <iframe id="mapFrame" width="100%" height="300" style="border: 0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required value="<?= htmlspecialchars($phone); ?>">
                        <small class="text-danger"><?= $phone_error; ?></small>
                    </div>

                    <button type="submit" class="btn btn-danger w-100">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function updateMap() {
            let mapLink = document.getElementById("mapLink").value;
            let extractedCoords = extractCoordinates(mapLink);

            if (extractedCoords) {
                document.getElementById("mapFrame").src = `https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d2000!2d${extractedCoords.lng}!3d${extractedCoords.lat}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v${Date.now()}`;
            }
        }

        function extractCoordinates(url) {
            let match = url.match(/@([-.\d]+),([-.\d]+)/);
            return match ? { lat: match[1], lng: match[2] } : null;
        }
    </script>
</body>
</html>
