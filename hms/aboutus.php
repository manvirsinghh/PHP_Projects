<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Our Hospital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .about-section {
            padding: 30px 20px;
            background-color: #f8f9fa;
        }



        .about-title {
            font-weight: 600;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="container-fluid about-section">
        <div class="row align-items-center">
            <!-- Image section -->
            <div class="col-md-6">
                <img src="images/hospital.jpeg" class="img-fluid rounded shadow w-100 h-75" alt="Hospital">
            </div>

            <!-- Text section -->
            <div class="col-md-6 about-text">
                <h4 class="about-title">About Our Hospital</h4>
                <p>
                    Welcome to <strong>Healing Touch Hospital</strong>, where care meets excellence. Established with the vision of providing accessible, affordable, and quality healthcare to all, our hospital is a modern medical facility equipped with the latest technology and staffed by a team of highly qualified doctors, nurses, and healthcare professionals.
                </p>
                <p>
                    We specialize in a wide range of medical services including general medicine, surgery, pediatrics, gynecology, orthopedics, and emergency care. Our commitment to patient safety, hygiene, and personalized care has made us a trusted name in healthcare.Your health is our priority. Experience the future of healthcare — simple, smart, and safe
                    At Healing Touch, we believe in a patient-first approach, combining medical expertise with compassion. Whether it’s a regular health check-up or a critical procedure, our team ensures you receive the best care at every step.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php include 'footer.php';?>