<?php
$host = "localhost";
$port = 3306;
$dbname = "dadima";
$user = "root";
$password = "";

$conn = mysqli_connect($host, $user, $password, $dbname, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>