<?php

require 'config/mail.php';

$otp = rand(100000, 999999);

// Yahan apna email likho jahan test mail receive karna hai
$result = sendOTP("tusharraghav817@gmail.com", $otp);

if ($result === true) {
    echo "Mail Sent Successfully!";
} else {
    echo "Mail Error: " . $result;
}