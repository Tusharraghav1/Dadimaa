<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/db.php';
include '../config/mail.php';

$msg = "";
$error = "";

if (isset($_POST['send_otp'])) {

    $email = mysqli_real_escape_string($conn, trim($_POST['email']));

    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($check) == 1) {

        $otp = rand(100000,999999);
        $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

        mysqli_query($conn,"
            UPDATE users
            SET otp='$otp',
                otp_expiry='$expiry'
            WHERE email='$email'
        ");

        if(sendOTP($email,$otp) === true){

            $_SESSION['reset_email'] = $email;

            header("Location: verify_reset_otp.php");
            exit();

        }else{

            $error = "Failed to send OTP.";

        }

    }else{

        $error = "Email not found.";

    }

}
?>

<!DOCTYPE html>
<html>
<style>




    .forgot-link{
    text-align:right;
    margin:-5px 0 18px;
}

.forgot-link a{
    color:#0f5132;
    text-decoration:none;
    font-size:15px;
    font-weight:600;
}

.forgot-link a:hover{
    text-decoration:underline;
}
</style>
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Forgot Password</title>

<link rel="stylesheet" href="../assets/css/auth.css">

</head>

<body>

<a href="login.php" class="back-btn">← Back</a>

<div class="container">

<h2>Forgot Password</h2>

<?php if($msg!=""){ ?>
<p class="message"><?php echo $msg; ?></p>
<?php } ?>

<?php if($error!=""){ ?>
<p class="error"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">

<input
type="email"
name="email"
placeholder="Enter Registered Email"
required
autocomplete="off">

<button
type="submit"
name="send_otp">
Send OTP
</button>

</form>

<p>
Remember Password?
<a href="login.php">Login Here</a>
</p>

</div>

</body>

</html>