<?php 
session_start();

require_once 'dbconnection.php';

$userType = $_SESSION['user_type'] ?? '';
$Name = !empty($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Admin';

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
    <div class="col-2 d-flex flex-column flex-shrink-0 p-4 text-white bg-dark min-vh-100" style="width: 15em ; height: 100%;">
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
            <a href="organizerScorePage.php" class="nav-link active">
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

        $selectQuery = "SELECT * FROM tbl_votes";

        $selectResult = $conn -> query($selectQuery);

        if ($selectResult -> num_rows > 0) {
            ?>
            <div class="container mt-5">
                <div class="row">

                    <div class="col-10">
                        <h2 class="text-center text-color">Score List</h2>
                    </div>

                </div>

                <div class="row">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Voter ID</th>
                                <th>Voter Name</th> 
                                <th>Overall Personality & Presence</th>
                                <th>Fashion Segment</th>
                                <th>Talent Segment</th>
                                <th>Q & A</th>
                                <th>Advocacy / Platform</th>
                                <th>Photogenic Qualities</th>   
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($selectResult as $fieldname) {
                                echo "<tr>";
                                echo "<td>" . $fieldname['voter_id'] . "</td>";
                                echo "<td>" . $fieldname['voter_name'] . "</td>";
                                echo "<td>" . $fieldname['overall'] . "</td>";
                                echo "<td>" . $fieldname['fashion'] . "</td>";
                                echo "<td>" . $fieldname['talent'] . "</td>";
                                echo "<td>" . $fieldname['QA'] . "</td>";
                                echo "<td>" . $fieldname['advocacy'] . "</td>";
                                echo "<td>" . $fieldname['photogenic'] . "</td>";
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
                

                
            <?php
            }
            ?>

    </div>


</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>