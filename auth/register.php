<?php
if(session_status() === PHP_SESSION_NONE){
    session_start();
}

include '../config/db.php';

$message = "";

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){

        $message = "Email already exists!";

    }else{

        $sql = "INSERT INTO users(name,email,password)
                VALUES('$name','$email','$password')";

        if(mysqli_query($conn,$sql)){

    $user_id = mysqli_insert_id($conn);

    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $name;

  header("Location: ../index.php");
    exit();

}else{

            $message = "Registration Failed!";

        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>

<div class="container">

    <h2>Register</h2>

    <?php if(!empty($message)){ ?>
        <p class="message"><?php echo $message; ?></p>
    <?php } ?>

   <form method="POST" autocomplete="off">

    <input type="text"
           name="name"
           placeholder="Name"
           autocomplete="off"
           required>

    <input type="email"
           name="email"
           placeholder="Email"
           autocomplete="off"
           required>

    <input type="password"
           name="password"
           placeholder="Password"
           autocomplete="new-password"
           required>

    <button type="submit" name="register">
        Register
    </button>

</form>

    <p>
        <a href="login.php">Login Here</a>
    </p>

</div>

</body>
</html>