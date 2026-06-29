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
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>

<div class="profile-container">

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="user-card">
            <div class="avatar">👤</div>
            <h3><?php echo $_SESSION['user_name']; ?></h3>
            <p>Pickle Delights Customer</p>
        </div>

        <ul>
            <li class="active">👤 My Profile</li>
              <li> <a href="orders/my-orders.php">📦 My Orders</a></li>
            
            <li><a href="address.php">🏠 Addresses</a></li>
          <li>
            <a href="settings.php">⚙️ Settings</a>
          </li>
            <li>
                <a href="auth/logout.php" class="logout">
                    🚪 Logout
                </a>
            </li>
        </ul>

    </div>

    <!-- Main Content -->
    <div class="content">
          <div class="profile-top">
    <a href="index.php" class="back-btn">
        ← Back to Home
    </a>
</div>
        <div class="welcome-card">
            <div>
                <h1>Welcome, <?php echo $_SESSION['user_name']; ?></h1>
                <p>Manage your account and orders</p>
            </div>

            <div class="badge">
                🏆 Premium Member
            </div>
        </div>

        <!-- Stats -->
        <div class="stats">

            <div class="stat-card">
              <h1><?php echo $orderCount['total_orders']; ?></h1>
<p>Orders</p>
            </div>

            <div class="stat-card">
             <h3>📍 Address</h3>

<?php if($address){ ?>

    <p>
        <?php echo $address['address']; ?>
    </p>

<?php } else { ?>

    <p>No Address Added</p>

<?php } ?>
            </div>

            <!-- <div class="stat-card">
                <h2>5</h2>
                <p>Wishlist</p>
            </div>

        </div> -->

        <!-- Recent Orders -->
        <div class="orders-card">

            <div class="card-header">
                <h2>Recent Orders</h2>
            </div>

            <!-- <div class="order-row">
                <img src="assets/img/mango.png">

                <div>
                    <h4>Mango Pickle</h4>
                    <p>Delivered</p>
                </div>

                <span>₹120</span>
            </div>

            <div class="order-row">
                <img src="assets/img/lemon.png">

                <div>
                    <h4>Lemon Pickle</h4>
                    <p>Delivered</p>
                </div>

                <span>₹100</span>
            </div> -->



    <?php while($order = mysqli_fetch_assoc($recentOrders)){ ?>

        <div class="order-item">

            <img src="assets/img/<?php echo $order['image']; ?>" width="70">

            <div>
                <h4><?php echo $order['product_name']; ?></h4>
                <p>Qty: <?php echo $order['quantity']; ?></p>
            </div>

            <strong>
                ₹<?php echo $order['total_price']; ?>
            </strong>

        </div>

    <?php } ?>



        </div>

    </div>

</div>

</body>
</html>