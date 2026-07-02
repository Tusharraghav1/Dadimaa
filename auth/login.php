<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/db.php';
include '../config/mail.php';

$msg = "";

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        // Check if account is verified
        if ($row['is_verified'] == 0) {
            $msg = "Please verify your email first.";
        }

        // Check password
        elseif (password_verify($password, $row['password'])) {

            // Generate Login OTP
            $otp = rand(100000, 999999);
            $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

            mysqli_query($conn,
                "UPDATE users
                SET otp='$otp',
                    otp_expiry='$expiry'
                WHERE id=".$row['id']
            );

            // Send OTP
            if (sendOTP($email, $otp) === true) {

                $_SESSION['login_email'] = $email;

                header("Location: verify_login_otp.php");
                exit();

            } else {

                $msg = "Failed to send OTP.";

            }

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
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../assets/css/auth.css">
</head>
<body>
<a href="../index.php" class="back-btn">← Back</a>
<div class="container">

    <h2>Login</h2>

    <?php if(!empty($msg)){ ?>
        <p class="message"><?php echo $msg; ?></p>
    <?php } ?>

  <form method="POST" autocomplete="off">

    <!-- Fake fields to prevent browser autofill -->
    <input type="text"
           name="fakeuser"
           autocomplete="username"
           style="display:none">

    <input type="password"
           name="fakepass"
           autocomplete="new-password"
           style="display:none">

    <input
        type="email"
        name="email"
        placeholder="Enter Email"
        autocomplete="off"
        spellcheck="false"
        required>

    <!-- Password -->
        <div class="password-box">

            <input
                type="password"
                id="password"
                name="password"
                placeholder="Enter Password"
                autocomplete="new-password"
                required>

            <i class="fa-solid fa-eye toggle-password"
               onclick="togglePassword()"></i>

        </div>

    <button type="submit" name="login">
        Login
    </button>

    <div class="forgot-link">
    <a href="forgot_password.php">Forgot Password?</a>
</div>

</form>

    <p>
        <a href="register.php">Register Here</a>
    </p>

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