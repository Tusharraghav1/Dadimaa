<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM user_addresses
        WHERE user_id='$user_id'
        ORDER BY is_default DESC";

$result = mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Addresses</title>
    <link rel="stylesheet" href="assets/css/address.css">
</head>
<body>

<div class="container">

    <div class="top">
        <h1>🏠 My Addresses</h1>

        
    <div class="header-buttons">
        <a href="profile.php" class="back-btn">
            ← Back
        </a>

        <a href="add-address.php" class="add-btn">
            + Add New Address
        </a>
    </div>
    </div>

    <?php while($row = mysqli_fetch_assoc($result)){ ?>

    <div class="address-card">

        <div class="address-info">

            <h3>
                <?php echo $row['full_name']; ?>

                <?php if($row['is_default']==1){ ?>
                    <span class="default">Default</span>
                <?php } ?>

            </h3>

            <p><?php echo $row['mobile']; ?></p>

            <p>
                <?php echo $row['address']; ?>,
                <?php echo $row['city']; ?>,
                <?php echo $row['state']; ?> -
                <?php echo $row['pincode']; ?>
            </p>

        </div>

        <div class="actions">

            <a href="edit-address.php?id=<?php echo $row['id']; ?>">
                Edit
            </a>

            <a href="set-default.php?id=<?php echo $row['id']; ?>">
                Set Default
            </a>

        </div>

    </div>

    <?php } ?>

</div>

</body>
</html>

