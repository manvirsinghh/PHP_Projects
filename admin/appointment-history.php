<?php
session_start();
include('../config.php');

// Fixed: JOIN appointments.patient_id with tblpatient.Docid
$query = mysqli_query($conn, "
    SELECT 
        a.id AS appointment_id,
        p.PatientName,
        p.PatientContno,
        d.doctor_name,
        s.specialization AS Specialization,
        a.appointment_date,
        a.appointment_time,
        a.consultancy_fee,
        a.status,
        a.created_at
    FROM 
        appointments a
    LEFT JOIN 
        tblpatient p ON a.doctor_id = p.Docid
    LEFT JOIN 
        doctors d ON a.doctor_id = d.id
    LEFT JOIN 
        doctors_specialization s ON d.specialization_id = s.id
    ORDER BY 
        a.appointment_date DESC, a.appointment_time DESC
");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Appointment History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="mb-4">All Appointments</h3>
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Patient Name</th>
                    <th>Contact</th>
                    <th>Doctor</th>
                    <th>Specialization</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Fee</th>
                    <th>Status</th>
                    <th>Created On</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $cnt = 1;
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_assoc($query)) { ?>
                        <tr>
                            <td><?= $cnt++; ?></td>
                            <td><?= htmlspecialchars($row['PatientName']); ?></td>
                            <td><?= htmlspecialchars($row['PatientContno']); ?></td>
                            <td><?= htmlspecialchars($row['doctor_name']); ?></td>
                            <td><?= htmlspecialchars($row['Specialization']); ?></td>
                            <td><?= htmlspecialchars($row['appointment_date']); ?></td>
                            <td><?= htmlspecialchars($row['appointment_time']); ?></td>
                            <td>₹<?= htmlspecialchars($row['consultancy_fee']); ?></td>
                            <td>
                                <?php
                                $status = $row['status'];
                                if ($status == 'Approved') {
                                    echo '<span class="badge bg-success">Approved</span>';
                                } elseif ($status == 'Pending') {
                                    echo '<span class="badge bg-warning text-dark">Pending</span>';
                                } elseif ($status == 'Cancelled' || $status == 'Canceled by you') {
                                    echo '<span class="badge bg-danger">Cancelled</span>';
                                } else {
                                    echo '<span class="badge bg-secondary">Unknown</span>';
                                }
                                ?>
                            </td>
                            <td><?= htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                <?php } 
                } else {
                    echo "<tr><td colspan='10' class='text-center'>No appointments found.</td></tr>";
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
