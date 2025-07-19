<?php
include('header.php');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
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
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
         <h3 class="mt-5">Our Key Features</h3>
         <p>Take a look at some of our key features</p>
        </div>
        
    </div>
    <div class="row">
      <div class="container my-5">

  <div class="row row-cols-1 row-cols-md-3 g-4">

    <!-- Cardiology -->
    <div class="col">
      <div class="card text-center shadow p-4">
        <i class="fas fa-heart-pulse fa-3x text-danger mb-3"></i>
        <h5 class="card-title fw-bold">Cardiology</h5>
        <p class="card-text">Expert heart care with advanced diagnostics and treatment.</p>
      </div>
    </div>

    <!-- Orthopedic -->
    <div class="col">
      <div class="card text-center shadow p-4">
        <i class="fas fa-bone fa-3x text-primary mb-3"></i>
        <h5 class="card-title fw-bold">Orthopedic</h5>
        <p class="card-text">Comprehensive bone and joint care by leading specialists.</p>
      </div>
    </div>

    <!-- Neurology -->
    <div class="col">
      <div class="card text-center shadow p-4">
        <i class="fas fa-brain fa-3x text-warning mb-3"></i>
        <h5 class="card-title fw-bold">Neurology</h5>
        <p class="card-text">Advanced brain and nervous system treatments and care.</p>
      </div>
    </div>

    <!-- Pharma Pipeline -->
    <div class="col">
      <div class="card text-center shadow p-4">
        <i class="fas fa-vials fa-3x text-info mb-3"></i>
        <h5 class="card-title fw-bold">Pharma Pipeline</h5>
        <p class="card-text">Innovative drug development for future healthcare solutions.</p>
      </div>
    </div>

    <!-- Pharma Team -->
    <div class="col">
      <div class="card text-center shadow p-4">
        <i class="fas fa-user-doctor fa-3x text-success mb-3"></i>
        <h5 class="card-title fw-bold">Pharma Team</h5>
        <p class="card-text">Highly skilled doctors and pharmacists working together.</p>
      </div>
    </div>

    <!-- High Quality Treatments -->
  <div class="col">
      <div class="card text-center shadow p-4">
      <i class="fa fa-thumbs-up text-danger fa-3x"></i>

        <h5 class="card-title fw-bold">Quality Treatment</h5>
        <p class="card-text">Compassionate and top-quality medical care for all.</p>
      </div>
    </div>

  </div>
</div>

    </div>
</div>
<div class="contact-form">
    <h3 class="text-dark">Contact Form</h3>
    <form action="contact_submit.php" method="post">
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