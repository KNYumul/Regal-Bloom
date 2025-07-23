<?php
session_start(); // Move session_start to the top
require_once 'dbconnection.php';
require_once 'email-verify.php';

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
    $otp = rand(000000, 999999);
    $status = "Pending";

    $insertsql = "INSERT INTO tbl_judge (judge_name,judge_prefix,judge_gender,judge_dob,judge_phone,judge_email,judge_add,judge_username,judge_pass,judge_security,judge_secpass,judge_image_path,user_role,otp,status) 
    VALUES ('$fullname','$prefix','$gender','$dob','$contact','$email','$address','$username','$pass','$security','$secpass','$img','judge','$otp','$status')";

    $result = $conn->query($insertsql);

    if ($result == TRUE ) {
        // Get the ID of the newly inserted judge
        $new_judge_id = $conn->insert_id;
        
        // Log the registration action
        // Check if there's a logged-in user (admin/organizer registering someone)
        if (isset($_SESSION['log_id']) && !empty($_SESSION['log_id'])) {
            $log_user_id = $_SESSION['log_id'];
            $logssql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('".$log_user_id."','Registered New User',NOW())";
            $conn->query($logssql);
        } else {
            // Self-registration - use the new judge's ID
            $logssql = "INSERT INTO tbl_logs (user_id, action, datetime) VALUES ('".$new_judge_id."','Self Registration',NOW())";
            $conn->query($logssql);
        }

        send_verification($fullname, $email, $otp);

        echo '<script>
            alert("Registration Successful");
            window.location.href = "otp.php";
        </script>';
        exit;
    } else {
        echo '<script>
            alert("Registration Failed");
        </script>';
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center registrationBg">

<div class="registrationBox rounded p-4 my-5">

<div class="row">
    <div class="col d-flex justify-content-center">
        <img src="Resources\logo.png" class="row logoImage">
    </div>
</div>

<div class="row">
    <div class="col d-flex justify-content-center">
        <h1 class="Snell">Registration</h1>
    </div>
</div>

<div class="row d-flex align-items-center">
    <div class="col">
        <hr>
    </div>
    <div class="col-4 d-flex justify-content-center">
        <h3 class="t1">Personal Information</h3>
    </div>
    <div class="col">
        <hr>
    </div>
</div>

<form action="registerPage.php" method="post" enctype="multipart/form-data">

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