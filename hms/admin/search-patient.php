<?php
session_start();
include('../config.php');

$search = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $search = mysqli_real_escape_string($conn, $_POST['search']);

    $query = "
        SELECT * FROM tblpatient 
        WHERE PatientName LIKE '%$search%' 
           OR PatientEmail LIKE '%$search%' 
           OR PatientContno LIKE '%$search%'
    ";

    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Patient Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h3 class="text-center mb-4">Search Patient</h3>

        <form method="post" class="d-flex justify-content-center mb-4">
            <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" class="form-control w-50 me-2" placeholder="Search by name, email or contact" required>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if ($result !== null): ?>
            <h5>Results for "<strong><?= htmlspecialchars($search) ?></strong>":</h5>
            <?php if (mysqli_num_rows($result) > 0): ?>
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Registered On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?= $count++ ?></td>
                                <td><?= htmlspecialchars($row['PatientName']) ?></td>
                                <td><?= htmlspecialchars($row['PatientEmail']) ?></td>
                                <td><?= htmlspecialchars($row['PatientContno']) ?></td>
                                <td><?= htmlspecialchars($row['PatientGender']) ?></td>
                                <td><?= htmlspecialchars($row['PatientAge']) ?></td>
                                <td><?= htmlspecialchars($row['CreationDate']) ?></td>
                                <td>
                                    <a href="view-patient-admin.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>

                    </tbody>
                </table>
            <?php else: ?>
                <div class="alert alert-warning">No patients found.</div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>

</html>