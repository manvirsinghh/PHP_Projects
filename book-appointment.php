<?php
session_start();
if (!isset($_SESSION['user_email'])) {
    header('Location: user-login.php');
    exit;
}

include 'config.php'; // DB connection
require_once __DIR__ . '/vendor/autoload.php'; // mPDF
use Mpdf\Mpdf;

// Fetch specializations
$specializations = mysqli_query($conn, "SELECT * FROM doctors_specialization");

// Initialize
$selected_spec = $_POST['specialization'] ?? '';
$selected_doc = $_POST['doctor'] ?? '';
$fee = '';
$date = $_POST['date'] ?? '';
$time = $_POST['time'] ?? '';
$message = '';
$doctors = [];

// Fetch doctors
if (!empty($selected_spec)) {
    $esc_spec = mysqli_real_escape_string($conn, $selected_spec);
    $doctor_result = mysqli_query($conn, "SELECT * FROM doctors WHERE specialization_id = '$esc_spec'");
    while ($doc = mysqli_fetch_assoc($doctor_result)) {
        $doctors[] = $doc;
    }
}

// Fetch fee
if (!empty($selected_doc)) {
    $esc_doc = mysqli_real_escape_string($conn, $selected_doc);
    $fee_result = mysqli_query($conn, "SELECT doctor_consultancy_fee FROM doctors WHERE id = '$esc_doc'");
    if ($row = mysqli_fetch_assoc($fee_result)) {
        $fee = $row['doctor_consultancy_fee'];
    }
}

// Final submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['final_submit'])) {
    if ($selected_spec && $selected_doc && $date && $time) {
        $dateObj = DateTime::createFromFormat('Y-m-d', $date);
        $timeObj = DateTime::createFromFormat('H:i', $time);

        if (!$dateObj || !$timeObj) {
            $message = "Invalid date or time format.";
        } else {
            $patient_id = $_SESSION['user_id'];
            $doctor_id = mysqli_real_escape_string($conn, $selected_doc);
            $appointment_date = $dateObj->format('Y-m-d');
            $appointment_time = $timeObj->format('H:i:s');
            $consultancy_fee = mysqli_real_escape_string($conn, $fee);
            $status = 'Pending';

            $dup_check = mysqli_query($conn, "SELECT * FROM appointments 
                WHERE patient_id='$patient_id' 
                AND doctor_id='$doctor_id' 
                AND appointment_date='$appointment_date' 
                AND appointment_time='$appointment_time'");

            if (mysqli_num_rows($dup_check) > 0) {
                echo "<script>alert('You already have an appointment with this doctor at this time.');</script>";
            } else {
                $insert = mysqli_query($conn, "INSERT INTO appointments 
                    (patient_id, doctor_id, appointment_date, appointment_time, consultancy_fee, status)
                    VALUES ('$patient_id', '$doctor_id', '$appointment_date', '$appointment_time', '$consultancy_fee', '$status')");

                if ($insert) {
                    $appointment_id = mysqli_insert_id($conn);
                    $patient_name = $_SESSION['user_name'];
                    $doctor_row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT doctor_name FROM doctors WHERE id='$doctor_id'"));
                    $doctor_name = $doctor_row['doctor_name'];

                    // mPDF with temp directory
                    $mpdf = new Mpdf([
                        'tempDir' => __DIR__ . '/tmp'
                    ]);

                    $html = '
                        <div style="text-align:center;">
                            <h2 style="margin-bottom: 0;">Hospital Management System</h2>
                            <small>Appointment Confirmation Slip</small>
                        </div>
                        <hr>
                        <p><strong>Appointment ID:</strong> ' . $appointment_id . '</p>
                        <p><strong>Patient Name:</strong> ' . htmlspecialchars($patient_name) . '</p>
                        <p><strong>Doctor:</strong> ' . htmlspecialchars($doctor_name) . '</p>
                        <p><strong>Date:</strong> ' . $appointment_date . '</p>
                        <p><strong>Time:</strong> ' . $appointment_time . '</p>
                        <p><strong>Consultancy Fee:</strong> ₹' . $consultancy_fee . '</p>
                        <p><strong>Status:</strong> Confirmed</p>
                        <hr>
                        <p style="text-align:center;">Please arrive 15 minutes before your appointment time.</p>
                    ';

                    $mpdf->WriteHTML($html);
                    $filename = 'Appointment_Slip_' . $appointment_id . '.pdf';
                    $mpdf->Output($filename, \Mpdf\Output\Destination::DOWNLOAD);
                    exit;
                } else {
                    $message = "Error booking appointment: " . mysqli_error($conn);
                }
            }
        }
    } else {
        $message = "Please fill all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment | HMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .sidebar {
            position: fixed;
            top: 56px;
            left: 0;
            width: 220px;
            height: 100%;
           background-color: white;
            color: black;
            padding-top: 20px;
            z-index: 1000;
        }
        .sidebar a {
            display: block;
            color: black;
            padding: 12px 20px;
            text-decoration: none;
        }
       
        .sidebar .menu-title {
            padding: 0 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .topbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 56px;
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 0 20px;
            z-index: 1050;
        }
        .main-content {
            margin-left: 240px;
            padding-top: 70px;
        }
    </style>
</head>
<body>
    <!-- Top Bar -->
    <div class="topbar d-flex justify-content-between align-items-center">
        <div class="title ms-auto me-2">Hospital Management System</div>
        <div class="dropdown user-info me-3">
            <a class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-user-circle fa-lg me-2"></i>
                <span><?php echo $_SESSION['user_name']; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="user-profile.php">My Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a href="change_password.php" class="dropdown-item">Change password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="menu-title">Main Navigation</div>
        <a href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="book-appointment.php"><i class="fas fa-calendar-plus me-2"></i> Book Appointment</a>
        <a href="appointment-history.php"><i class="fas fa-history me-2"></i> Appointment History</a>
        <a href="manage-medhistory.php"><i class="fas fa-notes-medical me-2"></i> Medical History</a>
    </div>

    <!-- Main Content -->
    <div class="main-content container mt-3">
        <h3 class="mb-4">Book an Appointment</h3>

        <?php if (!empty($message)): ?>
            <div class="alert alert-danger"><?= $message ?></div>
        <?php endif; ?>

        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label">Specialization</label>
                <select name="specialization" class="form-select" onchange="this.form.submit()" required>
                    <option value="" disabled <?= empty($selected_spec) ? 'selected' : '' ?>>Select Specialization</option>
                    <?php mysqli_data_seek($specializations, 0); while ($spec = mysqli_fetch_assoc($specializations)) { ?>
                        <option value="<?= $spec['id'] ?>" <?= $selected_spec == $spec['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($spec['specialization']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Doctor</label>
                <select name="doctor" class="form-select" onchange="this.form.submit()" required>
                    <option value="" disabled <?= empty($selected_doc) ? 'selected' : '' ?>>Select Doctor</option>
                    <?php foreach ($doctors as $doc) { ?>
                        <option value="<?= $doc['id'] ?>" <?= $selected_doc == $doc['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($doc['doctor_name']) ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Consultancy Fee</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($fee) ?>" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Appointment Date</label>
                <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($date) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Appointment Time</label>
                <input type="time" name="time" class="form-control" value="<?= htmlspecialchars($time) ?>" required>
            </div>

            <button type="submit" name="final_submit" class="btn btn-primary">Confirm & Download Slip</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
