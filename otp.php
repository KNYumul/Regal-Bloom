<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="style.css" rel="stylesheet">

    <style>
        body, html {
            height: 100%;
        }
    </style>
</head>
<body class="loginBg">
    <div class="container d-flex justify-content-center align-items-center min-vh-100 p-5">
        <form action="otp.php" method="post" class="form-container text-center shadow-sm border border-primary border-3 rounded p-4 mainBox">
            <div class="row">
                <div class="col d-flex justify-content-center">
                    <img src="Resources\logo.png" class="row logoImage">
                </div>
            </div>
            <h1 class="otp-title text-primary display-3 fw-bold TheSeason-Bold text-color">OTP</h1>
            <h2 class="otp-subtitle mb-4 text-primary display-3 fw-bold TheSeason text-color">Verification</h2>
            <p class="otp-info text-primary form-label TheSeason">One time password (OTP) was sent to your email</p>
            
            <div class="form-group mt-4 mb-3">
                <label for="otp" class="form-label TheSeason">Enter the OTP Number to verify</label>
                <input type="text" name="otp" id="otp" class="form-control text-center" maxlength="6" required>
            </div>

            <button type="submit" name="ver" class="btn submitBtn w-100 mt-3">Verify</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>

<?php 

require_once "dbconnection.php";

if (isset($_POST['ver'])){
    //User Input
    $userotp = $_POST['otp'];

    $otpsql = "Select * from tbl_judge where otp='".$userotp."'";
    $result = $conn -> query($otpsql);

    if ($result->num_rows ==1) {
        $updatesql = "UPDATE tbl_judge SET status = 'Active', otp = NULL where otp='".$userotp."'";
        $conn -> query($updatesql);

        ?> 
        <script>
            Swal.fire({
            position: "center",
            icon: "success",
            title: "Account is now Verified!",
            showConfirmButton: false,
            timer: 1500
            }).then(()=>{
                window.location.href = "LoginPage.php"
            })
        </script>
        <?php


    } else {
        ?> 
        <script>
            Swal.fire({
            position: "center",
            icon: "error",
            title: "Please recheck your OTP verification code.",
            showConfirmButton: false,
            timer: 1500
            });
        </script>
        <?php
    }
    
}

?>