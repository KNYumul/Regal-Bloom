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

if(isset($_POST['sub'])) {
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $month = $_POST['month'];
    $day = $_POST['day'];
    $year = $_POST['year'];
    $town = $_POST['town'];
    $email = $_POST['email'];
    
    $fullimg = "Images/".basename($_FILES['fullbody_upload_img']['name']);
    move_uploaded_file($_FILES['fullbody_upload_img']['tmp_name'], $fullimg);

    $headimg = "Images/".basename($_FILES['headshot_upload_img']['name']);
    move_uploaded_file($_FILES['headshot_upload_img']['tmp_name'], $headimg);

    $category = $_POST['category'];
    $desc = $_POST['desc'];
    $advocacy = $_POST['advo'];
    $talent = $_POST['talent'];
    $ques = $_POST['ques'];
    $ans = $_POST['ans'];

    $contestantNumber = rand(1, 50);

    $efname = $_POST['efname'];
    $emname = $_POST['emname'];
    $elname = $_POST['elname'];
    $econtact = $_POST['econtact'];

    $fullname = $fname . " " . $mname . " " . $lname;
    $efullname = $efname . " " . $emname . " " . $elname;
    $dob = $month . " " . $day . " " . $year;

    $fullname = $conn->real_escape_string($fullname);
    $contestantNumber = $conn->real_escape_string($contestantNumber);
    $dob = $conn->real_escape_string($dob);
    $email = $conn->real_escape_string($email);
    $town = $conn->real_escape_string($town);
    $fullimg = $conn->real_escape_string($fullimg);
    $headimg = $conn->real_escape_string($headimg);
    $category = $conn->real_escape_string($category);
    $desc = $conn->real_escape_string($desc);
    $advocacy = $conn->real_escape_string($advocacy);
    $talent = $conn->real_escape_string($talent);
    $ques = $conn->real_escape_string($ques);
    $ans = $conn->real_escape_string($ans);
    $efullname = $conn->real_escape_string($efullname);
    $econtact = $conn->real_escape_string($econtact);

    $insertsql = "INSERT INTO tbl_contestant (contestant_name,contestant_number,contestant_dob,contestant_email,contestant_town,contestant_fullbody,contestant_headshot,category,shortbio,advocacy,talent,question,answer,emergency_contact_name,emergency_contact_number) 
    VALUES ('$fullname','$contestantNumber','$dob','$email','$town','$fullimg','$headimg','$category','$desc','$advocacy','$talent','$ques','$ans','$efullname','$econtact')";

    $result = $conn->query($insertsql); 
    if ($result == TRUE ) {
        header("Location: adminContestantsPage.php");
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
            <a href="adminContestantsPage.php" class="nav-link active">
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

        $selectQuery = "SELECT * FROM tbl_contestant";

        $selectResult = $conn -> query($selectQuery);

        if ($selectResult -> num_rows > 0) {
            ?>

            <div class="container mt-5">
                <div class="row">

                    <div class="col-10">
                        <h2 class="text-center text-color">Contestant List</h2>
                    </div>
                    <div class="col align-self-center text-end">
                        <button type="button" class="btn mb-3 Btn-custom" data-bs-toggle="modal" data-bs-target=".addContestantModal">Add Contestant</button> 
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
                    <button type="button" class="btn Btn-custom mt-5" data-bs-toggle="modal" data-bs-target=".addContestantModal">Add Contestant</button> 
                </div> 
                
            <?php
            }
            ?>
        
    </div>

</div>

<!-- Modal -->
         <div class="modal fade addContestantModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-3" style="background-color: #FFF6EA;">

                    <h1 class="text-center mb-3">Add Contestant</h1>

                    <form action="adminContestantsPage.Php" method="post" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="col">
                                <label class="form-label" id="town-label" for="town">Town/City Represented:</label>
                                <input type="text" id="town" name="town" class="form-control" placeholder="Please Enter the Town/City you Represent">
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col">
                                <label class="form-label" id="email-label" for="email">Email Address:</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email Address">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col text-center">
                                <h6>Fullbody Image</h6>
                                <div class="row mt-3 align-items-center">
                                    <div class="col">
                                        <img src="" alt="" id="preview_fullbody" width="200" height="200" class="img-thumbnail mx-auto d-block">
                                    </div>
                                </div>
                                <div class="row mb-5 mt-2">
                                    <div class="col">
                                        <input type="file" name="fullbody_upload_img" id="fullbody_upload_img" class="form-control w-50 mx-auto d-block" onchange="previewImg(event, 'preview_fullbody')">
                                    </div>
                                </div>
                            </div>

                            <div class="col text-center">
                                <h6>Headshot Image</h6>
                                <div class="row mt-3 align-items-center">
                                    <div class="col">
                                        <img src="" alt="" id="preview_headshot" width="200" height="200" class="img-thumbnail mx-auto d-block">
                                    </div>
                                </div>
                                <div class="row mb-5 mt-2">
                                    <div class="col">
                                        <input type="file" name="headshot_upload_img" id="headshot_upload_img" class="form-control w-50 mx-auto d-block" onchange="previewImg(event, 'preview_headshot')">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="category">Category:</label>
                                <select id="category" name="category" class="form-select mb-2">
                                    <option value="Miss">Miss</option>
                                    <option value="Mister" disabled>Mister</option>
                                    <option value="Teen" disabled>Teen</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="form-label" id="desc-label" for="desc">Short Biography:</label>
                                <input type="text" id="desc" name="desc" class="form-control" placeholder="Please Enter a Short Biography">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="form-label" id="advo-label" for="advo">Advocacy:</label>
                                <input type="text" id="advo" name="advo" class="form-control" placeholder="Please Enter Advocacy">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="form-label" id="talent-label" for="talent">Talent Performed:</label>
                                <input type="text" id="talent" name="talent" class="form-control" placeholder="Please Enter Talent">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="ques-label" for="ques">Question Given:</label>
                                <select id="ques" name="ques" class="form-select">
                                    <option value="null">Select a Question</option>
                                    <option value="1">What does representation mean to you?</option>
                                    <option value="2">How do you stay grounded despite fame and recognition?</option>
                                    <option value="3">If you could solve one global issue instantly, what would it be and why?</option>
                                    <option value="4">When something bad is happing in you life, what fives you power to keep going?</option>
                                    <option value="5">What is the role of beauty in today's world?</option>

                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label class="form-label" id="ans-label" for="ans">Answer Given:</label>
                                <input type="text" id="ans" name="ans" class="form-control" placeholder="Please Enter the Answer">
                            </div>
                        </div>


                        <div class="row d-flex align-items-center">
                            <div class="col">
                                <hr>
                            </div>
                            <div class="col-4 d-flex justify-content-center">
                                <h3 class="t1">Emergency Contact</h3>
                            </div>
                            <div class="col">
                                <hr>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">First Name</label>
                                <input type="text" id="efname" name="efname" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">Middle Name</label>
                                <input type="text" id="emname" name="emname" class="form-control" placeholder="Middle Name">
                            </div>
                            <div class="col">
                                <label class="form-label" id="username-label" for="username">Last Name</label>
                                <input type="text" id="elname" name="elname" class="form-control" placeholder="Last Name">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col">
                                <label class="form-label" id="contact-label" for="contact">Contact Number:</label>
                                <input type="text" id="econtact" name="econtact" class="form-control" placeholder="Contact Number">
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


