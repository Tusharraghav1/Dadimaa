<?php
session_start();
include 'config/db.php';

if(!isset($_SESSION['user_id'])){
    header("Location: auth/login.php");
    exit();
}

$msg = "";

if(isset($_POST['change_password'])){

    $user_id = $_SESSION['user_id'];

    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $query = mysqli_query($conn,
        "SELECT * FROM users WHERE id='$user_id'");

    $user = mysqli_fetch_assoc($query);

    if(password_verify($old_password,$user['password'])){

        if($new_password == $confirm_password){

            $hash = password_hash($new_password,PASSWORD_DEFAULT);

            mysqli_query($conn,
            "UPDATE users
             SET password='$hash'
             WHERE id='$user_id'");

            $msg = "✅ Password Changed Successfully";

        }else{
            $msg = "❌ New Password and Confirm Password do not match";
        }

    }else{
        $msg = "❌ Old Password Incorrect";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Change Password</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,sans-serif;
}

body{
background:#f5f2e9;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
}

.card{
background:#fff;
padding:20px;
width:450px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,.1);
}

h2{
color:#0b4d1e;
margin-bottom:20px;
}

input{
width:100%;
padding:12px;
margin:10px 0;
border:1px solid #ccc;
border-radius:8px;
}

button{
width:100%;
padding:12px;
background:#0b4d1e;
color:white;
border:none;
border-radius:8px;
cursor:pointer;
}

.msg{
margin-bottom:15px;
font-weight:bold;
}

.back{
display:block;
margin-top:15px;
text-align:center;
text-decoration:none;
color:#0b4d1e;
}

</style>

</head>
<body>

<div class="card">

<h2>🔐 Change Password</h2>

<?php if($msg!=""){ ?>
<div class="msg"><?php echo $msg; ?></div>
<?php } ?>

<form method="POST">

<input type="password"
name="old_password"
placeholder="Old Password"
required>

<input type="password"
name="new_password"
placeholder="New Password"
required>

<input type="password"
name="confirm_password"
placeholder="Confirm Password"
required>

<button type="submit"
name="change_password">
Change Password
</button>

</form>

<a href="settings.php" class="back">
← Back to Settings
</a>

</div>

</body>
</html>