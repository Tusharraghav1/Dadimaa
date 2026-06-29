<?php
session_start();

if(isset($_GET['id'])){

    $id = $_GET['id'];

    if(isset($_SESSION['cart'][$id])){

        if($_SESSION['cart'][$id]['quantity'] > 1){

            $_SESSION['cart'][$id]['quantity']--;

        }else{

            unset($_SESSION['cart'][$id]);
        }
    }
}

header("Location: cart.php");
exit();
?>