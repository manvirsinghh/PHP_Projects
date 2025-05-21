<?php 

include("header.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donor Registration</title>
    <link rel="stylesheet" href="style4.css">
    
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <h3 class="text-center fw-bold mb-4">Blood Donor Login </h3>
            <?php

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //get the form data
    
    $username=$_POST['username'];
    $password=$_POST['password'];

    //Check if email and username  are correct 
    $sql="SELECT * FROM blood_donor_registration WHERE username='$username' AND password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        // echo "login successfully";

        $_SESSION["username"]=$username;
        header("location:detail_dashboard.php");
    }
    else {
        echo '<div class="d-flex justify-content-center">
        <div class="alert alert-danger text-center fw-bold p-2 mb-3 " role="alert" style="width:40%;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> Invalid Credentials
        </div>
      </div>';
    }
    

}
  

?>
            <div class="col-md-6 col-lg-5 blooddonorlogin p-4 rounded shadow">
                <form method="post">
                    
                    
                    <div class="mb-3">
                        <label for="username" class="fw-bold"> Create Username</label>
                        <input type="text" name="username" class="form-control input-field" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="fw-bold"> Create Password</label>
                        <input type="password" name="password" class="form-control input-field" required>
                    </div>

                    <button type="submit" class="btn btn-custom w-100 text-white">Submit</button>

                    <h6 class="text-center mt-3">New User? <a href="blood_donor_register.php" class="text-danger">Register as Blood Donor</a></h6>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
 


 

