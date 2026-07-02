<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

include 'config/db.php';

$user_id = $_SESSION['user_id'];

$recentOrders = mysqli_query($conn,"
    SELECT o.*, p.product_name, p.image
    FROM orders o
    JOIN products p ON o.product_id = p.id
    WHERE o.user_id = '$user_id'
    ORDER BY o.id DESC
    LIMIT 3
");


$orderCountQuery = mysqli_query($conn,"
    SELECT COUNT(*) as total_orders
    FROM orders
    WHERE user_id = '$user_id'
");

$orderCount = mysqli_fetch_assoc($orderCountQuery);


/* ADDRESS QUERY YAHAN ADD KARO */

$addressQuery = mysqli_query($conn,"
    SELECT *
    FROM user_addresses
    WHERE user_id = '$user_id'
    ORDER BY id DESC
    LIMIT 1
");

$address = mysqli_fetch_assoc($addressQuery);



?>

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
    
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>

<!-- Mobile Header -->

<div class="mobile-header">

    <button class="menu-btn" id="menuBtn">
        ☰
    </button>

    <a href="index.php" class="back-btn">
        ← Back to Home
    </a>

</div>


<div class="profile-container">

    <!-- Sidebar -->

    <aside class="sidebar" id="sidebar">

        <div class="user-card">

            <div class="avatar">
                👤
            </div>

            <div class="user-info">

                <h2>
                    <?php echo $_SESSION['user_name']; ?>
                </h2>

                <p>
                    Pickle Delights Customer
                </p>

            </div>

        </div>

        <ul class="menu">

            <li class="active">

                <span>
                    👤 My Profile
                </span>

            </li>

            <li>

                <a href="orders/my-orders.php">

                    <span>
                        📦 My Orders
                    </span>

                    <span class="arrow">
                        ›
                    </span>

                </a>

            </li>

            <li>

                <a href="address.php">

                    <span>
                        📍 Addresses
                    </span>

                    <span class="arrow">
                        ›
                    </span>

                </a>

            </li>

            <li>

                <a href="settings.php">

                    <span>
                        ⚙️ Settings
                    </span>

                    <span class="arrow">
                        ›
                    </span>

                </a>

            </li>

            <li>

                <a href="auth/logout.php" class="logout">

                    <span>
                        🚪 Logout
                    </span>

                    <span class="arrow">
                        ›
                    </span>

                </a>

            </li>

        </ul>

    </aside>


    <!-- Right Content -->

    <main class="content">

        <section class="welcome-card">

            <div>

                <h1>

                    Welcome,
                    <?php echo $_SESSION['user_name']; ?>

                </h1>

                <p>

                    Manage your account and orders

                </p>

            </div>

            <div class="badge">

                🏆 Premium Member

            </div>

        </section>


        <!-- Stats -->

        <section class="stats">

            <div class="stat-card">

                <div class="icon green">

                    🛍

                </div>

                <div>

                    <h2>

                        <?php echo $orderCount['total_orders']; ?>

                    </h2>

                    <p>

                        Orders

                    </p>

                </div>

            </div>



            <div class="stat-card">

                <div class="icon pink">

                    📍

                </div>

                <div>

                    <h3>

                        Address

                    </h3>

                    <?php if($address){ ?>

                        <p>

                            <?php echo $address['address']; ?>

                        </p>

                    <?php }else{ ?>

                        <p>

                            No Address Added

                        </p>

                    <?php } ?>

                </div>

            </div>

        </section>



        <!-- Orders -->

        <section class="orders-card">

            <div class="card-header">

                <h2>

                    Recent Orders

                </h2>

            </div>


            <?php

            if(mysqli_num_rows($recentOrders)>0){

            while($order=mysqli_fetch_assoc($recentOrders)){ ?>



            <div class="order-item">

                <img src="assets/img/<?php echo $order['image']; ?>">


                <div class="order-details">

                    <h4>

                        <?php echo $order['product_name']; ?>

                    </h4>

                    <p>

                        Qty :
                        <?php echo $order['quantity']; ?>

                    </p>

                </div>


                <strong>

                    ₹<?php echo $order['total_price']; ?>

                </strong>

            </div>

            <?php }

            }else{ ?>

                <div class="empty-orders">

                    <div class="empty-icon">

                        📋

                    </div>

                    <h3>

                        No Recent Orders

                    </h3>

                    <p>

                        You have no recent orders.

                    </p>

                </div>

            <?php } ?>

        </section>

    </main>

</div>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init({
duration:900,
once:true
});
</script>
<script src="assets/js/profile.js"></script>

</body>
</html>