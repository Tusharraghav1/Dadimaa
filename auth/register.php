<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../config/db.php';
include '../config/mail.php';

$message = "";

if (isset($_POST['register'])) {

    $name = trim(mysqli_real_escape_string($conn, $_POST['name']));
    $email = strtolower(trim(mysqli_real_escape_string($conn, $_POST['email'])));
    $plainPassword = $_POST['password'];

    // Basic Validation
    if (empty($name) || empty($email) || empty($plainPassword)) {

        $message = "All fields are required.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $message = "Invalid email address.";

    } elseif (strlen($plainPassword) < 8) {

        $message = "Password must be at least 8 characters.";

    } else {

        // Check existing email
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");

        if (mysqli_num_rows($check) > 0) {

            $message = "Email already exists.";

        } else {

            $password = password_hash($plainPassword, PASSWORD_DEFAULT);

            // Generate OTP
            $otp = rand(100000, 999999);

            $expiry = date("Y-m-d H:i:s", strtotime("+10 minutes"));

            // Insert User
            $sql = "INSERT INTO users
                    (name,email,password,otp,otp_expiry,is_verified)
                    VALUES
                    ('$name','$email','$password','$otp','$expiry',0)";

            if (mysqli_query($conn, $sql)) {

                // Send OTP Email
                if (sendOTP($email, $otp) === true) {

                    $_SESSION['verify_email'] = $email;

                    header("Location: verify_signup_otp.php");
                    exit();

                } else {

                    // Delete user if mail failed
                    mysqli_query($conn, "DELETE FROM users WHERE email='$email'");

                    $message = "Failed to send OTP. Please try again.";

                }

            } else {

                $message = "Registration failed.";

            }

        }

    }

}
?>

<!DOCTYPE html>
<html>

<head>

    <title>Register</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/auth.css">

</head>

<body>
   <a href="../index.php" class="back-btn">← Back</a> 

<div class="container">

    <h2>Create Account</h2>

    <?php if (!empty($message)) { ?>
    <p class="message"><?php echo $message; ?></p>
    <?php } ?>

  <form method="POST" autocomplete="off">

    <!-- Chrome Autofill Trick -->
    <input type="text" name="fakeuser" autocomplete="username" style="display:none;">
    <input type="password" name="fakepass" autocomplete="new-password" style="display:none;">

    <input
        type="text"
        name="name"
        placeholder="Full Name"
        autocomplete="name"
        spellcheck="false"
        required>

    <input
        type="email"
        name="email"
        placeholder="Email Address"
        autocomplete="email"
        spellcheck="false"
        required>

    <input
        type="password"
        name="password"
        placeholder="Create Password"
        autocomplete="new-password"
        required>

    <button
        type="submit"
        name="register">

        Create Account

    </button>

</form>

    <p>

        Already have an account?

        <a href="login.php">Login</a>

    </p>

</div>

</body>
</html>