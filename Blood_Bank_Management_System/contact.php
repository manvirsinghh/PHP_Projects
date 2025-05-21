<?php


include("header.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['msg'];

    $sql="INSERT INTO contact(name,email,message) VALUES('$name','$email','$message')";
    if($conn->query($sql)===TRUE){
        // echo "data entered successfully";
    }
    else{
        echo "something went wrong";
    }

}
// else{
//     echo "form not submitted successfully";
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<div class="container ">
<h2 class="text-center fw-bold mt-5 d-md-block d-none">Contact Us</h2>
   
    <div class="row mt-4">
    <div class="col-12 d-md-none">
            <h2 class="text-center fw-bold mt-3 mb-5">Contact Us</h2> <!-- Visible only on small screens -->
        </div>
        <div class="col-md-6 left d-flex align-items-center mt-5  ">
            <div class="text-md-start text-center mx-auto mx-md-0">
                 
                <h4 class="fw-bold mt-4">Get in Touch</h4>
                <p><img src="img/telephone.png" alt=""> (555) 123-4567</p>
                <p><img src="img/communication (4).png" alt=""> contact@bloodbank.com</p>
                <p><img src="img/location.png" alt=""> 123 Blood Bank Street, City, State 12345</p>
            </div>
        </div>

        
        <div class="col-md-6 d-flex justify-content-md-end mt-5">
            <div class="sec p-4 rounded shadow w-100" style="max-width: 500px;">
                <h4 class="mb-3 fw-bold">Send us a Message</h4>
                <form method="post">
                    <label for="name" class="fw-bold">Name</label>
                    <input type="text" class="form-control mb-3 input-field " name="name">

                    <label for="email" class="fw-bold">Email</label>
                    <input type="email" class="form-control mb-3 input-field" name="email">

                    <label for="message" class="fw-bold">Message</label>
                    <textarea class="form-control mb-3 input-field" name="msg" rows="4"></textarea>

                    <input type="submit" class="btn-custom w-100" value="Send Message">
                </form>
            </div>
        </div>
    </div>
</div>



</body>
</html>

<?php
 include("footer.php");
?>
