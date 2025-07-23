<?php 
session_start();

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
    <div class="col-2 d-flex flex-column flex-shrink-0 p-4 text-white bg-dark min-vh-100" style="width: 15em ;">
        <img src="Resources\logo.png" alt="Logo" width="160" class="mx-auto d-block">
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="adminOverviewPage.php" class="nav-link active">
            Overview
            </a>
        </li>
        <li>
            <a href="adminUsersPage.php" class="nav-link text-color">
            Users
            </a>
        </li>
        <li>
            <a href="adminContestantsPage.php" class="nav-link text-color">
            Contestants
            </a>
        </li>
        <li>
            <a href="adminCategoryPage.php" class="nav-link text-color">
            Categories
            </a>
        </li>
        <li>
            <a href="adminScorePage.php" class="nav-link text-color">
            Score / Criteria
            </a>
        </li>
        <li>
            <a href="adminLogsPage.php" class="nav-link text-color">
            Logs
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
           
        
    </div>

</div>










   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>