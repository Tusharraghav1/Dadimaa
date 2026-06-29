<?php
session_start();

if(isset($_POST['add_cart']))
{
    $id = $_POST['id'];

    $basePrice = $_POST['price'];
    $grams = $_POST['grams'];

    // Price Calculation
    if($grams == 100){
        $price = $basePrice;
    }
    elseif($grams == 200){
        $price = $basePrice * 2;
    }
    elseif($grams == 300){
        $price = $basePrice * 3;
    }
    elseif($grams == 500){
        $price = $basePrice * 5;
    }

    // Product ID + Grams ko unique key banao
    $cartKey = $id . "_" . $grams;

    if(isset($_SESSION['cart'][$cartKey]))
    {
        $_SESSION['cart'][$cartKey]['quantity']++;
    }
    else
    {
        $_SESSION['cart'][$cartKey] = [

            'id' => $id,
            'product_name' => $_POST['product_name'],
            'price' => $price,
            'image' => $_POST['image'],
            'grams' => $grams,
            'quantity' => 1
        ];
    }

    header("Location: cart.php");
    exit();
}

echo "Invalid Product ID";
?>