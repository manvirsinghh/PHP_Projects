<?php
session_start();
include('../config.php');

$from = $to = $date_type = '';
$result = null;
$labels = $data = [];

if (isset($_POST['generate']) || isset($_POST['export_csv'])) {
    $from = $_POST['from'];
    $to = $_POST['to'];
    $date_type = $_POST['date_type'];

    $query = "SELECT * FROM tblpatient WHERE DATE($date_type) BETWEEN '$from' AND '$to'";
    $result = mysqli_query($conn, $query);

    // Prepare data for chart
    $graphQuery = "SELECT DATE($date_type) as report_date, COUNT(*) as total 
                   FROM tblpatient 
                   WHERE DATE($date_type) BETWEEN '$from' AND '$to' 
                   GROUP BY DATE($date_type)";
    $graphResult = mysqli_query($conn, $graphQuery);
    while ($row = mysqli_fetch_assoc($graphResult)) {
        $labels[] = $row['report_date'];
        $data[] = $row['total'];
    }

    // Export CSV
    if (isset($_POST['export_csv'])) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=patient_report.csv');
        $output = fopen("php://output", "w");
        fputcsv($output, ['Name', 'Email', 'Contact', 'Gender', 'Age', 'Registered', 'Updated']);
        while ($row = mysqli_fetch_assoc($result)) {
            fputcsv($output, [
                $row['PatientName'],
                $row['PatientEmail'],
                $row['PatientContno'],
                $row['PatientGender'],
                $row['PatientAge'],
                $row['CreationDate'],
                $row['UpdationDate']
            ]);
        }
        fclose($output);
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Patient Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Generate Patient Report</h3>

        <form method="POST" class="row g-3 mb-4">
            <div class="col-md-3">
                <label>From Date</label>
                <input type="date" name="from" class="form-control" value="<?= $from ?>" required>
            </div>
            <div class="col-md-3">
                <label>To Date</label>
                <input type="date" name="to" class="form-control" value="<?= $to ?>" required>
            </div>
            <div class="col-md-3">
                <label>Filter By</label>
                <select name="date_type" class="form-control">
                    <option value="CreationDate" <?= $date_type == 'CreationDate' ? 'selected' : '' ?>>Registration Date</option>
                    <option value="UpdationDate" <?= $date_type == 'UpdationDate' ? 'selected' : '' ?>>Last Update Date</option>
                </select>
            </div>
            <div class="col-md-3 align-self-end">
                <button type="submit" name="generate" class="btn btn-primary w-100">Generate Report</button>
            </div>
        </form>

        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <form method="POST">
                <input type="hidden" name="from" value="<?= $from ?>">
                <input type="hidden" name="to" value="<?= $to ?>">
                <input type="hidden" name="date_type" value="<?= $date_type ?>">
                <button type="submit" name="export_csv" class="btn btn-success mb-3">Export to CSV</button>
            </form>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Registered</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    mysqli_data_seek($result, 0);
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row['PatientName'] ?></td>
                            <td><?= $row['PatientEmail'] ?></td>
                            <td><?= $row['PatientContno'] ?></td>
                            <td><?= $row['PatientGender'] ?></td>
                            <td><?= $row['PatientAge'] ?></td>
                            <td><?= $row['CreationDate'] ?></td>
                            <td><?= $row['UpdationDate'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <h5 class="mt-5">Graphical Report (<?= $date_type ?>)</h5>
            <canvas id="reportChart" height="100"></canvas>
        <?php elseif (isset($_POST['generate'])): ?>
            <div class="alert alert-warning">No records found for selected range.</div>
        <?php endif; ?>
    </div>

    <?php if (!empty($labels)): ?>
        <script>
            const ctx = document.getElementById('reportChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= json_encode($labels) ?>,
                    datasets: [{
                        label: 'Number of Patients',
                        data: <?= json_encode($data) ?>,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)',
                            'rgba(255, 159, 64, 0.6)'
                        ],
                        borderColor: [
                            'rgb(243, 70, 107)',
                            'rgb(25, 153, 238)',
                            'rgb(231, 176, 37)',
                            'rgb(35, 235, 235)',
                            'rgb(95, 37, 209)',
                            'rgb(235, 123, 12)'
                        ],

                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    <?php endif; ?>
</body>

</html>