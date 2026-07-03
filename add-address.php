<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Address</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

/* ===================== */

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:"Poppins",sans-serif;
}

body{
background:#f6f4eb;
padding:30px;
}

/* Header */

.page-header{
max-width:750px;
margin:auto;
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:20px;
}

.back-btn{
width:48px;
height:48px;
display:flex;
justify-content:center;
align-items:center;
background:#fff;
color:#11471d;
border-radius:12px;
font-size:22px;
text-decoration:none;
box-shadow:0 5px 15px rgba(0,0,0,.08);
transition:.3s;
}

.back-btn:hover{
background:#11471d;
color:#fff;
}

.page-title{
font-size:30px;
font-weight:700;
color:#11471d;
}

/* Card */

.box{
max-width:750px;
margin:auto;
background:#fff;
padding:35px;
border-radius:25px;
box-shadow:0 15px 40px rgba(0,0,0,.08);
}

.box h2{
margin-bottom:30px;
color:#11471d;
font-size:30px;
}

/* Form */

.input-group{
margin-bottom:18px;
}

.input-group label{
display:block;
font-size:15px;
font-weight:600;
margin-bottom:8px;
color:#333;
}

.input-group input,
.input-group textarea{

width:100%;

padding:15px 18px;

border:1px solid #ddd;

border-radius:12px;

font-size:15px;

transition:.3s;

outline:none;

}

.input-group input:focus,
.input-group textarea:focus{

border-color:#11471d;

box-shadow:0 0 0 4px rgba(17,71,29,.08);

}

textarea{

height:130px;

resize:none;

}

.row{

display:grid;

grid-template-columns:repeat(2,1fr);

gap:18px;

}

.save-btn{

width:100%;

padding:16px;

background:#11471d;

color:#fff;

font-size:18px;

font-weight:600;

border:none;

border-radius:12px;

cursor:pointer;

transition:.3s;

margin-top:10px;

}

.save-btn:hover{

background:#0d3817;

}

/* ===========================
Mobile
=========================== */

@media(max-width:576px){

body{

padding:15px;

}

.page-header{

margin-bottom:18px;

}

.page-title{

font-size:24px;

}

.box{

padding:22px;

border-radius:20px;

}

.box h2{

font-size:24px;

margin-bottom:20px;

}

.row{

grid-template-columns:1fr;

gap:0;

}

.input-group input,
.input-group textarea{

padding:15px;

font-size:16px;

}

.save-btn{

padding:15px;

font-size:17px;

}

}

</style>

</head>

<body>

<div class="page-header">

<a href="address.php" class="back-btn">

<i class="fa-solid fa-arrow-left"></i>

</a>

<div class="page-title">

Add Address

</div>

</div>

<div class="box">

<h2>📍 Add New Address</h2>

<form action="save-address.php" method="POST">

<div class="input-group">

<label>Full Name</label>

<input type="text" name="full_name" required>

</div>

<div class="input-group">

<label>Mobile Number</label>

<input type="text" name="mobile" required>

</div>

<div class="input-group">

<label>Complete Address</label>

<textarea name="address" required></textarea>

</div>

<div class="row">

<div class="input-group">

<label>City</label>

<input type="text" name="city" required>

</div>

<div class="input-group">

<label>State</label>

<input type="text" name="state" required>

</div>

</div>

<div class="input-group">

<label>Pincode</label>

<input type="text" name="pincode" required>

</div>

<button class="save-btn">

<i class="fa-solid fa-floppy-disk"></i>

Save Address

</button>

</form>

</div>

</body>
</html>