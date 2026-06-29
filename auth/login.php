
<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include '../config/db.php';

$msg = "";

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){

        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];

           header("Location: ../index.php");
            exit();

        } else {
            $msg = "Wrong Password";
        }

    } else {
        $msg = "Email Not Found";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="container">

    <h2>Login</h2>

    <?php if(!empty($msg)){ ?>
        <p class="message"><?php echo $msg; ?></p>
    <?php } ?>

    <form method="POST">

        <input type="email" name="email" placeholder="Enter Email" required>

        <input type="password" name="password" placeholder="Enter Password" required>

        <button type="submit" name="login">Login</button>

    </form>

    <p>
        <a href="register.php">Register Here</a>
    </p>

</div>

</body>
</html>