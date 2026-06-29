<?php

session_start();
include 'config/db.php';

$user_id = $_SESSION['user_id'];

$full_name = $_POST['full_name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];

$sql = "INSERT INTO user_addresses
(
user_id,
full_name,
mobile,
address,
city,
state,
pincode
)
VALUES
(
'$user_id',
'$full_name',
'$mobile',
'$address',
'$city',
'$state',
'$pincode'
)";

mysqli_query($conn,$sql);

header("Location: address.php");
exit();
?>