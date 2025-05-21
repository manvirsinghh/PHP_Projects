<?php

include("header.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
 

</head>

<body>

  <div class="container-fluid ">
    <div class="row justify-content-center align-items-center " style="background: linear-gradient(to right, #FFE5E5, #FFF9F9); min-height:70vh;">
      <div class=" col-md-12 content1 text-center text-dark  display-4 fw-bold mt-5 ">
        Every Drop Counts
      </div>
      <div class=" col-md-12 content2 text-center fs-5">
        Your blood donation can save up to three lives. Join our mission to<br> make a difference in your community.
      </div>
      <div class="col-md-12 d-flex justify-content-center align-items-center">
    <a class="btn text-white fw-bold fs-4 d-flex align-items-center justify-content-center"
       href="emergency_details_fetch.php"
       style="background-color: #FF4444; height: 70px; text-transform: uppercase; box-shadow: 0 0 15px red; animation: pulse 1s infinite; margin-top: -30px;">
        Emergency! Urgently Needed Blood
    </a>
</div>

    </div>
    <div class="container">
    <div class="row gap-3 mt-5 mx-2 justify-content-md-center ">
      <div class="col-md-4 card mb-3 text-center " style="width: 20rem;">

        <div class="card-body">
          <h5 class="img"><img src="img/emptyl.png" alt=""></h5>
          <h4 class="card-text fw-bold">150,000+</h4>
          <p class="text-secondary">Lives Saved</p>
        </div>
      </div>
      <div class=" col-md-4 card mb-3 text-center" style="width: 20rem;">
        <div class="card-body">
          <h5 class="img"><img src="img/users.png" alt=""></h5>
          <h4 class="card-text fw-bold">50,000+</h4>
          <p class="text-secondary">Active Donors</p>

        </div>
      </div>

      <div class=" col-md-4 card mb-3 text-center" style="width: 20rem;">
        <div class="card-body ">
          <h5 class="img"><img src="img/loc.png" alt=""></h5>
          <h4 class="card-text fw-bold">100+</h4>
          <p class="text-secondary">Donation Centers</p>
        </div>
      </div>
    </div>

    </div>
    
    <div class="row mt-4 gap-5 mx-auto  ">
      <h3 class="text-center fw-bold mt-4">How Blood Donation Works</h3>
      <p class="text-center text-secondary">Donating blood is a simple process that takes about an hour from start to finish. Here's<br> what you can expect.</p>

      <div class="container">
    <div class="row justify-content-center">

    <div class="col-md-8 first-line d-flex justify-content-center mb-4" >
            <div class="card border border-0 rounded-2  p-3  shadow-sm bg-white ">
                <div class="card-body">
                    <div class="icon d-flex">
                        <img src="img/emptydrop.png" alt="">
                        <h5 class="fw-bold mt-2 ms-2">Registration</h5>
                    </div>
                    <p class="ms-5 ">Fill out a registration form and provide valid identification. Our staff will review your basic information and medical history.</p>
                </div>
            </div>
        </div>
        <div class="col-md-8 first-line d-flex justify-content-center mb-4">
            <div class="card border border-0 rounded-2  p-3  shadow-sm bg-white">
                <div class="card-body">
                    <div class="icon d-flex">
                        <img src="img/emptydrop.png" alt="">
                        <h5 class="fw-bold mt-2 ms-2">Health Screening</h5>
                    </div>
                    <p class="ms-5">We'll check your temperature, blood pressure, pulse, and hemoglobin levels to ensure you're eligible to donate.</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 first-line d-flex justify-content-center mb-4">
            <div class="card border border-0 rounded-2  p-3 shadow bg-white">
                <div class="card-body">
                    <div class="icon d-flex">
                        <img src="img/emptydrop.png" alt="">
                        <h5 class="fw-bold mt-2 ms-2">The Donation</h5>
                    </div>
                    <p class="ms-5">The actual blood donation takes about 8-10 minutes. You'll be comfortably seated while a pint of blood is drawn.</p>
                </div>
            </div>
        </div>

        <div class="col-md-8 first-line d-flex justify-content-center mb-4">
            <div class="card border border-0 rounded-2  p-3 shadow bg-white">
                <div class="card-body">
                    <div class="icon d-flex">
                        <img src="img/emptydrop.png" alt="">
                        <h5 class="fw-bold mt-2 ms-2">Recovery</h5>
                    </div>
                    <p class="ms-5">After donating, you'll rest and enjoy refreshments for 15 minutes before leaving. Stay hydrated and avoid strenuous activities for the rest of the day.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-light ">
<h2 class="fs-2 fw-bold text-center mt-5">Eligibility Requirements</h2>
<div class="row">
 <div class=" col-md-6 list1   d-flex justify-content-center ">
 <ul class="list-unstyled mt-4">
  <h4 class="text-success "><i class="bi bi-check text-success fs-2 "></i>You Can Donate If</h4>
    <li class="text-secondary"><i class="bi bi-check text-success text-opacity-50 fs-3"></i> You are at least 17 years old</li>
    <li class="text-secondary"><i class="bi bi-check text-success text-opacity-50 fs-3"></i> You weigh at least 110 pounds</li>
    <li class="text-secondary"><i class="bi bi-check text-success text-opacity-50 fs-3"></i> You are in good general health</li>
    <li class="text-secondary"><i class="bi bi-check text-success text-opacity-50 fs-3"></i>You have not donated blood in the last 56 days</li>
    <li class="text-secondary"><i class="bi bi-check  text-success text-opacity-50 fs-3"></i>You have a valid ID</li>
</ul>

 </div>
 <div class=" col-md-6 list1">
 <ul class="list-unstyled mt-4">
  <h4 class="text-danger"><i class="bi bi-x text-danger fs-2 "></i>You Cannot Donate If</h4>
    <li class="text-secondary"><i class="bi bi-x text-danger text-opacity-50 fs-3"></i> You have a cold, flu, or other illness</li>
    <li class="text-secondary"><i class="bi bi-x text-danger text-opacity-50 fs-3"></i> You have low iron levels</li>
    <li class="text-secondary"><i class="bi bi-x text-danger text-opacity-50 fs-3"></i> You've had recent surgery</li>
    <li class="text-secondary"><i class="bi bi-x text-danger text-opacity-50 fs-3"></i>You're taking certain medications</li>
    <li class="text-secondary"><i class="bi bi-x text-danger text-opacity-50 fs-3"></i>You have certain medical conditions</li>
</ul>

 </div>
</div>

</div>

      

    </div>

   
</body>

</html>
<?php

include("footer.php");
?>