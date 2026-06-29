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
    <title>Add Address</title>

    <style>

    body{
        font-family:Arial;
        background:#f5f5f5;
    }

    .box{
        width:700px;
        margin:40px auto;
        background:#fff;
        padding:30px;
        border-radius:12px;
    }

    h2{
        color:#0b4d1c;
    }

    input,textarea{
        width:100%;
        padding:12px;
        margin:10px 0;
    }

    button{
        background:#0b4d1c;
        color:white;
        border:none;
        padding:12px 25px;
        border-radius:8px;
        cursor:pointer;
    }

    </style>

</head>
<body>

<div class="box">

<h2>Add New Address</h2>

<form action="save-address.php" method="POST">

    <input type="text"
           name="full_name"
           placeholder="Full Name"
           required>

    <input type="text"
           name="mobile"
           placeholder="Mobile Number"
           required>

    <textarea
        name="address"
        placeholder="Complete Address"
        required></textarea>

    <input type="text"
           name="city"
           placeholder="City"
           required>

    <input type="text"
           name="state"
           placeholder="State"
           required>

    <input type="text"
           name="pincode"
           placeholder="Pincode"
           required>

    <button type="submit">
        Save Address
    </button>

</form>

</div>

</body>
</html>