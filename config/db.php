<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "jhaji";

$conn = mysqli_connect("localhost", "root", "", "jhaji", 3307);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

?>
