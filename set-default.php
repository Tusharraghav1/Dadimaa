<?php
session_start();
include 'config/db.php';

if(!isset($_GET['id'])){
    die("Invalid Address");
}

$user_id = $_SESSION['user_id'];
$address_id = $_GET['id'];

mysqli_query($conn,
"UPDATE user_addresses
 SET is_default = 0
 WHERE user_id='$user_id'");

mysqli_query($conn,
"UPDATE user_addresses
 SET is_default = 1
 WHERE id='$address_id'
 AND user_id='$user_id'");

header("Location: address.php");
exit();
?>