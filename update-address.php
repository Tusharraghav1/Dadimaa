<?php
session_start();
include 'config/db.php';

$id = $_POST['id'];

$full_name = $_POST['full_name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$pincode = $_POST['pincode'];

mysqli_query($conn,"
UPDATE user_addresses SET
full_name='$full_name',
mobile='$mobile',
address='$address',
city='$city',
state='$state',
pincode='$pincode'
WHERE id='$id'
");

header("Location: address.php");
exit();
?>