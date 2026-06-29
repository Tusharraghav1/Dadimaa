<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Account Settings</title>
    <link rel="stylesheet" href="assets/css/settings.css">
</head>
<body>

<div class="settings-container">



    <div class="settings-card">




 <div class="settings-header">

        <h1>⚙️ Account Settings</h1>

        <a href="profile.php" class="back-btn">
            ← Back to Profile
        </a>


</div>


        <div class="user-info">
            <h2><?php echo $_SESSION['user_name']; ?></h2>
            <p>Manage your account settings</p>
        </div>

        <div class="setting-item">
            <div>
                <h3>🔐 Change Password</h3>
                <p>Update your account password</p>
            </div>

            <a href="change-password.php" class="btn">
                Change
            </a>
        </div>

        <div class="setting-item">
            <div>
                <h3>🏠 Manage Addresses</h3>
                <p>Add, edit and set default address</p>
            </div>

            <a href="address.php" class="btn">
                Open
            </a>
        </div>

        <div class="setting-item">
            <div>
                <h3>📦 My Orders</h3>
                <p>View your order history</p>
            </div>

            <a href="orders/my-orders.php" class="btn">
                View
            </a>
        </div>

        <div class="setting-item">
            <div>
                <h3>🚪 Logout</h3>
                <p>Sign out from your account</p>
            </div>

            <a href="auth/logout.php" class="btn danger">
                Logout
            </a>
        </div>

    </div>

</div>

</body>
</html>