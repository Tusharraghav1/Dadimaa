<?php
session_start();

$total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
    <!-- <link rel="stylesheet" href="../assets/css/cart.css"> -->


    <link rel="stylesheet" href="../assets/css/cart.css?v=<?php echo time(); ?>">
</head>
<body>

<div class="wrapper">

    <!-- Header -->
    <div class="cart-header">

        <h1 class="cart-title">My Cart</h1>

       

    </div>

    <?php if(empty($_SESSION['cart'])){ ?>

        <div class="empty-cart">
            <h2>Your Cart is Empty 🛒</h2>

            <a href="../index.php" class="add-more-btn">
                Start Shopping
            </a>
        </div>

    <?php } else { ?>

    <div class="cart-container">

        <!-- Products -->
        <div class="cart-products">

            <?php
            foreach($_SESSION['cart'] as $cartKey => $item){

                if(empty($item['product_name'])) continue;

                $qty = $item['quantity'];
                $subtotal = $item['price'] * $qty;

                $total += $subtotal;
            ?>

            <div class="cart-card">

                <img src="../assets/img/<?php echo $item['image']; ?>" alt="">

                <div class="cart-info">

                    <div class="top-row">

                        <h3>
                            <?php echo $item['product_name']; ?>
                        </h3>

                        
<a class="delete-btn"
   href="remove-cart.php?id=<?php echo urlencode($cartKey); ?>">
   🗑️
</a>

                    </div>

                    <?php if(isset($item['grams'])){ ?>
                    <p class="weight">
                        Weight : <?php echo $item['grams']; ?>g
                    </p>
                    <?php } ?>

                    <p class="weight">
                        Quantity : <?php echo $qty; ?>
                    </p>

                    <p class="price">
                        ₹<?php echo $subtotal; ?>
                    </p>

                    <div class="qty-box">
<a href="decrease.php?id=<?php echo urlencode($cartKey); ?>">-</a>

                        <span>
                            <?php echo $qty; ?>
                        </span>

                    <a href="increase.php?id=<?php echo urlencode($cartKey); ?>">+</a>

                    </div>

                </div>

            </div>

            <?php } ?>

        </div>

        <!-- Order Summary -->
        <div class="summary-section">

            <a href="../index.php" class="add-more-btn summary-btn">
                + Add More Products
            </a>

            <div class="summary-card">

                <h2>Order Summary</h2>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>₹<?php echo $total; ?></span>
                </div>

                <div class="summary-row">
                    <span>Shipping</span>
                    <span>₹50</span>
                </div>

                <hr><br>

                <div class="summary-row total">
                    <span>Total</span>
                    <span>₹<?php echo $total + 50; ?></span>
                </div>

                <form action="../orders/checkout.php" method="GET">

                    <button type="submit" class="checkout-btn">
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