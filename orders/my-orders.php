<?php
session_start();
include '../config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT o.*, p.product_name, p.image
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.user_id = '$user_id'
        ORDER BY o.id DESC";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    
       <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>My Orders</title>
    <link rel="stylesheet" href="../assets/css/my-orders.css">
</head>
<body>

<div class="container">

    <div class="header">
        <h1>📦 My Orders</h1>
        <a href="../profile.php" class="back-btn">← Back Profile</a>
    </div>

    <?php if(mysqli_num_rows($result) > 0){ ?>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>

        <div class="order-card">

            <div class="left">

                <img src="../assets/img/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">

                <div class="details">
                    <h3><?php echo $row['product_name']; ?></h3>
                    <p>Order ID: #<?php echo $row['id']; ?></p>
                    <p>Quantity: <?php echo $row['quantity']; ?></p>
                </div>

            </div>

            <div class="right">

                <h2>₹<?php echo $row['total_price']; ?></h2>

                <span class="status">
                <?php
                if($row['ofd']==1){
                    echo "🚚 Out for Delivery";
                }else{
                    echo "📦 Preparing Order";
                }
                ?>
                </span>

            </div>

        </div>

        <?php } ?>

    <?php } else { ?>

        <div class="empty">
            <h2>No Orders Found</h2>
            <a href="../index.php">Start Shopping</a>
        </div>

    <?php } ?>

</div>

</body>
</html>