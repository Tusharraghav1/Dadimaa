<?php
session_start();

$error = "";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Change these credentials
    if($username=="admin" && $password=="admin123"){

        $_SESSION['admin']=true;

        header("Location: dashboard.php");
        exit();

    }else{

        $error="Invalid Username or Password";

    }

}
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Admin Login</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}

body{

background:#f4f6f9;
display:flex;
justify-content:center;
align-items:center;
height:100vh;

}

.login-box{

width:400px;
background:#fff;
padding:40px;
border-radius:15px;
box-shadow:0 10px 30px rgba(0,0,0,.1);

}

.login-box h2{

text-align:center;
margin-bottom:30px;
color:#1d2b44;

}

input{

width:100%;
padding:14px;
margin-bottom:18px;
border:1px solid #ddd;
border-radius:8px;
font-size:16px;

}

button{

width:100%;
padding:14px;
background:#28a745;
color:#fff;
border:none;
border-radius:8px;
font-size:16px;
cursor:pointer;

}

button:hover{

background:#218838;

}

.error{

color:red;
margin-bottom:15px;
text-align:center;

}

</style>

</head>

<body>

<div class="login-box">

<h2>Admin Login</h2>

<?php
if($error!=""){
echo "<div class='error'>$error</div>";
}
?>

<form method="POST" action="" autocomplete="off">

    <!-- Dummy fields -->
    <input type="text" name="fakeuser" style="display:none">
    <input type="password" name="fakepass" style="display:none">

    <input
        type="text"
        name="username"
        placeholder="Username"
        value=""
        autocomplete="new-password"
        spellcheck="false"
        autocapitalize="off"
        autocorrect="off"
        required>

    <input
        type="password"
        name="password"
        placeholder="Password"
        value=""
        autocomplete="new-password"
        required>

    <button type="submit" name="login">
        Login
    </button>

</form>





</div>

</body>
</html>