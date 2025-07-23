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

//insert judge to db
if(isset($_POST['sub'])) {
    $name = $_POST['name'];
    $desc = $_POST['desc'];

    $insertsql = "INSERT INTO tbl_category (category_name,category_desc) 
    VALUES ('$name','$desc')";

    $result = $conn->query($insertsql); 
    if ($result == TRUE ) {
        header("Location: adminCategoryPage.php");
        ?>
        <script>
            alert("Registration Successful");
        </script>
        <?php
        exit;
    } else {
        ?>
        <script>
            alert("Registration Failed");
        </script>
        <?php
    }
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
            <a href="adminOverviewPage.php" class="nav-link text-color">
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
            <a href="adminCategoryPage.php" class="nav-link active">
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

        <?php

        $selectQuery = "SELECT * FROM tbl_category";

        $selectResult = $conn -> query($selectQuery);

        if ($selectResult -> num_rows > 0) {
            ?>
            <div class="container mt-5">
                <div class="row">

                    <div class="col-10">
                        <h2 class="text-center text-color">Category List</h2>
                    </div>
                    <div class="col align-self-center text-end">
                        <button type="button" class="btn mb-3 Btn-custom" data-bs-toggle="modal" data-bs-target=".addCategoryModal">Add Category</button> 
                    </div>

                </div>

                <div class="row">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Category ID</th>
                                <th>Category Name</th> 
                                <th>Category Description</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($selectResult as $fieldname) {
                                echo "<tr>";
                                echo "<td>" . $fieldname['category_id'] . "</td>";
                                echo "<td>" . $fieldname['category_name'] . "</td>";
                                echo "<td>" . $fieldname['category_desc'] . "</td>";
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
                    <h2 class="text-center text-color">No Categories Found</h2>
                    <button type="button" class="btn Btn-custom mt-5" data-bs-toggle="modal" data-bs-target=".addCategoryModal">Add Category</button> 
                </div>

                
            <?php
            }
            ?>

        <!-- Modal for adding -->
        <div class="modal fade addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-3" style="background-color: #FFF6EA;">

                    <h1 class="text-center mb-3">Add Admin</h1>

                    <form action="adminCategoryPage.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="name-label" for="name">Category Name:</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Please Enter Category Name" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="desc-label" for="desc">Category Description:</label>
                                <input type="text" id="desc" name="desc" class="form-control" placeholder="Please Enter Description" required>
                            </div>
                        </div>
                        
                        
                        <div class="row">
                            <div class="col mt-3">   
                                <input type="submit"  name="sub" class="btn submitBtn btn-block w-100" value="Save Details" id="sub">
                            </div>

                            <div class="col mt-3">   
                                <input type="button"  name="cancel" class="btn submitBtn btn-block w-100" value="Cancel" id="cancel">
                            </div>
                        </div>

                    </form>
                
                </div>
            </div>
        </div>


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

