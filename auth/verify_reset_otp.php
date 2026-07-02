<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/db.php';

if (!isset($_SESSION['reset_email'])) {
    header("Location: forgot_password.php");
    exit();
}

$email = $_SESSION['reset_email'];

$msg = "";
$error = "";

if (isset($_POST['verify'])) {

    $otp = mysqli_real_escape_string($conn, trim($_POST['otp']));

    // $result = mysqli_query($conn,
    //     "SELECT * FROM users
    //      WHERE email='$email'
    //      AND otp='$otp'
    //      AND otp_expiry >= NOW()"
    // );
$result = mysqli_query($conn,
    "SELECT * FROM users
     WHERE email='$email'
     AND otp='$otp'"
);
    if (mysqli_num_rows($result) == 1) {

        $_SESSION['reset_verified'] = true;

        header("Location: new_password.php");
        exit();

    } else {

        $error = "Invalid or Expired OTP.";

    }

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verify OTP</title>

<link rel="stylesheet" href="../assets/css/auth.css">

</head>

<body>

<a href="forgot_password.php" class="back-btn">← Back</a>

<div class="container">

<h2>Verify OTP</h2>

<?php if($msg!=""){ ?>
<p class="message"><?php echo $msg; ?></p>
<?php } ?>

<?php if($error!=""){ ?>
<p class="error"><?php echo $error; ?></p>
<?php } ?>

<form method="POST">

<input
type="text"
name="otp"
placeholder="Enter 6 Digit OTP"
maxlength="6"
required>

<button
type="submit"
name="verify">
Verify OTP
</button>

</form>

<p>
OTP sent to<br>
<strong><?php echo htmlspecialchars($email); ?></strong>
</p>

</div>

</body>

</html>