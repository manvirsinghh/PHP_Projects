<?php
include('../config.php');

// Handle deletion securely
if (isset($_GET['id']) && isset($_GET['del']) && $_GET['del'] == 'delete') {
    $id = intval($_GET['id']);
    $delete_query = "DELETE FROM users WHERE id = $id";
    mysqli_query($conn, $delete_query);
    header("Location: manage_users.php");
    exit();
}

// Fetch users
$select_query = "SELECT * FROM users";
$execute_query = mysqli_query($conn, $select_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Manage Users</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
        }
        .mainTitle {
           font-size: 25px;
            margin-bottom: 20px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .container-fullw {
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <section id="page-title">
        <div class="row">
            <div class="col-sm-8">
                <h1 class="mainTitle">Admin | Manage Users</h1>
            </div>
          
        </div>
    </section>

    <div class="container-fullw">
        <h5 class="mb-4">Manage <strong>Users</strong></h5>

        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Full Name</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Gender</th>
                    <th>Email</th>
          
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cnt = 1;
                while ($row = mysqli_fetch_assoc($execute_query)) {
                ?>
                <tr>
                    <td class="text-center"><?php echo $cnt; ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                 
                    <td class="text-center">
                        <a href="manage_users.php?id=<?php echo $row['id']; ?>&del=delete" 
                           onclick="return confirm('Are you sure you want to delete this user?')" 
                           class="btn btn-sm btn-danger" 
                           title="Delete User">
                            <i class="fa fa-trash-alt"></i> Delete
                        </a>
                    </td>
                </tr>
                <?php
                $cnt++;
                } 
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
