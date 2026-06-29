<?php


session_start();

if(!isset($_SESSION['admin'])){

header("Location: login.php");

exit();

}

include '../config/db.php';

/* Total Products */

$productQuery = mysqli_query($conn,"
    SELECT COUNT(*) as total_products
    FROM products
");

$productData = mysqli_fetch_assoc($productQuery);

/* Total Orders */
$orderQuery = mysqli_query($conn,"
    SELECT COUNT(*) as total_orders
    FROM orders
");

$orderData = mysqli_fetch_assoc($orderQuery);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jhaji Admin Dashboard</title>

    <!-- <link rel="stylesheet" href="assets/css/admin.css">
      -->

      <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar">

        <div class="logo">
            Dadima
        </div>

        <ul class="menu">
            <li><a href="dashboard.php">🏠 Dashboard</a></li>
            <li><a href="products.php">📦 Products</a></li>
            <li><a href="orders.php">🛒 Orders</a></li>
             <li> <a href="login.php" class="login-btn">🔑 Login</a></li>
            <li><a href="logout.php">🚪 Logout</a></li>
        </ul>

    </div>

    <!-- Main Content -->
    <div class="main-content">

        <div class="topbar">
            <h1>Dashboard</h1>

            <div class="admin-profile">
                Admin
            </div>

     
        </div>

        <!-- Cards -->
        <div class="card-container">

            <div class="card">
                <h3>Total Products</h3>
           <h2><?php echo $productData['total_products']; ?></h2>
            </div>

            <div class="card">
                <h3>Total Orders</h3>
               <h2><?php echo $orderData['total_orders']; ?></h2>
            </div>

        </div>

        <!-- Welcome Section -->
        <div class="welcome-box">
            <h2>Welcome to Jhaji Pickle Admin Panel</h2>
            <p>
                Manage products and orders easily from this dashboard.
            </p>
        </div>

    </div>

</body>
</html>