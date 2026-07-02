<?php
session_start();
$total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Shopping Cart</title>

<link rel="stylesheet" href="../assets/css/cart.css?v=<?php echo time(); ?>">

</head>

<body>

<div class="wrapper">

    <div class="page-title">

        <h1>🛒 Shopping Cart</h1>

    </div>

<?php if(empty($_SESSION['cart'])){ ?>

<div class="empty-cart">

<h2>Your Cart is Empty</h2>

<a href="../index.php" class="shop-btn">

Continue Shopping

</a>

</div>

<?php } else { ?>

<div class="cart-container">

<!-- LEFT -->

<div class="cart-products">

<?php

foreach($_SESSION['cart'] as $cartKey=>$item){

if(empty($item['product_name'])) continue;

$qty=$item['quantity'];

$subtotal=$item['price']*$qty;

$total+=$subtotal;

?>

<div class="cart-card">

<div class="product-image">

<img src="../assets/img/<?php echo $item['image']; ?>" alt="">

</div>

<div class="product-details">

<div class="product-header">

<h2>

<?php echo $item['product_name']; ?>

</h2>

<a href="remove-cart.php?id=<?php echo urlencode($cartKey); ?>" class="remove-btn">

🗑

</a>

</div>

<?php if(isset($item['grams'])){ ?>

<div class="weight">

Weight :
<strong>

<?php echo $item['grams']; ?>g

</strong>

</div>

<?php } ?>

<div class="price">

₹<?php echo number_format($item['price']); ?>

</div>

<div class="qty-title">

Quantity

</div>

<div class="qty-box">

<a href="decrease.php?id=<?php echo urlencode($cartKey); ?>">−</a>

<span>

<?php echo $qty; ?>

</span>

<a href="increase.php?id=<?php echo urlencode($cartKey); ?>">+</a>

</div>

<div class="subtotal">

Subtotal :

<strong>

₹<?php echo number_format($subtotal); ?>

</strong>

</div>

</div>

</div>

<?php } ?>

</div>

<!-- RIGHT -->

<div class="summary-section">

<div class="summary-card">

<h2>Order Summary</h2>

<div class="summary-row">

<span>Items Total</span>

<span>

₹<?php echo number_format($total); ?>

</span>

</div>

<div class="summary-row">

<span>Shipping</span>

<span>

₹50

</span>

</div>

<hr>

<div class="summary-row grand-total">

<span>Total</span>

<span>

₹<?php echo number_format($total+50); ?>

</span>

</div>

<a href="../index.php" class="continue-btn">

← Continue Shopping

</a>

<form action="../orders/checkout.php" method="GET">

<button class="checkout-btn">

Proceed To Checkout

</button>

</form>

</div>

</div>

</div>

<?php } ?>

</div>

</body>
</html>