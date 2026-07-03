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



/* Back Button */

.back-btn{
    position:fixed;
    top:20px;
    left:20px;
    background:#1d2b44;
    color:#fff;
    text-decoration:none;
    padding:10px 18px;
    border-radius:8px;
    font-size:15px;
    font-weight:600;
    box-shadow:0 4px 10px rgba(0,0,0,.15);
    transition:.3s;
    z-index:1000;
}

.back-btn:hover{
    background:#28a745;
}

/* Tablet */
/* ==========================
   TABLET (577px - 768px)
========================== */

/* ==========================
   TABLET (577px - 768px)
========================== */

@media (min-width:577px) and (max-width:768px){

body{
    margin:0;
    padding:35px;
    background:#f4f6f9;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

/* Login Card */

.login-box{

    width:100%;
    max-width:650px;      /* Card bada */

    padding:60px 50px;

    border-radius:24px;

    box-shadow:0 18px 40px rgba(0,0,0,.12);
}

/* Heading */

.login-box h2{

    font-size:42px;

    margin-bottom:40px;
}

/* Inputs */

input{

    width:100%;

    height:65px;

    padding:0 22px;

    font-size:20px;

    border-radius:14px;

    margin-bottom:24px;
}

/* Button */

button{

    width:100%;

    height:65px;

    font-size:22px;

    border-radius:14px;
}

/* Back Button */

.back-btn{

    position:fixed;

    top:25px;
    left:25px;

    width:180px;
    height:60px;

    display:flex;
    justify-content:center;
    align-items:center;

    font-size:18px;
    font-weight:600;

    border-radius:14px;
}
}
/* Mobile */

/* ==========================
   MOBILE
========================== */

@media (max-width:576px){

body{
    /* padding:20px; */
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    height:auto;
}

.login-box{

    width:100%;
    max-width:100%;

    padding:35px 25px;

    border-radius:20px;

    box-shadow:0 12px 30px rgba(0,0,0,.12);

}

.login-box h2{

    font-size:34px;

    margin-bottom:30px;

}

input{

    height:58px;

    padding:0 18px;

    font-size:18px;

    border-radius:12px;

    margin-bottom:20px;

}

button{

    height:58px;

    font-size:19px;

    border-radius:12px;

}

.back-btn{

    top:18px;
    left:18px;

    padding:12px 20px;

    font-size:16px;

    border-radius:12px;
}

}

</style>

</head>

<body>
    <a href="../admin/dashboard.php" class="back-btn">← Back</a>

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

    <div class="password-box">
    <input
        type="password"
        id="password"
        name="password"
        placeholder="Enter Password"
        autocomplete="new-password"
        required>

    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()"></i>
</div>

    <button type="submit" name="login">
        Login
    </button>
    

</form>





</div>



<script>
function togglePassword() {
    const password = document.getElementById("password");
    const icon = document.querySelector(".toggle-password");

    if (password.type === "password") {
        password.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>

</body>
</html>