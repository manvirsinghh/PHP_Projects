<?php
include 'header2.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Blood Donor</title>
    
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-danger text-white">
                        <h3>Find a Blood Donor</h3>
                    </div>
                    <div class="card-body">
                        <form action="seeker_results.php" method="POST">
                            <div class="mb-3">
                                <label for="name" class="form-label"> User Name</label>
                                <input type="text" name="username" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="blood_group" class="form-label">Select Blood Group</label>
                                <select name="blood_group" class="form-select" required>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">Enter City</label>
                                <input type="text" name="city" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="contact" class="form-label">Your phone no</label>
                                <input type="text" name="pno" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-danger w-100">Find Donors</button>
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</body>
</html>
