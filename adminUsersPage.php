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
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $prefix = $_POST['prefix'];
    $gender = $_POST['gender'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $year = $_POST['year'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $pass = md5($_POST['pass']);
    // $confpass = $_POST['confpass'];
    $security = $_POST['security'];
    $secpass = md5($_POST['secpass']);

    $img = "Images/".basename($_FILES['upload_img']['name']);
    move_uploaded_file($_FILES['upload_img']['tmp_name'], $img);

    $fullname = $fname . " " . $mname . " " . $lname;
    $dob = $month . " " . $day . " " . $year;

    $insertsql = "INSERT INTO tbl_judge (judge_name,judge_prefix,judge_gender,judge_dob,judge_phone,judge_email,judge_add,judge_username,judge_pass,judge_security,judge_secpass,judge_image_path,user_role) 
    VALUES ('$fullname','$prefix','$gender','$dob','$contact','$email','$address','$username','$pass','$security','$secpass','$img','judge')";

    $result = $conn->query($insertsql); 
    if ($result == TRUE ) {
        header("Location: adminUsersPage.php");
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


// insert admin to db
if (isset($_POST['subAdmin'])) {
    $adminName = $_POST['adminName'];
    $adminUsername = $_POST['adminUsername'];
    $adminPass = md5($_POST['adminPass']);
    $adminRole = $_POST['adminRole']; 

    $insertAdminSql = "INSERT INTO tbl_admin (admin_name, admin_username, admin_pass, user_role) 
    VALUES ('$adminName', '$adminUsername', '$adminPass', '$adminRole')";

    // Check if the admin username already exists
    $checkAdminSql = "SELECT * FROM tbl_admin WHERE admin_username = '$adminUsername'";
    $checkResult = $conn->query($checkAdminSql);
    

    $result = $conn->query($insertAdminSql);
    if ($result == TRUE) {
        header("Location: adminUsersPage.php");
        ?>
        <script>
            alert("Admin Registration Successful");
        </script>
        <?php
        exit;
    } else {
        ?>
        <script>
            alert("Admin Registration Failed");
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
            <a href="adminUsersPage.php" class="nav-link active">
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
                    <div class="col align-self-center text-end">
                        <button type="button" class="btn mb-3 Btn-custom" data-bs-toggle="modal" data-bs-target=".addUserModal">Add User</button> 
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
                    <button type="button" class="btn Btn-custom mt-5" data-bs-toggle="modal" data-bs-target=".addUserModal">Add Judge</button> 
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
                    <div class="col align-self-center text-end">
                        <button type="button" class="btn Btn-custom mb-3" data-bs-toggle="modal" data-bs-target=".addAdminModal">Add Admin</button> 
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
                    <button type="button" class="btn Btn-custom mt-5" data-bs-toggle="modal" data-bs-target=".addAdminModal">Add Admin</button> 
                </div>

                
            <?php
            }
            ?>

        <!-- Modal for adding Judges -->
        <div class="modal fade addUserModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-3" style="background-color: #FFF6EA;">

                    <h1 class="text-center mb-3">Add Judge</h1>

                    <form action="adminUsersPage.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">First Name</label>
                                <input type="text" id="fname" name="fname" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">Middle Name</label>
                                <input type="text" id="mname" name="mname" class="form-control" placeholder="Middle Name">
                            </div>
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">Last Name</label>
                                <input type="text" id="lname" name="lname" class="form-control" placeholder="Last Name">
                            </div>
                        </div>

                        <label for="prefix">Prefix:</label>
                        <select id="prefix" name="prefix" class="form-select mb-2">
                            <option value="Mr">Mr.</option>
                            <option value="Ms">Ms.</option>
                            <option value="Mrs">Mrs.</option>
                            <option value="Dr">Mx.</option>
                            <option value="Dr">Mxs.</option>
                        </select>

                        <label for="gender">Gender:</label>
                        <select id="gender" name="gender" class="form-select mb-4">
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="others">Others</option>
                        </select>

                        <div class="row">
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">Date of Birth:</label>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="month-label" for="month">Month:</label>
                                <select id="month" name="month" class="form-select">
                                    <option value="null">Select Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            <div class="col">
                                <label class="form-label" id="day-label" for="day">Day:</label>
                                <input type="text" id="day" name="day" class="form-control" placeholder="Day">
                            </div>
                            <div class="col">
                                <label class="form-label" id="year-label" for="year">Year:</label>
                                <input type="text" id="year" name="year" class="form-control" placeholder="Year">
                            </div>
                        </div>

                        <div class="row mt-3 align-items-center">
                            <div class="col">
                                <img src="" alt="" id="preview_image" width="200" height="200" class="img-thumbnail mx-auto d-block">
                            </div>
                        </div>
                        <div class="row mb-5 mt-2">
                            <div class="col">
                                <input type="file" name="upload_img" id="upload_img" class="form-control w-25 mx-auto d-block" onchange= "previewImg(event)">
                            </div>
                        </div>

                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <h3 class="t1">Contact Information</h3>
                            </div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="contact-label" for="contact">Contact Number:</label>
                                <input type="text" id="contact" name="contact" class="form-control" placeholder="Contact Number">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="email-label" for="email">Email Address:</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="address-label" for="address">Mailing Address:</label>
                                <input type="text" id="address" name="address" class="form-control" placeholder="Mailing Address">
                            </div>
                        </div>

                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <h3 class="t1">User Information</h3>
                            </div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="pass-label" for="pass">Password:</label>
                                <input type="password" id="pass" name="pass" class="form-control" placeholder="Password">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="confpass-label" for="confpass">Confirm Password:</label>
                                <input type="password" id="confpass" name="confpass" class="form-control" placeholder="Confirm Password">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="security-label" for="security">Security Question:</label>
                                <select id="security" name="security" class="form-select">
                                    <option value="null">Select Question</option>
                                    <option value="pet">What is your pet's name?</option>
                                    <option value="school">What is the name of your first school?</option>
                                    <option value="mother">What is your mother's maiden name?</option>
                                    <option value="color">What is your favorite color?</option> 
                                </select>
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="secpass-label" for="secpass">Answer:</label>
                                <input type="password" id="secpass" name="secpass" class="form-control" placeholder="Security Answer"> 
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
        

        <!-- Modal for adding Admin -->
        <div class="modal fade addAdminModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-3" style="background-color: #FFF6EA;">

                    <h1 class="text-center mb-3">Add Admin</h1>

                    <form action="adminUsersPage.php" method="post" enctype="multipart/form-data">
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="adminName-label" for="adminName">Admin Name:</label>
                                <input type="text" id="adminName" name="adminName" class="form-control" placeholder="Please Enter Admin Name">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="adminUsername-label" for="adminUsername">Username:</label>
                                <input type="text" id="adminUsername" name="adminUsername" class="form-control" placeholder="Please Enter Username">
                            </div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="adminPass-label" for="adminPass">Password:</label>
                                <input type="password" id="adminPass" name="adminPass" class="form-control" placeholder="Please Enter Password"> 
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="form-label" id="adminRole" for="adminRole">Role:</label>
                                <select id="adminRole" name="adminRole" class="form-select">
                                    <option value="null">Select Role</option>
                                    <option value="admin">ADMIN</option>
                                    <option value="organizer">ORGANIZER</option>

                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col mt-3">   
                                <input type="submit"  name="subAdmin" class="btn submitBtn btn-block w-100" value="Save Details" id="subAdmin">
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

