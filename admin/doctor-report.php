<?php
session_start();
include('../config.php');

$from = $to = '';
$result = null;

if (isset($_POST['generate']) || isset($_POST['export_csv'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];

    $query = "
        SELECT d.*, s.specialization
        FROM doctors d
        JOIN doctors_specialization s ON d.specialization_id = s.id
        WHERE DATE(d.created_at) BETWEEN '$from' AND '$to'
    ";

    $result = mysqli_query($conn, $query);

    // Export to CSV
    if (isset($_POST['export_csv'])) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=doctor_report.csv');

        $output = fopen("php://output", "w");
        fputcsv($output, ['Name', 'Email', 'Contact', 'Specialization', 'Registered']);

        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, [
                $row['doctor_name'],
                $row['doctor_email'],
                $row['doctor_contact_number'],
                $row['specialization'],
                $row['created_at']
            ]);
        }

        fclose($output);
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Doctor Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Generate Doctor Report</h3>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-4">
                <label>From Date</label>
                <input type="date" name="from" class="form-control" value="<?= $from ?>" required>
            </div>
            <div class="col-md-4">
                <label>To Date</label>
                <input type="date" name="to" class="form-control" value="<?= $to ?>" required>
            </div>
            <div class="col-md-4 align-self-end">
                <button type="submit" name="generate" class="btn btn-primary w-100">Generate Report</button>
            </div>
        </form>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <form method="POST">
                <input type="hidden" name="from" value="<?= $from ?>">
                <input type="hidden" name="to" value="<?= $to ?>">
                <button type="submit" name="export_csv" class="btn btn-success mb-3">Export to CSV</button>
            </form>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Specialization</th>
                        <th>Registered On</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $specialization_count = [];
                    mysqli_data_seek($result, 0); // Reset result pointer
                    while ($row = mysqli_fetch_assoc($result)):
                        // Count for chart
                        $spec = $row['specialization'];
                        $specialization_count[$spec] = isset($specialization_count[$spec]) ? $specialization_count[$spec] + 1 : 1;
                    ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['doctor_name'] ?></td>
                            <td><?= $row['doctor_email'] ?></td>
                            <td><?= $row['doctor_contact_number'] ?></td>
                            <td><?= $row['specialization'] ?></td>
                            <td><?= $row['created_at'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <!-- Chart Section -->
            <div class="mb-4">
                <h4 class="text-center mb-3">Doctors by Specialization</h4>
                <div class="d-flex justify-content-center">
                    <canvas id="doctorChart" width="300" height="300"></canvas>
                </div>
            </div>

            <script>
                const ctx = document.getElementById('doctorChart').getContext('2d');
                const doctorChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?= json_encode(array_keys($specialization_count)) ?>,
                        datasets: [{
                            label: 'Doctors per Specialization',
                            data: <?= json_encode(array_values($specialization_count)) ?>,
                            backgroundColor: [
                                '#007bff', '#28a745', '#dc3545', '#ffc107', '#6610f2', '#6f42c1', '#20c997'
                            ],
                            borderColor: '#fff',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            </script>

        <?php elseif (isset($_POST['generate'])): ?>
            <div class="alert alert-warning">No doctor records found for the selected date range.</div>
        <?php endif; ?>
    </div>
</body>

</html>