<?php
include 'header.php'; 


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $blood_group =  $_POST['blood_group'];
    $city =  $_POST['city'];

    $query = "SELECT * FROM donor_details WHERE blood_group = '$blood_group' AND city = '$city'";
    $result = $conn->query($query);
}
else{
    echo "error";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matching Blood Donors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 ">
        <div class="card shadow-lg">
            <div class="card-header text-center bg-success text-white">
                <h3>Available Blood Donors</h3>
            </div>
            <div class="card-body">
                <?php if (isset($result) && $result->num_rows > 0): ?>
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Blood Group</th>
                                <th>City</th>
                                <th>Contact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $row['username']; ?></td>
                                    <td><?php echo $row['blood_group']; ?></td>
                                    <td><?php echo $row['city']; ?></td>
                                    <td><?php echo $row['pno']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p class="text-center text-danger">No matching donors found in your city</p>
                <?php endif; ?>
            </div>
        </div>
        <a class="position-fixed bottom-0 end-0 translate-middle border border-0 rounded text-white p-2 text-decoration-none" href="emergency.php"style="background-color: #FF4444; box-shadow: 0 0 15px red; animation: pulse 1s infinite;">Emergency</a>
        
    </div>
</body>
</html>
