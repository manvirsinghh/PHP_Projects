 <?php
    session_start();
    include("header.php");
    if (isset($_SESSION["username"])) {
        // echo "welcome " . $_SESSION['username'];
    } else {
        header("location:blood_donor_login.php");
        exit();
    }
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM donor_details WHERE username= '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    } else {
        echo "User details not found.";
        exit();
    }
    ?>



 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Donor Dashboard</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 </head>

 <body class="bg-light">

     <div class="container mt-5">
         <div class="row align-items-start">

             <div class="col-md-7">
                 <div class="card shadow-lg p-4">
                     <h2 class="text-danger text-center">Welcome, <?php echo $_SESSION['username']; ?>!</h2>
                     <hr>
                     <div class="row">
                         <div class="col-md-6">
                             <p class="fw-bold">Age: <?php echo $userData['age']; ?></p>
                             <p class="fw-bold">Email: <?php echo $userData['email']; ?></p>
                             <p class="fw-bold">Phone: <?php echo $userData['pno']; ?></p>
                         </div>
                         <div class="col-md-6">
                             <p class="fw-bold">Address: <?php echo $userData['address']; ?></p>
                             <p class="fw-bold">City: <?php echo $userData['city']; ?></p>
                             <p class="fw-bold">State: <?php echo $userData['state']; ?></p>
                         </div>
                     </div>
                     <p class="fw-bold">Blood Group: <span class="badge bg-danger"><?php echo $userData['blood_group']; ?></span></p>
                     <div class="d-flex justify-content-center align-items-center mt-3 gap-3">
                         <a href="edit.php?username=<?php echo $userData['username']; ?>" class="btn btn-warning w-auto">Edit</a>
                         <a href="delete.php?username=<?php echo $userData['username']; ?>" class="btn btn-danger w-auto">Delete</a>
                     </div>



                 </div>
             </div>


             <div class="col-md-5 text-center">
                 <img src="uploads/<?php echo $userData['image']; ?>" alt="Profile Image" class="img-fluid rounded-circle border border-0" width="250">
             </div>

         </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

 </body>

 </html>