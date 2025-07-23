<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
</head>
<body class="d-flex justify-content-center align-items-center loginBg">

<div class="mainBox rounded p-4 my-5">

<div class="row">
    <div class="col d-flex justify-content-center">
        <img src="Resources\logo.png" class="row logoImage">
    </div>
</div>

<div class="row">
    <div class="col d-flex justify-content-center">
        <h1 class="Snell">Login</h1>
    </div>
</div>

<div class="row">
    <div class="col">

        <form action="LoginPage.php" method="post">

            <div class="row mb-2">
                <div class="col">
                    <label class="form-label" id="username-label" for="username">Username or Email</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username or Email">
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <label class="form-label" id="password-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Please Enter Password">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col d-flex justify-content-end">
                    <a href="forgotPassword.php">Forgot Password?</a>
                </div>
            </div>

            <div class="row mb-4 ">
                <div class="col d-flex justify-content-center">
                    <input type="submit" name="sub" id="sub" value="Login" class="btn submitBtn btn-block w-50">
                </div>
            </div>

            <div class="row d-flex align-items-center">
                <div class="col">
                    <hr>
                </div>
                <div class="col-1 d-flex justify-content-center">
                    <h3>OR</h3>
                </div>
                <div class="col">
                    <hr>
                </div>
            </div>

            <button type="button" class="btn googleBtn w-100 mb-2"> <img src="Resources\googleLogo.png" class="googleImage"> </button>

            <div class="row">
                <div class="col d-flex justify-content-center">
                    <h5 class="registerText">Don't have an account? <a href="registerPage.php">Register</a> </h5>
                </div>


        </form>

    </div>
</div>






</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>

<?php
session_start();
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

if (isset($_POST['sub'])){

    //userinput
    $username = $_POST['username']; 
    $password = md5($_POST['password']); //decryption

    $_SESSION['username'] = $username;

    $loginQuery = "
        SELECT admin_id AS user_id, admin_username AS username, admin_pass AS password, admin_name AS fullname, user_role, NULL AS judge_image_path
        FROM tbl_admin
        WHERE admin_username = '$username' AND admin_pass = '$password'
        UNION
        SELECT judge_id AS user_id, judge_username AS username, judge_pass AS password, judge_name AS fullname, 'judge' AS user_role, judge_image_path
        FROM tbl_judge
        WHERE judge_username = '$username' AND judge_pass = '$password'
    ";
    $result = $conn->query($loginQuery);

    if ($result -> num_rows == 1) {

        $fielddata = $result->fetch_assoc();

        $user_type = $fielddata['user_role'];
        $fullname = $fielddata['fullname'];
        $image = $fielddata['judge_image_path'];
        $id = $fielddata['user_id']; // Now this will work

        $_SESSION['user_type'] = $user_type;
        $_SESSION['fullname'] = $fullname;
        $_SESSION['log_id'] = $id;

        if ($user_type == 'judge') {
            // Get judge_id and judge_name from tbl_judge
            $judgeQuery = "SELECT judge_id, judge_name FROM tbl_judge WHERE judge_username = '$username'";
            $judgeResult = $conn->query($judgeQuery);
            if ($judgeResult && $judgeResult->num_rows == 1) {
                $judgeData = $judgeResult->fetch_assoc();
                $_SESSION['judge_id'] = $judgeData['judge_id'];
                $_SESSION['judge_name'] = $judgeData['judge_name'];
            }
            $_SESSION['judge_image_path'] = $image;
        }

        // Insert log entry
        $logsql = "INSERT INTO tbl_logs (user_id,action,datetime) VALUES ('".$id."','Logged In',NOW())";
        $conn -> query($logsql);

        // Redirect based on user type
        if ($user_type == 'admin') {
            header("Location: adminOverviewPage.php");
            exit();
        } elseif ($user_type == 'organizer') {
            header("Location: organizerOverviewPage.php");
            exit();
        } elseif ($user_type == 'judge') {
            header("Location: userHomePage.php");
            exit();
        }

    } else {
        // User not found, show error message
        echo "<script> alert('Invalid username or password. Please try again.'); </script>";
    }
}
?>