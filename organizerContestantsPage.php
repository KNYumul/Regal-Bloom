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
            <a href="organizerUsersPage.php" class="nav-link text-color">
            Users
            </a>
        </li>
        <li>
            <a href="organizerContestantsPage.php" class="nav-link active">
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

        $selectQuery = "SELECT * FROM tbl_contestant";

        $selectResult = $conn -> query($selectQuery);

        if ($selectResult -> num_rows > 0) {
            ?>

            <div class="container mt-5">
                <div class="row">

                    <div class="col-10">
                        <h2 class="text-center text-color">Contestant List</h2>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Contestant ID</th>
                                <th>Full Name</th>
                                <th>Contestant Number</th>
                                <th>Age</th>
                                <th>Date of Birth</th>
                                <th>Email</th>
                                <th>Town Represented</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($selectResult as $fieldname) {
                                echo "<tr>";
                                echo "<td>" . $fieldname['contestant_id'] . "</td>";
                                echo "<td>" . $fieldname['contestant_name'] ."</td>";
                                echo "<td>" . $fieldname['contestant_number'] . "</td>";
                                echo "<td>" . $fieldname['contestant_age'] . "</td>";
                                echo "<td>" . $fieldname['contestant_dob'] . "</td>";
                                echo "<td>" . $fieldname['contestant_email'] . "</td>";
                                echo "<td>" . $fieldname['contestant_town'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Contestant ID</th>
                                <th>Full Body Picture</th>
                                <th>Headshot Picture</th>
                                <th>Category</th>
                                <th>Short Biography</th>
                                <th>Advocacy</th>
                                <th>Talent</th>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($selectResult as $fieldname) {
                                echo "<tr>";
                                echo "<td>" . $fieldname['contestant_id'] . "</td>";
                                echo "<td> <img src='". $fieldname['contestant_fullbody']."' width=100 height=100> </td>";
                                echo "<td> <img src='". $fieldname['contestant_headshot']."' width=100 height=100> </td>";
                                echo "<td>" . $fieldname['category'] . "</td>";
                                echo "<td>" . $fieldname['shortbio'] . "</td>";
                                echo "<td>" . $fieldname['advocacy'] . "</td>";
                                echo "<td>" . $fieldname['talent'] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="row">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Contestant ID</th>
                                <th>Question Given</th>
                                <th>Answer</th>
                                <th>Emergency Contact Name</th>
                                <th>Emergency Contact</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($selectResult as $fieldname) {
                                echo "<tr>";
                                echo "<td>" . $fieldname['contestant_id'] . "</td>";
                                echo "<td>" . $fieldname['question'] . "</td>";
                                echo "<td>" . $fieldname['answer'] . "</td>";
                                echo "<td>" . $fieldname['emergency_contact_name'] . "</td>";
                                echo "<td>" . $fieldname['emergency_contact_number'] . "</td>";
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
                    <h2 class="text-center text-color">No Contestants Found</h2>
                </div> 
                
            <?php
            }
            ?>
        
    </div>

</div>

    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="validation.js"></script>
<script>
    function previewImg(event, imgId) {
        const preview = document.getElementById(imgId);
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


