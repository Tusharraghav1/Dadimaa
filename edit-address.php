<?php
session_start();
include 'config/db.php';

$id = $_GET['id'];

$result = mysqli_query($conn,
"SELECT * FROM user_addresses
 WHERE id='$id'");

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Address</title>
<link rel="stylesheet" href="assets/css/edit-address.css">
</head>
<body>
<div class="edit-container">

    <div class="edit-card">

        <h1>Edit Address</h1>

        <form action="update-address.php" method="POST">

            <input type="hidden"
                   name="id"
                   value="<?php echo $row['id']; ?>">

            <div class="input-group">
                <label>Full Name</label>
                <input type="text"
                       name="full_name"
                       value="<?php echo $row['full_name']; ?>">
            </div>

            <div class="input-group">
                <label>Mobile Number</label>
                <input type="text"
                       name="mobile"
                       value="<?php echo $row['mobile']; ?>">
            </div>

            <div class="input-group">
                <label>Address</label>
                <textarea name="address"><?php echo $row['address']; ?></textarea>
            </div>

            <div class="row">

                <div class="input-group">
                    <label>City</label>
                    <input type="text"
                           name="city"
                           value="<?php echo $row['city']; ?>">
                </div>

                <div class="input-group">
                    <label>State</label>
                    <input type="text"
                           name="state"
                           value="<?php echo $row['state']; ?>">
                </div>

            </div>

            <div class="input-group">
                <label>Pincode</label>
                <input type="text"
                       name="pincode"
                       value="<?php echo $row['pincode']; ?>">
            </div>

            <button type="submit" class="save-btn">
                Update Address
            </button>

        </form>

    </div>

</div>

</body>
</html>