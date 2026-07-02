<?php

session_start();

include "../config/db.php";
include "../config/mail.php";

// Signup OTP
if (isset($_SESSION['verify_email'])) {

    $email = $_SESSION['verify_email'];
    $redirect = "verify_signup_otp.php";

}
// Login OTP
elseif (isset($_SESSION['login_email'])) {

    $email = $_SESSION['login_email'];
    $redirect = "verify_login_otp.php";

}
// No Session
else {

    header("Location: login.php");
    exit();

}

$otp = rand(100000,999999);

$expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

mysqli_query($conn,"
UPDATE users
SET
otp='$otp',
otp_expiry='$expiry'
WHERE email='$email'
");

if(sendOTP($email,$otp) === true){

    header("Location: $redirect");
    exit();

}else{

    die("Failed to send OTP.");

}