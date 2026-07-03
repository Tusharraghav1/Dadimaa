<?php

session_start();

include "../config/db.php";

$msg = "";

if (!isset($_SESSION['verify_email'])) {
    header("Location: register.php");
    exit();
}

$email = $_SESSION['verify_email'];

if (isset($_POST['verify'])) {

    $otp = trim($_POST['otp']);

 $sql = "SELECT * FROM users
        WHERE email='$email'
        AND otp='$otp'";

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {

    $user = mysqli_fetch_assoc($result);

    if (strtotime($user['otp_expiry']) < time()) {

        $msg = "OTP Expired";

    } else {

        mysqli_query($conn, "
            UPDATE users
            SET
                is_verified = 1,
                otp = NULL,
                otp_expiry = NULL
            WHERE id=".$user['id']);

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];

        unset($_SESSION['verify_email']);

        header("Location: ../index.php");
        exit();
    }

} else {

    $msg = "Invalid OTP";

}

}

?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Verify Signup OTP</title>
<link rel="stylesheet" href="../assets/css/otp.css">

</head>

<body>
 <a href="register.php" class="back-btn">
    ← Back
</a> 

<div class="container">

<h2>Verify Signup OTP</h2>

<p>OTP sent to</p>

<b><?php echo htmlspecialchars($email); ?></b>

<?php if($msg!=""){ ?>

<p class="message"><?php echo $msg; ?></p>

<?php } ?>

<form method="POST">

<input
type="text"
name="otp"
maxlength="6"
placeholder="Enter OTP"
required>

<button
type="submit"
name="verify">

Verify OTP

</button>

</form>

<br>

<a href="resend_otp.php">Resend OTP</a>

</div>

</body>

</html>