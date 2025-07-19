<?php include 'header.php';

include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];
    $insert_query = "INSERT INTO contact_us(name,email_address,mobile_no,message)VALUES('$name','$email','$mobile','$message')";
    $execute_query = mysqli_query($conn, $insert_query);
    if ($execute_query) {
        echo "<script>alert('Query Submitted successfully');
         window.location.href = './admin/unread_queries.php';
         </script>";
    } else {
        echo "something went wrong";
    }
}

?>
<link rel="stylesheet" href="style.css">

<div class="contact-form">
    <h3 class="text-dark">Contact Form</h3>
    <form action="" method="post">
        <div class="mb-3">
            <label for="name" class="form-label">Enter Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter email address" required>
        </div>
        <div class="mb-3">
            <label for="mobile" class="form-label">Enter Mobile No.</label>
            <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile number" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Enter Message</label>
            <textarea id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
        </div>
        <div class="d-grid">
            <button type="submit" class="btn  btn-block text-white" style="background-color: #00AB9F;">Send Message</button>
        </div>
    </form>

</div>
<?php
include 'footer.php';
?>