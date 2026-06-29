<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id'])){
    die("Please Login First");
}

if(empty($_SESSION['cart'])){
    die("Cart Empty");
}

$user_id = $_SESSION['user_id'];

/* ==========================
   ADDRESS
========================== */

if(isset($_POST['address_option']) && $_POST['address_option']=="saved"){

    $res = mysqli_query($conn,"
        SELECT *
        FROM user_addresses
        WHERE user_id='$user_id'
        AND is_default=1
        LIMIT 1
    ");

    if(mysqli_num_rows($res)==0){
        die("Default address not found.");
    }

    $addr = mysqli_fetch_assoc($res);

    $customer_name = $addr['full_name'];
    $phone         = $addr['mobile'];
    $address       = $addr['address'];
    $city          = $addr['city'];
    $state         = $addr['state'];
    $pincode       = $addr['pincode'];

}else{

    $customer_name = mysqli_real_escape_string($conn,$_POST['name']);
    $phone         = mysqli_real_escape_string($conn,$_POST['mobile']);
    $address       = mysqli_real_escape_string($conn,$_POST['address']);
    $city          = mysqli_real_escape_string($conn,$_POST['city']);
    $state         = mysqli_real_escape_string($conn,$_POST['state']);
    $pincode       = mysqli_real_escape_string($conn,$_POST['pincode']);

    $set_default = isset($_POST['set_default']) ? 1 : 0;

    if($set_default){

        mysqli_query($conn,"
            UPDATE user_addresses
            SET is_default=0
            WHERE user_id='$user_id'
        ");

    }

    mysqli_query($conn,"
        INSERT INTO user_addresses
        (
            user_id,
            full_name,
            mobile,
            address,
            city,
            state,
            pincode,
            is_default
        )
        VALUES
        (
            '$user_id',
            '$customer_name',
            '$phone',
            '$address',
            '$city',
            '$state',
            '$pincode',
            '$set_default'
        )
    ");
}


/* ==========================
   SAVE ORDER
========================== */

$order_no = "ORD" . date("YmdHis") . rand(100,999);

foreach($_SESSION['cart'] as $item){

    $product_id = (int)$item['id'];

    $grams = isset($item['grams'])
        ? mysqli_real_escape_string($conn,$item['grams'])
        : "";

    $quantity = (int)$item['quantity'];

    $price = (float)$item['price'];

    $total_price = $price * $quantity;

    $check = mysqli_query($conn,"
        SELECT id
        FROM products
        WHERE id='$product_id'
        LIMIT 1
    ");

    if(mysqli_num_rows($check)==0){
        continue;
    }

    $insert = mysqli_query($conn,"
        INSERT INTO orders
        (
             order_no,
            user_id,
            product_id,
            grams,
            quantity,
            total_price,
            customer_name,
            phone,
            address,
            city,
            state,
            pincode
        )
        VALUES
        (
                '$order_no',
            '$user_id',
            '$product_id',
            '$grams',
            '$quantity',
            '$total_price',
            '$customer_name',
            '$phone',
            '$address',
            '$city',
            '$state',
            '$pincode'
        )
    ");

    if(!$insert){
        die(mysqli_error($conn));
    }

}

unset($_SESSION['cart']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:Arial,sans-serif;
    }

    body{
        background:#f4f4f4;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
    }

    .success-box{
        background:#fff;
        padding:40px;
        border-radius:15px;
        text-align:center;
        box-shadow:0 5px 20px rgba(0,0,0,.1);
        width:450px;
    }

    .success-box
        color:green;
        margin-bottom:15px;
    }

    .success-box p{
        color:#555;
        margin-bottom:20px;
    }

    .success-box a{
        display:inline-block;
        padding:12px 24px;
        background:#0e3014;
        color:#fff;
        text-decoration:none;
        border-radius:8px;
    }

    </style>

</head>
<body>

<div class="success-box">

    <h2>✅ Order Placed Successfully</h2>

    <p>Thank you for shopping with us.</p>

    <a href="../index.php">Continue Shopping</a>

</div>

<script>

setTimeout(function(){
    window.location.href = "../index.php";
},3000);

</script>

</body>
</html>