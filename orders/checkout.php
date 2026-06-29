<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    die("Cart is Empty");
}

$user_id = $_SESSION['user_id'];

$address_query = mysqli_query($conn,"
SELECT *
FROM user_addresses
WHERE user_id='$user_id'
AND is_default=1
LIMIT 1
");

$default_address = mysqli_fetch_assoc($address_query);

$total = 0;
$shipping = 50;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/css/checkout.css">

    <style>

    .saved-address{
        background:#f7f7f7;
        padding:20px;
        border-radius:10px;
        margin-bottom:20px;
        border:1px solid #ddd;
    }

    .saved-address h3{
        color:#0b4d1c;
        margin-bottom:10px;
    }

    .saved-address label{
        display:block;
        margin-top:10px;
        cursor:pointer;
    }

    </style>

</head>
<body>

<div class="checkout-container">

    <!-- LEFT SIDE -->

    <div class="address-card">

        <div class="title-box">

            <div class="icon">📍</div>

            <div>
                <h2>Shipping Address</h2>
                <p>Select address for delivery</p>
            </div>

        </div>

        <form action="place_order.php" method="POST">

            <?php if($default_address){ ?>

            <div class="saved-address">

                <h3>Default Address</h3>

                <p>
                    <strong>
                        <?php echo $default_address['full_name']; ?>
                    </strong>
                </p>

                <p>
                    <?php echo $default_address['mobile']; ?>
                </p>

                <p>
                    <?php echo $default_address['address']; ?>,
                    <?php echo $default_address['city']; ?>,
                    <?php echo $default_address['state']; ?> -
                    <?php echo $default_address['pincode']; ?>
                </p>

                <label>

                    <input type="radio"
                           name="address_option"
                           value="saved"
                           checked>

                    Use Saved Address

                </label>

                <label>

                    <input type="radio"
                           name="address_option"
                           value="new">

                    Add New Address

                </label>

            </div>

            <?php } ?>

            <!-- NEW ADDRESS FORM -->

            <div id="newAddressForm"
                 <?php if($default_address){ ?>
                 style="display:none;"
                 <?php } ?>>

                <div class="row">

                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" name="name">
                    </div>

                    <div class="input-group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile">
                    </div>

                </div>

                <div class="input-group">

                    <label>Address</label>

                    <textarea name="address"></textarea>

                </div>

                <div class="row">

                    <div class="input-group">
                        <label>City</label>
                        <input type="text" name="city">
                    </div>

                    <div class="input-group">
                        <label>State</label>
                        <input type="text" name="state">
                    </div>

                    <div class="input-group">
                        <label>Pincode</label>
                        <input type="text" name="pincode">
                    </div>

                    <div class="input-group">
                     <div class="default-address">
    <label class="checkbox-card">
        <input type="checkbox" name="set_default" value="1">

        <span class="checkmark"></span>

        <div class="text">
            <strong>⭐ Set as Default Address</strong>
            <small>Use this address for all future deliveries.</small>
        </div>
    </label>
</div>
 
</div>

                </div>

            </div>

            <button type="submit" class="order-btn">
                Place Order
            </button>

        </form>

    </div>

    <!-- RIGHT SIDE -->

   
  <!-- RIGHT SIDE -->

<div class="summary-card">

    <h3>Order Summary</h3>

    <?php
    foreach($_SESSION['cart'] as $item){

        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
    ?>

    <div class="product">

        <img src="../assets/img/<?php echo $item['image']; ?>" width="70">

        <div>

            <h4><?php echo $item['product_name']; ?></h4>

            <p>
                Qty : <?php echo $item['quantity']; ?>
            </p>

        </div>

        <span>₹<?php echo $subtotal; ?></span>

    </div>

    <hr>

    <?php } ?>

    <?php
        $grand_total = $total + $shipping;
    ?>

    <div class="summary-row">
        <span>Subtotal</span>
        <span>₹<?php echo $total; ?></span>
    </div>

    <div class="summary-row">
        <span>Shipping</span>
        <span>₹<?php echo $shipping; ?></span>
    </div>

    <hr>

    <div class="summary-row grand-total">
        <strong>Total</strong>
        <strong>₹<?php echo $grand_total; ?></strong>
    </div>

</div>

</div>

<script>

const radios =
document.querySelectorAll(
'input[name="address_option"]'
);

const form =
document.getElementById(
'newAddressForm'
);

radios.forEach(radio=>{

    radio.addEventListener('change',()=>{

        if(
            radio.value=="new"
            &&
            radio.checked
        ){
            form.style.display="block";
        }
        else{
            form.style.display="none";
        }

    });

});

</script>

</body>
</html>