<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/db.php';

if (!isset($_SESSION['reset_email']) || !isset($_SESSION['reset_verified'])) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['reset_email'];

$msg = "";
$error = "";

if (isset($_POST['reset_password'])) {

    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']);

    if (strlen($password) < 6) {

        $error = "Password must be at least 6 characters.";

    } elseif ($password != $confirmPassword) {

        $error = "Passwords do not match.";

    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $update = mysqli_query($conn,"
            UPDATE users
            SET
                password='$hashedPassword',
                otp=NULL,
                otp_expiry=NULL
            WHERE email='$email'
        ");

        if($update){

            unset($_SESSION['reset_email']);
            unset($_SESSION['reset_verified']);

            $_SESSION['success'] = "Password changed successfully. Please login.";

            header("Location: login.php");
            exit();

        }else{

            $error = "Something went wrong.";

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>New Password</title>

<link rel="stylesheet" href="../assets/css/auth.css">

<!-- Font Awesome -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<a href="verify_reset_otp.php" class="back-btn">← Back</a>

<div class="container">

<h2>Create New Password</h2>

<?php if($msg!=""){ ?>
<p class="message"><?php echo $msg; ?></p>
<?php } ?>

<?php if($error!=""){ ?>
<p class="error"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">

<!-- New Password -->

<div class="password-box">

<input
type="password"
name="password"
id="password"
placeholder="New Password"
required>

<i class="fa-solid fa-eye toggle-password"
onclick="togglePassword('password',this)"></i>

</div>

<!-- Confirm Password -->

<div class="password-box">

<input
type="password"
name="confirm_password"
id="confirm_password"
placeholder="Confirm Password"
required>

<i class="fa-solid fa-eye toggle-password"
onclick="togglePassword('confirm_password',this)"></i>

</div>

<button
type="submit"
name="reset_password">
Update Password
</button>

</form>

</div>

<script>

function togglePassword(id,icon){

    let input=document.getElementById(id);

    if(input.type==="password"){

        input.type="text";

        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");

    }else{

        input.type="password";

        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");

    }

}

</script>

</body>

</html>