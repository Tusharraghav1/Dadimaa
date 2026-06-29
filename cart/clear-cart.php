<?php
session_start();
unset($_SESSION['cart']);

echo "Cart Cleared Successfully";
?>