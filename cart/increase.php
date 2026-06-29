<?php
session_start();

if(isset($_GET['id'])){

    $id = $_GET['id'];

    if(isset($_SESSION['cart'][$id])){
        $_SESSION['cart'][$id]['quantity']++;
    }
}

header("Location: cart.php");
exit();
?>