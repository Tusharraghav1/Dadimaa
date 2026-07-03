<?php

session_start();

include "../config/db.php";

$msg = "";

if (!isset($_SESSION['login_email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['login_email'];
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

            mysqli_query($conn,"
                UPDATE users
                SET
                    otp=NULL,
                    otp_expiry=NULL
                WHERE id=".$user['id']);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];

            unset($_SESSION['login_email']);

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

    <title>Login OTP Verification</title>
<link rel="stylesheet" href="../assets/css/otp.css">
</head>

<body>
<a href="register.php" class="back-btn">
    ← Back
</a>
<div class="container">

<h2>Verify Login OTP</h2>

<p>OTP has been sent to <b><?php echo htmlspecialchars($email); ?></b></p>

<?php if($msg!=""){ ?>

<p class="message"><?php echo $msg; ?></p>

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

</div>

</body>

</html>