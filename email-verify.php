<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

function send_verification($fullname, $email, $otp){

    $mail = new PHPMailer(true);                              // Passing true enables exceptions
    try {

       
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'mong082805@gmail.com';                 // SMTP username
        $mail->Password = 'cvkg dtva skne ocwe';                           // SMTP password
        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, ssl also accepted
        $mail->Port = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom('mong082805@gmail.com','Regal Bloom');
        $mail->addAddress($email);     // Add a recipient
        //Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = "OTP Verification";
        $mail->Body    = 
        '<h3 style="color: #00018c; margin-bottom: 20px;">Verify your Regal Bloom sign-up</h3>
        <p>We have received a sign-up attempt with the following code. Please enter it in the browser window where you started signing up for <strong> Regal Bloom</strong>.</p>
        <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; font-size: 36px; color: #00018c; font-weight: bold; margin: 30px 0;">
        '.$otp.'
        </div>
        <p style="margin-top: 10px; font-size: 14px; color: #6c757d;">
        If you did not attempt to sign up but received this email, please disregard it. The code will remain active for 10 minutes.<br>
        — Regal Bloom </p>';

        $mail->send();
        ?>
            <script>
                alert("Email Successfully Send!!")
            </script>
        <?php
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }



}


?>