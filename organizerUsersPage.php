<?php 
session_start();

$userType = $_SESSION['user_type'] ?? '';
$Name = !empty($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Admin';

require_once "dbconnection.php";

if ($conn -> connect_error) {
    ?>
    <script>
        console.log ("Connection failed");
    </script>
    <?php
} else {
    ?>
    <script>
        console.log ("Connection Successful"); 
    </script>
    <?php
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="adminBg" style="height: 100%;">

<div class="row min-vh-100 m-0">
    <div class="col-2 d-flex flex-column flex-shrink-0 p-4 text-white bg-dark min-vh-100" style="width: 15em ;">
        <img src="Resources\logo.png" alt="Logo" width="160" class="mx-auto d-block">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="organizerOverviewPage.php" class="nav-link text-color">
            Overview
            </a>
        </li>
        <li>
            <a href="organizerUsersPage.php" class="nav-link active">
            Users
            </a>
        </li>
        <li>
            <a href="organizerContestantsPage.php" class="nav-link text-color">
            Contestants
            </a>
        </li>
        <li>
            <a href="organizerCategoryPage.php" class="nav-link text-color">
            Categories
            </a>
        </li>
        <li>
            <a href="organizerScorePage.php" class="nav-link text-color">
            Score / Criteria
            </a>
        </li>
        </ul>
        <hr>
        <div class="dropdown d-flex align-items-center">
            <strong>Welcome <?php echo $Name ?></strong>
            <form action="logout.php" method="post">
                <button type="button "class="btn btn-danger mx-3">Signout</button>
            </form>
        </div>
    </div>
    
    <div class="col-10">

        <?php

        $selectQuery = "SELECT * FROM tbl_judge";

        $selectResult = $conn -> query($selectQuery);

        if ($selectResult -> num_rows > 0) {
            ?>
            <div class="container mt-5">
                <div class="row">

                    <div class="col-10">
                        <h2 class="text-center text-color">Judge List</h2>
                    </div>

                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Judge ID</th>
                                    <th>Full Name</th> 
                                    <th>Gender</th>
                                    <th>Date of Birth</th>
                                    <th>Email</th>
                                    <th>Contact Number</th>
                                    <th>Address</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($selectResult as $fieldname) {
                                    echo "<tr>";
                                    echo "<td>" . $fieldname['judge_id'] . "</td>";
                                    echo "<td>" . $fieldname['judge_prefix'] .". " . $fieldname['judge_name'] . "</td>";
                                    echo "<td>" . $fieldname['judge_gender'] . "</td>";
                                    echo "<td>" . $fieldname['judge_dob'] . "</td>";
                                    echo "<td>" . $fieldname['judge_email'] . "</td>";
                                    echo "<td>" . $fieldname['judge_phone'] . "</td>";
                                    echo "<td>" . $fieldname['judge_add'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Judge ID</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Security Question</th>
                                    <th>Security Answer</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($selectResult as $fieldname) {
                                    echo "<tr>";
                                    echo "<td>" . $fieldname['judge_id'] . "</td>";
                                    echo "<td>" . $fieldname['judge_username'] . "</td>";
                                    echo "<td>" . $fieldname['judge_pass'] . "</td>";
                                    echo "<td>" . $fieldname['judge_security'] . "</td>";
                                    echo "<td>" . $fieldname['judge_secpass'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Judge ID</th>
                                    <th>Image</th>
                                    <th>Role</th>
                                    <th>OTP</th>
                                    <th>Status</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($selectResult as $fieldname) {
                                    echo "<tr>";
                                    echo "<td>" . $fieldname['judge_id'] . "</td>";
                                    echo "<td> <img src='". $fieldname['judge_image_path']."' width=100 height=100> </td>";
                                    echo "<td>" . $fieldname['otp'] . "</td>";
                                    echo "<td>" . $fieldname['status'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                
            </div>
            <?php

        } else {
            ?>
                <div class="container d-flex justify-content-center align-items-center vh-100 flex-column">
                    <h2 class="text-center text-color">No Judges Found</h2>
                </div>

                
            <?php
            }
            ?>


        <?php


        $selectQuery = "SELECT * FROM tbl_admin";

        $selectResult = $conn -> query($selectQuery);

        if ($selectResult -> num_rows > 0) {
            ?>
            <div class="container mt-5">
                <div class="row">

                    <div class="col-10">
                        <h2 class="text-center text-color">Admin List</h2>
                    </div>

                </div>

                <div class="row">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Admin ID</th>
                                <th>Admin Name</th> 
                                <th>Admin Username</th>
                                <th>Admin Password</th>
                                <th>Role</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($selectResult as $fieldname) {
                                echo "<tr>";
                                echo "<td>" . $fieldname['admin_id'] . "</td>";
                                echo "<td>" . $fieldname['admin_name'] . "</td>";
                                echo "<td>" . $fieldname['admin_username'] . "</td>";
                                echo "<td>" . $fieldname['admin_pass'] . "</td>";
                                echo "<td>" . $fieldname['user_role'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
                
            </div>
            <?php

        } else {
            ?>
                <div class="container d-flex justify-content-center align-items-center vh-100 flex-column">
                    <h2 class="text-center text-color">No Admins Found</h2>
                </div>

                
            <?php
            }
            ?>


    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="validation.js"></script>
<script>
    function previewImg(event) {
        const preview = document.getElementById('preview_image');
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = "";
        }
    }

</script>


</body>
</html>

