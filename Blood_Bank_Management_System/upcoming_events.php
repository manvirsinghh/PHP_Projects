<?php
include("header.php");
$sql = "SELECT * FROM events ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Bank</title>
 
</head>
<body class="bg-light">

<div class="container mt-5 bg-light">
    <div class="row justify-content-between align-items-center">
        <div class="col-md-6">
            <h2 class="text-danger">Blood Donation Camps</h2>
        </div>
       
    </div>

    <div class="mt-4">
        <?php 
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) { ?>
                <div class="card p-4 mb-4 shadow-sm">
                    <div class="row align-items-center">
                       <img src="" alt="">
                        <div class="col-md-6 text-center">
                            <img src="uploads/<?php echo $row['image']; ?>" alt="Event Image" class="img-fluid rounded" style="width: 75%; height: 300px;">
                        </div>

                        <div class="col-md-6">
                            <h4 class="text-danger"><?php echo $row['blood_camp_name']; ?></h4>
                            <p><strong>Location:</strong> <?php echo $row['location']; ?></p>
                            <p><strong>Date:</strong> <?php echo $row['calendar']; ?></p>
                            <p><strong>Time:</strong> <?php echo $row['starttime']; ?> - <?php echo $row['endtime']; ?></p>

                            <div class="d-flex gap-2">
                                <a href="register_for_camp.php?event_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Register for camp</a>
                               
                            </div>
                        </div>
                    </div>
                </div>
        <?php 
            }
        } else {
            echo "<p class='text-muted text-center'>No blood donation camps found.</p>";
        }
        ?>
    </div>
</div>


</body>
</html>

<?php
include("footer.php");
?>
